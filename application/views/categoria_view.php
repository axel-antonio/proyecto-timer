<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías</title>
</head>
<body>
    <h1>Gestión de Categorías</h1>

    <a href="<?= base_url('index.php/Categoria/crear'); ?>">Agregar Nueva Categoría</a><br><br>

    <?php if ($this->session->flashdata('success')): ?>
        <p style="color: green;"><?= $this->session->flashdata('success'); ?></p>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <p style="color: red;"><?= $this->session->flashdata('error'); ?></p>
    <?php endif; ?>

    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Restricción de Tiempo</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($categorias as $categoria): ?>
            <tr>
                <td><?= $categoria->nombre; ?></td>
                <td><?= $categoria->descripcion; ?></td>
                <td><?= $categoria->restriccion_tiempo; ?> min</td>
                <td>
                    <a href="<?= base_url('index.php/Categoria/editar/' . $categoria->id); ?>">Editar</a> |
                    <a href="<?= base_url('index.php/Categoria/eliminar/' . $categoria->id); ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta categoría?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
