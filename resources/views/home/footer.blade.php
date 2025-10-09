<!-- Ajoute ceci dans ton <head> si ce n'est pas déjà fait -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<footer class="footer_section"> 
    <div class="container">
       <div class="row">
          <!-- Logo + infos -->
          <div class="col-md-4">
              <div class="full">
                 <div class="logo_footer">
                    <a href="{{url('/')}}">
                        <img width="200" src="{{ asset('images/bluestrek.png') }}" alt="Logo" />
                    </a>
                 </div>
                 <div class="information_f">
                   <p>
                      <strong>ADRESSE :</strong> 
                      <a style="color: #2225d3;" 
                         href="https://www.google.com/maps/place/BLUESTREK+LTD/@33.5797394,-7.559345,17z/data=!3m1!4b1!4m6!3m5!1s0xda62df0c4a1c867:0x1705e1b13417b4fe!8m2!3d33.5797394!4d-7.5567701!16s%2Fg%2F11rmw3qn9y?entry=ttu">
                         Antaria 1, N°19 Hay Mohammadi, Casablanca, Maroc
                      </a>
                   </p>
                   <p>
                      <strong>TÉLÉPHONE :</strong> 
                      <a style="color: #2225d3;" href="tel:+212522620621">+212522620621</a>
                   </p>
                   <p>
                      <strong>EMAIL :</strong> 
                      <a style="color: #2225d3;" href="mailto:bluestrekltd@gmail.com">bluestrekltd@gmail.com</a>
                   </p>
                 </div>

                 <!-- Réseaux sociaux -->
                 <div class="footer_social">
                    <a href="https://wa.me/+212661110918" class="whatsApp" target="_blank">
                       <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="https://www.facebook.com/profile.php?id=61576051897243" class="facebook" target="_blank">
                       <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://x.com/KarimSsmc?t=-m2TOHk3GmrOanhD1qzatQ&s=09" class="twitter" target="_blank">
                       <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/company/bluestrek/" class="linkedin" target="_blank">
                       <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="https://www.instagram.com/bluestrek_0661110918?igsh=dDV5dmN6Z21zaGIx" class="instagram" target="_blank">
                       <i class="fab fa-instagram"></i>
                    </a>
                 </div>  
              </div>
          </div>

          <!-- Menu + compte -->
          <div class="col-md-8">
             <div class="row">
                <div class="col-md-7">
                   <div class="row">
                      <div class="col-md-6">
                         <div class="widget_menu">
                            <h3>Menu</h3>
                            <ul>
                               <li><a style="color: #2225d3;" href="{{url('/')}}">Accueil</a></li>
                               <li><a style="color: #2225d3;" href="{{url('/about')}}">À propos</a></li>
                               <li><a style="color: #2225d3;" href="{{url('/pproduct')}}">Produits</a></li>
                            </ul>
                         </div>
                      </div>
                      <div class="col-md-6">
                         <div class="widget_menu">
                            <h3>Compte</h3>
                            <ul>
                               <li><a style="color: #2225d3;" href="{{ route('client.login') }}">Connexion</a></li>
                               <li><a style="color: #2225d3;" href="{{ route('client.register') }}">Inscription</a></li>
                               @if (Auth::guard('client')->check())
    <!-- Si le client est connecté -->
    <li>
        <a style="color: #2225d3;" href="{{ url('client/show_cart') }}">
            Panier
        </a>
    </li>
@else
    <!-- Si aucun client connecté -->
    <li>
        <a style="color: #2225d3;" href="{{route('client.login') }}">
            Panier
        </a>
    </li>
@endif
                            </ul>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>

       <!-- Ligne du bas fixée -->
       <div class="footer_bottom text-center mt-3">
          Tous les droits sont réservés &copy; {{ date('Y') }} BluestrekLTD
       </div>
    </div>
</footer>
