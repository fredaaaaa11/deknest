<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController 
{
    // ── PUBLIC ──

    public function index()
    {
        $projects = Project::where('featured', true)
            ->orderBy('sort_order')
            ->get();

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $project->load('images');
        $renders = $project->renders;
        $completed = $project->completedImages;

        return view('projects.show', compact('project', 'renders', 'completed'));
    }

    // ── ADMIN ──

    public function adminIndex()
    {
        $projects = Project::orderBy('sort_order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:200',
            'location'      => 'required|string|max:200',
            'category'      => 'required|string|max:100',
            'description'   => 'nullable|string',
            'year'          => 'nullable|string|max:4',
            'status'        => 'required|string',
            'featured'      => 'boolean',
            'sort_order'    => 'integer',
            'cover_image'   => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            'images.*'      => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            'image_types.*' => 'nullable|string',
            'captions.*'    => 'nullable|string',
        ]);

        // handle cover image
        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('projects', 'public');
        }

        $project = Project::create([
            'name'        => $request->name,
            'location'    => $request->location,
            'category'    => $request->category,
            'description' => $request->description,
            'year'        => $request->year,
            'status'      => $request->status,
            'featured'    => $request->boolean('featured'),
            'sort_order'  => $request->sort_order ?? 0,
            'cover_image' => $coverPath,
        ]);

        // handle additional images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('projects', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $path,
                    'type'       => $request->image_types[$index] ?? 'completed',
                    'caption'    => $request->captions[$index] ?? null,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project added successfully.');
    }

    public function edit(Project $project)
    {
        $project->load('images');
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name'        => 'required|string|max:200',
            'location'    => 'required|string|max:200',
            'category'    => 'required|string|max:100',
            'description' => 'nullable|string',
            'year'        => 'nullable|string|max:4',
            'status'      => 'required|string',
            'featured'    => 'boolean',
            'sort_order'  => 'integer',
            'cover_image' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            'images.*'    => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        // handle new cover image
        if ($request->hasFile('cover_image')) {
            if ($project->cover_image) {
                Storage::disk('public')->delete($project->cover_image);
            }
            $project->cover_image = $request->file('cover_image')->store('projects', 'public');
        }

        $project->update([
            'name'        => $request->name,
            'location'    => $request->location,
            'category'    => $request->category,
            'description' => $request->description,
            'year'        => $request->year,
            'status'      => $request->status,
            'featured'    => $request->boolean('featured'),
            'sort_order'  => $request->sort_order ?? 0,
            'cover_image' => $project->cover_image,
        ]);

        // handle new images
        if ($request->hasFile('images')) {
            $existingCount = $project->images()->count();
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('projects', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $path,
                    'type'       => $request->image_types[$index] ?? 'completed',
                    'caption'    => $request->captions[$index] ?? null,
                    'sort_order' => $existingCount + $index,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->cover_image) {
            Storage::disk('public')->delete($project->cover_image);
        }
        foreach ($project->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    public function destroyImage(ProjectImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Image removed.');
    }
}