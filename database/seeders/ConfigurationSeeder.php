<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Configuration;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'is_able_to_register'=>1,
            'register_date' => Carbon::parse(Carbon::today()),
        ];
        Configuration::firstOrCreate($data);
    }
}
