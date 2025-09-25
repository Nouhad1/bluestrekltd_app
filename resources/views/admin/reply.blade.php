<!DOCTYPE html>
<html lang="fr">
<head>
    @include('admin.css')
</head>
<body>
<div class="container-scroller">
    @include('admin.sidebar')
    @include('admin.header')

    <div class="main-panel">
        <div class="content-wrapper">
            <h2 class="reference_deg">Répondre à {{ $message->name }}</h2>

            <form action="{{ route('admin.sendReply', $message->id) }}" method="POST">
                @csrf
                <div>
                    <label>Email :</label>
                    <input type="text" value="{{ $message->email }}" disabled class="form-control">
                </div>
                <div>
                    <label>Sujet :</label>
                    <input type="text" value="{{ $message->subject }}" disabled class="form-control">
                </div>
                <div>
                    <label>Message reçu :</label>
                    <textarea class="form-control" disabled>{{ $message->message }}</textarea>
                </div>
                <div>
                    <label>Votre réponse :</label>
                    <textarea name="reply" class="form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Envoyer la réponse</button>
            </form>
        </div>
    </div>
</div>
@include('admin.script')
</body>
</html>
