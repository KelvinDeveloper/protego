<div class="page-head">
    <h2>{{ $Model->title }}</h2>
    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/{{ strtolower($Model->title) }}">{{ str_plural($Model->title) }}</a></li>
        <li class="active">{{ $Model->title }}</li>
    </ol>
</div>