<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_inner', 100)->nullable();
            $table->string('name', 100);
            $table->text('desc')->nullable();
            $table->string('brand', 100)->nullable();
            $table->string('country', 100)->nullable();
            $table->float('cost');
            $table->float('profit')->default(0);
            $table->float('discount')->default(0);
            $table->string('currency');
            $table->float('quantity');
            $table->string('item')->nullable();
            $table->integer('mark_id')->unsigned()->nullable();
            $table->integer('model_id')->unsigned()->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->string('img_path')->nullable();
            $table->string('slug', 255)->default('');
            $table->boolean('active')->default(true);

            $table->foreign('mark_id')
                ->references('id')
                ->on('marks')
                ->onUpdate('cascade');

            $table->foreign('model_id')
                ->references('id')
                ->on('models')
                ->onUpdate('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
};
