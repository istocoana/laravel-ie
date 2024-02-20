@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="76" height="76" fill="currentColor" class="bi bi-check-circle-fill mb-4" viewBox="0 0 16 16" style="color: #198754;">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.999-4.999a.75.75 0 0 0-.02-1.05z"/>
                </svg>
                <h3 class="mb-3">Comanda înregistrată cu succes!</h3>
                <p class="mb-4">Vă mulțumim pentru comandă. Puteți vedea detaliile comenzii dvs. făcând clic pe linkul de mai jos.</p>
                <a href="{{ route('detalii-comanda', ['comanda_id' => $comanda_id]) }}" class="btn btn-success">Detalii Comandă</a>
            </div>
        </div>
    </div>
</div>
@endsection
