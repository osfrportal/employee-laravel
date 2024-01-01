<?php

namespace Osfrportal\OsfrportalLaravel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Enum\Laravel\Http\Requests\TransformsEnums;
use Spatie\Enum\Laravel\Rules\EnumRule;
use Osfrportal\OsfrportalLaravel\Enums\CryptoTypesEnum;

class СryptoAddNewRequest extends FormRequest
{
    use TransformsEnums;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //return Auth::user()->can('links-manage');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'cryptoType' => new EnumRule(CryptoTypesEnum::class),
            'cryptoPurpose' => 'nullable|string',
            'personid' => 'nullable|uuid',
            'cryptoLicenseNumber' => 'required_if:cryptoType,1|string|size:25'
        ];
    }
    public function enums(): array
    {
        return [
            'cryptoType' => CryptoTypesEnum::class,
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            '*.uuid' => 'Некорректный формат идентификатора',
            '*.required' => 'Поле обязательно для заполнения',
            '*.string' => 'Поле должно иметь формат строки',
        ];
    }
}