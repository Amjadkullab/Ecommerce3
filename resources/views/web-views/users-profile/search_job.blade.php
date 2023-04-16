@extends('layouts.front-end.app')

@section('title', \App\CPU\translate('searchjob'))

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

                <form action="{{ route('storesearchjob') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">





























                        <div class="col-12 form-group"><br>


                            <small style="color: red">* {{\App\CPU\translate('Please write')}}  </small><br><br>
                            <label for="">{{ \App\CPU\translate('advertisment_description1') }} : </label>  <small style="color: red">*</small><br>
                            <textarea name="description"  id="description" required class="editor textarea">{{ old('description') }}</textarea>


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





                        {{-- -------------- --}}





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
     const imagess = [];
    const input= document.getElementById('viewer');
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
                imagess.push(index);
                console.log(imagess);
                if(imagess.length > 1){
                    input.required = '';
                }
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
