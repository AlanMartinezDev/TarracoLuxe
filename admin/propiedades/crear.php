<?php
require '../../includes/config/database.php';
$db = conectarDB();

// Consultar para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

// Array con mensajes de errores
$errores = [];

$titulo = '';
$precio = '';
$imagen = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$plazas = '';
$vendedorId = '';

// Ejecutar el código después de que el usuario envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $imagen = $_POST['imagen'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitaciones'];
    $wc = $_POST['wc'];
    $plazas = $_POST['plazas'];
    $creado = date('Y/m/d');
    $vendedorId = $_POST['vendedor'];

    if (!$titulo) {
        $errores[] = "Debes añadir un título";
    }

    if (!$precio) {
        $errores[] = "Debes añadir un precio";
    }

    if (strlen($descripcion) < 50) {
        $errores[] = "Debes añadir una descripcion que tenga al menos 50 caracteres";
    }

    if (!$habitaciones) {
        $errores[] = "Debes añadir al menos una habitación";
    }

    if (!$wc) {
        $errores[] = "Debes añadir al menos un wc";
    }

    if (!$plazas) {
        $errores[] = "Debes añadir al menos una plaza";
    }

    if (!$vendedorId) {
        $errores[] = "Debes añadir un vendedor";
    }

    // Revisar que el array de errores esté vacío
    if (empty($errores)) {
        // Insertar en la base de datos
        $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, plazas, creado, vendedorId) VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$plazas', '$creado', '$vendedorId')";

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            // Redireccionar al usuario
            header('Location: /TarracoLuxe/admin');
        }
    }
}

require '../../includes/funciones.php';
incluirTemplate('header');
?>
<main class="contenedor seccion">
    <h1>Crear propiedad</h1>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach ?>
    <form action="/TarracoLuxe/admin/propiedades/crear.php" method="post" class="formulario">
        <fieldset>
            <legend>Información general</legend>
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $titulo; ?>" placeholder="Título de la propiedad">
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" value="<?php echo $precio; ?>" placeholder="Precio de la propiedad">
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" value="<?php echo $imagen; ?>" accept="image/jpeg, image/png">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
        </fieldset>
        <fieldset>
            <legend>Información de la propiedad</legend>
            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" value="<?php echo $habitaciones; ?>" placeholder="Número de habitaciones" min="1" max="9">
            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" value="<?php echo $wc; ?>" placeholder="Número de baños" min="1" max="9">
            <label for="plazas">Plazas:</label>
            <input type="number" id="plazas" name="plazas" value="<?php echo $plazas; ?>" placeholder="Número de plazas" min="1" max="9">
        </fieldset>
        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedor">
                <option disabled selected>-- Selecciona un vendedor --</option>
                <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?></option>
                <?php endwhile ?>
            </select>
        </fieldset>
        <input type="submit" value="Crear propiedad" class="boton boton-verde">
    </form>
    <a href="/TarracoLuxe/admin" class="boton boton-verde">Volver</a>
</main>
<?php
incluirTemplate('footer');
?>