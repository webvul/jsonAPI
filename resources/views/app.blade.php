<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{env('APP_NAME', true)}}</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">

    {!! Html::style('//fonts.useso.com/css?family=Open+Sans:400,300,400italic,700') !!}
    {!! Html::style('css/font-awesome.min.css') !!}
    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('css/templatemo-style.css') !!}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    {!! Html::script('https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js') !!}
    {!! Html::script('https://oss.maxcdn.com/respond/1.4.2/respond.min.js') !!}

    <![endif]-->

</head>
<body>
<!-- Left column -->
<div class="templatemo-flex-row">
    <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
            <div class="square"></div>
            <h1>{{env('APP_NAME', true)}}</h1>
        </header>
        {{--<div class="profile-photo-container">--}}
            {{--<img src="/images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">--}}
            {{--<div class="profile-photo-overlay"></div>--}}
        {{--</div>--}}
        <!-- Search box -->
        <form class="templatemo-search-form" role="search">
            <div class="input-group">
                <button type="submit" class="fa fa-search"></button>
                <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
            </div>
        </form>
        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
        </div>
        @include('menu')
    </div>
    <!-- Main content -->
    <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
            <div class="row">
                {{--<nav class="templatemo-top-nav col-lg-12 col-md-12">--}}
                    {{--<ul class="text-uppercase">--}}
                        {{--<li><a href="#" class="active">Admin panel</a></li>--}}
                        {{--<li><a href="#">Dashboard</a></li>--}}
                        {{--<li><a href="#">Overview</a></li>--}}
                        {{--<li><a href="#login.html">Sign in form</a></li>--}}
                    {{--</ul>--}}
                {{--</nav>--}}
            </div>
        </div>
        @yield('content')
        <footer class="text-right">
            <p>Copyright &copy; 2084 Company Name | Designed by <a href="http://www.zkdj.com/"
                                                                   target="_parent">中科点击(北京)科技有限公司</a></p>
        </footer>
    </div>

</div>

<!-- JS -->
{!! Html::script('/js/jquery-1.11.2.min.js') !!}
{!! Html::script('/js/templatemo-script.js') !!}

<script>
    $(document).ready(function(){
        // Content widget with background image
        var imageUrl = $('img.content-bg-img').attr('src');
        $('.templatemo-content-img-bg').css('background-image', 'url(' + imageUrl + ')');
        $('img.content-bg-img').hide();
    });
    $(function () {
        $('li[route="{!! \Route::currentRouteName() !!}"] a').addClass('active');
    })
</script>
@yield('javascript')
</body>

<!-- Mirrored from www.17sucai.com/preview/2/2015-05-19/admin/manage-users.html by HTTrack Website Copier/3.x [XR&CO'2013], Tue, 22 Sep 2015 13:12:10 GMT -->
</html>