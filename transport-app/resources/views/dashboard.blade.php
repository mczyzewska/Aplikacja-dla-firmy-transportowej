@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-6">
        Witaj, {{ auth()->user()->name }}
    </h1>

    @if(auth()->user()->role === 'admin')
        @include('dashboards.admin')
    @elseif(auth()->user()->role === 'employee')
        @include('dashboards.employee')
    @else
        @include('dashboards.client')
    @endif
@endsection
