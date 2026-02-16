<?php

namespace App\Http\Controllers\Finance;

use App\Exports\FinanceBook;
use App\Exports\FinanceSheet;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Maatwebsite\Excel\Excel as ExcelFormat;
use Maatwebsite\Excel\Facades\Excel;

class FinanceController extends Controller
{
    public function index(): View
    {
        return view('finance.cabinet.index');
    }

    public function upload(Request $request): RedirectResponse
    {
        $file = $request->file('file');

        if(!in_array($file->getMimeType(),[
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ]))
            return redirect()->route('finance.compilation.index')->with(['error' => 'Неверный формат файла']);


        $data = Excel::toCollection(collect(), $file);

        if(!$data->has($request->input('page')-1))
            return redirect()->route('finance.compilation.index')
                ->with(['error' => 'Страница под указанным номером не найдена']);

        $page = $data[$request->input('page')-1];

        if(!$page->first()->has(9))
            return redirect()->route('finance.compilation.index')
                ->with(["error" => "Проверьте шаблон данных на указанной странице"]);

        $page = $page->filter(fn($item) => $item[9] == 1);

        if($page->isEmpty())
            return redirect()->route('finance.compilation.index')
                ->with(["error" => "На указанной странице не найдено записей для обработки (колонке J = 1)"]);


        $errors     = $page->filter(fn($item) => (float)$item[2] <= 0)->each(fn($item) => $item[2] = $item[2] ?: '0');

        $correct    = $page->filter(fn($item) => (float)$item[2] > 0);

        $mir        = $correct->filter(fn($item) =>  Str::startsWith($item[0], '4081'));


        $psb        = $mir->filter(fn($item) =>  is_null($item[6]));

        $psbAccounts = $psb->groupBy(0)->map(function ($group) {
            $row    = $group->first();

            return collect([
                'account'       => $row[0],
                'code'          => 810,
                'sum'           => $group->sum(2),
                'lastname'      => $row[3],
                'firstname'     => $row[4],
                'middle_name'   => $row[5],
                'indent'        => null,
                'passport'      => $row[7],
                'indent2'       => null,
                'indent3'       => null,
                'income_code'   => 1
            ]);
        });

        $sbr = $mir->diffKeys($psb)
            ->filter(fn($item) => trim(Str::lower($item[6])) == 'сбербанк' || trim(Str::lower($item[6])) == 'сбер');

        $sbrAccounts = $sbr->groupBy(0)->map(function ($group) {
            $row    = $group->first();

            return collect([
                'account'       => $row[0],
                'lastname'      => $row[3],
                'firstname'     => $row[4],
                'middle_name'   => $row[5],
                'sum'           => $group->sum(2),
                'income_code'   => 0
            ]);
        });

        $cash       = $correct->filter(fn($item) => is_null($item[0]))
                        ->each(fn($item) => $item->ident = $item[3]."-".$item[4]."-".$item[5]."-".$item[7]);

        $cashAccounts = $cash->groupBy('ident')->map(function ($group) {
            $row    = $group->first();

            return collect([
                'sum'           => $group->sum(2),
                'lastname'      => $row[3],
                'firstname'     => $row[4],
                'middle_name'   => $row[5],
            ]);
        });

        $other      = $correct->diffKeys($psb)->diffKeys($sbr)->diffKeys($cash)
                        ->each(fn($item) => $item->ident = $item[3]."-".$item[4]."-".$item[5]."-".$item[7]);

       $otherAccounts = $other->groupBy('ident')->map(function ($group) {
            $row    = $group->first();

            return collect([
                'account'       => $row[0],
                'sum'           => $group->sum(2),
                'lastname'      => $row[3],
                'firstname'     => $row[4],
                'middle_name'   => $row[5],
            ]);
        });

        $totals = collect([
            ['ПСБ',     $psbAccounts->count(), $psbAccounts->sum('sum')],
            ['Сбер',    $sbrAccounts->count(), $sbrAccounts->sum('sum')],
            ['Другое',  $otherAccounts->count(), $otherAccounts->sum('sum')],
            ['Касса',   $cashAccounts->count(), $cashAccounts->sum('sum')],
            ['Errors',  $errors->count()],
        ]);

        $compilation = collect([
            'psb' => (object)[
                'type'      => 'psb',
                'name'      => 'ПСБ',
                'accounts'  => $psbAccounts,
            ],
            'sbr' => (object)[
                'type'      => 'sbr',
                'name'      => 'Сбербанк',
                'accounts'  => $sbrAccounts,
            ],
            (object)[
                'type'      => 'other',
                'name'      => 'Другое',
                'accounts'  => $otherAccounts,
            ],
            (object)[
                'type'      => 'cash',
                'name'      => 'Касса',
                'accounts'  => $cashAccounts,
            ],
            (object)[
                'type'      => 'errors',
                'name'      => 'Errors',
                'accounts'  => $errors,
            ],
            (object)[
                'type'      => 'totals',
                'name'      => 'Итоги',
                'accounts'  =>  $totals,
            ],
        ]);

        $time       = Carbon::now()->format('H_i_s_');
        $path       = "finance-compilation/" . Carbon::now()->format('Y/m/d');
        $importName = $time . $file->getClientOriginalName();
        $resultName = $time . 'compilation_for_'.
            Str::replace('.'.$file->getClientOriginalExtension(),'',$file->getClientOriginalName());

        Excel::store(new FinanceBook($compilation), "{$path}/{$resultName}".'.xlsx', 'private');

//        Excel::store(
//            new FinanceSheet($psbAccounts, 'psb', 'psb'),
//            "{$path}/{$resultName}".'.xlsx', 'private', ExcelFormat::CSV);

        Storage::disk('private')->putFileAs($path, $file, $importName  );

        session()->put('financeCompilationResult', $path . '/' . $resultName .'.xlsx');

        return redirect()->route('finance.compilation.results');
    }

    public function results(): View
    {
        $fileName = session()->get('financeCompilationResult');

        $pages = collect();

        if(Storage::disk('private')->exists(session()->get('financeCompilationResult')))
            $pages  = Excel::toCollection(collect(), Storage::disk('private')->path($fileName));

        $extension  = File::extension(Storage::disk('private')->path($fileName));
        $size       = Storage::disk('private')->size($fileName);

        return view('finance.cabinet.index', compact('pages', 'extension', 'size'));
    }

    public function download(): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $fileName = session()->get('financeCompilationResult');

        if(!Storage::disk('private')->exists($fileName))
            abort(419);

        return Storage::disk('private')->download($fileName);
    }


}
