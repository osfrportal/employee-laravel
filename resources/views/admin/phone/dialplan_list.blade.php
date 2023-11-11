@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item"><a href="#">Телефонный справочник</a></li>
                <li class="breadcrumb-item active">Управление DialPlan</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <a class="btn btn-primary" href="{{ route('osfrportal.admin.phone.dialplan.add') }}" role="button">Добавить</a>
    <table class="table table-striped table-hover">
        <thead class="align-middle text-center">
            <tr>
                <th scope="col">Начало диапазона</th>
                <th scope="col">Конец диапазона</th>
                <th scope="col">Адрес</th>
                <th scope="col">Код города</th>
                <th scope="col">&nbsp;</th>
            </tr>
        </thead>
        <tbody class="align-middle text-center">
            @foreach ($dialplan as $dp)
                <tr>
                    <td>{{ $dp->dpnumstart ?? '' }}</td>
                    <td>{{ $dp->dpnumend ?? '' }}</td>
                    <td>{{ $dp->addressFull->paddress ?? '' }}</td>
                    <td>{{ $dp->addressFull->areacode ?? '' }}</td>
                    <td><a href="{{ route('osfrportal.admin.phone.dialplan.edit', ['dpid' => $dp->dpid]) }}"><span
                                class="bi bi-pencil-square"></span></a>&nbsp;&nbsp;
                        <button type="button" class="btn btn-link bi bi-trash3" data-bs-toggle="modal"
                            data-bs-target="#deleteModal" data-bs-whatever="{{ $dp->dpnumstart }} - {{ $dp->dpnumend }}"
                            data-href="{{ route('osfrportal.admin.phone.dialplan.delete', ['dpid' => $dp->dpid]) }}"></button>
                        <!-- a
                                                                                                                                                                                                            href="{{ route('osfrportal.admin.phone.dialplan.delete', ['dpid' => $dp->dpid]) }}"><span
                                                                                                                                                                                                                class="bi bi-trash3"></span></a -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Подтвердите действие</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h1 class="modal-text fs-5" id="deleteModalLabel">Удалить DialPlan</h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <a href="" role="button" class="btn btn-danger btn-ok" id="deleteBtn">Удалить</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer-scripts')
    <script>
        const deleteModal = document.getElementById('deleteModal')
        deleteModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const recipient = button.getAttribute('data-bs-whatever')
            const link = button.getAttribute('data-href')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //

            // Update the modal's content.
            const modalText = deleteModal.querySelector('.modal-text')
            //const modalBodyInput = deleteModal.querySelector('.modal-body input')

            const deleteBtn = $('#deleteBtn')

            deleteBtn.attr('href', link)

            modalText.textContent = `Удалить DialPlan ${recipient}`
            //modalBodyInput.value = recipient
        })
    </script>
@endpush
