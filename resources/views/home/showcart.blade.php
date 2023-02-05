<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
    {{-- </div> --}}
   

    <div class="main-panel">
        <div class="content-wrapper">
            <div id="flash_message">
                @include('flash::message')
            </div>
            <div class="container">
                <table class="table mt-5">
                    <thead>
                    <tr>
                        <th>Product title</th>
                        <th>Product quantity</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $totalprice = 0; ?>

                        @foreach($cart as $cart)
                        <tr>
                           <td>{{$cart->product_title}}</td>
                           <td>{{$cart->quantity}}</td>
                           <td>{{$cart->price}}</td>
                           <td><img src="product/{{$cart->image}}" alt="" class="image_size"></td>
                           <td><a href="{{url('/remove-cart')}}/{{$cart->id}}" class="btn btn-danger" onclick="return confirm('Are You Delete This Product')">Remove Cart</a></td>
                        </tr>
                        <?php $totalprice = $totalprice + $cart->price; ?> 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="text-center font-weight-bold">
        <h2>Total Price : {{$totalprice}}</h2>
    </div>

    <div class="text-center ">
        <h3 class="font-weight-bold">Proceed to order</h3>
        <a class="btn btn-danger" href="{{url('cash-order')}}">Cash on delivery</a>
        <a class="btn btn-danger" href="">Pay using card</a>
    </div>
    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->
    <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

        </p>
    </div>
    <!-- jQery -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>
</body>

</html>