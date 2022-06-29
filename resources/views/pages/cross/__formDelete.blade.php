<table class="table table-striped table-bordered datatable">
    <tbody>
        @include('partials.input', ['input' => 'text', 'field' => "main_article", 'label' => trans('fields.main_article')])
        @include('partials.input', ['input' => 'text', 'field' => "repl_article", 'label' => trans('fields.substitute_article')])
    </tbody>
</table>
