<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Import;
use App\Models\Import\FinanceReport;

class ImportController extends Controller
{

    public function financeReport(Request $request)
    {
        if ($request->hasFile('file')) {

            $import = new Import();

            $import->sheet = $request->get('sheet');

            Excel::import($import, $request->file('file'));

        }


        $list = FinanceReport::select('name')
            ->selectRaw('SUM(amount) as amount')
            ->groupBy('name')
            ->get();

        $result = collect([]);

        for($i=1;$i<=34;$i++)
            $result->put($i, (object)[
                'count'     => 0,
                'amount'    => 0,
            ]);


        foreach ($list as $item) {
            $item->group = match(true){
                $item->amount > 0 && $item->amount <= 22440             => 1,
                $item->amount > 22440 && $item->amount <= 23550         => 2,
                $item->amount > 23550 && $item->amount <= 24670         => 3,
                $item->amount > 24670 && $item->amount <= 25790         => 4,
                $item->amount > 25790 && $item->amount <= 26920         => 5,
                $item->amount > 26920 && $item->amount <= 29170         => 6,
                $item->amount > 29170 && $item->amount <= 31410         => 7,
                $item->amount > 31410 && $item->amount <= 33650         => 8,
                $item->amount > 33650 && $item->amount <= 35900         => 9,
                $item->amount > 35900 && $item->amount <= 38140         => 10,
                $item->amount > 38140 && $item->amount <= 40390         => 11,
                $item->amount > 40390 && $item->amount <= 42630         => 12,
                $item->amount > 42630 && $item->amount <= 44870         => 13,
                $item->amount > 44870 && $item->amount <= 47120         => 14,
                $item->amount > 47120 && $item->amount <= 49360         => 15,
                $item->amount > 49360 && $item->amount <= 51610         => 16,
                $item->amount > 51610 && $item->amount <= 53850         => 17,
                $item->amount > 53850 && $item->amount <= 56090         => 18,
                $item->amount > 56090 && $item->amount <= 58340         => 19,
                $item->amount > 58340 && $item->amount <= 60580         => 20,
                $item->amount > 60580 && $item->amount <= 62630         => 21,
                $item->amount > 62630 && $item->amount <= 65070         => 22,
                $item->amount > 65070 && $item->amount <= 67300         => 23,
                $item->amount > 67300 && $item->amount <= 70000         => 24,
                $item->amount > 70000 && $item->amount <= 80000         => 25,
                $item->amount > 80000 && $item->amount <= 100000        => 26,
                $item->amount > 100000 && $item->amount <= 150000       => 27,
                $item->amount > 150000 && $item->amount <= 200000       => 28,
                $item->amount > 200000 && $item->amount <= 400000       => 29,
                $item->amount > 400000 && $item->amount <= 1000000      => 30,
                $item->amount > 1000000 && $item->amount <= 2000000     => 31,
                $item->amount > 2000000 && $item->amount <= 3000000     => 32,
                $item->amount > 3000000                                 => 33,

            };

            $result[$item->group]->count++;
            $result[$item->group]->amount += $item->amount;


            $result[34]->count++;
            $result[34]->amount += $item->amount;

        }

        return view('imports.finance.report', compact('result'));

    }

}
