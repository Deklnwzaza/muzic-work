@extends('template')

@section('page_title', 'Edit')
@section('content')
    {!! Form::model($note, ['url' => 'note/'.$note->id, 'method' => 'PATCH']) !!}
    @include('note._form')
    {!! Form::close() !!}
@stop