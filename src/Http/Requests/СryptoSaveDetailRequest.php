<?php

namespace Osfrportal\OsfrportalLaravel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class СryptoSaveDetailRequest extends FormRequest
{
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
            'cryptouuid' => 'required|uuid',
            'personid' => 'nullable|uuid',
            'cryptoPurpose' => 'nullable|string',
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
            '*.array' => 'Поле должно иметь формат списка',
            '*.boolean' => 'Поле должно содержать только логическое значение',
        ];
    }
}