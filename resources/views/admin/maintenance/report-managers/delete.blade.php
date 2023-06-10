<div class="btn-group mr-1 mt-1">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">Opciones
        <i class="mdi mdi-chevron-down"></i>
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ route('edit.report-manager', $report_manager->id) }}">Editar</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('delete.report-manager', $report_manager->id) }}" id="delete">Eliminar</a>
    </div>
</div>
