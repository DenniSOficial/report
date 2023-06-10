@extends('admin.layouts.app')

@section('css')
    
    <!-- DataTables -->
    <link href="{{ asset('plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />     

@endsection

@section('content')
    
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Sistema de Informes</h4>
                    <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
                <div class="col-md-4">
                    <div class="float-right d-none d-md-block">
                        <div class="dropdown">
                            <button class="btn btn-light btn-rounded dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-settings-outline mr-1"></i> Opciones
                            </button>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
                                <a class="dropdown-item" href="{{ route('add.report-manager') }}">Nuevo</a>
                            </div>
                        </div>
                    </div>
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
        
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Documento</th>
                                    <th>Apellidos y Nombres</th>
                                    <th>Email</th>
                                    <th>Telefono</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @isset($report_managers)
                                        @foreach ($report_managers as $key => $report_manager)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $report_manager->type_document . ' - ' . $report_manager->document }}</td>
                                                <td>{{ $report_manager->NombreCompleto() }}</td>
                                                <td>{{ $report_manager->email }}</td>
                                                <td>{{ $report_manager->telephone }}</td>
                                                <td>
                                                    @include('admin.maintenance.report-managers.delete', $report_manager)
                                                </td>
                                            </tr>        
                                        @endforeach
                                    @endisset    
                                </tbody>
                            </table>
        
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
        $('#datatable').dataTable( {
            'ordering': false
        } );
    </script>
@endsection