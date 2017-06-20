@extends('index')
@section('content')
@section('title', $Model->title . ' | ')
    {!! view('form.top', compact('Model'))->render() !!}
    <div class="main-content">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="widget-head">{!! view('form.buttons', compact('Model'))->render() !!}</div>
                    <form class="form-horizontal group-border-dashed">
                        {!! $Form !!}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection