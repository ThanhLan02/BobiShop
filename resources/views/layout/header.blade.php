<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script>
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  </script>
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title>Bobishop - Chuyên đồ chơi con quay</title>

  <!-- Google font -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

  <!-- Bootstrap -->
  <link type="text/css" rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />

  <!-- Slick -->
  <link type="text/css" rel="stylesheet" href="{{asset('css/slick.css')}}" />
  <link type="text/css" rel="stylesheet" href="{{asset('css/slick-theme.css')}}" />

  <!-- nouislider -->
  <link type="text/css" rel="stylesheet" href="{{asset('css/nouislider.min.css')}}" />

  <!-- Font Awesome Icon -->
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

  <!-- Custom stlylesheet -->
  <link type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}" />

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
<style>
    #header {
    height: 100px; /* Chiều cao cố định cho header */
    position: relative; /* Đảm bảo các phần tử con được định vị tương đối */
}

#search-results {
    position: absolute; /* Định vị tuyệt đối bên trong div cha */
    top: 100%; /* Vị trí ngay dưới header */
    left: 0;
    right: 0;
    background: white; /* Đặt màu nền nếu cần */
    z-index: 1000; /* Đảm bảo nó nằm trên các phần tử khác */
    max-height: 300px; /* Giới hạn chiều cao tối đa cho kết quả */
    overflow-y: auto; /* Hiển thị thanh cuộn nếu cần */
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}
</style>
</head>