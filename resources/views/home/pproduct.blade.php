<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Nos Produits</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/responsive.css') }}">

    <style>
        /* ---- Conteneur principal ---- */
        .product-detail-container {
            max-width: 900px;
            width: auto;
            padding: 20px;
            background: #fff;
        }

        /* ---- Barre de recherche en haut à droite ---- */
        .header-search {
            position: absolute;
            top: 25px;
            right: 40px;
            display: flex;
            align-items: center;
            z-index: 1000;
        }

        /* ---- Icône stylisée ---- */
        .search-icon {
            font-size: 16px;
            color: white;
            background: linear-gradient(135deg, #007bff, #00c6ff);
            border-radius: 50%;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 6px rgba(0,0,0,0.2);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-icon:hover {
            transform: scale(1.1);
            background: linear-gradient(135deg, #0062cc, #0099ff);
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }

        /* ---- Champ de recherche ---- */
        .search-input {
            border: 1px solid #ddd;
            border-radius: 20px;
            padding: 6px 12px;
            margin-left: 10px;
            outline: none;
            width: 0;
            opacity: 0;
            background: #fff;
            color: #333;
            transition: all 0.4s ease;
            font-size: 14px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .search-input.show {
            width: 200px;
            opacity: 1;
        }

        @media (max-width: 768px) {
            .search-input.show {
                width: 130px;
            }
        }

        /* ---- Titre produit ---- */
        .heading_container {
            text-align: center;
            margin-bottom: 30px;
        }

        /* ---- Produit ---- */
        .box {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .box:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-add-cart {
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            width: 100%;
            font-size: 14px;
            transition: 0.3s;
        }

        .btn-add-cart:hover {
            background: #1e40af;
        }

        @media (max-width: 768px) {
            .search-box {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    {{-- Header --}}
    <div style="position: relative;">
        @include('home.header')

        {{-- Icône + champ de recherche alignés à droite du header --}}
        <div class="header-search">
            <div class="search-icon" onclick="toggleSearch()">
                <i class="fa fa-search"></i>
            </div>
            <br><br><br><br><br><br><br>
            <input 
                type="text" 
                id="searchInput" 
                class="search-input" 
                placeholder="Rechercher un produit..." 
                onkeyup="filterProducts()"
            >
        </div>
    </div>

    <!-- Section Produits -->
    <section class="product_section layout_padding">
        <div class="container">

            <!-- Liste des produits -->
            <div class="row">
                @forelse ($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-4 mb-4">
                        <div class="box">
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

            <!-- Pagination -->
            <div class="mt-3 d-flex justify-content-center">
                {!! $products->appends(request()->all())->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </section>

    @include('home.footer')

    <!-- JS -->
    <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('home/js/popper.min.js') }}"></script>
    <script src="{{ asset('home/js/bootstrap.js') }}"></script>
    <script src="{{ asset('home/js/custom.js') }}"></script>

    <!-- Filtrage instantané -->
    <script>
        function toggleSearch() {
            const input = document.getElementById('searchInput');
            input.classList.toggle('show');
            if (input.classList.contains('show')) input.focus();
        }

        function filterProducts() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const products = document.querySelectorAll('.box');

            products.forEach(product => {
                const name = product.querySelector('.detail-box h5').textContent.toLowerCase();
                product.parentElement.style.display = name.includes(filter) ? '' : 'none';
            });
        }
    </script>
</body>
</html>
