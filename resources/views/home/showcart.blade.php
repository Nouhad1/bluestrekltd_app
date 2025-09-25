<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Bon de commande</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/responsive.css') }}">

    <style>
        body { background-color: #f9f9fb; font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; }
        .cart-container { max-width: 1100px; margin: 40px auto; padding: 30px; background: #fff; border-radius: 16px; box-shadow: 0 6px 25px rgba(0,0,0,0.1); }
        .cart-title { color: #4B0082; font-weight: 700; margin-bottom: 25px; text-align: center; }
        .form-control { border-radius: 8px; padding: 12px; }
        table { border-radius: 12px; overflow: hidden; margin-top: 20px; }
        thead { background: rgba(3, 19, 165, 0.8); color: white; }
        th, td { padding: 14px; text-align: center; vertical-align: middle; }
        tfoot th { font-size: 18px; color: #333; }
        .btn-submit { background: linear-gradient(135deg, #28a745, #218838); color: #fff; padding: 12px 28px; border: none; border-radius: 10px; font-size: 15px; font-weight: bold; cursor: pointer; transition: all 0.3s ease; margin: 8px; }
        .btn-submit:hover { opacity: 0.9; transform: translateY(-2px); box-shadow: 0 4px 14px rgba(0,0,0,0.2); }
        .btn-danger { border-radius: 8px; }
    </style>
</head>
<body>

@include('home.header')

<div class="cart-container">
    <h3 class="cart-title">🛒 Bon de commande</h3>

    <!-- Message de succès -->
    @if(session()->has('message'))
        <div class="alert alert-success text-center">{{ session('message') }}</div>
    @endif

    <!-- Formulaire auto-update infos client -->
    <form action="{{ route('client.profile.update') }}" method="POST">
        @csrf
        {{-- @method('PUT') --}}
        <div class="row mb-4">
            <div class="col-md-6">
                <input type="text" name="name" class="form-control"
                       value="{{ Auth::guard('client')->user()->name ?? '' }}" required
                       onchange="this.form.submit();">
            </div>
            <div class="col-md-6">
                <input type="email" name="email" class="form-control"
                       value="{{ Auth::guard('client')->user()->email ?? '' }}" required
                       onchange="this.form.submit();">
            </div>
            <div class="col-md-6 mt-3">
                <input type="text" name="phone" class="form-control"
                       value="{{ Auth::guard('client')->user()->phone ?? '' }}" required
                       onchange="this.form.submit();">
            </div>
            <div class="col-md-6 mt-3">
                <input type="text" name="address" class="form-control"
                       value="{{ Auth::guard('client')->user()->address ?? '' }}" required
                       onchange="this.form.submit();">
            </div>
        </div>
    </form>

    <!-- Tableau du panier -->
    <div class="table-responsive">
        <table class="table table-bordered shadow-sm">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantité</th>
                    <th>Prix unitaire (DH)</th>
                    <th>Total (DH)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach($carts as $item)
                    @php 
                        $lineTotal = $item->unit_price * $item->quantity; 
                        $grandTotal += $lineTotal; 
                    @endphp
                    <tr>
                        <td>{{ $item->product_title }}</td>
                        <td>
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" 
                                       class="form-control d-inline" style="width:80px;" 
                                       onchange="this.form.submit();">
                            </form>
                        </td>
                        <td>{{ number_format($item->unit_price, 2) }}</td>
                        <td>{{ number_format($lineTotal, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">❌ Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">Total :</th>
                    <th>{{ number_format($grandTotal, 2) }} DH</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Formulaire confirmation commande -->
    <form action="{{ route('cart.confirm') }}" method="POST" class="text-center mt-4">
        @csrf
        <button type="submit" name="type" value="whatsapp" class="btn-submit">
            📲 Confirmer via WhatsApp
        </button>
        <button type="submit" name="type" value="email" class="btn-submit">
            📧 Confirmer via Gmail
        </button>
    </form>
</div>

@include('home.footer')

<script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('home/js/popper.min.js') }}"></script>
<script src="{{ asset('home/js/bootstrap.js') }}"></script>

</body>
</html>
