<?php

namespace App\View\Components\Info\Education;

use App\Enums\ProfileDocumentType;
use App\Models\Documents\Document;
use App\Models\Education\Profile;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class DocumentForm extends Component
{
    public Collection $types;
    public Collection $years;
    public string $save;
    public ?string $type = null;
    public ?string $code = null;
    public ?Document $document = null;
    public function __construct($profileId,$documentId,$code, $type = null)
    {

        $this->types    = ProfileDocumentType::list();

        $this->years    = collect(range(2020, now()->year))->mapWithKeys(function ($item){
            return [$item => $item];
        })->reverse();;

        $this->save     = route('education-profile.document.save',[
            'profile'   => $profileId,
            'document'  => $documentId,
        ]);

        $this->code     = $code;

        $this->document = Document::find($documentId) ?? new Document();

        $this->type = $type;

    }

    public function render(): View|Closure|string
    {
        return view('components.info.education.document-form');
    }
}
