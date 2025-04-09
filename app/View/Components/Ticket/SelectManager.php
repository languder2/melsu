<?php

namespace App\View\Components\Ticket;

use App\Enums\TicketRoles;
use App\Models\Ticket\UserRole;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

use App\Enums\UserRoles;

class SelectManager extends Component
{

    public Collection $managers;

    public function __construct(?array $managers)
    {
        $this->managers = $managers
            ? collect($managers)
            : UserRole::where('role', TicketRoles::Manager)->get()
            ->mapWithKeys(function ($record) {
                return [$record->user_id => $record->user->full_name];
            });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ticket.select-manager');
    }
}
