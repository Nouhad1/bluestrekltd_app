<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <title>Créer un compte</title>
   <!-- Tailwind CSS -->
   <script src="https://cdn.tailwindcss.com"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="min-h-screen flex flex-col justify-between bg-gradient-to-br from-blue-600 via-indigo-500 to-purple-600">

   <!-- Header -->
   <header class="p-4 text-white text-lg font-bold flex justify-between items-center">
      @include('home.header');
   </header>

   <!-- Register Card -->
   <main class="flex-grow flex items-center justify-center px-4 py-10">
      <div class="w-full max-w-md bg-white/20 backdrop-blur-xl shadow-2xl rounded-2xl p-8 border border-white/30">

         <!-- Title -->
         <div class="text-center mb-6">
            <a href="{{ url('/') }}">
               <img src="{{ asset('images/hassan.png') }}" alt="Logo" class="h-12 mx-auto mb-3">
            </a>
            <h2 class="text-3xl font-extrabold text-white mb-2">Créer un compte</h2>
            <p class="text-gray-200 text-sm">
               Déjà inscrit ? 
               <a href="{{ route('login') }}" class="text-white font-semibold hover:underline">Connectez-vous</a>
            </p>
         </div>

         <!-- Validation Errors -->
         <x-validation-errors class="mb-4 text-red-300" />

         <!-- Form -->
         <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <input type="text" name="name" placeholder="Nom complet" value="{{ old('name') }}"
               class="w-full px-4 py-3 rounded-lg bg-white/90 border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none" required autofocus>

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
               class="w-full px-4 py-3 rounded-lg bg-white/90 border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none" required>

            <div class="flex gap-2">
               <select name="country_code" class="w-1/3 px-4 py-3 rounded-l-lg bg-white/90 border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                  @php
                     $countries = [
                        ['code'=>'+212','name'=>'Maroc'],
                        ['code'=>'+33','name'=>'France'],
                        ['code'=>'+44','name'=>'Royaume-Uni'],
                        ['code'=>'+1','name'=>'USA'],
                     ];
                  @endphp
                  @foreach($countries as $c)
                     <option value="{{ $c['code'] }}">{{ $c['code'] }}</option>
                  @endforeach
               </select>
               <input type="tel" name="phone" placeholder="Téléphone" value="{{ old('phone') }}"
                  class="w-2/3 px-4 py-3 rounded-r-lg bg-white/90 border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none" required>
            </div>

            <input type="text" name="address" placeholder="Adresse" value="{{ old('address') }}"
               class="w-full px-4 py-3 rounded-lg bg-white/90 border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none" required>

            <input type="password" name="password" placeholder="Mot de passe"
               class="w-full px-4 py-3 rounded-lg bg-white/90 border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none" required>

            <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe"
               class="w-full px-4 py-3 rounded-lg bg-white/90 border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none" required>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
               <label class="flex items-center text-gray-200 text-sm">
                  <input type="checkbox" name="terms" required class="mr-2 rounded border-gray-300 text-indigo-600 focus:ring focus:ring-indigo-400">
                  {!! __('J’accepte les :terms_of_service et la :privacy_policy', [
                     'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline">Conditions d’utilisation</a>',
                     'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline">Politique de confidentialité</a>',
                  ]) !!}
               </label>
            @endif

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg shadow-lg transition duration-300">
               <i class="fa-solid fa-user-plus mr-2"></i> Créer un compte
            </button>
         </form>

         <!-- Divider -->
         <div class="flex items-center my-6">
            <hr class="flex-grow border-gray-400">
            <span class="mx-3 text-gray-200 text-sm">OU</span>
            <hr class="flex-grow border-gray-400">
         </div>

         <!-- Social Buttons -->
         <div class="space-y-3">
            <button class="w-full flex items-center justify-center gap-2 bg-white/90 hover:bg-gray-200 text-gray-700 font-medium py-3 rounded-lg shadow-md transition">
               <i class="fa-brands fa-google text-red-500"></i> Continuer avec Google
            </button>
            <button class="w-full flex items-center justify-center gap-2 bg-white/90 hover:bg-gray-200 text-gray-700 font-medium py-3 rounded-lg shadow-md transition">
               <i class="fa-brands fa-facebook text-blue-600"></i> Continuer avec Facebook
            </button>
         </div>

      </div>
   </main>

   <!-- Footer -->
   <footer class="bg-white/10 backdrop-blur-md text-white py-4 text-center text-sm">
      <p>© 2025 Bluestrek | Casablanca, Maroc | Tel: +212 710678089</p>
      <div class="flex justify-center gap-4 mt-2">
         <a href="#"><i class="fab fa-facebook"></i></a>
         <a href="#"><i class="fab fa-twitter"></i></a>
         <a href="#"><i class="fab fa-linkedin"></i></a>
         <a href="#"><i class="fab fa-instagram"></i></a>
      </div>
   </footer>

</body>
</html>
