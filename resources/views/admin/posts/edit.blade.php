<x-layouts.admin>

  @push('css')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  @endpush

  <div class="flex justify-between items-center mb-4">
    <flux:breadcrumbs>
      <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Home</flux:breadcrumbs.item>
      <flux:breadcrumbs.item href="{{ route('admin.posts.index') }}">Posts</flux:breadcrumbs.item>
      <flux:breadcrumbs.item >Editar</flux:breadcrumbs.item>
    </flux:breadcrumbs>
  </div>

  <form action="{{ route('admin.posts.update', $post) }}" method="post">

    @csrf
    @method('PUT')

    <div class="relative mb-2">
      <img class="w-full aspect-video object-cover object-center" id="imgPreview" src="https://img.freepik.com/vector-premium/vector-icono-imagen-predeterminado-pagina-imagen-faltante-diseno-sitio-web-o-aplicacion-movil-no-hay-foto-disponible_87543-11093.jpg" alt="">
      <div class="absolute top-8 right-8">
        <label class="bg-white px-4 rounded-lg py-2 cursor-pointer">
          Cambiar imagen
          <input class="hidden" type="file" name="image" onchange="preview_image(event, '#imgPreview')" accept="image/*">
        </label>
      </div>
    </div>

    <div class="bg-white px-6 py-8 rounded-lg shadow-lg space-y-4">

      <flux:input label="Título" name="title" value="{{ old('title', $post->title) }}" />

      @if (!$post->published_at)
        <flux:input label="Slug" name="slug" value="{{ old('slug', $post->slug) }}" />
      @endif

      <flux:select label="Categoría" name="category_id" placeholder="Selecciona Categoría...">
        @foreach ($categories as $category)
          <flux:select.option value="{{ $category->id }}" :selected="$category->id == old('category_id', $post->category_id)">{{ $category->name }}</flux:select.option>
        @endforeach
      </flux:select>

      <flux:textarea
        label="Resumen"
        name="excerpt"
        placeholder="Ingrese resumen..."
      >{{ old('excerpt', $post->excerpt) }}</flux:textarea>

      <div class="">
        <p class="font-medium text-sm mb-1">
          Etiquetas
        </p>
        <select id="tags" name="tags[]" multiple="multiple" style="width: 100%">
          @foreach ($tags as $tag)
            <option value="{{ $tag->name }}" @selected(in_array($tag->name, old('tags', $post->tags->pluck('name')->toArray())))>{{ $tag->name }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <p class="font-medium text-sm mb-1">
          Cuerpo
        </p>
        <div id="editor">{!! old('content', $post->content) !!}</div>
      </div>

      <flux:textarea
        class="hidden"
        name="content"
        id="content"
      >{{ old('content', $post->content) }}</flux:textarea>

      <div>
        <p class="text-sm font-semibold">Estado</p>
        <label for="">
          <input type="radio" name="is_published" value="0" @checked(old('is_published', $post->is_published) == 0)> No publicado
        </label>
        <label for="">
          <input type="radio" name="is_published" value="1" @checked(old('is_published', $post->is_published) == 1)> Publicado
        </label>
      </div>

      <div class=" flex justify-end py-3">
        <flux:button type="submit" variant="primary">Editar</flux:button>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-gray text-xs">Cancelar</a>
      </div>

    </div>

  </form>
  
  @push('js')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#tags').select2({
          tags: true,
          tokenSeparators: [',']
        });
      });
    </script>
    <script>
      const quill = new Quill('#editor', {
        theme: 'snow'
      });

      quill.on('text-change', function() {
        document.querySelector('#content').value = quill.root.innerHTML;
      });
    </script>
  @endpush
</x-layouts.admin>