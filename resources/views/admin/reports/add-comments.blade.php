@extends('admin.layouts.app')

@section('css')
    
    <link href="{{ asset('plugins/summernote/summernote-bs4.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Sistema de Informes</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('all.report') }}">Informes</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('commitments.report', $document->report_commitment->report_id) }}">Compromisos</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('upload.report', $document->report_commitment_id) }}">Documentos</a></li>
                        <li class="breadcrumb-item active">Agregar Comentario</li>
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
                        {{ Form::open(['route' => ['store.add-comment.report', $document->id], 'method' => 'POST', 'id' => 'formAddComment']) }}

                            <div class="card-body">
                                
                                <div class="form-group row">
                                    <h4 class="header-title col-md-10">{{ $document->title }}</h4>
                                    <div class="float-right col-md-2">
                                        <center>
                                            <a href="{{ $document->url }}" target="_blank">Ver / Descargar</a>
                                        </center>
                                    </div>
                                </div>

                                <hr>
                                                            
                                <div class="form-group row">
                                    <input type="hidden" name="id" value="{{ $document->id }}">
                                    <div class="col-md-12">
                                        <textarea id="summernote" name="summernote" required></textarea>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="card-footer">
                                <div class="">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Guardar</button>
                                    <a href="{{ route('upload.report', 1) }}" class="btn btn-secondary">Regresar</a>
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
    
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('js/pages/summernote.init.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Ingrese sus comentarios',
                tabsize: 2,
                height: 500
            });
        });
    </script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#formAddComment').validate({
            rules: {
                summernote: {
                    required: true,
                },
            },
            messages: {
                summernote: {
                    required: 'Please Enter Comments',
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