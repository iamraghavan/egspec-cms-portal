<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->middleware('auth');
        $this->apiUrl = env('API_BASE_URL') . '/categories';
        $this->apiKey = env('API_AUTH_KEY');
    }

    // Helper method to make API requests with error handling
    protected function makeApiRequest($method, $url, $data = [])
    {
        try {
            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json'
                ])
                ->$method($url, $data);

            if ($response->failed()) {
                throw new \Exception($response->body());
            }

            return $response;
        } catch (\Exception $e) {
            Log::error('API Request Error: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }
    }

    // Display a list of parent categories
    public function sa_categories_index()
    {
        $response = $this->makeApiRequest('get', $this->apiUrl);

        if ($response->status() === 200) {
            $categories = collect($response->json())->filter(fn($category) => is_null($category['parent_id']));
            return view('admin.pages.category.category', compact('categories'));
        } else {
            return back()->with('error', 'Failed to fetch categories.');
        }
    }

    // Show the form to create a new category
    public function sa_categories_create()
    {
        return view('admin.pages.category.add-category');
    }

    // Create a new category
    public function sa_categories_post(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
            'description' => 'nullable|string',
            'keywords' => 'nullable|array',
            'parent_id' => 'nullable|string',
            'category_order' => 'nullable|integer',
            'show_on_menu' => 'boolean'
        ]);

        $response = $this->makeApiRequest('post', $this->apiUrl, $data);

        if ($response->status() === 201) {
            return redirect()->route('sa_categories_index')->with('success', 'Category created successfully.');
        } else {
            return back()->with('error', 'Failed to create category.');
        }
    }

    // Show the form to edit an existing category
    public function sa_categories_edit($id)
    {
        $url = $this->apiUrl . "/{$id}";
        $response = $this->makeApiRequest('get', $url);

        if ($response->status() === 200) {
            $category = $response->json();
            return view('admin.pages.category.edit-category', compact('category'));
        } else {
            return back()->with('error', 'Failed to fetch category details.');
        }
    }

    // Update a specific category
    public function sa_categories_update(Request $request, $id)
    {
        // Validate incoming data
        $data = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
            'description' => 'nullable|string',
            'keywords' => 'nullable|string', // Accept the keywords as a string
            'parent_id' => 'nullable|string',
            'category_order' => 'nullable|integer',
            'show_on_menu' => 'boolean'
        ]);

        // Convert keywords to an array if it's a non-empty string
        if (isset($data['keywords']) && !empty($data['keywords'])) {
            $data['keywords'] = array_map('trim', explode(',', $data['keywords']));
        }

        // Make the API request to update the category
        $url = $this->apiUrl . "/{$id}";
        $response = $this->makeApiRequest('put', $url, $data);

        // Check the response and redirect accordingly
        if ($response->status() === 200) {
            return redirect()->route('sa_categories_index')->with('success', 'Category updated successfully.');
        } else {
            return back()->with('error', 'Failed to update category.');
        }
    }


    // Delete a specific category
    public function sa_categories_destroy($id)
    {
        $url = $this->apiUrl . "/{$id}";
        $response = $this->makeApiRequest('delete', $url);

        if ($response->status() === 200) {
            return redirect()->route('sa_categories_index')->with('success', 'Category deleted successfully.');
        } else {
            return back()->with('error', 'Failed to delete category.');
        }
    }
}
