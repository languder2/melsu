<?php

namespace App\Http\Controllers\History;

use App\Http\Controllers\Controller;
use App\Models\History\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $histories = History::orderBy('order', 'asc')->get();

        return view('admin.history.page', compact('histories'));
    }
    public function indexPage()
    {
        $histories = History::orderBy('year', 'asc')->orderBy('order', 'asc')->get()->groupBy('year')
        ->map(function ($items) {
            $first = $items->first();
//            $first->description  = $items->pluck('description')->map(fn($item)=> "<div>$item</div>")->implode('');
//            $first->content      = $items->pluck('content')->map(fn($item)=> "<div>$item</div>")->implode('');
            return $first;
        })
        ->take(100)
        ;

        return view('public.history.history', compact('histories'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.history.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:20048',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/history', 'public');
            $validated['image'] = $path;
        }

        History::create($validated);

        return redirect()->route('history');
    }

    /**
     * Display the specified resource.
     */
    public function show(History $history)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $history = History::find($id);
        return view('admin.history.form', compact('history'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'year' => 'required|integer',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $history = History::findOrFail($id);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/history', 'public');
            $validated['image'] = $path;
        } else {
            $validated['image'] = $history->image;
        }

        $history->update($validated);

        return redirect()->route('history');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $history = History::find($id);
        $history->delete();

        return redirect()->route('history');
    }
}
