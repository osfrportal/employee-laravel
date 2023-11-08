@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item"><a href="#">Телефонный справочник</a></li>
                <li class="breadcrumb-item active">Управление подразделениями</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    @if ($roots_units->count())
        <table id="unitstable_config" class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>Подразделение</th>
                    <th>Родительское подразделение</th>
                    <th>Сортировка</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roots_units as $root)
                    <tr>

                        <form method="POST" action="{{ route('osfrportal.admin.phone.units.save') }}"
                            id="upd{{ $root->unitid ?? '' }}">
                            <input type="hidden" id="unitid" name="unitid" value="{{ $root->unitid ?? '' }}">
                            <td>
                                <b>{{ $root->unitname }}</b>
                            </td>
                            <td>
                                @include('osfrportal::admin.phone.units_formselect')
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" id="unitsortorder"
                                    name="unitsortorder" value="{{ $root->unitsortorder ?? '' }}" size="4">
                            </td>
                            <td>
                                <button type="submit" class="btn btn-outline-primary btn-sm">Сохранить</button>
                            </td>
                        </form>

                    </tr>
                    @foreach ($root->children as $child)
                        <tr>
                            <form method="POST" action="{{ route('osfrportal.admin.phone.units.save') }}" id="upd{{ $child->unitid ?? '' }}">
                                <input type="hidden" id="unitid" name="unitid" value="{{ $child->unitid ?? '' }}">
                                <td class="px-4">
                                    {{ $child->unitname }}
                                </td>
                                <td>
                                    @include('osfrportal::admin.phone.units_formselect')
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm" id="unitsortorder"
                                        name="unitsortorder" value="{{ $child->unitsortorder ?? '' }}" size="4">
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-outline-primary btn-sm">Сохранить</button>
                                </td>
                            </form>
                        </tr>
                        @php
                            unset($child);
                        @endphp
                    @endforeach
                    <tr>
                        <td colspan="4">
                            <hr>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
