@extends('admin.layouts.app')

@section('css')
    <!-- DataTables -->
    <link href="{{ asset('plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection

@section('content')

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Sistema de Informes</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('all.report') }}">Informe
                                {{ $report_commitment->report->code }}</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('commitments.report', $report_commitment->report->id) }}">Compromiso:
                                {{ $report_commitment->commitment->summary }}</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
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
                        <div class="card-body">

                            <h4 class="header-title">{{ $title }}</h4>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th data-priority="1">#</th>
                                        <th>DOCUMENTO</th>
                                        <th>ESTADO</th>
                                        <th>FEC. SUBIDA</th>
                                        <th>OPCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($documents)
                                        @foreach ($documents as $key => $document)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <h4 class="header-title">{{ $document->title }}</h4>
                                                    <a href="{{ $document->url }}" target="_blank"
                                                        class="btn btn-link waves-effect">Ver Documento</a>
                                                </td>
                                                <td>
                                                    <center>
                                                        @switch($document->document_status_id)
                                                            @case(1)
                                                                <div class="badge badge-soft-success">
                                                                    {{ $document->document_status->name }}</div>
                                                            @break

                                                            @case(2)
                                                                <div class="badge badge-soft-warning">
                                                                    {{ $document->document_status->name }}</div>
                                                            @break

                                                            @case(3)
                                                                <div class="badge badge-soft-primary">
                                                                    {{ $document->document_status->name }}</div>
                                                            @break

                                                            @default
                                                                <div class="badge badge-soft-primary">
                                                                    {{ $document->document_status->name }}</div>
                                                            @break
                                                        @endswitch
                                                    </center>
                                                </td>
                                                <td>{{ $document->created_at }}</td>
                                                <td>
                                                    <div class="btn-group mr-1 mt-1">
                                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">Opciones
                                                            <i class="mdi mdi-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            @if ($document->document_status_id !== 2)
                                                                <a class="dropdown-item"
                                                                    href="{{ route('add-comment.report', $document->id) }}">Agregar
                                                                    comentario
                                                                </a>
                                                            @endif

                                                            @if ($document->document_status_id !== 1)
                                                                <a class="dropdown-item"
                                                                    href="{{ route('trancking.document', $document->id) }}">Seguimiento</a>
                                                            @endif


                                                            @if ($document->document_status_id === 2)
                                                                <a class="dropdown-item"
                                                                    href="{{ route('close-comment.document', $document->id) }}"
                                                                    id="close_comment">Cerrar comentarios</a>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        {{ Form::open(['route' => ['store.upload.report', $report_commitment->id], 'method' => 'POST', 'id' => 'formUploadDocument', 'files' => true]) }}
                        <div class="card-body">

                            <h4 class="header-title">Subir Documento</h4>

                            <div class="form-group row">

                                <input type="hidden" name="id"
                                    value="{{ isset($report_commitment->id) ? $report_commitment->id : null }}">

                                <label for="title" class="col-md-2 col-form-label">Título / Detalle</label>
                                <div class="form-group col-md-10">
                                    {{ Form::text('title', '', ['class' => 'form-control']) }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="custom-file">
                                    {{ Form::file('document', ['class' => 'custom-file-input', 'id' => 'validationCustomFile']) }}
                                    <label class="custom-file-label" for="validationCustomFile">Seleccione...</label>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="">
                                <button class="btn btn-primary waves-effect waves-light" type="submit">Subir</button>
                                <a href="{{ route('commitments.report', $report_commitment->report_id) }}" class="btn btn-secondary">Regresar</a>
                            </div>
                        </div>
                        {{ Form::close() }}

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('js')
    <!-- Required datatable js -->
    <script src="{{ asset('plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('plugins/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    {{-- <script src="{{ asset('js/pages/datatables.init.js') }}"></script> --}}

    <script>
        $('#datatable').dataTable({
            'ordering': false
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#formUploadDocument').validate({
                rules: {
                    title: {
                        required: true,
                    },
                    document: {
                        required: true,
                    },
                },
                messages: {
                    title: {
                        required: 'Please Enter title',
                    },
                    document: {
                        required: 'Please Select document',
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
