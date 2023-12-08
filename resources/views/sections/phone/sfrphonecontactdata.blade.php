<form method="POST" action="{{ route('osfrportal.phone.save') }}">
    <input type="hidden" id="personid" name="personid" value="{{ $SFRPersonData->persondata_pid }}">
    <div class="card mb-4">
        <div class="card-header">Контактные данные</div>
        <div class="card-body">
            <div class="mb-3">
                <label class="mb-1" for="inputEmailAddress">Адрес электронной почты:</label>
                <input class="form-control form-control-sm @error('inputEmailAddress') is-invalid @enderror"
                    id="inputEmailAddress" name="inputEmailAddress" type="email"
                    placeholder="Введите адрес электронной почты"
                    value="{{ old('inputEmailAddress') ?? ($SFRPhoneContactData->email_ext ?? '') }}">
                @error('inputEmailAddress')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="mb-1" for="inputPhoneInt">Внутренний номер телефона:</label>
                <input class="form-control form-control-sm @error('inputPhoneInt') is-invalid @enderror"
                    id="inputPhoneInt" name="inputPhoneInt" type="tel"
                    placeholder="Введите 4 цифры внутреннего номера телефона"
                    value="{{ old('inputPhoneInt') ?? ($SFRPhoneContactData->phone_internal ?? '') }}"
                    data-inputmask="'mask': '9999'">
                @error('inputPhoneInt')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="font-italic text-muted mb-4">
                    Для здания по ул. Плеханова, д.4а - указать 7000<br />
                    Для здания г.Елец ул. Костенко д.42 - указать 8000 <br />
                    Если номер отсутствует - указать 0000
                </div>
            </div>
            <div class="mb-3">
                <label class="mb-1" for="inputAddr">Адрес местонахождения</label>
                <input class="form-control form-control-sm" id="inputAddr" type="text"
                    value="{{ $SFRPhoneContactData->address ?? '' }}" disabled readonly>
                <div class="font-italic text-muted mb-4">
                    Адрес заполняется автоматически по внутреннему номеру телефона.
                </div>
            </div>
            <div class="mb-3">
                <label class="mb-1" for="inputRoom">Помещение:</label>
                <input class="form-control form-control-sm @error('inputRoom') is-invalid @enderror" id="inputRoom"
                    name="inputRoom" type="text" placeholder="Введите номер помещения"
                    value="{{ old('inputRoom') ?? ($SFRPhoneContactData->room ?? '') }}">
                @error('inputRoom')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="font-italic text-muted mb-4">
                    В случае отсутствия номера кабинета, допускается указывать функциональное назначение
                    помещения. Например, электрощитовая, вахта, окно приема №1 и т.д
                </div>

            </div>


            <div class="mb-3">
                <label class="mb-1" for="inputPhoneExt">Городской номер телефона:</label>
                <div class="input-group">
                    <span class="input-group-text">{{ $SFRPhoneContactData->areacode ?? '' }}</span>
                    <input class="form-control form-control-sm @error('inputPhoneExt') is-invalid @enderror"
                        id="inputPhoneExt" name="inputPhoneExt" type="tel"
                        placeholder="Введите городской номер телефона БЕЗ кода города"
                        value="{{ old('inputPhoneExt') ?? ($SFRPhoneContactData->phone_external ?? '') }}"
                        data-inputmask="'mask': '99999[9]'">
                </div>
                @error('inputPhoneExt')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="font-italic text-muted mb-4">
                    Код города заполняется автоматически<br />
                    Если номер отсутствует - указать 000000
                </div>
            </div>

            <div class="mb-3">
                <label class="mb-1" for="inputPhoneMobile">Мобильный номер телефона:</label>
                <input class="form-control form-control-sm @error('inputPhoneMobile') is-invalid @enderror"
                    id="inputPhoneMobile" name="inputPhoneMobile" type="tel"
                    value="{{ old('inputPhoneMobile') ?? ($SFRPhoneContactData->phone_mobile ?? '') }}"
                    data-inputmask="'mask': '+7 (999) 999-99-99'">
            </div>
            @error('inputPhoneMobile')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label class="mb-1" for="inputVipnetApName">Наименование АП VipNet Деловая почта:</label>
                <input class="form-control form-control-sm @error('inputVipnetApName') is-invalid @enderror"
                    id="inputVipnetApName" name="inputVipnetApName" type="text"
                    value="{{ old('inputVipnetApName') ?? ($SFRPhoneContactData->vipnetapname ?? '') }}">
            </div>
            @error('inputVipnetApName')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <button class="btn btn-primary btn-submit" type="submit">Сохранить</button>

        </div>
    </div>
</form>
