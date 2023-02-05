<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertis_skill', function (Blueprint $table) {
            $table->foreignId('advertis_id')->constrained('advertis', 'id')->cascadeOnDelete();
            $table->foreignId('skill_id')->constrained('skills', 'id')->cascadeOnDelete();
            $table->primary(['advertis_id', 'skill_id']);
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
        Schema::dropIfExists('advertis_skill');
    }
}
