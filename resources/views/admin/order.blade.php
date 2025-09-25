<html lang="fr">
<head>
    @include('admin.css')
    <style>
        .title_deg { 
            text-align: center; 
            font-size: 40px; 
            padding-bottom: 40px; 
        }
        .table_deg {
            width: 100%; 
            margin: auto; 
            text-align: center; 
            border-collapse: collapse;
        }
        .table_deg th, .table_deg td {
            border: 2px solid rgb(40, 27, 181);
            padding: 12px;
        }
        .th_color {
            background: rgb(40, 27, 181); 
            color: white; 
        }
        .search_form {
            padding-left: 50%;
            transform: translateX(-50%);
            padding-bottom: 30px;
        }
        .badge-status {
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
        }
        .badge-paid { background-color: #28a745; color: #fff; }
        .badge-pending { background-color: #ffc107; color: #000; }
        .badge-delivered { background-color: #00ff8c; color: #000; }
        .badge-processing { background-color: #17a2b8; color: #fff; }
    </style>
</head>
<body>
<div class="container-scroller">
    @include('admin.sidebar')
    @include('admin.header')

    <div class="main-panel">
        <div class="content-wrapper">

            <h2 class="title_deg">Commandes</h2>

            <!-- Formulaire de recherche -->
            <div class="search_form">
                <form action="{{ route('admin.orders.search') }}" method="GET">
                    <input type="text" name="search" placeholder="Rechercher..." value="{{ request('search') }}">
                    <input type="submit" value="Rechercher" class="btn btn-outline-primary">
                </form>
            </div>

            <!-- Tableau des commandes -->
            <table class="table_deg">
                <thead class="th_color">
                    <tr>
                        <th>Nom</th>
                        <th>E-mail</th>
                        <th>Adresse</th>
                        <th>Téléphone</th>
                        <th>Description</th>
                        <th>Quantité</th>
                        <th>Prix (DH)</th>
                        <th>Statut livraison</th>
                        {{-- <th>Statut piemant</th> --}}
                        <th>Livré</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->product_title }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ number_format($order->total_price, 2) }}</td>

                        <!-- Statut livraison -->
                        <td>
                            @if(strtolower($order->delivery_status) == 'delivered')
                                <span class="badge-status badge-delivered">Livré</span>
                            @else
                                <span class="badge-status badge-processing">En cours ⏳</span>
                            @endif
                        </td>

                        <!-- Statut piemant -->
                        {{-- <td>
                            @if(strtolower($order->payment_status) == 'delivered')
                                <span class="badge-status badge-delivered">payé</span>
                            @else
                                <span class="badge-status badge-processing">En cours ⏳</span>
                            @endif
                        </td>
 --}}
                        <!-- Bouton Livré -->
                        <td>
                            @if($order->delivery_status == 'processing')
                                <a href="{{ route('admin.orders.delivered', $order->id) }}"
                                   onclick="return confirm('Êtes-vous sûr que le produit est livré ?')"
                                   class="btn btn-sm btn-primary">Marquer comme livré</a>
                            @else
                                <span class="text-success fw-bold">✔️</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted fs-5">Aucune commande trouvée</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>

@include('admin.script')
</body>
</html>
