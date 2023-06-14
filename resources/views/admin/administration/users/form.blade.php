{{ Form::open(['url' => $url, 'method' => $method, 'id' => 'formUser', 'autocomplete' => 'off']) }}
<div class="card-body">

    <h4 class="header-title">Registro de Usuario</h4>

    <div class="form-group row">
        <input type="hidden" name="id" value="{{ isset($user->id) ? $user->id : null }}">

        <label for="name" class="col-md-2 col-form-label">Nombre Completo</label>
        <div class="form-group col-md-10">
            {{ Form::text('name', isset($user->name) ? $user->name : '', ['class' => 'form-control', 'style' => 'text-transform: uppercase;']) }}
        </div>
    </div>

    <div class="form-group row">

        <label for="username" class="col-md-2 col-form-label">Usuario</label>
        <div class="form-group col-md-4">
            {{ Form::text('username', isset($user->username) ? $user->username : old('username'), ['class' => 'form-control', 'style' => 'text-transform: uppercase;']) }}
        </div>

        <label for="role" class="col-md-2 col-form-label">Rol</label>
        <div class="form-group col-md-4">
            <select name="role" id="role" class="custom-select" placeholder="Seleccione">
                <option value="">Seleccione</option>
                @foreach ($roles as $role)
                    <option value="{{ $role }}" {{ isset($user) ? ($user->role == $role) ? 'selected' : '' : '' }} >{{ $role }}</option>
                @endforeach
            </select>
        </div>
        
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-2 col-form-label">Email</label>
        <div class="form-group col-md-10">
            {{ Form::text('email', isset($user->email) ? $user->email : '', ['class' => 'form-control', 'style' => 'text-transform: uppercase;']) }}
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-2 col-form-label">Password</label>
        <div class="form-group col-md-4">
            {{ Form::password('password', ['class' => 'form-control']) }}
        </div>

        <label for="repassword" class="col-md-2 col-form-label">Re-password</label>
        <div class="form-group col-md-4">
            {{ Form::password('repassword', ['class' => 'form-control']) }}
        </div>

    </div>

</div>
<div class="card-footer">
    <div class="">
        <button class="btn btn-primary waves-effect waves-light" type="submit">Guardar</button>
        <a href="{{ route('all.user') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</div>
{{ Form::close() }}
