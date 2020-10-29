$(function(){
    window.{{ config('datatables.variable_name') }} = window.{{ config('datatables.variable_name') }} || {};
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}});
    @foreach($editors as $editor)
        var {{$editor->instance}} = window.{{ config('datatables.variable_name') }}["%1$s-{{$editor->instance}}"] = new $.fn.dataTable.Editor({!! $editor->toJson() !!});
        {!! $editor->scripts  !!}
        @foreach ((array) $editor->events as $event)
            {{$editor->instance}}.on('{!! $event['event']  !!}', {!! $event['script'] !!});
        @endforeach
    @endforeach
    window.{{ config('datatables.variable_name') }}["%1$s"] = $("#%1$s").DataTable(%2$s);
});