<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisLicenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertis_license', function (Blueprint $table) {
            $table->foreignId('advertis_id')->constrained('advertis', 'id')->cascadeOnDelete();
            $table->foreignId('license_id')->constrained('licenses', 'id')->cascadeOnDelete();
            $table->primary(['advertis_id', 'license_id']);
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
        Schema::dropIfExists('advertis_license');
    }
}
