@if ($SFRPersonDekret->count() > 0)
    <div class="card mb-4 mb-xl-0 mt-2">
        <div class="card-header">Декрет</div>
        <div class="card-body">
            @foreach ($SFRPersonDekret as $SFRPersonDekretRow)
                {{ $SFRPersonDekretRow->dekretstart->format('d.m.Y') }} {{ $SFRPersonDekretRow->dekretend }}<br>
            @endforeach
        </div>
    </div>
@endif
