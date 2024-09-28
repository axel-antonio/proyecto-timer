console.log('Base URL:', base_url);

$(document).ready(function() {
    var sessionStartTimes = {};
    var sessionTimers = {};
    var alertSound = new Audio(base_url + 'assets/audio/alert_sound.mp3');

    // Verificar si el audio se carga correctamente.
    alertSound.addEventListener('canplaythrough', function() {
        console.log('El sonido se cargó correctamente.');
    });

    alertSound.addEventListener('error', function(e) {
        console.log('Error al cargar el sonido:', e);
    });

    console.log('Ruta del sonido:', base_url + 'assets/audio/alert_sound.mp3');

    function showAlert(message, icon = 'warning') {
        Swal.fire({
            title: 'Alerta',
            text: message,
            icon: icon,
            confirmButtonText: 'Entendido',
            background: '#1e293b',
            color: '#e2e8f0',
            confirmButtonColor: '#3498db',
            customClass: {
                popup: 'swal-custom-popup',
                title: 'swal-custom-title',
                content: 'swal-custom-content',
                confirmButton: 'swal-custom-confirm'
            }
        });
    }

    function playAlertSound() {
        try {
            alertSound.currentTime = 0;
            alertSound.play().then(() => {
                console.log('El sonido se está reproduciendo.');
            }).catch(function(error) {
                console.log('Error al reproducir el audio:', error);
            });
        } catch (e) {
            console.log('Error al intentar reproducir el sonido:', e);
        }
    }

    // Botón de prueba para reproducir el sonido manualmente
    $('body').append('<button id="prueba-sonido" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">Probar Sonido</button>');
    $('#prueba-sonido').click(function() {
        playAlertSound();
    });

    function actualizarContadores() {
        $('.card').each(function() {
            var card = $(this);
            var id = card.data('id');

            if (sessionStartTimes[id]) {
                var ahora = new Date();
                var inicio = sessionStartTimes[id];
                var diferencia = Math.floor((ahora - inicio) / 1000);

                var horas = Math.floor(diferencia / 3600);
                var minutos = Math.floor((diferencia % 3600) / 60);
                var segundos = diferencia % 60;

                var tiempoTranscurrido = 
                    horas.toString().padStart(2, '0') + ':' +
                    minutos.toString().padStart(2, '0') + ':' +
                    segundos.toString().padStart(2, '0');

                card.find('.contador').text(tiempoTranscurrido);

                var pararA = parseInt(card.find('.parar-a').val());
                if (pararA && (minutos >= pararA)) {
                    finalizarSesion(id, card);
                    mostrarNotificacionPersonalizada(id, card);
                }
            }
        });
    }

    function mostrarNotificacionPersonalizada(id, card) {
        $.get(base_url + 'index.php/Ciber/obtener_notificacion_personalizada/' + id, function(response) {
            console.log('Respuesta del servidor:', response);
            if (response.success && response.notificacion) {
                Swal.fire({
                    title: 'Tiempo Agotado',
                    html: response.notificacion.mensaje,
                    icon: 'warning',
                    confirmButtonText: 'Entendido',
                    background: '#1e293b',
                    color: '#e2e8f0',
                    confirmButtonColor: '#3498db',
                    customClass: {
                        popup: 'swal-custom-popup',
                        title: 'swal-custom-title',
                        content: 'swal-custom-content',
                        confirmButton: 'swal-custom-confirm'
                    }
                });

                if (response.notificacion.reproducir_sonido) {
                    playAlertSound();
                }
            } else {
                // Si no hay notificación personalizada, mostrar la predeterminada
                Swal.fire({
                    title: 'Tiempo Agotado',
                    html: 'Tu tiempo ha terminado en ' + card.find('.card-header h5').text(),
                    icon: 'warning',
                    confirmButtonText: 'Entendido',
                    background: '#1e293b',
                    color: '#e2e8f0',
                    confirmButtonColor: '#3498db',
                    customClass: {
                        popup: 'swal-custom-popup',
                        title: 'swal-custom-title',
                        content: 'swal-custom-content',
                        confirmButton: 'swal-custom-confirm'
                    }
                });
                playAlertSound();
            }
        }, 'json').fail(function() {
            showAlert('Error al obtener la notificación personalizada.', 'error');
        });
    }

    function iniciarSesion(id, card) {
        var ahora = new Date();
        var pararA = card.find('.parar-a').val();

        $.post(base_url + 'index.php/Ciber/iniciar_sesion', {id: id, parar_a: pararA}, function(response) {
            if (response.success) {
                card.find('.status-indicator').removeClass('status-inactive').addClass('status-active');
                card.find('.estado').text('en uso');
                card.find('.inicio').text(ahora.toLocaleTimeString());
                sessionStartTimes[id] = ahora;
                card.find('.contador').text('00:00:00');
                sessionTimers[id] = setInterval(actualizarContadores, 1000);
                card.find('.iniciar').prop('disabled', true);
                card.find('.finalizar').prop('disabled', false);
            } else {
                showAlert('Error al iniciar sesión.', 'error');
            }
        }, 'json').fail(function() {
            showAlert('Error de comunicación con el servidor.', 'error');
        });
    }

    function finalizarSesion(id, card) {
        $.post(base_url + 'index.php/Ciber/finalizar_sesion', {id: id}, function(response) {
            if (response.success) {
                card.find('.status-indicator').removeClass('status-active').addClass('status-inactive');
                card.find('.estado').text('sin usar');
                card.find('.inicio').text('');
                card.find('.contador').text('00:00:00');
                card.find('.nota').val('');
                clearInterval(sessionTimers[id]);
                delete sessionStartTimes[id];
                delete sessionTimers[id];
                card.find('.iniciar').prop('disabled', false);
                card.find('.finalizar').prop('disabled', true);
            } else {
                showAlert('Error al finalizar sesión.', 'error');
            }
        }, 'json').fail(function() {
            showAlert('Error de comunicación con el servidor.', 'error');
        });
    }

    function eliminarMaquina(id) {
        Swal.fire({
            title: '¿Está seguro?',
            text: "¿Desea eliminar esta máquina?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            background: '#1e293b',
            color: '#e2e8f0',
        }).then((result) => {
            if (result.isConfirmed) {
                playAlertSound();
                $.post(base_url + 'index.php/Ciber/eliminar_maquina', {id: id}, function(response) {
                    console.log('Respuesta del servidor:', response);
                    if (response.success) {
                        showAlert('Máquina eliminada correctamente.', 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        showAlert('Error al eliminar la máquina.', 'error');
                    }
                }, 'json').fail(function() {
                    showAlert('Error de comunicación con el servidor.', 'error');
                });
            }
        });
    }

    $('.eliminar').click(function() {
        var card = $(this).closest('.card');
        var id = card.data('id');
        eliminarMaquina(id);
    });

    $('#eliminar-maquina-btn').click(function() {
        var maquinaId = $('#maquina-a-eliminar').val();
    
        if (!maquinaId) {
            showAlert('Por favor, seleccione una máquina para eliminar.', 'warning');
            return;
        }

        eliminarMaquina(maquinaId);
    });

    $('.iniciar').click(function() {
        var card = $(this).closest('.card');
        var id = card.data('id');
        iniciarSesion(id, card);
    });

    $('.finalizar').click(function() {
        var card = $(this).closest('.card');
        var id = card.data('id');
        finalizarSesion(id, card);
    });

    $('.enviar-mensaje').click(function() {
        var card = $(this).closest('.card');
        var id = card.data('id');
        var nota = card.find('.nota').val();
        var mensaje = card.find('.mensaje').val();
        
        $.post(base_url + 'index.php/Ciber/actualizar_nota_mensaje', {id: id, nota: nota, mensaje: mensaje}, function(response) {
            if (response.success) {
                showAlert('Mensaje enviado correctamente.', 'success');
                card.find('.mensaje').val('');
            } else {
                showAlert('Error al actualizar nota y mensaje.', 'error');
            }
        }, 'json').fail(function() {
            showAlert('Error de comunicación con el servidor.', 'error');
        });
    });

    $('#agregar-maquina-form').submit(function(e) {
        e.preventDefault();
        var nombre = $('#nombre-maquina').val();

        $.post(base_url + 'index.php/Ciber/agregar_maquina', {nombre: nombre}, function(response) {
            if (response.success) {
                showAlert('Máquina agregada correctamente.', 'success');
                location.reload();
            } else {
                showAlert('Error al agregar la máquina.', 'error');
            }
        }, 'json').fail(function() {
            showAlert('Error de comunicación con el servidor.', 'error');
        });
    });

    $('.card').each(function() {
        var card = $(this);
        if (card.find('.estado').text().trim() === 'en uso') {
            card.find('.iniciar').prop('disabled', true);
            card.find('.finalizar').prop('disabled', false);
            var inicio = new Date(card.find('.inicio').text());
            var id = card.data('id');
            sessionStartTimes[id] = inicio;
            sessionTimers[id] = setInterval(actualizarContadores, 1000);
        } else {
            card.find('.iniciar').prop('disabled', false);
            card.find('.finalizar').prop('disabled', true);
        }
    });

    function animateMachineNames() {
        $('.card-header h5').each(function() {
            $(this).css('transform', 'scale(1.05)');
            setTimeout(() => {
                $(this).css('transform', 'scale(1)');
            }, 500);
        });
    }
    
    // Animar los nombres de las máquinas cada 5 segundos
    setInterval(animateMachineNames, 5000);

    // New code for clock and date
    function updateClockAndDate() {
        const now = new Date();
        const clockElement = document.getElementById('clock');
        const dateElement = document.getElementById('date');
        
        if (clockElement && dateElement) {
            clockElement.textContent = now.toLocaleTimeString();
            dateElement.textContent = now.toLocaleDateString();
        }
    }

    // Update clock and date every second
    setInterval(updateClockAndDate, 1000);
    
    // Initial call to set the time immediately
    updateClockAndDate();

    // Animate the title
    function animateTitle() {
        const title = document.getElementById('controlador-title');
        if (title) {
            title.style.transform = 'scale(1.05)';
            setTimeout(() => {
                title.style.transform = 'scale(1)';
            }, 500);
        }
    }

    // Animate title every 5 seconds
    setInterval(animateTitle, 5000);

    // Iniciar los contadores para las sesiones en curso
    actualizarContadores();
    setInterval(actualizarContadores, 1000);
});