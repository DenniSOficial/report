{{ Form::open(['url' => $url, 'method' => $method, 'id' => 'formClient']) }}
<div class="card-body">

    <h4 class="header-title">Registrar Cliente</h4>

    <div class="form-group row">
        <input type="hidden" name="id" value="{{ isset($client->id) ? $client->id : null }}">
        <input type="hidden" name="identifier" value="{{ isset($client->identifier) ? $client->identifier : null }}">

        <label for="document" class="col-md-2 col-form-label">Documento</label>
        <div class="form-group col-md-4">
            {{ Form::text('document', isset($client->document) ? $client->document : old('document'), ['class' => 'form-control',  isset($client) ? 'readonly' : ''  ]) }}
        </div>
        @if(!isset($client))
            <div class="col-md-1">
                <a id="findClient" class="btn btn-outline-secondary"><i class="fas fa-search"></i></a>
            </div>    
        @endif
    </div>

    <div class="form-group row">
        <label for="name" class="col-md-2 col-form-label">Razon Social</label>
        <div class="form-group col-md-10">
            {{ Form::text('name', isset($client->name) ? $client->name : '', ['class' => 'form-control', 'readonly']) }}
        </div>
    </div>

    <div class="form-group row">
        <label for="contact" class="col-md-2 col-form-label">Contacto</label>
        <div class="form-group col-md-10">
            {{ Form::text('contact', isset($client->contact) ? $client->contact : '', ['class' => 'form-control', 'style' => 'text-transform: uppercase;']) }}
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-2 col-form-label">Email</label>
        <div class="form-group col-md-10">
            {{ Form::text('email', isset($client->email) ? $client->email : '', ['class' => 'form-control', 'style' => 'text-transform: uppercase;']) }}
        </div>
    </div>

</div>
<div class="card-footer">
    <div class="">
        <button class="btn btn-primary waves-effect waves-light" type="submit">Guardar</button>
        <a href="{{ route('all.client') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</div>
{{ Form::close() }}
