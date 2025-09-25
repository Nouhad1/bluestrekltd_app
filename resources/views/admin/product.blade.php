<!DOCTYPE html> 
<html lang="fr">
<head>
    @include('admin.css')
    <style type="text/css">
        .div_center {
            max-width: 600px;
            margin: 40px auto; /* centre le bloc dans la page */
            text-align: left;  /* force l’alignement à gauche */
        }
        .font_size {
            font-size: 40px;
            padding-bottom: 40px;
            text-align: center; /* titre centré uniquement */
        }
        .text_color {
            color: black;
            padding-bottom: 20px;
        }
        .div_design {
            padding-bottom: 15px;
            display: flex;
            align-items: center; /* aligne label + input */
        }
        label {
            width: 200px;
            font-weight: bold;
        }
        .texte_color {
            flex: 1; /* prend toute la largeur restante */
            padding: 6px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        select.texte_color {
            height: 38px;
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
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="div_center">
                <h1 class="font_size">Ajouter un produit</h1>

                <form action="{{ route('admin.products.add') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="div_design">
                        <label>Référence du produit</label>
                        <input class="texte_color" type="text" name="reference" placeholder="Entrez la référence du produit" required>
                    </div>

                    <div class="div_design">
                        <label>Description du produit</label>
                        <input class="texte_color" type="text" name="description" placeholder="Écrivez une description" required>
                    </div>

                    <div class="div_design">
                        <label>Prix du produit</label>
                        <input class="texte_color" type="number" min="0" step="0.01" name="price" placeholder="Entrez le prix" required>
                    </div>

                    <div class="div_design">
                        <label>Prix promotionnel</label>
                        <input class="texte_color" type="number" min="0" step="0.01" name="discount_price" placeholder="Entrez le prix promotionnel (facultatif)">
                    </div>

                    <div class="div_design">
                        <label>Quantité du produit</label>
                        <input class="texte_color" type="number" name="quantity" placeholder="Entrez la quantité" required>
                    </div>

                    <div class="div_design">
                        <label>Catégorie du produit</label>
                        <select class="texte_color" name="id_category" required>
                            <option value="" selected disabled>-- Sélectionnez la catégorie --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->catagory_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="div_design">
                        <label>Image du produit</label>
                        <input type="file" name="image" accept="image/*" required>
                    </div>

                    <div class="div_design" style="justify-content: center;">
                        <input type="submit" value="Ajouter le produit" class="btn btn-primary">
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
@include('admin.script')
</body>
</html>
