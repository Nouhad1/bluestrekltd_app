<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <style>
        .form_deg {
            width: 50%;
            margin: auto;
            padding-top: 50px;
        }
        .form-control {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        .submit_btn {
            background-color: rgb(40, 27, 181);
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 6px;
            transition: background 0.3s;
        }
        .submit_btn:hover {
            background-color: rgb(25, 15, 120);
        }
        .alert {
            width: 50%;
            margin: 20px auto;
            text-align: center;
        }
        #newProductModal .form-control {
            margin-bottom: 10px;
        }
    </style>
    <!-- Bootstrap 5 pour modal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-scroller">
    @include('admin.sidebar')
    @include('admin.header')

    <div class="main-panel">
        <div class="content-wrapper">
            <h2 class="text-center" style="padding-bottom: 20px;">Ajouter/Modifier entrée</h2>

            {{-- Flash message --}}
            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            {{-- Formulaire principal (référence + quantité) --}}
            <form class="form_deg" action="{{ route('admin.store_entry') }}" method="POST">
                @csrf
                <input id="reference" class="form-control" type="text" name="reference" placeholder="Référence" required>
                <input id="quantity" class="form-control" type="number" name="quantity" placeholder="Quantité" min="1" required>

                {{-- Erreurs --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin-bottom:0;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <input type="submit" class="submit_btn" value="Entregistrer une entrée">
            </form>

        </div>
    </div>
</div>

@include('admin.script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
