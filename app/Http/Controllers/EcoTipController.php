<?php

namespace App\Http\Controllers;

use App\Models\EcoTip;

class EcoTipController extends Controller
{
    public function index()
    {
        $tips = EcoTip::where('is_active', true)
            ->orderBy('category')
            ->get()
            ->groupBy('category');

        return view('tips.index', compact('tips'));
    }

    public function show(EcoTip $ecoTip)
    {
        if (!$ecoTip->is_active) {
            abort(404);
        }

        return view('tips.show', ['tip' => $ecoTip]);
    }
}
