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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('descripcion', 500);
            $table->string('como', 500);
            $table->string('archivo', 200);
            $table->integer('tipo');
            $table->string('img', 100);
            $table->integer('vista_prev');
            $table->unsignedBigInteger('id_usuarios');
            $table->foreign('id_usuarios')->references('id')->on('usuarios');   
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
        Schema::dropIfExists('proyectos');
    }
};
