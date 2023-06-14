@extends('admin.layouts.app')

@section('css')
@endsection

@section('content')
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Cambiar Contraseña</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('all.user') }}">Perfil</a></li>
                        <li class="breadcrumb-item active">Cambiar Contraseña</li>
                    </ol>
                </div>

            </div>

        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="page-content-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        {{ Form::open(['url' => '/admin/update/password', 'method' => 'POST', 'id' => 'formChangePassword', 'autocomplete' => 'off']) }}
                        <div class="card-body">

                            <h4 class="header-title">Cambiar de Contraseña</h4>

                            <div class="form-group row">
                                <input type="hidden" name="id" value="{{ isset($user->id) ? $user->id : null }}">

                                <label for="old_password" class="col-md-2 col-form-label">Contraseña antigua</label>
                                <div class="form-group col-md-10">
                                    {{ Form::password('old_password', ['class' => 'form-control', 'style' => 'text-transform: uppercase;']) }}
                                </div>
                            </div>

                            <div class="form-group row">

                                <label for="new_password" class="col-md-2 col-form-label">Contraseña</label>
                                <div class="form-group col-md-10">
                                    {{ Form::password('new_password', ['class' => 'form-control', 'style' => 'text-transform: uppercase;']) }}
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="new_password_confirmation" class="col-md-2 col-form-label">Confirmar Contraseña</label>
                                <div class="form-group col-md-10">
                                    {{ Form::password('new_password_confirmation', ['class' => 'form-control', 'style' => 'text-transform: uppercase;']) }}
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="">
                                <button class="btn btn-primary waves-effect waves-light" type="submit">Guardar</button>
                                
                            </div>
                        </div>
                        {{ Form::close() }}


                    </div>
                </div>
            </div>

        </div>
        <!-- end container-fluid -->
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#formChangePassword').validate({
                rules: {
                    old_password: {
                        required: true,
                    },
                    new_password: {
                        required: true,
                    },
                    new_password_confirmation: {
                        required: true,
                    },
                },
                messages: {
                    old_password: {
                        required: 'Please Enter old password',
                    },
                    new_password: {
                        required: 'Please Enter new password',
                    },
                    new_password_confirmation: {
                        required: 'Please Enter new password confirmation',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
