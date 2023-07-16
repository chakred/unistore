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
            $table->string('name');
            $table->integer('year_start')->nullable();
            $table->integer('year_end')->unsigned()->nullable();
            $table->string('engine', 100);
            $table->string('engine_type')->nullable();
            $table->string('transmission');
            $table->string('transmission_type')->nullable();
            $table->string('img_path')->nullable();
            $table->string('slug', 255)->default('');
            $table->boolean('active')->default(true);

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
