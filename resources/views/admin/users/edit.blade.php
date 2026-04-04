<x-layouts.admin>
  <div class="flex justify-between items-center mb-4">
    <flux:breadcrumbs>
      <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}">Home</flux:breadcrumbs.item>
      <flux:breadcrumbs.item href="{{ route('admin.users.index') }}">Usuarios</flux:breadcrumbs.item>
      <flux:breadcrumbs.item >Editar</flux:breadcrumbs.item>
    </flux:breadcrumbs>
  </div>

  <div class="bg-white px-6 py-8 rounded-lg shadow-lg">
    <form action="{{ route('admin.users.update', $user) }}" method="post" class="space-y-4">

      @csrf
      @method('PUT')

      <flux:input label="Nombre" name="name" value="{{ old('name', $user->name) }}" />
      <flux:input type="email" label="Correo" name="email" value="{{ old('email', $user->email) }}" />
      <flux:input type="password" label="Contraseña" name="password" />
      <flux:input type="password" label="Confirmar contraseña" name="password_confirmation" />

      <div class="">
        <p class="text-sm font-medium mb-1">Roles</p>
        <ul>
          @foreach ($roles as $role)
            <li>
              <label class="flex items-center gap-2">
                <input type="checkbox" name="roles[]" value="{{ $role->id }}" @checked(in_array($role->id, old('roles', $user->roles->pluck('id')->toArray()))) class="form-checkbox">
                <span class="text-sm">{{ $role->name }}</span>
              </label>
            </li>
          @endforeach
        </ul>
      </div>

      <div class=" flex justify-end py-3">
        <flux:button type="submit" variant="primary">Editar</flux:button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-gray text-xs">Cancelar</a>
      </div>

    </form>
  </div>
  
</x-layouts.admin>