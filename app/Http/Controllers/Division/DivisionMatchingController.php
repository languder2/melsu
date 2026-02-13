<?php

namespace App\Http\Controllers\Division;

use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DivisionMatchingController extends Controller
{
    public function UUID(): View
    {
        $filters = collect(Session::get('divisionMatchingUUIDFilter'));

        $divisions = Division::query();

        if($filters->has('notEmptyUUID') && $filters->get('notEmptyUUID') === '0')
            $divisions->whereNull('uuid');

        $divisions = flattenList($divisions->get());

        $file = Storage::disk('private')->get('json/departments.json');

        $json = collect();

        if($file){
            $json = collect(json_decode($file, true)['departments'])->mapWithKeys(fn($item, $index) => [$item['GUID_Dep'] => (object)($item)]);

            if($filters->has('showDeleted') && $filters->get('showDeleted') === '0')
                $json = $json->filter(fn($item) => !$item->deleted);

            if($filters->has('showDisbanded') && $filters->get('showDisbanded') === '0')
                $json = $json->filter(fn($item) => !$item->disbanded);


            $json = flattenList($json, 'GUID_Dep','GUID_ParentDep');
        }

        //        $json->each(fn($item) => $item->name = Str::of($item->name)->replaceMatches('/^[\d\.]+\s*/u', '')->trim());


        return view('divisions.matching.uuid', compact('divisions', 'json'));
    }

    public function changeUUID(Request $request, Division $division): JsonResponse
    {
        $division->fill(['uuid' => $request->input('uuid')])->save();

        return response()->json(['success' => true, 'uuid' => $request->input('uuid'), 'id' => $division->id]);

    }

    public function filter(Request $request): RedirectResponse
    {

        if($request->has('clear'))
            Session::remove('divisionMatchingUUIDFilter');

        else
            Session::put('divisionMatchingUUIDFilter', $request->collect()->except('_token'));

        return redirect()->back();

    }

}
