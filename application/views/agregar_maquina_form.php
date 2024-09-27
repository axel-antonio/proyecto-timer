<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agregar Nuevo Espacio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1a1a1a 0%, #2c3e50 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #ecf0f1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            max-width: 500px;
            width: 100%;
            padding: 20px;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
        }
        .card-header {
            background-color: rgba(52, 152, 219, 0.8);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
        }
        .card-body {
            padding: 30px;
        }
        .form-label {
            color: #ecf0f1;
        }
        .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ecf0f1;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.2);
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .btn-secondary {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            color: #ecf0f1;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.3);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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