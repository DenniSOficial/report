{{ Form::open(['url' => $url, 'method' => $method, 'id' => 'formReportManager']) }}
<div class="card-body">

    <h4 class="header-title">Registrar Encargado</h4>

    <div class="form-group row">

        <input type="hidden" name="id" value="{{ isset($report_manager->id) ? $report_manager->id : null }}">

        <label for="type_document" class="col-md-2 col-form-label">Tipo Documento</label>
        <div class="form-group col-md-4">
            <select name="type_document" id="type_document" class="custom-select" placeholder="Seleccione">
                <option value="">Seleccione</option>
                @foreach ($types as $type)
                    <option value="{{ $type }}" {{ isset($report_manager) ? ($report_manager->type_document == $type) ? 'selected' : '' : '' }} >{{ $type }}</option>
                @endforeach
            </select>
        </div>

        <label for="document" class="col-md-2 col-form-label">Documento</label>
        <div class="form-group col-md-4">
            {{ Form::text('document', isset($report_manager->document) ? $report_manager->document : old('document'), ['class' => 'form-control']) }}
        </div>
    </div>

    <div class="form-group row">
        <label for="lastname" class="col-md-2 col-form-label">Apellido Paterno</label>
        <div class="form-group col-md-4">
            {{ Form::text('lastname', isset($report_manager->lastname) ? $report_manager->lastname : '', ['class' => 'form-control', 'style' => 'text-transform: uppercase;']) }}
        </div>

        <label for="lastname2" class="col-md-2 col-form-label">Apellido Materno</label>
        <div class="form-group col-md-4">
            {{ Form::text('lastname2', isset($report_manager->lastname2) ? $report_manager->lastname2 : '', ['class' => 'form-control', 'style' => 'text-transform: uppercase;']) }}
        </div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-md-2 col-form-label">Nombre completo</label>
        <div class="form-group col-md-10">
            {{ Form::text('name', isset($report_manager->name) ? $report_manager->name : '', ['class' => 'form-control', 'style' => 'text-transform: uppercase;']) }}
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-2 col-form-label">Email</label>
        <div class="form-group col-md-4">
            {{ Form::text('email', isset($report_manager->email) ? $report_manager->email : '', ['class' => 'form-control']) }}
        </div>

        <label for="telephone" class="col-md-2 col-form-label">Telefono</label>
        <div class="form-group col-md-4">
            {{ Form::text('telephone', isset($report_manager->telephone) ? $report_manager->telephone : '', ['class' => 'form-control']) }}
        </div>

    </div>

</div>
<div class="card-footer">
    <div class="">
        <button class="btn btn-primary waves-effect waves-light" type="submit">Guardar</button>
        <a href="{{ route('all.report-manager') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</div>
{{ Form::close() }}
