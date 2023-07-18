<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Knowledge;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function show(Request $request, $id){
        $knowlege=Knowledge::with('module')->find($id);
        $modules = Module::paginate(10);

        return view('knowledges.searchdetail', compact('knowlege','modules'));
    }
}
