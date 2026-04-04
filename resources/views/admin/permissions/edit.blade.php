<x-layouts.admin>
  <div class="flex justify-between items-center mb-4">
    <flux:breadcrumbs>
      <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Home</flux:breadcrumbs.item>
      <flux:breadcrumbs.item href="{{ route('admin.permissions.index') }}">Permisos</flux:breadcrumbs.item>
      <flux:breadcrumbs.item >Editar</flux:breadcrumbs.item>
    </flux:breadcrumbs>
  </div>

  <div class="bg-white px-6 py-8 rounded-lg shadow-lg">
    <form action="{{ route('admin.permissions.update', $permission) }}" method="post" class="space-y-4">

      @csrf
      @method('PUT')

      <flux:input label="Nombre" name="name" value="{{ old('name', $permission->name) }}" />

      <div class=" flex justify-end py-3">
        <flux:button type="submit" variant="primary">Editar</flux:button>
        <a href="{{ route('admin.permissions.index') }}" class="btn btn-gray text-xs">Cancelar</a>
      </div>

    </form>
  </div>
  
</x-layouts.admin>