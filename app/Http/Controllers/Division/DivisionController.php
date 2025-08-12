<?php

namespace App\Http\Controllers\Division;

use App\Enums\DivisionType;
use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\Documents\Document;
use App\Models\Documents\DocumentCategory;
use App\Models\Education\Speciality;
use App\Models\Gallery\Image;
use App\Models\Menu\Menu;
use App\Models\News\RelationNews;
use App\Models\Page\Content as PageContent;
use App\Models\Partner\Partner;
use App\Models\Sections\Contact;
use App\Models\Services\Log;
use App\Models\Staff\Affiliation;
use App\Models\Staff\Staff;
use App\Models\Upbringing\Upbringing;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DivisionController extends Controller
{
    public function admin(): string
    {
        $list = Division::whereNull('parent_id')->orderBy('name')->get();

        return view('divisions.admin.list', compact('list'));
    }

    public function form(Request $request,$id = null): View|RedirectResponse
    {
        $current = Division::find($id);

        if(!$current)
            $current = new Division();

        $parents = Division::where('id','!=',$id)->orderBy('name')->get()->pluck('name','id');

        $types = DivisionType::forSelect();

        return view('divisions.admin.form.page',compact('parents','current','types'));
    }

    public function save(Request $request)
    {
        $form = $request->validate(Division::FormRules($request->get('id')), Division::FormMessage());

        if (empty($request->get('id')))
            $record = new Division();
        else
            $record = Division::find($request->get('id'));

        $record->fill($form);

        if($request->has('coordinator'))
            $record->coordinator_id = $request->get('coordinator')['staff_id'] ?? null;

        $record->show = array_key_exists('show', $form);

        $record->save();

        if(in_array($record->type,[DivisionType::Faculty,DivisionType::Department]))
            foreach ($record->specialities as $speciality)
                Speciality::updateAffiliation($speciality,$record);

        if($request->has('ico')){
            $ico = $record->ico ?? ( new Image(['type'=>'ico','name'=>$record->name]))->relation()->associate($record);
            $ico->saveImage($request->file('ico'));
        }

        /* upload image */
        if($request->file('image'))
            $record->preview->relation()->associate($record)->saveImage($request->file('image'));

        /* image form gallery */
        elseif($request->has('preview') && $record->preview->src != $request->get('preview')){
            $record->preview->fill([
                'name'          => $record->name,
                'reference_id'  => $record->preview::getReference($request->get('preview')),
                'filename'      => null,
                'filetype'      => null,
            ])
                ->relation()->associate($record)
                ->save();

        }

        /* add content sections*/
        if(array_key_exists('sections',$form))
            PageContent::processing($record,$request->get('sections'));

        /* add contacts*/
        if($request->has('contacts'))
            Contact::processing($record,$request->get('contacts'));

        /* add news*/
        if($request->has('news')){
            RelationNews::processingForms($record,request()->all('news')['news']);
        }

        /* add content upbringing sections*/
        if ($request->has('upbringing_sections')) {
            foreach ($request->input('upbringing_sections') as $id => $data) {
                $data['relation_id'] = $record->id;
                $data['relation_type'] = get_class($record);

                $data['show_title'] = !empty($data['show_title']) ? 1 : 0;
                $data['show'] = !empty($data['show']) ? 1 : 0;

                Upbringing::updateOrCreate(['id' => $id], $data);
            }
        }

        /* add content partner sections*/
        if ($request->has('partner_sections')) {
            foreach ($request->input('partner_sections') as $id => $data) {
                $data['relation_id'] = $record->id;
                $data['relation_type'] = get_class($record);

                $data['show_title'] = !empty($data['show_title']) ? 1 : 0;
                $data['show'] = !empty($data['show']) ? 1 : 0;

                Partner::updateOrCreate(['id' => $id], $data);
            }
        }

        return redirect()->to($request->has('save') ? $record->edit : $record->admin);
    }

    public function delete(int $id)
    {
        $record = Division::find($id);

        if (!is_null($record))
            $record->delete();

        $list = Division::where('parent_id',$id)->get();

        foreach ($list as $item)
            $item->fill(['parent_id' => null])->save();

        return redirect()->route('admin:division:list');
    }

    /* Public */
    public function publicList():View
    {
        $division   = Division::where('code', 'rectorate')->first();
        $menu       = Menu::where('code','university')->first();
        $depth      = 0;

        return view('divisions.public.list.page',compact('division','depth','menu'));
    }

    public function show(?Division $division):View|RedirectResponse
    {
        if (!$division->exists || !$division->show)
            return redirect()->route('public:division:list');

        $menu = Menu::where('code','university')->first();

        if (strtolower($division->code) === 'rectorate')
            return view('public.divisions.rectorate.page', compact('menu','division'));
        else
            return view('divisions.public.single.page', compact('menu','division'));
    }

    /* API */
    public function ApiVacatePosition(Request $request,$affiliation_id = null): JsonResponse
    {

        $item = Affiliation::find($affiliation_id);

        if($item)
            $item->delete();

        return response()->json(
            [
                'message' => "Вакансия освобождена"
            ]);
    }

    /* Public search */

    public function PublicSearchResult(Request $request)
    {
        $division = Division::where('code', 'rectorate')->first();

        if($request->has('search'))
            Division::search($division,$request->get('search'));
        else
            Division::search($division,'Отдел по работе с обучающимися');

        $depth = 0;

        return view('public.divisions.list.list',compact('division','depth'));

    }

    public function adminBranches():View
    {
        $list = Division::getBranches();

        return view('divisions.branches.admin.admin', compact('list'));
    }

    /* Staffs */
    public function staffsAdmin(Division $division):View
    {
        return view('divisions.staffs.admin', compact('division'));
    }

    public function staffsForm(Division $division, $type, Affiliation $staff):View
    {
        $staff->fill(['type'=>$type])->relation()->associate($division);

        return view('divisions.staffs.form', compact('division','staff'));
    }

    public function staffsSave(Request $request, Division $division, $type, Affiliation $staff)
    {

        $staff->fill([
            'staff_id'  => $request->get('staff_id'),
            'show'      => (bool) $request->get('show'),
            'post'      => $request->get('post'),
            'post_alt'  => $request->get('post_alt'),
            'full_name' => $staff->card->full_name,
            'order'     => $request->get('order'),
        ]);

        if((bool)$request->get('new') || !$request->get('staff_id')){
            $item = Staff::create([
                'lastname' => $request->get('lastname'),
                'firstname' => $request->get('firstname'),
                'middle_name' => $request->get('middle_name'),
            ]);

            $staff->staff_id = $item->id;
        }

        $staff->fill(['type'=>$type])->relation()->associate($division);

        if($staff->staff_id)
            $staff->save();

        return redirect()->to( $division->staffs_admin_list );
    }
    /* end Staffs */

    /* Document Categories */

    public function documentCategoryForm(Division $division, ?DocumentCategory $category):View
    {
        $category->relation()->associate($division);

        $sort = $division->new_document_category_sort;

        $list   = DocumentCategory::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->where('relation_id',$category->relation_id)
            ->where('relation_type',$category->relation_type)
            ->orderBy('name')
            ->get()
            ->pluck('name','id')
        ;

        return view('divisions.document-categories.form', compact('division','category','list','sort'));
    }

    public function documentCategorySave(Request $request, Division $division, ?DocumentCategory $category)
    {
        $category->relation()->associate($division);

        $form = $request->validate($category::FormRules(),$category::FormMessage());

        $category->fill($form)->relation()->associate($division)->save();

        return redirect()->to( $division->documents_admin_list );
    }

    public function documentCategoryDelete(?DocumentCategory $category):RedirectResponse
    {
        $category->delete();

        return redirect()->to( $category->relation_admin );
    }


    /* Documents */
    public function documentsAdmin(Request $request, Division $division):View
    {
        $field      = $request->get('field') ?? 'name';
        $direction  = $request->get('direction') ?? 'asc';

        return view('divisions.documents.admin', compact('division','field', 'direction'));
    }
    public function documentsForm(Division $division, ?DocumentCategory $category, ?Document $document):View
    {
        if(!$document->relation)
            $document->relation()->associate($division);

        if($category->exists && $category->id !== $document->category_id)
            $document->category_id = $category->id;

        if(!$document->exists)
            $document->sort = ($category->documents()->latest()->first()->sort ?? 0) + 10;

        $categories = $division->AllDocumentCategories();

        return view('divisions.documents.form', compact('division','document','categories'));
    }
    public function documentsSave(Request $request, Division $division, ?Document $document)
    {

        $form = $request->validate($document::FormRules(),$document::FormMessage());

        if(request()->file('file'))
            Document::FileSave($form);

        $document->fill($form)->relation()->associate($division)->save();

        Log::withOrigin($document->category, $document);

        return redirect()->to( $document->category->relation_admin );
    }
    /* end Documents */

}
