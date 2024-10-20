<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\LiveEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Cloudinary\Cloudinary;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Storage;
use Carbon\Carbon;


class EventController extends Controller
{
    protected $cloudinary;

    public function __construct()
    {
        // Initialize Cloudinary
        $this->cloudinary = new Cloudinary();
        $this->middleware('auth');
    }

    public function sa_event_index()
    {
        $events = LiveEvent::orderBy('created_at', 'desc')->paginate(10);
        $dates = LiveEvent::select('date')->distinct()->get(); // Example for date filtering
        $venues = LiveEvent::select('venue')->distinct()->get();
        return view('admin.pages.events', compact('events', 'dates', 'venues'));
    }



    public function sp_event_create()
    {
        return view('admin.pages.add-events');
    }


    public function sp_event_store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'venue' => 'required|string',
            'event_image' => 'nullable|image|mimes:webp|max:1024', // 1MB limit
            'department' => 'required|string',
            'attachment' => 'nullable|url',
        ]);

        // Debug request data
        Log::info('Event data:', $request->all());

        $event = new LiveEvent();
        $event->title = $request->title;
        $event->date = $request->date;
        $event->time = $request->time;
        $event->venue = $request->venue;
        $event->department = $request->department;
        $event->slug = Str::slug($request->title);
        $event->event_created_by = auth()->id();
        $event->event_id = Str::uuid();
        $event->attachment = $request->attachment; // Store Google Drive URL if provided

        // Process and upload image if provided
        if ($request->hasFile('event_image')) {
            $event->event_image = $this->uploadImageToFirebase($request->file('event_image'));
        }

        try {
            $event->save();
            return redirect()->route('sa_event_index')->with('success', 'Event created successfully.');
        } catch (\Exception $e) {
            Log::error('Event save error: ' . $e->getMessage());
            return back()->with('error', 'Error saving event: ' . $e->getMessage());
        }
    }

    private function uploadImageToFirebase($image)
    {
        // Initialize Firebase
        $firebase = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/egspec-website-firebase-adminsdk-fitho-243e4c443a.json'));

        $storage = $firebase->createStorage();
        $bucket = $storage->getBucket();

        // Create a unique file name and upload the image
        $fileName = 'egspec/events/' . Carbon::now()->format('Y/m') . '/' . Str::uuid() . '.webp';
        $stream = fopen($image->getRealPath(), 'r');

        // Upload the image to the bucket
        $bucket->upload($stream, [
            'name' => $fileName,
            'metadata' => [
                'contentType' => 'image/webp',
                'contentLanguage' => 'en',
                'customMetadata' => [
                    'uploadedBy' => 'Raghavan Jeeva',
                    'description' => 'EGS Pillay Group of Institutions'
                ]
            ]
        ]);

        // Get the image URL
        $imageReference = $bucket->object($fileName);
        $imageUrl = $imageReference->signedUrl(new \DateTime('+1 year'));

        return $imageUrl;
    }


    public function edit(LiveEvent $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, LiveEvent $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'venue' => 'required|string',
            'event_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'department' => 'required|string',
        ]);

        $event->title = $request->title;
        $event->date = $request->date;
        $event->time = $request->time;
        $event->venue = $request->venue;
        $event->department = $request->department;
        $event->slug = Str::slug($request->title);

        // Process and upload new image if provided
        if ($request->hasFile('event_image')) {
            $event->event_image = $this->uploadImage($request->file('event_image'));
        }

        $event->save();

        return redirect()->route('sa_event_index')->with('success', 'Event updated successfully.');
    }

    public function sp_event_destroy(Request $request)
    {
        try {
            $eventId = $request->query('id');

            $event = LiveEvent::where('event_id', $eventId)->firstOrFail();

            $event->delete();
            return redirect()->route('sa_event_index')->with('success', 'Event deleted successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Event not found: ' . $e->getMessage());
            return back()->with('error', 'Error deleting event: ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::error('Event delete error: ' . $e->getMessage());
            return back()->with('error', 'Error deleting event: ' . $e->getMessage());
        }
    }
}