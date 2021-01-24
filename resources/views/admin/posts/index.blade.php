@extends('admin.layouts.app')

@section('title', 'Listagem de Posts')

@section('content')

<p class="text-right">
    <a class="text-3x1 my-4" href="{{ url('/logout') }}"> Sair do sistema </a>    
</p>

<div class="container">
    
<a class="inline-block px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-green-500 rounded shadow ripple hover:shadow-lg hover:bg-green-600 focus:outline-none" href="{{ route('posts.create') }}">Criar novo posts</a>

<h1 class="text-center text-3x1 uppercase font-black my-4">Index de Posts</h1>

@if (session('message'))
    <div>
        {{ session('message') }}
    </div>
@endif


<form action="{{ route('posts.search') }}" method="post">
    @csrf
    <input type="text" name="search" id="search" class="focus:ring-indigo-300 focus:border-indigo-300 flex-1 block rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="Pesquisar">
    <button class="inline-block px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-blue-700 rounded shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none" type="submit">Pesquisar</button>
</form>


<hr>

<h1 class="text-center text-3x1 uppercase font-black my-4">Posts</h1>

@foreach ($posts as $post)
    <p class="text-left text-3x1 uppercase my-4">
        <img src="{{url("storage/{$post->image}")}}" alt="{{$post->title}}" style="width:200px;height:200px;">
        {{ $post->title }} - {{ $post->content }} 
        <a class="inline-block px-6 py-2 text-xs font-medium leading-6 text-center text-pink-500 uppercase transition bg-transparent border-2 border-pink-500 rounded ripple hover:bg-pink-100 focus:outline-none" href="{{ route('posts.show', $post->id)}}">Ver</a>
        <a class="inline-block px-6 py-2 text-xs font-medium leading-6 text-center text-yellow-500 uppercase transition bg-transparent border-2 border-yellow-500 rounded ripple hover:bg-yellow-100 focus:outline-none" href="{{ route('posts.edit', $post->id)}}">Edit</a>
    </p>
@endforeach
<hr>

@if (isset($filters))
    {{ $posts->appends($filters)->links() }}    
@else
    {{ $posts->links() }}
@endif

</div>
@endsection