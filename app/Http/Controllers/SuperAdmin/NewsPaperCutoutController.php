<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\NewspaperCutout;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class NewsPaperCutoutController extends Controller
{
    protected $firebase;
    protected $bucket;

    public function __construct()
    {
        // Initialize Firebase on controller instantiation
        $this->firebase = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/egspec-website-firebase-adminsdk-fitho-243e4c443a.json'))
            ->createStorage();

        $this->bucket = $this->firebase->getBucket();
    }

    /**
     * List newspaper cutouts with pagination and eager load user data
     */
    public function sa_newspcc_index()
    {
        $newspcc = NewspaperCutout::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pages.newspaper-cutout.newspaper-cutout', compact('newspcc'));
    }

    /**
     * View a single newspaper cutout by ID with detailed error handling
     */
    public function sa_newspcc_view(Request $request)
    {
        try {
            $newspccId = $request->query('id');
            $newspcc = NewspaperCutout::where('id', $newspccId)->firstOrFail();
            return view('admin.pages.newspaper-cutout.newspaper-cutout-view', compact('newspcc'));
        } catch (\Exception $e) {
            Log::error('Error fetching newspaper cutout: ' . $e->getMessage());
            return redirect()->route('sa_newspcc_index')->with('error', 'Failed to load the newspaper cutout.');
        }
    }

    /**
     * Show the create form for a newspaper cutout
     */
    public function sa_newspcc_create()
    {
        return view('admin.pages.newspaper-cutout.add-newspaper-cutout');
    }

    /**
     * Store a new newspaper cutout with Firebase image upload
     */
    public function sp_newspcc_store(Request $request)
    {
        $request->validate([
            'newspaper_name' => 'required|string|max:255',
            'description' => 'required|string',
            'department' => 'required|string',
            'date_of_publish' => 'required|date',
            'image_path' => 'required|file|mimes:webp|max:1024', // only .webp files under 1MB
        ]);

        try {
            // Upload image to Firebase
            $imageUrl = $this->uploadImageToFirebase($request->file('image_path'));

            // Store newspaper cutout in database
            $newspcc = new NewspaperCutout();
            $newspcc->newspaper_name = $request->newspaper_name;
            $newspcc->department = $request->department;
            $newspcc->description = $request->description;
            $newspcc->date_of_publish = $request->date_of_publish;
            $newspcc->uploaded_by = auth()->id();
            $newspcc->updated_at = now();
            $newspcc->image_path = $imageUrl;
            $newspcc->save();

            return redirect()->route('sa_newspcc_index')->with('success', 'Newspaper Cutout added successfully.');
        } catch (\Exception $e) {
            Log::error('Error storing newspaper cutout: ' . $e->getMessage());
            return back()->with('error', 'Failed to add newspaper cutout. Please try again.');
        }
    }

    /**
     * Delete a newspaper cutout and its associated Firebase image
     */
    public function sp_newspcc_destroy(Request $request)
    {
        try {
            $newspccId = $request->query('id');
            $newspcc = NewspaperCutout::where('id', $newspccId)->firstOrFail();

            // Delete image from Firebase Storage
            $this->deleteImageFromFirebase($newspcc->image_path);

            // Delete database record
            $newspcc->delete();

            return redirect()->route('sa_newspcc_index')->with('success', 'Newspaper Cutout deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting newspaper cutout: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete newspaper cutout.');
        }
    }

    /**
     * Upload image to Firebase Storage and return the signed URL
     */
    protected function uploadImageToFirebase($file)
    {
        $fileName = 'egspec/newspaper/' . Carbon::now()->format('Y/m') . '/' . Str::uuid() . '.webp';
        $stream = fopen($file->getRealPath(), 'r');

        try {
            $this->bucket->upload($stream, [
                'name' => $fileName,
                'metadata' => [
                    'contentType' => 'image/webp',
                ]
            ]);

            $imageReference = $this->bucket->object($fileName);
            return $imageReference->signedUrl(new \DateTime('+1 year'));
        } catch (\Exception $e) {
            Log::error('Error uploading image to Firebase: ' . $e->getMessage());
            throw new \Exception('Image upload failed');
        } finally {
            fclose($stream);
        }
    }

    /**
     * Delete image from Firebase Storage using the provided URL
     */
    protected function deleteImageFromFirebase($imageUrl)
    {
        try {
            // Extract file name from URL
            $path = parse_url($imageUrl, PHP_URL_PATH);
            $fileName = ltrim($path, '/');

            $object = $this->bucket->object($fileName);

            if ($object->exists()) {
                $object->delete();
            }
        } catch (\Exception $e) {
            Log::error('Error deleting image from Firebase: ' . $e->getMessage());
            throw new \Exception('Failed to delete associated image');
        }
    }
}