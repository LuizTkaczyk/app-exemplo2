@extends('admin.layouts.app')

@section('title', 'Listagem dos posts')

@section('content')
    <h1>Posts</h1>


    {{-- campo de busca de posts --}}
    <form action="{{ route('posts.search') }}" method="post">
        @csrf
        <input type="text" name="search" placeholder="Filtrar:">
        <button type="submit">Filtrar</button>
    </form>

    {{-- mensagem exibida se o post for deletado com sucesso --}}
    @if (session('message'))
        <div>
            {{ session('message') }}
        </div>

    @endif

    {{-- Captura o conteudo da variavel posts e insere na variavel post --}}
    @foreach ($posts as $post)
        <p><img width="320px" src="{{ url("storage/{$post->image}") }}" alt="{{ $post->title }}">
            {{ $post->title }}
            <br>
            <button> <a href="{{ route('posts.show', $post->id) }}" style="text-decoration: none">Ver detalhes</a>
            </button>
            <button> <a href="{{ route('posts.edit', $post->id) }}" style="text-decoration: none">Editar</a> </button>
        </p>
    @endforeach



    {{-- route('posts.create') vindo das rotas em web --}}
    <a href="{{ route('posts.create') }}">Clique aqui para criar um novo post!</a>

    <hr>
    {{-- paginando o site --}}


    {{-- isset: verifica se existe a variavel --}}
    @if (isset($filters))
        {{ $posts->appends($filters)->links() }}
    @else
        {{ $posts->links() }}
    @endif

@endsection
