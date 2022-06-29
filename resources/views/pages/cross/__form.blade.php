<table class="table table-striped table-bordered datatable">
    <tbody>
        @include('partials.input', ['input' => 'text', 'field' => "main_brand", 'label' => trans('fields.manufacturer')])
        @include('partials.input', ['input' => 'text', 'field' => "main_article", 'label' => trans('fields.main_article')])
        @include('partials.input', ['input' => 'text', 'field' => "repl_brand", 'label' => trans('fields.substitute_manufacturer')])
        @include('partials.input', ['input' => 'text', 'field' => "repl_article", 'label' => trans('fields.substitute_article')])
        @include('partials.input', ['input' => 'text', 'field' => "name", 'label' => trans('fields.name')])
        @include('partials.input', ['input' => 'number', 'field' => "quality", 'label' => trans('fields.cross_quality'), 'min' => 1, 'max' => 5 ])
    </tbody>
</table>
