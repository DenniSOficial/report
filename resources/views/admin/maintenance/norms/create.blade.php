@extends('admin.layouts.app')

@section('css')
    
@endsection

@section('content')

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Nueva Norma / IGA</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('all.norm') }}">Normas</a></li>
                    <li class="breadcrumb-item active">Nueva Norma / IGA</li>
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
                        @include('admin.maintenance.norms.form', ['url' => 'store/norm', 'method' => 'POST'])
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
        $('#formNorm').validate({
            rules: {
                code: {
                    required : true,
                }, 
                authority_id: {
                    required : true,
                },
                applicable_standard: {
                    required : true,
                },
                large_name: {
                    required : true,
                },
                short_name: {
                    required : true,
                },
                place_application: {
                    required : true,
                },
                expedition: {
                    required : true,
                }, 
            },
            messages :{
                code: {
                    required : 'Please Enter code',
                }, 
                authority_id: {
                    required : 'Please Enter authority',
                }, 
                applicable_standard: {
                    required : 'Please Enter applicable standard',
                }, 
                large_name: {
                    required : 'Please Enter large name',
                }, 
                short_name: {
                    required : 'Please Enter short name',
                }, 
                place_application: {
                    required : 'Please Enter place application',
                }, 
                expedition: {
                    required : 'Please Enter expedition',
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