<?php
session_start();

$auth = $_SESSION['login'];

if (!$auth) {
    header('Location: ../login.php');
}

// Importar la conexión
require '../includes/config/database.php';
$db = conectarDB();

// Escribir el query
$query = "SELECT * FROM propiedades";

// Consultar la base de datos
$resultadoConsulta = mysqli_query($db, $query);

// Muestra mensaje condicional
$resultado = $_GET['resultado'] ?? null;

// Eliminar propiedad
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {
        // Eliminar la imagen
        $query = "SELECT imagen FROM propiedades WHERE id = {$id}";
        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);
        unlink('../imagenes/' . $propiedad['imagen']);

        // Eliminar la propiedad
        $query = "DELETE FROM propiedades WHERE id = {$id}";
        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            header('Location: /TarracoLuxe/admin?resultado=3');
        }
    }
}

// Incluye un template
require '../includes/funciones.php';
incluirTemplate('header');
?>
<main class="contenedor seccion">
    <h1>Administrador de TarracoLuxe</h1>
    <?php if (intval($resultado) === 1) : ?>
        <p class="alerta exito">Propiedad creada correctamente</p>
    <?php endif; ?>
    <?php if (intval($resultado) === 2) : ?>
        <p class="alerta exito">Propiedad actualizada correctamente</p>
    <?php endif; ?>
    <?php if (intval($resultado) === 3) : ?>
        <p class="alerta exito">Propiedad eliminada correctamente</p>
    <?php endif; ?>
    <a href="/TarracoLuxe/admin/propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
                <tr>
                    <td><?php echo $propiedad['id']; ?></td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td><img src="/TarracoLuxe/imagenes/<?php echo $propiedad['imagen']; ?>" alt="Imagen de la casa en la playa" class="imagen-tabla"></td>
                    <td><?php echo $propiedad['precio']; ?> €</td>
                    <td>
                        <a href="propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>
                        <form method="post" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                            <input type="submit" value="Borrar" class="boton-rojo-block">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>
<?php
// Cerrar la conexión (opcional)
mysqli_close($db);

incluirTemplate('footer');
?>