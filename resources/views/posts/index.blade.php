@extends('layouts.app')

@section('app')

<h1>posts.index</h1>
    <ul>
        @foreach ($posts as $post)
            <li>
                {{ link_to_route('posts.show', $post->title, [$post->id]) }}
                {{ link_to_route('posts.edit', '[Edit]', [$post->id]) }}
                {{ Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete', 'name' => 'delete_' . $post->id, 'style' => 'display:inline;']) }}
                    <a href="javascript:document.{{ 'delete_' . $post->id }}.submit()" onclick="return confirm('削除しますか？');">[Delete]</a>
                {{ Form::close() }}
            </li>
        @endforeach
        @if (Session::has('flash_message'))
        {{ Session::get('flash_message') }}
        @endif 
        <li>
            {{ link_to_route('posts.create', '[new post]') }}
        </li>
        <!-- <form action="{{ route('posts.index') }}" method="GET">
                <input type="text" name="keywords" size="50">
                <input type="submit" value="検索">
            </form> -->

        {{ $posts->links() }} 
        {{ Form::open(['route' => 'posts.index', 'method' => 'get']) }}
      <div>
      ワード検索{{Form::text('keywords')}}
      </div>
      <div>
      作成日範囲検索{{ Form::text('from_date') }} - {{ Form::text('to_date') }}
      </div>
      {{ Form::submit('検索') }}
    {{ Form::close() }}

    </ul>

@endsection
