<?php

namespace App\Http\Controllers\Admin;

use App\Actions\CreateTravel;
use App\Data\Travel\TravelCreationData;
use App\Data\Travel\TravelEditData;
use App\Http\Controllers\Controller;
use App\Models\Travel;

class TravelsController extends Controller
{
    public function store(TravelCreationData $travelCreationData)
    {
        $travel = CreateTravel::execute($travelCreationData);

        return response()->json();
    }

    public function edit(Travel $travel, TravelEditData $travelEditData)
    {
        //action

        return response()->json();
    }
}
