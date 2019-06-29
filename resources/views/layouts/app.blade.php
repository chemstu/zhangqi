<!DOCTYPE html>
<head>
    @include('layouts._head')
</head>
<body>

<!-- Header -->
@include('layouts._header')
<!-- /Header -->
<!-- section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-8">
                @section('content')
                @show
            </div>

            <div class="col-md-4">
                @include('layouts._sidebar')
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->

<!-- Footer -->
@include('layouts._footer')
<!-- /Footer -->
<!-- jQuery Plugins -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>