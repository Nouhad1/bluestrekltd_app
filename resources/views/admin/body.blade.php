<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de bord</title>
  @include('admin.css')
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet">
  <style>
    .card {
      border-radius: 10px;
      box-shadow: 0 2px 12px rgba(0,0,0,0.1);
      padding: 1rem;
    }
    .card h3 {
      font-size: 1.5rem;
      margin-bottom: 0;
    }
    .card .icon {
      font-size: 2rem;
      color: #fff;
      padding: 10px;
      border-radius: 50%;
    }
    .bg-primary { background-color: #2563eb !important; }
    .bg-success { background-color: #22c55e !important; }
    .bg-warning { background-color: #f59e0b !important; }
    .bg-danger { background-color: #ef4444 !important; }
    .table th, .table td {
      vertical-align: middle;
    }
    .chart-card {
      min-height: 300px;
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
          <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif

        <div class="row mb-4">
          <!-- Cartes statistiques -->
          @foreach([
            ['total' => $total_product, 'text' => 'Total des produits', 'icon' => 'mdi-package-variant', 'bg' => 'bg-primary'],
            ['total' => $total_order, 'text' => 'Total des commandes', 'icon' => 'mdi-cart-outline', 'bg' => 'bg-success'],
            ['total' => $total_client, 'text' => 'Total des clients', 'icon' => 'mdi-account-multiple', 'bg' => 'bg-warning'],
            ['total' => $total_revenue.' DH', 'text' => 'Chiffre d\'affaires', 'icon' => 'mdi-cash', 'bg' => 'bg-danger']
          ] as $stat)
          <div class="col-md-3 col-sm-6 mb-3">
            <div class="card text-white {{$stat['bg']}}">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h3>{{ $stat['total'] }}</h3>
                  <p>{{ $stat['text'] }}</p>
                </div>
                <div class="icon"><i class="mdi {{ $stat['icon'] }}"></i></div>
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <div class="row">
          <!-- Graphiques -->
          <div class="col-md-6 mb-3">
            <div class="card chart-card">
              <h5 style="text-align:center; margin-bottom: 20px;">
                Ventes quotidiennes - {{ $currentMonthName }}
              </h5>
              <canvas id="dailySalesChart"></canvas>
            </div>
          </div>

          <div class="col-md-6 mb-3">
            <div class="card chart-card">
              <h5 style="text-align:center; margin-bottom: 20px;">
                Chiffre d'affaires annuel - {{ $currentYearName }}
              </h5>
              <canvas id="totalRevenueChart"></canvas>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  @include('admin.script')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    // Graphique ventes quotidiennes
    const dailySalesCtx = document.getElementById('dailySalesChart').getContext('2d');
    new Chart(dailySalesCtx, {
      type: 'bar',
      data: {
          labels: {!! json_encode($daily_sales_labels) !!}, 
          datasets: [{
              label: 'Commandes',
              data: {!! json_encode($daily_sales_values) !!}, 
              backgroundColor: '#2563eb'
          }]
      },
      options: {
          responsive: true,
          plugins: {
              legend: { display: true }
          },
          scales: {
              x: { title: { display: true, text: 'Jours du mois' } },
              y: { beginAtZero: true, title: { display: true, text: 'Nombre de commandes' } }
          }
      }
    });

    // Graphique chiffre d'affaires mensuel
    const totalRevenueCtx = document.getElementById('totalRevenueChart').getContext('2d');
    new Chart(totalRevenueCtx, {
      type: 'line',
      data: {
          labels: {!! json_encode($revenue_labels) !!}, // Jan, Fév, ...
          datasets: [{
              label: 'Chiffre d\'affaires',
              data: {!! json_encode($revenue_values) !!},
              borderColor: '#22c55e',
              fill: false,
              tension: 0.3,
              pointRadius: 4,
              pointHoverRadius: 6
          }]
      },
      options: {
          responsive: true,
          plugins: {
              legend: { display: true }
          },
          scales: {
              x: { title: { display: true, text: 'Mois' } },
              y: { beginAtZero: true, title: { display: true, text: 'Chiffre d\'affaires (DH)' } }
          }
      }
    });
  </script>
</body>
</html>
