<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Candidate;

class DashboardController extends Controller
{
    public function index()
    {
        $candidates = Candidate::all();

        return view('pages.app.dashboard', compact('candidates'));
    }
}
