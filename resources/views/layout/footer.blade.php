<footer id="footer">
  <!-- top footer -->
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <div class="col-md-3 col-xs-6">
          <div class="footer">
            <h3 class="footer-title">About Us</h3>
            <p>Chào mừng đến với Bobishop chuyên về đồ chơi con quay.Chúng tôi tự hào là địa chỉ uy tín và tin cậy, mang đến cho bạn những trải nghiệm vui chơi thú vị và bổ ích.</p>
            <ul class="footer-links">
              <li><a href="#"><i class="fa fa-map-marker"></i>75A Tô Hiệu, Hiệp Tân, Tân Phú, Thành phố Hồ Chí Minh </a></li>
              <li><a href="#"><i class="fa fa-phone"></i>0904613293</a></li>
              <li><a href="#"><i class="fa fa-envelope-o"></i>tranthanhlanth9@email.com</a></li>
            </ul>
          </div>
        </div>

        <div class="col-md-3 col-xs-6">
          <div class="footer">
            <h3 class="footer-title">Categories</h3>
            <ul class="footer-links">
              <li><a href="#">Beyblade</a></li>
              <li><a href="#">NADO</a></li>
              <li><a href="#">Chiến xa</a></li>
              <li><a href="#">Other</a></li>
            </ul>
          </div>
        </div>

        <div class="clearfix visible-xs"></div>

        <div class="col-md-3 col-xs-6">
          <div class="footer">
            <h3 class="footer-title">Thông tin</h3>
            <ul class="footer-links">
              <li><a href="#">Trần Thanh Lân - HELPER</a></li>
              <li><a href="#">Trần Thị Bich Ngọc - Chủ SHOP</a></li>
            </ul>
          </div>
        </div>

        <div class="col-md-3 col-xs-6">
          <div class="footer">
            <h3 class="footer-title">Service</h3>
            <ul class="footer-links">
              <li><a href="#">Đăng nhập</a></li>
              <li><a href="#">Đăng ký</a></li>
              <li><a href="#">giỏ hàng</a></li>
              <li><a href="#">Thanh Toán</a></li>
              <li><a href="#">Help</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /top footer -->

  <!-- bottom footer -->
  <div id="bottom-footer" class="section">
    <div class="container">
      <!-- row -->
      <div class="row">
        <div class="col-md-12 text-center">
          <ul class="footer-payments">
            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
            <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
            <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
          </ul>
          <span class="copyright">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>
              document.write(new Date().getFullYear());
            </script> All rights reserved | The Website is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">THT Team</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          </span>
        </div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /bottom footer -->
</footer>
<!-- /FOOTER -->

<!-- jQuery Plugins -->
<script src="{{ URL::asset('js/jquery.min.js')}}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('js/slick.min.js')}}"></script>
<script src="{{ URL::asset('js/nouislider.min.js')}}"></script>
<script src="{{ URL::asset('js/jquery.zoom.min.js')}}"></script>
<script src="{{ URL::asset('js/main.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('#search-input').on('keyup', function() {
      var query = $(this).val().trim(); // Lấy giá trị và loại bỏ không gian trắng

      // Kiểm tra nếu query không rỗng
      if (query !== '') {
        $.ajax({
          url: "{{ route('user.search') }}",
          type: "GET",
          data: {
            'query': query
          },
          success: function(data) {
            $('#search-results').empty();

            if (data.length > 0) {
              $.each(data, function(index, item) {
                $('#search-results').append(
                  '<div class="results" style="width: 555px;height: auto;">' +
                  '<a href="/product_detail/'+item.id+'" style=""><img src="' + item.image +'" width="50px" height="50px" alt="">&ensp;' + item.name+
                  '</a><br />'
                );
              });
            } else {
              $('#search-results').append('<p>No results found</p>');
            }
          }
        });
      } else {
        $('#search-results').empty(); // Xóa kết quả khi input trống
      }
    });
  });
</script>
@stack('scripts')