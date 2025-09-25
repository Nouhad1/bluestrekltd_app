<!DOCTYPE html>
<html lang="fr">
<head>
    <base href="/public"> 
    <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
    <title>Nos produits</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/responsive.css') }}">

    <style>
        .product-detail-container {
            max-width: 900px;        
            width: auto;              
            padding: 20px;
            background: #fff;
            border-radius: 0px;
        }

        .product-img {
            max-width: 50%;
            border-radius: 12px;
        }
        .product-info h5 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
        .product-info h6 {
            margin-bottom: 10px;
        }
        .price-original {
            text-decoration: line-through;
            color: red;
            margin-left: 10px;
        }
        .price-discount {
            color: green;
            font-weight: bold;
        }
        .add-cart-btn {
            background-color: #2563eb;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
        }
        .add-cart-btn:hover {
            background-color: #1e40af;
        }
        @media (max-width: 768px) {
            .row-product {
                flex-direction: column;
                align-items: center;
            }
            .product-info {
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
      
    <section class="product_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Nos <span>produits</span>
                </h2>
            </div>

            <div class="row">
                @foreach ($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="box">
                            <!-- overlay hover -->
                            <div class="option_container">
                                <div class="options">
                                    <a href="{{ url('product_details', $product->reference) }}" class="option1">
                                        Détails du produit
                                    </a>

                                    <form action="{{ url('client/add_cart', $product->reference) }}" method="POST">
                                        @csrf
                                        <div class="row mt-2">
                                            <div class="col-6">
                                                <input type="number" name="quantity" value="1" min="1" class="form-control input-quantity">
                                            </div>
                                            <div class="col-6">
                                               <button type="submit" class="btn add-cart-btn">
    <i class="fa fa-cart-plus"></i>
</button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="img-box">
                                <img src="{{ asset('product/'.$product->image) }}" alt="{{ $product->reference }}">
                            </div>

                            <div class="detail-box">
                                <h5>{{ $product->description }}</h5>

                                @if($product->discount_price)
                                    <h6 style="color: blue">{{ $product->discount_price }} DH</h6>
                                    <h6 style="text-decoration: line-through; color: red">{{ $product->price }} DH</h6>
                                @else
                                    <h6 style="color: red">{{ $product->price }} DH</h6>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {!! $products->appends(Request::all())->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </section>

    {{-- @include('home.footer') --}}
    <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('home/js/bootstrap.js') }}"></script>  

    <script src="home/js/jquery-3.4.1.min.js"></script>
    <script src="home/js/bootstrap.js"></script>
</body>
</html>
