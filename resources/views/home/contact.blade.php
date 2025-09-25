<!DOCTYPE html>
<html>
   <head>
      <!-- Basique -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Métas mobiles -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Métas du site -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Contactez-nous</title>
      <!-- Feuilles de style -->
      <link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}">
      <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}">
      <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
      <link rel="stylesheet" href="{{ asset('home/css/responsive.css') }}">
   </head>
   <body class="sub_page">
      <div class="hero_area">
         <!-- Début header -->
         @include('home.header')
         <!-- Fin header -->
      </div>

      <!-- Section de titre -->
      <section class="inner_page_head">
         <div class="container_fuild">
            <div class="row">
               <div class="col-md-12">
                  <div class="full">
                     <h3>Contactez-nous</h3>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- Fin section de titre -->

      <!-- Section contact -->
      <section class="why_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 offset-lg-2">
                  <div class="full">
                     {{-- <form action="{{route ('contact')}}" method="GET">
                        <fieldset>
                           <input type="text" placeholder="Votre nom complet"  value="{{ Auth::guard('client')->user()->name ?? '' }}" name="name" required />
                           <input type="email" placeholder="Votre adresse email" value="{{ Auth::guard('client')->user()->email ?? '' }}" name="email" required />
                           <input type="text" placeholder="Sujet" name="subject" required />
                           <textarea placeholder="Votre message" name="message" required></textarea>
                           </fieldset>
                     </form>

                     <form action="{{ route('contact.submit') }}" method="POST">
                           <input type="submit" value="Envoyer" />
                     </form> --}}

                     <form action="{{ route('contact.submit') }}" method="POST">
    @csrf
    <fieldset>
       <input type="text" placeholder="Votre nom complet"  
              value="{{ Auth::guard('client')->user()->name ?? '' }}" 
              name="name" required />
       
       <input type="email" placeholder="Votre adresse email" 
              value="{{ Auth::guard('client')->user()->email ?? '' }}" 
              name="email" required />
       
       <input type="text" placeholder="Sujet" name="subject" required />
       
       <textarea placeholder="Votre message" name="message" required></textarea>
       
       <input type="submit" value="Envoyer" />
    </fieldset>
</form>

                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- Fin section contact -->

       <!-- arrival section -->
     {{--  <section class="arrival_section">
         <div class="container">
            <div class="box">
               <div class="arrival_bg_box">
                  <img src="images/arrival-bg.png" alt="">
               </div>
               <div class="row">
                  <div class="col-md-6 ml-auto">
                     <div class="heading_container remove_line_bt">
                        <h2>
                           #NewArrivals
                        </h2>
                     </div>
                     <p style="margin-top: 20px;margin-bottom: 30px;">
                        Vitae fugiat laboriosam officia perferendis provident aliquid voluptatibus dolorem, fugit ullam sit earum id eaque nisi hic? Tenetur commodi, nisi rem vel, ea eaque ab ipsa, autem similique ex unde!
                     </p>
                     <a href="">
                     Shop Now
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </section> --}}
      <!-- end arrival section -->
      
      <!-- Pied de page -->
      {{-- <footer class="footer_section">
         <div class="container">
            <div class="row">
               <div class="col-md-4 footer-col">
                  <div class="footer_contact">
                     <h4 style="color:#0d1397;" >
                        Nous joindre
                     </h4>
                     <div class="contact_link_box">
                        <a href="https://www.google.com/maps/place/BLUESTREK+LTD/@33.5797394,-7.559345,17z/data=!3m1!4b1!4m6!3m5!1s0xda62df0c4a1c867:0x1705e1b13417b4fe!8m2!3d33.5797394!4d-7.5567701!16s%2Fg%2F11rmw3qn9y?entry=ttu&g_ep=EgoyMDI1MDkxMC4wIKXMDSoASAFQAw%3D%3D">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        <span>
                         Casablanca, Maroc
                        </span>
                        </a>
                        <a href="tel:+2125102030405">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <span>
                        Appelez-nous : +212 5102030405
                        </span>
                        </a>
                        <a href="mailto:bluestrek@gmail.com">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <span>
                        bluesrekltd@gmail.com
                        </span>
                        </a>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 footer-col">
                  <div class="footer_detail">
                     <a href="index.html" class="footer-logo" style="color:#0d1397;">
                        {{-- Bluestrek LTD --}}
                        {{-- <div class="logo_footer">
                    <img width="150" src="{{ asset('images/hassan.png') }}" alt="Logo" />
                 </div>
                     </a>
                     <p style="color:#000;">
                         Notre entreprise s'engage à fournir des produits de qualité et un service professionnel, 
                         afin de répondre au mieux aux besoins de nos clients.                     </p>
                     <div class="footer_social">
                        <a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href=""><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        <a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        <a href=""><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 footer-col">
                  <div class="map_container">
                     <div class="map">
                        <div id="googleMap"></div>
                     </div>
                  </div>
               </div>
            </div> --}}
            <!-- Bas du footer -->
     {{--  <div class="footer-info">
         <div class="col-lg-7 mx-auto px-0">
            <p style="color: #000">
                <span id="displayYear"></span> Tous droits réservés&copy;Bluestrek LTD 
            </p>
         </div>
      </div>
   </div>

      </footer> --}}
      @include('home.footer')
      <!-- Fin pied de page -->

      <!-- Scripts -->
      <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
      <script src="{{ asset('home/js/popper.min.js') }}"></script>
      <script src="{{ asset('home/js/bootstrap.js') }}"></script>
      <script src="{{ asset('home/js/custom.js') }}"></script>
   </body>
</html>
