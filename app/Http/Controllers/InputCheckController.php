<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class InputCheckController extends Controller
{
    public function index() {
        return Inertia::render('InputCheck/InputCheck');
    }
}
