<?php

namespace App\Reports\Generator;

use App\Models\Logs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VideosReportGenerator
{
    public static function PerActionReport(Request $request)
    {
        $actions = Logs::where('associatable_type', '=', $request->video_type)->where('associatable_id', '=', $request->video_id)->groupBy('action_type', 'id')->orderBy('log_date', 'desc')->get();
        return response()->json(['actions' => $actions]);
    }
    public static function PerDayReport(Request $request)
    {
        $actions = Logs::where('associatable_type', '=', $request->video_type)->where('associatable_id', '=', $request->video_id)->groupBy('created_at', 'id')->orderBy('log_date', 'desc')->get();
        return response()->json(['actions' => $actions]);
    }
    public static function PerUserReport(Request $request)
    {
        $actions = Logs::where('associatable_type', '=', $request->video_type)->where('associatable_id', '=', $request->video_id)->groupBy('user_id', 'id')->orderBy('log_date', 'desc')->get();
        return response()->json(['actions' => $actions]);
    }
    public static function PerCategoryReport(Request $request)
    {
        $actions = Logs::where('associatable_type', '=', $request->video_type)->where('associatable_id', '=', $request->video_id)->groupBy('category_id', 'id')->orderBy('log_date', 'desc')->get();
        return response()->json(['actions' => $actions]);
    }
}
