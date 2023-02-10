<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Advertis;
use Illuminate\Http\Request;

use App\Model\CityAdvertis;
use App\Model\AdvertiseType;
use App\Model\CareerSector;
use App\Model\EducationDegree;
use App\Model\Experience;
use App\Model\ExtraBenefit;
use App\Model\Governorate;
use App\Model\JobTitle;
use App\Model\Language;
use App\Model\License;
use App\Model\Nationality;
use App\Model\Salary;
use App\Model\Skill;
use App\Model\StateAdvertis;
use App\Model\Translation;
use App\Model\TypeContract;
use App\Model\TypeWorkHour;
use App\Model\WorkDays;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdvertiseController extends Controller
{
    //





    // ط§ظ„ط§ط¹ظ„ط§ظ†ط§طھ
    public function careerSector()
    {

        $CareerSector = CareerSector::latest()->get();
        return view('admin-views.Advertisement.careerSector', compact('CareerSector'));
    }

    //  ط§ط¶ط§ظپط© ط§ظ„ظ‚ط·ط§ط¹ ط§ظ„ظˆط¸ظٹظپظٹ
    public function AddCareerSector(Request $request)
    {
        // $request->validate([
        //     'name[]' => 'required',

        // ], [
        //     'name[].required' => \App\CPU\translate('Career_Sector_name_is_required!'),

        // ]);

        $CareerSector = new CareerSector();
        $CareerSector->name = $request->name[array_search('en', $request->lang)];
        $CareerSector->description = $request->description;
        $CareerSector->save();
        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                array_push($data, array(
                    'translationable_type' => 'App\Model\CareerSector',
                    'translationable_id' => $CareerSector->id,
                    'locale' => $key,
                    'key' => 'name',
                    'value' => $request->name[$index],
                ));
            }
        }

        if (count($data) > 0) {
            Translation::insert($data);
        }

        Toastr::success (\App\CPU\translate('Career_Sector_added_successfully!'));



        return redirect()->route('admin.careerSector');
    }



    public function EditCareerSector($id){

        $CareerSector = CareerSector::findOrFail($id);
        return view('admin-views.Advertisement.EditCareerSector', compact('CareerSector'));
    }

     //  طھط¹ط¯ظٹظ„ ط§ظ„ظ‚ط·ط§ط¹ ط§ظ„ظˆط¸ظٹظپظٹ
     public function updateCareerSector(Request $request, $id)
     {


         $request->validate([
             'name' => 'required',

         ], [
             'name.required' => 'Career Sector name is required!',
         ]);

         $CareerSector = CareerSector::findOrFail($id);
         $CareerSector->name = $request->name[array_search('en', $request->lang)];
         $CareerSector->description = $request->description;
         $CareerSector->save();
         $data = [];
         foreach ($request->lang as $index => $key) {
             if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\CareerSector',
                        'translationable_id' => $CareerSector->id,
                        'locale' => $key,
                        'key' => 'name'],
                    ['value' => $request->name[$index]]
                );
             }
         }


         Toastr::success(\App\CPU\translate(\App\CPU\translate('updated_successfully!')));

         return redirect('admin/Advertisement/careerSector');
     }


    public function jobTitle()
    {

        $CareerSector = CareerSector::all();
        $JobTitle = JobTitle::latest()->get();
        return view('admin-views.Advertisement.jobTitle', compact('CareerSector', 'JobTitle'));
    }



    //  // ط§ط¶ط§ظپط© ط§ظ„ظ…ط³ظ…ظ‰ ط§ظ„ظˆط¸ظٹظپظٹ
    public function AddJobTitle(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'career_sector_id' => 'required',
            //  'description' => 'required'
        ], [
            'name.required' =>\App\CPU\translate('job_title_name_is_required!')

            //  'description.required' => 'Career Sector description field is required!',
        ]);

        $JobTitle = new JobTitle();
        $JobTitle->name = $request->name[array_search('en', $request->lang)];
        $JobTitle->career_sector_id = $request->career_sector_id;
        $JobTitle->save();
        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                array_push($data, array(
                    'translationable_type' => 'App\Model\JobTitle',
                    'translationable_id' => $JobTitle->id,
                    'locale' => $key,
                    'key' => 'name',
                    'value' => $request->name[$index],
                ));
            }
        }

        if (count($data) > 0) {
            Translation::insert($data);
        }

        Toastr::success(\App\CPU\translate('job_Title_added_successfully!'));



        return redirect()->route('admin.jobTitle');
    }


    public function EditjobTitle($id){

        $JobTitle = JobTitle::findOrFail($id);
        $CareerSector = CareerSector::all();
        return view('admin-views.Advertisement.EditJobTitle', compact('JobTitle', 'CareerSector' ));
    }

     //  طھط¹ط¯ظٹظ„ ط§ظ„ظ‚ط·ط§ط¹ ط§ظ„ظˆط¸ظٹظپظٹ
     public function updatejobTitle(Request $request, $id)
     {


         $request->validate([
             'name' => 'required',

         ], [
             'name.required' => 'Career Sector name is required!',
         ]);

         $JobTitle = JobTitle::findOrFail($id);
         $JobTitle->name = $request->name[array_search('en', $request->lang)];
         $JobTitle->description = $request->description;
         $JobTitle->career_sector_id = $request->career_sector_id;
         $JobTitle->save();
         $data = [];
         foreach ($request->lang as $index => $key) {
             if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\JobTitle',
                        'translationable_id' => $JobTitle->id,
                        'locale' => $key,
                        'key' => 'name'],
                    ['value' => $request->name[$index]]
                );
             }
         }


         Toastr::success(\App\CPU\translate('updated_successfully!'));

         return redirect('admin/Advertisement/jobTitle');
     }





    public function advertiseType()
    {
        $advertisType = AdvertiseType::latest()->get();
        return view('admin-views.Advertisement.advertiseType', compact('advertisType'));
    }





    //  //ط§ط¶ط§ظپط© ظ†ظˆط¹ ط§ظ„ظ…ط¹ظ„ظ†
    public function AddAdvertiseType(Request $request)
    {

        $request->validate([
            'name' => 'required',
            //  'description' => 'required'
        ], [
            'name.required' => \App\CPU\translate('advertise_type_name_is_required!')
            //  'description.required' => 'Career Sector description field is required!',
        ]);

        $AdvertiseType = new AdvertiseType();
        $AdvertiseType->name = $request->name[array_search('en', $request->lang)];
        $AdvertiseType->description = $request->description;
        $AdvertiseType->save();
        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                array_push($data, array(
                    'translationable_type' => 'App\Model\AdvertiseType',
                    'translationable_id' => $AdvertiseType->id,
                    'locale' => $key,
                    'key' => 'name',
                    'value' => $request->name[$index],
                ));
            }
        }

        if (count($data) > 0) {
            Translation::insert($data);
        }

        Toastr::success(\App\CPU\translate('Advertise_Type_added_successfully!'));



        return redirect()->route('admin.advertiseType');
    }




    public function EditadvertiseType($id){

        $AdvertiseType = AdvertiseType::findOrFail($id);
        return view('admin-views.Advertisement.EditadvertiseType', compact('AdvertiseType'));
    }

     //  طھط¹ط¯ظٹظ„ ط§ظ„ظ‚ط·ط§ط¹ ط§ظ„ظˆط¸ظٹظپظٹ
     public function updateadvertiseType(Request $request, $id)
     {


         $request->validate([
             'name' => 'required',

         ], [
             'name.required' => 'Career Sector name is required!',
         ]);

         $AdvertiseType = AdvertiseType::findOrFail($id);
         $AdvertiseType->name = $request->name[array_search('en', $request->lang)];
         $AdvertiseType->description = $request->description;
         $AdvertiseType->save();
         $data = [];
         foreach ($request->lang as $index => $key) {
             if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\AdvertiseType',
                        'translationable_id' => $AdvertiseType->id,
                        'locale' => $key,
                        'key' => 'name'],
                    ['value' => $request->name[$index]]
                );
             }
         }


         Toastr::success(\App\CPU\translate('updated_successfully!'));

         return redirect('admin/Advertisement/advertiseType');
     }






    public function typeContract()
    {
        $TypeContract = TypeContract::latest()->get();
        return view('admin-views.Advertisement.typeContract', compact('TypeContract'));
    }

    public function AddTypeContract(Request $request)
    {

        $request->validate([
            'name' => 'required',
            //  'description' => 'required'
        ], [
            'name.required' => \App\CPU\translate('type_contract_name_is_required!')
            //  'description.required' => 'Career Sector description field is required!',
        ]);

        $TypeContract = new TypeContract();
        $TypeContract->name = $request->name[array_search('en', $request->lang)];
        $TypeContract->description = $request->description;
        $TypeContract->save();
        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                array_push($data, array(
                    'translationable_type' => 'App\Model\TypeContract',
                    'translationable_id' => $TypeContract->id,
                    'locale' => $key,
                    'key' => 'name',
                    'value' => $request->name[$index],
                ));
            }
        }

        if (count($data) > 0) {
            Translation::insert($data);
        }

        Toastr::success(\App\CPU\translate('type_Contract_Type_added_successfully!'));


        return redirect()->route('admin.typeContract');
    }




    public function EdittypeContract($id){

        $TypeContract = TypeContract::findOrFail($id);
        return view('admin-views.Advertisement.EditTypeContract', compact('TypeContract'));
    }

     //  طھط¹ط¯ظٹظ„ ط§ظ„ظ‚ط·ط§ط¹ ط§ظ„ظˆط¸ظٹظپظٹ
     public function updatetypeContract(Request $request, $id)
     {


         $request->validate([
             'name' => 'required',

         ], [
             'name.required' => 'Career Sector name is required!',
         ]);

         $TypeContract = TypeContract::findOrFail($id);
         $TypeContract->name = $request->name[array_search('en', $request->lang)];
         $TypeContract->description = $request->description;
         $TypeContract->save();
         $data = [];
         foreach ($request->lang as $index => $key) {
             if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\TypeContract',
                        'translationable_id' => $TypeContract->id,
                        'locale' => $key,
                        'key' => 'name'],
                    ['value' => $request->name[$index]]
                );
             }
         }


         Toastr::success(\App\CPU\translate('updated_successfully!'));

         return redirect('admin/Advertisement/typeContract');
     }









    public function workDay()
    {
        $workDays = WorkDays::latest()->get();
        return view('admin-views.Advertisement.workDay', compact('workDays'));
    }

    public function AddWorkDay(Request $request)
    {

        $request->validate([
            'workDays' => 'required',
            //  'description' => 'required'
        ], [
            'workDays.required' => \App\CPU\translate('work_day_name_is_required!')
            //  'description.required' => 'Career Sector description field is required!',
        ]);

        $WorkDays = new WorkDays();
        $WorkDays->workDays = $request->workDays[array_search('en', $request->lang)];
        $WorkDays->description = $request->description;
        $WorkDays->save();
        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($request->workDays[$index] && $key != 'en') {
                array_push($data, array(
                    'translationable_type' => 'App\Model\WorkDays',
                    'translationable_id' => $WorkDays->id,
                    'locale' => $key,
                    'key' => 'workDays',
                    'value' => $request->workDays[$index],
                ));
            }
        }

        if (count($data) > 0) {
            Translation::insert($data);
        }

        Toastr::success(\App\CPU\translate('Work_Days_Type_added_successfully!'));



        return redirect()->route('admin.workDay');
    }


    public function EditworkDay($id){

        $WorkDay = WorkDays::findOrFail($id);
        return view('admin-views.Advertisement.EditWorkDay', compact('WorkDay'));
    }

     //  طھط¹ط¯ظٹظ„ ط§ظ„ظ‚ط·ط§ط¹ ط§ظ„ظˆط¸ظٹظپظٹ
     public function updateworkDay(Request $request, $id)
     {


         $request->validate([
             'workDays' => 'required',

         ], [
             'workDays.required' => 'Career Sector name is required!',
         ]);

         $WorkDays = WorkDays::findOrFail($id);
         $WorkDays->workDays = $request->workDays[array_search('en', $request->lang)];
         $WorkDays->description = $request->description;
         $WorkDays->save();
         $data = [];
         foreach ($request->lang as $index => $key) {
             if ($request->workDays[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\WorkDays',
                        'translationable_id' => $WorkDays->id,
                        'locale' => $key,
                        'key' => 'workDays'],
                    ['value' => $request->workDays[$index]]
                );
             }
         }


         Toastr::success(\App\CPU\translate('updated_successfully!'));

         return redirect('admin/Advertisement/workDay');
     }







    public function typeWorkHour()
    {
        $typeWorkHour = TypeWorkHour::latest()->get();
        return view('admin-views.Advertisement.typeWorkHour', compact('typeWorkHour'));
    }

    public function AddTypeWorkHour(Request $request)
    {

        $request->validate([
            'name' => 'required',
            //  'description' => 'required'
        ], [
            'name.required' => \App\CPU\translate('Work_Hour_name_is_required!')
            //  'description.required' => 'Career Sector description field is required!',
        ]);

        $TypeWorkHour = new TypeWorkHour();
        $TypeWorkHour->name = $request->name[array_search('en', $request->lang)];
        $TypeWorkHour->description = $request->description;
        $TypeWorkHour->save();
        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                array_push($data, array(
                    'translationable_type' => 'App\Model\TypeWorkHour',
                    'translationable_id' => $TypeWorkHour->id,
                    'locale' => $key,
                    'key' => 'name',
                    'value' => $request->name[$index],
                ));
            }
        }

        if (count($data) > 0) {
            Translation::insert($data);
        }

        Toastr::success(\App\CPU\translate('type_Work_Hour_added_successfully!'));


        return redirect()->route('admin.typeWorkHour');
    }


    public function EdittypeWorkHour($id){

        $TypeWorkHour = TypeWorkHour::findOrFail($id);
        return view('admin-views.Advertisement.EditTypeWorkHour', compact('TypeWorkHour'));
    }

     //  طھط¹ط¯ظٹظ„ ط§ظ„ظ‚ط·ط§ط¹ ط§ظ„ظˆط¸ظٹظپظٹ
     public function updatetypeWorkHour(Request $request, $id)
     {


         $request->validate([
             'name' => 'required',

         ], [
             'name.required' => 'Career Sector name is required!',
         ]);

         $TypeWorkHour = TypeWorkHour::findOrFail($id);
         $TypeWorkHour->name = $request->name[array_search('en', $request->lang)];
         $TypeWorkHour->description = $request->description;
         $TypeWorkHour->save();
         $data = [];
         foreach ($request->lang as $index => $key) {
             if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\TypeWorkHour',
                        'translationable_id' => $TypeWorkHour->id,
                        'locale' => $key,
                        'key' => 'name'],
                    ['value' => $request->name[$index]]
                );
             }
         }


         Toastr::success(\App\CPU\translate('updated_successfully!'));

         return redirect('admin/Advertisement/typeWorkHour');
     }




    public function salary()
    {
        $salary = Salary::latest()->get();
        return view('admin-views.Advertisement.salary', compact('salary'));
    }

    public function Addsalary(Request $request)
    {

        $request->validate([
            'type' => 'required',
            //  'description' => 'required'
        ], [
            'type.required' =>\App\CPU\translate('add_salary_name_is_required!')
            //  'description.required' => 'Career Sector description field is required!',
        ]);

        $Salary = new Salary();
        $Salary->type = $request->type[array_search('en', $request->lang)];
        $Salary->description = $request->description;
        $Salary->save();
        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($request->type[$index] && $key != 'en') {
                array_push($data, array(
                    'translationable_type' => 'App\Model\Salary',
                    'translationable_id' => $Salary->id,
                    'locale' => $key,
                    'key' => 'type',
                    'value' => $request->type[$index],
                ));
            }
        }

        if (count($data) > 0) {
            Translation::insert($data);
        }

        Toastr::success( \App\CPU\translate('salary_Type_added_successfully!'));


        return redirect()->route('admin.salary');
    }


    public function Editsalary($id){

        $Salary = Salary::findOrFail($id);
        return view('admin-views.Advertisement.EditSalary', compact('Salary'));
    }

     //  طھط¹ط¯ظٹظ„ ط§ظ„ظ‚ط·ط§ط¹ ط§ظ„ظˆط¸ظٹظپظٹ
     public function updatesalary(Request $request, $id)
     {


         $request->validate([
             'type' => 'required',

         ], [
             'type.required' => 'Career Sector name is required!',
         ]);

         $Salary = Salary::findOrFail($id);
         $Salary->type = $request->type[array_search('en', $request->lang)];
         $Salary->description = $request->description;
         $Salary->save();
         $data = [];
         foreach ($request->lang as $index => $key) {
             if ($request->type[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\Salary',
                        'translationable_id' => $Salary->id,
                        'locale' => $key,
                        'key' => 'type'],
                    ['value' => $request->type[$index]]
                );
             }
         }


         Toastr::success(\App\CPU\translate('updated_successfully!'));

         return redirect('admin/Advertisement/salary');
     }




    public function ExtraBenefit()
    {

        $extraBenefit = ExtraBenefit::latest()->get();
        return view('admin-views.Advertisement.extraBenefit', compact('extraBenefit'));
    }

    public function AddExtraBenefit(Request $request)
    {

        $request->validate([
            'name' => 'required',
            //  'description' => 'required'
        ], [
            'name.required' =>\App\CPU\translate('Extra_Benefit_name_is_required!')
            //  'description.required' => 'Career Sector description field is required!',
        ]);

        $ExtraBenefit = new ExtraBenefit();
        $ExtraBenefit->name = $request->name[array_search('en', $request->lang)];
        $ExtraBenefit->description = $request->description;
        $ExtraBenefit->save();
        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                array_push($data, array(
                    'translationable_type' => 'App\Model\ExtraBenefit',
                    'translationable_id' => $ExtraBenefit->id,
                    'locale' => $key,
                    'key' => 'name',
                    'value' => $request->name[$index],
                ));
            }
        }

        if (count($data) > 0) {
            Translation::insert($data);
        }

        Toastr::success( \App\CPU\translate('Extra_Benefit_Type_added_successfully!'));


        return redirect()->route('admin.ExtraBenefit');
    }


    public function EditExtraBenefit($id){

        $ExtraBenefit = ExtraBenefit::findOrFail($id);
        return view('admin-views.Advertisement.EditExtraBenefit', compact('ExtraBenefit'));
    }

     //  طھط¹ط¯ظٹظ„ ط§ظ„ظ‚ط·ط§ط¹ ط§ظ„ظˆط¸ظٹظپظٹ
     public function updateExtraBenefit(Request $request, $id)
     {


         $request->validate([
             'name' => 'required',

         ], [
             'name.required' => 'Career Sector name is required!',
         ]);

         $ExtraBenefit = ExtraBenefit::findOrFail($id);
         $ExtraBenefit->name = $request->name[array_search('en', $request->lang)];
         $ExtraBenefit->description = $request->description;
         $ExtraBenefit->save();
         $data = [];
         foreach ($request->lang as $index => $key) {
             if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\ExtraBenefit',
                        'translationable_id' => $ExtraBenefit->id,
                        'locale' => $key,
                        'key' => 'name'],
                    ['value' => $request->name[$index]]
                );
             }
         }


         Toastr::success(\App\CPU\translate('updated_successfully!'));

         return redirect('admin/Advertisement/ExtraBenefit');
     }


    public function EducationDegree()
    {
        $educationDegree = EducationDegree::latest()->get();
        return view('admin-views.Advertisement.educationDegree', compact('educationDegree'));
    }

    public function AddEducationDegree(Request $request)
    {

        $request->validate([
            'name' => 'required',
            //  'description' => 'required'
        ], [
            'name.required' => \App\CPU\translate('Education_Degree_name_is_required!')
            //  'description.required' => 'Career Sector description field is required!',
        ]);

        $EducationDegree = new EducationDegree();
        $EducationDegree->name = $request->name[array_search('en', $request->lang)];
        $EducationDegree->description = $request->description;
        $EducationDegree->save();
        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                array_push($data, array(
                    'translationable_type' => 'App\Model\EducationDegree',
                    'translationable_id' => $EducationDegree->id,
                    'locale' => $key,
                    'key' => 'name',
                    'value' => $request->name[$index],
                ));
            }
        }

        if (count($data) > 0) {
            Translation::insert($data);
        }

        Toastr::success( \App\CPU\translate('Education_Degree_Type_added_successfully!'));


        return redirect()->route('admin.EducationDegree');
    }

    public function EditEducationDegree($id){

        $EducationDegree = EducationDegree::findOrFail($id);
        return view('admin-views.Advertisement.EditEducationDegree', compact('EducationDegree'));
    }

     //  طھط¹ط¯ظٹظ„ ط§ظ„ظ‚ط·ط§ط¹ ط§ظ„ظˆط¸ظٹظپظٹ
     public function updateEducationDegree(Request $request, $id)
     {


         $request->validate([
             'name' => 'required',

         ], [
             'name.required' => 'Career Sector name is required!',
         ]);

         $EducationDegree = EducationDegree::findOrFail($id);
         $EducationDegree->name = $request->name[array_search('en', $request->lang)];
         $EducationDegree->description = $request->description;
         $EducationDegree->save();
         $data = [];
         foreach ($request->lang as $index => $key) {
             if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\EducationDegree',
                        'translationable_id' => $EducationDegree->id,
                        'locale' => $key,
                        'key' => 'name'],
                    ['value' => $request->name[$index]]
                );
             }
         }


         Toastr::success(\App\CPU\translate('updated_successfully!'));

         return redirect('admin/Advertisement/EducationDegree');
     }

    public function Experience()
    {
        $experience = Experience::latest()->get();
        return view('admin-views.Advertisement.experience', compact('experience'));
    }

    public function AddExperience(Request $request)
    {

        $request->validate([
            'experiences_level' => 'required',
            //  'description' => 'required'
        ], [
            'experiences_level.required' => \App\CPU\translate('Add_Experiencer_name_is_required!')
            //  'description.required' => 'Career Sector description field is required!',
        ]);

        $Experience = new Experience();
        $Experience->experiences_level = $request->experiences_level[array_search('en', $request->lang)];
        $Experience->description = $request->description;
        $Experience->save();
        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($request->experiences_level[$index] && $key != 'en') {
                array_push($data, array(
                    'translationable_type' => 'App\Model\Experience',
                    'translationable_id' => $Experience->id,
                    'locale' => $key,
                    'key' => 'experiences_level',
                    'value' => $request->experiences_level[$index],
                ));
            }
        }

        if (count($data) > 0) {
            Translation::insert($data);
        }

        Toastr::success(\App\CPU\translate('Experience_level_added_successfully!'));



        return redirect()->route('admin.Experience');
    }


    public function EditExperience($id){

        $Experience = Experience::findOrFail($id);
        return view('admin-views.Advertisement.EditExperience', compact('Experience'));
    }

     //  طھط¹ط¯ظٹظ„ ط§ظ„ظ‚ط·ط§ط¹ ط§ظ„ظˆط¸ظٹظپظٹ
     public function updateExperience(Request $request, $id)
     {


         $request->validate([
             'experiences_level' => 'required',

         ], [
             'experiences_level.required' => 'Career Sector name is required!',
         ]);

         $Experience = Experience::findOrFail($id);
         $Experience->experiences_level = $request->experiences_level[array_search('en', $request->lang)];
         $Experience->description = $request->description;
         $Experience->save();
         $data = [];
         foreach ($request->lang as $index => $key) {
             if ($request->experiences_level[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\Experience',
                        'translationable_id' => $Experience->id,
                        'locale' => $key,
                        'key' => 'experiences_level'],
                    ['value' => $request->experiences_level[$index]]
                );
             }
         }


         Toastr::success(\App\CPU\translate('updated_successfully!'));

         return redirect('admin/Advertisement/Experience');
     }







    public function License()
    {
        $License = License::latest()->get();
        return view('admin-views.Advertisement.license', compact('License'));
    }

    public function AddLicense(Request $request)
    {

        $request->validate([
            'name' => 'required',
            //  'description' => 'required'
        ], [
            'name.required' => \App\CPU\translate('Add_License_name_is_required!')
        ]);

        $License = new License();
        $License->name = $request->name[array_search('en', $request->lang)];
        $License->description = $request->description;
        $License->save();
        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                array_push($data, array(
                    'translationable_type' => 'App\Model\License',
                    'translationable_id' => $License->id,
                    'locale' => $key,
                    'key' => 'name',
                    'value' => $request->name[$index],
                ));
            }
        }

        if (count($data) > 0) {
            Translation::insert($data);
        }

        Toastr::success(\App\CPU\translate('License_added_successfully!'));

        return redirect()->route('admin.License');
    }



    public function EditLicense($id){

        $License = License::findOrFail($id);
        return view('admin-views.Advertisement.EditLicense', compact('License'));
    }

     //  طھط¹ط¯ظٹظ„ ط§ظ„ظ‚ط·ط§ط¹ ط§ظ„ظˆط¸ظٹظپظٹ
     public function updateLicense(Request $request, $id)
     {


         $request->validate([
             'name' => 'required',

         ], [
             'name.required' => 'Career Sector name is required!',
         ]);

         $License = License::findOrFail($id);
         $License->name = $request->name[array_search('en', $request->lang)];
         $License->description = $request->description;
         $License->save();
         $data = [];
         foreach ($request->lang as $index => $key) {
             if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\License',
                        'translationable_id' => $License->id,
                        'locale' => $key,
                        'key' => 'name'],
                    ['value' => $request->name[$index]]
                );
             }
         }


         Toastr::success(\App\CPU\translate('updated_successfully!'));

         return redirect('admin/Advertisement/License');
     }


    public function Language()
    {
        $langg = Language::latest()->get();
        return view('admin-views.Advertisement.language', compact('langg'));
    }

    public function AddLanguage(Request $request)
    {

        $request->validate([
            'name' => 'required',
            //  'description' => 'required'
        ], [
            'name.required' =>\App\CPU\translate('Add_language_is_required!')
                        //  'description.required' => 'Career Sector description field is required!',
        ]);

        $Language = new Language();
        $Language->name = $request->name[array_search('en', $request->lang)];
        $Language->description = $request->description;
        $Language->save();
        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                array_push($data, array(
                    'translationable_type' => 'App\Model\Language',
                    'translationable_id' => $Language->id,
                    'locale' => $key,
                    'key' => 'name',
                    'value' => $request->name[$index],
                ));
            }
        }

        if (count($data) > 0) {
            Translation::insert($data);
        }

        Toastr::success(\App\CPU\translate('Language_added_successfully!'));

        return redirect()->route('admin.Language');
    }


    public function EditLanguage($id){

        $Language = Language::findOrFail($id);
        return view('admin-views.Advertisement.EditLanguage', compact('Language'));
    }

     //  طھط¹ط¯ظٹظ„ ط§ظ„ظ‚ط·ط§ط¹ ط§ظ„ظˆط¸ظٹظپظٹ
     public function updateLanguage(Request $request, $id)
     {


         $request->validate([
             'name' => 'required',

         ], [
             'name.required' => 'Career Sector name is required!',
         ]);

         $Language = Language::findOrFail($id);
         $Language->name = $request->name[array_search('en', $request->lang)];
         $Language->description = $request->description;
         $Language->save();
         $data = [];
         foreach ($request->lang as $index => $key) {
             if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\Language',
                        'translationable_id' => $Language->id,
                        'locale' => $key,
                        'key' => 'name'],
                    ['value' => $request->name[$index]]
                );
             }
         }


         Toastr::success(\App\CPU\translate('updated_successfully!'));

         return redirect('admin/Advertisement/Language');
     }





    public function Nationality()
    {
        $Nationality = Nationality::latest()->get();
        return view('admin-views.Advertisement.nationality', compact('Nationality'));
    }

    public function AddNationality(Request $request)
    {

        $request->validate([
            'name' => 'required',
            //  'description' => 'required'
        ], [
            'name.required' => \App\CPU\translate('Add_Nationality_name_is_required!')
            //  'description.required' => 'Career Sector description field is required!',
        ]);

        $Nationality = new Nationality();
        $Nationality->name = $request->name[array_search('en', $request->lang)];
        $Nationality->description = $request->description;
        $Nationality->save();
        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                array_push($data, array(
                    'translationable_type' => 'App\Model\Nationality',
                    'translationable_id' => $Nationality->id,
                    'locale' => $key,
                    'key' => 'name',
                    'value' => $request->name[$index],
                ));
            }
        }

        if (count($data) > 0) {
            Translation::insert($data);
        }

        Toastr::success( \App\CPU\translate('Nationality_added_successfully!'));

        return redirect()->route('admin.Nationality');
    }

    public function EditNationality($id){

        $Nationality = Nationality::findOrFail($id);
        return view('admin-views.Advertisement.EditNationality', compact('Nationality'));
    }

     //  طھط¹ط¯ظٹظ„ ط§ظ„ظ‚ط·ط§ط¹ ط§ظ„ظˆط¸ظٹظپظٹ
     public function updateNationality(Request $request, $id)
     {


         $request->validate([
             'name' => 'required',

         ], [
             'name.required' => 'Career Sector name is required!',
         ]);

         $Nationality = Nationality::findOrFail($id);
         $Nationality->name = $request->name[array_search('en', $request->lang)];
         $Nationality->description = $request->description;
         $Nationality->save();
         $data = [];
         foreach ($request->lang as $index => $key) {
             if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\Nationality',
                        'translationable_id' => $Nationality->id,
                        'locale' => $key,
                        'key' => 'name'],
                    ['value' => $request->name[$index]]
                );
             }
         }


         Toastr::success(\App\CPU\translate('updated_successfully!'));

         return redirect('admin/Advertisement/Nationality');
     }


    public function Skill()
    {
        $Skill = Skill::latest()->geT();
        return view('admin-views.Advertisement.Skill', compact('Skill'));
    }

    public function AddSkill(Request $request)
    {

        $request->validate([
            'name' => 'required',
            //  'description' => 'required'
        ], [
            'name.required' => \App\CPU\translate('Add_Skill_name_is_required!')
            //  'description.required' => 'Career Sector description field is required!',
        ]);

        $Skill = new Skill();
        $Skill->name = $request->name[array_search('en', $request->lang)];
        $Skill->description = $request->description;
        $Skill->save();
        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                array_push($data, array(
                    'translationable_type' => 'App\Model\Skill',
                    'translationable_id' => $Skill->id,
                    'locale' => $key,
                    'key' => 'name',
                    'value' => $request->name[$index],
                ));
            }
        }

        if (count($data) > 0) {
            Translation::insert($data);
        }

        Toastr::success( \App\CPU\translate('Skill_added_successfully!'));

        return redirect()->route('admin.Skill');
    }


    public function EditSkill($id){

        $Skill = Skill::findOrFail($id);
        return view('admin-views.Advertisement.EditSkill', compact('Skill'));
    }

     //  طھط¹ط¯ظٹظ„ ط§ظ„ظ‚ط·ط§ط¹ ط§ظ„ظˆط¸ظٹظپظٹ
     public function updateSkill(Request $request, $id)
     {


         $request->validate([
             'name' => 'required',

         ], [
             'name.required' => 'Career Sector name is required!',
         ]);

         $Skill = Skill::findOrFail($id);
         $Skill->name = $request->name[array_search('en', $request->lang)];
         $Skill->description = $request->description;
         $Skill->save();
         $data = [];
         foreach ($request->lang as $index => $key) {
             if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\Skill',
                        'translationable_id' => $Skill->id,
                        'locale' => $key,
                        'key' => 'name'],
                    ['value' => $request->name[$index]]
                );
             }
         }


         Toastr::success(\App\CPU\translate('updated_successfully!'));

         return redirect('admin/Advertisement/Skill');
     }




    public function CityAdvertis()
    {
        $CityAdvertis = CityAdvertis::latest()->get();
        $stateAdvertis = StateAdvertis::all();
        return view('admin-views.Advertisement.CityAdvertis', compact('CityAdvertis', 'stateAdvertis'));
    }


    public function AddCityAdvertis(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'state_advertis_id' => 'required',
            //  'description' => 'required'
        ], [
            'name.required' =>  \App\CPU\translate('Add_City_name_is_required!')
                        //  'description.required' => 'Career Sector description field is required!',
        ]);

        $CityAdvertis = new CityAdvertis();
        $CityAdvertis->name = $request->name[array_search('en', $request->lang)];
        $CityAdvertis->description = $request->description;
        $CityAdvertis->state_advertis_id = $request->state_advertis_id;
        $CityAdvertis->save();
        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                array_push($data, array(
                    'translationable_type' => 'App\Model\CityAdvertis',
                    'translationable_id' => $CityAdvertis->id,
                    'locale' => $key,
                    'key' => 'name',
                    'value' => $request->name[$index],
                ));
            }
        }

        if (count($data) > 0) {
            Translation::insert($data);
        }

        Toastr::success( \App\CPU\translate('City_Advertis_added_successfully!'));

        return redirect()->route('admin.CityAdvertis');
    }



    public function EditCityAdvertis($id){

        $CityAdvertis = CityAdvertis::findOrFail($id);
        $stateAdvertis =StateAdvertis::all();
        return view('admin-views.Advertisement.EditCityAdvertis', compact('CityAdvertis', 'stateAdvertis'));
    }

     //  طھط¹ط¯ظٹظ„ ط§ظ„ظ‚ط·ط§ط¹ ط§ظ„ظˆط¸ظٹظپظٹ
     public function updateCityAdvertis(Request $request, $id)
     {


         $request->validate([
             'name' => 'required',
             'state_advertis_id' => 'required'

         ], [
             'name.required' => 'Career Sector name is required!',
         ]);

         $CityAdvertis = CityAdvertis::findOrFail($id);
         $CityAdvertis->name = $request->name[array_search('en', $request->lang)];
         $CityAdvertis->description = $request->description;
         $CityAdvertis->state_advertis_id = $request->state_advertis_id;
         $CityAdvertis->save();
         $data = [];
         foreach ($request->lang as $index => $key) {
             if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\CityAdvertis',
                        'translationable_id' => $CityAdvertis->id,
                        'locale' => $key,
                        'key' => 'name'],
                    ['value' => $request->name[$index]]
                );
             }
         }


         Toastr::success(\App\CPU\translate('updated_successfully!'));

         return redirect('admin/Advertisement/CityAdvertis');
     }








    public function governorate()
    {
        $Governorate = Governorate::latest()->get();
        $CityAdvertis = CityAdvertis::all();
        return view('admin-views.Advertisement.Governorate', compact('Governorate', 'CityAdvertis'));
    }



    public function Addgovernorate(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'city_advertis_id' => 'required'
            //  'description' => 'required'
        ], [
            'name.required' => 'Career Sector name is required!',
            //  'description.required' => 'Career Sector description field is required!',
        ]);

        $Governorate = new Governorate();
        $Governorate->name = $request->name[array_search('en', $request->lang)];
        $Governorate->description = $request->description;
        $Governorate->city_advertis_id = $request->city_advertis_id;
        $Governorate->save();
        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                array_push($data, array(
                    'translationable_type' => 'App\Model\Governorate',
                    'translationable_id' => $Governorate->id,
                    'locale' => $key,
                    'key' => 'name',
                    'value' => $request->name[$index],
                ));
            }
        }

        if (count($data) > 0) {
            Translation::insert($data);
        }

        Toastr::success('Governorate added successfully!');


        return redirect()->route('admin.governorate');
    }



    public function Editgovernorate($id){

        $governorate = Governorate::findOrFail($id);
        $CityAdvertis = CityAdvertis::all();
        return view('admin-views.Advertisement.EditGovernorate', compact('governorate', 'CityAdvertis'));
    }

     //  طھط¹ط¯ظٹظ„ ط§ظ„ظ‚ط·ط§ط¹ ط§ظ„ظˆط¸ظٹظپظٹ
     public function updategovernorate(Request $request, $id)
     {


         $request->validate([
             'name' => 'required',
             'city_advertis_id' => 'required'

         ], [
             'name.required' => 'Career Sector name is required!',
         ]);

         $Governorate = Governorate::findOrFail($id);
         $Governorate->name = $request->name[array_search('en', $request->lang)];
         $Governorate->description = $request->description;
         $Governorate->city_advertis_id = $request->city_advertis_id;
         $Governorate->save();
         $data = [];
         foreach ($request->lang as $index => $key) {
             if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\Governorate',
                        'translationable_id' => $Governorate->id,
                        'locale' => $key,
                        'key' => 'name'],
                    ['value' => $request->name[$index]]
                );
             }
         }


         Toastr::success(\App\CPU\translate('updated_successfully!'));

         return redirect('admin/Advertisement/governorate');
     }











     public function stateAdvertis()
     {
         $stateAdvertis = StateAdvertis::latest()->get();
         return view('admin-views.Advertisement.stateAdvertis', compact('stateAdvertis'));
     }



     public function AddstateAdvertis(Request $request)
     {

         $request->validate([
             'name' => 'required',
             //  'description' => 'required'
         ], [
            'name.required' =>\App\CPU\translate('Add_state_name_is_required!')
                         //  'description.required' => 'Career Sector description field is required!',
         ]);

         $StateAdvertis = new StateAdvertis();
         $StateAdvertis->name = $request->name[array_search('en', $request->lang)];
         $StateAdvertis->description = $request->description;
         $StateAdvertis->save();
         $data = [];
         foreach ($request->lang as $index => $key) {
             if ($request->name[$index] && $key != 'en') {
                 array_push($data, array(
                     'translationable_type' => 'App\Model\StateAdvertis',
                     'translationable_id' => $StateAdvertis->id,
                     'locale' => $key,
                     'key' => 'name',
                     'value' => $request->name[$index],
                 ));
             }
         }

         if (count($data) > 0) {
             Translation::insert($data);
         }

         Toastr::success(\App\CPU\translate('state_Advertis_added_successfully!'));

         return redirect()->route('admin.stateAdvertis');
     }



     public function EditstateAdvertis($id){

         $StateAdvertis = StateAdvertis::findOrFail($id);
         return view('admin-views.Advertisement.EditStateAdvertis', compact('StateAdvertis'));
     }

      //  طھط¹ط¯ظٹظ„ ط§ظ„ظ‚ط·ط§ط¹ ط§ظ„ظˆط¸ظٹظپظٹ
      public function updatestateAdvertis(Request $request, $id)
      {


          $request->validate([
              'name' => 'required',

          ], [
              'name.required' => 'Career Sector name is required!',
          ]);

          $StateAdvertis = StateAdvertis::findOrFail($id);
          $StateAdvertis->name = $request->name[array_search('en', $request->lang)];
          $StateAdvertis->description = $request->description;
          $StateAdvertis->save();
          $data = [];
          foreach ($request->lang as $index => $key) {
              if ($request->name[$index] && $key != 'en') {
                 Translation::updateOrInsert(
                     ['translationable_type' => 'App\Model\StateAdvertis',
                         'translationable_id' => $StateAdvertis->id,
                         'locale' => $key,
                         'key' => 'name'],
                     ['value' => $request->name[$index]]
                 );
              }
          }


          Toastr::success(\App\CPU\translate('updated_successfully!'));

          return redirect('admin/Advertisement/stateAdvertis');
      }




















    //   for admin
    public function desblayAdvertisement(){
        $Advertis = Advertis::with('Benefits', 'Skills', 'licenses', 'Languages', 'CareerSector', 'JobTitle', 'advertiseType',
         'educationDegree', 'typeContract', 'workDays', 'typeWorkHours', 'salary',  'experience', 'nationality', 'CityAdvertis',
          'StateAdvertis')->where('actor_type', 'App\Model\Admin')->get();

        return view('admin-views.Advertisement.desblady', [
            'CareerSector' => CareerSector::select('id', 'name')->get(),
            'JobTitle' => JobTitle::select('id', 'name')->get(),
            'stateAdvertis' => StateAdvertis::select('id', 'name')->get(),
            'CityAdvertis' => CityAdvertis::select('id', 'name')->get(),
            'Advertis' => $Advertis,
        ]);
    }

    // for customer
    public function desblayAdvertisementCustomer(){
        $Advertis = Advertis::with('Benefits', 'Skills', 'licenses', 'Languages', 'CareerSector', 'JobTitle', 'advertiseType',
         'educationDegree', 'typeContract', 'workDays', 'typeWorkHours', 'salary',  'experience', 'nationality', 'CityAdvertis',
          'StateAdvertis')->where('actor_type', 'App\Model\User')->get();

        return view('admin-views.Advertisement.desbladyCustomer', [
            'CareerSector' => CareerSector::select('id', 'name')->get(),
            'JobTitle' => JobTitle::select('id', 'name')->get(),
            'stateAdvertis' => StateAdvertis::select('id', 'name')->get(),
            'CityAdvertis' => CityAdvertis::select('id', 'name')->get(),
            'Advertis' => $Advertis,
        ]);
    }

    public function AddAdvertisement()
    {


        return view('admin-views.Advertisement.advertisement', [
            'CareerSector' => CareerSector::all(),
            'jobTitle' => JobTitle::all(),
            'AdvertiserType' => AdvertiseType::all(),
            'TypeOfContract' => TypeContract::all(),
            'numberWorkingDay' => WorkDays::all(),
            'workHour' => TypeWorkHour::all(),
            'expectedSalary' => Salary::all(),
            'ExtraBenefit' => ExtraBenefit::all(),
            'educationDegree' => EducationDegree::all(),
            'ExperienceLevel' => Experience::all(),
            'Nationality' => Nationality::all(),
            'license' => License::all(),
            'langg' => Language::all(),
            'skill' => Skill::all(),
            'city_advertis' => CityAdvertis::all(),
            'state_advertis' => StateAdvertis::all(),
            'governorate' => Governorate::all(),
        ]);
    }



    public function statusAdvertisement(Request $request){
        $Advertis = Advertis::findOrFail($request->id);
        $Advertis->status = ($Advertis['status'] == 'InActive') ? 'Active' : 'InActive';
        $Advertis->save();
        $data = $request->status;
        return response()->json($data);
    }

    // for admin
    public function fillterAdvertisement(Request $request){


        if(!$request->state_advertis == null && !$request->city_advertis == null && $request->career_sector == null && $request->job_title == null){

                $Advertis = Advertis::where('state_advertis_id', $request->state_advertis)->where('city_advertis_id', $request->city_advertis)
                ->where('actor_type', 'App\Model\Admin')->get();
        }

        if(!$request->career_sector == null && !$request->job_title == null && $request->state_advertis == null && $request->city_advertis == null){

                $Advertis = Advertis::where('career_sector_id', $request->career_sector)->where('job_title_id', $request->job_title)
                ->where('actor_type', 'App\Model\Admin')->get();

        }

        if(!$request->career_sector == null && !$request->job_title == null && !$request->state_advertis == null && !$request->city_advertis == null){

            $Advertis = Advertis::where('career_sector_id', $request->career_sector)->where('job_title_id', $request->job_title)
            ->where('state_advertis_id', $request->state_advertis)->where('city_advertis_id', $request->city_advertis)
            ->where('actor_type', 'App\Model\Admin')->get();

        }

        return view('admin-views.Advertisement.desblady', compact('Advertis'), [
            'CareerSector' => CareerSector::select('id', 'name')->get(),
            'JobTitle' => JobTitle::select('id', 'name')->get(),
            'stateAdvertis' => StateAdvertis::select('id', 'name')->get(),
            'governorate' => Governorate::select('id', 'name')->get(),
        ]);






    }


    // for admin
    public function fillterAdvertisementCustomer(Request $request){


        if(!$request->state_advertis == null && !$request->city_advertis == null && $request->career_sector == null && $request->job_title == null){

                $Advertis = Advertis::where('state_advertis_id', $request->state_advertis)->where('city_advertis_id', $request->city_advertis)
                ->where('actor_type', 'App\Model\User')->get();
        }

        if(!$request->career_sector == null && !$request->job_title == null && $request->state_advertis == null && $request->city_advertis == null){

                $Advertis = Advertis::where('career_sector_id', $request->career_sector)->where('job_title_id', $request->job_title)
                ->where('actor_type', 'App\Model\User')->get();

        }

        if(!$request->career_sector == null && !$request->job_title == null && !$request->state_advertis == null && !$request->city_advertis == null){

            $Advertis = Advertis::where('career_sector_id', $request->career_sector)->where('job_title_id', $request->job_title)
            ->where('state_advertis_id', $request->state_advertis)->where('city_advertis_id', $request->city_advertis)
            ->where('actor_type', 'App\Model\User')->get();

        }

        return view('admin-views.Advertisement.desbladyCustomer', compact('Advertis'), [
            'CareerSector' => CareerSector::select('id', 'name')->get(),
            'JobTitle' => JobTitle::select('id', 'name')->get(),
            'stateAdvertis' => StateAdvertis::select('id', 'name')->get(),
            'governorate' => Governorate::select('id', 'name')->get(),
        ]);






    }



    public function storeAdvertisement(Request $request)
    {

        // dd($request->ExtraBenefit);
        $request->validate([
            // 'name' => 'required',
            //  'description' => 'required'
        ], [
            // 'name.required' => 'Career Sector name is required!',
            //  'description.required' => 'Career Sector description field is required!',
        ]);





        $img = $this->uploadAttachments($request);

        $user = auth('admin')->user()->id;
        // dd($user);
        $actorType = 'App\Model\Admin';
        $Advertis = Advertis::create([
            'name' => $request->name[array_search('en', $request->lang)],
            'description' => $request->description[array_search('en', $request->lang)],
            'expected_salary' => $request->expected_salary,
            'work_from_home' => $request->work_from_home,
            'job_requires_vehicle' => $request->job_requires_vehicle,
            'Require_driver_license' => $request->Require_driver_license,
            'gender' => $request->gender,
            'career_sector_id' => $request->career_sector_id,
            'job_title_id' => $request->job_title_id,
            'advertise_type_id' => $request->advertise_type_id,
            'education_degree_id' => $request->education_degree_id,
            'type_contract_id' => $request->type_contract_id,
            'work_day_id' => $request->work_day_id,
            'type_work_hour_id' => $request->type_work_hour_id,
            'salary_id' => $request->salary_id,
            'experience_id' => $request->experience_id,
            'nationality_id' => $request->nationality_id,
            'city_advertis_id' => $request->city_advertis_id,
            'state_advertis_id' => $request->state_advertis_id,
            'governorates_id' => $request->governorates_id,
            'image' => $img,
            'actor_type' => $actorType,
            'actor_id' => $user,
        ]);


        // dd($user);


        $benefits = $request->ExtraBenefit;
        $Advertis->Benefits()->sync($benefits);

        $licenses = $request->license;
        $Advertis->licenses()->sync($licenses);

        $languagesSelect = $request->langg;
        $Advertis->Languages()->sync($languagesSelect);

        $skillSelect = $request->skill;
        $Advertis->Skills()->sync($skillSelect);

        $Advertis->save();
        $dataName = [];
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                array_push($dataName, array(
                    'translationable_type' => 'App\Model\Advertis',
                    'translationable_id' => $Advertis->id,
                    'locale' => $key,
                    'key' => 'name',
                    'value' => $request->name[$index],
                ));
            }
        }
        if (count($dataName) > 0) {
            Translation::insert($dataName);
        }

        $dataDescription = [];
        foreach ($request->lang as $index => $key) {
            if ($request->description[$index] && $key != 'en') {
                array_push($dataDescription, array(
                    'translationable_type' => 'App\Model\Advertis',
                    'translationable_id' => $Advertis->id,
                    'locale' => $key,
                    'key' => 'description',
                    'value' => $request->description[$index],
                ));
            }
        }

        if (count($dataDescription) > 0) {
            Translation::insert($dataDescription);
        }

        Toastr::success(\App\CPU\translate('Advertis_added_successfully!'));

        return redirect('admin/desblayAdvertisement/AddAdvertisement');
    }



    public function EditAdvertisement($id){

        $Advertis = Advertis::findOrFail($id);
        // $lan = $Advertis->Languages;
            // $con = [];


            // dd($con);
            // dd($Advertis->Languages()->get());

            return view('admin-views.Advertisement.EditAdvertis', compact('Advertis'), [
            'CareerSector' => CareerSector::all(),
            'jobTitle' => JobTitle::all(),
            'AdvertiserType' => AdvertiseType::all(),
            'TypeOfContract' => TypeContract::all(),
            'numberWorkingDay' => WorkDays::all(),
            'workHour' => TypeWorkHour::all(),
            'expectedSalary' => Salary::all(),
            'ExtraBenefit' => ExtraBenefit::all(),
            'educationDegree' => EducationDegree::all(),
            'ExperienceLevel' => Experience::all(),
            'Nationality' => Nationality::all(),
            'license' => License::all(),
            'langg' => Language::all(),
            'skill' => Skill::all(),
            'city_advertis' => CityAdvertis::all(),
            'state_advertis' => StateAdvertis::all(),
            'governorate' => Governorate::all(),
        ]);
    }

     //  طھط¹ط¯ظٹظ„ ط§ظ„ظ‚ط·ط§ط¹ ط§ظ„ظˆط¸ظٹظپظٹ
     public function updateAdvertisement(Request $request, $id)
     {


         $request->validate([
             'name' => 'required',

         ], [
             'name.required' => 'Career Sector name is required!',
         ]);

         $Advertis = Advertis::findOrFail($id);

         $data = $request->except('image', 'name', 'description');

         if(!$request->image == null){

             $data['image'] = array_merge(($Advertis->image ?? []), $this->uploadAttachments($request));
        }
        $data['name'] = $request->name[array_search('en', $request->lang)];
        $data['description'] = $request->description[array_search('en', $request->lang)];
        $Advertis->update($data);


         $benefits = $request->ExtraBenefit;
         $Advertis->Benefits()->sync($benefits);

         $licenses = $request->license;
         $Advertis->licenses()->sync($licenses);

         $languagesSelect = $request->langg;
         $Advertis->Languages()->sync($languagesSelect);

         $skillSelect = $request->skill;
         $Advertis->Skills()->sync($skillSelect);

         $Advertis->save();

         foreach ($request->lang as $index => $key) {
             if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\Advertis',
                        'translationable_id' => $Advertis->id,
                        'locale' => $key,
                        'key' => 'name'],
                    ['value' => $request->name[$index]]
                );
             }



             if ($request->description[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\Advertis',
                        'translationable_id' => $Advertis->id,
                        'locale' => $key,
                        'key' => 'description'],
                    ['value' => $request->description[$index]]
                );
             }

         }


         Toastr::success(\App\CPU\translate('updated_successfully!'));

         return back();
     }












    public function deleteCareerSector(Request $request){

        $Isdeleted = CareerSector::where('id', $request->id)->first();
        if( $Isdeleted->Advertis()->first() == null && $Isdeleted->jobtitles()->first() == null){
        $translation = Translation::where('translationable_type','App\Model\CareerSector')
                                    ->where('translationable_id', $request->id);
        $translation->delete();
        CareerSector::destroy($request->id);

        return Toastr::success (\App\CPU\translate('deleted_Successfully_'));


    }else{
        return Toastr::success (\App\CPU\translate('You_cant_delete'));
    }

    }

    public function deletejobTitle(Request $request){

        $Isdeleted = JobTitle::where('id', $request->id)->first();
        if( $Isdeleted->Advertis()->first() == null){
        $translation = Translation::where('translationable_type','App\Model\JobTitle')
                                    ->where('translationable_id', $request->id);
        $translation->delete();
        JobTitle::destroy($request->id);
        return Toastr::success (\App\CPU\translate('deleted_Successfully_'));


    }else{
        return Toastr::success (\App\CPU\translate('You_cant_delete'));
    }

    }

    public function deleteadvertiseType(Request $request){

        $Isdeleted = AdvertiseType::where('id', $request->id)->first();
        if( $Isdeleted->Advertis()->first() == null){
        $translation = Translation::where('translationable_type','App\Model\AdvertiseType')
                                    ->where('translationable_id', $request->id);
        $translation->delete();
        AdvertiseType::destroy($request->id);
        return Toastr::success (\App\CPU\translate('deleted_Successfully_'));


    }else{
        return Toastr::success (\App\CPU\translate('You_cant_delete'));
    }

    }

    public function deletetypeContract(Request $request){

        $Isdeleted = TypeContract::where('id', $request->id)->first();
        if( $Isdeleted->Advertis()->first() == null){

        $translation = Translation::where('translationable_type','App\Model\TypeContract')
                                    ->where('translationable_id', $request->id);
        $translation->delete();
        TypeContract::destroy($request->id);
        return Toastr::success (\App\CPU\translate('deleted_Successfully_'));


    }else{
        return Toastr::success (\App\CPU\translate('You_cant_delete'));
    }

    }

    public function deleteworkDay(Request $request){

        $Isdeleted = WorkDays::where('id', $request->id)->first();
        if( $Isdeleted->Advertis()->first() == null){

        $translation = Translation::where('translationable_type','App\Model\WorkDays')
                                    ->where('translationable_id', $request->id);
        $translation->delete();
        WorkDays::destroy($request->id);
        return Toastr::success (\App\CPU\translate('deleted_Successfully_'));


    }else{
        return Toastr::success (\App\CPU\translate('You_cant_delete'));
    }

    }

    public function deletesalary(Request $request){

        $Isdeleted = Salary::where('id', $request->id)->first();
        if( $Isdeleted->Advertis()->first() == null){
        $translation = Translation::where('translationable_type','App\Model\Salary')
                                    ->where('translationable_id', $request->id);
        $translation->delete();
        Salary::destroy($request->id);

        return Toastr::success (\App\CPU\translate('deleted_Successfully_'));


    }else{
        return Toastr::success (\App\CPU\translate('You_cant_delete'));
    }

    }

    public function deleteExtraBenefit(Request $request){


        $translation = Translation::where('translationable_type','App\Model\ExtraBenefit')
                                    ->where('translationable_id', $request->id);
        $translation->delete();
        ExtraBenefit::destroy($request->id);

        return response()->json();

    }

    public function deleteEducationDegree(Request $request){

        $Isdeleted = EducationDegree::where('id', $request->id)->first();
        if( $Isdeleted->Advertis()->first() == null){

        $translation = Translation::where('translationable_type','App\Model\EducationDegree')
                                    ->where('translationable_id', $request->id);
        $translation->delete();
        EducationDegree::destroy($request->id);

        return Toastr::success (\App\CPU\translate('deleted_Successfully_'));


    }else{
        return Toastr::success (\App\CPU\translate('You_cant_delete'));
    }

    }

    public function deleteExperience(Request $request){

        $Isdeleted = EducationDegree::where('id', $request->id)->first();
        if( $Isdeleted->Advertis()->first() == null){
        $translation = Translation::where('translationable_type','App\Model\Experience')
                                    ->where('translationable_id', $request->id);
        $translation->delete();
        Experience::destroy($request->id);

        return Toastr::success (\App\CPU\translate('deleted_Successfully_'));


    }else{
        return Toastr::success (\App\CPU\translate('You_cant_delete'));
    }

    }

    public function deleteLicense(Request $request){


        $translation = Translation::where('translationable_type','App\Model\License')
                                    ->where('translationable_id', $request->id);
        $translation->delete();
        License::destroy($request->id);

        return response()->json();

    }

    public function deleteLanguage(Request $request){


        $translation = Translation::where('translationable_type','App\Model\Language')
                                    ->where('translationable_id', $request->id);
        $translation->delete();
        Language::destroy($request->id);

        return response()->json();

    }

    public function deleteNationality(Request $request){

        $Isdeleted = Nationality::where('id', $request->id)->first();
        if( $Isdeleted->Advertis()->first() == null){
        $translation = Translation::where('translationable_type','App\Model\Nationality')
                                    ->where('translationable_id', $request->id);
        $translation->delete();
        Nationality::destroy($request->id);

        return Toastr::success (\App\CPU\translate('deleted_Successfully_'));


    }else{
        return Toastr::success (\App\CPU\translate('You_cant_delete'));
    }

    }

    public function deleteSkill(Request $request){


        $translation = Translation::where('translationable_type','App\Model\Skill')
                                    ->where('translationable_id', $request->id);
        $translation->delete();
        Skill::destroy($request->id);

        return response()->json();

    }

    public function deletestateAdvertis(Request $request){

        $Isdeleted = StateAdvertis::where('id', $request->id)->first();
        if($Isdeleted->Advertis()->first() == null && $Isdeleted->CityAdvertis()->first() == null ){

            $translation = Translation::where('translationable_type','App\Model\StateAdvertis')
                                    ->where('translationable_id', $request->id);
        $translation->delete();
        StateAdvertis::destroy($request->id);

        return Toastr::success (\App\CPU\translate('deleted_Successfully_'));


            }else{
                return Toastr::success (\App\CPU\translate('You_cant_delete'));
            }



    }

    public function deletegovernorate(Request $request){

        $Isdeleted = Governorate::where('id', $request->id)->first();
            if( $Isdeleted->Advertis()->first() == null ){
                $translation = Translation::where('translationable_type','App\Model\Governorate')
                ->where('translationable_id', $request->id);
              $translation->delete();
            Governorate::destroy($request->id);

           return Toastr::success (\App\CPU\translate('deleted_Successfully_'));


            }else{
                return Toastr::success (\App\CPU\translate('You_cant_delete'));
            }




    }

    public function deletetypeWorkHour(Request $request){


        $Isdeleted = TypeWorkHour::where('id', $request->id)->first();
        if( $Isdeleted->Advertis()->first() == null){
        $translation = Translation::where('translationable_type','App\Model\TypeWorkHour')
                                    ->where('translationable_id', $request->id);
        $translation->delete();
        TypeWorkHour::destroy($request->id);


        return Toastr::success (\App\CPU\translate('deleted_Successfully_'));


            }else{
                return Toastr::success (\App\CPU\translate('You_cant_delete'));
            }

    }


    public function deleteCityAdvertis(Request $request){

        $Isdeleted = CityAdvertis::where('id', $request->id)->first();
        if( $Isdeleted->Advertis()->first() == null &&  $Isdeleted->Governorates()->first()){
        $translation = Translation::where('translationable_type','App\Model\CityAdvertis')
                                    ->where('translationable_id', $request->id);
        $translation->delete();
        CityAdvertis::destroy($request->id);

        return Toastr::success (\App\CPU\translate('deleted_Successfully_'));


            }else{
                return Toastr::success (\App\CPU\translate('You_cant_delete'));
            }

    }


    public function deleteAdvertisement(Request $request){


        $translation = Translation::where('translationable_type','App\Model\Advertis')
                                    ->where('translationable_id', $request->id);
        $translation->delete();
        Advertis::destroy($request->id);

        return response()->json();

    }













    // //////////////////////////////////////////////////


    public function getJobTitle($id){
        $states = DB::table('job_titles')->where('career_sector_id', $id)->pluck("name", "id");

        return json_encode($states);
        // return $states;
    }

    public function getCityAdvertis($id){
        $states = DB::table('city_advertis')->where('state_advertis_id', $id)->pluck("name", "id");

        return json_encode($states);
        // return $states;
    }

    public function getGovernorate($id){
        $states = DB::table('governorates')->where('city_advertis_id', $id)->pluck("name", "id");

        return json_encode($states);
        // return $states;
    }





    // ///////////////////////////////////////////////image//////////////


    protected function uploadAttachments(Request $request)
    {


        if(!$request->hasFile('image')){

            return;
        }
        $files = $request->file('image');
        $image = [];
        foreach($files as $file){

            if($file->isValid()){

                $path = $file->store('/', [
                    'disk' => 'uploads',
                 ]);

                 $image[] = $path;

            }
        }

        return $image;



     }




     public function deletepicture($id, $imgdelete){

        $Advertis = Advertis::findOrFail($id);
        $imgarray = $Advertis->image;
        // dd($img);

        $imgsave = [];
        foreach($imgarray as $img){
            if($img == $imgdelete){

                // Storage::delete($img);
                Storage::disk('uploads')->delete($img);

            }else{

                $imgsave[] = $img;

            }

        }

        // dd($imgsave);
        $Advertis->update([
            'image' => $imgsave,
        ]);

        return back();


     }


     public function users(){
        return view('admin-views.users.usersadvertiment');
     }











}



















