<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías</title>
    <!-- Enlace a tu archivo CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/styleC.css'); ?>">
</head>
<body>

    <div class="container-categorias">
        <h2>Gestión de Categorías</h2>

        <!-- Botón para agregar una nueva categoría -->
        <a href="<?= base_url('index.php/Categoria/crear'); ?>" class="btn-agregar">Agregar Nueva Categoría</a>

        <!-- Mensaje de éxito si se agrega una categoría correctamente -->
        <?php if ($this->session->flashdata('success')): ?>
            <p class="alert-success"><?= $this->session->flashdata('success'); ?></p>
        <?php endif; ?>

        <!-- Tabla para mostrar las categorías -->
        <table class="tabla-categorias">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Restricción de Tiempo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $categoria): ?>
                    <tr>
                        <td><?= $categoria->nombre; ?></td>
                        <td><?= $categoria->descripcion; ?></td>
                        <td><?= $categoria->restriccion_tiempo; ?> min</td>
                        <td class="acciones">
                            <a href="<?= base_url('index.php/Categoria/editar/' . $categoria->id); ?>" class="btn-editar">Editar</a>
                            <a href="<?= base_url('index.php/Categoria/eliminar/' . $categoria->id); ?>" class="btn-eliminar" onclick="return confirm('¿Estás seguro de eliminar esta categoría?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Botón para regresar a la pantalla principal -->
        <a href="<?= base_url('index.php/Ciber'); ?>" class="btn-regresar">Volver a la pantalla principal</a>
    </div>

</body>
</html>
