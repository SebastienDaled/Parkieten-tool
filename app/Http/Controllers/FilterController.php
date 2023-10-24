<?php

namespace App\Http\Controllers;

use App\Models\Ring;
use Illuminate\Http\Request;

class FilterController extends Controller
{
       //

    public function filter(Request $request)

    {

        // make it work on size and type name
    // when only one filter is selected
    // when both filters are selected
    // when no filter is selected
    // when both filters are selected and no results are found
    // when only one filter is selected and no results are found
    // when no filter is selected and no results are found
    // when no filter is selected and no results are found
    // when no filter is selected and no results are found
    // when no filter is selected and no results are found
    

        $rings = Ring::with('type')->get();

        $size = $request->size;
        $type = $request->type;

        if ($size && $type) {
            $rings = Ring::where('size', $size)->whereHas('type', function ($query) use ($type) {
                $query->where('name', $type);
            })->get();
        } elseif ($size) {
            $rings = Ring::where('size', $size)->get();
        } elseif ($type) {
            $rings = Ring::whereHas('type', function ($query) use ($type) {
                $query->where('name', $type);
            })->get();
        }

        return view('order.index', compact('rings'));


    }

}
