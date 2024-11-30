  <!-- HEADER -->
  <header>
      @php
          use App\Models\Cart;
          use App\Models\category;
          use App\Models\brand;
          $cartlist = cart::where('user_id', Session::get('user'))->get();
          $sl = $cartlist->count();
          $tongtien = cart::where('user_id', Session::get('user'))->sum('amount');
          $categories = category::all();
          $brands = brand::all();
      @endphp
      <!-- TOP HEADER -->
      <div id="top-header">
          <div class="container">
              <ul class="header-links pull-left">
                  <li><a href="#"><i class="fa fa-phone"></i> 0902621216 - Zalo </a></li>
                  <li><a href="#"><i class="fa fa-envelope-o"></i> bobikidchannel@gmail.com</a></li>
                  <li><a href="#"><i class="fa fa-map-marker"></i> 75 Tô Hiệu, Hiệp Tân, Tân Phú, TPHCM</a></li>
              </ul>
              <ul class="header-links pull-right">
                  <li><a href="#"><i class="fa fa-dollar"></i> VND</a></li>

                  @if (Session::has('user'))
                      <li><a href="/profile"><i class="fa fa-user"></i> HI {{ Session::get('username') }}</a></li>
                      <li><a href="/logout"><i class="fa fa-user-plus"></i> LOGOUT</a></li>
                  @else
                      <li><a href="/login"><i class="fa fa-user-o"></i> Đăng Nhập</a></li>
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
                          <a href="/"><img class="logo" src="/storage/photos/1/image/logo.png"
                                  alt="logo"></a>
                      </div>
                  </div>
                  <!-- /LOGO -->

                  <!-- SEARCH BAR -->
                  <div class="col-md-6">
                      <div class="header-search">
                          <form>
                              <select class="input-select">
                                  <option value="0">TẤT CẢ</option>
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
                          {{-- <!-- Wishlist -->
								<div>
									<a href="#">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty">2</div>
									</a>
								</div>
								<!-- /Wishlist --> --}}

                          <!-- Cart -->
                          <div class="dropdown">
                              <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                  <i class="fa fa-shopping-cart"></i>
                                  <span>Giỏ hàng</span>
                                  <div class="qty">{{ $sl }}</div>
                              </a>
                              <div class="cart-dropdown">
                                  <div class="cart-list">
                                      <!-- Cart LIST-->
                                      @foreach ($cartlist as $key)
                                          <div class="product-widget">
                                              <div class="product-img">
                                                  <img src="{{ $key->products->image }}" alt="" width="60px"
                                                      height="60px">
                                              </div>
                                              <div class="product-body">
                                                  <h3 class="product-name"><a
                                                          href="#">{{ $key->products->name }}</a></h3>
                                                  <h4 class="product-price"><span class="qty">SL :
                                                          {{ $key->quantity }}</span>{{ number_format($key->amount, 0) }}
                                                      VNĐ</h4>
                                              </div>
                                              <button class="delete"><i class="fa fa-close"></i></button>
                                          </div>
                                      @endforeach
                                  </div>
                                  <div class="cart-summary">
                                      <small>Có {{ $sl }} sản phẩm đã thêm</small>
                                      <h5>TỔNG TIỀN: {{ number_format($tongtien, 0) }} VNĐ</h5>
                                  </div>
                                  <div class="cart-btns">
                                      <a href="/cart">Xem giỏ hàng</a>
                                      <a href="/checkout">Thanh Toán <i class="fa fa-arrow-circle-right"></i></a>
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
                  <li><a href="#">Giới Thiệu</a></li>
                  <li><a href="#">Sản Phẩm</a></li>
                  <li class="dropdown">
                      <a class="dropdown-toggle" href="#">Loại sản phẩm</a>
                      <ul class="dropdown-menu">
                          @foreach ($categories as $key)
                              <li><a href="{{ route('user.productbycatename', $key->name) }}">{{ $key->name }}</a>
                              </li>
                          @endforeach
                      </ul>
                  </li>
                  <li class="dropdown">
                      <a class="dropdown-toggle" href="#">Hãng Đồ Chơi</a>
                      <ul class="dropdown-menu">
                          @foreach ($brands as $key)
                              <li><a href="{{ route('user.productbybrandname', $key->name) }}">{{ $key->name }}</a>
                              </li>
                          @endforeach
                      </ul>
                  </li>
                  <li><a href="#">Liên Hệ</a></li>

              </ul>
              <!-- /NAV -->

          </div>
          <!-- /responsive-nav -->
      </div>
      <!-- /container -->
  </nav>
  <!-- /NAVIGATION -->
