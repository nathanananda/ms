<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $emails = DB::table('karyawan')->pluck('email_pribadi');
        $roles = ['kepsek', 'admin', 'user'];

        foreach ($emails as $email) {
            DB::table('users')->insert([
                'email' => $email,
                'password' => Hash::make('AdminSekolah'),
                'role' => Arr::random($roles),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ]);
        }
    }
}
