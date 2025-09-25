<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Bluestrek</title>

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}" />
    <!-- Styles personnalisés -->
    <link rel="stylesheet" href="{{ asset('home/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('home/css/responsive.css') }}" />

    <style>
        /* Footer fixe en bas */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .footer_section {
            background-color: #f8f9fa;
            padding: 40px 0 20px;
            margin-top: auto;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
        }

        .footer_section h4 {
            font-weight: bold;
            margin-bottom: 15px;
        }

        .footer_section p {
            font-size: 14px;
            line-height: 1.6;
        }

        .footer_social a {
            display: inline-block;
            margin: 0 5px;
            color: #2563eb;
            font-size: 16px;
            transition: color 0.3s;
        }

        .footer_social a:hover {
            color: #1e40af;
        }

        .footer_social a {
                margin: 0 8px;
        }

        .footer-info {
            font-size: 13px;
            color: #555;
            margin-top: 15px;
        }

        /* Responsive Map */
        .map_container {
            width: 100%;
            height: 150px;
            background: #e9ecef;
            border-radius: 8px;
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .footer_section .row {
                text-align: center;
            }
            .footer_col {
                margin-bottom: 20px;
            }
            .footer_social a {
                margin: 0 8px;
            }
        }
    </style>
</head>
<body class="sub_page">

    <!-- Hero & Header -->
    <div class="hero_area">
        @include('home.header')
    </div>

    <!-- Contenu principal -->
    <main class="flex-fill">
        <section class="inner_page_head">
            <div class="container_fuild">
                <div class="row">
                    <div class="col-md-12">
                        <div class="full">
                            <h3>À propos de nous</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('home.why')
        @include('home.new_arival')
    </main>

    <!-- Footer -->
    @include('home.footer')
    {{-- <footer class="footer_section">
        <div class="container">
            <div class="row">
                <!-- Contact -->
                <div class="col-md-4 footer-col">
                    <h4 style="color: #7529CC;">Nous contacter</h4>
                    <div class="contact_link_box">
                        <a href="#"><i class="fa fa-map-marker"></i><span>Maroc, Casablanca</span></a>
                        <a href="tel:+2125102030405"><i class="fa fa-phone"></i><span>+212 5102030405</span></a>
                        <a href="mailto:bluestrek@gmail.com"><i class="fa fa-envelope"></i><span>bluestrek@gmail.com</span></a>
                    </div>
                </div>

                <!-- Logo & Description -->
                <div class="col-md-4 footer-col text-center">
                    <a href="{{ url('products') }}" class="footer-logo">
                        <img width="150" src="{{ asset('images/hassan.png') }}" alt="Logo Bluestrek" />
                    </a>
                    <p>
                        Achetez en toute confiance, en sachant que nous privilégions la qualité, la fiabilité et la satisfaction des clients.
                    </p>
                    <div class="footer_social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>

                <!-- Map -->
                <div class="col-md-4 footer-col">
                    <div class="map_container">
                        <div id="googleMap"></div>
                    </div>
                </div>
            </div>

            <div class="footer-info text-center mt-3">
                &copy; {{ date('Y') }} Bluestrek. Tous droits réservés.
            </div>
        </div>
    </footer> --}}

    <!-- Scripts -->
    <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('home/js/popper.min.js') }}"></script>
    <script src="{{ asset('home/js/bootstrap.js') }}"></script>
    <script src="{{ asset('home/js/custom.js') }}"></script>

</body>
</html>
