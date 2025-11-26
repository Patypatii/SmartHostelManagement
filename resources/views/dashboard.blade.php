@extends('layouts.webflow')

@section('title', 'Dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Welcome, {{ Auth::user()->name }}!</h1>
            <p>You are logged in!</p>
            <p>Role: {{ Auth::user()->role }}</p>
        </div>
    </div>
@endsection
