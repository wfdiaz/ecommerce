<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Departament;
use Illuminate\Database\Seeder;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departament::factory(8)->create()->each(function(Departament $departament){
            City::factory(8)->create([
                'departament_id' => $departament->id
            ]);
        });
    }
}
