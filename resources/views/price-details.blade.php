@extends('layouts.front')
@section('title')
    Price Details
@endsection
@section('content')
<section class="pricing_sec">
    <div class="container">
        <h2 class="home_head">Easy and Proper Learning</h2>
        <p class="home_para">Education is the passport to the future, for tomorrow belongs to those who prepare for it today.</p>
        <p class="home_para">
            <label>Till June</label>
            <select class="form-control" onchange="getPrice()" id="year">
                @foreach($prices as $price)
                <option value="{{$price->year}}">{{$price->year}}</option>
                @endforeach
            </select>
        </p>
        <div class="pricing-grids">

            {{--<div class="pricing-grid2">
                <div class="price-value two">
                    <h3><a href="#">SILVER</a></h3>
                    <h5>
                        <lable style="font-size:30px"><i class="fa fa-rupee"></i><b id="silver">/-</b></lable>
                    </h5>
                    <div class="sale-box two">
                        <span class="on_sale title_shop">NEW</span>
                    </div>

                </div>
                <div class="price-bg">
                    <ul>
                        <li class="whyt"><a href="#">Videos </a></li>
                        <li><a href="#">Practice</a></li>
                        --}}{{--<li><a href="#">20 Domain Names</a></li>--}}{{--
                        --}}{{--<li class="whyt"><a href="#">10 E-Mail Address </a></li>--}}{{--
                        --}}{{--<li><a href="#">100GB Monthly Bandwidth </a></li>--}}{{--
                        --}}{{--<li class="whyt"><a href="#">Fully Support</a></li>--}}{{--
                    </ul>
                    <div class="cart2" style="padding: 0.7em 0em 2.7em;">
                        <a class="popup-with-zoom-anim" href="javascript:void(0)" onclick="payment()">Buy Now</a>
                    </div>
                </div>
            </div>--}}
            <div class="pricing-grid2">
                <div class="price-value two">
                    <h3><a href="#">GOLD</a></h3>
                    <h5>
                        <lable style="font-size:30px;"><i class="fa fa-rupee"></i><b id="gold">/-</b></lable>
                    </h5>
                   

                </div>
                <div class="price-bg">
                    <ul>
                        <li class="whyt"><a href="#">Practice </a></li>
                        <li><a href="#">Test Series</a></li>
                        {{--<li class="whyt"><a href="#">10 E-Mail Address </a></li>--}}
                        {{--<li><a href="#">100GB Monthly Bandwidth </a></li>--}}
                        {{--<li class="whyt"><a href="#">Fully Support</a></li>--}}
                    </ul>
                    <div class="cart2">
                        <a class="popup-with-zoom-anim" data-toggle="modal" data-target="#payment_detail" href="javascript:void(0)">Buy Now</a>
                        {{--<a class="popup-with-zoom-anim" href="javascript:void(0)" onclick="payment()">Buy Now</a>--}}
                    </div>
                </div>
            </div>
            <div class="pricing-grid2">
                <div class="price-value two">
                    <h3><a href="#">DIAMOND</a></h3>
                    <h5>
                        <lable style="font-size:30px;"><i class="fa fa-rupee"></i><b id="diamond">/-</b></lable>
                    </h5>
                    <div class="sale-box two">
                        <span class="on_sale title_shop">NEW</span>
                    </div>

                </div>
                <div class="price-bg">
                    <ul>
                        <li class="whyt"><a href="#">Videos </a></li>
                        <li><a href="#">Practice</a></li>
                        <li class="whyt"><a href="#">Test Series </a></li>
                        {{--<li><a href="#">100GB Monthly Bandwidth </a></li>--}}
                        {{--<li class="whyt"><a href="#">Fully Support</a></li>--}}
                    </ul>
                    <div class="cart2">
                        {{--<a class="popup-with-zoom-anim" href="javascript:void(0)" onclick="payment()">Buy Now</a>--}}
                        <a class="popup-with-zoom-anim" data-toggle="modal" data-target="#payment_detail" href="javascript:void(0)">Buy Now</a>
                    </div>
                </div>
            </div>
            <div class="pricing-grid2">
                <div class="price-value two">
                    <h3><a href="#">PLATINUM</a></h3>
                    <h5>
                        <lable><b id="platinum"></b></lable>
                    </h5>
                    <div class="sale-box two">
                        <!--<span class="on_sale title_shop">NEW</span>-->
                    </div>

                </div>
                <div class="price-bg">
                    <ul>
                        <li class="whyt"><a href="#">Videos </a></li>
                        <li><a href="#">Practice</a></li>
                        <li class="whyt"><a href="#">Test Series </a></li>
                        <li><a href="#">Doubts </a></li>
                        {{--<li class="whyt"><a href="#">Fully Support</a></li>--}}
                    </ul>
                    <div class="cart2">
                        {{--<a class="popup-with-zoom-anim" href="javascript:void(0)" onclick="payment()">Buy Now</a>--}}
                        <a class="popup-with-zoom-anim" data-toggle="modal" data-target="#payment_detail" href="javascript:void(0)">Buy Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
    $(document).ready(function(){
        getPrice();
    });

    function payment(){
        Swal.fire({
            title:'Payment',
            imageUrl: '{{url("/public/theme1/images/payment.png")}}',
            imageAlt: 'UPI QR CODE'
        })
    }

    function getPrice() {
        var year = $('#year').val();
        $.ajax({
            url:"{{url('get/price')}}",
            data:{
                year:year
            },
            success:function (result) {
                //$('#silver').text(result.silver);
                $('#gold').text(result.gold);
                $('#diamond').text(result.diamond);
                $('#platinum').text(result.platinum);

            }
        });
    }
</script>
@endsection