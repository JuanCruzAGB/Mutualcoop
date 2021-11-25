<?php
    /** @var string $current - Current active link */
?>
<nav id="nav-1" class="nav-menu">
    <div class="nav-row">
        <a href="#menu" class="sidebar-button open-btn left">
            <i class="sidebar-icon fas fa-bars"></i>
        </a>
        
        <a href="/" class="nav-title logo flex items-center">
            <img src="/img/recursos/logo.png" alt="Mutualcoop">
            <h1>Mutualcoop</h1>
        </a>
    </div>

    <div class="nav-row">
        <ul class="nav-menu-list">
        @if(!Auth::user())
            <li><a href="/ingresar" class="nav-link">
                <i class="link-icon left fas fa-sign-in-alt"></i>
                <span class="link-text">Iniciar Sesión</span>
            </a></li>
        @else
            <li><a href="/dashboard#hace-tu-consulta" class="nav-link">
                <span class="link-text">Hace tu consulta</span>
            </a></li>
            @if(Auth::user()->id_nivel <= 1)
                <li><a href="/dashboard" class="nav-link">
                    <span class="link-text">Panel</span>
                </a></li>
            @elseif(Auth::user()->id_nivel > 1)
                <li id="dropdown-1" class="dropdown closed">
                    <a href="/dashboard" class="dropdown-header nav-link">
                        <span class="text">Panel</span>
                        <button class="dropdown-button">
                            <i class="dropdown-icon fas fa-sort-down"></i>
                        </button>
                    </a>
                    <ul class="dropdown-menu-list">
                        <li class="m-0">
                            <a href="/dashboard" class="dropdown-link nav-link">
                                <i class="link-icon fas fa-chevron-right"></i>
                                <span class="link-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="m-0">
                            <a href="/panel/eventos" class="dropdown-link nav-link">
                                <i class="link-icon fas fa-chevron-right"></i>
                                <span class="link-text">Eventos</span>
                            </a>
                        </li>
                        <li class="m-0">
                            <a href="/panel/gestiones" class="dropdown-link nav-link">
                                <i class="link-icon fas fa-chevron-right"></i>
                                <span class="link-text">Gestiones</span>
                            </a>
                        </li>
                        <li class="m-0">
                            <a href="/panel/normativas" class="dropdown-link nav-link">
                                <i class="link-icon fas fa-chevron-right"></i>
                                <span class="link-text">Normativas</span>
                            </a>
                        </li>
                        <li class="m-0">
                            <a href="/panel/notas-de-interes" class="dropdown-link nav-link">
                                <i class="link-icon fas fa-chevron-right"></i>
                                <span class="link-text">Notas de Interés</span>
                            </a>
                        </li>
                        <li class="m-0">
                            <a href="/panel/noticias" class="dropdown-link nav-link">
                                <i class="link-icon fas fa-chevron-right"></i>
                                <span class="link-text">Noticias</span>
                            </a>
                        </li>
                        <li class="m-0">
                            <a href="/panel/precios" class="dropdown-link nav-link">
                                <i class="link-icon fas fa-chevron-right"></i>
                                <span class="link-text">Precios</span>
                            </a>
                        </li>       
                        <li class="m-0">
                            <a href="/panel/preguntas" class="dropdown-link nav-link">
                                <i class="link-icon fas fa-chevron-right"></i>
                                <span class="link-text">Preguntas Frecuentes</span>
                            </a>
                        </li>                 
                        <li class="m-0">
                            <a href="/panel/usuarios" class="dropdown-link nav-link">
                                <i class="link-icon fas fa-chevron-right"></i>
                                <span class="link-text">Usuarios</span>
                            </a>
                        </li>
                        <li class="m-0">
                            <a href="/panel/facturaciones" class="dropdown-link nav-link">
                                <i class="link-icon fas fa-chevron-right"></i>
                                <span class="link-text">Facturaciones</span>
                            </a>
                        </li>
                        <li class="m-0">
                            <a href="/panel/suscriptores" class="dropdown-link nav-link">
                                <i class="link-icon fas fa-chevron-right"></i>
                                <span class="link-text">Suscriptores</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            <li><a href="/salir" class="nav-link">
                <i class="link-icon left fas fa-sign-out-alt"></i>
                <span class="link-text">Cerrar Sesión</span>
            </a></li>
        @endif
        </ul>
    </div>

    @component('components.nav.sidebar_panel')
    @endcomponent
</nav>