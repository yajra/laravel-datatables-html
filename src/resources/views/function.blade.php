window.dtx = window.dtx || {};
window.dtx["%1$s"] = function() {
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
    return $("#%1$s").DataTable(%2$s);
}
