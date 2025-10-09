<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription Client</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

  <!-- Bootstrap core css -->
  <link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('home/css/responsive.css') }}">

  <style>
    body { background-color: beige; }

    .register-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .register-card {
      background: #fff;
      border-radius: 15px;
      padding: 40px 30px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
      width: 100%;
      max-width: 800px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .register-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    }

    h2 {
      font-weight: 700;
      color: #1b04ca;
      text-align: center;
      margin-bottom: 25px;
    }

    .form-label { font-weight: 600; color: #333; }
    .form-control {
      border-radius: 10px;
      padding: 12px;
      border: 1px solid #ddd;
      transition: all 0.3s ease;
      text-transform: none; 
    }
    .form-control:focus {
      border-color: #4a90e2;
      box-shadow: 0 0 0 3px rgba(74,144,226,0.15);
    }

    .btn-register {
      width: 100%;
      border-radius: 10px;
      padding: 12px;
      font-weight: 600;
      font-size: 16px;
      background-color: #4e96e8;
      border: none;
      color: #fff;
      transition: background-color 0.3s ease;
    }
    .btn-register:hover { background-color: #6a11cb; }

    .social-btns button { margin: 5px 5px 15px 0; }

    .text-center a { color: #4a90e2; font-weight: 500; text-decoration: none; }
    .text-center a:hover { text-decoration: underline; }

    .alert { border-radius: 10px; margin-bottom: 20px; }
    .password-toggle {
      position: absolute;
      right: 10px;
      top: 70%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #888;
    }

    @media (max-width: 992px) {
      .register-img { display: none; }
    }

    @media (max-width: 576px) {
      .register-card { padding: 30px 20px; }
    }
  </style>
</head>
<body>
  @include('home.header')

  <div class="register-container container">
    <div class="row w-100">
      <!-- Formulaire -->
      <div class="col-lg-6 col-md-12 d-flex align-items-center">
        <div class="register-card w-100 position-relative">
          <h2>Créer un compte client</h2>

          <!-- Boutons sociaux -->
          {{-- <div class="social-btns text-center mb-3">
            <a href="{{ route('social.login', 'linkedin') }}" class="btn btn-outline-info"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
            <a href="{{ route('social.login', 'google') }}" class="btn btn-outline-danger"><i class="fab fa-google"></i> Google</a>
            <a href="{{ route('social.login', 'facebook') }}" class="btn btn-outline-primary"><i class="fab fa-facebook-f"></i> Facebook</a>
          </div> --}}


          <!-- Affichage des erreurs -->
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <!-- Formulaire inscription -->
          <form action="{{ route('client.register.submit') }}" method="POST" id="registerForm">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Nom complet</label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Entrez votre nom complet" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Adresse Email</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="votre@email.com" required>
              <small class="text-danger" id="emailError"></small>
            </div>

            <div class="mb-3">
              <label for="phone" class="form-label">Téléphone</label>
              <input type="tel" name="phone" id="phone" class="form-control" placeholder="+212600000000">
            </div>

            <div class="mb-3">
              <label for="address" class="form-label">Adresse</label>
              <input type="text" name="address" id="address" class="form-control" placeholder="Votre adresse complète">
            </div>

            <div class="mb-3 position-relative">
              <label for="password" class="form-label">Mot de passe</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="********" required>
              <span class="password-toggle" id="togglePassword"><i class="fa fa-eye"></i></span>
            </div>

            <div class="mb-3 position-relative">
              <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
              <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="********" required>
              <span class="password-toggle" id="toggleConfirm"><i class="fa fa-eye"></i></span>
            </div>

            <button type="submit" class="btn btn-register">S’inscrire</button>
          </form>

          <div class="text-center mt-3">
            Déjà un compte ? <a href="{{ route('client.login') }}">Se connecter</a>
          </div>
        </div>
      </div>

      <!-- Illustration -->
      <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center register-img">
        <img src="{{ asset('images/register-illustration.png') }}" alt="Illustration inscription" class="img-fluid">
      </div>
    </div>
  </div>

  @include('home.footer')

  <script>
    // Toggle mot de passe
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function () {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    const toggleConfirm = document.querySelector('#toggleConfirm');
    const passwordConfirm = document.querySelector('#password_confirmation');
    toggleConfirm.addEventListener('click', function () {
      const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordConfirm.setAttribute('type', type);
      this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    // Validation en direct email
    const emailInput = document.querySelector('#email');
    const emailError = document.querySelector('#emailError');
    emailInput.addEventListener('input', function () {
      const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      emailError.textContent = regex.test(emailInput.value) ? '' : 'Email invalide';
    });
  </script>
</body>
</html>
