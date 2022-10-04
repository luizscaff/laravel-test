<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Permissões') }}
    </h2>
  </x-slot>
  <x-slot name="slot">
    <x-content-card>

    <!-- Messages -->
    <x-messages-panel />
      <div class="row">
        <div class="col">
          <a href="{{ route( 'admins.permissions.create' ) }}" class="btn btn-primary mb-3" >
            <i class="fas fa-plus"></i>&nbsp;&nbsp;
            Nova Permissão
          </a>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Rota</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            @forelse($list as $permission)
              <tr>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->route }}</td>
                <td>
                <a href="{{ route( 'admins.permissions.edit', $permission->id_permission) }}" class="btn btn-primary reportBtn" id="edit-{{ $permission->id_permission }}">
                  <i class="fas fa-pen-alt" style="font-size:11pt"></i>
                </a>
                <form id="delete-form-{{$permission->id_permission}}" action="{{ route( 'admins.permissions.destroy', $permission->id_permission) }}"
                      method="POST" class="inline">
                  @csrf
                  @method('DELETE')
                  <a href="#" class="btn btn-danger reportBtn" id="delete-{{ $permission->id_permission }}"
                    onclick="if (confirm('Deseja excluir esse registro?')) { event.preventDefault(); this.closest('form').submit();}">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7">Nenhuma permissão cadastrada</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </x-content-card>
  </x-slot>
</x-app-layout>

<script>

</script>