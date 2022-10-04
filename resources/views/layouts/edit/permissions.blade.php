<x-app-layout>
  <x-slot name="slot">

    <div class="d-inline">
      <a class="btn btn-link" href="{{ route( 'admins.permissions.index') }}">
        <i class="far fa-arrow-alt-circle-left"></i>
        Voltar
      </a>
      @if (isset($item))
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-3">
          {{ __('Editando Permissão') }}
        </h2>
      @else
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-3">
          {{ __('Nova Permissão') }}
        </h2>
      @endif
    </div>

    <x-form-card>

      <!-- Messages -->
      <x-messages-panel />

      @if (isset($item))
      <form action="{{ route( 'admins.permissions.update', $item->id_permission) }}" method="POST"
            onsubmit="btnSubmit.disabled = true; return true;" >
        @method('PUT')
      @else
      <form action="{{ route( 'admins.permissions.store') }}" method="POST"
            onsubmit="btnSubmit.disabled = true; return true;" >
      @endif

      @csrf

        <!-- Nome -->
        <div>
          <x-input-label for="name" :value="__('Nome')" />

          <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="isset($item) ? $item->name : ''" required autofocus />
        </div>
        <br>

        <!-- Rota -->
        <div>
          <x-input-label for="route" :value="__('Rota')" />

          <x-text-input id="route" class="block mt-1 w-full" type="text" name="route" :value="isset($item) ? $item->route : ''" required />
        </div>
        <br>

        <div class="flex items-center justify-end mt-4">
          <x-button class="ml-4" id="btnSave">
              {{ __('Salvar') }}
          </x-button>
        </div>
      </form>
    </x-auth-card>
  </x-slot>
</x-app-layout>