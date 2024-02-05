<?php

namespace App\Http\Controllers\Admin;

use App\Actions\CreateTravel;
use App\Actions\EditTravel;
use App\Data\Travel\TravelCreationData;
use App\Data\Travel\TravelEditData;
use App\Http\Controllers\Controller;
use App\Http\Resources\TravelResource;
use App\Models\Travel;

class TravelsController extends Controller
{
    public function store(TravelCreationData $travelCreationData): TravelResource
    {
        $travel = CreateTravel::execute($travelCreationData);

        return new TravelResource($travel);
    }

    public function edit(Travel $travel, TravelEditData $travelEditData): TravelResource
    {
        $travel = EditTravel::execute($travel, $travelEditData);
        return new TravelResource($travel);

    }
}
