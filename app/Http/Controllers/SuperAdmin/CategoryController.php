<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensures only authenticated users can access this controller
    }

    // Display a list of parent categories
    public function sa_categories_index()
    {
        // Get the API base URL and authorization key from the .env file
        $apiUrl = env('API_BASE_URL') . '/categories';
        $apiKey = env('API_AUTH_KEY');

        // Make the request with the authorization header
        $response = Http::withoutVerifying()
            ->withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json'
            ])
            ->get($apiUrl);

        if ($response->successful()) {
            // Filter to only include parent categories (where `parent_id` is null)
            $categories = collect($response->json())->filter(function ($category) {
                return is_null($category['parent_id']);
            });

            return view('admin.pages.category.category', compact('categories'));
        } else {
            return back()->with('error', 'Failed to fetch categories.');
        }
    }
}