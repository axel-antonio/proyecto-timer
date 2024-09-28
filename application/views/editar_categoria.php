<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría</title>
</head>
<body>
    <h1>Editar Categoría</h1>

    <?php if (isset($categoria)): ?>
        <form action="<?= base_url('index.php/Categoria/actualizar/' . $categoria->id); ?>" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?= $categoria->nombre; ?>" required><br><br>

            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" required><?= $categoria->descripcion; ?></textarea><br><br>

            <label for="restriccion_tiempo">Restricción de Tiempo (min):</label>
            <input type="number" name="restriccion_tiempo" value="<?= $categoria->restriccion_tiempo; ?>" required><br><br>

            <button type="submit">Guardar Cambios</button>
        </form>

        <br>
        <a href="<?= base_url('index.php/Categoria'); ?>">Regresar a la pantalla principal</a>

    <?php else: ?>
        <p>Categoría no encontrada.</p>
        <a href="<?= base_url('index.php/Categoria'); ?>">Regresar a la pantalla principal</a>
    <?php endif; ?>
</body>
</html>
