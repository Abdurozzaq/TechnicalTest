<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CalculatorController extends Controller
{
    public function calculatorOngkir() {
        return Inertia::render('CalculatorOngkirProgresif/Calculator');
    }
}
