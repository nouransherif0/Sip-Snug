<?php

namespace App\Services\Addresses;

use App\Models\Address;
use Illuminate\Support\Facades\DB;

// Defines the structure and properties of this class
class AddressService
{
    public function getUserAddresses(string $userId)
    {
        return Address::with('deliveryZone')
            ->where('user_id', $userId)
            ->orderByDesc('is_default')
            ->orderByDesc('created_at')
            ->get();
    }

    public function createAddress(string $userId, array $data)
    {
        return DB::transaction(function () use ($userId, $data) {
            if (isset($data['is_default']) && $data['is_default']) {
                Address::where('user_id', $userId)->update(['is_default' => false]);
            } else {
                // If it's the first address, make it default automatically
                $count = Address::where('user_id', $userId)->count();
                if ($count === 0) {
                    $data['is_default'] = true;
                }
            }

            $data['user_id'] = $userId;
            return Address::create($data);
        });
    }

    public function updateAddress(string $addressId, string $userId, array $data)
    {
        return DB::transaction(function () use ($addressId, $userId, $data) {
            $address = Address::where('id', $addressId)->where('user_id', $userId)->firstOrFail();

            if (isset($data['is_default']) && $data['is_default']) {
                Address::where('user_id', $userId)->where('id', '!=', $addressId)->update(['is_default' => false]);
            }

            $address->update($data);
            return $address;
        });
    }

    public function deleteAddress(string $addressId, string $userId)
    {
        $address = Address::where('id', $addressId)->where('user_id', $userId)->firstOrFail();
        $address->delete();
    }
}
