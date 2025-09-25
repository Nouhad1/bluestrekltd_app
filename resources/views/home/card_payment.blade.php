<!-- Flash messages -->
@if(session('success'))
<div class="alert success">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert error">{{ session('error') }}</div>
@endif

<!-- Total -->
<div class="total" style="margin-bottom: 1rem; text-align:center;">
    Montant total: {{ $totalPrice ?? '0' }} DH
</div>

<!-- Payment Form -->
<form id="payment-form" method="POST" action="{{ route('process_card_payment') }}">
    @csrf
    <input type="hidden" name="stripeToken" id="stripeToken">

    <div class="form-group">
        <label>Nom sur la carte</label>
        <input type="text" name="card_name" placeholder="John Doe" required>
    </div>

    <div class="form-group">
        <label>Numéro de carte</label>
        <div id="card-element"></div>
        <div id="card-errors" class="error"></div>
    </div>

    <button type="submit" class="btn btn-primary btn-block">
        Payer {{ $totalPrice ?? '0' }} DH
    </button>
</form>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ env("STRIPE_KEY") }}');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const { token, error } = await stripe.createToken(cardElement);

        if (error) {
            document.getElementById('card-errors').textContent = error.message;
        } else {
            document.getElementById('stripeToken').value = token.id;
            form.submit(); // Envoie le formulaire en POST vers Laravel
        }
    });
</script>

<style>
    .form-group label { display: block; margin-bottom: 0.25rem; font-weight: 500; color: #374151; }
    .form-group input { width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 12px; margin-bottom: 1rem; }
    .error { color: #ef4444; font-size: 0.875rem; }
    .btn-block { width: 100%; padding: 0.75rem; font-size: 1rem; border-radius: 12px; font-weight: 600; }
    .alert { padding: 0.75rem; border-radius: 12px; margin-bottom: 1rem; text-align:center; font-weight:600; }
    .alert.success { background-color: #d1fae5; color: #065f46; }
    .alert.error { background-color: #fee2e2; color: #b91c1c; }
</style>
