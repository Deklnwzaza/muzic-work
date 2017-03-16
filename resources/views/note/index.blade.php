@extends('template')

@section('page_title', 'Index')
@section('content')
    <h1>All Notes</h1>
    @foreach($notes as $note)
        <h3>{!! $note -> title !!}</h3>
        <a href="{!! url('note/'.$note -> id) !!}">Show more</a>
        <hr>
    @endforeach

    @stop