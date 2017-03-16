@extends('template')

@section('page_title', 'Show')
@section('content')
    <h1>Notes {!! $note -> id !!}</h1>
        <h3>{!! $note -> title !!}</h3>
        <p>{!! $note -> content !!}</p>

    {!! Form::open(['url' => 'note/'.$note -> id, 'method' => 'Delete']) !!}
    {!! Form::submit('Delete') !!}
    {!! Form::close() !!}
@stop