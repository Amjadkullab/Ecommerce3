@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('show_advertisment'))

@push('css_or_js')
    <link href="{{ asset('assets/back-end/css/tags-input.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/back-end/css/tags-input.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/select2/css/select2.min.css') }}" rel="stylesheet">


    <link href="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{\App\CPU\translate('Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{\App\CPU\translate('show_advertisment')}}</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row" style="margin-top: 20px" id="cate-table">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row flex-between justify-content-between align-items-center flex-grow-1">
                            <div class="col-12 col-sm-12 col-md-12" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                                <form action="{{ route('admin.fillterAdvertisement') }}" method="get" role="search" autocomplete="off">
                                    @csrf



                                    <div class="row">



                                        <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="career_sector">
                                            <p class="mg-b-10"> ({{\App\CPU\translate('name_carrer_sector')}}) </p>
                                            <select dir="{{Session::get('direction') === "rtl" ? 'rtl' : 'ltr'}}" name="career_sector" class="js-example-basic-single js-states js-example-responsive form-control color-var-select"
                                                required>
                                                <option value="{{ $type ??  \App\CPU\translate('name_carrer_sector')}} " disabled selected>
                                                    {{ $type ?? \App\CPU\translate('name_carrer_sector') }}
                                                </option>
                                                @foreach ($CareerSector as $CareerSectors)
                                                    <option value="{{ $CareerSectors->id }}">{{ $CareerSectors->name }}</option>
                                                @endforeach




                                            </select>
                                        </div><!-- col-4 -->



                                        <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="job_title">
                                            <p class="mg-b-10"> ({{\App\CPU\translate('name_joptitle')}})  </p>
                                            <select dir="{{Session::get('direction') === "rtl" ? 'rtl' : 'ltr'}}" class="form-control" name="job_title"
                                                required>
                                                <option value="{{\App\CPU\translate('name_joptitle')}}" disabled selected>
                                                    {{\App\CPU\translate('name_joptitle')}}
                                                </option>
                                                {{-- @foreach ($JobTitle as $JobTitles)
                                                    <option value="{{ $JobTitles->id }}">{{ $JobTitles->name }}</option>
                                                @endforeach --}}




                                            </select>
                                        </div><!-- col-4 -->



                                        <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="state_advertis">
                                            <p class="mg-b-10"> ({{\App\CPU\translate('state')}} )</p>
                                            <select dir="{{Session::get('direction') === "rtl" ? 'rtl' : 'ltr'}}" class="form-control" name="state_advertis"
                                                >
                                                <option value="" disabled selected>
                                                    {{ $type ?? \App\CPU\translate('state') }}
                                                </option>
                                                @foreach ($stateAdvertis as $stateAdvertises)
                                                    <option value="{{ $stateAdvertises->id }}">{{ $stateAdvertises->name }}</option>
                                                @endforeach
                                            </select>
                                        </div><!-- col-4 -->


                                        <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="governorates">
                                            <p class="mg-b-10"> ({{\App\CPU\translate('governorate')}} ) </p>
                                            <select dir="{{Session::get('direction') === "rtl" ? 'rtl' : 'ltr'}}" class="form-control" name="city_advertis"
                                                >
                                                <option value="" disabled selected>
                                                    {{ $type ?? \App\CPU\translate('governorate') }}
                                                </option>
                                                {{-- @foreach ($governorate as $governorates)
                                                    <option value="{{ $governorates->id }}">{{ $governorates->name }}</option>
                                                @endforeach --}}
                                            </select>
                                        </div><!-- col-4 -->


                                    </div><br>

                                    <div class="row">

                                        <div class="col-sm-1 col-md-2">
                                            <button class="btn btn-primary btn-block">{{\App\CPU\translate('search')}}</button>
                                        </div>

                                        <div class="col-sm-1 col-md-2">
                                            <a href="{{ route('admin.desblayAdvertisement') }}"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 50px">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                              </svg></a>

                                            {{-- <a class="btn btn-primary" href="{{ route('admin.desblayAdvertisement') }}">  {{\App\CPU\translate('Reload data')}}</a> --}}
                                        </div>

                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 1,0">
                        <div class="table-responsive">
                            <table id="dataTable" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                                class="table table-bordered" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                <tr>
                                    <th style="width: 100px">{{ \App\CPU\translate('category_id')}}</th>
                                    <th> {{ \App\CPU\translate('advertisment_name1')}}</th>
                                    <th>{{ \App\CPU\translate('name_carrer_sector')}}</th>
                                    <th>{{ \App\CPU\translate('name_joptitle')}}</th>
                                    <th> {{\App\CPU\translate('status')}}</th>
                                    <th>{{ \App\CPU\translate('settings')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($Advertis as $Advertises)

                                    <tr>

                                        <td >{{ $Advertises->id }}</td>
                                        <td >{{ $Advertises->name }}</td>
                                        <td>{{ $Advertises->CareerSector->name }}</td>
                                        <td>{{ $Advertises->JobTitle->name }}</td>


                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" class="status"
                                                    onclick="featured_status('{{$Advertises['id']}}')" {{$Advertises->status == 'Active'?'checked':''}}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td class="d-flex">
                                            <a class="btn btn-primary btn-sm edit" style="cursor: pointer;"
                                                title="{{ \App\CPU\translate('Edit')}}"
                                            href="{{route('admin.EditAdvertisement',[$Advertises['id']])}}">
                                                <i class="tio-edit"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm delete" style="cursor: pointer;"
                                                title="{{ \App\CPU\translate('Delete')}}"
                                            id="{{$Advertises['id']}}">
                                                <i class="tio-add-to-trash"></i>
                                            </a>
                                        </td>



                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="3">
                                        {{ \App\CPU\translate('There are no data')}}
                                    </td>
                                </tr>
                                @endforelse

                                </tbody>
                            </table>


                        </div>
                    </div>

                    {{-- <div class="card-footer">
                        {{$categories->links()}}
                    </div> --}}
                    {{-- @if(count($categories)==0)
                        <div class="text-center p-4">
                            <img class="mb-3" src="{{asset('public/assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">
                            <p class="mb-0">{{\App\CPU\translate('no_data_found')}}</p>
                        </div>
                    @endif --}}
                </div>
                <div class="pt-2">
                    {{-- {{ $Advertis->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
{{-- <script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script> --}}
    {{-- <script>
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
    </script> --}}


    <script>
        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            Swal.fire({
                title: '{{\App\CPU\translate('Are_you_sure')}}?',
                text: "{{\App\CPU\translate('You_will_not_be_able_to_revert_this')}}!",
                showCancelButton: true,
                type: 'warning',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{\App\CPU\translate('Yes')}}, {{\App\CPU\translate('delete_it')}}!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('admin.deleteAdvertisement')}}",
                        method: 'delete',
                        data: {id: id},
                        success: function () {
                            toastr.success('{{\App\CPU\translate('Category_deleted_Successfully.')}}');
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>

    <script src="{{ asset('assets/back-end') }}/js/tags-input.min.js"></script>
    <script src="{{ asset('assets/back-end/js/spartan-multi-image-picker.js') }}"></script>

    <script src="{{ asset('/') }}vendor/ckeditor/ckeditor/ckeditor.js"></script>
    <script src="{{ asset('/') }}vendor/ckeditor/ckeditor/adapters/jquery.js"></script>
    <script src="{{ asset('public/assets/back-end') }}/js/tags-input.min.js"></script>

     <!-- Page level plugins -->
     <script src="{{asset('public/assets/back-end')}}/vendor/datatables/jquery.dataTables.min.js"></script>
     <script src="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
     <!-- Page level custom scripts -->
     <script>
         // Call the dataTables jQuery plugin
         $(document).ready(function () {
             $('#dataTable').DataTable();
         });

         $(document).on('change', '.status', function () {
             var id = $(this).attr("id");
             if ($(this).prop("checked") == true) {
                 var status = 1;
             } else if ($(this).prop("checked") == false) {
                 var status = 0;
             }
             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                 }
             });
             $.ajax({
                 url: "{{route('admin.product.status-update')}}",
                 method: 'POST',
                 data: {
                     id: id,
                     status: status
                 },
                 success: function (data) {
                     if(data.success == true) {
                         toastr.success('{{\App\CPU\translate('Status updated successfully')}}');
                     }
                     else if(data.success == false) {
                         toastr.error('{{\App\CPU\translate('Status updated failed. Product must be approved')}}');
                         setTimeout(function(){
                             location.reload();
                         }, 2000);
                     }
                 }
             });
         });

         function featured_status(id) {
             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                 }
             });
             $.ajax({
                 url: "{{route('admin.statusAdvertisement')}}",
                 method: 'PUT',
                 data: {
                     id: id
                 },
                 success: function () {
                     toastr.success('{{\App\CPU\translate('advertisment status updated successfully')}}');
                 }
             });
         }

     </script>



<script>
    $(document).ready(function() {
        $('#name').hide();
        $('input[type="radio"]').click(function() {
            if ($(this).attr('id') == 'type_div') {
                $('#name').hide();
                $('#governorates').show();
                $('#state_advertis').show();
                $('#job_title').show();
                $('#career_sector').show();
            } else {
                $('#name').show();
                $('#governorates').hide();
                $('#state_advertis').hide();
                $('#job_title').hide();
                $('#career_sector').hide();
            }
        });
    });
</script>


<!-- Page level custom scripts -->
<script>
    // Call the dataTables jQuery plugin
    $(document).ready(function () {
        $('#dataTable').DataTable({
            "pageLength": {{\App\CPU\Helpers::pagination_limit()}}
        });
    });

 </script>



<script>
    $(document).ready(function() {
        $('select[name="career_sector"]').on('change', function() {
            var CareerSectorId = $(this).val();
            if (CareerSectorId) {
                $.ajax({
                    url: "{{ URL::to('admin/selectCareerSector') }}/" + CareerSectorId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="job_title"]').empty().append('<option value="" disabled selected>{{ \App\CPU\translate('name_joptitle') }}</option>');;
                        $.each(data, function(key, value) {
                            $('select[name="job_title"]').append('<option value="' +
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
        $('select[name="state_advertis"]').on('change', function() {
            var StateAdvertisID = $(this).val();
            if (StateAdvertisID) {
                $.ajax({
                    url: "{{ URL::to('admin/selectStateAdvertis') }}/" + StateAdvertisID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="city_advertis"]').empty().append('<option value="" disabled selected>{{ \App\CPU\translate('Select the governorate')}}</option>');
                        $.each(data, function(key, value) {
                            $('select[name="city_advertis"]').append('<option value="' +
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

@endpush
