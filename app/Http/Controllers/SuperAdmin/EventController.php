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

class EventService
{

    public function uploadImage($image)
    {
        // Same upload logic as before
        $firebase = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/egspec-website-firebase-adminsdk-fitho-243e4c443a.json'));

        $storage = $firebase->createStorage();
        $bucket = $storage->getBucket();
        $fileName = 'egspec/events/' . Carbon::now()->format('Y/m') . '/' . Str::uuid() . '.webp';
        $stream = fopen($image->getRealPath(), 'r');

        $bucket->upload($stream, [
            'name' => $fileName,
            'metadata' => [
                'contentType' => 'image/webp',
            ]
        ]);

        $imageReference = $bucket->object($fileName);
        return $imageReference->signedUrl(new \DateTime('+1 year'));
    }
}

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
        $this->middleware('auth');
    }

    public function sa_event_index()
    {
        $events = LiveEvent::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pages.events.events', compact('events'));
    }

    public function sp_event_create()
    {
        return view('admin.pages.events.add-events');
    }

    public function sp_event_store(Request $request)
    {
        $validatedData = $this->validateEvent($request);

        try {
            $event = new LiveEvent($validatedData);
            $event->event_created_by = auth()->id();
            $event->event_id = Str::uuid();
            if ($request->hasFile('event_image')) {
                $event->event_image = $this->eventService->uploadImage($request->file('event_image'));
            }
            $event->save();
            return redirect()->route('sa_event_index')->with('success', 'Event created successfully.');
        } catch (\Exception $e) {
            Log::error('Event save error: ' . $e->getMessage());
            return back()->with('error', 'An unexpected error occurred while saving the event. Please try again later.');
        }
    }

    protected function validateEvent(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'venue' => 'required|string|max:255',
            'event_image' => 'nullable|image|mimes:webp|max:1024',
            'department' => 'required|string',
            'attachment' => 'nullable|url',
        ]);
    }

    public function sp_event_edit(Request $request)
    {
        $eventId = $request->query('id');
        $event = LiveEvent::where('event_id', $eventId)->firstOrFail();
        return view('admin.pages.events.edit-events', compact('event'));
    }

    public function sp_event_update(Request $request, LiveEvent $event)
    {
        $validatedData = $this->validateEvent($request);

        try {
            $event->fill($validatedData);
            if ($request->hasFile('event_image')) {
                $event->event_image = $this->eventService->uploadImage($request->file('event_image'));
            }
            $event->save();
            return redirect()->route('sa_event_index')->with('success', 'Event updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update event: ' . $e->getMessage());
            return back()->with('error', 'An unexpected error occurred while updating the event. Please try again later.');
        }
    }

    public function sp_event_destroy(Request $request)
    {
        try {
            $eventId = $request->query('id');
            $event = LiveEvent::where('event_id', $eventId)->firstOrFail();
            $event->delete();
            return redirect()->route('sa_event_index')->with('success', 'Event deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Event delete error: ' . $e->getMessage());
            return back()->with('error', 'An unexpected error occurred while deleting the event. Please try again later.');
        }
    }
}