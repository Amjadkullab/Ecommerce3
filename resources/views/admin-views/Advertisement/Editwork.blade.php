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
                        <form action="{{route('admin.updatework', $Advertis->id)}}" method="POST" enctype="multipart/form-data">
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





























                                        {{-- <label for=""> {{ \App\CPU\translate('advertisment_description1')}}</label>
                                        <textarea name="description[]"
                                        class="form-control">{{$lang==$default_lang?$Advertis['description']:($translate[$lang]['name']??'')}}
                                        </textarea> --}}
                                        <label for=""> {{ \App\CPU\translate('advertisment_description1')}}</label>
                                        <textarea name="description"
                                        class="form-control">{{ old('description',$Advertis->description) }}
                                        </textarea>














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
