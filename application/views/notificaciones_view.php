<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Notificaciones</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Gestionar Notificaciones para <?= htmlspecialchars($computer['nombre'], ENT_QUOTES, 'UTF-8') ?></h2>

        <!-- Mostrar mensajes de éxito o error -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Formulario para crear una nueva notificación -->
        <form action="<?= base_url('index.php/Ciber/add_notification') ?>" method="post">
            <input type="hidden" name="computadora_id" value="<?= htmlspecialchars($computer['id'], ENT_QUOTES, 'UTF-8') ?>">
            <div class="mb-3">
                <label for="mensaje" class="form-label">Mensaje de Notificación</label>
                <input type="text" class="form-control" id="mensaje" name="mensaje" required>
            </div>
            <div class="mb-3">
                <label for="sonido" class="form-label">Sonido (opcional)</label>
                <input type="text" class="form-control" id="sonido" name="sonido" placeholder="Ejemplo: alerta.mp3">
            </div>
            <button type="submit" class="btn btn-primary">Crear Notificación</button>
            <a href="<?= base_url('index.php/Ciber') ?>" class="btn btn-secondary">Volver</a>
        </form>

        <hr>

        <!-- Lista de notificaciones existentes -->
        <h3>Notificaciones Existentes</h3>
        <?php if (!empty($notificaciones)): ?>
            <ul class="list-group">
                <?php foreach ($notificaciones as $notificacion): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= htmlspecialchars($notificacion['mensaje'], ENT_QUOTES, 'UTF-8') ?>
                        <div>
                            <?php if (!empty($notificacion['sonido'])): ?>
                                <span class="badge bg-info text-dark me-2">Sonido: <?= htmlspecialchars($notificacion['sonido'], ENT_QUOTES, 'UTF-8') ?></span>
                            <?php endif; ?>
                            <a href="#" class="btn btn-sm btn-danger" onclick="event.preventDefault(); if(confirm('¿Estás seguro de eliminar esta notificación?')) { 
                                $.post('<?= base_url('index.php/Ciber/delete_notification') ?>', { id: <?= $notificacion['id'] ?> }, function(response) {
                                    if(response.success) {
                                        location.reload();
                                    } else {
                                        alert('Error al eliminar la notificación.');
                                    }
                                }, 'json');
                            }">
                                <i class="fas fa-trash"></i> Eliminar
                            </a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No hay notificaciones creadas para esta máquina.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

