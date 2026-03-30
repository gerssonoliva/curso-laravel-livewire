<x-layouts.admin>
  <div class="flex justify-between items-center mb-4">
    <flux:breadcrumbs>
      <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Home</flux:breadcrumbs.item>
      <flux:breadcrumbs.item href="{{ route('admin.posts.index') }}">Posts</flux:breadcrumbs.item>
      <flux:breadcrumbs.item >Editar</flux:breadcrumbs.item>
    </flux:breadcrumbs>
  </div>

  <div class="bg-white px-6 py-8 rounded-lg shadow-lg">
    <form action="{{ route('admin.posts.update', $post) }}" method="post" class="space-y-4">

      @csrf
      @method('PUT')

      <flux:input label="Título" name="title" value="{{ old('title', $post->title) }}" />

      <flux:input label="Slug" name="slug" value="{{ old('slug', $post->slug) }}" />

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

      <flux:textarea
        label="Cuerpo"
        name="content"
        rows="10"
        placeholder="Ingrese el cuerpo..."
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

    </form>
  </div>
  
</x-layouts.admin>