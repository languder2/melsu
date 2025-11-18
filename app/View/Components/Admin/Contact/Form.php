<?php

namespace App\View\Components\Admin\Contact;

use App\Enums\ContactType;
use App\Models\Minor\Contact;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public ?Contact $current;

    public function __construct(Contact|array|null $current, ?string $type)
    {



        if(!$type)
            $type = ContactType::Email;

        if( $current instanceof Contact )
            $this->current = $current;
        else
            $this->current = new Contact(
                $current ??
                [
                    'id'        => (int)microtime(true),
                    'type'      => $type,
                    'is_show'   => true,
                ]
            );

    }

    public function render(): View|Closure|string
    {
        return view('components.admin.contact.form',[
            'current' => $this->current,
        ]);
    }
}
