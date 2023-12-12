@extends('layouts.main')

@section('content')
<div class="container">
<form action="{{ route('procesare-plata') }}" method="POST" style="width: 100%">
    @csrf
    {{-- <input type="hidden" name="session_id" value="{{ $session_id }}"> --}}

    @foreach ($cos as $item)
        Amount: {{ $item->eveniment->pret * $item->nr_bilete_selectate }} RON
        <input  type="hidden" name="amount" id="amount" value="{{ $amount }}">
    @endforeach

    <label for="card-element">
        Credit or debit card
    </label>
    <div id="card-element" style="width: 100%">
        <!-- A Stripe Element will be inserted here. -->
    </div>

    <button type="submit">Submit Payment</button>
</form>
</div>


<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ env('STRIPE_PUBLIC') }}');
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');
</script>

@endsection
