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
        Schema::create('current_currency', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('currency', ['USD', 'EUR']);
            $table->decimal('rate', 10, 4);
            $table->date('date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index(['currency', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('current_currency');
    }
};
