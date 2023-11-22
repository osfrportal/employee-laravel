<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use Carbon\Carbon;

use Osfrportal\OsfrportalLaravel\Http\Resources\SFROtrsStatsCollection;


class SFROtrsAdminController extends Controller
{
    public function APIStatsOut(Request $request) {
        $otrs_ozi_query = "
        SELECT
            date,
            COUNT(CASE WHEN history_type_id = 1 THEN history_type_id END) AS created,
            COUNT(CASE WHEN history_type_id IN (1, 27) AND state_id IN (2, 3) THEN history_type_id END) AS closed
        FROM (
            SELECT DISTINCT
                history_type_id,
                ticket_id,
                state_id,
                to_char(create_time,'YYYY-MM-DD') AS date
            FROM
                ticket_history
            WHERE
                history_type_id IN (1, 27)
            AND
                create_time > CURRENT_DATE - INTERVAL '30 DAY'
            AND
                queue_id IN (2,15,16,17,18,19,20,21,22,23,24,26,27,55,56)
        ) AS a
        GROUP BY date
        ORDER BY date ASC
    ";
    $otrs_it_query = "
    SELECT
        date,
        COUNT(CASE WHEN history_type_id = 1 THEN history_type_id END) AS created,
        COUNT(CASE WHEN history_type_id IN (1, 27) AND state_id IN (2, 3) THEN history_type_id END) AS closed
    FROM (
        SELECT DISTINCT
            history_type_id,
            ticket_id,
            state_id,
            to_char(create_time,'YYYY-MM-DD') AS date
        FROM
            ticket_history
        WHERE
            history_type_id IN (1, 27)
        AND
            create_time > CURRENT_DATE - INTERVAL '30 DAY'
        AND
            queue_id IN (28,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54)
    ) AS a
    GROUP BY date
    ORDER BY date ASC
";
//dd($request->otrs_graph_unit);
switch ($request->otrs_graph_unit) {
    case 'ozi':
        $otrs_list = DB::connection("otrspgsql")->select($otrs_ozi_query);
        break;
    case 'oit':
        $otrs_list = DB::connection("otrspgsql")->select($otrs_it_query);
        break;
    default:
        $otrs_list = DB::connection("otrspgsql")->select($otrs_ozi_query);
        break;
}

$collection = collect();
$ticket_stat_labels = array();
$ticket_stat_dataset = collect();
$ticket_stat_dataset_data_created = array();
$ticket_stat_dataset_data_closed = array();

$tmp_created = collect();
$tmp_closed = collect();
foreach ($otrs_list as $ticket_stats) {
    $ticket_stat_labels[] = Carbon::parse($ticket_stats->date)->format('d.m.Y');
    $ticket_stat_dataset_data_created[] = $ticket_stats->created;
    $ticket_stat_dataset_data_closed[] = $ticket_stats->closed;

}
$tmp_created->put('data',$ticket_stat_dataset_data_created);
$tmp_created->put('label', 'Созданные');
$tmp_created->put('lineTension', 0);
$tmp_created->put('backgroundColor', "transparent");
$tmp_created->put('borderColor', "#00bfff");
$tmp_created->put('pointBackgroundColor', "#00bfff");
//$tmp_created->put('borderWidth', 4);

$tmp_closed->put('data',$ticket_stat_dataset_data_closed);
$tmp_closed->put('label', 'Закрытые');
$tmp_closed->put('lineTension', 0);
$tmp_closed->put('backgroundColor', "transparent");
$tmp_closed->put('borderColor', "#fd5e53");
$tmp_closed->put('pointBackgroundColor', "#fd5e53");
//$tmp_closed->put('borderWidth', 4);
$ticket_stat_dataset->push($tmp_created);
$ticket_stat_dataset->push($tmp_closed);
$collection->put('labels',$ticket_stat_labels);
$collection->put('datasets',$ticket_stat_dataset);

        return new SFROtrsStatsCollection($collection);
    }
}
