<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Control de Ciber</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

    
    <style>
        :root {
            --primary-color: #1e2a38;
            --secondary-color: #1e40af;
            --accent-color: #22d3ee;
            --background-color: #0f172a;
            --card-bg-color: #1e293b;
            --text-color: #e2e8f0;
            --button-text-color: #ffffff;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
        }


          /* Agrega esto al final de tu bloque de estilo en el <head> */
    .btn.eliminar {
        display: none;
    }
        .sidebar {
            background-color: var(--primary-color);
            min-height: 100vh;
            padding-top: 20px;
        }

        .content {
            padding: 20px;
        }

        .card {
            background-color: var(--card-bg-color);
            border: none;
            border-radius: 25px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
           
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }

        .card-header {
            background-color: var(--secondary-color);
            color: var(--text-color);
            border-bottom: none;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            border-radius: 15px 15px 0 0; /* Redondea la parte superior de la tarjeta */
        }

        

        .btn {
            border-radius: 20px;
            padding: 5px 10px;
            font-size: 0.8rem;
            font-weight: bold;
            text-transform: uppercase;
            transition: all 0.3s ease;
            color: var(--button-text-color);
        }

        .btn-success { background-color: #003d6b; border-color: #003d6b; }
        .btn-danger { background-color: #002f4b; border-color: #002f4b; }
        .btn-warning { background-color: #001a33; border-color: #001a33; }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }

        .status-active { background-color: #10b981; }
        .status-inactive { background-color: #ef4444; }

        .contador {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin: 10px 0;
            color: var(--accent-color);
        }

        .computer-icon {
            font-size: 3rem;
            color: var(--accent-color);
            margin-bottom: 15px;
        }

        #controlador-title {
    font-family: 'Poppins', sans-serif; /* Usa la fuente llamativa */
    text-align: center;                /* Alineación centrada */
    color: #ffffff;                    /* Color blanco para un buen contraste */
    font-size: 4rem;                   /* Tamaño de fuente más grande */
    font-weight: 700;                  /* Fuente en negrita */
    margin-bottom: 40px;               /* Espacio debajo del título */
    text-transform: uppercase;         /* Texto en mayúsculas */
    letter-spacing: 6px;               /* Espaciado entre letras */
    background: linear-gradient(135deg, #003366, #3366cc); /* Degradado de fondo */
    -webkit-background-clip: text;     /* Fondo se aplica al texto */
    background-clip: text;             /* Fondo se aplica al texto */
    color: transparent;                /* Color del texto transparente para mostrar el degradado */
    text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.5); /* Sombra de texto pronunciada */
}

        .form-control {
            background-color: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            color: var(--text-color);
        }

        .form-control:focus {
            background-color: rgba(255,255,255,0.2);
            border-color: var(--accent-color);
            color: var(--text-color);
            box-shadow: 0 0 0 0.2rem rgba(34, 211, 238, 0.25);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="#">
                                <i class="fas fa-desktop me-2"></i>
                                Control de Ciber
                            </a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link btn btn-info text-white" href="<?= base_url('index.php/Ciber/agregar_maquina_form') ?>">
                                <i class="fas fa-plus-circle me-2"></i>
                                Agregar Máquina
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="mt-3">
    <select id="maquina-a-eliminar" class="form-select mb-2">
        <option value="">Seleccione una máquina para eliminar</option>
        <?php foreach ($computadoras as $pc): ?>
            <option value="<?= $pc['id'] ?>"><?= $pc['nombre'] ?></option>
        <?php endforeach; ?>
    </select>
    <button id="eliminar-maquina-btn" class="btn btn-danger w-100"><i class="fas fa-trash me-2"></i>Eliminar Máquina</button>
</div>
            </nav>

            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
                <h1 id="controlador-title">Controlador</h1>

                <div class="row">
                    <?php foreach ($computadoras as $pc): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card" data-id="<?= $pc['id'] ?>">
                            <div class="card-header">
                                <h5 class="mb-0"><?= $pc['nombre'] ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="fas fa-desktop computer-icon"></i>
                                </div>
                                <p class="text-center"><strong>Inicio:</strong> <span class="inicio"><?= $pc['inicio'] ? date('H:i:s', strtotime($pc['inicio'])) : '00:00:00' ?></span></p>
                                <div class="contador"><?= $pc['contador'] ? $pc['contador'] : '00:00:00' ?></div>
                                <p class="text-center">
                                    <span class="status-indicator <?= $pc['estado'] == 'en uso' ? 'status-active' : 'status-inactive' ?>"></span>
                                    <span class="estado"><?= $pc['estado'] ?></span>
                                </p>
                                <div class="mb-3">
                                    <label><strong>Parar a (min):</strong></label>
                                    <input type="number" class="form-control form-control-sm parar-a" value="<?= $pc['parar_a'] ?>" min="1" placeholder="Min">
                                </div>
                                <div class="mb-3">
                                    <label><strong>Nota:</strong></label>
                                    <input type="text" class="form-control form-control-sm nota" value="<?= $pc['nota'] ?>" placeholder="Nota">
                                </div>
                                <div class="mb-3">
                                    <label><strong>Mensaje:</strong></label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control mensaje" value="<?= $pc['mensaje'] ?>" placeholder="Mensaje">
                                        <button class="btn btn-outline-secondary enviar-mensaje" type="button"><i class="fas fa-paper-plane"></i></button>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <button class="btn btn-sm btn-success iniciar"><i class="fas fa-play me-1"></i>Iniciar</button>
                                    <button class="btn btn-sm btn-danger finalizar"><i class="fas fa-stop me-1"></i>Finalizar</button>
                                    <button class="btn btn-sm btn-warning eliminar"><i class="fas fa-trash me-1"></i>Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </main>
        </div>
    </div>
<!-- Contenedor de alerta para mostrar mensajes -->
<div id="alert-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.8); z-index: 1000;">
    <div id="alert-message" style="color: white; font-size: 2rem; text-align: center; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></div>
    <button id="alert-close" style="position: absolute; top: 10%; right: 10%; padding: 10px; background-color: red; color: white;">Cerrar</button>
</div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var base_url = "<?= base_url(); ?>";
    </script>
    <script src="<?= base_url('assets/js/ciber.js') ?>"></script>
</body>
</html>