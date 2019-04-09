@extends('layouts.master')

@section('title')
    Interest Calculator
@endsection

@section('head')
    {{-- Page specific CSS includes should be defined here; this .css file does not exist yet, but we can create it --}}

    <link href='/css/stylesheet.css' rel='stylesheet'>
@endsection

@section('content')
    <div id='main'>
        <h1>Interest Calculator</h1>
        <form method='GET' action='/calculate'>
            <p>Calculate the interest on a given payment<br></p>
            <fieldset>
                <legend>Initial amount:</legend>
                <label>$ <input type='number'
                                step='.01'
                                name='initialAmount'
                            @include('includes.oldNum', ['fieldName' => 'initialAmount'])
                    ></label>
                @include('includes.error-field', ['fieldName' => 'initialAmount'])
            </fieldset>

            <fieldset>
                <legend>Interest Rate:</legend>
                <label>
                    <input type='number'
                           step='any'
                           name='percentInterest'
                            @include('includes.oldNum', ['fieldName' => 'percentInterest'])>%
                </label>
                <label> per
                    <select name='interestFrequency'>
                        <option value='year'
                                @include('includes.oldSelect', ['fieldName' => 'interestFrequency', 'fieldValue' => 'year'])> year
                        </option>
                        <option value='half'
                                @include('includes.oldSelect', ['fieldName' => 'interestFrequency', 'fieldValue' => 'half'])> half-year
                        </option>
                        <option value='quarter'
                                @include('includes.oldSelect', ['fieldName' => 'interestFrequency', 'fieldValue' => 'quarter'])> quarter-year
                        </option>
                        <option value='month'
                                @include('includes.oldSelect', ['fieldName' => 'interestFrequency', 'fieldValue' => 'month'])> month
                        </option>
                    </select>
                </label>
                @include('includes.error-field', ['fieldName' => 'percentInterest'])
                @include('includes.error-field', ['fieldName' => 'interestFrequency'])
            </fieldset>

            <fieldset>
                <legend>Type of interest:</legend>
                <label><input type='radio'
                              name='interestType'
                              value='compound'
                            @include('includes.oldRadio', ['fieldName' => 'interestType', 'fieldValue' => 'compound'])>
                    Compound interest</label><br>
                <label><input type='radio'
                              name='interestType'
                              value='simple'
                            @include('includes.oldRadio', ['fieldName' => 'interestType', 'fieldValue' => 'simple'])>
                    Simple interest</label><br>
                @include('includes.error-field', ['fieldName' => 'interestType'])
            </fieldset>

            <fieldset>
                <legend>Time period:</legend>
                <label>After
                    <input type='number' step='any' name='timePeriodNumber'
                            @include('includes.oldNum', ['fieldName' => 'timePeriodNumber'])>
                       periods (Years / Half-Years / Quarters / Months)
                </label>
                @include('includes.error-field', ['fieldName' => 'timePeriodNumber'])
            </fieldset>

            <fieldset>
                <legend>Misc:</legend>
                <label>Display only interest?
                    <input type="checkbox"
                           name="totalBool" {{ (old('totalBool') || $totalBool) ? 'checked' : '' }}>
                </label>
            </fieldset>
            @if (count($errors) != 0)
                <h3 class='error'>Please fix all errors</h3>
            @else
                <br>
            @endif

            <input type='submit' value='CALCULATE' id='submit'>

        </form>
        @if (count($errors) == 0 && $total != '')
            <br>
            <div id='results'>
                <p>Calculated the
                    @if (!$totalBool)
                   total
                    @endif
                    {{ $interestType }} interest off of ${{ $initialAmount }}
                   at an interest rate of {{ $percentInterest }}% per
                    @if ($interestFrequency == 'year')
                   year
                    @elseif ($interestFrequency == 'half')
                   six months
                    @elseif ($interestFrequency == 'quarter')
                   three months
                    @elseif ($interestFrequency == 'month')
                   month
                    @endif
                   after
                    @if ($interestFrequency == 'year')
                        {{ $timePeriodNumber }} year{{ ($timePeriodNumber > 1 || $timePeriodNumber == 0) ? 's' : '' }}.
                    @elseif ($interestFrequency == 'half')
                        {{ $timePeriodNumber * 6 }} months.
                    @elseif ($interestFrequency == 'quarter')
                        {{ $timePeriodNumber * 3 }} months.
                    @elseif ($interestFrequency == 'month')
                        {{ $timePeriodNumber }}month{{ ($timePeriodNumber > 1) ? 's' : '' }}.
                    @endif
                </p>
                <h3>
                    @if ($totalBool)
                        Interest: $
                    @else
                        Total: $
                    @endif
                    @if ($total != '') {{ round($total, 2) }} @endif
                </h3>
            </div>
        @else

        @endif
        <br>
    </div>
@endsection