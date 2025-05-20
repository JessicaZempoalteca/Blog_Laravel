<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 30)->nullable();
            $table->string('apellido_paterno', 30)->nullable();
            $table->string('apellido_materno', 30)->nullable();
            $table->string('nombre_usuario', 30)->unique();
            $table->string('email', 60)->unique();
            $table->string('password', 80)->nullable();
            $table->tinyInteger('estatus')->default('1');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
