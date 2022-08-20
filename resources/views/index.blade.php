@extends('template') 

@section('content')
    @if ($parentview=='ticket' && $subview=='')
        @include('ticket.index')
    @elseif ($parentview=='ticket' && $subview=='detail')
        @include('ticket.detail')
    @elseif ($parentview=='ticket' && $subview=='create')
        @include('ticket.create')
    @endif
@endsection