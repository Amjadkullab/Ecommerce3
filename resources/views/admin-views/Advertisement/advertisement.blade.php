@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('add_advertisment'))

@push('css_or_js')
    <link href="{{ asset('assets/back-end/css/tags-input.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/back-end/css/tags-input.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/select2/css/select2.min.css') }}" rel="stylesheet">




@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{\App\CPU\translate('Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{\App\CPU\translate('add_advertisment')}}</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ \App\CPU\translate('add_advertisment')}}
                    </div>
                    <div class="card-body" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                        <form action="{{route('admin.storeAdvertisement')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @php($language=\App\Model\BusinessSetting::where('type','pnc_language')->first())
                            @php($language = $language->value ?? null)
                            @php($default_lang = 'en')
                            @php($default_lang = json_decode($language)[0])
                            <ul class="nav nav-tabs mb-4">
                                @foreach(json_decode($language) as $lang)
                                    <li class="nav-item">
                                        <a class="nav-link lang_link {{$lang == $default_lang? 'active':''}}"
                                           href="#"
                                           id="{{$lang}}-link">{{\App\CPU\Helpers::get_language_name($lang).'('.strtoupper($lang).')'}}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="row">
                                <div class="col-12 col-md-5 rest-part"><br>
                                    <label for="">{{ \App\CPU\translate('name_carrer_sector')}} : </label> <small style="color: red"> * {{\App\CPU\translate('req')}}  </small>
                                    <select name="career_sector_id" id="career_sector_id" class="js-example-placeholder-single js-example-basic-single js-states js-example-responsive form-control color-var-select" autofocus>
                                        <option value="" disabled selected> {{ \App\CPU\translate('Select the career sector')}}</option>
                                        @foreach ($CareerSector as $CareerSectors)
                                            <option value="{{ $CareerSectors->id }}">{{ $CareerSectors->name }}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="col-12 col-md-5 rest-part"><br>
                                    <label for="">{{ \App\CPU\translate('name_joptitle')}} : </label>  <small style="color: red"> * {{\App\CPU\translate('req')}}  </small>
                                    <select name="job_title_id" id="job_title_id" class="js-example-basic-single js-states js-example-responsive form-control color-var-select">
                                        <option value="" disabled selected>{{ \App\CPU\translate('Select the job title')}}</option>
                                        {{-- @foreach ($jobTitle as $jobTitles)
                                            <option value="{{ $jobTitles->id }}">{{ $jobTitles->name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>

                                <div class="col-12 col-md-5 rest-part"><br>
                                    <label for="">{{ \App\CPU\translate('advertise_type')}} : </label>  <small style="color: red"> * {{\App\CPU\translate('req')}}  </small>
                                    <select name="advertise_type_id" id="advertise_type_id" class="js-example-basic-single js-states js-example-responsive form-control color-var-select" required>
                                        <option value="" disabled selected>{{ \App\CPU\translate('Select the advertise type')}} </option>
                                        @foreach ($AdvertiserType as $AdvertiserTypes)
                                            <option value="{{ $AdvertiserTypes->id }}">{{ $AdvertiserTypes->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-5 rest-part"><br>
                                    <label for="">{{\App\CPU\translate('type_contract')}} : </label>  <small style="color: red"> * {{\App\CPU\translate('req')}}  </small>
                                    <select name="type_contract_id" id="type_contract_id" class="js-example-basic-single js-states js-example-responsive form-control color-var-select">
                                        <option value="" disabled selected>  {{ \App\CPU\translate('Select the type contract')}}</option>
                                        @foreach ($TypeOfContract as $TypeOfContracts)
                                            <option value="{{ $TypeOfContracts->id }}">{{ $TypeOfContracts->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-5 rest-part"><br>
                                    <label for="">{{ \App\CPU\translate('work_day')}} : </label>  <small style="color: red"> * {{\App\CPU\translate('req')}}  </small>
                                    <select name="work_day_id" id="work_day_id" class="js-example-basic-single js-states js-example-responsive form-control color-var-select">
                                        <option value="" disabled selected>   {{ \App\CPU\translate('Select the work day')}}</option>
                                        @foreach ($numberWorkingDay as $numberWorkingDays)
                                            <option value="{{ $numberWorkingDays->id }}">{{ $numberWorkingDays->workDays }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-5 rest-part"><br>
                                    <label for="">{{ \App\CPU\translate('work_hour')}} : </label>  <small style="color: red"> * {{\App\CPU\translate('req')}}  </small>
                                    <select name="type_work_hour_id" id="type_work_hour_id" class="js-example-basic-single js-states js-example-responsive form-control color-var-select">
                                        <option value="" disabled selected>   {{ \App\CPU\translate('Select the work hour')}}</option>
                                        @foreach ($workHour as $workHours)
                                            <option value="{{ $workHours->id }}">{{ $workHours->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-5 rest-part"><br>
                                    <label for="">{{ \App\CPU\translate('expected_salary') }} : </label>  <small style="color: red"> * {{\App\CPU\translate('opt')}}  </small>
                                    <div class="input-group">
                                        <select name="salary_id" id="salary_id"
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
                                        <input type="number" name="expected_salary" id="expected_salary" class="form-control"
                                            placeholder= {{ \App\CPU\translate('Enter_the_expected_salary') }}>
                                    </div>
                                </div>
                                {{-- <div class="col-12 col-md-5 rest-part"><br>
                                    <label for="">{{ \App\CPU\translate('expected_salary')}} : </label>  <small style="color: red"> * {{\App\CPU\translate('opt')}}  </small>
                                    <div class="input-group">
                                        <select name="salary_id" id="salary_id" class="js-example-basic-single js-states js-example-responsive form-control color-var-select">
                                            <option value="" disabled selected> {{ \App\CPU\translate('Select the salary type')}}  </option>
                                            @foreach ($expectedSalary as $expectedSalaries)
                                            <option value="{{ $expectedSalaries->id }}">{{ $expectedSalaries->type }}</option>
                                            @endforeach
                                        </select>
                                        <input type="number" name="expected_salary" id="expected_salary" class="form-control" placeholder="ادخل الراتب المتوقع">
                                    </div>
                                </div> --}}

                                <div class="col-12 col-md-5 form-group rest-part"><br>
                                    <label for="">{{ \App\CPU\translate('Work_from_home')}} : </label>  <small style="color: red"> * {{\App\CPU\translate('req')}}  </small>
                                    <div class="form-check">
                                        <input type="radio" name="work_from_home" value="Yes">
                                        <label for="" class="form-check-label">{{ \App\CPU\translate('Yes')}}</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="work_from_home" value="No">
                                        <label for="" class="form-check-label">{{ \App\CPU\translate('No')}}</label>

                                    </div>
                                </div>

                                <div class="col-12 col-md-5 rest-part"><br>
                                    <label for="">{{ \App\CPU\translate('extra_benefit')}} : </label>  <small style="color: red"> * {{\App\CPU\translate('req')}}  </small>

                                    <select
                                            class="js-example-basic-multiple js-states js-example-responsive form-control color-var-select"
                                            name="ExtraBenefit[]" multiple="multiple">
                                            @foreach ($ExtraBenefit as $ExtraBenefits)
                                                <option value="{{ $ExtraBenefits->id }}">{{ $ExtraBenefits->name }}</option>
                                            @endforeach

                                        </select>
                                </div>

                                <div class="col-12 col-md-5 rest-part"><br>
                                    <label for="">{{ \App\CPU\translate('education_degree')}} : </label>  <small style="color: red"> * {{\App\CPU\translate('req')}}  </small>
                                    <select name="education_degree_id" id="education_degree_id" class="js-example-basic-single js-states js-example-responsive form-control color-var-select">
                                        <option value="" disabled selected>  {{ \App\CPU\translate('Select the education degree')}}</option>
                                        @foreach ($educationDegree as $educationDegrees)
                                            <option value="{{ $educationDegrees->id }}">{{ $educationDegrees->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-5 rest-part"><br>
                                    <label for="">{{ \App\CPU\translate('experience')}} : </label>  <small style="color: red"> * {{\App\CPU\translate('req')}}  </small>

                                    <select name="experience_id" id="experience_id" class="js-example-basic-single js-states js-example-responsive form-control color-var-select">
                                        <option value="" disabled selected>  {{ \App\CPU\translate('Select the experience level')}} </option>
                                        @foreach ($ExperienceLevel as $ExperienceLeveles)
                                            <option value="{{ $ExperienceLeveles->id }}">{{ $ExperienceLeveles->experiences_level }}</option>
                                        @endforeach
                                    </select>
                                </div>



                                <div class="col-12 col-md-5 rest-part"><br>
                                    <label for="">{{ \App\CPU\translate('The_job_requires_a_vehicle')}} : </label>  <small style="color: red"> * {{\App\CPU\translate('req')}}  </small>

                                    <div class="form-check">
                                        <input type="radio" name="job_requires_vehicle" value="Yes">
                                        <label for="" class="form-check-label">{{ \App\CPU\translate('Yes')}}</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="job_requires_vehicle" value="No">
                                        <label for="" class="form-check-label">{{ \App\CPU\translate('No')}}</label>

                                    </div>
                                </div>



                                <div class="col-12 col-md-5 rest-part"><br>
                                    <label for="">{{ \App\CPU\translate('Driving_license_required')}} : </label>  <small style="color: red"> * {{\App\CPU\translate('req')}}  </small>

                                    <div class="form-check">
                                        <input type="radio" name="Require_driver_license" value="Yes">
                                        <label for="" class="form-check-label">{{ \App\CPU\translate('Yes')}}</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="Require_driver_license" value="No">
                                        <label for="" class="form-check-label">{{ \App\CPU\translate('No')}}</label>

                                    </div>
                                </div>

                                <div class="col-12 col-md-5 rest-part"><br>
                                    <label for="">{{ \App\CPU\translate('License_category')}} : </label> <small style="color: red"> * {{\App\CPU\translate('opt')}}  </small>

                                    <select name="license[]" class="js-example-basic-multiple js-states js-example-responsive form-control color-var-select"
                                    multiple>
                                        @foreach ($license as $licenses)
                                            <option value="{{ $licenses->id }}">{{ $licenses->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-5 rest-part"><br>
                                    <label for="">{{ \App\CPU\translate('sex')}} : </label>  <small style="color: red"> * {{\App\CPU\translate('req')}}  </small>

                                    <select name="gender" id="gender" class="form-control">
                                        <option value="" disabled selected>{{ \App\CPU\translate('Select the sex type')}}  </option>
                                        <option value="male">{{ \App\CPU\translate('male_')}}</option>
                                        <option value="female">{{ \App\CPU\translate('female')}}</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-5 rest-part"><br>
                                    <label for="">{{ \App\CPU\translate('language_')}} : </label>  <small style="color: red"> * {{\App\CPU\translate('opt')}}  </small>

                                    <select name="langg[]" class="js-example-basic-multiple js-states js-example-responsive form-control color-var-select"
                                    multiple>

                                        @foreach ($langg as $languges)
                                            <option value="{{ $languges->id }}">{{ $languges->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-5 rest-part"><br>
                                    <label for="">{{ \App\CPU\translate('nationality')}} : </label>  <small style="color: red"> * {{\App\CPU\translate('req')}}  </small>

                                    <select name="nationality_id" id="nationality_id" class="js-example-basic-single js-states js-example-responsive form-control color-var-select">
                                            <option value="" disabled selected>{{ \App\CPU\translate('Select the nationality')}} </option>

                                             @foreach ($Nationality as $Nationalities)
                                            <option value="{{ $Nationalities->id }}">{{ $Nationalities->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-5 rest-part"><br>
                                    <label for="">{{ \App\CPU\translate('skill_')}} : </label>  <small style="color: red"> * {{\App\CPU\translate('opt')}}  </small>

                                    <select name="skill[]" id="" class="js-example-basic-multiple js-states js-example-responsive form-control color-var-select"
                                    multiple>
                                        @foreach ($skill as $skills)
                                            <option value="{{ $skills->id }}">{{ $skills->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                @foreach(json_decode($language) as $lang)
                                <div class="col-12 form-group {{ $lang != $default_lang ? 'd-none' : '' }} lang_form"
                                id="{{ $lang }}-form"> <br>
                                        <label for="">{{ \App\CPU\translate('advertisment_name1')}} : </label>  <small style="color: red"> * {{\App\CPU\translate('req')}}  </small> <br>
                                        <input type="text" class="form-control" name="name[]" id="name">
<br>

                                        <label for="">{{ \App\CPU\translate('advertisment_description1')}} : </label>  <small style="color: red"> * {{\App\CPU\translate('req')}}  </small><br>
                                        <textarea name="description[]" id="description" class="editor textarea"></textarea> <br>


                                </div>


                                <input type="hidden" name="lang[]" value="{{$lang}}">
                                @endforeach


                                <div class="col-12 col-md-5 rest-part"><br>
                                    <label for="">{{ \App\CPU\translate('state')}} : </label>  <small style="color: red"> * {{\App\CPU\translate('req')}}  </small>

                                    <select name="state_advertis_id" id="state_advertis_id" class="js-example-basic-single js-states js-example-responsive form-control color-var-select">
                                        <option value="" disabled selected>{{ \App\CPU\translate('Select the state')}} </option>
                                        @foreach ($state_advertis as $state_advertises)
                                            <option value="{{ $state_advertises->id }}">{{ $state_advertises->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-5 rest-part"><br>
                                    <label for="">{{ \App\CPU\translate('governorate')}} : </label>  <small style="color: red"> * {{\App\CPU\translate('req')}}  </small>

                                    <select name="city_advertis_id" id="city_advertis_id" class="js-example-basic-single js-states js-example-responsive form-control color-var-select">
                                        <option value="" disabled selected>  {{ \App\CPU\translate('Select the governorate')}}</option>

                                        {{-- @foreach ($city_advertis as $city_advertises)
                                            <option value="{{ $city_advertises->id }}">{{ $city_advertises->name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>

                                <div class="col-12 col-md-5 rest-part"><br>
                                    <label for="">{{ \App\CPU\translate('Neighborhood')}} : </label>  <small style="color: red"> * {{\App\CPU\translate('opt')}}  </small>

                                    <select name="governorates_id" id="governorates_id" class="js-example-basic-single js-states js-example-responsive form-control color-var-select">
                                        <option value="" disabled selected> {{ \App\CPU\translate('Select the Neighborhood')}} </option>
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
                                        <label class="custom-file-label"
                                               for="customFileEg1">{{\App\CPU\translate('choose_file')}} </label>
                                    </div>
                                </div> --}}
                                {{-- <input type="file"  name="image[]" multiple> --}}



                                {{-- -------------- --}}


                                <div class="col-md-8 rest-part"><br>
                                    <div class="form-group ">
                                        <label>{{ \App\CPU\translate('Upload advertisement images') }} : </label><small
                                        style="color: red">  * {{ \App\CPU\translate('ratio') }} 1:9 {{\App\CPU\translate('req')}} </small>
                                    </div>
                                    <div class="p-2 border border-dashed" style="max-width:430px;"> <br>
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

                            <button type="submit" class="btn btn-primary float-right">{{\App\CPU\translate('add')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('script')


<script>
    $(".lang_link").click(function (e) {
        e.preventDefault();
        $(".lang_link").removeClass('active');
        $(".lang_form").addClass('d-none');
        $(this).addClass('active');

        let form_id = this.id;
        let lang = form_id.split("-")[0];
        console.log(lang);
        $("#" + lang + "-form").removeClass('d-none');
        if (lang == '{{$default_lang}}') {
            $(".from_part_2").removeClass('d-none');
        } else {
            $(".from_part_2").addClass('d-none');
        }
    });




    $(document).ready(function () {
        $('#dataTable').DataTable();
    });
</script>


{{-- <img src="" width="" alt="">
.attr('src', e.target.result); --}}
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
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
    <script>
        $(".lang_link").click(function (e) {
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.split("-")[0];
            console.log(lang);
            $("#" + lang + "-form").removeClass('d-none');
            if (lang == '{{$default_lang}}') {
                $(".from_part_2").removeClass('d-none');
            } else {
                $(".from_part_2").addClass('d-none');
            }
        });

        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>


    <script src="{{ asset('assets/back-end') }}/js/tags-input.min.js"></script>
    <script src="{{ asset('assets/back-end/js/spartan-multi-image-picker.js') }}"></script>
    <script>
    $(".js-example-responsive").select2({
        // dir: "rtl",
        width: 'resolve'
    });
    </script>

    <script>
        $('input[name="colors_active"]').on('change', function() {
            if (!$('input[name="colors_active"]').is(':checked')) {
                $('#colors-selector').prop('disabled', true);
            } else {
                $('#colors-selector').prop('disabled', false);
            }
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
                            $('select[name="job_title_id"]').empty().append('<option value="" disabled selected>{{ \App\CPU\translate('Select the job title')}} </option>');;
                            $.each(data, function(key, value) {
                                $('select[name="job_title_id"]').append('<option value="' +
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
            $('select[name="state_advertis_id"]').on('change', function() {
                var StateAdvertisID = $(this).val();
                if (StateAdvertisID) {
                    $.ajax({
                        url: "{{ URL::to('admin/selectStateAdvertis') }}/" + StateAdvertisID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="city_advertis_id"]').empty().append('<option value="" disabled selected>{{ \App\CPU\translate('Select the governorate')}}</option>');
                            $.each(data, function(key, value) {
                                $('select[name="city_advertis_id"]').append('<option value="' +
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
                            $('select[name="governorates_id"]').empty().append('<option value="" disabled selected> {{ \App\CPU\translate('Select the Neighborhood')}} </option>');
                            $.each(data, function(key, value) {
                                $('select[name="governorates_id"]').append('<option value="' +
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

<script src="{{ asset('/') }}vendor/ckeditor/ckeditor/ckeditor.js"></script>
<script src="{{ asset('/') }}vendor/ckeditor/ckeditor/adapters/jquery.js"></script>
<script>
    $('.textarea').ckeditor({
        contentsLangDirection: '{{ Session::get('direction') }}',
    });
</script>


<script src="{{ asset('public/assets/back-end') }}/js/tags-input.min.js"></script>
<script src="{{ asset('public/assets/back-end/js/spartan-multi-image-picker.js') }}"></script>
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



$('.js-example-placeholder-single').select2({
  templateSelection: function (data) {
    if (data.id === '') { // adjust for custom placeholder values
      return '  {{ \App\CPU\translate('Select the career sector')}}';
    }

    return data.text;
  }
});
</script>

<script>
    $(".lang_link").click(function(e) {
        e.preventDefault();
        $(".lang_link").removeClass('active');
        $(".lang_form").addClass('d-none');
        $(this).addClass('active');

        let form_id = this.id;
        let lang = form_id.split("-")[0];
        console.log(lang);
        $("#" + lang + "-form").removeClass('d-none');
        if (lang == '{{ $default_lang }}') {
            $(".rest-part").removeClass('d-none');
        } else {
            $(".rest-part").addClass('d-none');
        }
    })
</script>

{{-- ck editor --}}
<script src="{{ asset('/') }}vendor/ckeditor/ckeditor/ckeditor.js"></script>
<script src="{{ asset('/') }}vendor/ckeditor/ckeditor/adapters/jquery.js"></script>
<script>
    $('.textarea').ckeditor({
        contentsLangDirection: '{{ Session::get('direction') }}',
    });
</script>


<script>
    $(".lang_link").click(function(e) {
        e.preventDefault();
        $(".lang_link").removeClass('active');
        $(".lang_form").addClass('d-none');
        $(this).addClass('active');

        let form_id = this.id;
        let lang = form_id.split("-")[0];
        console.log(lang);
        $("#" + lang + "-form").removeClass('d-none');
        if (lang == '{{ $default_lang }}') {
            $(".rest-part").removeClass('d-none');
        } else {
            $(".rest-part").addClass('d-none');
        }
    })
</script>

@endpush
