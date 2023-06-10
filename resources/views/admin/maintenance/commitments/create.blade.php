@extends('admin.layouts.app')

@section('css')
    
@endsection

@section('content')

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Nuevo Compromiso</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('all.norm') }}">Compromisos</a></li>
                    <li class="breadcrumb-item active">Nuevo Compromiso</li>
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
                        @include('admin.maintenance.commitments.form', ['url' => 'store/commitment', 'method' => 'POST'])
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
        $('#formCommitment').validate({
            rules: {
                code: {
                    required : true,
                }, 
                norm_id: {
                    required : true,
                },
                phase_id: {
                    required : true,
                },
                frequency_id: {
                    required : true,
                },
                summary: {
                    required : true,
                },
                description: {
                    required : true,
                },
            },
            messages :{
                code: {
                    required : 'Please Enter code',
                }, 
                norm_id: {
                    required : 'Please Select norm',
                }, 
                phase_id: {
                    required : 'Please Select phase',
                }, 
                frequency_id: {
                    required : 'Please Select frequency',
                }, 
                summary: {
                    required : 'Please Enter summary',
                }, 
                description: {
                    required : 'Please Enter description',
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