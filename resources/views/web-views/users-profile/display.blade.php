@extends('layouts.front-end.app')





@section('title', \App\CPU\translate('show_advertisment'))

@push('css_or_js')
    <meta property="og:image" content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo'] }}" />
    <meta property="og:title" content="Products of {{ $web_config['name'] }} " />
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:description" content="{!! substr($web_config['about']->value, 0, 100) !!}">

    <meta property="twitter:card" content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo'] }}" />
    <meta property="twitter:title" content="Products of {{ $web_config['name'] }}" />
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value, 0, 100) !!}">

    <style>
        .headerTitle {
            font-size: 26px;
            font-weight: bolder;
            margin-top: 3rem;
        }

        .for-count-value {
            position: absolute;

            {{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}: 0.6875 rem;
            ;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 50%;

            color: black;
            font-size: .75rem;
            font-weight: 500;
            text-align: center;
            line-height: 1.25rem;
        }

        .for-count-value {
            position: absolute;

            {{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}: 0.6875 rem;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 50%;
            color: #fff;
            font-size: 0.75rem;
            font-weight: 500;
            text-align: center;
            line-height: 1.25rem;
        }

        .for-brand-hover:hover {
            color: {{ $web_config['primary_color'] }};
        }

        .for-hover-lable:hover {
            color: {{ $web_config['primary_color'] }} !important;
        }

        .page-item.active .page-link {
            background-color: {{ $web_config['primary_color'] }} !important;
        }

        .page-item.active>.page-link {
            box-shadow: 0 0 black !important;
        }

        .for-shoting {
            font-weight: 600;
            font-size: 14px;
            padding- {{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}: 9px;
            color: #030303;
        }

        .sidepanel {
            width: 0;
            position: fixed;
            z-index: 6;
            height: 500px;
            top: 0;
            {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}: 0;
            background-color: #ffffff;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 40px;
        }

        .sidepanel a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidepanel a:hover {
            color: #f1f1f1;
        }

        .sidepanel .closebtn {
            position: absolute;
            top: 0;
            {{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}: 25 px;
            font-size: 36px;
        }

        .openbtn {
            font-size: 18px;
            cursor: pointer;
            background-color: transparent !important;
            color: #373f50;
            width: 40%;
            border: none;
        }

        .openbtn:hover {
            background-color: #444;
        }

        .for-display {
            display: block !important;
        }

        @media (max-width: 360px) {
            .openbtn {
                width: 59%;
            }

            .for-shoting-mobile {
                margin- {{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}: 0% !important;
            }

            .for-mobile {

                margin- {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}: 10% !important;
            }

        }

        @media (max-width: 500px) {
            .for-mobile {

                margin- {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}: 27%;
            }

            .openbtn:hover {
                background-color: #fff;
            }

            .for-display {
                display: flex !important;
            }

            .for-tab-display {
                display: none !important;
            }

            .openbtn-tab {
                margin-top: 0 !important;
            }

        }

        @media screen and (min-width: 500px) {
            .openbtn {
                display: none !important;
            }


        }

        @media screen and (min-width: 800px) {


            .for-tab-display {
                display: none !important;
            }

        }

        @media (max-width: 768px) {
            .headerTitle {
                font-size: 23px;

            }

            .openbtn-tab {
                margin-top: 3rem;
                display: inline-block !important;
            }

            .for-tab-display {
                display: inline;
                justify-content: right
            }
        }

        @if (Session::get('direction') === 'rtl').direction_advertis {
            display: flex;
            justify-content: right;
            width: 100%
        }

        .advertis-view-img {
            margin-left: 1rem;
            height: 10rem;
        }

        .advertis-view-body {
            margin-top: 1rem;
        }

        .advertis-view-body>.advertis-view-body-a {
            /* position: absolute; */
            /* bottom: 3rem; */
        }

        @endif
        @if (Session::get('direction') === 'ltr').direction_advertis {
            display: flex;
            justify-content: :left;
            width: 100%
        }

        .advertis-view-img {
            margin-right: 1rem;
            height: 10rem;
        }

        .advertis-view-body {
            margin-top: 1rem;
        }

        .advertis-view-body>.advertis-view-body-a {
            /* position: absolute; */
            /* bottom: 3rem; */
        }

        @endif
        @media (max-width:500px) {
            @if (Session::get('direction') === 'rtl').advertis-view-img {
                margin-left: 0.5rem;
                height: 8rem;
                margin-top: 2px
            }

            .advertis-view-body {
                margin-top: 0.5rem;
            }

            .advertis-view-body>.advertis-view-body-a {
                /* position: absolute;
                            bottom: 2rem; */
            }

            .advertis-view-body .advertis-view-body-p {

                margin: 0;
                font-size: 15px
            }

            @endif
            @if (Session::get('direction') === 'ltr').advertis-view-img {
                margin-right: 0.5rem;
                height: 8rem;
                margin-top: 2px
            }

            .advertis-view-body {
                margin-top: 0.5rem;
            }

            .advertis-view-body>.advertis-view-body-a {
                /* position: absolute;
                            bottom: 2rem; */
            }

            .advertis-view-body .advertis-view-body-p {

                margin: 0;
                font-size: 15px
            }

            @endif
        }
    </style>
@endpush

@section('content')
    <div class="container mb-md-4">

        @php($decimal_point_settings = \App\CPU\Helpers::get_business_settings('decimal_point_settings'))
        <!-- Page Title-->
        <div class="d-flex justify-content-center align-items-center mb-3"
            style="min-height: 70px;background:{{ $web_config['primary_color'] }}10;width:100%;">

         

        </div>


        <!-- Page Content-->
        <div class="container pb-5 mb-2 mb-md-4 rtl"
            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
            <div class="row">
                <!-- Sidebar-->
                <aside
                    class="col-lg-3 hidden-xs col-md-3 col-sm-4 SearchParameters {{ Session::get('direction') === 'rtl' ? 'pl-2' : 'pr-2' }}"
                    id="SearchParameters">
                    <!--Price Sidebar-->
                    <div class="cz-sidebar  box-shadow-lg" id="shop-sidebar"
                        style="margin-bottom: -10px;border-radius: 5px;">
                        <div class="cz-sidebar-header box-shadow-sm">
                            <button class="close {{ Session::get('direction') === 'rtl' ? 'mr-auto' : 'ml-auto' }}"
                                type="button" data-dismiss="sidebar" aria-label="Close"><span
                                    class="d-inline-block font-size-xs font-weight-normal align-middle">{{ \App\CPU\translate('Dashboard') }}Close
                                    sidebar</span><span
                                    class="d-inline-block align-middle {{ Session::get('direction') === 'rtl' ? 'mr-2' : 'ml-2' }}"
                                    aria-hidden="true">&times;</span></button>
                        </div>


                        <div class="mt-2">
                            <div class="text-center">
                                <div style="border-bottom: 1px solid #F3F5F9;padding:17px;border-top: 1px solid #F3F5F9;">
                                    <span class="widget-title"
                                        style="font-weight: 700;">{{ \App\CPU\translate('filter') }}</span>
                                </div>
                                <form action="{{ route('fillterAdvertisWebSite') }}" method="get" role="search" autocomplete="off">
                                    @csrf
                                    <div class="input-group-overlay input-group-sm"
                                        style="width: 100%;padding: 14px;padding-top: 30px; ">


                                        <select dir="{{Session::get('direction') === "rtl" ? 'rtl' : 'ltr'}}" name="career_sector" class="js-example-basic-single js-states js-example-responsive form-control color-var-select"
                                                required>
                                                <option value="{{ $type ??  \App\CPU\translate('name_carrer_sector')}} " disabled selected>
                                                    {{ $type ?? \App\CPU\translate('name_carrer_sector') }}
                                                </option>
                                                @foreach ($CareerSector as $CareerSectors)
                                                    <option value="{{ $CareerSectors->id }}">{{ $CareerSectors->name }}</option>
                                                @endforeach
                                        </select>

                                    </div>
                                    <div class="input-group-overlay input-group-sm"
                                        style="width: 100%;padding: 14px;padding-top: 30px; ">


                                            <select dir="{{Session::get('direction') === "rtl" ? 'rtl' : 'ltr'}}" class="form-control" name="job_title"
                                                required>
                                                <option value="{{\App\CPU\translate('name_joptitle')}}" disabled selected>
                                                    {{\App\CPU\translate('name_joptitle')}}
                                                </option>
                                                {{-- @foreach ($JobTitle as $JobTitles)
                                                    <option value="{{ $JobTitles->id }}">{{ $JobTitles->name }}</option>
                                                @endforeach --}}
                                            </select>
                                    </div>
                                    <div class="input-group-overlay input-group-sm"
                                        style="width: 100%;padding: 14px;padding-top: 30px; ">


                                            <select dir="{{Session::get('direction') === "rtl" ? 'rtl' : 'ltr'}}" class="form-control" name="state_advertis"
                                                >
                                                <option value="" disabled selected>
                                                    {{ $type ?? \App\CPU\translate('state') }}
                                                </option>
                                                @foreach ($stateAdvertis as $stateAdvertises)
                                                    <option value="{{ $stateAdvertises->id }}">{{ $stateAdvertises->name }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="input-group-overlay input-group-sm"
                                        style="width: 100%;padding: 14px;padding-top: 30px; ">

                                            <select dir="{{Session::get('direction') === "rtl" ? 'rtl' : 'ltr'}}" class="form-control" name="city_advertis"
                                                >
                                                <option value="" disabled selected>
                                                    {{ $type ?? \App\CPU\translate('governorate') }}
                                                </option>
                                                {{-- @foreach ($governorate as $governorates)
                                                    <option value="{{ $governorates->id }}">{{ $governorates->name }}</option>
                                                @endforeach --}}
                                            </select>
                                    </div>
                                    <div class="input-group-overlay input-group-sm"
                                        style="width: 100%;padding: 14px;padding-top: 30px; ">

                                        <button class="btn btn-primary btn-block">{{\App\CPU\translate('Filiter_')}}</button>
                                    </div>





                                </form>




                            </div>
                        </div>

                    </div>




                </aside>
                <div id="mySidepanel" class="sidepanel">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                    <aside class="" style="padding-right: 5%;padding-left: 5%;">
                        <div class="" id="shop-sidebar" style="margin-bottom: -10px;">
                            <div class=" box-shadow-sm">

                            </div>
                            <div class="" style="padding-top: 12px;">
                                <!-- Filter -->
                                <div class="widget cz-filter" style="width: 100%">
                                    <div style="text-align: center">
                                        <span class="widget-title"
                                            style="font-weight: 600;">{{ \App\CPU\translate('filter') }}</span>
                                    </div>
                                    <form action="{{ route('fillterAdvertisWebSite') }}" method="get" role="search" autocomplete="off">
                                    @csrf
                                    <div class="input-group-overlay input-group-sm"
                                        style="width: 100%;padding: 14px;padding-top: 30px; ">

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

                                    </div>
                                    <div class="input-group-overlay input-group-sm"
                                        style="width: 100%;padding: 14px;padding-top: 30px; ">

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
                                    </div>
                                    <div class="input-group-overlay input-group-sm"
                                        style="width: 100%;padding: 14px;padding-top: 30px; ">

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
                                    </div>
                                    <div class="input-group-overlay input-group-sm"
                                        style="width: 100%;padding: 14px;padding-top: 30px; ">

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
                                    </div>
                                    <div class="input-group-overlay input-group-sm"
                                        style="width: 100%;padding: 14px;padding-top: 30px; ">

                                        <button class="btn btn-primary btn-block">{{\App\CPU\translate('search')}}</button>
                                    </div>





                                </form>

                                </div>
                            </div>
                        </div>


                    </aside>
                </div>

                <!-- Content  -->
                <section class="col-lg-9">
                    {{-- <div class="col-md-9"> --}}
                    <div class="row mb-3" style="background: rgba(26, 29, 231, 0.068);margin:0px;border-radius:5px;">
                        <div class="col-md-6 d-flex  align-items-center">
                            {{-- if need data from also --}}
                            {{-- <h1 class="h3 text-dark mb-0 headerTitle text-uppercase">{{\App\CPU\translate('product_by')}} {{$data['data_from']}} ({{ isset($brand_name) ? $brand_name : $data_from}})</h1> --}}
                            <h1 class="{{ Session::get('direction') === 'rtl' ? 'mr-3' : 'ml-3' }}">

                                {{-- <label id="price-filter-count"> {{$products->total()}} {{\App\CPU\translate('items found')}} </label> --}}
                            </h1>
                        </div>
                        <div class="col-md-6 m-2 m-md-0 d-flex  align-items-center ">

                            <button class="openbtn text-{{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}"
                                onclick="openNav()">
                                <div>
                                    <i class="fa fa-filter"></i>
                                    {{ \App\CPU\translate('filter') }}
                                </div>
                            </button>

                           <div class="container pb-4 mb-1 mb-md-3 mt-2">
                                <div class="col-md-15">
                                    <form action="{{ route('search-jop') }}" style="background-color: #818181">
                                        @csrf
                                        <div class="input-group mb-8">
                                            <input type="text" class="form-control"
                                                placeholder="{{ \App\CPU\translate('advertisment_name1') }}"
                                                name="name" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary"
                                                    type="submit">{{ \App\CPU\translate('Search') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>





                    </div>

                    <div class="container pb-5 mb-2 mb-md-4 mt-3 rtl"
                        style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">

                        <div class="row">
                            <!-- advertis grid-->
                            @foreach ($Advertis as $shop)
                                <div class="col-lg-12 px-2 pb-4">
                                    <div class="card-body shadow" style="width: 100%">
                                        <p
                                            class="mb-0 float-{{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}">
                                            {{ $shop->created_at }}</p>
                                    </div>
                                    <div class="direction_advertis">
                                        @if ($shop->image)
                                        <img style="vertical-align: middle; border-radius: 3%;" class="advertis-view-img"
                                            onerror="this.src='{{ asset('public/assets/front-end/img/image-place-holder.png') }}'"
                                            src="{{asset('public/uploads/'.$shop->image[0]) }}" alt="{{ $shop->name }}">
                                        @else
                                        <img style="vertical-align: middle; border-radius: 3%;" class="advertis-view-img"
                                            onerror="this.src='{{ asset('public/assets/front-end/img/image-place-holder.png') }}'"
                                            src="" alt="{{ $shop->name }}">
                                        @endif


                                        <div class="advertis-view-body">

                                            <div class="text-dark">
                                                <h1 class="font-weight-bold small">{{ Str::limit($shop->name, 14) }}</h1>
                                                <p class="advertis-view-body-p">{{ $shop->CareerSector->name }} |
                                                    {{ $shop->JobTitle->name }} | {{ $shop->advertiseType->name }}</p>
                                                <p class=""> {{ \App\CPU\translate('Vacancies_in') }}
                                                    {{ $shop->StateAdvertis->name }} {{ \App\CPU\translate('in') }}
                                                    {{ $shop->CityAdvertis->name }}</p>
                                            </div>
                                            <div class="col-md-8" style="top: 10%">
                                                <div class="advertis-view-body">
                                                    <a href="{{ route('desblayAdvertisement', $shop->id) }}"
                                                        class="btn btn-primary btn-sm"
                                                        style="margin-top:0px;padding-top:5px;padding-bottom:10px;padding-left:10px;padding-right:10px;bottom:40;">{{ \App\CPU\translate('show_advertism_detail') }}</a>
                                                </div>
                                                <div class="advertis-view-body"
                                                    style="text-align:center;text-align: left; position: absolute;left:0;top: 15px;right:80%;">
                                                    <div
                                                        class="topbar-text dropdown d-md-none {{ Session::get('direction') === 'rtl' ? 'mr-auto' : 'ml-auto' }}">
                                                        <a class="topbar-link"
                                                            href="tel: {{ $web_config['phone']->value }}">
                                                            <i class="fa fa-phone"></i> {{ $web_config['phone']->value }}
                                                        </a>
                                                    </div>
                                                    <div
                                                        class="d-none d-md-block {{ Session::get('direction') === 'rtl' ? 'mr-2' : 'mr-2' }} text-nowrap">
                                                        <a class="topbar-link d-none d-md-inline-block"
                                                            href="tel:{{ $web_config['phone']->value }}">
                                                            <i class="fa fa-phone"></i> {{ $web_config['phone']->value }}
                                                        </a>
                                                    </div>
                                                </div>



                                                <div class="col-md-9"
                                                    style="margin-right: 10px;position: relative;text-align:center;text-align: left; position: absolute;right:0%;top: 15px;">
                                                    <span
                                                        style="font-weight: 400;"class=" font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{ Session::get('direction') === 'rtl' ? 'mr-1 ml-md-2 ml-0 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-0 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1' }} text-capitalize">
                                                    </span>

                                                    <button type="button" onclick="addWishlistAdvertis('{{ $shop['id'] }}')"
                                                        class="btn for-hover-bg"
                                                        style="color:{{ $web_config['secondary_color'] }};font-size: 18px;">
                                                        <i class="fa fa-heart-o " aria-hidden="true"></i>
                                                    </button><br>
                                                    <div
                                                        class="{{ Session::get('direction') === 'rtl' ? 'pr-2' : 'pl-2' }}">
                                                        <br>
                                                        <div class="d-flex mb-3 mb-md-0 align-items-center">
                                                            <h5 class="font-name"></h5>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @endforeach
                        </div>

                    </div>







                </section>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function openNav() {
            document.getElementById("mySidepanel").style.width = "70%";
            document.getElementById("mySidepanel").style.height = "100vh";
        }

        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }





        $('#searchByFilterValue, #searchByFilterValue-m').change(function() {
            var url = $(this).val();
            if (url) {
                window.location = url;
            }
            return false;
        });

        $("#search-brand").on("keyup", function() {
            var value = this.value.toLowerCase().trim();
            $("#lista1 div>li").show().filter(function() {
                return $(this).text().toLowerCase().trim().indexOf(value) == -1;
            }).hide();
        });
    </script>


    <script>
        function featured_status(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('saveAdvertisment') }}",
                method: 'PUT',
                data: {
                    id: id
                },
                success: function() {
                    toastr.success('{{ \App\CPU\translate('advertisment status updated successfully') }}');
                }
            });
        }
    </script>


    <script>
        function addWishlistAdvertis(advertis_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('saveAdvertisment')}}",
            method: 'POST',
            data: {
                advertis_id: advertis_id
            },
            success: function (data) {
                if (data.value == 1) {
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: data.success,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('.tooltip').html('');

                } else if (data.value == 2) {
                    Swal.fire({
                        type: 'info',
                        title: 'WishList',
                        text: data.error
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'WishList',
                        text: data.error
                    });
                }
            }
        });
    }
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
