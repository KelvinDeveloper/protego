@extends('index')
@section('content')
@section('title', $Model->title . ' | ')
    {!! view('grid.top', compact('Model'))->render() !!}
    <div class="main-content">
        <div class="col-sm-12">
            <div class="widget widget-fullwidth widget-small">
                <div class="widget-head">{!! view('grid.buttons', compact('Model'))->render() !!}</div>
                <table class="table table-striped table-fw-widget table-hover">
                    {!! view('grid.header', compact('Model'))->render() !!}
                    {!! view('grid.body', compact('Model', 'Table', 'Values'))->render() !!}
                    {!! view('grid.footer')->render() !!}
                </table>
                {!! view('grid.pagination')->render() !!}
            </div>
        </div>
    </div>
    {!! view('grid.javascript', compact('Model'))->render() !!}
@endsection