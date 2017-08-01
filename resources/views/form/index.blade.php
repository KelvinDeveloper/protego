@extends('index')
@section('content')
@section('title', $Model->title . ' | ')
    {!! view('form.top', compact('Model'))->render() !!}
    <div class="main-content">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="widget-head">{!! view('form.buttons', compact('Model'))->render() !!}</div>
                    <form action="/{{ str_singular($Model->getTable()) }}/{{ $Value->id ?: 'new' }}/save" class="form-horizontal group-border-dashed" id="form-{{ str_singular($Model->getTable()) }}" method="POST">
                        {{ csrf_field() }}
                        {!! $Form !!}
                    </form>
                </div>
            </div>
        </div>
    </div>
    {!! view('form.javascript', compact('Model', 'Value'))->render() !!}
@endsection