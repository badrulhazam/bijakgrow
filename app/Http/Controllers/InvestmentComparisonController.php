<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvestmentComparisonController extends Controller
{
  public function index(Request $request)
{
    if ($request->isMethod('post')) {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'rate_asb' => 'required|numeric',
            'rate_th' => 'required|numeric',
            'rate_emas' => 'required|numeric',
        ]);

        $investment = $validated['amount'];
        $returns = [
            'ASB' => $validated['rate_asb'],
            'TH' => $validated['rate_th'],
            'Emas' => $validated['rate_emas'],
        ];

        $results = [];

        foreach ($returns as $name => $rate) {
            $results[] = [
                'instrument' => $name,
                'return_rate' => $rate,
                'profit_1_year' => $investment * ($rate / 100),
                'profit_2_years' => $investment * pow(1 + ($rate / 100), 2) - $investment,
                'profit_3_years' => $investment * pow(1 + ($rate / 100), 3) - $investment,
                'profit_4_years' => $investment * pow(1 + ($rate / 100), 4) - $investment,
                'profit_5_years' => $investment * pow(1 + ($rate / 100), 5) - $investment,
            ];
        }

        return view('investment.index', compact('results', 'investment'));
    }

    // jika GET, paparkan kosong
    return view('investment.index', [
        'results' => [],
        'investment' => 0
    ]);
}



}
