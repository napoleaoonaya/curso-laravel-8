<!-- $errors é um array de erros, any é a função que pega todos erros se existir -->
@if ($errors->any())
    <ul>
        <!-- Intera na variavel $errors para pegar cada campo de erro, usa se a função all() para 
        pegar todos os campos -->
        @foreach ($errors->all() as $erro)
            <li>{{ $erro }}</li>
        @endforeach
    </ul>
@endif

@csrf
<!-- value= $post->title ?? old('title') a duas interrogações faz um if e else -->
<!-- helper session flash para manter o valor de dados old() -->
<input type="file" name="image" id="image">
<input type="text" name="title" id="title" placeholder="Título" value={{ $post->title ?? old('title') }}>
<textarea name="content" id="content" cols="30" rows="10" placeholder="Conteúdo">{{ $post->content ?? old('content') }}</textarea>
<button type="submit">Enviar</button>