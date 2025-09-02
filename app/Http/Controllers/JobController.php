<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::query();
        
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('company', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('location', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('what_you_will_do', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('requirements', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category', $request->category);
        }
        
        $perPage = $request->get('per_page', 9);
        $perPage = min(max((int)$perPage, 1), 50); 
        
        $query->orderBy('created_at', 'desc');
        
        $jobs = $query->paginate($perPage);
        
        $jobs->appends($request->query());
        
        return response()->json($jobs);
    }

    public function show($id)
    {
        $job = Job::findOrFail($id);
        return response()->json($job);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'job_type' => 'required|string|max:100',
            'experience' => 'required|string|max:100',
            'salary' => 'required|string|max:100',
            'what_you_will_do' => 'nullable|string',
            'requirements' => 'nullable|string',
            'nice_to_have' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'expires_at' => 'nullable|date',
        ]);

        $job = Job::create($validated);

        return response()->json([
            'message' => 'Job created successfully!',
            'data' => $job
        ], 201);
    }

    public function delete($id)
    {
        $job = Job::find($id);

        if (!$job) {
            return response()->json([
                'message' => 'Job not found.'
            ], 404);
        }

        $job->delete();

        return response()->json([
            'message' => 'Job deleted successfully.'
        ], 200);
    }
    
    public function getCategories()
    {
        $categories = Job::distinct()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->pluck('category')
            ->sort()
            ->values();
            
        return response()->json($categories);
    }
}