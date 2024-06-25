<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
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
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        // Validazione e salvataggio del progetto
        $projectData = $request->validated();

        // Creare una nuova istanza di Project
        $newProject = new Project();
        $newProject->fill($projectData);

        // Generare lo slug dal nome
        $newProject->slug = Str::slug($newProject->name, '_');

        // Salvare il progetto
        $newProject->save();

        // Reindirizzare alla lista dei progetti con un messaggio di successo
        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::with('type')->findOrFail($id);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type_id' => 'nullable|exists:types,id',
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
    { {
            $project = Project::findOrFail($id);
            $project->delete();

            return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully');
        }
    }
}
