<div wire:poll.5s>
    error: {{ $imapMessage->error }} <br>
    Message: {{ $imapMessage->message }}<br>
    tryAgain: {{ $imapMessage->tryAgain }}<br>
    canRunImports: {{ $imapMessage->canRunImports }}<br>
    date: {{ $imapMessage->date }}
</div>
