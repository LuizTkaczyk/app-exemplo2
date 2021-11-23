<h1>Posts</h1>

{{-- Captura o conteudo da variavel posts e insere na variavel post --}}
@foreach ($posts as $post)
    <p>{{ $post->title }}</p>
@endforeach

{{-- route('posts.crate') vindo das rotas em web --}}
<a href="{{ route('posts.create') }}">Clique aqui para criar um novo post!</a>
