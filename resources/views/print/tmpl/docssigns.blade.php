@extends('osfrportal::print.printlayout')
@section('content')
    @include('osfrportal::admin.persons.details.docssigns')
@endsection
@push('footer-scripts')
    <script>
        $(function() {
            var css = '@page { size: portrait !important; }',
                head = document.head || document.getElementsByTagName('head')[0],
                style = document.createElement('style');

            style.type = 'text/css';
            style.media = 'print';

            if (style.styleSheet) {
                style.styleSheet.cssText = css;
            } else {
                style.appendChild(document.createTextNode(css));
            }

            head.appendChild(style);
            window.print();
        });
    </script>
@endpush
