# Proyecto de Gestión de Almacén de Bebidas

Este proyecto es una aplicación web de gestión de acceso a un sistema de almacén de bebidas. Permite la autenticación de usuarios y ofrece funcionalidades específicas según el rol asignado: administrador o usuario. Los administradores tienen acceso a operaciones adicionales como la administración de usuarios, mientras que los usuarios tienen acceso limitado a ciertas funcionalidades de gestión de inventario.

## Características

- **Inicio de Sesión y Roles:** Permite el acceso a través de un sistema de login que valida el rol del usuario (administrador o usuario regular).
- **Operaciones de Gestión:** Cálculo de precio total de bebidas, precio por marca y estantería.
- **Administración de Usuarios:** Los administradores pueden gestionar usuarios: agregar, editar o eliminar usuarios.
- **Interfaz de Usuario Amigable:** Uso de Bootstrap para una interfaz atractiva y receptiva.
  
## Tecnologías Utilizadas

- **PHP**: Lenguaje principal para la lógica del servidor.
- **MySQL**: Base de datos para almacenar usuarios y productos.
- **HTML/CSS/JavaScript**: Tecnologías para el frontend.
- **Bootstrap 5**: Framework para el diseño de la interfaz.
- **AJAX**: Para actualización dinámica de datos sin recargar la página.

## Requisitos

- **PHP** >= 7.4
- **MySQL** >= 5.7
- **Servidor Web** (Apache recomendado, compatible con XAMPP o WAMP)
- **Composer** (opcional, si se planea extender el proyecto con dependencias externas)
