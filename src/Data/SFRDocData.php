<?php

namespace Osfrportal\OsfrportalLaravel\Data;


use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\DataCollectionOf;

class SFRDocData extends Data
{
    public function __construct(
        public string $docName = "",
        public string $docNumber,
        public string $docDate,
        public ?string $docType = "",
        public string $docGroup,
        public ?string $docDescription = null,
        public bool $docNeedSign = false,
        public ?string $docId = "",
        public ?int $docFileCount = 0,
        public ?string $docTypeName = "",
        public ?string $docGroupName = "",
    #[DataCollectionOf(SFRDocSignsByPersonData::class)]
        public ?DataCollection $docPersonSigns = null,
        public ?string $docDateEnd,
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
            docName: $doc->doc_name,
            docNumber: $doc->doc_number,
            docDate: $doc->doc_date,
            docType: $doc->doc_typeid,
            docGroup: $doc->doc_groupid,
            docDescription: $docData->docDescription,
            docNeedSign: $docData->docNeedSign,
            docId: $doc->docid,
            docFileCount: $doc->SfrDocsFiles()->count(),
            docTypeName: $doc->docType->type_name,
            docGroupName: $doc->docGroup->group_name,
            docDateEnd: $doc->doc_date_end,
        );
    }
}
