<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Models\Documents\Document;
use App\Models\Projects\Cluster;
use App\Models\Services\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClustersController extends Controller
{
    public function admin(): View
    {
        $list = Cluster::orderBy('sort')->orderBy('name')->get();

        return view('projects.clusters.admin.list', compact('list'));
    }
    public function form(?Cluster $current): View
    {
        return view('projects.clusters.admin.form', compact("current"));
    }


    public function save(Request $request, Cluster $current)
    {
        $form = $request->validate($current->FormRules(),$current->FormMessage());

        $current->fill($form)->save();

        Log::add($current);

        if($request->has('short'))
            $current->getContent('short')->updateWithLog($request->get('short'));

        if($request->has('full'))
            $current->getContent('full')->updateWithLog($request->get('full'));

        $current->preview->includeSave($request->file('image'),$request->get('preview'));

        if($request->has('ico'))
            $current->ico->includeSave($request->file('ico'));

        if($request->has('contents'))
            foreach ($request->get('contents') as $key=>$form)
                $current->getContent($key)->customSave($form);

        return redirect()->to($request->has('save') ? $current->edit : $current->admin);
    }

    public function delete(?Cluster $current): RedirectResponse
    {
        $current->delete();

        Log::add($current,'delete');

        return redirect()->to($current->admin);
    }

    public function public(): View
    {
        $list = Cluster::where('is_show',true)->orderBy('sort')->orderBy('name')->get();

        return view('projects.clusters.public.list', compact('list'));
    }
    public function single(?Cluster $current = null): View
    {
        return view('projects.clusters.public.single', compact('current'));
    }

}
