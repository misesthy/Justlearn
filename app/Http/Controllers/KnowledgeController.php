<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Module;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Models\Knowledge;

class KnowledgeController extends Controller
{

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $knowledges = Knowledge::all();

        return view('knowledges.index', compact('knowledges'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $domains = Domain::all();

        return view('knowledges.create', compact('domains'));
    }

    public function getApplications(Request $request)
    {
        $applications = Application::where('domain_id', $request->domain_id)->get();

        return response()->json($applications);
    }

    public function getModules(Request $request)
    {
        $modules = Module::where('application_id', $request->application_id)->get();

        return response()->json($modules);
    }

    public function getKnowledges(Request $request)
    {
        $knowledges = Knowledge::where('module_id', $request->module_id)->get();

        return response()->json($knowledges);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $knowledge = new Knowledge();
        $knowledge->name = $request->name;
        $knowledge->module_id = $request->module_id;
        // Autres attributs de la knowledge

        $knowledge->save();

        return redirect()->route('knowledges.index')->with('success', 'La connaissance a été créée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $knowledge = Knowledge::findOrFail($id);

        return view('knowledges.show', compact('knowledge'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $knowledge = Knowledge::findOrFail($id);
        // Code pour récupérer les données nécessaires à l'édition de la connaissance

        return view('knowledges.edit', compact('knowledge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $knowledge = Knowledge::findOrFail($id);
        $knowledge->name = $request->name;
        $knowledge->module_id = $request->module_id;
        // Autres attributs de la knowledge

        $knowledge->save();

        return redirect()->route('knowledges.index')->with('success', 'La connaissance a été mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $knowledge = Knowledge::findOrFail($id);
        $knowledge->delete();

        return redirect()->route('knowledges.index')->with('success', 'La connaissance a été supprimée avec succès');
    }
}