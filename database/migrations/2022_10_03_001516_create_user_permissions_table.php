<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('user_permissions', function (Blueprint $table) {
      $table->bigIncrements('id_user_permission');
      $table->bigInteger('id_permission')->unsigned();
      $table->bigInteger('id_user')->unsigned();

      $table->timestamps();

      $table->foreign('id_permission')->references('id_permission')->on('permissions');
      $table->foreign('id_user')->references('id')->on('users');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('user_permissions');
  }
};
