<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('brand/thestoneoflapiz.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('brand/thestoneoflapiz.png') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>E-Commerce | Login</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="{{ asset('nowui-kit/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('nowui-kit/css/now-ui-kit.css?v=1.3.0') }}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ asset('nowui-kit/demo/demo.css') }}" rel="stylesheet" />
  <style>
    #error_alert_msgs{display:none;}
  </style>
</head>

<body class="login-page sidebar-collapse">
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
          <a class="dropdown-header">More Choices</a>
          <a class="dropdown-item" href="/">See items</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/register">Register</a>
        </div>
      </div>
      <div class="navbar-translate">
        <a class="navbar-brand" href="/" rel="tooltip" title="Project by thestoneoflapiz. Contact me through thestoneoflapiz@gmail.com" data-placement="bottom">
            E-Commerce | go to HOME
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
  <div class="page-header clear-filter" filter-color="orange">
    <div class="page-header-image" style="background-image:url({{ asset('nowui-kit/img/login.jpg') }}"></div>
    <div class="content">
      <div class="container">
        <div class="col-md-4 ml-auto mr-auto">
          <div class="card card-login card-plain">
            <form class="form" id="form">
              <div class="card-header text-center">
                <div class="logo-container">
                  <img src="{{ asset('brand/thestoneoflapiz-1.png') }}" alt="">
                </div>
              </div>
              <div class="alert alert-danger" role="alert" id="error_alert_msgs">
                  <div class="container error-messages"></div>
              </div>
              <div class="card-body">
                <div class="input-group no-border input-lg">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="now-ui-icons users_circle-08"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" placeholder="Email" name="email">
                </div>
                <div class="input-group no-border input-lg">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="now-ui-icons objects_key-25"></i>
                    </span>
                  </div>
                  <input type="password" placeholder="Password" class="form-control" name="password"/>
                </div>
              </div>
              <div class="card-footer text-center">
                <button class="btn btn-primary btn-round btn-lg btn-block">Login</button>
                <div class="pull-left">
                  <h6>
                    <a href="/register" class="link">Register</a>
                  </h6>
                </div>
            </form>
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
  <script src="{{ asset('nowui-kit/js/core/jquery.min.js') }}" type="text/javascript"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

  <script src="{{ asset('nowui-kit/js/core/popper.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('nowui-kit/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('nowui-kit/js/now-ui-kit.js?v=1.3.0') }}" type="text/javascript"></script>
  <script>
    $(document).ready(function(){
      $("#form").validate({
        rules: {
          email: {
            required: true,
            email: true,
          },
          password: {
            required: true,
            minlength: 5
          }
        },
        messages: {
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
          },
          email: "Please enter a valid email address"
        },
        errorElement : 'div',
        errorLabelContainer: '.error-messages',
        invalidHandler: function(form, validator) {
          $("#error_alert_msgs").show();
        },
        submitHandler: function(form) {
          $.ajax({
            method: "POST",
            url: "/login",
            data: {
              email: $("[name='email']").val(),
              password: $("[name='password']").val(),
              _token: "<?=csrf_token()?>"
            },
            success: function(response){
              window.location=response.type+"/dashboard";
            },
            error: function(response){
              var body = response.responseJSON;
              if(body.hasOwnProperty("message")){
                alert(body.message);
                return;
              }

              alert("Unable to login! Please try again later.");
            }
          });
        }
      });
    });
  </script>
</body>
</html>