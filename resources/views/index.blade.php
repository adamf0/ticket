@extends('template') 

@section('content')
    @if ($parentview=='dashbboard' && $subview=='')
       @include('dashboard.index')

    @elseif ($parentview=='my-ticket' && $subview=='')
        @include('my-ticket.index')

    @elseif ($parentview=='form-ticket' && $subview=='')
        @include('form-ticket.index')

    @elseif ($parentview=='detail' && $subview=='')
        @include('detail.index')

    @endif
@endsection