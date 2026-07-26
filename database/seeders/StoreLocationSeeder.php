<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StoreLocation;

class StoreLocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            [
                'name' => 'Nasr City Branch',
                'badge' => 'Flagship Store',
                'address' => 'Abbas El Akkad St, Nasr City, Cairo',
                'days_label' => 'Daily',
                'opening_time' => '07:00',
                'closing_time' => '00:00',
                'working_hours' => 'Daily: 07:00 AM - 12:00 AM',
                'phone' => '+20 19696 (Ext. 1)',
                'google_maps_url' => 'https://maps.google.com/?q=Nasr+City',
                'status' => 'open',
                'is_active' => true,
            ],
            [
                'name' => 'Zamalek Outlet',
                'badge' => 'Co-Working Friendly',
                'address' => '26th of July St, Zamalek, Cairo',
                'days_label' => 'Daily',
                'opening_time' => '08:00',
                'closing_time' => '23:30',
                'working_hours' => 'Daily: 08:00 AM - 11:30 PM',
                'phone' => '+20 19696 (Ext. 2)',
                'google_maps_url' => 'https://maps.google.com/?q=Zamalek',
                'status' => 'open',
                'is_active' => true,
            ],
            [
                'name' => 'New Cairo - Waterway',
                'badge' => 'Garden Seating',
                'address' => 'Waterway Compound, 5th Settlement',
                'days_label' => 'Daily',
                'opening_time' => '07:30',
                'closing_time' => '01:00',
                'working_hours' => 'Daily: 07:30 AM - 01:00 AM',
                'phone' => '+20 19696 (Ext. 3)',
                'google_maps_url' => 'https://maps.google.com/?q=Waterway+New+Cairo',
                'status' => 'open',
                'is_active' => true,
            ],
        ];

        foreach ($locations as $loc) {
            StoreLocation::updateOrCreate(['name' => $loc['name']], $loc);
        }
    }
}
