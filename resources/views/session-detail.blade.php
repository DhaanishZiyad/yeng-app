@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold">{{ $session->title }}</h1>
    <p class="text-gray-600">Date: {{ \Carbon\Carbon::parse($session->date)->format('l, jS F') }}</p>
    <p class="text-gray-600">Time: {{ \Carbon\Carbon::parse($session->time)->format('H:i') }}</p>
    <p class="text-gray-600">Instructor: {{ $session->instructor->name ?? 'N/A' }}</p>
    <p class="text-gray-600">Location: {{ $session->location }}</p>
    <p class="text-gray-600">Status: {{ ucfirst($session->status) }}</p>
</div>
@endsection