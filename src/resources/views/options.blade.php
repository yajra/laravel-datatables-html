window.{{ config('datatables.variable_name') }} = window.{{ config('datatables.variable_name') }} || {};
window.{{ config('datatables.variable_name') }}.options = %2$s
window.{{ config('datatables.variable_name') }}.editors = [];
@foreach($editors as $editor)
window.{{ config('datatables.variable_name') }}.editors["{{$editor->instance}}"] = {!! $editor->toJson()  !!}
@endforeach
