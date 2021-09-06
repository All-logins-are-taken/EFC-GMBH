<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1, 2) as $number) {
            User::factory(1)->withPersonalTeam()->hasAttached(Team::factory(), ['role' => 'user'])->create([
                'name' => 'user_' . $number,
                'email' => 'user_' . $number . '@gmail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password_' . $number),
            ]);

//            User::factory()->count(1)->hasAttached(Team::factory()->count(1), ['role' => 'user'])->create([
//                'name' => 'user_' . $number,
//                'email' => 'user_' . $number . '@gmail.com',
//                'email_verified_at' => Carbon::now(),
//                'password' => Hash::make('password_' . $number),
//            ]);
        }
    }
}
