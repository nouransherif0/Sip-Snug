<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreLocation;
use App\Http\Requests\StoreLocations\StoreStoreLocationRequest;
use App\Http\Requests\StoreLocations\UpdateStoreLocationRequest;

class AdminStoreLocationController extends Controller
{
    public function index()
    {
        $locations = StoreLocation::orderBy('id', 'asc')->get();
        return response()->json(['data' => $locations]);
    }

    public function store(StoreStoreLocationRequest $request)
    {
        $data = $request->validated();
        if (!isset($data['is_active'])) {
            $data['is_active'] = true;
        }

        $location = StoreLocation::create($data);

        return response()->json([
            'message' => 'Store location created successfully!',
            'data' => $location,
        ], 201);
    }

    public function show($id)
    {
        $location = StoreLocation::findOrFail($id);
        return response()->json(['data' => $location]);
    }

    public function update(UpdateStoreLocationRequest $request, $id)
    {
        $location = StoreLocation::findOrFail($id);
        $data = $request->validated();

        $location->update($data);

        return response()->json([
            'message' => 'Store location updated successfully!',
            'data' => $location,
        ]);
    }

    public function destroy($id)
    {
        $location = StoreLocation::findOrFail($id);
        $location->delete();

        return response()->json([
            'message' => 'Store location deleted successfully!',
        ]);
    }
}
