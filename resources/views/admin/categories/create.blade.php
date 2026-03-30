<x-layouts.admin>
  <div class="flex justify-between items-center mb-4">
    <flux:breadcrumbs>
      <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Home</flux:breadcrumbs.item>
      <flux:breadcrumbs.item href="{{ route('admin.categories.index') }}">Categorias</flux:breadcrumbs.item>
      <flux:breadcrumbs.item >Nuevo</flux:breadcrumbs.item>
    </flux:breadcrumbs>
  </div>

  <div class="bg-white px-6 py-8 rounded-lg shadow-lg">
    <form action="{{ route('admin.categories.store') }}" method="post" class="space-y-4">

      @csrf
      
      <flux:input label="Nombre" name="name" value="{{ old('name') }}" />

      <div class=" flex justify-end py-3">
        {{-- <flux:button type="submit" variant="blue">Crear</flux:button> --}}
        <flux:button type="submit" variant="primary">Guardar</flux:button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-gray text-xs">Cancelar</a>
      </div>

    </form>
  </div>
  
</x-layouts.admin>