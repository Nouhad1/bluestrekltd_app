<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Profil du client</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/responsive.css') }}">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .profile-container {
            max-width: 1200px;
            margin: 40px auto;
        }

        .card-profile {
            background: #fff;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 40px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .card-profile h3 {
            color: #4B0082;
            margin-bottom: 25px;
            font-weight: bold;
            text-align: center;
        }

        .form-control {
            margin-bottom: 15px;
            text-align: center;
            border-radius: 8px;
        }

        .btn-submit {
            background-color: #28a745;
            color: #fff;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .alert-success {
            margin-bottom: 25px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #e0e0e0;
            text-align: center;
        }

        table th {
            background-color: rgba(3, 19, 165, 0.799);
            color: #fff;
        }

        table tbody tr:hover {
            background-color: #f1f1f1;
        }

        @media (max-width: 767px) {
            .form-control { text-align: left; }
        }
    </style>
</head>
<body>

@include('home.header')

<div class="container profile-container">
    <!-- Titre -->
    <div class="card-profile">
        <h3>Profil de {{ Auth::guard('client')->user()->name ?? '' }}</h3>

        <!-- Message de succès -->
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <!-- Formulaire mise à jour -->
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
    </div>

    <!-- Historique des commandes -->
    <div class="card-profile">
        <h3>Historique des commandes</h3>

        @if($orders->isEmpty())
            <p class="text-center">Aucune commande passée.</p>
        @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix unitaire (DH)</th>
                            <th>Total (DH)</th>
                            <th>Statut de livraison</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                <td>{{ $order->product_title ?? 'Produit supprimé' }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ number_format($order->price ?? 0, 2) }}</td>
                                <td>{{ number_format($order->total_price, 2) }}</td>
                                <td>{{ ucfirst($order->delivery_status) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@include('home.footer')

<script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('home/js/popper.min.js') }}"></script>
<script src="{{ asset('home/js/bootstrap.js') }}"></script>

</body>
</html>
