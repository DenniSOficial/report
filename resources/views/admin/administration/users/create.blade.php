@extends('admin.layouts.app')

@section('css')
    
@endsection

@section('content')

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Nuevo Usuario</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('all.user') }}">Usuarios</a></li>
                    <li class="breadcrumb-item active">Nuevo Usuario</li>
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
                        @include('admin.administration.users.form', ['url' => 'store/user', 'method' => 'POST'])
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
        $('#formUser').validate({
            rules: {
                name: {
                    required : true,
                }, 
                username: {
                    required : true,
                },
                role: {
                    required : true,
                },
                email: {
                    required : true,
                },
                password: {
                    required : true,
                },
                repassword: {
                    required : true,
                },
            },
            messages :{
                name: {
                    required : 'Please Enter name',
                }, 
                username: {
                    required : 'Please Enter username',
                }, 
                role: {
                    required : 'Please Select role',
                }, 
                email: {
                    required : 'Please Enter email',
                }, 
                password: {
                    required : 'Please Enter password',
                }, 
                repassword: {
                    required : 'Please Enter re password',
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