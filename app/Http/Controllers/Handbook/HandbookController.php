<?php

namespace App\Http\Controllers\Handbook;

use App\Http\Controllers\Controller;
use App\Models\Handbook\HandbookCollectionModel;
use App\Models\Handbook\HandbookModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HandbookController extends Controller
{
    public function indexCollections()
    {
        $collections = HandbookCollectionModel::all();
        return view('admin.handbook.collectionsIndex', compact('collections'));
    }

    public function createCollection()
    {
        return view('admin.handbook.collectionsForm');
    }

    public function storeCollection(Request $request)
    {
        $request->validate([
            'page_name' => 'required|unique:handbook_collections,page_name',
        ]);

        HandbookCollectionModel::create([
            'page_name' => $request->page_name,
        ]);

        return redirect()->route('handbook.collections')
            ->with('success', 'Коллекция справочников успешно создана.');
    }

    public function editCollection($id)
    {
        $collection = HandbookCollectionModel::find($id);
        return view('admin.handbook.collectionsForm', compact('collection'));
    }

    public function updateCollection(Request $request, $id)
    {
        $request->validate([
            'page_name' => 'required|unique:handbook_collections,page_name,' . $id,
        ]);

        HandbookCollectionModel::find($id)->update([
            'page_name' => $request->page_name,
        ]);

        return redirect()->route('handbook.collections')
            ->with('success', 'Коллекция справочников успешно обновлена.');
    }

    public function destroyCollection($id)
    {
        HandbookCollectionModel::find($id)->delete();

        return redirect()->route('handbook.collections')
            ->with('success', 'Коллекция справочников успешно удалена.');
    }

    public function index($collectionId)
    {
        $handbook = HandbookModel::where('handbook_collection_id', $collectionId)->get()->groupBy('category');;
        $collection = HandbookCollectionModel::find($collectionId);
        $pageName = $collection->page_name;
        return view('admin.handbook.page', compact('handbook', 'collectionId','pageName'));
    }

    public function create($collectionId)
    {
        return view('admin.handbook.form', compact('collectionId'));
    }

    public function store(Request $request, $collectionId)
    {
        $request->validate([
            'title' => 'required',
            'link' => '',
            'icon' => 'nullable|file|mimes:svg',
            'category' => 'required',
            'color' => 'nullable',
        ]);

        $path = $request->file('icon')->store('svg');

        HandbookModel::create([
            'handbook_collection_id' => $collectionId,
            'title' => $request->title,
            'link' => $request->link,
            'category' => $request->category,
            'icon' => $path,
            'color' => $request->color,
        ]);

        return redirect()->route('handbook.page', ['collectionId' => $collectionId])
            ->with('success', 'Запись успешно создана.');
    }

    public function edit($collectionId, $id)
    {
        $handbook = HandbookModel::find($id);
        return view('admin.handbook.form', compact('handbook', 'collectionId'));
    }

    public function update(Request $request, $collectionId, $id)
    {
        $request->validate([
            'title' => 'required',
            'link' => '',
            'icon' => 'nullable|file|mimes:svg',
            'category' => 'required',
            'color' => 'nullable|',
        ]);

        $handbook = HandbookModel::find($id);
        if ($request->hasFile('icon')) {
            if ($handbook->icon) {
                Storage::delete($handbook->icon);
            }
            $path = $request->file('icon')->store('svg');
            $handbook->icon = $path;
        }

        $handbook->title = $request->title;
        $handbook->link = $request->link;
        $handbook->category = $request->category;
        $handbook->color = $request->color;
        $handbook->save();

        return redirect()->route('handbook.page', ['collectionId' => $collectionId])
            ->with('success', 'Запись успешно обновлена.');
    }

    public function destroy($collectionId, $id)
    {
        $handbook = HandbookModel::find($id);
        $handbook->delete();

        return redirect()->route('handbook.page', ['collectionId' => $collectionId])
            ->with('success', 'Запись успешно удалена.');
    }

    public function show($collectionId)
    {
        $handbooks = HandbookModel::where('handbook_collection_id', $collectionId)->get()->groupBy('category');
        $collections = HandbookCollectionModel::all(['id', 'page_name']);

        $menuItems = [];
        foreach ($collections as $collection) {
            $menuItems[] = (object) [
                'name' => $collection->page_name,
                'link' => route('public.handbooks.show', ['collectionId' => $collection->id]),
                'subs' => [],
            ];
        }

        $menu = (object) ['items' => $menuItems];


        return view('public.handbook.show', compact('handbooks','menu'));
    }
}
