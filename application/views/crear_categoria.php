<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nueva Categoría</title>
</head>
<body>
    <h1>Agregar Nueva Categoría</h1>

    <form action="<?= base_url('index.php/Categoria/guardar'); ?>" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" required></textarea><br><br>

        <label for="restriccion_tiempo">Restricción de Tiempo (min):</label>
        <input type="number" name="restriccion_tiempo" required><br><br>

        <button type="submit">Guardar</button>
    </form>

    <br>
    <a href="<?= base_url('index.php/Categoria'); ?>">Regresar a la pantalla principal</a>
</body>
</html>
