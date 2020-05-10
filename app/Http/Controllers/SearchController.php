<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Request;
use App\Lab;

class SearchController extends Controller
{
    function Search()
    {
        $query = Request::get('searchInput');
        if ($query != '') {
            $labs = Lab::where('name', 'like', '%' . $query . '%')->get();
            if (count($labs) > 0) {
                return view('labs.index', compact('labs'))->withDetails($labs)->withQuery($query);
            }
            else {
                return view('labs.index', compact('labs'))->withMessage('No data found!');
            }
        }
    }
}
