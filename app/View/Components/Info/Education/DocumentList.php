<?php

namespace App\View\Components\Info\Education;

use App\Models\Education\Profile;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class DocumentList extends Component
{
    public string $addLink;
    public string $code;

    public Collection $list;

    public function __construct(?int $profileId, ?int $documentId, ?string $code)
    {
        $this->addLink = route('education-profile.document.modal',[
            $profileId, $documentId, "code"=> $code
        ]);
        $this->code = $code;

        $documents = Profile::find($profileId)->documents();

        $this->list = collect();

        if($documents->count())
            $this->list = $documents->where(function ($item) use ($code) {
                return $item->code === $code;
            })
            ->each(function ($item) use ($profileId, $code) {
                $item->edit = route('education-profile.document.modal',[
                    $profileId, $item->id, "code"=> $code
                ]);
            })
            ->sortBy('sort')
            ->reverse()
            ;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.info.education.document-list');
    }
}
