<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <form id="payment-form">
        <input type="number" name="amount" placeholder="Enter amount">
        <div id="card-element">
            <!-- Stripe Elements will be inserted here -->
        </div>
        <button id="submit">Pay</button>
        <div id="payment-error" role="alert"></div>
    </form>

    <script>
        const stripe = Stripe('{{ config('services.stripe.key') }}');
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const { clientSecret } = await fetch('/create-payment-intent', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ amount: form.amount.value })
            }).then(r => r.json());

            const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: card,
                }
            });

            if (error) {
                document.getElementById('payment-error').textContent = error.message;
            } else if (paymentIntent.status === 'succeeded') {
                alert('Payment successful!');
            }
        });
    </script>
</body>
</html>