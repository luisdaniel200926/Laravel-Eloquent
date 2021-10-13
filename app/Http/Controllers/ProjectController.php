<?php

namespace App\Http\Controllers;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function getAllProjects() {
        $projects = Project::all();
        return $projects;
    }
    public function getChunkProjects() {
        Project::chunk(200, function ($projects) {
            foreach ($projects as $project) {
                //Aquí escribimos lo que haremos con los datos (operar, modificar, etc)
            }
            return $projects;
        });
    }

    public function getTenProjects()
    {
        $projects = Project::take(10)->get();
        return $projects;
    }

    public function insertProject(Request $request) {
        $project = new Project;
        $project->city_id = $request->cityId;
        $project->company_id = $request->companyId;
        $project->user_id = $request->userId;
        $project->name = $request->name;
        $project->execution_date = $request->executionDate;
        $project->is_active = $request->isActive;
        $project->save();
    }

    public function updateProject(Request $request, $id) {
        $project = Project::findOrFail($id);
        $project->city_id = $request->cityId;
        $project->company_id = $request->companyId;
        $project->user_id = $request->userId;
        $project->name = $request->name;
        $project->execution_date = $request->executionDate;
        $project->is_active = $request->isActive;
        $project->save();


        return "Actualizado";
    }
    public function updateInactiveProjects() {
        $project = Project::where('is_active', 0)
            ->update(['name' => 'Proyecto Inactivo']);

        return "Se han actualizado los proyectos inactivos";
    }

}
