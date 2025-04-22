<?php

namespace App\Http\Controllers\Minor;

use App\Enums\RegimentType;
use App\Http\Controllers\Controller;
use App\Models\Minor\RegimentMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RegimentController extends Controller
{
    public function test()
    {

    }
    public function admin()
    {
        $list = RegimentMember::orderBy('lastname')->orderBy('firstname')->get();

        return view('regiment.admin.list',compact('list'));
    }
    public function form(RegimentMember $member)
    {

        $regiments = RegimentType::pluck();

        return view('regiment.admin.form', compact('member', 'regiments'));

    }
    public function save(Request $request, RegimentMember $member):RedirectResponse
    {

        $form = $request->validate(RegimentMember::FormRules(), RegimentMember::FormMessage());

        $member->fill($form)->save();


        /* upload image */
        if($request->file('image'))
            $member->image->saveImage($request->file('image'));

        /* image form gallery */
        elseif($request->has('gallery_image') && $request->get('gallery_image') !== $member->image->src){
            $member->image->fill([
                'name'          => $member->full_name,
                'reference_id'  => $member->image::getReference($request->get('gallery_image')),
                'filename'      => null,
                'filetype'      => null,
            ])->save();
        }

        return redirect()->route('regiment:admin:list');

    }
    public function Delete(RegimentMember $member):RedirectResponse
    {
        $member->delete();

        return redirect()->back();
    }
    public function public(string $type)
    {

        $type = RegimentType::tryFrom(ucwords(strtolower($type))) ?? RegimentType::Immortal;

        $menu = RegimentMember::getMenu();

        $list = RegimentMember::where('is_show', true)
            ->where('type',$type)->orWhere('type',RegimentType::Both)
            ->orderBy('lastname')->orderBy('firstname')->get();

        $letters = RegimentMember::where('is_show', true)
            ->where('type',$type)->orWhere('type',RegimentType::Both)
            ->select('letter')
            ->distinct()
            ->pluck('letter');

        return view('regiment.public.list', compact('menu', 'list', 'letters', 'type'));
    }
}
