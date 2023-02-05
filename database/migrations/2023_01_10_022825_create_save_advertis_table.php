<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaveAdvertisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('save_advertis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advertis_id')->constrained('advertis', 'id')->cascadeOnDelete();
            $table->foreignId('users_id')->constrained('user', 'id')->cascadeOnDelete();
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
        Schema::dropIfExists('save_advertis');
    }
}
