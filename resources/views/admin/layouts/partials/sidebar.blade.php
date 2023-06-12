<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                        <span>Dashboard</span>
                    </a>
                </li>

                @if (Auth::user()->role !== 'user')
                
                    <li class="menu-title">MANTENIMIENTO</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-comment-message"></i></div>
                            <span>Clientes</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('all.client') }}">Listado de Clientes</a></li>
                            <li><a href="{{ route('add.client') }}">Agregar Clientes</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-comment-message"></i></div>
                            <span>Encargados</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('all.report-manager') }}">Listado de Encargados</a></li>
                            <li><a href="{{ route('add.report-manager') }}">Agregar Encargado</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-comment-message"></i></div>
                            <span>Normas</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('all.norm') }}">Listado de Normas</a></li>
                            <li><a href="{{ route('add.norm') }}">Agregar Norma</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-sign-in-alt"></i></div>
                            <span>Compromisos</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('all.commitment') }}">Listado de Compromisos</a></li>
                            <li><a href="{{ route('add.commitment') }}">Agregar Compromiso</a></li>
                        </ul>
                    </li>
                    
                @endif
                

                <li class="menu-title">Informes</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-document-layout-left"></i></div>
                        <span>Informes</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('all.report') }}">Listado de Informes</a></li>
                        @if (Auth::user()->role !== 'user')
                            <li><a href="{{ route('add.report') }}">Agregar Informe</a></li>
                        @endif
                    </ul>
                </li>

            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->