<?php $this->load->view('templates/header'); ?>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2>Editar Alerta para: <?php echo htmlspecialchars($computadora['nombre']); ?></h2>

        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <?php echo form_open('alertas/actualizar/' . $alerta['id']); ?>

            <div class="form-group">
                <label for="computadora_id">ID de Computadora</label>
                <input type="text" name="computadora_id" class="form-control" value="<?php echo set_value('computadora_id', $computadora['id']); ?>" readonly>
            </div>

            <div class="form-group">
                <label for="mensaje">Mensaje de Alerta</label>
                <input type="text" name="mensaje" class="form-control" value="<?php echo set_value('mensaje', $alerta['mensaje']); ?>" required>
            </div>

            <div class="form-group">
                <label for="sticker">URL del Sticker</label>
                <input type="url" name="sticker" class="form-control" value="<?php echo set_value('sticker', $alerta['sticker']); ?>" placeholder="https://example.com/sticker.png" required>
                <small class="form-text text-muted">Proporciona la URL completa de la imagen del sticker.</small>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Alerta</button>
            <a href="<?php echo site_url('alertas/index/' . $computadora['id']); ?>" class="btn btn-secondary">Cancelar</a>

        <?php echo form_close(); ?>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>
