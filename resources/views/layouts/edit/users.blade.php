<x-app-layout>
  <x-slot name="slot">

    <div class="d-inline">
      <a class="btn btn-link" href="{{ route( 'admins.users.index') }}">
        <i class="far fa-arrow-alt-circle-left"></i>
        Voltar
      </a>
      @if (isset($item))
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-3">
          {{ __('Editando Usuário') }}
        </h2>
      @else
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-3">
          {{ __('Novo Usuário') }}
        </h2>
      @endif
    </div>

    <x-form-card>

      <!-- Messages -->
      <x-messages-panel />

      @if (isset($item))
      <form action="{{ route( 'admins.users.update', $item->id) }}" method="POST"
            onsubmit="btnSubmit.disabled = true; return true;" >
        @method('PUT')
      @else
      <form action="{{ route( 'admins.users.store') }}" method="POST"
            onsubmit="btnSubmit.disabled = true; return true;" >
      @endif

      @csrf

        <!-- Name -->
        <div>
          <x-input-label for="name" :value="__('Nome')" />

          <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="isset($item) ? $item->name : ''" required autofocus />
        </div>
        <br>

        <!-- E-mail -->
        <div>
          <x-input-label for="email" :value="__('E-mail')" />

          <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="isset($item) ? $item->email : ''" required />
        </div>

        <!-- Password -->
        <div class="mt-4">
          <x-input-label for="password" :value="__('Senha')" />

          <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
          <x-input-label for="password_confirmation" :value="__('Confirmação de Senha')" />

          <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" />
        </div>

        <!-- É administrador? -->
        <div class="mt-4">
          <x-input-label for="is_admin" :value="__('É administrador?')" />

          <x-checkbox field="is_admin" :item="isset($item) ? $item : null" onclick="ChangePermissionsVisibility()" />
        </div>

        <!-- Variáveis -->
        <div class="mt-4" id="divPermissions">
          <x-input-label for="id_permission" :value="__('Permissões')" />

          <select id="id_permission" class="form-control multiple-searchable-select" multiple="multiple" style="width: 100%" name="id_permission[]">
            @foreach($listPermission as $permission)
              @if(isset($item) && in_array($permission->id_permission, $item->Permissions->pluck('id_permission')->toArray()))
                <option value="{{ $permission->id_permission }}" selected>{{ $permission->name }}</option>
              @else
                <option value="{{ $permission->id_permission }}">{{ $permission->name }}</option>
              @endif
            @endforeach
          </select>
        </div>

        <div class="flex items-center justify-end mt-4">
          <x-button class="ml-4" id="btnSave">
              {{ __('Salvar') }}
          </x-button>
        </div>
      </form>
    </x-auth-card>
  </x-slot>
</x-app-layout>

<script>
//--------------------------------------------------------------------------------

function ChangePermissionsVisibility()
{
  var checkbox       = document.getElementById('is_admin');
  var divPermissions = document.getElementById('divPermissions');

  if(checkbox.checked)
    divPermissions.style.display = "none";
  else
    divPermissions.style.display = "block";
}

//--------------------------------------------------------------------------------

$(document).ready(function()
{
  ChangePermissionsVisibility();
});

//--------------------------------------------------------------------------------
</script>