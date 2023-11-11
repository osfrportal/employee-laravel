<?php

namespace Osfrportal\OsfrportalLaravel\Data;


use Spatie\LaravelData\Data;


class SFRDocData extends Data
{
    public function __construct(
        //make each property of the data object nullable like this:
        //public ?string $room,
        public string $docName = "",
        public string $docNumber,
        public string $docDate,
        public ?string $docType = "",
        public string $docGroup,
        public ?string $docDescription = null,
        public bool $docNeedSign = false,
        public ?string $docId = "",
        public ?int $docFileCount = 0,
    ) {
    }
    public static function rules(): array
    {
        return [
            'docName' => ['required', 'string'],
            'docNeedSign' => ['required', 'boolean'],
            //'docType' => ['required', 'uuid'],
            //'docGroup' => ['required', 'uuid'],
            'docDate' => ['required', 'date_format:Y-m-d'],
        ];
    }

    public static function messages(): array
    {
        return [
            '*.required' => 'Поле должно быть заполнено',
            '*.uuid' => 'Выбранное значение не является UUID. Обратитесь к разработчику системы.',
            '*.boolean' => 'Выберите одно из значений',
        ];
    }

    public static function forList($doc): self
    {
        //dd($doc);
        $docData = json_decode(json: $doc->doc_data, flags: JSON_UNESCAPED_UNICODE);
        return new self(
            $doc->doc_name,
            $doc->doc_number,
            $doc->doc_date,
            $doc->doc_typeid,
            $doc->doc_groupid,
            $docData->docDescription,
            $docData->docNeedSign,
            $doc->docid,
            $doc->SfrDocsFiles()->count(),
        );
    }
}
