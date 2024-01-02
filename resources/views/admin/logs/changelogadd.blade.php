@extends('osfrportal::layout')
@section('content')
    <form method="POST" action="#" id="changelogadd">
        @csrf
        <input type="text" id="log_data" name="log_data" value="">
        <select id="log_type" name="log_type">
            <option value="{{ Osfrportal\OsfrportalLaravel\Enums\ChangelogTypesEnum::NONE()->value }}" selected>
                {{ Osfrportal\OsfrportalLaravel\Enums\ChangelogTypesEnum::NONE()->label }}</option>
            <option value="{{ Osfrportal\OsfrportalLaravel\Enums\ChangelogTypesEnum::ADD()->value }}">
                {{ Osfrportal\OsfrportalLaravel\Enums\ChangelogTypesEnum::ADD()->label }}</option>
            <option value="{{ Osfrportal\OsfrportalLaravel\Enums\ChangelogTypesEnum::FIX()->value }}">
                {{ Osfrportal\OsfrportalLaravel\Enums\ChangelogTypesEnum::FIX()->label }}</option>
            <option value="{{ Osfrportal\OsfrportalLaravel\Enums\ChangelogTypesEnum::TEST()->value }}">
                {{ Osfrportal\OsfrportalLaravel\Enums\ChangelogTypesEnum::TEST()->label }}</option>
        </select>
        <input class="btn btn-primary" type="submit" value="Добавить">
    </form>
@endsection
