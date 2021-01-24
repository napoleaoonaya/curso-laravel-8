@extends('admin.layouts.app')

@section('title', 'Detalhes do Post')

@section('content')

<h1>Detalhes do Post {{ $post->title }} </h1>
<a href="{{ route('posts.index') }}">Index</a>
<ul>
    <li><strong>Id: </strong>{{ $post->id }}</li>
    <li><strong>Title: </strong>{{ $post->title }}</li>
    <li><strong>Content: </strong>{{ $post->content }}</li>
</ul>

<!-- Todo formulário tem que usar o csrf -->
<form action="{{ route('posts.destroy', $post->id)}}" method="post">
    @csrf
    @method('delete')
    <!--<input type="hidden" name="_method" value="DELETE">-->
    <button type="submit">Deletar o Post: {{ $post->title }}</button>
</form>

@endsection