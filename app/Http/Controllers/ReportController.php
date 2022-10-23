<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);        
    }
    public static function routeName()
    {
        return Str::snake("Report");
    }
    public function index(Request $request)
    {
        $sub_type = Str::camel(request('sub_type'));
        $type = ucfirst(request('type'));
        $generator = "\\App\\Reports\\Generator\\" . $type . "ReportGenerator";
        $res = $generator::$sub_type($request);
        return $res;
    }
}
