<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Gallery\Gallery;
use App\View\Components\Admin\Contact\Form;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function ApiAddPosition(?string $type, ?int $current = null):View
    {
        $contact = new Form($current,$type);
        return $contact->render();
    }

    public function ApiDelete (Request $request,$id): JsonResponse
    {

        $item = Contact::Find($id);

        if(!$item)
            return response()->json([],204);

        $item->delete();

        return response()->json(
            [
                'message' =>
                    "Контакт удален"
                    . PHP_EOL .
                    $item->content
                    . PHP_EOL .
                    "Восстановимо до: "
                    .Carbon::now()->addWeek(2)->format('d.m.Y H:i')
            ]);
    }
}
