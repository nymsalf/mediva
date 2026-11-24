<?php

namespace App\Http\Controllers;

use App\Models\Medicine;

class PharmacyController extends Controller
{
    public function index()
    {
        $medicines = Medicine::orderBy('name')->get();

        return view('pharmacy.index', compact('medicines'));
    }
}