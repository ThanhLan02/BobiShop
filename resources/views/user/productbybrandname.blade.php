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
                        <li><a href="#">Trang chủ</a></li>
                        <li><a href="#">Tất cả hãng sản phẩm</a></li>
                        <li><a href="#">{{ $name }}</a></li>
                        <li class="active">Sản phẩm ({{ $count_all }} Kết quả)</li>
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
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Các loại sản phẩm</h3>
                        <div class="checkbox-filter">
                            @foreach ($categories as $category)
                                <div class="input-checkbox">
                                    @if ($name == $category->name)
                                        <input type="checkbox" id="category-1" checked>
                                    @else
                                        <input type="checkbox" id="category-1">
                                    @endif
                                    <label for="category-1">
                                        <span></span>
                                        <a
                                            href="{{ route('user.productbycatename', $category->name) }}">{{ $category->name }}</a>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Hãng</h3>
                        @foreach ($brands as $brand)
                            <div class="checkbox-filter">
                                <div class="input-checkbox">
                                    @if ($name == $brand->name)
                                        <input type="checkbox" id="brand-1" checked>
                                    @else
                                        <input type="checkbox" id="brand-1">
                                    @endif
                                    <label for="brand-1">
                                        <span></span>
                                        <a
                                            href="{{ route('user.productbybrandname', $brand->name) }}">{{ $brand->name }}</a>
                                    </label>
                                </div>

                            </div>
                        @endforeach
                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Mặt hàng khuyến mãi</h3>
                        @foreach ($product_discount as $key)
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="{{ $key->image }}" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">{{ $key->category->name }}</p>
                                    <h3 class="product-name"><a
                                            href="{{ route('home.product_detail', $key->id) }}">{{ $key->name }}</a></h3>
                                    @if ($key->discount > 0 && $key->discount != 0)
                                        <h4 class="product-price">{{ number_format($key->new_price, 0) }} VNĐ <del
                                                class="product-old-price">{{ number_format($key->old_price, 0) }} VNĐ</del>
                                        </h4>
                                    @else
                                        <h4 class="product-price">{{ number_format($key->old_price, 0) }} VNĐ</h4>
                                    @endif

                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- /aside Widget -->
                </div>
                <!-- /ASIDE -->
                @if (count($products) > 0)
                    <!-- STORE -->
                    <div id="store" class="col-md-9">
                        <!-- store products -->
                        <div class="row">
                            <!-- product -->

                            @foreach ($products as $product)
                                <form action="{{ route('single-add-to-cart', $product->id) }}" method="POST">
                                    @csrf
                                    <div class="col-md-4 col-xs-6">
                                        <div class="product">
                                            <div class="product-img">
                                                <img src="{{ $product->image }}" alt="">
                                                <div class="product-label">
                                                    @if ($product->discount > 0 && $product->discount != null)
                                                        <span class="sale">- {{ $product->discount }} %</span>
                                                    @endif
                                                    <span class="new">{{ $product->condition }}</span>
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category">{{ $product->category->name }}</p>
                                                <h3 class="product-name"><a
                                                        href="{{ route('home.product_detail', $product->id) }}">{{ $product->name }}</a>
                                                </h3>
                                                @if ($product->discount > 0 && $product->discount != null)
                                                    <h4 class="product-price">{{ number_format($product->new_price, 0) }}
                                                        VNĐ<del
                                                            class="product-old-price">{{ number_format($product->old_price, 0) }}
                                                            VNĐ</del></h4>
                                                @else
                                                    <h4 class="product-price">{{ number_format($product->old_price, 0) }}
                                                        VNĐ</h4>
                                                @endif
                                                <div class="product-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="product-btns">
                                                    <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                            class="tooltipp">add to wishlist</span></button>
                                                    <button class="add-to-compare"><i class="fa fa-exchange"></i><span
                                                            class="tooltipp">add to compare</span></button>
                                                    <button class="quick-view"><i class="fa fa-eye"></i><span
                                                            class="tooltipp">quick view</span></button>
                                                </div>
                                            </div>
                                            <div class="add-to-cart">
                                                <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> THÊM VÀO
                                                    GIỎ HÀNG</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix visible-sm visible-xs"></div>
                                </form>
                            @endforeach
                            <!-- /product -->
                        </div>
                        <!-- /store products -->

                        <!-- store bottom filter -->
                        <div class="store-filter clearfix">
                            <span class="store-qty">Showing 9 products</span>
                            {{ $products->links('pagination::bootstrap-4') }}
                        </div>
                        <!-- /store bottom filter -->
                    </div>
                @else
                    <h2>Những mặt hàng thuộc loại <bold>{{ $category->name }}</bold> đã hết!! Vui lòng chờ một thời gian để
                        nhập hàng <br /> Xin chân thành cảm ơn.</h2>
                @endif
                <!-- /STORE -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <br />
    <br />
@endsection
