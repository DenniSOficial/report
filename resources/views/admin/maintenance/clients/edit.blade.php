@extends('admin.layouts.app')

@section('css')
@endsection

@section('content')
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Editar Cliente</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('all.client') }}">Clientes</a></li>
                        <li class="breadcrumb-item active">Editar Cliente</li>
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
                        @include('admin.maintenance.clients.form', [
                            'url' => 'update/client',
                            'method' => 'POST',
                        ])
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
            $('#formClient').validate({
                rules: {
                    document: {
                        required: true,
                    },
                    name: {
                        required: true,
                    },
                    identifier: {
                        required: true,
                    },
                },
                messages: {
                    document: {
                        required: 'Please Enter document',
                    },
                    name: {
                        required: 'Please Enter name',
                    },
                    identifier: {
                        required: 'Please Enter identifier',
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

    <script type="text/javascript">
        $("#findClient").click(function() {

            var nro = $('#document').val();
            console.log('nro:::', nro);

            if (nro === '') {
                //alert('Debe de ingresar el nro de cotizacion');
                Swal.fire({
                    icon: 'error',
                    title: 'Sistemas Análiticos Generales',
                    text: 'Debe de ingresar el N° de cotización.',
                });
                return;
            }

            limpiarControles();

            var url_ = $('.urlBuscarCotizacion').data('url');
            console.log('url_:::', url_);
            var data_ = {
                nro: nro
            };

            $.ajax({
                url: url_,
                type: 'POST',
                headers: {
                    'X-CSRF-Token': $("input[name=_token]").val()
                },
                dataType: 'json',
                data: data_,
                success: function(response) {
                    console.log('response:::', response);
                    if (response.message == 'Ok') {
                        var cliente = response.data['cliente'];
                        var contactos = response.data['contactos'];
                        $('#client_id').val(cliente.nIdCliente);
                        $('#client_document').val(cliente.cDoc);
                        $('#client_name').val(cliente.cNombreClie);
                        $('#client_executive').val(cliente.EjecutivoComercial);
                        $('#client_executive_id').val(cliente.codvend);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Sistemas Análiticos Generales',
                            text: response.message
                        });
                    }
                },
                error: function(err) {
                    console.log('err:::', err);
                }
            });

        });

        function limpiarControles() {
            $('#id_cliente').val('');
            $('#cliente').val('');
            $('#contacto').val('');
            $('#email').val('');
            $('#telefono_cliente').val('');
            $('#lugar').val('');
            $('#empresa').val('');
            $('#planta').val('');
            $('#proyecto').val('');
        }
    </script>
@endsection
