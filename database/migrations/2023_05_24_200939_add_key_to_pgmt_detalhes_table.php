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
        Schema::table('pgmt_detalhes', function (Blueprint $table) {
            $table->foreign('forma_id')->references('id')->on('pgmt_formas');
            $table->foreign('bandeira_id')->references('id')->on('pgmt_bandeiras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pgmt_detalhes', function (Blueprint $table) {
            //
        });
    }
};
