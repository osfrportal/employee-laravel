@extends('osfrportal::layout')
@section('dashboardTitle', 'Документы для ознакомления')
@section('content')
    <p class="text-muted">
        Для ознакомления с документами используется электронная подпись (Усиленная квалифицированная - УКЭП или Усиленная
        неквалифицированная - УНЭП).
    </p>
    <p class="text-muted">
        Ведомость ознакомления с документами доступна для скачивания ............
    </p>


    <table class="table">
        <thead class="table-light">
            <td>Реквизиты документа</td>
            <td>Наименование документа</td>
            <td>Тип документа</td>
            <td>Количество файлов</td>
            <td>Статус ознакомления</td>
        </thead>
        <tbody>
            @foreach ($docsToSign as $doc)
                <tr>
                    <td><strong>№ {{ $doc->docNumber ?? '-' }} от {{ $doc->docDate ?? '' }}</strong></td>
                    <td><strong>{{ $doc->docName ?? '' }}</strong></td>
                    <td>{{ $doc->docTypeName ?? '' }}</td>
                    <td>{{ $doc->docFileCount ?? '' }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="5">
                        <table class="table table-sm align-middle table-bordered">
                            <thead class="table-light" align="center">
                                <tr>
                                    <td>Файл</td>
                                    <td>Ознакомление с ЭП</td>
                                </tr>
                            </thead>
                            <tbody align="center">
                                @foreach ($doc->docFiles as $docFile)
                                    @if ($docFile->file_enabled === true)
                                        <tr>
                                            <td><a href="@docsfileurl($docFile->file_name)"
                                                    target="_blank">{{ $docFile->file_description }}</a>
                                            </td>
                                            <td scope="row">
                                                @if ($docFileSigns->doesntContain('sign_fileid', $docFile->fileid))
                                                    @switch($certToUse)
                                                        @case(Osfrportal\OsfrportalLaravel\Enums\CertsTypesEnum::UKEP())
                                                            <a class="btn btn-primary btn-sm" href="#" role="button"
                                                                id="sign-{{ $docFile->fileid }}"
                                                                onclick="doSignDocFile('{{ $doc->docId }}', '{{ $docFile->fileid }}', '{{ $certToUse }}');">Ознакомиться
                                                                (УКЭП)
                                                            </a>
                                                        @break

                                                        @case(Osfrportal\OsfrportalLaravel\Enums\CertsTypesEnum::UNEP())
                                                            <a class="btn btn-primary btn-sm" href="#" role="button"
                                                                id="sign-{{ $docFile->fileid }}"
                                                                onclick="doSignDocFile('{{ $doc->docId }}', '{{ $docFile->fileid }}', '{{ $certToUse }}');">Ознакомиться
                                                                (УНЭП)</a>
                                                        @break

                                                        @default
                                                            <a class="btn btn-sm btn-outline-danger disabled" href="#"
                                                                role="button">Отсуствует электронная подпись</a>
                                                    @endswitch
                                                @else
                                                    <a class="btn btn-sm btn-outline-success disabled" href="#"
                                                        role="button">Ознакомлен</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@push('footer-scripts')
    <script type="text/javascript">
        let certListIDs = "{{ $certListIDs }}";
        let cryptoSessionID = "";


        async function doSignDocFile(docid, fileid, signtype) {
            let personId = "{{ Auth::user()->SfrPerson->getPid() }}";
            let apiURLforXMLsign = `/docs/sign/xml/${docid}/${fileid}`;
            let responseXMLencoded = await fetch(apiURLforXMLsign);
            let xmlToSign = "";
            let btnSign = document.getElementById(`sign-${fileid}`);
            btnSign.innerText = "Идет подписание";
            btnSign.classList.add('disabled');
            if (responseXMLencoded.ok) {
                let xmlEncodedJSON = await responseXMLencoded.json();
                xmlToSign = xmlEncodedJSON.data;
            } else {
                console.log("Ошибка HTTP: " + responseCheck.status);
                btnSign.classList.remove('disabled');
            }
            switch (signtype) {
                case '1':
                    sessionCheck = await cryptoDEsessionCheck(cryptoSessionID);
                    if (!sessionCheck) {
                        cryptoSessionID = await cryptoDEsessionInit(certListIDs);
                    }

                    let signedData = await cryptoDEsignXML(cryptoSessionID, xmlToSign);
                    if (signedData) {
                        let signPostData = {
                            sign_fileId: fileid,
                            sign_docId: docid,
                            sign_personId: personId,
                            sign_data: signedData,

                        };
                        let saveUrl = "{{ route('osfrportal.docs.saveSignUKEP') }}";
                        //console.log(JSON.stringify(signPostData));
                        let response = await fetch(saveUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json;charset=utf-8'
                            },
                            body: JSON.stringify(signPostData)
                        });
                        let result = await response.json();
                        if (result.status == 200) {
                            btnSign.innerText = "Документ подписан";
                        } else {
                            btnSign.innerText = "Ошибка подписания!";
                        }
                    } else {
                        btnSign.innerText = "Ошибка подписания!";
                    }
                    break;
                case '2':
                    let saveUrlUnep = "{{ route('osfrportal.docs.saveSignUNEP') }}";
                    let signPostDataUnep = {
                        sign_fileId: fileid,
                        sign_docId: docid,
                        sign_personId: personId,
                        sign_xml: xmlToSign,
                        sign_unepid: certListIDs,
                    };
                    let response = await fetch(saveUrlUnep, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json;charset=utf-8'
                        },
                        body: JSON.stringify(signPostDataUnep)
                    });
                    let result = await response.json();
                    if (result.status == 200) {
                        btnSign.innerText = "Документ подписан";
                    } else {
                        btnSign.innerText = "Ошибка подписания!";
                    }
                    break;
            }
        }
    </script>
@endpush
