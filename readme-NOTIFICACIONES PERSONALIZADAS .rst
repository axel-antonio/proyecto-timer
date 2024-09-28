

Proyecto Cyber - Personalización de Notificaciones
Este documento describe los cambios e implementaciones realizados en el proyecto Proyecto Cyber para la gestión de notificaciones personalizadas. Las notificaciones se crean, gestionan y se muestran cuando el temporizador de una máquina llega a su finalización (campo parar_a). Estas notificaciones pueden incluir un mensaje personalizado y, opcionalmente, un sonido.


Estructura de la Base de Datos
Para implementar la funcionalidad de notificaciones personalizadas, se creó una nueva tabla en la base de datos llamada notificaciones_personalizadas. Esta tabla almacena las notificaciones asociadas a cada computadora, permitiendo definir un mensaje personalizado y un archivo de sonido opcional.
Campos principales:
ID de notificación: Identificador único de la notificación.
ID de la computadora: Relaciona la notificación con una computadora específica.
Mensaje: El mensaje que se mostrará al finalizar el tiempo.
Sonido: Archivo de sonido opcional que puede reproducirse cuando la notificación aparece.


Controlador Ciber.php
El controlador se actualizó para gestionar la creación, edicion y eliminación de notificaciones personalizadas. También se añadieron funciones que verifican si el temporizador de una computadora ha llegado a su fin y, en ese caso, muestran la notificación asociada.
Funcionalidades clave:
Agregar notificaciones: Permite al usuario crear una nueva notificación con mensaje y sonido opcional para una computadora específica.
Eliminar notificaciones: Se agregó la posibilidad de eliminar notificaciones previamente creadas.
Verificación del temporizador: El sistema verifica si el tiempo configurado en el campo parar_a ha llegado a su fin. Si es así, muestra la notificación correspondiente.

Modelo Ciber_model.php
El modelo fue modificado para incluir métodos que interactúan con la tabla de notificaciones personalizadas en la base de datos. Estos métodos permiten agregar nuevas notificaciones, recuperarlas para mostrarlas y eliminarlas cuando sea necesario.
Cambios realizados:
Se implementaron funciones para agregar, obtener y eliminar notificaciones.
Se integró la lógica para asociar las notificaciones a una computadora en particular.

Vistas
Vista principal ciber_view.php
En la vista principal, se añadió un botón que redirige al usuario a una pantalla donde puede gestionar las notificaciones personalizadas de cada computadora. Este cambio facilita el acceso a la funcionalidad de notificaciones.
Vista de notificaciones notificaciones_view.php
En esta nueva vista, se implementó un formulario que permite al usuario crear una notificación personalizada para cada computadora. Además, se muestra una lista de todas las notificaciones creadas, permitiendo gestionarlas (crear y eliminar).

Diseño de Interfaz
Se aplicó un diseño  directamente en la vista de gestión de notificaciones. Este diseño mejora la apariencia visual de la interfaz, haciéndola más moderna y agradable para el usuario. Las modificaciones incluyen:


Crear una Notificación:
El usuario puede ingresar un mensaje personalizado y, opcionalmente, un archivo de sonido que se reproducirá cuando el temporizador de la computadora llegue a su fin.

Eliminar O Editar una Notificación:
Las notificaciones existentes se muestran en una lista con un botón para editar  o eliminarlas   si ya no son necesarias.

Mostrar Notificación al Finalizar el Temporizador:
Cuando el tiempo establecido en el campo parar_a llega a su fin, se activa la notificación personalizada, mostrando el mensaje y reproduciendo el sonido configurado (si aplica).