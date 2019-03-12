<aside class="sidebar sidebar-left">
    <div class="sidebar--wrapper">
        <div class="sidebar--header">
            <div class="sidebar--brand-text">
                <h1>{{ config("app.name", "SISGEC") }}</h1>
            </div>
        </div>
        <div class="sidebar--content">
            <nav class="sidebar--menu">
                <ul>
                    <li class="sidebar--menu-item item-active">
                        <a href="#">
                            <span class="item-icon"><i class="fas fa-fw fa-home"></i></span> <span class="item-text">Inicio</span>
                        </a>
                    </li>
                    <li class="sidebar--menu-item">
                        <a href="#">
                            <span class="item-icon"><i class="fas fa-fw fa-users"></i></span> <span class="item-text">Pacientes</span>
                        </a>
                    </li>
                    <li class="sidebar--menu-item">
                        <a href="#">
                            <span class="item-icon"><i class="fas fa-fw fa-sticky-note"></i></span> <span class="item-text">Notas</span>
                        </a>
                    </li>
                    <li class="sidebar--menu-item">
                        <a href="#">
                            <span class="item-icon"><i class="fas fa-fw fa-calendar-alt"></i></span> <span class="item-text">Calendario</span>
                        </a>
                    </li>
                    <li class="sidebar--menu-item">
                        <a href="#">
                            <span class="item-icon"><i class="fas fa-fw fa-user-nurse"></i></span> <span class="item-text">Asistentes</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="sidebar--footer">
            <p><abbr title="Sistema Gestor de Expedientes Clinicos">SISGEC</abbr> v{{version()}}</p>
            <p><a href="https://github.com/SISGEC/SISGEC" target="_blank"><i class="fab fa-github"></i> Github</a> | <a href="https://github.com/SISGEC/SISGEC/issues" target="_blank"><i class="fas fa-info-circle"></i> Ayuda</a></p>
        </div>
    </div>
</aside>