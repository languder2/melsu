<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Page\Page;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class PageCabinetController extends Controller
{

    public function list(bool $onApproval = false): View
    {
        $filters = Session::get('cabinetPagesFilters', collect());

        $builder = Page::query()->when(
            !auth()->user()->isEditor(),
            fn ($query) => $query->whereIn('id', auth()->user()->pages->pluck('id'))
        );

        if($filters->has('search'))
            $builder->where(fn($query) => $query->where('id', $filters->get('search'))
                ->orWhere('name', 'like', '%'.$filters->get('search').'%')
                ->orWhere('code', 'like', '%'.$filters->get('search').'%')
            );

        $list = $builder->get();


        return view('pages.cabinet.list', compact('onApproval', 'list', 'filters'));
    }

    public function form(Page $page): View
    {
        Gate::authorize('access-page', $page);

        return view('pages.cabinet.form', compact('page'));
    }

    public function save(Request $request, Page $page): RedirectResponse
    {
        Gate::authorize('access-page', $page);

        $form = $request->validate($page->validateRules(), $page->validateMessages());

        $page->fill($form)->save();

        $page->getContentRecord()->fill(['content' => $request->get('content')])->save();

        if($request->file('image'))
            $page->image->saveImage($request->file('image'));

        if($request->get('meta'))
            $page->metaSave($request->get('meta'), $request->file('meta.image'));

        return redirect()->to( $request->has('save-close') ? $page->cabinet_list_link : $page->cabinet_form_link );
    }

    public function delete(Page $page): RedirectResponse
    {
        Gate::authorize('access-page', $page);

        $page->delete();

        return redirect()->back();
    }

    public function setFilter(Request $request): RedirectResponse
    {
        if($request->has('clear'))
            Session::remove('cabinetPagesFilters');
        else
            Session::put('cabinetPagesFilters', $request->collect()->filter(fn($item) => !empty($item)));

        return redirect()->back();
    }

}
