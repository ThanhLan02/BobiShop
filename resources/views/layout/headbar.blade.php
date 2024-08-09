		<!-- HEADER -->
		<header>
			@php
			use App\Models\Cart;
			use App\Models\category;
			$cartlist = cart::where('user_id', Session::get('user'))->get();
			$sl = $cartlist->count();
			$tongtien = cart::where('user_id',Session::get('user'))->sum('amount');
			$categories = category::all();
			@endphp
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> 0904613293</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> tranthanhlanth9@gmail.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 75 Tô Hiệu, Hiệp Tân, Tân Phú, TPHCM</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="#"><i class="fa fa-dollar"></i> VND</a></li>

						@if(Session::has('user'))
						<li><a href="#"><i class="fa fa-user"></i> HI {{Session::get('username')}}</a></li>
						<li><a href="/logout"><i class="fa fa-user-plus"></i> LOGOUT</a></li>
						@else
						<li><a href="/login"><i class="fa fa-user-o"></i> LOGIN</a></li>
						@endif
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="/" class="logo">
									<img src="/storage/photos/1/image/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select">
										<option value="0">All Categories</option>
									</select>
									<input class="input" id="search-input" placeholder="Nhập từ khóa..." value="">
									<button class="search-btn" type="submit">Search</button>
									<div id="search-results"></div>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div>
									<a href="#">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty">2</div>
									</a>
								</div>
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty">{{$sl}}</div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											<!-- Cart LIST-->
											@foreach($cartlist as $key)
											<div class="product-widget">
												<div class="product-img">
													<img src="{{$key->products->image}}" alt="" width="60px" height="60px">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">{{$key->products->name}}</a></h3>
													<h4 class="product-price"><span class="qty">SL : {{$key->quantity}}</span>{{number_format($key->amount, 0)}} VNĐ</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>
											@endforeach
										</div>
										<div class="cart-summary">
											<small>Có {{$sl}} sản phẩm đã thêm</small>
											<h5>TỔNG TIỀN: {{number_format($tongtien, 0)}} VNĐ</h5>
										</div>
										<div class="cart-btns">
											<a href="/cart">View Cart</a>
											<a href="/checkout">Checkout <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="#">Trang Chủ</a></li>
						@foreach($categories as $key)
						<li><a href="#">{{$key->name}}</a></li>
						@endforeach
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->