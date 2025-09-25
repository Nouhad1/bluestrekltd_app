<!DOCTYPE html>
<html lang="fr">
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

    <title>Nos Produits</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/responsive.css') }}">

    <style>
        .product-detail-container { max-width: 900px; width: auto; padding: 20px; background: #fff; }
        .product-img { max-width: 100%; border-radius: 12px; }
        .product-info h5 { font-size: 1.5rem; margin-bottom: 15px; }
        .product-info h6 { margin-bottom: 10px; }
        .price-original { text-decoration: line-through; color: red; margin-left: 10px; }
        .price-discount { color: green; font-weight: bold; }
        .btn-add-cart { background: #2563eb; color: #fff; border: none; border-radius: 8px; padding: 10px 20px; width: 100%; font-size: 14px; transition: 0.3s; }
        .btn-add-cart:hover { background: #1e40af; }
        @media (max-width: 768px) {
            .row-product { flex-direction: column; align-items: center; }
            .product-info { margin-top: 20px; }
        }
        
        /* Input de recherche stylé */
        .form-control-search {
            align-self: center;
            padding: 10px 15px;
            border-radius: 12px;
            border: 1px solid #ccc;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            width: 100%;
            font-size: 14px;
        }

        .form-control-search:focus {
            border-color: #2563eb;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
            outline: none;
        }
        .row mb-3{
            
        }
    </style>
</head>
<body>
      @include('home.header')

    {{-- Section Produits --}}
    <section class="product_section layout_padding">
        <div class="container">
            <!-- Input de filtre -->
<div class="row mb-3">
    <div class="col-12 col-md-6 mx-auto">
        <input type="text" id="searchInput" class="form-control-search" placeholder="Rechercher par designation...">
    </div>
</div>


            {{-- Produits --}}
            <div class="row">
                @forelse ($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-4 mb-4">
                        <div class="box">

                            {{-- Options au survol --}}
                            <div class="option_container">
                                <div class="options">
                                    <a href="{{ url('product_details', $product->reference) }}" class="option1">
                                        Détails du produit
                                    </a>

                                    <form action="{{ url('client/add_cart', $product->reference) }}" method="POST">
                                        @csrf
                                        <div class="row mt-2">
                                            <div class="col-6">
                                                <input type="number" name="quantity" value="1" min="1" class="form-control" style="width:100px;">
                                            </div>
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-add-cart">
                                                    <i class="fa fa-cart-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="img-box">
                                <img src="/product/{{ $product->image }}" alt="{{ $product->description }}">
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
                @empty
                    <div class="col-12 text-center">
                        <h5>Aucun produit trouvé.</h5>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-3 d-flex justify-content-center">
                {!! $products->appends(request()->all())->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </section>

    {{-- Footer --}}
    @include('home.footer')

    <!-- Scripts -->
    <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('home/js/popper.min.js') }}"></script>
    <script src="{{ asset('home/js/bootstrap.js') }}"></script>
    <script src="{{ asset('home/js/custom.js') }}"></script>

    <!-- Filtrage instantané -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const products = document.querySelectorAll('.box');

        searchInput.addEventListener('input', function() {
            const filter = this.value.toLowerCase();

            products.forEach(product => {
                const description = product.querySelector('.detail-box h5').textContent.toLowerCase();
                product.parentElement.style.display = description.includes(filter) ? '' : 'none';
            });
        });
    </script>

</body>
</html>
