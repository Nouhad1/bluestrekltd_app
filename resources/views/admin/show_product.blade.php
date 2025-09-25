<!DOCTYPE html>
<html lang="fr">
<head>
    @include('admin.css')
    <style>
        .reference_deg {
            text-align: center;
            font-size: 40px;
            padding-bottom: 40px;
        }
        .table_deg {
            border: 2px solid #2810db;
            width: 100%;
            margin: auto;
            padding-top: 50px;
            text-align: center;
        }
        .img_size {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .th_color {
            background: #1119ec;
            color: white;
        }
        td {
            border: 2px solid #1e14e3;
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
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                </div>
            @endif

            <h2 class="reference_deg">Tous les produits</h2>

            <table class="table_deg">
                <tr class="th_color">
                    <th>Référence du produit</th>
                    <th>Description</th>
                    <th>Quantité</th>
                    <th>Catégorie</th>
                    <th>Prix</th>
                    <th>Prix promotionnel</th>
                    <th>Image du produit</th>
                    <th>Supprimer</th>
                    <th>Modifier</th>
                </tr>

                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->reference }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->catagory ?? ($product->category->catagory_name ?? 'Pas de catégorie') }}</td>
                        <td>{{ number_format($product->price, 2) }} DH</td>
                        <td>{{ $product->discount_price ? number_format($product->discount_price, 2) . ' DH' : '-' }}</td>
                        <td><img class="img_size" src="/product/{{ $product->image }}" alt="{{ $product->reference }}"></td>

                        <td>
                            <a class="btn btn-danger"
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')"
                               href="{{ route('admin.products.delete', $product->reference) }}">
                               🗑️
                            </a>
                        </td>

                        <td>
                            <a class="btn btn-success" href="{{ route('admin.products.update', $product->reference) }}">
                               ✏️
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>
</div>

@include('admin.script')
</body>
</html>
