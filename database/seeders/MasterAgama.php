<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MasterAgama extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $agamas = [
            'Islam',
            'Kristen Protestan',
            'Katolik',
            'Hindu',
            'Buddha',
            'Konghucu'
        ];

        foreach ($agamas as $agama) {
            DB::table('master_agama')->insert([
                'id_agama' => Str::uuid(),
                'agama' => $agama,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
            ]);
        }
    }
}
