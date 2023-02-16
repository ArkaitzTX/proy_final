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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->string('texto', 250);

            $table->unsignedBigInteger('id_padre');
            $table->foreign('id_padre')->references('id')->on('comentarios'); 

            $table->unsignedBigInteger('id_usu');
            $table->foreign('id_usu')->references('id')->on('usuarios'); 

            $table->unsignedBigInteger('id_proy');
            $table->foreign('id_proy')->references('id')->on('proyectos');  

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
        Schema::dropIfExists('comentarios');
    }
};
