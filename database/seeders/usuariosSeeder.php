<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuarios;

class usuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		$var = new Usuarios();
        $var->nombre = 'root';
        $var->pass = 'Inf041';
        $var->img = 'default.jpg';
        $var->admin = 1;
    	$var->save();

    }
}
