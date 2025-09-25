<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion Client</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

  <!-- Bootstrap core css -->
  <link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}"> 
  <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('home/css/responsive.css') }}">
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-pb+1kC7bIY3L6f3RO2zvB7t6sIYVZl/4f7+W5i4r/Yb3P0w+0K2x1+0ZtWm9Lmr+0Ov6+v1+RmcdmZjO/0OjIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

  <style>
    body { background-color: beige; }

    .login-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .login-card {
      background: #fff;
      border-radius: 15px;
      padding: 40px 30px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
      width: 100%;
      max-width: 500px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .login-card:hover {
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

    .btn-primary {
      background-color: #4e96e8;
      border: none;
      border-radius: 10px;
      padding: 12px 0;
      width: 100%;
      font-weight: 600;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }
    .btn-primary:hover { background-color: #6a11cb; }

    .social-btns button { margin: 5px 5px 15px 0; }

    .text-center a { color: #4a90e2; font-weight: 500; text-decoration: none; }
    .text-center a:hover { text-decoration: underline; }

    .alert { border-radius: 10px; margin-bottom: 20px; }

    /* Ajout de place pour l’icône */
    #password {
      padding-right: 100px; /* espace pour l’icône */
    }
    .password-toggle {
      position: absolute;
      right: 15px;
      top: 70%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #888;
      font-size: 18px;
    }

    @media (max-width: 992px) {
      .login-img { display: none; }
    }

    @media (max-width: 576px) {
      .login-card { padding: 30px 20px; }
    }
  </style>
</head>
<body>
 
  @include('home.header')

  <div class="login-container container">
    <div class="row w-100 align-items-center">
      <!-- Illustration à gauche -->
      <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center login-img">
        <img src="{{ asset('images/login-illustration.png') }}" alt="Illustration login" class="img-fluid">
      </div>

      <!-- Formulaire à droite -->
      <div class="col-lg-6 col-md-12 d-flex align-items-center">
        <div class="login-card w-100 position-relative">
          <h2>Connexion Client</h2>

           <!-- Boutons sociaux -->
          <div class="social-btns text-center">    
            <a href="https://www.linkedin.com" class="btn btn-outline-info"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
            <a href="https://www.google.com" class="btn btn-outline-danger"><i class="fab fa-google"></i> Google</a>
            <a href="https://www.facebook.com" class="btn btn-outline-primary"><i class="fab fa-facebook-f"></i> Facebook</a>
          </div>

          <!-- Affichage des erreurs -->
          @if ($errors->any())
            <div class="alert alert-danger">
              {{ $errors->first() }}
            </div>
          @endif

          <!-- Formulaire -->
          <form action="{{ route('client.login.submit') }}" method="POST" id="loginForm">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="votre@email.com"
                     style="text-transform: none;" autocapitalize="none" required>
              <small class="text-danger" id="emailError"></small>
            </div>

            <div class="mb-3 position-relative">
              <label for="password" class="form-label">Mot de passe</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="********" required>
              <span class="password-toggle" id="togglePassword"><i class="fa fa-eye"></i></span>
            </div>

            <button type="submit" class="btn btn-primary mb-3">Se connecter</button>

            <p class="text-center"><a href="{{ route('client.password.request') }}">Mot de passe oublié ?</a></p>
            <p class="text-center">Pas encore de compte ? <a href="{{ route('client.register') }}">S’inscrire</a></p>
          </form>
        </div>
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

    // Validation email en direct
    const emailInput = document.querySelector('#email');
    const emailError = document.querySelector('#emailError');
    emailInput.addEventListener('input', function () {
      const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      emailError.textContent = regex.test(emailInput.value) ? '' : 'Email invalide';
    });
  </script>
</body>
</html>
