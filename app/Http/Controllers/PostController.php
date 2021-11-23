<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

   //função para exibir os dados na index
   public function index(){
      //recuperando os posts do banco de dados
        $posts = Post::get();

        //dd($posts); //função para debugar 

       //retorna a pagina html 'index.blade.php'
       return view ('admin.posts.index',compact('posts')); //passando para a index os resultados de 'posts' atraves da função compact.
   }


   //função para criar um post
   public function create(){
      return view('admin.posts.create');
   }

   //função para criar um post no banco de dados, e validando com o StoreUpdatePost
   public function store(StoreUpdatePost $request){

      //pegando o valor de 'title' do front end com o request
      //$request->title;
      //dd('cadastrando um novo post');

      //com request all(), todos os dados preenchidos são inseridos na tabela do bando de dados
      Post::create($request->all());

      return redirect()->route('posts.index');
      
   }
}