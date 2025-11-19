<!DOCTYPE html>
<html lang="fr">
<head>
    <base href="/public">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title>Nos produits</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/responsive.css') }}">

    <style>
        /* Conteneur principal */
        .category-belt {
            display: flex;
            overflow-x: auto;
            gap: 20px;
            padding: 20px;
            background: #f8f8f8;
            border-radius: 12px;
            white-space: nowrap;
            scroll-behavior: smooth;
            scrollbar-width: none;
        }

        .category-belt::-webkit-scrollbar {
            display: none;
        }

        .category-list {
            display: flex;
            gap: 20px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        /* Carte image */
        .category-item {
            position: relative;
            width: 220px;
            height: 220px;
            border-radius: 15px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .category-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .category-item:hover img {
            transform: scale(1.08);
        }

        /* Nom sur image */
        .category-name {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.55);
            color: #fff;
            text-align: center;
            padding: 10px;
            font-size: 18px;
            font-weight: 600;
        }

        .list {
            text-decoration: none;
            color: inherit;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .category-item {
                width: 150px;
                height: 150px;
            }
            .category-name {
                font-size: 14px;
            }
        }

        header, .navbar {
            position: relative;
            z-index: 1050;
        }
    </style>
</head>

<body>

    {{-- @include('home.header') --}}

    <section class="product_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Nos <span>produits</span></h2>
            </div>

            <div class="category-belt">
                <ul class="category-list">
                    @foreach ($categories as $cat)
                        @if (!empty($cat->image))
                            <li>
                                <a class="list" href="{{ route('products.byCategory', $cat->id) }}">
                                    <div class="category-item">
                                        <img src="/category/{{ $cat->image }}" alt="{{ $cat->catagory_name }}">
                                        <div class="category-name">{{ $cat->catagory_name }}</div>
                                    </div>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

        </div>
    </section>

    <!-- JS -->
    <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="{{ asset('home/js/bootstrap.js') }}"></script>

    <!-- Auto-scroll -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const belt = document.querySelector('.category-belt');
            let scrollAmount = 0;

            function autoScroll() {
                if (!belt) return;

                if (belt.scrollWidth - belt.clientWidth <= scrollAmount) {
                    scrollAmount = 0;
                } else {
                    scrollAmount += 1;
                }

                belt.scrollTo({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            }

            setInterval(autoScroll, 30);
        });
    </script>

</body>
</html>
