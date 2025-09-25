<!DOCTYPE html>
<html lang="fr">
<head>
    <base href="/public">
    @include('admin.css')
    <style type="text/css">
        .div_center {
            text-align: center;
            padding-top: 40px;
        }
        .font_size {
            font-size: 40px;
            padding-bottom: 40px;
        }
        .text_color {
            color: black;
            padding-bottom: 20px;
        }
        label {
            display: inline-block;
            width: 200px;
        }
        .div_design {
            padding-bottom: 15px;
        }
        .product-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container-scroller">
    @include('admin.sidebar')
    @include('admin.header')

    <div class="main-panel">
        <div class="content-wrapper">

            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session()->get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">×</button>
                </div>
            @endif

            <div class="div_center">
                <h1 class="font_size">Modifier le produit</h1>

                <form action="{{ route('admin.products.update', $product->reference) }}" method="POST" enctype="multipart/form-data">
                     @csrf
                    @method('PUT')

                    <div class="div_design">
                        <label>Référence du produit</label>
                        <input class="text_color" type="text" name="reference" 
                               value="{{ old('reference', $product->reference) }}" required>
                    </div>

                    <div class="div_design">
                        <label>Description du produit</label>
                        <input class="text_color" type="text" name="description" 
                               value="{{ old('description', $product->description) }}" required>
                    </div>

                    <div class="div_design">
                        <label>Prix du produit</label>
                        <input class="text_color" type="number" min="0" step="0.01" 
                               name="price" value="{{ old('price', $product->price) }}" required>
                    </div>

                    <div class="div_design">
                        <label>Prix promotionnel</label>
                        <input class="text_color" type="number" min="0" step="0.01"
                               name="discount_price" value="{{ old('discount_price', $product->discount_price) }}">
                    </div>

                    <div class="div_design">
                        <label>Quantité du produit</label>
                        <input class="text_color" type="number" min="0" 
                               name="quantity" value="{{ old('quantity', $product->quantity) }}" required>
                    </div>

                    <div class="div_design">
                        <label>Catégorie du produit</label>
                        <select class="text_color" name="id_category" required>
                            <option value="" disabled>-- Sélectionnez une catégorie --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->id_category == $category->id ? 'selected' : '' }}>
                                    {{ $category->catagory_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="div_design">
                        <label>Image actuelle du produit</label>
                        @if($product->image && file_exists(public_path('product/'.$product->image)))
                            <img src="product/{{$product->image}}" alt="{{$product->reference}}" class="product-img">
                        @else
                            <p>Aucune image disponible</p>
                        @endif
                    </div>

                    <div class="div_design">
                        <label>Changer l'image du produit</label>
                        <input type="file" name="image" accept="image/*">
                    </div>

                    <div class="div_design">
                        <input type="submit" value="Mettre à jour le produit" class="btn btn-primary">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@include('admin.script')
</body>
</html>
