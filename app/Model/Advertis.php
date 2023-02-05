<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertis extends Model
{
    use HasFactory;

    protected $casts = [
        'image' => 'json',
    ];

    protected $fillable = [
        'name', 'description', 'expected_salary', 'work_from_home', 'job_requires_vehicle',
        'Require_driver_license', 'gender', 'career_sector_id', 'job_title_id', 'advertise_type_id',
        'education_degree_id', 'type_contract_id', 'work_day_id', 'type_work_hour_id', 'salary_id',
        'experience_id', 'nationality_id', 'city_advertis_id', 'state_advertis_id','governorates_id', 'image', 'actor_type', 'actor_id',
    ];







    public function Benefits(){
        return $this->belongsToMany(
            ExtraBenefit::class,
            'advertis_extra_benefit',
            'advertis_id',
            'extra_benefit_id',
            'id',
            'id'
        );
    }

    public function Skills(){
        return $this->belongsToMany(
            Skill::class,
            'advertis_skill',
            'advertis_id',
            'skill_id',
            'id',
            'id'
        );
    }

    public function licenses(){
        return $this->belongsToMany(
            License::class,
            'advertis_license',
            'advertis_id',
            'license_id',
            'id',
            'id'
        );
    }

    public function Languages(){
        return $this->belongsToMany(
            Language::class,
            'advertis_language',
            'advertis_id',
            'language_id',
            'id',
            'id'
        );
    }
    public function translations()
    {
        return $this->morphMany('App\Model\Translation', 'translationable');
    }


    public function CareerSector(){
        return $this->belongsTo(CareerSector::class, 'career_sector_id', 'id')->withDefault();
    }


    public function JobTitle(){
        return $this->belongsTo(JobTitle::class, 'job_title_id', 'id')->withDefault();
    }

    public function advertiseType(){
        return $this->belongsTo(AdvertiseType::class, 'advertise_type_id', 'id')->withDefault();
    }


    public function educationDegree(){
        return $this->belongsTo(EducationDegree::class, 'education_degree_id', 'id')->withDefault();
    }

    public function typeContract(){
        return $this->belongsTo(TypeContract::class, 'type_contract_id', 'id')->withDefault();
    }

    public function workDays(){
        return $this->belongsTo(WorkDays::class, 'work_day_id', 'id')->withDefault();
    }

    public function typeWorkHours(){
        return $this->belongsTo(TypeWorkHour::class, 'type_work_hour_id', 'id')->withDefault();
    }

    public function salary(){
        return $this->belongsTo(Salary::class, 'salary_id', 'id')->withDefault();
    }

    public function experience(){
        return $this->belongsTo(Experience::class, 'experience_id', 'id')->withDefault();
    }

    public function nationality(){
        return $this->belongsTo(Nationality::class, 'nationality_id', 'id')->withDefault();
    }

    public function CityAdvertis(){
        return $this->belongsTo(CityAdvertis::class, 'city_advertis_id', 'id')->withDefault();
    }

    public function StateAdvertis(){
        return $this->belongsTo(StateAdvertis::class, 'state_advertis_id', 'id')->withDefault();
    }


    public function Governorate(){
        return $this->belongsTo(Governorate::class, 'governorates_id', 'id')->withDefault();
    }
    public function wish_list_advertis()
    {
        return $this->hasMany(SaveAdvertis::class, 'advertis_id');
    }




    // public function syncBenefits(array $benefits){
    //     $benefit_id = [];
    //     foreach($benefits as $benefits_name){
    //         $benefit = ExtraBenefit::firstOrCreate([
    //             'slug' => Str::slug($benefits_name),
    //         ],[
    //             'name' => trim($benefits_name),
    //         ]);

    //         $benefit_id[] = $benefit->id;
    //     }

    //     $this->tags()->sync($benefit_id);
    // }
}
