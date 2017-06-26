<div class="page-head">
    <h2>{{ $Model->title }}</h2>
    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/{{ str_plural( strtolower($Model->getTable() ) ) }}">{{ str_plural($Model->title) }}</a></li>
        <li class="active">{{ str_singular($Model->title) }}</li>
    </ol>
</div>