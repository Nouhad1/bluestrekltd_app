<!DOCTYPE html> 
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fdfcfb, #e2d1c3);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
            max-width: 600px;
            width: 100%; 
        }
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.2);
        }
        .card-header {
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            background: #0d6efd;
        }
        .form-control {
            border-radius: 0.75rem;
            padding: 0.9rem 1rem;
        }
        .btn-primary {
            border-radius: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
            transform: scale(1.02);
        }
        .login-title {
            font-size: 1.8rem;
            font-weight: 700;
        }
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 68%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
            font-size: 18px;
        }
        .position-relative {
            position: relative;
        }
        .card-footer {
            background: transparent;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <!-- élargissement de la colonne -->
        <div class="col-md-7 col-lg-6">
            <div class="card">
                <div class="card-header text-center text-white">
                    <h4 class="login-title">🔐 Connexion Admin</h4>
                </div>
                <div class="card-body p-5"><!-- plus de padding -->
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" 
                                   name="email" 
                                   class="form-control" 
                                   id="email" 
                                   value="{{ old('email') }}" 
                                   required autofocus>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="********" required>       
                            <span class="password-toggle" id="togglePassword"><i class="fa fa-eye"></i></span>       
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Se connecter</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center text-muted small">
                    {{-- <a href="url{{'/'}}">Administration©{{ date('Y') }}</a> --}}
                    &copy; {{ date('Y') }} BluestrekLTD- Tous les droits sont réservés
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="card-footer text-center text-muted small">
        {{-- <a href="url{{'/'}}">Administration©{{ date('Y') }}</a> --}}
        {{-- &copy; {{ date('Y') }} BluestrekLTD- Tous les droits sont réservés --}}
    {{--</div> --}}
</div>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.innerHTML = type === 'password' ? '<i class="fa fa-eye"></i>' : '<i class="fa fa-eye-slash"></i>';
    });
</script>
</body>
</html>
