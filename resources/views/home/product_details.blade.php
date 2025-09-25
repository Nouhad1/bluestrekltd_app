<!DOCTYPE html>
<html lang="fr">
<head>
  <base href="/public">
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Détails du produit</title>

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('home/css/responsive.css') }}">

  <style>
    body { font-family: "Inter", sans-serif; background: #f9fafb; color: #333; }
    .product-section { max-width: 1100px; margin: 60px auto; padding: 30px; }
    .product-layout { display: flex; gap: 40px; flex-wrap: wrap; align-items: flex-start; }
    .product-image { flex: 1 1 45%; text-align: center; }
    .product-image img { max-width: 30%; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); transition: transform 0.3s ease; }
    .product-image img:hover { transform: scale(1.03); }
    .product-info { flex: 1 1 50%; }
    .product-info h1 { font-size: 2rem; font-weight: 700; color: #000; margin-bottom: 15px; }
    .price-box { margin-bottom: 20px; }
    .price-discount { font-size: 1.3rem; font-weight: 700; color: #16a34a; }
    .price-original { text-decoration: line-through; color: #dc2626; margin-left: 10px; font-size: 1rem; }
    .description { margin-bottom: 20px; line-height: 1.6; }
    .fiche-technique h4 { font-size: 1.1rem; font-weight: 600; margin-bottom: 10px; color: #2563eb; }
    .fiche-technique ul { padding-left: 20px; list-style: disc; margin-bottom: 20px; }
    .quantity-add { display: flex; gap: 10px; align-items: center; margin-bottom: 20px; }
    .quantity-add input[type="number"] { width: 100px; border-radius: 8px; padding: 8px; border: 1px solid #ddd; }
    .add-cart-btn { background: linear-gradient(135deg, #2563eb, #1e40af); color: #fff; border: none; padding: 10px 25px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: background 0.3s ease; }
    .add-cart-btn:hover { background: linear-gradient(135deg, #1d4ed8, #1e3a8a); }
    .alert-success { border-radius: 8px; margin-top: 10px; }
    @media (max-width: 768px) { .product-layout { flex-direction: column; } }
  </style>
</head>
<body>
  <!-- Header -->
  @include('home.header')

  <!-- Détails Produit -->
  <section class="product-section">
    <div class="product-layout">
      <!-- Image -->
      <div class="product-image">
        <img src="{{ asset('product/'.$product->image) }}" alt="{{ $product->reference }}">
      </div>

      <!-- Infos -->
      <div class="product-info">
        <h1>{{ $product->description }}</h1>

        <!-- Prix -->
        <div class="price-box">
          @if($product->discount_price)
            <span class="price-discount">{{ $product->discount_price }} DH</span>
            <span class="price-original">{{ $product->price }} DH</span>
          @else
            <span class="price-discount">{{ $product->price }} DH</span>
          @endif
        </div>

        <!-- Description -->
        <p class="description">{{ $product->description }}</p>

       <!-- Fiche technique -->
@if($product->ficheTechnique)
  <div class="fiche-technique">
    <h4>Dimensions :</h4>
    <ul>
      <li>Longueur : {{ $product->ficheTechnique->longueur ?? '-' }} cm</li>
      <li>Largeur : {{ $product->ficheTechnique->largeur ?? '-' }} cm</li>
      <li>Profondeur : {{ $product->ficheTechnique->profondeur ?? '-' }} cm</li>
    </ul>

    
    @if(!empty($product->ficheTechnique->colors))
    <h4>Couleurs disponibles :</h4>
      <div class="colors-checkboxes">
        @foreach($product->ficheTechnique->colors as $color)
          <label style="margin-right:15px;">
            <input type="checkbox" name="colors[]" value="{{ $color }}"> {{ $color }}
          </label>
        @endforeach
      </div>
    @endif
  </div>
@endif


        <!-- Formulaire Ajouter au panier -->
        <form action="{{ url('client/add_cart', $product->reference) }}" method="POST">
          @csrf
          <div class="quantity-add">
            <input type="number" name="quantity" value="1" min="1">
            <input type="submit" value="Ajouter au panier" class="add-cart-btn">
          </div>
        </form>

        <!-- Message succès -->
        @if(session()->has('message'))
          <div class="alert alert-success">{{ session('message') }}</div>
        @endif
      </div>
    </div>
  </section>

  <!-- Footer -->
  @include('home.footer')

  <!-- Scripts -->
  
  <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('home/js/popper.min.js') }}"></script>
  <script src="{{ asset('home/js/bootstrap.js') }}"></script>
  <script src="{{ asset('home/js/custom.js') }}"></script>
</body>
</html>
