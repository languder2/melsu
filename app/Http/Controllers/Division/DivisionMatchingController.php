<?php

namespace App\Http\Controllers\Division;

use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DivisionMatchingController extends Controller
{
    public function UUID(): View
    {
        $divisions = flattenList(Division::all());

        $file = Storage::disk('private')->get('json/departments.json');

        $json = collect();

        if($file){
            $json = collect(json_decode($file, true)['departments'])->mapWithKeys(fn($item, $index) => [$item['GUID_Dep'] => (object)($item)]);
            $json = flattenList($json, 'GUID_Dep','GUID_ParentDep');
        }

        return view('divisions.matching.uuid', compact('divisions', 'json'));
    }

    public function changeUUID(Request $request, Division $division): JsonResponse
    {
        $division->fill(['uuid' => $request->input('uuid')])->save();

        return response()->json(['success' => true, 'uuid' => $request->input('uuid'), 'id' => $division->id]);

    }

}
