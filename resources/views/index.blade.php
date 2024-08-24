@extends('layout.master')

@section('main-content')
	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- shop -->
				<div class="col-md-4 col-xs-6">
					<div class="shop">
						<div class="shop-img">
							<img src="/storage/photos/1/thumbs/thumb3.jpg" alt="">
						</div>
						<div class="shop-body">
							<h3>TẤT CẢ<br>SẢN PHẨM</h3>
							<a href="/allproduct" class="cta-btn">XEM THỬ <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- /shop -->

				<!-- shop -->
				<div class="col-md-4 col-xs-6">
					<div class="shop">
						<div class="shop-img">
							<img src="/storage/photos/1/thumbs/thumb1.jpe" alt="" >
						</div>
						<div class="shop-body">
							<h3>TẤT CẢ<br>BEYBLADE</h3>
							<a href="/productbycatename/BEYBLADE" class="cta-btn">XEM THỬ <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- /shop -->

				<!-- shop -->
				<div class="col-md-4 col-xs-6">
					<div class="shop">
						<div class="shop-img">
							<img src="/storage/photos/1/thumbs/thumb2.jpg" alt="">
						</div>
						<div class="shop-body">
							<h3>MỘT SỐ<br>LOẠI KHÁC</h3>
							<a href="#" class="cta-btn">XEM THỬ <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- /shop -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">

				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h3 class="title">MỘT SỐ SẢN PHẨM MỚI</h3>
						<div class="section-nav">
							<ul class="section-tab-nav tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">New</a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /section title -->

				<!-- Products tab & slick -->
				<div class="col-md-12">
					<div class="row">
						<div class="products-tabs">
							<!-- tab -->
							<div id="tab1" class="tab-pane active">
								<div class="products-slick" data-nav="#slick-nav-1">
									<!-- product -->
									 @foreach($product_news as $product)
									<form action="{{ route('single-add-to-cart',$product->id) }}" method="POST" >
									@csrf
									<div class="product">
										<div class="product-img">
											<img src="{{$product->image}}" alt="">
											<div class="product-label">
												@if($product->discount != null)
												<span class="sale">- {{$product->discount}} %</span>
												@endif
												<span class="new">NEW</span>
											</div>
										</div>
										<div class="product-body">
											<p class="product-category">{{$product->category->name}}</p>
											<h3 class="product-name"><a href="product_detail/{{$product->id}}">{{$product->name}}</a></h3>
											@if($product->discount != null)
											<h4 class="product-price">{{number_format($product->new_price, 0)}} VNĐ <del
													class="product-old-price">{{number_format($product->old_price, 0)}} VNĐ</del></h4>
											@else
											<h4 class="product-price">{{number_format($product->old_price, 0)}} VNĐ</h4>
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
										@if($product->quantity > 0)
										<div class="add-to-cart">
											<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào
												giỏ hàng</button>
										</div>
										@else
										<div class="add-to-cart" style="color: white;">
											HẾT HÀNG
										</div>
										@endif
									</div>
									 </form>
									@endforeach
								</div>
								<div id="slick-nav-1" class="products-slick-nav"></div>
							</div>
							<!-- /tab -->
						</div>
					</div>
				</div>
				<!-- Products tab & slick -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->
	

	@if(count($product_hots) > 0)
	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">

				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h3 class="title">MỘT SỐ SẢN PHẨM HOT</h3>
						<div class="section-nav">
							<ul class="section-tab-nav tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Hot</a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /section title -->

				<!-- Products tab & slick -->
				<div class="col-md-12">
					<div class="row">
						<div class="products-tabs">
							<!-- tab -->
							
							<div id="tab1" class="tab-pane active">
								<div class="products-slick" data-nav="#slick-nav-2">
									<!-- product -->
									@foreach($product_hots as $product)
									<form action="{{ route('single-add-to-cart',$product->id) }}" method="POST" >
									@csrf
									<div class="product">
										<div class="product-img">
											<img src="{{$product->image}}" alt="">
											<div class="product-label">
												@if($product->discount != null)
												<span class="sale">- {{$product->discount}} %</span>
												@endif
												<span class="new">HOT</span>
											</div>
										</div>
										<div class="product-body">
											<p class="product-category">{{$product->category->name}}</p>
											<h3 class="product-name"><a href="{{ route('home.product_detail',$product->id) }}">{{$product->name}}</a></h3>
											@if($product->discount != null)
											<h4 class="product-price">{{number_format($product->new_price, 0)}} VNĐ <del
													class="product-old-price">{{number_format($product->old_price, 0)}} VNĐ</del></h4>
											@else
											<h4 class="product-price">{{number_format($product->old_price, 0)}} VNĐ</h4>
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
											<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào
												giỏ hàng</button>
										</div>
									</div>
									</form>
									@endforeach
									<!-- /product -->
								</div>
								<div id="slick-nav-2" class="products-slick-nav"></div>
							</div>
							<!-- /tab -->
							 
						</div>
					</div>
				</div>
				<!-- Products tab & slick -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->
	@else

	@endif
	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-4 col-xs-6">
					<div class="section-title">
						<h4 class="title">Một số sản phẩm mới</h4>
						<div class="section-nav">
							<div id="slick-nav-3" class="products-slick-nav"></div>
						</div>
					</div>

					<div class="products-widget-slick" data-nav="#slick-nav-3">
						<div>
							<!-- product widget -->
							@foreach ($product_new_list_1 as $key)
							<div class="product-widget">
								<div class="product-img">
									<img src="{{$key->image}}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">{{$key->category->name}}</p>
									<h3 class="product-name"><a href="{{ route('home.product_detail',$key->id) }}">{{$key->name}}</a></h3>
									@if ($key->discount > 0 && $key->discount != null)
									<h4 class="product-price">{{number_format($key->new_price,0)}} <del class="product-old-price">{{number_format($key->old_price,0)}}
										VNĐ</del></h4>
									@else
									<h4 class="product-price">{{number_format($key->old_price,0)}} VNĐ </h4>
									@endif
									
								</div>
							</div>
							@endforeach
							
							<!-- /product widget -->
						</div>

						<div>
							<!-- product widget -->
							@foreach ($product_new_list_2 as $key)
							<div class="product-widget">
								<div class="product-img">
									<img src="{{$key->image}}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">{{$key->category->name}}</p>
									<h3 class="product-name"><a href="{{ route('home.product_detail',$key->id) }}">{{$key->name}}</a></h3>
									@if ($key->discount > 0 && $key->discount != null)
									<h4 class="product-price">{{number_format($key->new_price,0)}} <del class="product-old-price">{{number_format($key->old_price,0)}}
										VNĐ</del></h4>
									@else
									<h4 class="product-price">{{number_format($key->old_price,0)}} VNĐ </h4>
									@endif
									
								</div>
							</div>
							@endforeach
							<!-- /product widget -->
						</div>
					</div>
				</div>

				<div class="col-md-4 col-xs-6">
					<div class="section-title">
						<h4 class="title">Một số sản phẩm hot</h4>
						<div class="section-nav">
							<div id="slick-nav-4" class="products-slick-nav"></div>
						</div>
					</div>

					<div class="products-widget-slick" data-nav="#slick-nav-4">
						<div>
							<!-- product widget -->
							@foreach ($product_hot_list_1 as $key)
							<div class="product-widget">
								<div class="product-img">
									<img src="{{$key->image}}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">{{$key->category->name}}</p>
									<h3 class="product-name"><a href="{{ route('home.product_detail',$key->id) }}">{{$key->name}}</a></h3>
									@if ($key->discount > 0 && $key->discount != null)
									<h4 class="product-price">{{number_format($key->new_price,0)}} <del class="product-old-price">{{number_format($key->old_price,0)}}
										VNĐ</del></h4>
									@else
									<h4 class="product-price">{{number_format($key->old_price,0)}} VNĐ </h4>
									@endif
									
								</div>
							</div>
							@endforeach
							
							<!-- /product widget -->
						</div>

						<div>
							<!-- product widget -->
							@foreach ($product_hot_list_2 as $key)
							<div class="product-widget">
								<div class="product-img">
									<img src="{{$key->image}}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">{{$key->category->name}}</p>
									<h3 class="product-name"><a href="{{ route('home.product_detail',$key->id) }}">{{$key->name}}</a></h3>
									@if ($key->discount > 0 && $key->discount != null)
									<h4 class="product-price">{{number_format($key->new_price,0)}} <del class="product-old-price">{{number_format($key->old_price,0)}}
										VNĐ</del></h4>
									@else
									<h4 class="product-price">{{number_format($key->old_price,0)}} VNĐ </h4>
									@endif
									
								</div>
							</div>
							@endforeach
							<!-- /product widget -->
						</div>
					</div>
				</div>

				<div class="clearfix visible-sm visible-xs"></div>

				<div class="col-md-4 col-xs-6">
					<div class="section-title">
						<h4 class="title">Khuyến Mãi</h4>
						<div class="section-nav">
							<div id="slick-nav-5" class="products-slick-nav"></div>
						</div>
					</div>

					<div class="products-widget-slick" data-nav="#slick-nav-5">
						<div>
							<!-- product widget -->
							@foreach ($product_new_list_1 as $key)
							<div class="product-widget">
								<div class="product-img">
									<img src="{{$key->image}}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">{{$key->category->name}}</p>
									<h3 class="product-name"><a href="{{ route('home.product_detail',$key->id) }}">{{$key->name}}</a></h3>
									@if ($key->discount > 0 && $key->discount != null)
									<h4 class="product-price">{{number_format($key->new_price,0)}} <del class="product-old-price">{{number_format($key->old_price,0)}}
										VNĐ</del></h4>
									@else
									<h4 class="product-price">{{number_format($key->old_price,0)}} VNĐ </h4>
									@endif
									
								</div>
							</div>
							@endforeach
							
							<!-- /product widget -->
						</div>

						<div>
							<!-- product widget -->
							@foreach ($product_new_list_2 as $key)
							<div class="product-widget">
								<div class="product-img">
									<img src="{{$key->image}}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">{{$key->category->name}}</p>
									<h3 class="product-name"><a href="{{ route('home.product_detail',$key->id) }}">{{$key->name}}</a></h3>
									@if ($key->discount > 0 && $key->discount != null)
									<h4 class="product-price">{{number_format($key->new_price,0)}} <del class="product-old-price">{{number_format($key->old_price,0)}}
										VNĐ</del></h4>
									@else
									<h4 class="product-price">{{number_format($key->old_price,0)}} VNĐ </h4>
									@endif
									
								</div>
							</div>
							@endforeach
							<!-- /product widget -->
						</div>
					</div>
				</div>

			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

@endsection