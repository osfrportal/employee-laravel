@extends('osfrportal::layout')
@section('content')
    <div class="container">
        <form method="POST" action="{{ route('osfrportal.admin.crypto.new.save') }}">
            @csrf
            <div class="card mb-4">
                <div class="card-header">Добавление криптосредства</div>
                <div class="card-body">
                    <div class="mb-3">
                        <input class="btn btn-primary" type="submit" value="Добавить">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#js-persons-ajax').select2({
                ajax: {
                    dataType: 'json',
                    url: function(params) {
                        var urlroute =
                            '{{ route('osfrapi.osfrportal.admin.select2.persons.search', ':slug') }}';
                        urlroute = urlroute.replace(':slug', params.term);
                        return urlroute;
                    }
                }
            });
        });
    </script>
@endpush
