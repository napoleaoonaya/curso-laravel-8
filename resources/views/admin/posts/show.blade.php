@extends('admin.layouts.app')

@section('title', 'Detalhes do Post')

@section('content')

<h1 class="text-center text-3x1 uppercase font-black my-4">Detalhes do Post {{ $post->title }} </h1>
<a class="mr-5 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg" href="{{ route('posts.index') }}">Index</a>
<ul class="text-center text-3x1">
    <li><strong>Id: </strong>{{ $post->id }}</li>
    <li><strong>Title: </strong>{{ $post->title }}</li>
    <li><strong>Content: </strong>{{ $post->content }}</li>
</ul>

<!-- Todo formulário tem que usar o csrf -->
<form action="{{ route('posts.destroy', $post->id)}}" method="post">
    @csrf
    @method('delete')
    <!--<input type="hidden" name="_method" value="DELETE">-->
    <button class="mr-5 bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-6 rounded-lg" type="submit">Deletar o Post: {{ $post->title }}</button>
</form>

@endsection