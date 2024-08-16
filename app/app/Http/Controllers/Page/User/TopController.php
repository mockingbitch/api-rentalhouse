<?php

namespace App\Http\Controllers\Page\User;

use App\Http\Controllers\Controller;
use App\Http\Entities\HouseEntity;
use App\Http\Resources\HouseResource;
use App\Services\HouseService;
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $response = app(HouseService::class)->listHouse($request->all());
        $data = [];
        foreach ($response['data'] as $item) {
            $house = new HouseEntity($item);
            $data[] = (new HouseResource($house))->toResponse($item);
        }

        return view('top', [
            'houses' => $data
        ]);
    }
}
