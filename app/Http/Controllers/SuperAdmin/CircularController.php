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
        try {
            $circulars = LiveCircular::with('user')->orderBy('created_at', 'desc')->paginate(10);
            return view('admin.pages.circulars.circulars', compact('circulars'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve circulars: ' . $e->getMessage());
        }
    }

    public function sa_circular_create()
    {
        return view('admin.pages.circulars.add-circulars');
    }

    public function sp_circular_store(Request $request)
    {
        $this->validateCircular($request);

        try {
            $circular = new LiveCircular();
            $this->fillCircular($circular, $request);
            $this->handleFileUpload($request, $circular);

            $circular->save();

            return redirect()->route('sa_circular_index')->with('success', 'Circular created successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create circular: ' . $e->getMessage());
        }
    }

    public function sp_circular_edit(Request $request, LiveCircular $circular)
    {
        $circularId = $request->query('id');
        $circular = LiveCircular::where('circular_id', $circularId)->firstOrFail();

        return view('admin.pages.circulars.edit-circulars', compact('circular'));
    }

    public function sp_circular_update(Request $request, LiveCircular $circular)
    {
        $this->validateCircular($request);

        try {
            $this->fillCircular($circular, $request);
            $this->handleFileUpdate($request, $circular);

            $circular->save();

            return redirect()->route('sa_circular_index')->with('success', 'Circular updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update circular: ' . $e->getMessage());
        }
    }

    public function sp_circular_destroy($id)
    {
        try {
            $circular = LiveCircular::where('circular_id', $id)->firstOrFail();
            $this->deleteFileFromFirebase($circular->circular_attachment);
            $circular->delete();

            return redirect()->route('sa_circular_index')->with('success', 'Circular deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete circular: ' . $e->getMessage());
        }
    }

    private function validateCircular(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:10|max:90',
            'circular_content' => 'required',
            'date' => 'required|date',
            'circular_attachment' => 'nullable|file|mimes:pdf|max:2048',
            'department' => 'required|in:COE,Principal & Administration',
            'authorized_signature_person' => 'required|string',
        ]);
    }

    private function fillCircular(LiveCircular $circular, Request $request)
    {
        $circular->title = $request->title;
        $circular->slug = Str::slug($request->title);
        $circular->circular_content = $request->circular_content;
        $circular->date = $request->date;
        $circular->department = $request->department;
        $circular->authorized_signature_person = $request->authorized_signature_person;
        $circular->circular_created_by = auth()->id();
        $circular->circular_id = 'egspec-circular' . strtolower(Str::random(8));
    }

    private function handleFileUpload(Request $request, LiveCircular $circular)
    {
        if ($request->hasFile('circular_attachment')) {
            $circular->circular_attachment = $this->uploadToFirebase($request->file('circular_attachment'));
        }
    }

    private function handleFileUpdate(Request $request, LiveCircular $circular)
    {
        if ($request->hasFile('circular_attachment')) {
            $this->deleteFileFromFirebase($circular->circular_attachment);
            $circular->circular_attachment = $this->uploadToFirebase($request->file('circular_attachment'));
        }
    }

    private function uploadToFirebase($file)
    {
        try {
            $firebase = (new Factory)->withServiceAccount(storage_path('app/firebase/egspec-website-firebase-adminsdk-fitho-243e4c443a.json'));
            $storage = $firebase->createStorage();
            $bucket = $storage->getBucket();
            $fileName = 'egspec/circular/' . Carbon::now()->format('Y/m') . '/' . Str::uuid() . '.pdf';
            $stream = fopen($file->getRealPath(), 'r');

            // Upload file to Firebase Storage
            $bucket->upload($stream, [
                'name' => $fileName,
                'metadata' => ['contentType' => 'application/pdf'],
            ]);

            // Return the full public URL
            return $bucket->object($fileName)->signedUrl(new \DateTime('+1 hour')); // URL expires in 1 hour
        } catch (\Exception $e) {
            throw new \RuntimeException('Failed to upload file: ' . $e->getMessage());
        }
    }

    private function deleteFileFromFirebase($fileURL)
    {
        if ($fileURL) {
            try {
                $firebase = (new Factory)->withServiceAccount(storage_path('app/firebase/egspec-website-firebase-adminsdk-fitho-243e4c443a.json'));
                $storage = $firebase->createStorage();
                $bucket = $storage->getBucket();
                $object = $bucket->object(parse_url($fileURL, PHP_URL_PATH));
                $object->delete();
            } catch (\Exception $e) {
                throw new \RuntimeException('Failed to delete file: ' . $e->getMessage());
            }
        }
    }
}