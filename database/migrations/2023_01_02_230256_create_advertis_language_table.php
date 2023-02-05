<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertis_language', function (Blueprint $table) {
            $table->foreignId('advertis_id')->constrained('advertis', 'id')->cascadeOnDelete();
            $table->foreignId('language_id')->constrained('languages', 'id')->cascadeOnDelete();
            $table->primary(['advertis_id', 'language_id']);
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
        Schema::dropIfExists('advertis_language');
    }
}
