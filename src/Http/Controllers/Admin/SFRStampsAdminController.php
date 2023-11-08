<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;

use Illuminate\Support\Facades\Validator;

use Osfrportal\OsfrportalLaravel\Models\SfrStamps;
use Osfrportal\OsfrportalLaravel\Models\SfrStampsJournal;
use Osfrportal\OsfrportalLaravel\Services\SFRPersonService;

class SFRStampsAdminController extends Controller
{
    /**
     * --------------------------------
     * API functions
     * --------------------------------
     */
    public function apiStampsListAll(Request $request)
    {
        $allStamps = SfrStamps::with(['StampJournalIssued'])->get();
        return DataTables::of($allStamps)
            ->setRowClass(function ($stamp) {
                if ($stamp->stampdestruct_at) {
                    //return 'bg-warning opacity-75';
                    //return 'table-warning p-2 text-dark bg-opacity-75 opacity-75';
                    return 'bg-danger p-2 opacity-75';
                }
            })
            ->make(true);
    }

    public function apiJournalAll()
    {
        $journalFull = SfrStampsJournal::with(['Person', 'Stamp'])->get();
        return DataTables::of($journalFull)->make(true);
    }

    /**
     * API интерфейс для вывода информации о работнике
     * Использутеся для Ajax запроса формой select2
     * @param string $searchq
     * @return \Illuminate\Http\JsonResponse
     * @todo Перенести в отдельный SFRApiController
     */
    public function apiSelect2PersonsList(string $searchq, SFRPersonService $sfrpersonservice)
    {
        $tmp = $sfrpersonservice->APIPersonsSearchSelect2($searchq);
        return response()->json(data: $tmp, options: JSON_UNESCAPED_UNICODE);
    }



    /**
     * --------------------------------
     * Main functions
     * --------------------------------
     */

    public function stampsShowList()
    {
        return view('osfrportal::admin.stamps.stampsall');
    }

    public function stampsJournalShow()
    {
        return view('osfrportal::admin.stamps.stampsjournal');
    }

    public function saveStamp(Request $request)
    {
        $rules = [
            //'stampnumber' => 'required|max:50|unique:Osfrportal\OsfrportalLaravel\Models\SfrStamps,stampnumber',
            'stampnumber' => 'required|max:50',
            'stampdescription' => 'required',
            'stampdestruct_at' => 'date|nullable',
            'stampdestructdoc' => 'required_with:stampdestruct_at',
            'stampid' => 'uuid|nullable'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $error = [
                'success' => false,
                'message' => json_decode($validator->errors())
            ];
            return response()->json(data: $error, status: 422, options: JSON_UNESCAPED_UNICODE);
        }

        $validated = $validator->validated();
        $stampDataSearch = collect(['stampnumber' => $validated['stampnumber']]);
        if (!is_null($validated['stampid'])) {
            $stampDataSearch->put('stampid', $validated['stampid']);
        }
        $stamp = SfrStamps::updateOrCreate(
            $stampDataSearch->toArray(),
            [
                'stampdescription' => $validated['stampdescription'],
                'stampdestruct_at' => $validated['stampdestruct_at'],
                'stampdestructdoc' => $validated['stampdestructdoc'],
            ],
        );

        $message = [
            'success' => true,
            'message' => 'Добавлено успешно',
        ];
        return response()->json(data: $message, status: 200, options: JSON_UNESCAPED_UNICODE);
    }

    public function issueStamp(Request $request)
    {
        $rules = [
            'stampid' => 'required|exists:Osfrportal\OsfrportalLaravel\Models\SfrStamps,stampid',
            'personid' => 'required|exists:Osfrportal\OsfrportalLaravel\Models\SfrPerson,pid',
            'stampIssueDate' => 'required|date',
            'stampIssuePaperNumber' => 'required_with:stampIssueDate',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $error = [
                'success' => false,
                'message' => json_decode($validator->errors())
            ];
            return response()->json(data: $error, status: 422, options: JSON_UNESCAPED_UNICODE);
        }

        $validated = $validator->validated();
        $stampJournalLine = SfrStampsJournal::firstOrCreate(
            [
                'stampid' => $validated['stampid'],
                'pid' => $validated['personid'],
                'stampjissue_at' => $validated['stampIssueDate'],
                'stampjpapernumber' => $validated['stampIssuePaperNumber'],
            ]
        );

        $message = [
            'success' => true,
            'message' => 'Добавлено успешно.',
        ];
        return response()->json(data: $message, status: 200, options: JSON_UNESCAPED_UNICODE);
    }

    public function returnStamp(Request $request)
    {
        $rules = [
            'stampid' => 'required|exists:Osfrportal\OsfrportalLaravel\Models\SfrStamps,stampid',
            'stampjournalid' => 'required|exists:Osfrportal\OsfrportalLaravel\Models\SfrStampsJournal,stampjournalid',
            'stampReturnDate' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $error = [
                'success' => false,
                'message' => json_decode($validator->errors())
            ];
            return response()->json(data: $error, status: 422, options: JSON_UNESCAPED_UNICODE);
        }

        $validated = $validator->validated();

        $stampJournalLine = SfrStampsJournal::where('stampjournalid', $validated['stampjournalid'])->first();
        if ($stampJournalLine !== null) {
            $stampJournalLine->update([
                'stampjreturn_at' => $validated['stampReturnDate'],
            ]);
        } else {
            $error = [
                'success' => false,
                'message' => 'Не найдена запись журнала выдачи!',
            ];
            return response()->json(data: $error, status: 422, options: JSON_UNESCAPED_UNICODE);
        }
        $message = [
            'success' => true,
            'message' => 'Выполнено успешно.',
        ];
        return response()->json(data: $message, status: 200, options: JSON_UNESCAPED_UNICODE);

    }
}