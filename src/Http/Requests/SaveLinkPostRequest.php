<?php

namespace Osfrportal\OsfrportalLaravel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SaveLinkPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->can('links-manage');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'linkid' => 'nullable',
            'linkname' => 'required',
            'linkurl' => 'required|url:http,https',
            'linksortorder' => 'required|integer|digits_between:1,4',
            'linkshowinleftmenu' => 'required|boolean',
            'linksgroup' => 'required|array',
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
            '*.required' => 'Поле обязательно для заполнения',
            '*.url' => 'Поле должно иметь формат URL',
            '*.integer' => 'Поле должно содержать только цифры',
            '*.digits_between' => 'Не меньше :min цифры, не более :max.',
        ];
    }
}