<div class="btn-group mr-1 mt-1">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">Opciones
        <i class="mdi mdi-chevron-down"></i>
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ route('edit.client', $client->id) }}">Editar</a>
        @isset($client->email)
            @if ($client->hasUSer() !== true)
                <a class="dropdown-item" href="{{ route('enable-user.client', $client->id) }}" id="enable_user">Habiliar Usuario</a>    
            @else
                <a class="dropdown-item" href="{{ route('disable-user.client', $client->id) }}" id="disable_user">Deshabiliar Usuario</a>    
            @endif    
        @endisset
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('delete.client', $client->id) }}" id="delete">Eliminar</a>
    </div>
</div>
