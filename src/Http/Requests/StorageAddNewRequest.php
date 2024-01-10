<?php

namespace Osfrportal\OsfrportalLaravel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Enum\Laravel\Http\Requests\TransformsEnums;
use Spatie\Enum\Laravel\Rules\EnumRule;
use Osfrportal\OsfrportalLaravel\Enums\StorageTypesEnum;
use Osfrportal\OsfrportalLaravel\Enums\StorageCategoryTypesEnum;

class StorageAddNewRequest extends FormRequest
{
    use TransformsEnums;

    public function rules(): array
    {
        return [
            'stortype' => new EnumRule(StorageTypesEnum::class),
            'stormark' => new EnumRule(StorageCategoryTypesEnum::class),
            'personid' => 'required|uuid',
            'stordate' => 'required|date',
            'storvolume' => 'required|integer',
            'stornumber' => 'required|string',
            'storserial' => 'required|string',
            'storarrivedfrom' => 'required|string',
            'stordestroydate' => 'nullable|date',
            'stordestroydoc' => 'nullable|string',
        ];
    }
    public function enums(): array
    {
        return [
            'stortype' => StorageTypesEnum::class,
            'stormark' => StorageCategoryTypesEnum::class,
        ];
    }

    public function messages(): array
    {
        return [
            'stortype.*' => 'Необходимо выбрать тип stortype',
            'stormark.*' => 'Необходимо выбрать тип stormark',
            '*.uuid' => 'Некорректный формат идентификатора',
            '*.date' => 'Некорректный формат даты',
            '*.required' => 'Поле обязательно для заполнения',
            '*.required_if' => 'Поле обязательно для заполнения',
            '*.string' => 'Поле должно иметь формат строки',
        ];
    }

}
