<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('brand/thestoneoflapiz.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('brand/thestoneoflapiz.png') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>E-Commerce | 404</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="{{ asset('nowui-kit/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('nowui-kit/css/now-ui-kit.css?v=1.3.0') }}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ asset('nowui-kit/demo/demo.css') }}" rel="stylesheet" />
</head>

<body class="login-page sidebar-collapse">
  <div class="page-header clear-filter" filter-color="orange">
    <div class="page-header-image" style="background-image:url({{ asset('nowui-kit/img/login.jpg') }}"></div>
    <div class="content">
      <div class="container">
        <div class="col-md-4 ml-auto mr-auto">
          <div class="card card-login card-plain">
              <div class="card-header text-center">
                <h3>I think you're lost...?</h3>
                <h1 style="font-weight:700;font-size:4rem;">404</h1>
              </div>
              <div class="card-footer text-center">
                <button onclick="window.location='/'" class="btn btn-primary btn-round btn-lg btn-block">Go back HOME</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer">
      <div class=" container ">
        <nav></nav>
        <div class="copyright" id="copyright">
          &copy;
          <script>
            document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
          </script>, Project by
          <a href="https://github.com/thestoneoflapiz" target="_blank">thestoneoflapiz</a>. Contact me through
          <a href="javascript:;" target="_blank">thestoneoflapiz@gmail.com</a>
        </div>
      </div>
    </footer>
  </div>
  <!--   Core JS Files   -->
  <script src="{{ asset('nowui-kit/js/core/jquery.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('nowui-kit/js/core/popper.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('nowui-kit/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="{{ asset('nowui-kit/js/plugins/bootstrap-switch.js') }}"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{ asset('nowui-kit/js/plugins/nouislider.min.js') }}" type="text/javascript"></script>
  <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
  <script src="{{ asset('nowui-kit/js/plugins/bootstrap-datepicker.js') }}" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('nowui-kit/js/now-ui-kit.js?v=1.3.0') }}" type="text/javascript"></script>
</body>
</html>