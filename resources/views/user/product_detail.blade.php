@extends('layout.master')

@section('main-content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="#">Trang Chủ</a></li>
                        <li><a href="#">{{ $product->category->name }}</a></li>
                        <li class="active">{{ $product->name }}</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Product main img -->

                <div class="col-md-5 col-md-push-2">

                    <div id="product-main-img">
                        @if ($product_image->isEmpty())
                            <div class="product-preview">
                                <img src="/storage/photos/1/users/No_Image_Available.jpg" alt="">
                            </div>
                        @else
                            @foreach ($product_image as $image)
                                <div class="product-preview">
                                    <img src="{{ asset($image->url_image) }}" alt="">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <!-- /Product main img -->

                <!-- Product thumb imgs -->
                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">
                        @if ($product_image->isEmpty())
                            <div class="product-preview">
                                <img src="/storage/photos/1/users/No_Image_Available.jpg" alt="">
                            </div>
                        @else
                            @foreach ($product_image as $image)
                                <div class="product-preview">
                                    <img src="{{ asset($image->url_image) }}" alt="">
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
                <!-- /Product thumb imgs -->

                <!-- Product details -->
                <div class="col-md-5">
                    <form action="{{ route('many-add-to-cart', $product->id) }}" method="POST">
                        @csrf
                        <div class="product-details">
                            <h2 class="product-name">{{ $product->name }}</h2>
                            <div>
                                <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <a class="review-link" href="#">{{ $sumuser }} Nhận xét</a>
                            </div>
                            @if ($product->discount != null)
                                <div>
                                    <h3 class="product-price">{{ number_format($product->new_price, 0) }} VNĐ <del
                                            class="product-old-price">{{ number_format($product->old_price, 0) }} VNĐ</del>
                                    </h3>
                                    <span class="product-available">CÓ SẴN TẠI KHO</span>
                                </div>
                            @else
                                <div>
                                    <h3 class="product-price">{{ number_format($product->old_price, 0) }} VNĐ </h3>
                                    <span class="product-available">CÓ SẴN TẠI KHO</span>
                                </div>
                            @endif
                            @if ($product->quantity > 0)
                                <div class="add-to-cart">
                                    <div class="qty-label">
                                        <span style="font-weight: bold">Số Lượng</span>
                                        <div class="input-number">
                                            <input type="number" name="quantity" value="1">
                                        </div>
                                    </div>
                                    <button type="submit" class="add-to-cart-btn" style="margin-left: 90px"><i
                                            class="fa fa-shopping-cart"></i> Thêm
                                        vào giỏ</button>
                                </div>
                            @else
                                <h1>Hết hàng</h1>
                            @endif
                            <ul class="product-btns">
                                <li><a href="#"><i class="fa fa-heart-o"></i> Thêm vào danh sách yêu thích</a></li>
                            </ul>

                            <ul class="product-links">
                                <li><a href="#"><span style="font-weight: bold">Loại</span> :
                                        {{ $product->category->name }}</a></li>
                                <li><a href="#"><span style="font-weight: bold">Hãng</span> :
                                        {{ $product->brand->name }}</a></li>
                            </ul>

                            <ul class="product-links">
                                <li style="font-weight: bold">Share :</li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                            </ul>

                        </div>
                    </form>
                </div>
                <!-- /Product details -->

                <!-- Product tab -->
                <div class="col-md-12">
                    <div id="product-tab">
                        <!-- product tab nav -->
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Mô Tả</a></li>
                            <li><a data-toggle="tab" href="#tab2">Thông tin</a></li>
                            <li><a data-toggle="tab" href="#tab3">Nhận Xét ({{ $sumuser }})</a></li>
                        </ul>
                        <!-- /product tab nav -->

                        <!-- product tab content -->
                        <div class="tab-content">
                            <!-- tab1  -->
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-12">
                                        <pre>{{ $product->description }}</pre>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab1  -->

                            <!-- tab2  -->
                            <div id="tab2" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-md-12">
                                        <pre>
                                        <p style="font-weight: bold;">Danh mục : <label>{{ $product->category->name }}</label></p>
                                        <p style="font-weight: bold;">Số lượng : <label>{{ $product->quantity }}</label></p>
                                        <p style="font-weight: bold;">Thương hiệu : <label>{{ $product->brand->name }}</label></p>
                                        <p style="font-weight: bold;">Độ tuổi khuyến nghị : <label>6 - 14 tuổi</label></p>
                                        <p style="font-weight: bold;">Gửi từ : <label>TP Hồ Chí Minh</label></p>
                                    </pre>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab2  -->

                            <!-- tab3  -->
                            <div id="tab3" class="tab-pane fade in">
                                <div class="row">
                                    <!-- Rating -->
                                    <div class="col-md-3">
                                        <div id="rating">
                                            <div class="rating-avg">
                                                <span>{{ number_format($avgstar, 2) }}</span>
                                                <div class="rating-stars">
                                                    @if ($avgstar == 5)
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    @elseif($avgstar >= 4)
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    @elseif($avgstar >= 3)
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    @elseif($avgstar >= 2)
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    @elseif($avgstar >= 1)
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    @else
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    @endif

                                                </div>
                                            </div>
                                            <ul class="rating">
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    @foreach ($starCounts as $star)
                                                        @if ($star->rate == 5 && $sumuser > 0)
                                                            <div class="rating-progress">
                                                                <div
                                                                    style="width: {{ ($star->count / $sumuser) * 100 }}%;">
                                                                </div>
                                                            </div>
                                                            <span class="sum">

                                                                {{ $star->count }}

                                                            </span>
                                                        @endif
                                                    @endforeach
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    @foreach ($starCounts as $star)
                                                        @if ($star->rate == 4 && $sumuser > 0)
                                                            <div class="rating-progress">
                                                                <div
                                                                    style="width: {{ ($star->count / $sumuser) * 100 }}%;">
                                                                </div>
                                                            </div>
                                                            <span class="sum">

                                                                {{ $star->count }}

                                                            </span>
                                                        @endif
                                                    @endforeach
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    @foreach ($starCounts as $star)
                                                        @if ($star->rate == 3 && $sumuser > 0)
                                                            <div class="rating-progress">
                                                                <div
                                                                    style="width: {{ ($star->count / $sumuser) * 100 }}%;">
                                                                </div>
                                                            </div>
                                                            <span class="sum">

                                                                {{ $star->count }}

                                                            </span>
                                                        @endif
                                                    @endforeach
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    @foreach ($starCounts as $star)
                                                        @if ($star->rate == 2 && $sumuser > 0)
                                                            <div class="rating-progress">
                                                                <div
                                                                    style="width: {{ ($star->count / $sumuser) * 100 }}%;">
                                                                </div>
                                                            </div>
                                                            <span class="sum">

                                                                {{ $star->count }}

                                                            </span>
                                                        @endif
                                                    @endforeach
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    @foreach ($starCounts as $star)
                                                        @if ($star->rate == 1 && $sumuser > 0)
                                                            <div class="rating-progress">
                                                                <div
                                                                    style="width: {{ ($star->count / $sumuser) * 100 }}%;">
                                                                </div>
                                                            </div>
                                                            <span class="sum">

                                                                {{ $star->count }}
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /Rating -->

                                    <!-- Reviews -->
                                    <div class="col-md-6">
                                        <div id="reviews">
                                            <ul class="reviews">
                                                @foreach ($reviews as $key)
                                                    <li>
                                                        <div class="review-heading">
                                                            @if ($key->users->image == '')
                                                                <img style="border-radius: 30%;width: 50px;height:50px;"
                                                                    src="/storage/photos/1/users/user.png"
                                                                    alt="logo_user">
                                                            @else
                                                                <img style="border-radius: 30%;width: 50px;height:50px;"
                                                                    src="{{ $key->users->image }}" alt="logo_user">
                                                            @endif
                                                            <h5 class="name">{{ $key->users->name }}</h5>
                                                            <div class="review-rating">

                                                                @if ($key->rate == 5)
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                @elseif($key->rate == 4)
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                @elseif($key->rate == 3)
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                @elseif($key->rate == 2)
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                @elseif($key->rate == 1)
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                    <i class="fa fa-star-o"></i>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="review-body">
                                                            <p>{{ $key->review }}</p>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="text-center">{{ $reviews->links('pagination::bootstrap-4') }}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Reviews -->

                                    <!-- Review Form -->
                                    <div class="col-md-3">
                                        <form class="review-form" action="{{ route('user.submitreview') }}"
                                            method="POST">
                                            @csrf
                                            <div id="review-form">
                                                <input name="product_id" style="display: none;"
                                                    value="{{ $product->id }}" type="text">
                                                <textarea class="input" placeholder="Nhận xét của bạn" name="review"></textarea>
                                                <div class="input-rating">
                                                    <span>Đánh giá: </span>
                                                    <div class="stars">
                                                        <input id="star5" name="rate" value="5"
                                                            type="radio"><label for="star5"></label>
                                                        <input id="star4" name="rate" value="4"
                                                            type="radio"><label for="star4"></label>
                                                        <input id="star3" name="rate" value="3"
                                                            type="radio"><label for="star3"></label>
                                                        <input id="star2" name="rate" value="2"
                                                            type="radio"><label for="star2"></label>
                                                        <input id="star1" name="rate" value="1"
                                                            type="radio"><label for="star1"></label>
                                                    </div>
                                                </div>
                                                <button type="submit" class="primary-btn btn">Đánh giá</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /Review Form -->
                                </div>
                            </div>
                            <!-- /tab3  -->
                        </div>
                        <!-- /product tab content  -->
                    </div>
                </div>
                <!-- /product tab -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- Section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3 class="title">Một số sản phẩm khác</h3>
                    </div>
                </div>

                <!-- product -->
                @foreach ($product_other as $key)
                    <form action="{{ route('single-add-to-cart', $key->id) }}" method="POST">
                        @csrf
                        <div class="col-md-3 col-xs-6">
                            <div class="product">
                                <div class="product-img">
                                    <img src="{{ $key->image }}" alt="">
                                    <div class="product-label">
                                        @if ($key->discount != null)
                                            <span class="sale">- {{ $key->discount }} %</span>
                                        @endif
                                        <span class="new">{{ $key->condition }}</span>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <p class="product-category">{{ $key->category->name }}</p>
                                    <h3 class="product-name"><a
                                            href="{{ route('home.product_detail', $product->id) }}">{{ $key->name }}</a>
                                    </h3>
                                    @if ($key->discount != null || $key->discount > 0)
                                        <h4 class="product-price">{{ number_format($key->new_price, 0) }} VNĐ</h4> <del
                                            class="key-old-price">{{ number_format($key->old_price, 0) }} VNĐ</del>
                                    @else
                                        <h4 class="product-price">{{ number_format($key->old_price, 0) }} VNĐ</h4>
                                    @endif
                                    <div class="product-rating">
                                    </div>
                                    <div class="product-btns">
                                        <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                class="tooltipp">add to wishlist</span></button>
                                        <button class="add-to-compare"><i class="fa fa-exchange"></i><span
                                                class="tooltipp">add to compare</span></button>
                                        <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick
                                                view</span></button>
                                    </div>
                                </div>
                                <div class="add-to-cart">
                                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ
                                        hàng</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix visible-sm visible-xs"></div>
                @endforeach
                <!-- /product -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /Section -->
@endsection
