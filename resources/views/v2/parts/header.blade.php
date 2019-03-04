<header class="header">
    <nav class="navbar navbar-dark bg-dark">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="addHeaderButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-plus"></i> A&ntilde;adir
            </button>
            <div class="dropdown-menu" aria-labelledby="addHeaderButton">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-fw fa-user-injured"></i> Paciente
                    <span class="shortcut">ctrl + p</span>
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-fw fa-sticky-note"></i> Nota
                    <span class="shortcut">ctrl + n</span>
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-fw fa-calendar-plus"></i> Cita
                    <span class="shortcut">ctrl + i</span>
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-fw fa-user-plus"></i> Asistente
                    <span class="shortcut">ctrl + a</span>
                </a>
            </div>
        </div>
        <div class="form-inline ml-auto">
            <div class="search">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input class="form-control search--input" type="search" placeholder="Buscar paciente por nombre, apellido o teléfono" aria-label="Buscar paciente por nombre, apellido o teléfono">
                </div>
                <div class="search--results"></div>
            </div>
            <div class="profile">
                <div class="dropdown">
                    <button class="dropdown-toggle btn btn-link" type="button" id="profileButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dr. Jesús Magallón</button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileButton">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-fw fa-user-cog"></i> Mi Perfil
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-fw fa-cogs"></i> Opciones
                        </a>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fas fa-fw fa-sign-out-alt"></i> Cerrar Sesión
                        </a>
                        <form id="logout-form" action="" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
                <div class="profile--avatar">
                    <img src="https://api.adorable.io/avatars/50/abott@adorable.png" alt="Dr. Jesús Magallón">
                </div>
            </div>
        </div>
    </nav>
</header>