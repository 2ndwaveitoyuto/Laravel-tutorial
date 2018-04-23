   @extends('layouts.app')

   @section('app')

   <h1>{{ $post->title }}</h1>
   <p>{{ $post->content }}</p>

   @endsection
