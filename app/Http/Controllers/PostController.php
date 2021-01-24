<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        //return 'PostController index';
        //return view('welcome');

        //$posts = Post::all();

        //para paginar
        $posts = Post::latest()->paginate(5);
        
        //$posts = Post::orderBy('id', 'DESC')->paginate();

        //or $post = Post::get();

        //Eloquent ORM Laravel
        //dd($posts);

        return view('admin.posts.index', compact('posts'));

        //or 
        // return view('admin.posts.index', [
        //    'posts' => $posts
        // ]);
        //
    }

    public function create(){

        return view('admin.posts.create');
         
    }

    public function store(StoreUpdatePost $request)
    {

        $data = $request->all();
        //Pegando a imagem
        //$request->file('image');

        //Validando se o arquivo é valido
        if($request->image->isValid()){

            // Nome do arquivo $nameFile
            // Helpers Str::of('LARAVEL FRAMEWORK')->slug('-')
            // $request->image->getClientOriginalExtension() esse método final pega a extensão do arquivo
            $nameFile = Str::of($request->title)->slug('-').'.'.$request->image->getClientOriginalExtension();

            //Grava no path store() sem customizar nome
            //storeAs() permite customizar o nome do arquivo salvo no banco de dados
            $image = $request->image->storeAs('posts', $nameFile);
            //Na posição image do array $data passa $image
            $data['image'] = $image;

        }


        // or $request = new Request;

        //dd('Cadastrando um novo posts...');

        //dd($request->title);
        //dd($request->content);
        //dd($request->all());

        // Passando a validação dentro do array
        // $storeData = $request->validate([
        //    'title' => 'required|max:255',
        //    'content' => 'required|max:255'
        // ]);
        // Post::create($storeData);

        // or

        // Post::create([
        //    'title' => $request->title,
        //    'content' => $request->content
        // ]);

        // Só usa esse método abaixo se todos os campos name tiverem o mesmo
        // nome no banco de dados

        //Post::create($request->all());

        Post::create($data);

        //return "Dados inseridos com sucesso!";

        //Retorna para o posts index
        
        return redirect()
        ->route('posts.index')
        ->with('message','Post cadastrado com sucesso');
    }

    //Usando o Request de validação StoreUpdatePost
    //public function store(StoreUpdatePost $request){   
    //    Post::create($request->all());
    //    return redirect()->route('posts.index');
    //}

    public function show($id){
        //dd($id);
        
        //Busca todos registros pelo id mais só mostra o primeiro por causa da função first
        //$post = Post::where('id',$id)->first();

        //Busca usando o find pesquisando pelo $id
        //$post = Post::find($id)

        $post = Post::find($id);

        //Se não tiver o $id no post ele volta para o index
        if(!$post){
            return redirect()->route('posts.index');
        }
            
        return view('admin.posts.show',compact('post'));
    
        //dd($post);
        
    }

    public function destroy($id){
        //dd("Deletando o post $id");

        if(!$post = Post::find($id))
            return redirect()->route('posts.index');

        //Validando se existe o arquivo image se exitir deleta
        if(Storage::exists($post->image))
            Storage::delete($post->image);
      
        $post->delete();
        
        return redirect()
            ->route('posts.index')
            ->with('message','Post deletado com sucesso');
            
    }

    public function edit($id){
        
        $post = Post::find($id);
       
        if(!$post){
            return redirect()->back();
        }
            
        return view('admin.posts.edit',compact('post'));
    
        
    }

    public function update(StoreUpdatePost $request, $id)
    {
        
        $post = Post::find($id);
       
        if(!$post){
            return redirect()->back();
        }

        $data = $request->all();

        //Implementando lógica de upload de arquivo para deletar o anterior e subir
        //novo arquivo de imagem para mesmo registro

        //Validando se o arquivo é valido
        if($request->image && $request->image->isValid()){

            //Validando se existe o arquivo image se existir deleta
            if(Storage::exists($post->image)){
                Storage::delete($post->image);
            }

            // Nome do arquivo $nameFile
            // Helpers Str::of('LARAVEL FRAMEWORK')->slug('-')
            // $request->image->getClientOriginalExtension() esse método final pega a extensão do arquivo
            $nameFile = Str::of($request->title)->slug('-').'.'.$request->image->getClientOriginalExtension();

            //Grava no path store() sem customizar nome
            //storeAs() permite customizar o nome do arquivo salvo no banco de dados
            $image = $request->image->storeAs('posts', $nameFile);
            //Na posição image do array $data passa $image
            $data['image'] = $image;

        }
            
        //$post->update($request->all());

        //Método update com a imagem
        $post->update($data);

        return redirect()
        ->route('posts.index')
        ->with('message','Post atualizado com sucesso');
        
    }

    public function search(Request $request)
    {

        //Cria o filtro da paginação memória com todos os campos
        //$filters = $request->all();

        //Cria o filtro da paginação exceto com o _token
        $filters = $request->except('_token');

        //Post::where('title', '=', $request->search)

        $posts = Post::where('title', 'LIKE', "%{$request->search}%")
            ->orWhere('content', 'LIKE', "%{$request->search}%")
            ->paginate(5);

        // ->toSql()
        // dd($posts)    

        return view('admin.posts.index', compact('posts','filters'));
    }
}
