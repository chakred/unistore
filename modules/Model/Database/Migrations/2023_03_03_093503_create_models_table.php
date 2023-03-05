<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('models', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mark_id')->unsigned();
            $table->string('name_model');
            $table->integer('year')->nullable();
            $table->integer('last_year')->unsigned()->nullable();
            $table->string('engine', 100);
            $table->string('type_of_engine')->nullable();
            $table->string('transmission');
            $table->string('type_of_transmission')->nullable();
            $table->string('img_path')->nullable();
            $table->string('slug', 255)->default('');

            $table->foreign('mark_id')->references('id')->on('marks')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('models');
    }
};
