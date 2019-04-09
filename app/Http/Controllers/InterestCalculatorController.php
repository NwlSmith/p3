<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class InterestCalculatorController extends Controller
{
    //use ValidatesRequests;

    /**
     * GET
     * /index
     * Show the form for calculating interest
     */
    public function index(Request $request)
    {
        $initialAmount = $request->session()->get('initialAmount', '0');
        $percentInterest = $request->session()->get('percentInterest', '0');
        $interestFrequency = $request->session()->get('interestFrequency', '');
        $interestType = $request->session()->get('interestType', '');
        $timePeriodNumber = $request->session()->get('timePeriodNumber', '0');
        $totalBool = $request->session()->get('totalBool', false);
        $total = $request->session()->get('total', '');

        return view('/index')->with([
            'initialAmount' => $initialAmount,
            'percentInterest' => $percentInterest,
            'interestFrequency' => $interestFrequency,
            'interestType' => $interestType,
            'timePeriodNumber' => $timePeriodNumber,
            'totalBool' => $totalBool,
            'total' => $total
        ]);
    }

    /**
     * GET
     * /calculate
     * Process the form to calculate interest
     */
    public function calculate(Request $request)
    {
        $request->validate([
            'initialAmount' => 'required|numeric|min:0',
            'percentInterest' => 'required|numeric',
            'interestFrequency' => 'required',
            'interestType' => 'required',
            'timePeriodNumber' => 'required|numeric|integer|min:0'
        ]);

        $initialAmount = $request->input('initialAmount', '0');
        $percentInterest = $request->input('percentInterest', '0');
        $interestFrequency = $request->input('interestFrequency', '');
        $interestType = $request->input('interestType', '');
        $timePeriodNumber = $request->input('timePeriodNumber', '0');
        $totalBool = $request->input('totalBool', false);
        $total = $request->input('total', '');

        switch ($interestType) {
            case 'compound':
                $total = $initialAmount * pow(1 + ($percentInterest / 100), $timePeriodNumber);
                break;
            case 'simple':
                $total = $initialAmount * (1 + ($percentInterest / 100) * $timePeriodNumber);
                break;
        }
        if ($totalBool) {
            $total = $total - $initialAmount;
        }

        return redirect('/index')->with([
            'initialAmount' => $initialAmount,
            'percentInterest' => $percentInterest,
            'interestFrequency' => $interestFrequency,
            'interestType' => $interestType,
            'timePeriodNumber' => $timePeriodNumber,
            'totalBool' => $totalBool,
            'total' => $total
        ]);
    }
}
