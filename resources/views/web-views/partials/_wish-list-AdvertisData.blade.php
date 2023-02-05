
@if($wishlists->count()>0)
    @foreach($wishlists as $wishlist)
        @php($advertis = $wishlist->Advertis_full_info)
        @if( $wishlist->Advertis_full_info)
            <div class="card __card __card-mobile-340 mb-3">
                <div class="product">
                    <div class="card">
                        <div class="row g-2">
                            <div class="wishlist_product_img col-md-4 col-xl-2 col-lg-3 col-sm-4">
                                <a href="{{route('desblayAdvertisement',$advertis->id)}}" class="d-block h-100">
                                    <img class="__img-full"
                                     src="{{ asset('public/uploads/'.$advertis->image[0]) }}"
                                    onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'" alt="wishlist" >
                                </a>
                            </div>
                            <div class="wishlist_product_desc align-self-center col-sm-8 col-md-8 col-xl-10 col-lg-9 py-3 px-sm-4">
                                <div class="font-name">
                                    <a href="{{route('desblayAdvertisement',$advertis->id)}}" style="text-align: center;width:100">{{$advertis['name']}}</a>
                                </div> <br>
                                <br>
                                {{-- @if($brand_setting)
                                <span class="sellerName"> {{\App\CPU\translate('Brand')}} :{{$advertis->brand?$advertis->brand['name']:''}} </span>
                                @endif --}}

                                {{-- <div class="">
                                    @if($advertis->discount > 0)
                                    <strike style="color: #E96A6A;" class="{{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-3'}}">
                                        {{\App\CPU\Helpers::currency_converter($advertis->unit_price)}}
                                    </strike>
                                @endif
                                <span
                                    class="font-weight-bold amount">{{\App\CPU\Helpers::get_price_range($advertis) }}</span>
                                </div> --}}


                                <div class="col-md-8" style="top: 10%">
                                    <div class="advertis-view-body">
                                        <a href="{{ route('desblayAdvertisement', $advertis->id) }}"
                                            class="btn btn-primary btn-sm"
                                            style="margin-top:0px;padding-top:5px;padding-bottom:10px;padding-left:10px;padding-right:10px;bottom:40;">{{ \App\CPU\translate('show_advertism_detail') }}</a>
                                    </div>
                                </div>
                            </div>
                            <a href="javascript:" class="wishlist_product_icon">
                                <i class="czi-close-circle" onclick="removeWishlist('{{$advertis['id']}}')"
                                    style="color: red"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <span class="badge badge-danger">{{\App\CPU\translate('item_removed')}}</span>
        @endif
    @endforeach
@else
    <center>
        <h6 class="text-muted">
            {{\App\CPU\translate('No data found')}}.
        </h6>
    </center>
@endif
