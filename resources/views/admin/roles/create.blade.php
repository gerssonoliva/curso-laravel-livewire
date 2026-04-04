<x-layouts.admin>
  <div class="flex justify-between items-center mb-4">
    <flux:breadcrumbs>
      <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Home</flux:breadcrumbs.item>
      <flux:breadcrumbs.item href="{{ route('admin.roles.index') }}">Roles</flux:breadcrumbs.item>
      <flux:breadcrumbs.item >Nuevo</flux:breadcrumbs.item>
    </flux:breadcrumbs>
  </div>

  <div class="bg-white px-6 py-8 rounded-lg shadow-lg">
    <form action="{{ route('admin.roles.store') }}" method="post" class="space-y-4">

      @csrf
      
      <flux:input label="Nombre" name="name" value="{{ old('name') }}" />

      <div class="">
        <p class="text-sm font-medium mb-1">Permisos</p>
        <ul>
          @foreach ($permissions as $permission)
            <li>
              <label class="flex items-center gap-2">
                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" @checked(in_array($permission->id, old('permissions', []))) class="form-checkbox">
                <span class="text-sm">{{ $permission->name }}</span>
              </label>
            </li>
          @endforeach
        </ul>
      </div>

      <div class=" flex justify-end py-3">
        <flux:button type="submit" variant="primary">Guardar</flux:button>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-gray text-xs">Cancelar</a>
      </div>

    </form>
  </div>
  
</x-layouts.admin>