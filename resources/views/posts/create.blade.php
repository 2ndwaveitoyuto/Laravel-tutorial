@extends('layouts.app')

@section('app')

<h1>posts.create</h1>

{{ Form::open(['route' => ['posts.store']]) }}
    @include('posts._form')

    {{ Form::submit('create') }}
{{ Form::close() }}

@endsection
