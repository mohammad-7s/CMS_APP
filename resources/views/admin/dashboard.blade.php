@extends('layouts.admin')
@section('title','Home page')
@section('page-title', 'Home page')
@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-2">Users Number</h3>
        <p class="text-3xl font-bold text-blue-600">{{ $usersCount }}</p>
    </div>
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-2">Number articles</h3>
        <p class="text-3xl font-bold text-green-600">{{ $articlesCount }}</p>
    </div>
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-2">Number of comments</h3>
        <p class="text-3xl font-bold text-purple-600">{{ $commentsCount }}</p>
    </div>
</div>
@endsection
