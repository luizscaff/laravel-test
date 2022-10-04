<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    \DB::table('users')->insert([
      [
        'id'       => 1,
        'name'     => 'Administrador',
        'email'    => 'admin@system',
        'is_admin' => true,
        'password' => \Hash::make('12345678')
      ],
      [
        'id'       => 2,
        'name'     => 'Usuário Sem Permissões',
        'email'    => 'user@nopermissions',
        'is_admin' => false,
        'password' => \Hash::make('12345678')
      ],
      [
        'id'       => 3,
        'name'     => 'Usuário Com Todas Permissões',
        'email'    => 'user@allpermissions',
        'is_admin' => false,
        'password' => \Hash::make('12345678')
      ],
      [
        'id'       => 4,
        'name'     => 'Usuário Com Algumas Permissões',
        'email'    => 'user@somepermissions',
        'is_admin' => false,
        'password' => \Hash::make('12345678')
      ]
    ]);
  }
}
