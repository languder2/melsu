<?php

namespace App\Models\Info;

use App\Enums\Info\CommonFields;
use App\Enums\Info\DocumentsFields;
use App\Enums\Info\InfoType;
use App\Enums\Info\StandardsFields;
use App\Enums\Info\StructureFields;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class InfoDocuments extends Info
{
    public function documents(string $code): array
    {
        $code = DocumentsFields::tryFrom($code);

        return [
            'prop'      => $code->name,
            'label'     => $code->getName(),
            'documents' => $this->getDocuments(InfoType::Documents, $code),
        ];
    }
    public function standards(string $code): array
    {
        $code = StandardsFields::get($code);

        return [
            'prop'      => $code->name,
            'label'     => $code->getName(),
            'documents' => $this->getDocuments(InfoType::Standards, $code),
        ];
    }

}
