@extends('admin.layouts.app')

@section('content')
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">sistema de Informe</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('all.report') }}">Informes</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('commitments.report', $report_commitment_document->report_commitment->report_id) }}">Compromisos</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('upload.report', $report_commitment_document->report_commitment_id) }}">Documentos</a></li>
                        <li class="breadcrumb-item active">Seguimiento de Comentarios</li>
                    </ol>
                </div>
                <div class="col-md-4">

                </div>
            </div>

        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="timeline" dir="ltr">
                        <div class="timeline-item timeline-left">
                            <div class="timeline-block">
                                <div class="time-show-btn mt-0">
                                    <a href="#" class="btn btn-info w-lg">Seguimiento de Comentarios</a>
                                </div>
                            </div>
                        </div>

                        @foreach ($comments as $key => $comment)
                            @if ($key % 2 == 0)
                                <div class="timeline-item">
                                    <div class="timeline-block">
                                        <div class="timeline-box card">
                                            <div class="card-body">
                                                <div class="timeline-icon icons-md">
                                                    <i class="uim uim-layer-group"></i>
                                                </div>
                                                <div class="d-inline-block py-1 px-3 bg-primary text-white badge-pill">
                                                    {{ $comment->user_created->name }} - {{ $comment->created_at }}
                                                </div>
                                                <p class="mt-3 mb-2"></p>
                                                <div class="text-muted">
                                                    {!! $comment->comment !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="timeline-item timeline-left">
                                    <div class="timeline-block">
                                        <div class="timeline-box card">
                                            <div class="card-body">
                                                <div class="timeline-icon icons-md">
                                                    <i class="uim uim-layer-group"></i>
                                                </div>
                                                <div class="d-inline-block py-1 px-3 bg-primary text-white badge-pill">
                                                    {{ $comment->user_created->name }} - {{ $comment->created_at }}
                                                </div>
                                                <p class="mt-3 mb-2"></p>
                                                <div class="text-muted">
                                                    {!! $comment->comment !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach



                    </div>

                </div>
            </div>
            <!-- end row -->

        </div>
        <!-- end container-fluid -->
    </div>
@endsection
