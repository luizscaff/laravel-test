<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    \DB::table('permissions')->insert([
      [
        'id_permission' => 1,
        'name'          => 'Cursos',
        'route'         => 'courses'
      ],
      [
        'id_permission' => 2,
        'name'          => 'Arquivos',
        'route'         => 'files'
      ],
      [
        'id_permission' => 3,
        'name'          => 'Categorias',
        'route'         => 'categories'
      ]
    ]);
  }
}
