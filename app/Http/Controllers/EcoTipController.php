<?php

namespace App\Http\Controllers;

use App\Models\EcoTip;
use Illuminate\Http\Request;

class EcoTipController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category', 'all');

        $query = EcoTip::query();
        if ($category !== 'all') {
            $query->where('category', $category);
        }

        $tips = $query->get();
        $tipOfDay = EcoTip::inRandomOrder()->first();
        $categories = EcoTip::distinct()->pluck('category');

        return view('eco-tips.index', compact('tips', 'tipOfDay', 'category', 'categories'));
    }
}
