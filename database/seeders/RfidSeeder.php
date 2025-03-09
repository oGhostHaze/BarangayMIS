<?php

namespace Database\Seeders;

use App\Models\Resident;
use Illuminate\Database\Seeder;

class RfidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get a few existing residents
        $residents = Resident::take(5)->get();

        // Assign random RFID numbers to them
        foreach ($residents as $index => $resident) {
            $resident->update([
                'rfid_number' => 'RFID' . str_pad($index + 1, 6, '0', STR_PAD_LEFT)
            ]);
        }

        $this->command->info('Added RFID numbers to ' . $residents->count() . ' residents.');
    }
}
