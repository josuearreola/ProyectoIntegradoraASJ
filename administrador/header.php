<header class="header">
        <nav class="nav-menu">
            <a href="administrador.php" class="enlace">
                <img src="../img/logo.jpg" alt="" class="logo">
            </a>
            <a href="../salir.php" class="imgsesion"><img class="imgses" src="../img/cerrarses.jpg" alt="Cerrar sesion" title="salir"></a>
            <div class="opc">
                <p class="horario">Mexico, <?php print FechaC() ?></p>
                <span class="user1"> | </span>
                <span class="user"> <?php print $_SESSION['idUsua'] ?> </span>
            </div>
        </nav>

        <div class="nav-menu2">
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>
            <ul class="ul-opc">
                <li class="li-opc"><a class="a-opc" href="administrador.php">Inicio</a></li>
                <li class="li-opc">
                    <a class="a-opc" href="#">Usuarios</a>
                    <ul class="menu-categoria">
                        <li class="li-cat"><a href="registrousuario.php" class="a-cat">Nuevos usuarios</a></li>
                        <li class="li-cat"><a href="listausuarios.php" class="a-cat">Lista de usuarios</a></li>
                    </ul>
                </li>
                <li class="li-opc">
                    <a class="a-opc" href="#">Clientes</a>
                    <ul class="menu-categoria">
                        <li class="li-cat"><a href="#" class="a-cat">Nuevos clientes</a></li>
                        <li class="li-cat"><a href="#" class="a-cat">Lista de clientes</a></li>
                    </ul>
                </li>
                <li class="li-opc">
                    <a class="a-opc" href="#">Marcas</a>
                    <ul class="menu-categoria">
                        <li class="li-cat"><a href="#" class="a-cat">Nuevas marcas</a></li>
                        <li class="li-cat"><a href="#" class="a-cat">Lista de marcas</a></li>
                    </ul>
                </li>
                <li class="li-opc">
                    <a class="a-opc" href="#">Productos</a>
                    <ul class="menu-categoria">
                        <li class="li-cat"><a href="#" class="a-cat">Nuevos productos</a></li>
                        <li class="li-cat"><a href="#" class="a-cat">Lista de productos</a></li>
                    </ul>
                </li>
                <li class="li-opc">
                    <a class="a-opc" href="#">Facturas</a>
                    <ul class="menu-categoria">
                        <li class="li-cat"><a href="#" class="a-cat">Nuevas facturas</a></li>
                        <li class="li-cat"><a href="#" class="a-cat">Lista de facturas</a></li>
                    </ul>
                </li>
            </ul>

        </div>
        <section></section>
    </header>