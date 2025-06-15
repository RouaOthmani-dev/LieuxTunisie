<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lieu;

class LieuPublicController extends Controller
{
    public function show($id)
    {
        $lieu = Lieu::findOrFail($id);
        return view('lieux.show', compact('lieu'));
    }
}