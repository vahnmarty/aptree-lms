<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $courses = [];
        $libraries = [];
        $enrollments = [];

        return view('dashboard', compact('courses', 'libraries', 'enrollments'));
    }
}
