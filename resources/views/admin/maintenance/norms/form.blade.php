{{ Form::open(['url' => $url, 'method' => $method, 'id' => 'formNorm']) }}
    <div class="card-body">

        <h4 class="header-title">Registrar norma / IGA</h4>

        <div class="form-group row">

            <input type="hidden" name="id" value="{{ isset($norm->id) ? $norm->id : null }}">
            
            <label for="example-text-input" class="col-md-2 col-form-label">Código</label>
            <div class="form-group col-md-4">
                {{ Form::text('code', isset($norm->code) ? $norm->code : old('code'), ['class' => 'form-control']) }}
            </div>

            <label for="example-search-input" class="col-md-2 col-form-label">Autoridad</label>
            <div class="form-group col-md-4">
                {{ Form::select('authority_id', $authorities, (isset($norm->authority_id) ? $norm->authority_id : old('authority_id')), [ 'class' => 'custom-select', 'placeholder' => 'Seleccione']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-email-input" class="col-md-2 col-form-label">Norma aplicable</label>
            <div class="form-group col-md-10">
                {{ Form::text('applicable_standard', isset($norm->applicable_standard) ? $norm->applicable_standard : '', ['class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-url-input" class="col-md-2 col-form-label">Nombre completo</label>
            <div class="form-group col-md-10">
                {{ Form::text('large_name', isset($norm->large_name) ? $norm->large_name : '', ['class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-tel-input" class="col-md-2 col-form-label">Nombre corto</label>
            <div class="form-group col-md-10">
                {{ Form::text('short_name', isset($norm->short_name) ? $norm->short_name : '', ['class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-password-input" class="col-md-2 col-form-label">Lugar de aplicación</label>
            <div class="form-group col-md-10">
                {{ Form::textarea('place_application', isset($norm->place_application) ? $norm->place_application : '', ['class' => 'form-control', 'cols' => 10, 'rows' => 5]) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-number-input" class="col-md-2 col-form-label">Fecha de expedición</label>
            <div class="form-group col-md-4">
                {{ Form::date('expedition', isset($norm->expedition) ? $norm->expedition : '', [ 'class' => 'form-control']) }}
            </div>

            <label for="example-datetime-local-input" class="col-md-2 col-form-label">Fecha de notificación</label>
            <div class="col-md-4">
                {{ Form::date('notification', isset($norm->notification) ? $norm->notification : '', [ 'class' => 'form-control']) }}
            </div>
        </div>
        <div class="form-group row">
            <label for="example-tel-input" class="col-md-2 col-form-label">Url</label>
            <div class="col-md-10">
                {{ Form::text('url', isset($norm->url) ? $norm->url : '', ['class' => 'form-control']) }}
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="">
            <button class="btn btn-primary waves-effect waves-light" type="submit">Guardar</button>
            <a href="{{ route('all.norm') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
{{ Form::close() }}