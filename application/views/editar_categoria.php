<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría</title>
    <!-- Enlace al archivo CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/styleC.css'); ?>">
</head>
<body>

    <div class="container-editar">
        <h2>Editar Categoría</h2>

        <!-- Formulario para editar la categoría -->
        <form action="<?= base_url('index.php/Categoria/actualizar/' . $categoria->id); ?>" method="post" class="form-categoria">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= $categoria->nombre; ?>" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required><?= $categoria->descripcion; ?></textarea>
            </div>

            <div class="form-group">
                <label for="restriccion_tiempo">Restricción de Tiempo (min):</label>
                <input type="number" id="restriccion_tiempo" name="restriccion_tiempo" value="<?= $categoria->restriccion_tiempo; ?>" required>
            </div>

            <button type="submit" class="btn-guardar">Guardar Cambios</button>
        </form>

        <!-- Botón para regresar -->
        <a href="<?= base_url('index.php/Categoria'); ?>" class="btn-regresar">Regresar a la pantalla principal</a>
    </div>

</body>
</html>
