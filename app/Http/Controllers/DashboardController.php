<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    // Create Category View For Operator
    public function index() {
        return Inertia::render('Dashboard');
    }
}
