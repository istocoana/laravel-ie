@extends('layouts.main')

@push('styles')
  <link href="{{ asset('css/events.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class='container'>
    <div class="line">
        <h2>Evenimente</h2>

        @if (Auth::check() && Auth::user()->isAdmin())   
            <a href="{{ route('events.create') }}" class="button">Adăugare eveniment nou</a>
        @elseif (Auth::check() && !Auth::user()->isAdmin())
        <a href="{{ route('cos.vizualizeazaCos') }}" class="cart-icon">
            <i class="bi bi-cart"></i>
            <?php
            $totalBilete = App\Helpers\Helpers::getTotalBileteInCos(auth()->id());
            ?>
        
            @if ($totalBilete > 0)
                <span class="cart-cos-numar">{{ $totalBilete }}</span>
            @endif
        </a>
        @endif
        
    </div>
   

    <div class="events">

    @if ($events->isEmpty())
        <p>Nu există evenimente disponibile.</p>
    @else
        
        @foreach ($events as $event)
            <div class='event'>
                <div class='photo'>
                @if($event->image_path)
                    <img src="{{ asset('storage/images/' . $event->image_path) }}" alt="Imagine eveniment">
                @else
                    <img src="{{ asset('../images/no_photo.jpg') }}" alt="Imagine eveniment">
                @endif
                </div>
                <div class='details'>
                    <div class='title'>
                        <p>{{ \Carbon\Carbon::parse($event->data)->isoFormat('DD MMM YYYY [ora] HH:mm') }}</p>
                        <p>
                            <i class='bi bi-geo-alt-fill'></i>
                            {{ $event->locatie }}
                        </p>
                        <a href="{{ route('events.show', ['event_id' => $event->event_id]) }}"> <strong>{{ $event->titlu }}</strong> </a>
                    </div>   
                    <div class='people'>
                        @if ($event->sponsori && $event->sponsori->count() > 0)
                            <p><b>Sponsori:</b> {{ implode(", ", $event->sponsori->pluck('nume')->toArray()) }}</p>
                        @endif

                        @if ($event->speakers)
                            <p><b>Speakeri:</b> {{ implode(", ", $event->speakers->pluck('nume')->toArray()) }}</p>
                        @endif
                    
                        @if ($event->parteneri && $event->parteneri->count() > 0)
                            <p><b>Parteneri:</b> {{ implode(", ", $event->parteneri->pluck('nume')->toArray()) }}</p>
                        @endif
                    
                        <p><b>Bilete disponibile: </b>{{ $event->bilete_disponibile }}</p>

                    </div>
                
                    <div class='actions'>
                        <p class='for-clients'>{{ $event->pret }} RON </p>
                    </div>
                </div>
            @if (Auth::check() && !Auth::user()->isAdmin())   
            <form method="post" action="{{ route('cos.adaugaInCos') }}">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                <div class="input-group">
                    <button type="button" class="btn btn-number" data-type="minus" data-field="numar_bilete">
                        -
                    </button>
                    <input type="number" name="numar_bilete" class="form-control input-number" value="1" min="1">
                    <button type="button" class="btn btn-number" data-type="plus" data-field="numar_bilete">
                        +
                    </button>
                </div>
                <button type="submit" class="btn btn-sm btn-secondary">Cumpara bilete</button>
            </form>
            
            @endif
            
            @if (Auth::check() && Auth::user()->isAdmin())   
                <div class='actions'>
                    <a href="{{ route('events.edit', ['event_id' => $event->event_id]) }}" class='btn btn-secondary btn-sm'>Editeaza</a>
                    <form action="{{ route('events.destroy', ['event_id' => $event->event_id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class='btn btn-danger btn-sm' onclick="return confirm('Sigur doriți să ștergeți acest eveniment?')">Șterge</button>
                    </form>
                </div>
            @endif
            </div>
    
        @endforeach
        @endif
    </div>
</div>
<script>
   $('.event').each(function() {
        var eventElement = $(this);

        eventElement.find('.btn-number').click(function (e) {
            e.preventDefault();

            var fieldName = $(this).attr('data-field');
            var type = $(this).attr('data-type');
            var input = eventElement.find('input[name="' + fieldName + '"]');
            var currentVal = parseInt(input.val());

            if (!isNaN(currentVal)) {
                if (type === 'minus' && currentVal > 1) {
                    input.val(currentVal - 1);
                } else if (type === 'plus') {
                    input.val(currentVal + 1);
                }
            } else {
                input.val(1);
            }
        });
    });

</script>
@endsection

