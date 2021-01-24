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

<div style="width: 420px" class="flex w-full bg-grey-lighter">
    <label class="w-64 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-white">
        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
        </svg>
        <span class="mt-2 text-base leading-normal">Selecione uma imagem</span>
        <input type='file' name="image" id="image" class="hidden" />
    </label>
</div><br>
<input type="text" name="title" id="title" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="Título" value={{ $post->title ?? old('title') }}><br>
<textarea name="content" id="content" cols="30" rows="10" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="Conteúdo">{{ $post->content ?? old('content') }}</textarea><br>
<button type="submit" class="mr-5 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg">Enviar</button>