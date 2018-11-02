(function(window,$){
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}});
    window.LaravelDataTables = window.LaravelDataTables || {};
    @foreach($editors as $editor)
        var {{$editor->instance}} = window.LaravelDataTables["%1$s-{{$editor->instance}}"] = new $.fn.dataTable.Editor({
        @if(is_array($editor->ajax))
            ajax: @json($editor->ajax),
        @else
            ajax: '{{$editor->ajax}}',
        @endif
        table: '#{{$editor->table}}',
        fields: @json($editor->fields),
        @if($editor->language)
            i18n: @json($editor->language)
        @endif
        });
    @endforeach
    window.LaravelDataTables["%1$s"] = $("#%1$s").DataTable(%2$s);
})(window,jQuery);
