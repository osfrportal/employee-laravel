<?php
namespace Osfrportal\OsfrportalLaravel\Data\Orion;
/**
 * В конфиге data.php установить значение переменной
 * 'date_format' => [DATE_ATOM, 'Y-m-d\TH:i:s.000O'],
 */
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Carbon\Carbon;

class TPersonData extends Data
{
    public function __construct(
        public int $Id = 0,
        public ?string $LastName = null,
        public ?string $FirstName = null,
        public ?string $MiddleName = null,
        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $BirthDate = null,
        public ?string $Company = null,
        public ?string $Department = null,
        public ?string $Position = null,
        public ?int $CompanyId = 0,
        public ?int $DepartmentId = 0,
        public ?int $PositionId = 0,
        public ?string $TabNum = null,
        public ?string $Phone = null,
        public ?string $HomePhone = null,
        public ?string $Address = null,
        public ?string $Photo = null,
        public ?int $AccessLevelId = null,
        public ?int $Status = null,
        public ?int $ContactIdIndex = 0,
        public ?bool $IsLockedDayCrossing = false,
        public ?bool $IsFreeShedule = false,
        public ?string $ExternalId = null,
        public ?bool $IsInArchive = false,
        public ?int $DocumentType = 0,
        public ?string $DocumentSerials = null,
        public ?string $DocumentNumber = null,
        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $DocumentIssueDate = null,
        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $DocumentEndingDate = null,
        public ?string $DocumentIsser = null,
        public ?string $DocumentIsserCode = null,
        public ?int $Sex = 0,
        public ?string $Birthplace = null,
        public ?string $EmailList = null,
        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $ArchivingTimeStamp = null,
        public ?bool $IsInBlackList = false,
        public ?bool $IsDismissed = false,
        public ?string $BlackListComment = null,
        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $ChangeTime = null,
        public ?string $Itn = null,
        public ?string $DismissedComment = null,
    ) {}
}
