@extends('template')

@section('page_title', 'Create')
@section('content')
    {!! Form::open(['url' => 'note']) !!}
    @include('note._form')
    {!! Form::close() !!}
@stop