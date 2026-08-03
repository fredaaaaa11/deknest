<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class HomeController
{
    public function index()
    {
        $projects = Project::where('featured', true)
            ->orderBy('sort_order')
            ->get();

        return view('home', compact('projects'));
    }
}