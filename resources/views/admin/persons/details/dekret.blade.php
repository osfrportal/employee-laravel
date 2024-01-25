@if ($SFRPersonDekret->count() > 0)
    <div class="card mb-4 mb-xl-0 mt-2">
        <div class="card-header">Декрет</div>
        <div class="card-body">
            <div class="container text-center">
                @foreach ($SFRPersonDekret as $SFRPersonDekretRow)
                    <div class="row">
                        <div class="col">
                            c {{ \Carbon\Carbon::parse($SFRPersonDekretRow->dekretstart)->format('d.m.Y') }}
                            по {{ \Carbon\Carbon::parse($SFRPersonDekretRow->dekretend)->format('d.m.Y') }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
