<div wire:poll.5s>
    Message error: {{ $redismessage->error }} <br>
    Message redis: {{ $redismessage->message }}<br>
    Message date: {{ $redismessage->date }}
</div>
