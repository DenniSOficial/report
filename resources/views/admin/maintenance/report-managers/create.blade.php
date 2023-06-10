@extends('admin.layouts.app')

@section('css')
    
@endsection

@section('content')

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Nuevo Encargado</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('all.report-manager') }}">Encargados</a></li>
                    <li class="breadcrumb-item active">Nuevo Encargado</li>
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
                        @include('admin.maintenance.report-managers.form', ['url' => 'store/report-manager', 'method' => 'POST'])
                    </div>
                </div>
            </div>

        </div>
        <!-- end container-fluid -->
    </div> 

@endsection

@section('js')
    
<script type="text/javascript">
    $(document).ready(function (){
        $('#formReportManager').validate({
            rules: {
                type_document: {
                    required : true,
                }, 
                document: {
                    required : true,
                },
                lastname: {
                    required : true,
                },
                lastname2: {
                    required : true,
                },
                name: {
                    required : true,
                },
                email: {
                    required : true,
                },
            },
            messages :{
                type_document: {
                    required : 'Please Select type document',
                }, 
                document: {
                    required : 'Please Enter document',
                }, 
                lastname: {
                    required : 'Please Enter lastname',
                }, 
                lastname2: {
                    required : 'Please Enter lastname2',
                }, 
                name: {
                    required : 'Please Enter name',
                }, 
                email: {
                    required : 'Please Enter email',
                }, 
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>

@endsection