<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\LiveCircular;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Kreait\Firebase\Factory;
use Illuminate\Support\Str;

class CircularController extends Controller
{
    public function sa_circular_index()
    {
        $circulars = LiveCircular::all();
        return view('admin.pages.circulars.circulars', compact('circulars'));
    }

    public function sa_circular_create()
    {
        return view('admin.pages.circulars.add-circulars');
    }

    public function store(Request $request)
    {
        $request->validate([
            'circular_content' => 'required',
            'date' => 'required|date',
            'circular_attachment' => 'nullable|file|mimes:pdf',
            'slug' => 'required|unique:live_circulars', // Update table name if necessary
            'department' => 'required|in:COE,Principal & Administration',
            'circular_id' => 'required|unique:live_circulars', // Update table name if necessary
            'authorized_signature_person' => 'required',
        ]);

        $circular = new LiveCircular($request->all());

        // Handle file upload to Firebase
        if ($request->hasFile('circular_attachment')) {
            $filePath = $this->uploadToFirebase($request->file('circular_attachment'));
            $circular->circular_attachment = $filePath; // Store Firebase path
        }

        $circular->circular_created_by = auth()->id();
        $circular->save();

        return redirect()->route('circulars.index')->with('success', 'Circular created successfully.');
    }

    public function edit(LiveCircular $circular) // Update here
    {
        return view('circulars.edit', compact('circular'));
    }

    public function update(Request $request, LiveCircular $circular) // Update here
    {
        $request->validate([
            'circular_content' => 'required',
            'date' => 'required|date',
            'circular_attachment' => 'nullable|file|mimes:pdf',
            'slug' => 'required|unique:live_circulars,slug,' . $circular->id, // Update table name if necessary
            'department' => 'required|in:COE,Principal & Administration',
            'circular_id' => 'required|unique:live_circulars,circular_id,' . $circular->id, // Update table name if necessary
            'authorized_signature_person' => 'required',
        ]);

        $circular->fill($request->all());

        // Handle file upload to Firebase
        if ($request->hasFile('circular_attachment')) {
            // Delete the old attachment if it exists
            if ($circular->circular_attachment) {
                $this->deleteFromFirebase($circular->circular_attachment);
            }
            $filePath = $this->uploadToFirebase($request->file('circular_attachment'));
            $circular->circular_attachment = $filePath; // Update Firebase path
        }

        $circular->save();

        return redirect()->route('circulars.index')->with('success', 'Circular updated successfully.');
    }

    public function destroy(LiveCircular $circular) // Update here
    {
        // Delete the attachment if it exists
        if ($circular->circular_attachment) {
            $this->deleteFromFirebase($circular->circular_attachment);
        }

        $circular->delete();

        return redirect()->route('circulars.index')->with('success', 'Circular deleted successfully.');
    }

    private function uploadToFirebase($file)
    {
        $firebase = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/egspec-website-firebase-adminsdk-fitho-243e4c443a.json'));

        $storage = $firebase->createStorage();
        $bucket = $storage->getBucket();
        $fileName = 'egspec/circular/' . Carbon::now()->format('Y/m') . '/' . Str::uuid() . '.pdf';
        $stream = fopen($file->getRealPath(), 'r');

        $bucket->upload($stream, [
            'name' => $fileName,
            'metadata' => [
                'contentType' => 'application/pdf',
            ]
        ]);

        return $fileName; // Return the Firebase file path
    }

    private function deleteFromFirebase($filePath)
    {
        $firebase = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/egspec-website-firebase-adminsdk-fitho-243e4c443a.json'));

        $storage = $firebase->createStorage();
        $bucket = $storage->getBucket();
        $object = $bucket->object($filePath);
        $object->delete(); // Delete the file from Firebase
    }
}
