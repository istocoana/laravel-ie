@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2>Finalizare Plată</h2>
    <form action="{{ route('procesare-plata') }}" method="POST" class="my-4">
        @csrf
        @foreach ($cos as $item)
            <p>Amount: <strong>{{ $item->eveniment->pret * $item->nr_bilete_selectate }} RON</strong></p>
            <input type="hidden" name="amount" id="amount" value="{{ $amount }}">
        @endforeach

        <div class="my-3">
            <label for="card-element" class="form-label">
                Credit or debit card
            </label>
            <div id="card-element" class="form-control">
                <!-- A Stripe Element will be inserted here. -->
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit Payment</button>
    </form>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ env('STRIPE_PUBLIC') }}');
    var elements = stripe.elements();
    var style = {
        base: {
            color: "#32325d",
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: "antialiased",
            fontSize: "16px",
            "::placeholder": {
                color: "#aab7c4"
            }
        },
        invalid: {
            color: "#fa755a",
            iconColor: "#fa755a"
        }
    };
    var cardElement = elements.create('card', {style: style});
    cardElement.mount('#card-element');
</script>

@endsection
