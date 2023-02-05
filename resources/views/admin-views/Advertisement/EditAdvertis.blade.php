@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('update_advertisment'))

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
                <li class="breadcrumb-item" aria-current="page">{{\App\CPU\translate('update_advertisment')}}</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ \App\CPU\translate('update_advertisment')}}
                    </div>
                    <div class="card-body" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                        <form action="{{route('admin.updateAdvertisement', $Advertis->id)}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
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
                                <div class="col-12 col-md-5">
                                    <label for=""> {{ \App\CPU\translate('name_carrer_sector')}}</label>
                                    <select name="career_sector_id" id="career_sector_id" class="form-control">
                                        @foreach ($CareerSector as $CareerSectors)
                                            <option value="{{ $CareerSectors->id }}" @if ($CareerSectors->id == $Advertis->career_sector_id)
                                                selected
                                            @endif>{{ $CareerSectors->name }}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="col-12 col-md-5">
                                    <label for=""> {{ \App\CPU\translate('name_joptitle')}}</label>
                                    <select name="job_title_id" id="job_title_id" class="form-control">
                                        @foreach ($jobTitle as $jobTitles)
                                            <option value="{{ $jobTitles->id }}" @if ($jobTitles->id == $Advertis->job_title_id)
                                                selected
                                            @endif>{{ $jobTitles->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-5">
                                    <label for=""> {{ \App\CPU\translate('advertise_type')}}</label>
                                    <select name="advertise_type_id" id="advertise_type_id" class="form-control">
                                        @foreach ($AdvertiserType as $AdvertiserTypes)
                                            <option value="{{ $AdvertiserTypes->id }}" @if ($AdvertiserTypes->id == $Advertis->advertise_type_id)
                                                selected
                                            @endif>{{ $AdvertiserTypes->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-5">
                                    <label for=""> {{\App\CPU\translate('type_contract')}}</label>
                                    <select name="type_contract_id" id="type_contract_id" class="form-control">
                                        @foreach ($TypeOfContract as $TypeOfContracts)
                                            <option value="{{ $TypeOfContracts->id }}" @if ($TypeOfContracts->id == $Advertis->type_contract_id)
                                                selected
                                            @endif>{{ $TypeOfContracts->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-5">
                                    <label for=""> {{ \App\CPU\translate('work_day')}}</label>
                                    <select name="work_day_id" id="work_day_id" class="form-control">
                                        @foreach ($numberWorkingDay as $numberWorkingDays)
                                            <option value="{{ $numberWorkingDays->id }}" @if ($numberWorkingDays->id == $Advertis->work_day_id)
                                                selected
                                            @endif>{{ $numberWorkingDays->workDays }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-5">
                                    <label for=""> {{ \App\CPU\translate('work_hour')}}</label>
                                    <select name="type_work_hour_id" id="type_work_hour_id" class="form-control">
                                        @foreach ($workHour as $workHours)
                                            <option value="{{ $workHours->id }}" @if ($workHours->id == $Advertis->type_work_hour_id)
                                                selected
                                            @endif>{{ $workHours->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-5">
                                    <label for=""> {{ \App\CPU\translate('salary')}}</label>
                                    <div class="input-group">
                                        <select name="salary_id" id="salary_id" class="form-control">
                                            {{-- <option value="">شيكل</option> --}}
                                            @foreach ($expectedSalary as $expectedSalaries)
                                            <option value="{{ $expectedSalaries->id }}" @if ($expectedSalaries->id == $Advertis->salary_id)
                                                selected
                                            @endif>{{ $expectedSalaries->type }}</option>
                                            @endforeach
                                        </select>
                                        <input type="number" name="expected_salary" id="expected_salary" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12 col-md-5 form-group">
                                    <label for=""> {{ \App\CPU\translate('Work_from_home')}} </label><br>
                                    <div class="form-check">
                                        <input type="radio" name="work_from_home" value="Yes" class="form-check-input" @if ($Advertis->work_from_home == 'Yes')
                                            checked
                                        @endif>
                                        <label for="" class="form-check-label">{{ \App\CPU\translate('Yes')}}</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="work_from_home" value="No" class="form-check-input" @if ($Advertis->work_from_home == 'No')
                                            checked
                                        @endif>
                                        <label for="" class="form-check-label">{{ \App\CPU\translate('No')}}</label>
                                    </div>
                                </div>


                                <div class="col-12 col-md-5">
                                    <label for=""> {{ \App\CPU\translate('extra_benefit')}}</label>

                                    <select
                                            class="js-example-basic-multiple js-states js-example-responsive form-control color-var-select"
                                            name="ExtraBenefit[]" multiple="multiple">
                                            @foreach ($ExtraBenefit as $ExtraBenefits)
                                                <option value="{{ $ExtraBenefits->id }}"
                                                    @foreach($Advertis->Benefits()->get() as $Benefits)
                                                        @if ($ExtraBenefits->id == $Benefits->id)
                                                        selected
                                                        @endif
                                                    @endforeach
                                                >{{ $ExtraBenefits->name }}</option>
                                            @endforeach

                                        </select>
                                </div>

                                <div class="col-12 col-md-5">
                                    <label for=""> {{ \App\CPU\translate('education_degree')}}</label>
                                    <select name="education_degree_id" id="education_degree_id" class="form-control">
                                        @foreach ($educationDegree as $educationDegrees)
                                            <option value="{{ $educationDegrees->id }}" @if ($educationDegrees->id == $Advertis->education_degree_id)
                                                selected
                                            @endif>{{ $educationDegrees->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-5">
                                    <label for=""> {{ \App\CPU\translate('experience')}}</label>

                                    <select name="experience_id" id="experience_id" class="form-control">
                                        @foreach ($ExperienceLevel as $ExperienceLeveles)
                                            <option value="{{ $ExperienceLeveles->id }}" @if ($ExperienceLeveles->id == $Advertis->experience_id)
                                                selected
                                            @endif>{{ $ExperienceLeveles->experiences_level }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-5 form-group">
                                    <label for="">  {{ \App\CPU\translate('The_job_requires_a_vehicle')}}</label>
                                    <div class="form-check">
                                        <input type="radio" name="job_requires_vehicle" class="form-check-input" value="Yes" @if ($Advertis->job_requires_vehicle == 'Yes')
                                            checked
                                        @endif>
                                        <label for="" class="form-check-label">{{ \App\CPU\translate('Yes')}}</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="job_requires_vehicle" class="form-check-input" value="No" @if ($Advertis->job_requires_vehicle == 'No')
                                            checked
                                        @endif>
                                        <label for="" class="form-check-label">{{ \App\CPU\translate('No')}}</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-5">
                                    <label for="">  {{ \App\CPU\translate('Driving_license_required')}}</label>

                                    <div class="form-check">
                                        <input type="radio" name="Require_driver_license" class="form-check-input" value="Yes" @if ($Advertis->Require_driver_license == 'Yes')
                                            checked
                                        @endif>
                                        <label for="" class="form-check-label">{{ \App\CPU\translate('Yes')}}</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="Require_driver_license" value="No" @if ($Advertis->Require_driver_license == 'No')
                                            checked
                                        @endif>
                                        <label for="" class="form-check-label">{{ \App\CPU\translate('No')}}</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-5">
                                    <label for=""> {{ \App\CPU\translate('License_category')}}</label>

                                    <select name="license[]" class="js-example-basic-multiple js-states js-example-responsive form-control color-var-select"
                                    multiple>
                                        @foreach ($license as $licenses)
                                            <option value="{{ $licenses->id }}"
                                                @foreach($Advertis->licenses()->get() as $licensed)
                                                @if ($licenses->id == $licensed->id)
                                                   selected
                                                @endif
                                               @endforeach

                                            >{{ $licenses->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-5">
                                    <label for="">{{ \App\CPU\translate('sex')}}</label>

                                    <select name="gender" id="gender" class="form-control">
                                        <option value="" @if ($Advertis->gender == '')
                                            selected
                                        @endif>{{ \App\CPU\translate('Did_not_matter')}}</option>
                                        <option value="male" @if ($Advertis->gender == 'male')
                                            selected
                                        @endif>{{ \App\CPU\translate('male_')}}</option>
                                        <option value="female" @if ($Advertis->gender == 'female')
                                            selected
                                        @endif>{{ \App\CPU\translate('female')}}</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-5">
                                    <label for="">{{ \App\CPU\translate('language')}}</label>

                                    <select name="langg[]" class="js-example-basic-multiple js-states js-example-responsive form-control color-var-select"
                                    multiple>
                                        @foreach ($langg as $languges)


                                            <option value="{{ $languges->id }}"
                                                @foreach($Advertis->Languages()->get() as $lan)
                                                 @if ($languges->id == $lan->id)
                                                    selected
                                                 @endif
                                                @endforeach
                                            >{{ $languges->name }}</option>

                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-5">
                                    <label for="">{{ \App\CPU\translate('nationality')}}</label>

                                    <select name="nationality_id" id="nationality_id" class="form-control">
                                        @foreach ($Nationality as $Nationalities)
                                            <option value="{{ $Nationalities->id }}" @if ($Nationalities->id == $Advertis->nationality_id)
                                                selected
                                            @endif>{{ $Nationalities->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-5">
                                    <label for="">{{ \App\CPU\translate('skill')}}</label>

                                    <select name="skill[]" id="" class="js-example-basic-multiple js-states js-example-responsive form-control color-var-select"
                                    multiple>
                                        @foreach ($skill as $skills)
                                            <option value="{{ $skills->id }}"
                                                @foreach($Advertis->Skills()->get() as $Skillsed)
                                                    @if ($skills->id == $Skillsed->id)
                                                        selected
                                                    @endif
                                                @endforeach
                                            >{{ $skills->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                @foreach(json_decode($language) as $lang)
                                    <?php
                                            if (count($Advertis['translations'])) {
                                                $translate = [];
                                                foreach ($Advertis['translations'] as $t) {
                                                    if ($t->locale == $lang && $t->key == "name") {
                                                        $translate[$lang]['name'] = $t->value;
                                                    }
                                                }
                                            }
                                    ?>

                                <div class="col-12 form-group {{$lang != $default_lang ? 'd-none':''}} lang_form"
                                     id="{{$lang}}-form">
                                        <label for=""> {{ \App\CPU\translate('advertisment_name1')}}</label>
                                        <input type="text" class="form-control" name="name[]"
                                        value="{{$lang==$default_lang?$Advertis['name']:($translate[$lang]['name']??'')}}"
                                        placeholder="{{\App\CPU\translate('New')}} {{\App\CPU\translate('Category')}}" {{$lang == $default_lang? 'required':''}}>


                                        <?php
                                            if (count($Advertis['translations'])) {
                                                $translate = [];
                                                foreach ($Advertis['translations'] as $t) {
                                                    if ($t->locale == $lang && $t->key == "description") {
                                                        $translate[$lang]['name'] = $t->value;
                                                    }
                                                }
                                            }
                                    ?>

                                        <label for=""> {{ \App\CPU\translate('advertisment_description1')}}</label>
                                        <textarea name="description[]"
                                        class="form-control">{{$lang==$default_lang?$Advertis['description']:($translate[$lang]['name']??'')}}
                                        </textarea>


                                </div>


                                <input type="hidden" name="lang[]" value="{{$lang}}">
                                @endforeach


                                <div class="col-12 col-md-5">
                                    <label for="">{{ \App\CPU\translate('state')}}</label>

                                    <select name="state_advertis_id" id="state_advertis_id" class="form-control">
                                        @foreach ($state_advertis as $state_advertises)
                                            <option value="{{ $state_advertises->id }}" @if ($state_advertises->id == $Advertis->state_advertis_id)
                                                selected
                                            @endif>{{ $state_advertises->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-5 form-group">
                                    <label for="">{{ \App\CPU\translate('governorate')}}</label>

                                    <select name="city_advertis_id" id="city_advertis_id" class="form-control">
                                        @foreach ($city_advertis as $city_advertises)
                                            <option value="{{ $city_advertises->id }}" @if ($city_advertises->id == $Advertis->city_advertis_id)
                                                selected
                                            @endif>{{ $city_advertises->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-5 form-group">
                                    <label for="">{{ \App\CPU\translate('Neighborhood')}}</label>

                                    <select name="governorates_id" id="governorates_id" class="form-control">
                                        @foreach ($governorate as $governorates)
                                            <option value="{{ $governorates->id }}" @if ($governorates->id == $Advertis->governorates_id)
                                                selected
                                            @endif>{{ $governorates->name }}</option>
                                        @endforeach
                                    </select>
                                </div>




                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ \App\CPU\translate('Upload advertisement images') }}</label><small
                                            style="color: red">* ( {{\App\CPU\translate('ratio')}} 1:10 )</small>
                                    </div>
                                    <div class="p-2 border border-dashed" style="max-width:430px;">
                                        <div class="row" id="coba">
                                            @if (is_array($Advertis->image))


                                            @foreach ($Advertis->image as $photo)
                                                <div class="col-6">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <img style="width: 100%" height="auto"
                                                                 onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                                 src="{{asset("public/uploads/".$photo)}}"
                                                                 alt="Product image">
                                                            <a href="{{route('admin.deletepicture', [$Advertis->id, $photo])}}"
                                                               class="btn btn-danger btn-block">{{\App\CPU\translate('Remove')}}</a>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                {{-- @if (is_array($Advertis->image))
                                    <div>
                                        <ul>
                                            @foreach ($Advertis->image as $file)
                                            <li><a href="{{ asset('uploads/' . $file) }}">{{ basename($file) }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif --}}

                                <div class="col-12 from_part_2">
                                    <div class="form-group">
                                        <hr>
                                        {{-- <div id="">

                                        </div> --}}
                                        <input type="hidden" id="viewer" name="image">
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary float-right">{{\App\CPU\translate('update')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('script')
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
                        $('select[name="job_title_id"]').empty();
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
                        $('select[name="city_advertis_id"]').empty();
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
                        $('select[name="governorates_id"]').empty();
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


@endpush
