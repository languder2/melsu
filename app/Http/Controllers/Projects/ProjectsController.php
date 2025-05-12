<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Models\Projects\Cluster;
use App\Models\Projects\Project;
use App\Models\Services\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectsController extends Controller
{
    public function admin(): View
    {
        $clusters = Cluster::orderBy('sort')->orderBy('name')->get();

        $projects = Project::independentProjects();


        return view('projects.admin.list', compact('clusters', 'projects'));
    }
    public function form(Request $request, ?Project $current): View
    {
        $cluster_id = $request->get('cluster_id');

        if($cluster_id)
            $current->sort = Project::where('cluster_id',$cluster_id)->orderBy('sort','desc')->first()->sort + 10;

        $clusters = Cluster::orderBy('name')->get()->pluck('name', 'id');

        return view('projects.admin.form', compact("current",'clusters','cluster_id'));
    }

    public function save(Request $request, ?Project $current)
    {

        $form = $request->validate($current->FormRules(),$current->FormMessage());

        $current->fill($form)->save();

        Log::add($current);

        $current->preview->includeSave($request->file('image'),$request->get('preview'));

        if($request->has('contents'))
            foreach ($request->get('contents') as $key=>$form)
                $current->getContent($key)->customSave($form);

        if($request->has('save'))
            return redirect()->to($current->edit);
        else
            return redirect()->to($current->admin);
    }

    public function delete(?Project $current): RedirectResponse
    {
        $current->delete();

        Log::add($current,'delete');

        return redirect()->to($current->admin);
    }

    public function single(?Project $current): View
    {
        return view('projects.public.single', compact('current'));
    }

}
