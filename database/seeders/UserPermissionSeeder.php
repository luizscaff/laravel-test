<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserPermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    \DB::table('user_permissions')->insert([
      [
        'id_permission' => 1,
        'id_user'       => 3
      ],
      [
        'id_permission' => 2,
        'id_user'       => 3
      ],
      [
        'id_permission' => 3,
        'id_user'       => 3
      ],
      [
        'id_permission' => 1,
        'id_user'       => 4
      ],
      [
        'id_permission' => 3,
        'id_user'       => 4
      ],
    ]);
  }
}
