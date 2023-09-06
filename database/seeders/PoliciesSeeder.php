<?php

namespace Database\Seeders;

use App\Models\Policies;
use Illuminate\Database\Seeder;

class PoliciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Policies::factory()->count(100)->create();
    }
}
