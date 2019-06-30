<header id="header">
    <!-- Nav -->
    <div id="nav">
        <!-- Main Nav -->
        <div id="nav-fixed">
            <div class="container">
                <!-- logo -->
                <div class="nav-logo">
                    <a href="{{route('homepage')}}" class="logo"><img src="{{asset('front/img/logo.png')}}" alt=""></a>
                </div>
                <!-- /logo -->

                <!-- nav -->
                <ul class="nav-menu nav navbar-nav">
                    <li><a href="{{route('homepage')}}">首页</a></li>
                    @foreach($categories as $category)
                        <li  class="{{$category->color}}"><a href="{{route('category',$category->id)}}" >{{$category->name}}</a></li>
                    @endforeach
                    </ul>
                <!-- /nav -->

                <!-- search & aside toggle -->
                <div class="nav-btns">

                    <button class="search-btn"><i class="fa fa-search"></i></button>
                    <div class="search-form">
                        <input class="search-input" type="text" name="search" placeholder="Enter Your Search ...">
                        <button class="search-close"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /search & aside toggle -->
            </div>
        </div>
        <!-- /Main Nav -->
    </div>
    <!-- Page Header -->
    @section('page_header')
        @show
        <!-- /Page Header -->
    <!-- /Nav -->
</header>