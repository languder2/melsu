<?php

namespace App\Enums;

enum TicketRoles: string
{
    case User           = 'user';
    case Agent          = 'agent';
    case Manager        = 'manager';
    case Administrator  = 'admin';
    case Viewer         = 'viewer';
    case Auditor        = 'auditor';
    case Guest          = 'guest';
}
