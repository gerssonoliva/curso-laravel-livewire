<x-layouts.admin>
  <div class="flex justify-between items-center mb-4">
    <flux:breadcrumbs>
      <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Home</flux:breadcrumbs.item>
      <flux:breadcrumbs.item href="{{ route('admin.posts.index') }}">Posts</flux:breadcrumbs.item>
      <flux:breadcrumbs.item >Nuevo</flux:breadcrumbs.item>
    </flux:breadcrumbs>
  </div>

  <div class="bg-white px-6 py-8 rounded-lg shadow-lg">
    <form action="{{ route('admin.posts.store') }}" method="post" class="space-y-4">

      @csrf
      
      <flux:input label="Título" name="title" oninput="string_to_slug(this.value, '#slug')" value="{{ old('title') }}" />

      <flux:input label="Slug" name="slug" id="slug" value="{{ old('slug') }}" />

      <flux:select label="Categoría" name="category_id" placeholder="Selecciona Categoría...">
        @foreach ($categories as $category)
          <flux:select.option value="{{ $category->id }}">{{ $category->name }}</flux:select.option>
        @endforeach
      </flux:select>

      <div class=" flex justify-end py-3">
        {{-- <flux:button type="submit" variant="blue">Crear</flux:button> --}}
        <flux:button type="submit" variant="primary">Guardar</flux:button>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-gray text-xs">Cancelar</a>
      </div>

    </form>
  </div>

  @push('post-scripts')
    <script>
      
    </script>
  @endpush
  
</x-layouts.admin>