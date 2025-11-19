<!DOCTYPE html>
<html lang="fr">
<head>
    <base href="/public">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Détails du produit</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/responsive.css') }}">

    <style>
        body { font-family: "Inter", sans-serif; background: #f4f6f8; color: #333; }

        .product-section {
            max-width: 1100px;
            margin: 50px auto;
            padding: 25px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.07);
        }

        .product-layout {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            align-items: flex-start;
        }

        /* IMAGE PRODUIT */
        .product-image { flex: 1 1 40%; text-align: center; }
        .product-image img {
            width: 100%;
            max-width: 380px;
            border-radius: 14px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.12);
            transition: 0.3s;
        }
        .product-image img:hover { transform: scale(1.03); }

        /* INFOS PRODUIT */
        .product-info { flex: 1 1 50%; }
        .product-info h1 { font-size: 2rem; font-weight: 700; margin-bottom: 15px; color: #0b3d91; }

        .price-box { margin-bottom: 20px; }
        .price-discount { font-size: 1.7rem; font-weight: 800; color: #0d6efd; }
        .price-original { text-decoration: line-through; color: #dc3545; margin-left: 8px; }

        .description { margin-bottom: 18px; color: #444; line-height: 1.6; }

        .fiche-technique { margin-top: 30px; }
        .fiche-technique h4 { color: #0d6efd; font-weight: 700; margin-bottom: 8px; }

        .fiche-technique ul { padding-left: 20px; list-style: disc; margin-bottom: 15px; }

        /* IMAGE FICHE TECHNIQUE */
        .fiche-technique-image {
            margin-top: 20px;
            text-align: center;
        }
        .fiche-technique-image img {
            max-width: 100%;
            width: 450px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        }

        .quantity-add { display: flex; gap: 10px; margin-top: 20px; }
        .quantity-add input[type="number"] {
            width: 90px; padding: 8px; border-radius: 8px; border: 1px solid #ddd;
        }
        .add-cart-btn {
            background: #0d6efd; color: #fff;
            padding: 10px 20px; border-radius: 8px;
            border: none; font-weight: 600;
            cursor: pointer;
        }
        .add-cart-btn:hover { background: #0b5ed7; }

        @media (max-width: 768px) {
            .product-layout { flex-direction: column; }
            .product-image img { max-width: 280px; }
        }
    </style>
</head>

<body>

@include('home.header')

<section class="product-section">
    <div class="product-layout">

        <!-- IMAGE PRODUIT -->
        <div class="product-image">
            <img src="{{ asset('product/'.$product->image) }}" alt="Image {{ $product->reference }}">
        </div>

        <!-- INFOS PRODUIT -->
        <div class="product-info">
            <h1>{{ $product->description }}</h1>

            <!-- PRIX -->
            <div class="price-box">
                @if($product->discount_price)
                    <span class="price-discount">{{ $product->discount_price }} DH</span>
                    <span class="price-original">{{ $product->price }} DH</span>
                @else
                    <span class="price-discount">{{ $product->price }} DH</span>
                @endif
            </div>

            <!-- DESCRIPTION -->
            <p class="description">{{ $product->description }}</p>

            <!-- FICHE TECHNIQUE -->
            @if($product->ficheTechnique)
                <div class="fiche-technique">

                    <!-- Dimensions -->
                    @if($product->ficheTechnique->longueur || $product->ficheTechnique->largeur || $product->ficheTechnique->profondeur)
                        <h4>Dimensions :</h4>
                        <ul>
                            @if($product->ficheTechnique->longueur)
                                <li>Longueur : {{ $product->ficheTechnique->longueur }} cm</li>
                            @endif
                            @if($product->ficheTechnique->largeur)
                                <li>Largeur : {{ $product->ficheTechnique->largeur }} cm</li>
                            @endif
                            @if($product->ficheTechnique->profondeur)
                                <li>Profondeur : {{ $product->ficheTechnique->profondeur }} cm</li>
                            @endif
                        </ul>
                    @endif

                    <!-- Couleurs -->
@if(!empty($product->ficheTechnique->colors))
    <h4>Couleurs disponibles :</h4>
    <div class="color-buttons" style="display:flex; gap:8px; margin-top:5px; flex-wrap: wrap;">
        @foreach($product->ficheTechnique->colors as $color)
            <span title="{{ $color }}" 
                  style="width:30px; height:30px; border-radius:6px; border:1px solid #ccc; 
                         background-color: {{ strtolower($color) }}; display:inline-block;"></span><span>{{ $color }}
            </span>
        @endforeach
    </div>
@endif


                    <!-- Image fiche technique -->
                    @if($product->ficheTechnique->image)
                        <div class="fiche-technique-image">
                            <h4>Fiche Technique (Image)</h4>
                            <img src="{{ asset('fiche_technique/'.$product->ficheTechnique->image) }}"
                                 alt="Fiche technique {{ $product->reference }}">
                        </div>
                    @endif

                </div>
            @endif

            <!-- AJOUT PANIER -->
            <form action="{{ url('client/add_cart', $product->reference) }}" method="POST">
                @csrf
                <div class="quantity-add">
                    <input type="number" name="quantity" value="1" min="1">
                    <button type="submit" class="add-cart-btn">Ajouter au panier</button>
                </div>
            </form>

            @if(session()->has('message'))
                <div class="alert alert-success mt-3">{{ session('message') }}</div>
            @endif

        </div>
    </div>
</section>

@include('home.footer')

<script src="{{ asset('home/js/bootstrap.js') }}"></script>
</body>
</html>
