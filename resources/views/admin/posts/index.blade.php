@extends('admin.layouts.app')

@section('title', 'Listagem de Posts')

@section('content')

<a href="{{ route('posts.create') }}">Criar novo posts</a>

<h1>Index de Posts</h1>

@if (session('message'))
    <div>
        {{ session('message') }}
    </div>
@endif

<form action="{{ route('posts.search') }}" method="post">
    @csrf
    <input type="text" name="search" id="search" placeholder="Filtrar: ">
    <button type="submit">Filtrar</button>
</form>

<hr>

<h1>Posts</h1>

@foreach ($posts as $post)
    <p>
        <img src="{{url("storage/{$post->image}")}}" alt="{{$post->title}}" style="width:200px;height:200px;">
        {{ $post->title }} - {{ $post->content }} 
        [
            <a href="{{ route('posts.show', $post->id)}}">Ver</a>
            <a href="{{ route('posts.edit', $post->id)}}">Edit</a>
        ]
    </p>
@endforeach
<hr>

@if (isset($filters))
    {{ $posts->appends($filters)->links() }}    
@else
    {{ $posts->links() }}
@endif


@endsection