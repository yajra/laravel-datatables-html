window.dtx = window.dtx || {};
window.dtx["%1$s"] = function(opts) {
    window.LaravelDataTables = window.LaravelDataTables || {};
    @if(isset($editors))
    @foreach($editors as $editor)
        var {{$editor->instance}} = window.LaravelDataTables["%1$s-{{$editor->instance}}"] = new $.fn.dataTable.Editor({!! $editor->toJson() !!});
        {!! $editor->scripts  !!}
        @foreach ((array) $editor->events as $event)
            {{$editor->instance}}.on('{!! $event['event']  !!}', {!! $event['script'] !!});
        @endforeach
    @endforeach
    @endif
    return window.LaravelDataTables["%1$s"] = $("#%1$s").DataTable($.extend(%2$s, opts));
}
