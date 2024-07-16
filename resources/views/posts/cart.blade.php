@include('header')
<head>
    <title>Cart</title>
    <style>
        img{
            width: 100%!important;
            height: 200px;
            padding: 10px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1>Shopping Cart</h1>
    <div class="row mt-4">
        @if($carts)
            @foreach($carts as $cart)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset($cart->post->image) }}" class="card-img-top" alt="Post Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $cart->post->title }}</h5>
                            <p class="card-text">Customer: {{ $cart->post->user->name }}</p>
                            <p class="card-text">Card Balance: {{ $cart->balance }}</p>
                            <p class="card-text">Added to cart: {{ $cart->created_at }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-danger h4 text-center p-4 items-center justify-content-center border rounded-3">there are no posts added your cart.</p>
        @endif
    </div>
</div>
