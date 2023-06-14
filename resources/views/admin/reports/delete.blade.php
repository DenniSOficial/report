<div class="btn-group mr-1 mt-1">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">Opciones
        <i class="mdi mdi-chevron-down"></i>
    </button>
    <div class="dropdown-menu">
        @if (Auth::user()->role !== 'user')
            <a class="dropdown-item" href="{{ route('edit.report', $report->id) }}">Editar</a>
        @endif
        <a class="dropdown-item" href="{{ route('commitments.report', $report->id) }}">Ver</a>
        @if (Auth::user()->role !== 'user')
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('delete.report', $report->id) }}" id="delete">Eliminar</a>
        @endif

    </div>
</div>
