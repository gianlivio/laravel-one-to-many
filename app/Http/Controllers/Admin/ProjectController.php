<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectsArray = Project::all();
        return view('admin.projects.index', compact('projectsArray'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {   
        // validazione unicità del nome nuovi item
        $projectData = $request->all();

        // Creare una nuova istanza di Project
        $newProject = new Project();
        $newProject->fill($projectData);

        // Generare lo slug dal nome
        $newProject->slug = Str::slug($newProject->name, '_');

        // Salvare il progetto
        $newProject->save();

        // Reindirizzare alla lista dei progetti con un messaggio di successo (with)

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully');;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $project = Project::findOrFail($id);
        $projectData = $request->all();
        $project->fill($projectData);
        $project->slug = Str::slug($project->name, '_');
        $project->save();

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        {
            $project = Project::findOrFail($id);
            $project->delete();
    
            return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully');
        }
    }
}