
<?php
session_start();
if (!isset($_SESSION['nombre']) || $_SESSION['rol'] !== 'administrador') {
    // Redirige al login si no hay una sesión activa o si no es administrador
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almacén de Bebidas</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menú de Almacén</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <!-- Operaciones de Almacén -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Operaciones
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#" id="calcular-total">Calcular precio total de todas las bebidas</a></li>
                      <li><a class="dropdown-item" href="#" id="calcular-marca">Calcular precio por marca</a></li>
                      <li><a class="dropdown-item" href="#" id="calcular-estanteria">Calcular precio por estantería</a></li>
                      <li><a class="dropdown-item" href="#" id="agregar-producto">Agregar producto</a></li>
                      <li><a class="dropdown-item" href="#" id="eliminar-producto">Eliminar producto</a></li>
                      <li><a class="dropdown-item" href="#" id="mostrar-info">Mostrar información</a></li>
                    </ul>
                    
                </li>
                <!-- Fin de Operaciones -->
                  <!--Inicio de Administrador de Usuarios -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Administracion de Usuarios
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#" id="Registro">Administrar Usuario</a></li>
                      <li><a class="dropdown-item" href="#" id="Usuarios">Agregar Nuevos Usuarios</a></li>
                      <li><a class="dropdown-item" href="#" id="eliminar-producto">Eliminar Usuarios</a></li>
                      <li><a class="dropdown-item" href="#" id="mostrar-info">Mostrar información</a></li>
                    </ul>
                </li>
                <!-- Fin de Administrar Usuarios -->
                   <!-- Opción de Cerrar Sesión -->
                   <li class="nav-item">
                        <a class="nav-link" href="cerrar.php">Cerrar Sesión</a>
                    </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
  
      <div class="container mt-5">
        <h1>Administrador: <?php echo htmlspecialchars($_SESSION['nombre']); ?>!</h1>
        <!-- Aquí puedes agregar más contenido relacionado con la administración -->
    </div>
 <!-- Mensaje temporal -->
 <div id="mensaje-temporal" class="alert alert-success" role="alert">
            Has iniciado sesión correctamente.
        </div>
    <!-- Sección principal donde se mostrarán los resultados o formularios -->
    <div class="container mt-5 pt-5">
        <div id="resultados" class="mt-4"></div>
    </div>

   <!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
 <!-- Script para ocultar el mensaje temporal -->
 <script>
        // Oculta el mensaje después de 5 segundos
        setTimeout(function() {
            document.getElementById('mensaje-temporal').style.display = 'none';
        }, 5000);
    </script>
</body>

</html>
