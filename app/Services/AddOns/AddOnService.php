<?php

namespace App\Services\AddOns;

use App\Models\AddOn;

// Defines the structure and properties of this class
class AddOnService
{
    public function getAllAddOns()
    {
   return AddOn::all();
    }

    public function getAddOnById(int $id)
    {
  return AddOn::findOrFail($id);
    }

    public function createAddOn(array $data)
    {
   return AddOn::create($data);
    }

    public function updateAddOn(int $id, array $data)
    {
    $addOn = AddOn::findOrFail($id);
    $addOn->update($data);
   return $addOn;
    }

    public function deleteAddOn(int $id)
    {
   $addOn = AddOn::findOrFail($id);
  $addOn->delete();
    }
}