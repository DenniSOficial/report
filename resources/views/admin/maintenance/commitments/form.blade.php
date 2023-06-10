{{ Form::open(['url' => $url, 'method' => $method, 'id' => 'formCommitment']) }}
    @csrf
    <div class="card-body">

        <h4 class="header-title">Registrar compromiso</h4>

        <div class="form-group row">

            <input type="hidden" name="id" value="{{ isset($commitment->id) ? $commitment->id : old('id') }}">

            <label for="example-text-input" class="col-md-2 col-form-label">Código</label>
            <div class="form-group col-md-2">
                {{ Form::text('code', isset($commitment->code) ? $commitment->code : old('code'), ['class' => 'form-control']) }}
            </div>

            <label for="example-search-input" class="col-md-2 col-form-label">Norma</label>
            <div class="form-group col-md-6">
                {{ Form::select('norm_id', $norms, (isset($commitment->norm_id) ? $commitment->norm_id : old('norm_id')), [ 'class' => 'custom-select', 'placeholder' => 'Seleccione']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-md-2 col-form-label">Fase</label>
            <div class="form-group col-md-4">
                {{ Form::select('phase_id', $phases, (isset($commitment->phase_id) ? $commitment->phase_id : old('phase_id')), [ 'class' => 'custom-select', 'placeholder' => 'Seleccione']) }}
            </div>

            <label for="example-search-input" class="col-md-2 col-form-label">Frecuencia</label>
            <div class="form-group col-md-4">
                {{ Form::select('frequency_id', $frequencies, (isset($commitment->frequency_id) ? $commitment->frequency_id : old('frequency_id')), [ 'class' => 'custom-select', 'placeholder' => 'Seleccione']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-email-input" class="col-md-2 col-form-label">Resumen</label>
            <div class="form-group col-md-10">
                {{ Form::text('summary', isset($commitment->summary) ? $commitment->summary : '', ['class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-password-input" class="col-md-2 col-form-label">Descripcion compromiso ambiental</label>
            <div class="form-group col-md-10">
                {{ Form::textarea('description', isset($commitment->description) ? $commitment->description : '', ['class' => 'form-control', 'cols' => 10, 'rows' => 5]) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-url-input" class="col-md-2 col-form-label">Coordenadas UTM</label>
            <div class="form-group col-md-4">
                {{ Form::text('coordinate_utm', isset($commitment->coordinate_utm) ? $commitment->coordinate_utm : '', ['class' => 'form-control']) }}
            </div>

            <label for="example-url-input" class="col-md-2 col-form-label">Coordenadas NUTM</label>
            <div class="form-group col-md-4">
                {{ Form::text('coordinate_ntum', isset($commitment->coordinate_ntum) ? $commitment->coordinate_ntum : '', ['class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-tel-input" class="col-md-2 col-form-label">Impacto relacionado</label>
            <div class="col-md-10">
                {{ Form::text('related_impact', isset($commitment->related_impact) ? $commitment->related_impact : '', ['class' => 'form-control']) }}
            </div>
        </div>

    </div>

    <div class="card-footer">
        <div class="">
            <button class="btn btn-primary waves-effect waves-light" type="submit">Guardar</button>
            <a href="{{ route('all.commitment') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
{{ Form::close() }}