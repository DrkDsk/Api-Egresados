<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEgresadosTable extends Migration
{
    public function up()
    {
        Schema::create('egresados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')->onDelete('cascade');
            $table->string('name');
            $table->string('apellido1');
            $table->string('apellido2');
            $table->string('noControl');
            $table->string('movil');
            $table->string('telefono_casa')->nullable($value = true);
            $table->string('email_alternativo')->nullable($value = true);
            $table->string('carrera');
            $table->date('fechaIngreso');
            $table->date('fechaEgreso');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('egresados');
    }
}