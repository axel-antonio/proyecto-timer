<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agregar Nueva Máquina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ecf0f1;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 500px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .card-header {
            background-color: #3498db;
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
        }
        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
        }
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Agregar Nueva Máquina</h3>
            </div>
            <div class="card-body">
                <form id="agregar-maquina-form">
                    <div class="mb-3">
                        <label for="nombre-maquina" class="form-label">Nombre de la máquina</label>
                        <input type="text" id="nombre-maquina" class="form-control" placeholder="Ingrese el nombre de la máquina" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-plus me-2"></i>Agregar Máquina</button>
                </form>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="<?= base_url('index.php/Ciber') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al Control de Ciber</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var base_url = "<?= base_url(); ?>";
        
        $(document).ready(function() {
            $('#agregar-maquina-form').submit(function(e) {
                e.preventDefault();
                var nombre = $('#nombre-maquina').val();

                $.post(base_url + 'index.php/Ciber/agregar_maquina', {nombre: nombre}, function(response) {
                    if (response.success) {
                        alert('Máquina agregada correctamente.');
                        window.location.href = base_url + 'index.php/Ciber';
                    } else {
                        alert('Error al agregar la máquina.');
                    }
                }, 'json').fail(function() {
                    alert('Error de comunicación con el servidor.');
                });
            });
        });
    </script>
</body>
</html>