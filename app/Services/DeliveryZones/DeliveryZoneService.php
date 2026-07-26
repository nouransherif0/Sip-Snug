<?php

namespace App\Services\DeliveryZones;

use App\Models\DeliveryZone;

// Defines the structure and properties of this class
class DeliveryZoneService
{
    public function getAllZones()
    {
   return DeliveryZone::all();
    }

    public function getZoneById(int $id)
    {
   return DeliveryZone::findOrFail($id);
    }

    public function createZone(array $data)
    {
   return DeliveryZone::create($data);
    }

    public function updateZone(int $id, array $data)
    {
   $zone = DeliveryZone::findOrFail($id);
   $zone->update($data);
   return $zone;
    }

    public function deleteZone(int $id)
    {
   $zone = DeliveryZone::findOrFail($id);
  $zone->delete();
    }
}