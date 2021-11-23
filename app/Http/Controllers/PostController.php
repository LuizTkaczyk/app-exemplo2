<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use Illuminate\Http\Request;
use App\Models\Post;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Str;


class PostController extends Controller
{

   //função para exibir os dados na index
   public function index()
   {
      //recuperando os posts do banco de dados, com paginate o blade faza a paginação
      $posts = Post::paginate(15);

      //dd($posts); //função para debugar 

      //retorna a pagina html 'index.blade.php'
      return view('admin.posts.index', compact('posts')); //passando para a index os resultados de 'posts' atraves da função compact.
   }


   //função para criar um post
   public function create()
   {
      //echo "console.log('chamou')";
      return view('admin.posts.create');
   }



   //função para criar um post no banco de dados, e validando com o StoreUpdatePost
   public function store(StoreUpdatePost $request)
   {
      $data = $request->all();

      //criando envio de imagens
      if($request->image->isValid()){
                                                                  //capturando a extensão da imagem
         $nameFile = Str::of($request->title)->slug('-') . '.' .$request->image->getClientOriginalExtension();
         $image = $request->image->storeAs('posts',  $nameFile);//criando a pasta posts em storage/app/public
         $data['image'] = $image;
      }

      //pegando o valor de 'title' do front end com o request
      //$request->title;
      //dd('cadastrando um novo post');

      //com request all(), todos os dados preenchidos são inseridos na tabela do bando de dados
      Post::create($data);

      return redirect()->route('posts.index')->with('message', 'Post criado com sucesso');

   }


   public function show($id)
   {

      //retornando os dados por id, com o if verifica se o post existe ou não
      if (!$post = Post::find($id)) {
         return redirect()->route('posts.index');
      }

      //$post = Post::find($id);

      //retorna o resultado para a pagina show
      return view('admin.posts.show', compact('post'));
   //dd($id);
   }

   //excluido um post, e voltando para a index
   public function destroy($id)
   {
      //dd('deletando o post {{$id}}');

      if (!$post = Post::find($id))
         return redirect()->route('posts.index'); //em caso de não encontrar o post ele retorna a index

      $post->delete();

      return redirect()->route('posts.index')->with('message', 'Post deletado com sucesso'); //em caso de sucesso ao deletar ele tambem volta a index

   }

   public function edit($id)
   {

      //retornando os dados por id, com o if verifica se o post existe ou não
      if (!$post = Post::find($id)) {
         return redirect()->back();
      }

      //$post = Post::find($id);

      //retorna o resultado para a pagina edit
      return view('admin.posts.edit', compact('post'));
   //dd($id);
   }

   public function update(StoreUpdatePost $request, $id)
   {

      //retornando os dados por id, com o if verifica se o post existe ou não
      if (!$post = Post::find($id)) {
         return redirect()->back();
      }
      //dd("editando o post: {{$post->id}}");

      $post->update($request->all());
      return redirect()->route('posts.index')->with('message', 'Post editado com sucesso');
   }

   //função para fazer a busca dos posts
   public function search(Request $request)
   {

      //captando todos os resultados
      $filters = $request->except('_token');
      //dd("pesquisando por {$request->search}");

      $posts = Post::where('title', '=', $request->search)->orWhere('content', 'LIKE', "%{$request->search}%")->paginate(15);
      return view('admin.posts.index', compact('posts'));

   }


}