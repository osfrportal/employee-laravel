<?php

namespace Osfrportal\OsfrportalLaravel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DocEditableSaveRequest extends FormRequest
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
            'docid' => 'required|uuid',
            'docName' => 'required|string',
            'docNumber' => 'required',
            'docDate' => 'required|date_format:Y-m-d',
            'docDescription' => 'required',
            'docNeedSign' => 'required|boolean',
            'docGroup' => 'required|uuid',
            'docType' => 'required|uuid',
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
            '*.required' => 'Поле должно быть заполнено',
            '*.uuid' => 'Некорректный формат идентификатора',
        ];
    }
}
