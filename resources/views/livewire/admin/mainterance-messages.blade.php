<div wire:poll.5s>
    Message error: {{ $redismessage->error }}
    Message redis: {{ $redismessage->message }}
    Message date: {{ $redismessage->date }}
</div>
