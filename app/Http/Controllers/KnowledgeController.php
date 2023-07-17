<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Module;
use App\Models\Knowledge;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Requests\KnowledgeRequest;

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
    public function create(Application $application)
    {
        $modules = $application->modules;
        
        $applications = Application::all();
        
        // dd($modules);
        return view('knowledges.create', compact('applications','modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KnowledgeRequest $request)
    {   
        $knowledge = new Knowledge();
        $knowledge->title = $request->title;
        $knowledge->short_text = $request->short_text;
        $knowledge->full_text = $request->full_text;
        $knowledge->module_id = $request->module_id;
      
         // Valider les données du formulaire
        $validatedData = $request->validate([
            'application_id' => 'required',
            'module_id' => 'required',
            'title' => 'required',
            'short_text' => 'required',
        ]);
        
        // Créer la connaissance

        // $knowledge = Knowledge::create($validatedData);

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
