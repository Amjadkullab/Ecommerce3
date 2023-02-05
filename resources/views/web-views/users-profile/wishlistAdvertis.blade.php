@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('List of favorite ads'))

@section('content')
    <!-- Page Content-->
    <div class="container rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <h3 class="headerTitle my-3 text-center">{{\App\CPU\translate('List of favorite ads')}}</h3>

        <div class="row">
            <!-- Sidebar-->
        @include('web-views.partials._profile-aside')
        <!-- Content  -->
            <section class="col-lg-9 col-md-9" id="set-wish-list">
                <!-- Item-->

                @include('web-views.partials._wish-list-AdvertisData',['wishlists'=>$wishlists])
            </section>
        </div>
    </div>
@endsection



@push('script')
<script>
     function removeWishlist(advertis_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('delete-wishlistAdvertis')}}",
            method: 'POST',
            data: {
                id: advertis_id
            },
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                Swal.fire({
                    type: 'success',
                    title: 'WishList',
                    text: data.success
                });
                $('.countWishlist').html(data.count);
                $('#set-wish-list').html(data.wishlist);
                $('.tooltip').html('');
            },
            complete: function () {
                $('#loading').hide();
            },
        });
    }
</script>
@endpush
