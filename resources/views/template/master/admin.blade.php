<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('brand/thestoneoflapiz.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('brand/thestoneoflapiz.png') }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>E-Commerce | Admin</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link href="{{ asset('nowui/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('nowui/css/now-ui-dashboard.css?v=1.5.0') }}" rel="stylesheet" />
        <link href="{{ asset('nowui/demo/demo.css') }}" rel="stylesheet" />

        @yield("styles")
    </head>
    <body class="">
        <div class="wrapper ">
            @if(Auth::user()->type=="admin")
                @include("template.leftnav.admin")
            @elseif(Auth::user()->type=="seller")
                @include("template.leftnav.seller")
            @else
                @include("template.leftnav.buyer")
            @endif
        
            <div class="main-panel" id="main-panel">
            
                @include("template.navbar")
                
                <div class="panel-header panel-header-sm"></div>

                @yield("content")
                
                <footer class="footer">
                    <div class=" container-fluid ">
                    <nav>
                    </nav>
                    <div class="copyright" id="copyright">
                        &copy; <script>
                        document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                        </script>, Project by <a href="https://github.com/thestoneoflapiz" target="_blank">thestoneoflapiz</a>. Contact me through  <a href="#" target="_blank">thestoneoflapiz@gmail.com</a>
                    </div>
                    </div>
                </footer>
            </div>
        </div>

        <!--   Core JS Files   -->
        <script src="{{ asset('nowui/js/core/jquery.min.js') }}"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
        <script src="{{ asset('nowui/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('nowui/js/core/bootstrap.min.js') }}"></script>
        <script src="{{ asset('nowui/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
        <!--  Notifications Plugin    -->
        <script src="{{ asset('nowui/js/plugins/bootstrap-notify.js') }}"></script>
        <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="{{ asset('nowui/js/now-ui-dashboard.min.js?v=1.5.0') }}" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
        <script src="{{ asset('nowui/demo/demo.js') }}"></script>
        @yield("scripts")
    </body>
</html>