<?php

namespace App\Http\Controllers;

use App\Models\Knowledge;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function show(Request $request, $id){
        $knowlege=Knowledge::with('module')->find($id);
        return view('knowledges.searchdetail', compact('knowlege'));
    }
}
