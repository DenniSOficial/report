@extends('admin.layouts.app')

@section('css')
    <style>
        .moveall,
        .removeall {
            border: 1px solid #ccc !important;

            &:hover {
                background: #efefef;
            }
        }

        // Only included because button labels aren't showing

        .moveall::after {
            content: attr(title);

        }

        .removeall::after {
            content: attr(title);
        }

        // Custom styling form
        .form-control option {
            padding: 10px;
            border-bottom: 1px solid #efefef;
        }
    </style>
@endsection

@section('content')
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Nuevo Informe</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('all.report') }}">Informes</a></li>
                        <li class="breadcrumb-item active">Nuevo Informe</li>
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
                        @include('admin.reports.form', ['url' => 'store/report', 'method' => 'POST'])
                    </div>
                </div>
            </div>

        </div>
        <!-- end container-fluid -->
    </div>
@endsection

@section('js')
    <script
        src="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/jquery.bootstrap-duallistbox.js">
    </script>
    <link rel="stylesheet" type="text/css"
        href="https://www.virtuosoft.eu/code/bootstrap-duallistbox/bootstrap-duallistbox/v3.0.2/bootstrap-duallistbox.css">

    <script type="text/javascript">
        $(document).ready(function() {
            $('#formReport').validate({
                rules: {
                    code: {
                        required: true,
                    },
                    client_id: {
                        required: true,
                    },
                    client_name: {
                        required: true,
                    },
                    report_manager_id: {
                        required: true,
                    },
                    type_report_id: {
                        required: true,
                    },
                    expedition: {
                        required: true,
                    },
                    to_name: {
                        required: true,
                    },
                },
                messages: {
                    code: {
                        required: 'Please Enter code',
                    },
                    client_id: {
                        required: 'Please Enter client id',
                    },
                    client_name: {
                        required: 'Please Enter client',
                    },
                    report_manager_id: {
                        required: 'Please Select report manager id',
                    },
                    type_report_id: {
                        required: 'Please Select typer report',
                    },
                    expedition: {
                        required: 'Please Enter expedition',
                    },
                    to_name: {
                        required: 'Please Select to name',
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
        $("#findQuote").click(function() {

            var nro = $('#quote_number').val();
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

        $("#findClient").click(function() {

            var nro = $('#client_document').val();
            console.log('nro:::', nro);

            if (nro === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Sistemas Análiticos Generales',
                    text: 'Debe de ingresar el N° de documento del cliente.',
                });
                return;
            }

            var url_ = $('.urlBuscarCliente').data('url');
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
                        $('#client_id').val(cliente.nIdCliente);
                        //$('#client_document').val(cliente.cDoc);
                        $('#client_name').val(cliente.cNombreClie);
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

    <script>
        var demo1 = $('select[name="commitments[]"]').bootstrapDualListbox({
            nonSelectedListLabel: 'Compromisos registrados',
            selectedListLabel: 'Compromisos seleccionados',
            preserveSelectionOnMove: 'moved',
            moveAllLabel: 'Move all',
            removeAllLabel: 'Remove all'
        });
        $("#demoform").submit(function() {
            alert($('[name="commitments[]"]').val());
            return false;
        });
    </script>
@endsection
