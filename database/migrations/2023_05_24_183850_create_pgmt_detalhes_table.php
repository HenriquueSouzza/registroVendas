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
        Schema::create('pgmt_detalhes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('forma_id');
            $table->unsignedBigInteger('bandeira_id')->nullable();
            $table->string('descricao');
            $table->char('debito_credito', 1)->nullable();
            $table->boolean('avista');
            $table->unsignedTinyInteger('parcela');
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
        Schema::dropIfExists('pgmt_detalhes');
    }
};
