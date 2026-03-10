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
        $histories = History::orderBy('year', 'desc')->orderBy('order', 'asc')->get();
        
        $groupedHistories = $histories->groupBy(function ($item) {
            $year = $item->year;
            $currentYear = date('Y');
            if ($year >= 2001) return $currentYear;
            if ($year >= 1951) return '2000';
            if ($year >= 1901) return '1950';
            if ($year >= 1851) return '1900';
            if ($year >= 1801) return '1850';
            if ($year >= 1751) return '1800';
            if ($year >= 1701) return '1750';
            
            return 'До 1750';
        });

        return view('public.history.history', compact('groupedHistories', 'histories'));
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
    public function show($id)
    {
        $history = History::findOrFail($id);
        
        $previous = History::where('year', '<', $history->year)
            ->orWhere(function($query) use ($history) {
                $query->where('year', $history->year)
                    ->where('id', '<', $history->id);
            })
            ->orderBy('year', 'desc')
            ->orderBy('id', 'desc')
            ->first();

        $next = History::where('year', '>', $history->year)
            ->orWhere(function($query) use ($history) {
                $query->where('year', $history->year)
                    ->where('id', '>', $history->id);
            })
            ->orderBy('year', 'asc')
            ->orderBy('id', 'asc')
            ->first();
        
        return view('public.history.show', compact('history', 'previous', 'next'));
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
