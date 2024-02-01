<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TravelToursController extends Controller
{
    public function store()
    {
        return view('admin.travel_tours.index');
    }
}
