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
                        <li class="breadcrumb-item"><a href="{{ route('all.report') }}">Informe {{ $report->code }}</a></li>
                        <li class="breadcrumb-item active">Compromisos</li>
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

                            <h4 class="header-title">Listado de Compromisos</h4>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th data-priority="1">#</th>
                                        <th data-priority="3">Norma</th>
                                        <th data-priority="4">compromiso</th>
                                        <th>Fase</th>
                                        <th>Frecuencia</th>
                                        <th>Resumen</th>
                                        <th data-priority="5">Documentos</th>
                                        <th data-priority="2" style="width: 10%">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($report_commitments)
                                        @foreach ($report_commitments as $key => $report_commitment)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    {{ $report_commitment->commitment->code }} -
                                                    {{ $report_commitment->commitment->norm->short_name }} <br>
                                                    <p class="card-title-desc">
                                                        {{ $report_commitment->commitment->norm->applicable_standard }} </p>
                                                </td>
                                                <td>{{ $report_commitment->commitment->code }} - {{ $report_commitment->commitment->summary }}</td>
                                                <td>{{ $report_commitment->commitment->phase->name }}</td>
                                                <td>{{ $report_commitment->commitment->frequency->name }}</td>
                                                <td>{{ $report_commitment->commitment->summary }}</td>
                                                <td>
                                                    <center>{{ $report_commitment->cantityDocumentsByCommitment() }}</center>
                                                </td>
                                                <td>
                                                    <div class="btn-group mr-1 mt-1">
                                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">Opciones
                                                            <i class="mdi mdi-chevron-down"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="{{ route('upload.report', $report_commitment->id) }}">Ver
                                                                documentos</a>
                                                            {{-- <a class="dropdown-item" href="{{ route('upload.report', $report_commitment->id) }}">Revisar</a>
                                                            <a class="dropdown-item" href="{{ route('upload.report', $report_commitment->id) }}">Seguimiento</a> --}}
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                                
                            </table>

                        </div>

                        <div class="card-footer">
                            <div class="">
                                <a href="{{ route('all.report') }}" class="btn btn-secondary">Regresar</a>
                            </div>
                        </div>

                    </div>
                </div> <!-- end col -->
            </div>

        </div> <!-- container-fluid -->
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
@endsection
