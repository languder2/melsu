<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Menu\Menu;
use App\Models\Page\Content as PageContent;
use App\Models\Page\Page;
use App\Models\Partners\Partner;
use App\Models\Upbringing\Upbringing;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PagesController extends Controller
{
    public function list(): string
    {

        return view('pages.admin', [
            'contents' => [

                View::make('components.admin.top_menu.pages')->with([
                    'active' => 'pages'
                ])->render(),

                View::make('components.admin.pages.header')->with([])->render(),

                View::make('components.admin.pages.list')->with([
                    'list' => Page::GetList(),
                ])->render(),
            ]
        ]);
    }


    public function form($id = null): string
    {

        return view('pages.admin', [
            'contents' => [

                View::make('components.admin.pages.form')->with([
                    'pages' => Page::orderBy('name')->get(),
                    'sidebars' => Menu::orderBy('name')->get(),
                    'current' => Page::find($id),
                ])->render(),
            ]
        ]);

    }

    public function save(Request $request): string|RedirectResponse
    {
        $form = $request->validate(Page::FormRules($request->get('id')), Page::FormMessage());

        if (empty($request->get('id')))
            $record = new Page();
        else
            $record = Page::find($request->get('id'));

        $record->fill($form);

        $record->without_bg = array_key_exists('without_bg', $form);

        $record->save();

        if($request->has('sections'))
            PageContent::processing($record,$request->get('sections'));

        return redirect()->route('admin:pages');
    }

    public function delete(int $id)
    {
        $record = Page::find($id);

        if (!is_null($record))
            $record->delete();

        return redirect()->route('admin:pages');
    }

    public function ApiDeleteSection($id = null): JsonResponse
    {
        $item = PageContent::find($id);

        if($item)
            $item->delete();

        return response()->json(
            [
                'message' => "Секция контента удалена"
            ]);
    }

    public function ApiDeleteUpbringingSection($id = null): JsonResponse
    {
        $section = Upbringing::find($id);

        if ($section) {
            $section->delete();
        }

        return response()->json(
            [
                'message' => "Секция контента удалена"
            ]);
    }
    public function ApiDeletePartnerSection($id = null): JsonResponse
    {
        $section = Partner::find($id);

        if ($section) {
            $section->delete();
        }

        return response()->json(
            [
                'message' => "Секция контента удалена"
            ]);
    }


    public function showPage(string $page = null): RedirectResponse| \Illuminate\View\View
    {
        $page = Page::where('code', $page)->first();

        if (!$page || !$page->is_show)
            abort(404);

        $menu = Menu::where('show',1)->find($page->menu_id);

        return view('pages.public.single',compact('page','menu'));
    }

}
