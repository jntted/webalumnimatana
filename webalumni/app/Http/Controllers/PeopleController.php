<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Alumni;

class PeopleController extends Controller
{
    /**
     * Display lists of active students and alumni.
     */
    public function index()
    {
        // Load related user data (name, email, etc.) for display
        $students = Student::with('user')->orderBy('nim')->get();
        $alumni = Alumni::with('user')->orderBy('graduation_year', 'desc')->get();

        return view('lists.index', compact('students', 'alumni'));
    }
}
