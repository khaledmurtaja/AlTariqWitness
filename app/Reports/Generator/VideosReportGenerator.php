<?php

namespace App\Reports\Generator;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VideosReportGenerator
{
    public static function PerActionReport(Request $request)
    {
        $items = User::get();
        return response()->json(compact('items'));
    }
    public static function PerDayReport(Request $request)
    {
        $items = User::get();
        return response()->json(compact('items'));
    }
    public static function PerUserReport(Request $request)
    {
        $items = User::get();
        return response()->json(compact('items'));
    }
    public static function PerCategoryReport(Request $request)
    {
        $items = User::get();
        return response()->json(compact('items'));
    }
}
