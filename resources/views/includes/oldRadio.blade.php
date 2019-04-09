@if ((old($fieldName) != '' && old($fieldName) == $fieldValue) || eval('return $'. $fieldName . ';') == $fieldValue)
    checked
@endif