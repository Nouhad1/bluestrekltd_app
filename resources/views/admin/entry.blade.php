<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <style>
        /* TITRE */
        .title_deg {
            text-align: center;
            font-size: 40px;
            padding-bottom: 40px;
        }

        /* TABLEAU */
        .table_deg {
            border: 2px solid rgb(40, 27, 181);
            width: 100%;
            margin: auto;
            margin-top: 20px;
            text-align: center;
            border-collapse: collapse;
        }

        .th_color {
            background: rgb(40, 27, 181);
            color: white;
            padding: 10px;
        }

        td {
            border: 2px solid rgb(40, 27, 181);
            padding: 8px;
        }

        .img_size {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .alert {
            width: 50%;
            margin: 20px auto;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container-scroller">
    @include('admin.sidebar')
    @include('admin.header')

    <div class="main-panel">
        <div class="content-wrapper">

            <h2 class="title_deg">Entrées</h2>

            {{-- Flash messages --}}
            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <!-- TABLEAU DES ENTRIES -->
            <table class="table_deg">
                <tr>
                    <th class="th_color">Référence</th>
                    <th class="th_color">Description</th>
                    <th class="th_color">Quantité</th>
                    <th class="th_color">Date</th>
                </tr>

                @forelse($entries as $entry)
                <tr>
                    <td>{{ $entry->product_reference }}</td>
                    <td>{{ $entry->description ?? '-' }}</td>
                    <td>{{ $entry->quantity }}</td>
                    <td>{{ \Carbon\Carbon::parse($entry->created_at)->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">Aucune entrée trouvée</td>
                </tr>
                @endforelse
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {!! $entries->appends(request()->all())->links('pagination::bootstrap-5') !!}
            </div>

        </div>
    </div>
</div>

@include('admin.script')
</body>
</html>
