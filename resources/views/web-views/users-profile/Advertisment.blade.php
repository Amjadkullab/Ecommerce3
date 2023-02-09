@extends('layouts.front-end.app')

@section('title', \App\CPU\translate('add advertisment'))

@push('css_or_js')
<link href="{{ asset('assets/back-end/css/tags-input.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/select2/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('public/assets/back-end/css/tags-input.min.css') }}" rel="stylesheet">
<link href="{{ asset('public/assets/select2/css/select2.min.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">



    <style>
        [type="radio"]:checked,
        [type="radio"]:not(:checked) {
            position: absolute;
            left: -9999px;
        }

        [type="radio"]:checked+label,
        [type="radio"]:not(:checked)+label {
            position: relative;
            padding-left: 28px;
            cursor: pointer;
            line-height: 20px;
            display: inline-block;
            color: #666;
        }

        [type="radio"]:checked+label:before,
        [type="radio"]:not(:checked)+label:before {
            content: '';
            position: absolute;
            left: 0px;
            top: 0px;
            width: 20px;
            height: 20px;
            border: 1px solid #ddd;
            border-radius: 100%;
            background: #fff;
        }

        [type="radio"]:checked+label:after,
        [type="radio"]:not(:checked)+label:after {
            content: '';
            width: 12px;
            height: 12px;
            background: #1b7fed;
            position: absolute;
            top: 4px;
            left: 4px;
            border-radius: 100%;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        [type="radio"]:not(:checked)+label:after {
            opacity: 0;
            -webkit-transform: scale(0);
            transform: scale(0);
        }

        [type="radio"]:checked+label:after {
            opacity: 1;
            -webkit-transform: scale(1);
            transform: scale(1);
        }
    </style>
@endpush

@section('content')

    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4 mt-3 rtl"
        style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
        <div class="row">
            <!-- Sidebar-->
            @include('web-views.partials._profile-aside')

            {{-- Content --}}
            <section class="col-lg-9 col-md-9">

                <form action="{{ route('storeAdvertisement') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-12 col-md-5 rest-part"><br>

                            <label for="">{{ \App\CPU\translate('name_carrer_sector') }} : </label> <small style="color: red">* {{\App\CPU\translate('req')}}  </small>

                            <select name="career_sector_id" id="career_sector_id" required
                                class="js-example-placeholder-single js-example-basic-single js-states js-example-responsive form-control color-var-select"
                                autofocus>
                                <option value="" disabled selected>
                                    {{ \App\CPU\translate('Select the career sector') }}</option>
                                @foreach ($CareerSector as $CareerSectors)
                                    <option value="{{ $CareerSectors->id }}"
                                         {{-- @if (old('career_sector_id') == $CareerSectors->id)
                                        selected
                                    @endif --}}
                                    >{{ $CareerSectors->name }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="col-12 col-md-5 rest-part"><br>
                            <label for="">{{ \App\CPU\translate('name_joptitle') }} : </label> <small style="color: red">* {{\App\CPU\translate('req')}}  </small>
                            <select name="job_title_id" id="job_title_id" required
                                class="js-example-basic-single js-states js-example-responsive form-control color-var-select">
                                <option value="" disabled selected>{{ \App\CPU\translate('Select the job title') }}
                                </option>

                                {{-- @foreach ($jobTitle as $jobTitles)
                                            <option value="{{ $jobTitles->id }}">{{ $jobTitles->name }}</option>
                                        @endforeach --}}
                            </select>
                        </div>

                        <div class="col-12 col-md-5 rest-part"><br>
                            <label for="">{{ \App\CPU\translate('advertise_type')}} : </label>  <small style="color: red">* {{\App\CPU\translate('req')}}  </small>
                            <select name="advertise_type_id" id="advertise_type_id" required
                                class="js-example-basic-single js-states js-example-responsive form-control color-var-select"
                                >
                                <option value="" disabled selected>
                                    {{ \App\CPU\translate('Select the advertise type') }} </option>
                                @foreach ($AdvertiserType as $AdvertiserTypes)
                                    <option value="{{ $AdvertiserTypes->id }}"
                                         @if (old('advertise_type_id') == $AdvertiserTypes->id)
                                        selected
                                    @endif
                                    >{{ $AdvertiserTypes->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-5 rest-part"><br>
                            <label for="">{{ \App\CPU\translate('type_contract') }} : </label> <small style="color: red">* {{\App\CPU\translate('req')}}  </small>
                            <select name="type_contract_id" id="type_contract_id" required
                                class="js-example-basic-single js-states js-example-responsive form-control color-var-select">
                                <option value="" disabled selected>
                                    {{ \App\CPU\translate('Select the type contract') }}</option>
                                @foreach ($TypeOfContract as $TypeOfContracts)
                                    <option value="{{ $TypeOfContracts->id }}"
                                        @if (old('type_contract_id') == $TypeOfContracts->id)
                                        selected
                                    @endif
                                    >{{ $TypeOfContracts->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-5 rest-part"><br>
                            <label for="">{{ \App\CPU\translate('work_day') }} : </label>  <small style="color: red">* {{\App\CPU\translate('req')}}  </small>
                            <select name="work_day_id" id="work_day_id" required
                                class="js-example-basic-single js-states js-example-responsive form-control color-var-select">
                                <option value="" disabled selected> {{ \App\CPU\translate('Select the work day') }}
                                </option>
                                @foreach ($numberWorkingDay as $numberWorkingDays)
                                    <option value="{{ $numberWorkingDays->id }}"
                                        @if (old('work_day_id') == $numberWorkingDays->id)
                                        selected
                                    @endif
                                    >{{ $numberWorkingDays->workDays }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-5 rest-part" ><br>
                            <label for="">{{ \App\CPU\translate('work_hour') }} : </label>  <small style="color: red">* {{\App\CPU\translate('req')}}  </small>
                            <select name="type_work_hour_id" id="type_work_hour_id" required
                                class="js-example-basic-single js-states js-example-responsive form-control color-var-select">
                                <option value="" disabled selected> {{ \App\CPU\translate('Select the work hour') }}
                                </option>
                                @foreach ($workHour as $workHours)
                                    <option value="{{ $workHours->id }}"
                                        @if (old('type_work_hour_id') == $workHours->id)
                                        selected
                                    @endif
                                    >{{ $workHours->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-5 rest-part"><br>
                            <label for="">{{ \App\CPU\translate('salary') }} : </label>  <small style="color: red">* {{\App\CPU\translate('opt')}}  </small>
                            <div class="input-group">

                                <input type="number" name="expected_salary" id="expected_salary" class="form-control form-control-sm"
                                    placeholder= {{ \App\CPU\translate('Enter_the_expected_salary') }}>
                                    <select name="salary_id" id="salary_id" style="width: 40%"
                                    class="js-example-basic-single js-states js-example-responsive form-control color-var-select">
                                    <option value="" disabled selected>
                                        {{ \App\CPU\translate('Select the salary type') }} </option>
                                    @foreach ($expectedSalary as $expectedSalaries)
                                        <option value="{{ $expectedSalaries->id }}"
                                            @if (old('salary_id') == $expectedSalaries->id)
                                            selected
                                        @endif
                                        >{{ $expectedSalaries->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-5 form-group rest-part"><br>
                            <label for="">{{ \App\CPU\translate('Work_from_home') }} : </label>  <small style="color: red">* {{\App\CPU\translate('req')}}  </small><br>
                            <div class="form-check">
                                <input type="radio" id="Yes1" name="work_from_home" value="Yes" required>
                                <label for="Yes1" class="form-check-label">{{ \App\CPU\translate('Yes') }}</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="No1" name="work_from_home" value="No" required>
                                <label for="No1" class="form-check-label">{{ \App\CPU\translate('No') }}</label>

                            </div>
                        </div>

                        <div class="col-12 col-md-5 rest-part"><br>
                            <label for="">{{ \App\CPU\translate('extra_benefit') }} : </label>  <small style="color: red">* {{\App\CPU\translate('req')}}  </small>

                            <select name="ExtraBenefit[]" id="ExtraBenefit" required class="js-example-basic-multiple js-states js-example-responsive form-control color-var-select" multiple>
                                @foreach ($ExtraBenefit as $ExtraBenefits)
                                    <option value="{{ $ExtraBenefits->id }}"
                                        @if (old('ExtraBenefit') == $ExtraBenefits->id)
                                        selected
                                    @endif
                                    >{{ $ExtraBenefits->name }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-12 col-md-5 rest-part"><br>
                            <label for="">{{ \App\CPU\translate('education_degree') }} : </label>  <small style="color: red">* {{\App\CPU\translate('req')}}  </small>
                            <select name="education_degree_id" id="education_degree_id" required
                                class="js-example-basic-single js-states js-example-responsive form-control color-var-select">
                                <option value="" disabled selected>
                                    {{ \App\CPU\translate('Select the education degree') }}</option>
                                @foreach ($educationDegree as $educationDegrees)
                                    <option value="{{ $educationDegrees->id }}"
                                        @if (old('education_degree_id') == $educationDegrees->id)
                                        selected
                                    @endif
                                    >{{ $educationDegrees->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-5 rest-part"><br>
                            <label for="">{{ \App\CPU\translate('experience') }} : </label>  <small style="color: red">* {{\App\CPU\translate('req')}}  </small>

                            <select name="experience_id" id="experience_id" required
                                class="js-example-basic-single js-states js-example-responsive form-control color-var-select">
                                <option value="" disabled selected>
                                    {{ \App\CPU\translate('Select the experience level') }} </option>
                                @foreach ($ExperienceLevel as $ExperienceLeveles)
                                    <option value="{{ $ExperienceLeveles->id }}"
                                        @if (old('experience_id') == $ExperienceLeveles->id)
                                        selected
                                    @endif
                                    >{{ $ExperienceLeveles->experiences_level }}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="col-12 col-md-5 rest-part"><br>
                            <label for="">{{ \App\CPU\translate('The_job_requires_a_vehicle') }} </label>  <small style="color: red">* {{\App\CPU\translate('req')}}  </small>

                            <div class="form-check">
                                <input type="radio" id="Yes2" name="job_requires_vehicle" value="Yes" required>
                                <label for="Yes2" class="form-check-label">{{ \App\CPU\translate('Yes') }}</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="No2" name="job_requires_vehicle" value="No" required>
                                <label for="No2" class="form-check-label">{{ \App\CPU\translate('No') }}</label>

                            </div>
                        </div>



                        <div class="col-12 col-md-5 rest-part"><br>
                            <label for="">{{ \App\CPU\translate('Driving_license_required') }} </label>  <small style="color: red">* {{\App\CPU\translate('req')}}  </small>

                            <div class="form-check">
                                <input type="radio" id="Yes3" name="Require_driver_license" value="Yes" required>
                                <label for="Yes3" class="form-check-label">{{ \App\CPU\translate('Yes') }}</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="No3" name="Require_driver_license" value="No" required>
                                <label for="No3" class="form-check-label">{{ \App\CPU\translate('No') }}</label>

                            </div>
                        </div>

                        <div class="col-12 col-md-5 rest-part"><br>
                            <label for="">{{ \App\CPU\translate('License_category') }} : </label>  <small style="color: red">* {{\App\CPU\translate('opt')}}  </small>

                            <select name="license[]" id="license" class="js-example-basic-multiple js-states js-example-responsive form-control color-var-select" multiple>
                                @foreach ($license as $licenses)
                                    <option value="{{ $licenses->id }}"
                                        @if (old('license') == $licenses->id)
                                        selected
                                    @endif
                                    >{{ $licenses->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-5 rest-part"><br>
                            <label for="">{{ \App\CPU\translate('sex') }} : </label>  <small style="color: red">* {{\App\CPU\translate('req')}}  </small>

                            <select name="gender" id="gender" class="form-control" required>
                                <option value="" disabled selected>{{old('gender', \App\CPU\translate('Select the sex type')) }}
                                </option>
                                <option value="male">{{ \App\CPU\translate('male_') }}</option>
                                <option value="female">{{ \App\CPU\translate('female') }}</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-5 rest-part"><br>
                            <label for="">{{ \App\CPU\translate('language_') }} : </label>  <small style="color: red">* {{\App\CPU\translate('opt')}}  </small>


                            <select name="langg[]" id="langg" class="js-example-basic-multiple js-states js-example-responsive form-control color-var-select" multiple>
                                @foreach ($langg as $languges)
                                <option value="{{ $languges->id }}"
                                    @if (old('langg') == $languges->id)
                                    selected
                                @endif
                                >{{ $languges->name }}</option>
                                @endforeach
                            </select>
                            {{-- <select name="langg[]" class="js-example-basic-multiple js-states js-example-responsive form-control color-var-select" multiple>

                                @foreach ($langg as $languges)
                                    <option value="{{ $languges->id }}">{{ $languges->name }}</option>
                                @endforeach
                            </select> --}}
                        </div>

                        <div class="col-12 col-md-5 rest-part"><br>
                            <label for="">{{ \App\CPU\translate('nationality') }} : </label>  <small style="color: red">* {{\App\CPU\translate('req')}}  </small>

                            <select name="nationality_id" id="nationality_id" required
                                class="js-example-basic-single js-states js-example-responsive form-control color-var-select">
                                <option value="" disabled selected>
                                    {{ \App\CPU\translate('Select the nationality') }} </option>

                                @foreach ($Nationality as $Nationalities)
                                    <option value="{{ $Nationalities->id }}"
                                        @if (old('nationality_id') == $Nationalities->id)
                                        selected
                                    @endif
                                    >{{ $Nationalities->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-5 rest-part"><br>
                            <label for="" >{{ \App\CPU\translate('skill_') }} : </label>  <small style="color: red">* {{\App\CPU\translate('opt')}}  </small>

                            <select name="skill[]" id="skill" multiple class="js-example-basic-multiple js-states js-example-responsive form-control color-var-select">
                                @foreach ($skill as $skills)
                                    <option value="{{ $skills->id }}"
                                        @if (old('skill') == $skills->id)
                                        selected
                                    @endif
                                    >{{ $skills->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-12 form-group"><br>
                            <label for="">{{ \App\CPU\translate('advertisment_name1') }} : </label>  <small style="color: red">* {{\App\CPU\translate('req')}}  </small> <br>
                            <input type="text" class="form-control" name="name" required value="{{ old('name') }}" id="name"><br>


                            <label for="">{{ \App\CPU\translate('advertisment_description1') }} : </label>  <small style="color: red">* {{\App\CPU\translate('req')}}  </small><br>
                            <textarea name="description"  id="description" required class="editor textarea">{{ old('description') }}</textarea>


                        </div>




                        <div class="col-12 col-md-5 rest-part"><br>
                            <label for="">{{ \App\CPU\translate('state') }} : </label>  <small style="color: red">* {{\App\CPU\translate('req')}}  </small>

                            <select name="state_advertis_id" id="state_advertis_id" required
                                class="js-example-basic-single js-states js-example-responsive form-control color-var-select">
                                <option value="" disabled selected>{{ \App\CPU\translate('Select the state') }}
                                </option>
                                @foreach ($state_advertis as $state_advertises)
                                    <option value="{{ $state_advertises->id }}">{{ $state_advertises->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-5 rest-part"><br>
                            <label for="">{{ \App\CPU\translate('governorate') }} : </label>  <small style="color: red">* {{\App\CPU\translate('req')}}  </small>

                            <select name="city_advertis_id" id="city_advertis_id" required
                                class="js-example-basic-single js-states js-example-responsive form-control color-var-select">
                                <option value="" disabled selected>
                                    {{ \App\CPU\translate('Select the governorate') }}</option>

                                {{-- @foreach ($city_advertis as $city_advertises)
                                            <option value="{{ $city_advertises->id }}">{{ $city_advertises->name }}</option>
                                        @endforeach --}}
                            </select>
                        </div>

                        <div class="col-12 col-md-5 rest-part"><br>
                            <label for="">{{ \App\CPU\translate('Neighborhood') }} : </label>  <small style="color: red">* {{\App\CPU\translate('opt')}}  </small>

                            <select name="governorates_id" id="governorates_id"
                                class="js-example-basic-single js-states js-example-responsive form-control color-var-select">
                                <option value="" disabled selected>
                                    {{ \App\CPU\translate('Select the Neighborhood') }} </option>
                                {{-- @foreach ($governorate as $governorates)
                                            <option value="{{ $governorates->id }}">{{ $governorates->name }}</option>
                                        @endforeach --}}
                            </select>
                        </div>


                        {{-- <div class="col-12 col-md-4 from_part_2">
                                    <label>{{\App\CPU\translate('image')}}</label><small style="color: red">*
                                        ( {{\App\CPU\translate('ratio')}} 1:9 )</small>
                                    <div class="custom-file" style="text-align: left">
                                        <input type="file" name="image[]"
                                               class="custom-file-input"
                                               accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*"
                                               required multiple>
                                               /*  */
                                        <label class="custom-file-label"
                                               for="customFileEg1">{{\App\CPU\translate('choose_file')}} </label>
                                    </div>
                                </div> --}}
                        {{-- <input type="file"  name="image[]" multiple> --}}



                        {{-- -------------- --}}


                        <div class="col-md-8 rest-part"><br>
                            <div class="form-group "><br>
                                <label>{{ \App\CPU\translate('Upload advertisement images') }} : </label><small
                                    style="color: red"> * {{ \App\CPU\translate('ratio') }} 1:9 {{\App\CPU\translate('req')}} </small>
                            </div>
                            <div class="p-2 border border-dashed" style="max-width:430px;">
                                <div class="row" id="coba"></div>
                            </div>

                        </div>


                        {{-- -------------- --}}

                        <div class="col-12 from_part_2 rest-part">
                            <div class="form-group">
                                <hr>
                                {{-- <div id="">

                                        </div> --}}
                                <input type="hidden" id="viewer" name="image">
                            </div>
                        </div>



                    </div>

                    <button type="submit" class="btn btn-primary float-right">{{ \App\CPU\translate('add') }}</button>
                </form>




            </section>
        </div>
    </div>



@endsection


@push('script')
    <script>
        function review_message() {
            toastr.info('{{ \App\CPU\translate('you_can_review_after_the_product_is_delivered!') }}', {
                CloseButton: true,
                ProgressBar: true
            });
        }

        function refund_message() {
            toastr.info('{{ \App\CPU\translate('you_can_refund_request_after_the_product_is_delivered!') }}', {
                CloseButton: true,
                ProgressBar: true
            });
        }
    </script>




    <script>
        $(document).ready(function() {
            $('select[name="state_advertis_id"]').on('change', function() {
                var StateAdvertisID = $(this).val();
                if (StateAdvertisID) {
                    $.ajax({
                        url: "{{ URL::to('admin/selectStateAdvertis') }}/" + StateAdvertisID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="city_advertis_id"]').empty().append(
                                '<option value="" disabled selected>{{ \App\CPU\translate('Select the governorate') }}</option>'
                                );
                            $.each(data, function(key, value) {
                                $('select[name="city_advertis_id"]').append(
                                    '<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('select[name="city_advertis_id"]').on('change', function() {
                var CityAdvertisId = $(this).val();
                if (CityAdvertisId) {
                    $.ajax({
                        url: "{{ URL::to('admin/selectCityAdvertis') }}/" + CityAdvertisId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="governorates_id"]').empty().append(
                                '<option value="" disabled selected> {{ \App\CPU\translate('Select the Neighborhood') }} </option>'
                                );
                            $.each(data, function(key, value) {
                                $('select[name="governorates_id"]').append(
                                    '<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('select[name="career_sector_id"]').on('change', function() {
                var CareerSectorId = $(this).val();
                if (CareerSectorId) {
                    $.ajax({
                        url: "{{ URL::to('admin/selectCareerSector') }}/" + CareerSectorId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="job_title_id"]').empty().append(
                                '<option value="" disabled selected>{{ \App\CPU\translate('Select the job title') }} </option>'
                                );
                            $.each(data, function(key, value) {
                                $('select[name="job_title_id"]').append(
                                    '<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>















<script src="{{ asset('public/assets/back-end') }}/js/tags-input.min.js"></script>
<script src="{{ asset('public/assets/back-end/js/spartan-multi-image-picker.js') }}"></script>
<script>
    $(".js-example-responsive").select2({
        // dir: "rtl",
        width: 'resolve'
    });
    </script>

    <script src="{{ asset('/') }}vendor/ckeditor/ckeditor/ckeditor.js"></script>
<script src="{{ asset('/') }}vendor/ckeditor/ckeditor/adapters/jquery.js"></script>
<script>
    $('.textarea').ckeditor({
        contentsLangDirection: '{{ Session::get('direction') }}',
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



<script src="{{ asset('public/assets/select2/js/select2.js') }}"></script>
<script src="{{ asset('public/assets/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('public/assets/select2/js/select2.full.js') }}"></script>
<script src="{{ asset('assets/select2/js/select2.full.min.js') }}"></script>



<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>


{{-- <script>
    new MultiSelectTag('langg')  // id
    new MultiSelectTag('skill')  // id
    new MultiSelectTag('license')  // id
    new MultiSelectTag('ExtraBenefit')  // id

</script> --}}



<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#viewer').append('<img width="200px" src="' +
                                    e.target.result + '">');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#customFileEg1").change(function () {
        readURL(this);
    });
</script>


<script>
    $(function() {
        $("#coba").spartanMultiImagePicker({
            fieldName: 'image[]',
            maxCount: 10,
            rowHeight: 'auto',
            groupClassName: 'col-6',
            maxFileSize: '',
            placeholderImage: {
                image: '{{ asset('public/assets/back-end/img/400x400/img2.jpg') }}',
                width: '100%',
            },
            dropFileLabel: "Drop Here",
            onAddRow: function(index, file) {

            },
            onRenderedPreview: function(index) {

            },
            onRemoveRow: function(index) {

            },
            onExtensionErr: function(index, file) {
                toastr.error(
                '{{ \App\CPU\translate('Please only input png or jpg type file') }}', {
                    CloseButton: true,
                    ProgressBar: true
                });
            },
            onSizeErr: function(index, file) {
                toastr.error('{{ \App\CPU\translate('File size too big') }}', {
                    CloseButton: true,
                    ProgressBar: true
                });
            }
        });

        $("#thumbnail").spartanMultiImagePicker({
            fieldName: 'image',
            maxCount: 1,
            rowHeight: 'auto',
            groupClassName: 'col-12',
            maxFileSize: '',
            placeholderImage: {
                image: '{{ asset('public/assets/back-end/img/400x400/img2.jpg') }}',
                width: '100%',
            },
            dropFileLabel: "Drop Here",
            onAddRow: function(index, file) {

            },
            onRenderedPreview: function(index) {

            },
            onRemoveRow: function(index) {

            },
            onExtensionErr: function(index, file) {
                toastr.error(
                '{{ \App\CPU\translate('Please only input png or jpg type file') }}', {
                    CloseButton: true,
                    ProgressBar: true
                });
            },
            onSizeErr: function(index, file) {
                toastr.error('{{ \App\CPU\translate('File size too big') }}', {
                    CloseButton: true,
                    ProgressBar: true
                });
            }
        });

        $("#meta_img").spartanMultiImagePicker({
            fieldName: 'meta_image',
            maxCount: 1,
            rowHeight: '280px',
            groupClassName: 'col-12',
            maxFileSize: '',
            placeholderImage: {
                image: '{{ asset('public/assets/back-end/img/400x400/img2.jpg') }}',
                width: '90%',
            },
            dropFileLabel: "Drop Here",
            onAddRow: function(index, file) {

            },
            onRenderedPreview: function(index) {

            },
            onRemoveRow: function(index) {

            },
            onExtensionErr: function(index, file) {
                toastr.error(
                '{{ \App\CPU\translate('Please only input png or jpg type file') }}', {
                    CloseButton: true,
                    ProgressBar: true
                });
            },
            onSizeErr: function(index, file) {
                toastr.error('{{ \App\CPU\translate('File size too big') }}', {
                    CloseButton: true,
                    ProgressBar: true
                });
            }
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#viewer').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#customFileUpload").change(function() {
        readURL(this);
    });


    $(".js-example-theme-single").select2({
        theme: "classic"
    });

    $(".js-example-responsive").select2({
        // dir: "rtl",
        width: 'resolve'
    });
</script>


<script>


// function preformStore(){
//         let data ={
//             let formData = new FormData();
//             formData.append('career_sector_id', document.getElementById('career_sector_id').value);
//             formData.append('job_title_id', document.getElementById('job_title_id').value);
//             formData.append('advertise_type_id', document.getElementById('advertise_type_id').value);
//             formData.append('type_contract_id', document.getElementById('type_contract_id').value);
//             formData.append('work_day_id', document.getElementById('work_day_id').value);
//             formData.append('type_work_hour_id', document.getElementById('type_work_hour_id').value);
//             formData.append('salary_id', document.getElementById('salary_id').value);
//             formData.append('expected_salary', document.getElementById('expected_salary').value);
//             formData.append('ExtraBenefit', document.getElementById('ExtraBenefit').value);
//             formData.append('education_degree_id', document.getElementById('education_degree_id').value);
//             formData.append('experience_id', document.getElementById('experience_id').value);
//             formData.append('license', document.getElementById('license').value);
//             formData.append('gender', document.getElementById('gender').value);
//             formData.append('langg', document.getElementById('langg').value);
//             formData.append('nationality_id', document.getElementById('nationality_id').value);
//             formData.append('skill', document.getElementById('skill').value);
//             formData.append('name', document.getElementById('name').value);
//             formData.append('description', document.getElementById('description').value);
//             formData.append('state_advertis_id', document.getElementById('state_advertis_id').value);
//             formData.append('city_advertis_id', document.getElementById('city_advertis_id').value);
//             formData.append('governorates_id', document.getElementById('governorates_id').value);

//             formData.append('image', document.getElementById('image').files[0]);


//         }

//         store('/AddAdvertisement/', data);
// }


function preformStore(){

let formData = new FormData();
formData.append('career_sector_id', document.getElementById('career_sector_id').value);
formData.append('job_title_id', document.getElementById('job_title_id').value);
formData.append('advertise_type_id', document.getElementById('advertise_type_id').value);
formData.append('type_contract_id', document.getElementById('type_contract_id').value);
formData.append('work_day_id', document.getElementById('work_day_id').value);
formData.append('type_work_hour_id', document.getElementById('type_work_hour_id').value);
formData.append('salary_id', document.getElementById('salary_id').value);
formData.append('expected_salary', document.getElementById('expected_salary').value);
formData.append('ExtraBenefit', document.getElementById('ExtraBenefit').value);
formData.append('education_degree_id', document.getElementById('education_degree_id').value);
formData.append('experience_id', document.getElementById('experience_id').value);
formData.append('license', document.getElementById('license').value);
formData.append('gender', document.getElementById('gender').value);
formData.append('langg', document.getElementById('langg').value);
formData.append('nationality_id', document.getElementById('nationality_id').value);
formData.append('skill', document.getElementById('skill').value);
formData.append('name', document.getElementById('name').value);
formData.append('description', document.getElementById('description').value);
formData.append('state_advertis_id', document.getElementById('state_advertis_id').value);
formData.append('city_advertis_id', document.getElementById('city_advertis_id').value);
formData.append('governorates_id', document.getElementById('governorates_id').value);

// formData.append('image', document.getElementById('image'));



store('/AddAdvertisement', formData);



}


</script>
@endpush
{{-- select2.min --}}
