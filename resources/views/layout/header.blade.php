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
    <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick-theme.css') }}" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/profilestyle.css') }}" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <style>
        #header {
            height: 100px;
            /* Chiều cao cố định cho header */
            position: relative;
            /* Đảm bảo các phần tử con được định vị tương đối */
        }

        #search-results {
            position: absolute;
            /* Định vị tuyệt đối bên trong div cha */
            top: 100%;
            /* Vị trí ngay dưới header */
            left: 0;
            right: 0;
            background: white;
            /* Đặt màu nền nếu cần */
            z-index: 1000;
            /* Đảm bảo nó nằm trên các phần tử khác */
            max-height: 300px;
            /* Giới hạn chiều cao tối đa cho kết quả */
            overflow-y: auto;
            /* Hiển thị thanh cuộn nếu cần */
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
            animation: fadeIn 0.3s ease-out;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #ffffff;
            border: 1px solid #ddd;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 0;
            z-index: 1000;
            transform: translateY(-10px);
            /* Bắt đầu dịch chuyển */
            transition: opacity 1s ease, transform 1s ease;
            /* Hiệu ứng chuyển động */
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1;
            /* Hiển thị */
            transform: translateY(0);
            /* Về vị trí ban đầu */
        }

        .dropdown-menu li {
            margin: 0;
        }

        .dropdown-menu a {
            padding: 10px 15px;
            color: #333;
        }

        .dropdown-menu a:hover {
            background-color: #f4f4f4;
        }



        .header-logo {
            position: relative;
            display: inline-block;
            overflow: hidden;
            /* Đảm bảo hiệu ứng không vượt ra ngoài logo */
        }

        /* Logo chính */
        .logo {
            display: block;
            width: 100%;
            /* Đảm bảo logo tự động co giãn theo kích thước */
            height: auto;
            position: relative;
            z-index: 1;
            /* Giữ logo ở trên */
        }

        /* Hiệu ứng tráng gương */
        .logo-container::after {
            content: "";
            position: absolute;
            top: 0;
            left: -150%;
            /* Vệt sáng bắt đầu ngoài logo */
            width: 150%;
            /* Độ rộng của vệt sáng */
            height: 100%;
            background: linear-gradient(120deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.6) 50%, rgba(255, 255, 255, 0) 100%);
            transform: skewX(-30deg);
            /* Nghiêng vệt sáng để tạo hiệu ứng tự nhiên */
            z-index: 2;
            /* Đặt vệt sáng lên trên logo */
            animation: shine 2.5s linear infinite;
            /* Hiệu ứng tráng gương liên tục */
        }

        /* Keyframes cho hiệu ứng */
        @keyframes shine {
            0% {
                left: -150%;
                /* Vệt sáng bắt đầu bên trái ngoài logo */
            }

            100% {
                left: 150%;
                /* Vệt sáng kết thúc bên phải ngoài logo */
            }
        }

        /* Hiệu ứng trượt xuống */
        @keyframes slideDown {
            from {
                top: -60px;
                /* Bắt đầu từ ngoài màn hình */
            }

            to {
                top: 0;
                /* Kết thúc ở trên cùng */
            }
        }

        /* Keyframes cho hiệu ứng */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <script>
        window.addEventListener('scroll', function() {
            var navigation = document.getElementById('navigation');
            if (window.scrollY > 100) {
                navigation.classList.add('fixed');
            } else {
                navigation.classList.remove('fixed');
            }
        });
    </script>
</head>
