<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('brand/thestoneoflapiz.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('brand/thestoneoflapiz.png') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>E-Commerce | Home</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="{{ asset('nowui-kit/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('nowui-kit/css/now-ui-kit.css?v=1.3.0') }}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ asset('nowui-kit/demo/demo.css') }}" rel="stylesheet" />

  @yield("styles")
</head>

<body class="landing-page sidebar-collapse">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent " color-on-scroll="400">
    <div class="container">
      <div class="dropdown button-dropdown">
        <a href="#pablo" class="dropdown-toggle" id="navbarDropdown" data-toggle="dropdown">
          <span class="button-bar"></span>
          <span class="button-bar"></span>
          <span class="button-bar"></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-header">MORE CHOICES</a>
          <a class="dropdown-item" href="#items">See Items</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/register">Register</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/login">Login</a>
        </div>
      </div>
      <div class="navbar-translate">
        <a class="navbar-brand" href="/" rel="tooltip" title="Project by thestoneoflapiz. Contact me at thestoneoflapiz@gmail.com" data-placement="bottom">
            E-Commerce | Home
        </a>
        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-bar top-bar"></span>
          <span class="navbar-toggler-bar middle-bar"></span>
          <span class="navbar-toggler-bar bottom-bar"></span>
        </button>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="wrapper">
    <div class="page-header page-header-small">
      <div class="page-header-image" data-parallax="true" style="background-image: url(<?=asset('nowui-kit/img/bg6.jpg') ?>);">
      </div>
      <div class="content-center">
        <div class="container">
          <h1 class="title">Practice makes... a good experience</h1>
        </div>
      </div>
    </div>
    
    @yield("content");

    <div class="section section-contact-us text-center">
      <div class="container">
        <h2 class="title">Want to work with us?</h2>
        <div class="row">
          <div class="col-lg-6 text-center col-md-8 ml-auto mr-auto">
            <div class="send-button">
              <a href="/register" class="btn btn-primary btn-round btn-block btn-lg">Register as Seller!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer footer-default">
      <div class=" container ">
        <nav></nav>
        <div class="copyright" id="copyright">
          &copy;
          <script>
            document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
          </script>, Project by
          <a href="https://github.com/thestoneoflapiz" target="_blank">thestoneoflapiz</a>. Contact me through
          <a href="javascript:;">thestoneoflapiz@gmail.com</a>
        </div>
      </div>
    </footer>
  </div>
  <!--   Core JS Files   -->
  <script src="{{ asset('nowui-kit/js/core/jquery.min.js') }}" type="text/javascript"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
  <script src="{{ asset('nowui-kit/js/core/popper.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('nowui-kit/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
  <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('nowui-kit/js/now-ui-kit.js?v=1.3.0') }}" type="text/javascript"></script>
  
  @yield("scripts")
</body>

</html>