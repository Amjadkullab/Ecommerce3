<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisExtraBenefitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertis_extra_benefit', function (Blueprint $table) {
            $table->foreignId('advertis_id')->constrained('advertis', 'id')->cascadeOnDelete();
            $table->foreignId('extra_benefit_id')->constrained('extra_benefits', 'id')->cascadeOnDelete();
            $table->primary(['advertis_id', 'extra_benefit_id']);
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
        Schema::dropIfExists('advertis_extra_benefit');
    }
}
