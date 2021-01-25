<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsNotSendsTable extends Migration
{
    
    public function up()
    {
        Schema::create('emails_not_sends', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tramite_id');
            $table->foreign('tramite_id')
                ->references('id')
                ->on('tramites')->onDelete('cascade');
            $table->string('destino');
            $table->text('mensaje');
            $table->string('asunto');
            $table->date('fecha');
            $table->time('hora');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('emails_not_sends');
    }
}
