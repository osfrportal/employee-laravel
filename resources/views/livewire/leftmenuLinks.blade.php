<div>
    <ul class="nav flex-column">
        @foreach ($leftmenuLinks as $leftLink)
            <li class="nav-item">
                <a class="nav-link" href="{{ $leftLink->linkurl ?? '' }}" target="_blank">
                    <span class="bi"> {{ $leftLink->linkname ?? '' }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
