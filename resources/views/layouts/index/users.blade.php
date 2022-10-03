<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Usuários') }}
    </h2>
  </x-slot>
  <x-slot name="slot">
    <x-content-card>

    <!-- Messages -->
    <x-messages-panel />
      <div class="row">
        <div class="col">
          <a href="{{ route( 'admins.users.create' ) }}" class="btn btn-primary mb-3" id="btnCreateProfessional">
            <i class="fas fa-plus"></i>&nbsp;&nbsp;
            Novo Usuário
          </a>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nome</th>
              <th>E-mail</th>
              <th>É admin?</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            @forelse($list as $user)
              <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->is_admin ? "Sim" : "Não" }}</td>
                <td>
                <a href="{{ route( 'admins.users.edit', $user->id) }}" class="btn btn-primary reportBtn" id="edit-{{ $user->id }}">
                  <i class="fas fa-pen-alt" style="font-size:11pt"></i>
                </a>
                <form id="delete-form-{{$user->id}}" action="{{ route( 'admins.users.destroy', $user->id) }}"
                      method="POST" class="inline">
                  @csrf
                  @method('DELETE')
                  <a href="#" class="btn btn-danger reportBtn" id="delete-{{ $user->id }}"
                    onclick="if (confirm('Deseja excluir esse registro?')) { event.preventDefault(); this.closest('form').submit();}">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7">Nenhum usuário cadastrado</td>
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