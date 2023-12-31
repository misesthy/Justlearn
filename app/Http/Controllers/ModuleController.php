<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Application;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\ModuleRequest;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = Module::all();
        
        foreach ($modules as $module) {
            $module->description = Str::limit($module->description, 30);
        }

        return view('modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $application = Application::all()->pluck('name','id');


        return view('modules.create', compact('application'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModuleRequest $request)
    {
        $module = new Module;
        $module->name = $request->name;
        $module->description = $request->description;
        $module->application_id = $request->application_id;

        $module->save();

        return redirect()->route('modules.index')->with('success', 'Le module a été créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $module = Module::findOrFail($id);

        return view('modules.show', compact('module'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module = Module::findOrFail($id);
        $application = Application::all()->pluck('name','id');

        return view('modules.edit', compact('module', 'application'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModuleRequest $request, $id)
    {
        $module = Module::findOrFail($id);
        $module->name = $request->name;
        $module->description = $request->description;
        $module->application_id = $request->application_id;

        $module->save();

        return redirect()->route('modules.index')->with('success', 'Le module a été mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $module = Module::findOrFail($id);
        $module->delete();

        return redirect()->route('modules.index')->with('success', 'Le module a été supprimé avec succès');
    }

    public function getModulesByApplicationId(Request $request, $id)
    {


        $modules = Module::where("application_id", "=" , $id)->latest()->paginate();
        

        return response()->json([
            'modules' => $modules->items(),
            'pagination' => [
                'total' => $modules->total(),
                'per_page' => $modules->perPage(),
                'current_page' => $modules->currentPage(),
                'last_page' => $modules->lastPage(),
                'from' => $modules->firstItem(),
                'to' => $modules->lastItem(),
            ],
        ]);

        // $module->name = $request->name;
        // $module->description = $request->description;
        // $module->application_id = $request->application_id;

        // $module->save();

        // return redirect()->route('modules.index')->with('success', 'Le module a été mis à jour avec succès');
    }
}
 