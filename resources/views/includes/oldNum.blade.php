@if (old($fieldName) != '')
    value='{{ old($fieldName) }}'
@else
    value='{{  eval('return $'. $fieldName . ';') }}'
@endif