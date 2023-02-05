<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->json('image');
            $table->foreignId('career_sector_id')->constrained('career_sectors', 'id')->restrictOnDelete();
            $table->foreignId('job_title_id')->constrained('job_titles', 'id')->restrictOnDelete();
            $table->foreignId('advertise_type_id')->constrained('advertise_types', 'id')->restrictOnDelete();
            $table->foreignId('education_degree_id')->constrained('education_degrees', 'id')->restrictOnDelete();
            $table->foreignId('type_contract_id')->constrained('type_contracts', 'id')->restrictOnDelete();
            $table->foreignId('work_day_id')->constrained('work_days', 'id')->restrictOnDelete();
            $table->foreignId('type_work_hour_id')->constrained('type_work_hours', 'id')->restrictOnDelete();
            $table->foreignId('salary_id')->nullable()->constrained('salaries', 'id')->restrictOnDelete();
            $table->foreignId('experience_id')->constrained('experiences', 'id')->restrictOnDelete();
            $table->foreignId('nationality_id')->constrained('nationalities', 'id')->restrictOnDelete();
            $table->foreignId('city_advertis_id')->constrained('city_advertis', 'id')->restrictOnDelete();
            $table->foreignId('state_advertis_id')->constrained('state_advertis', 'id')->restrictOnDelete();
            $table->enum('work_from_home', ['Yes', 'No'])->default('No');
            $table->enum('job_requires_vehicle', ['Yes', 'No'])->default('No');
            $table->enum('Require_driver_license', ['Yes', 'No'])->default('No');
            $table->unsignedFloat('expected_salary')->nullable();
            $table->enum('gender', ['male','female']);
            $table->foreignId('governorates_id')->constrained('governorates', 'id')->restrictOnDelete();
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
        Schema::dropIfExists('advertis');
    }
}
