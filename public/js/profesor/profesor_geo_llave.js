$(document).ready(function () {
    // Punto de referencia en coordenadas decimales PARA LA OFICIONA DE COORDINACION
    const latReferencia = 9.879722;
    const lngReferencia = -83.923306;
    const distanciaPermitida = 200;

    function verificarDistancia() {

        // PIDIENDO PERMISO
        let geo_permission_state = null;

        if ("geolocation" in navigator) {
            navigator.permissions.query({ name: "geolocation" }).then(function (permissionStatus) {
                geo_permission_state = permissionStatus.state;

                if (permissionStatus.state === "prompt") {
                    $('#activate_location_modal').modal('show');
                }
                permissionStatus.onchange = function () {
                    $('#activate_location_modal').modal('hide');
                    geo_permission_state = permissionStatus.state;
                };
            });
        } else {
            // Si el navegador no soporta geolocalización
            alert("La geolocalización no es compatible con este navegador, verifique que el dispositivo este conectado a internet.");
            location.href = 'profesor';
        }

        // YA TENIENDO PERMISO (ADMITIDO O DENEGADO)
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {

                    // console.log(geo_permission_state)

                    const latUsuario = position.coords.latitude;
                    const lngUsuario = position.coords.longitude;

                    // console.log("Latitud del usuario:", latUsuario);
                    // console.log("Longitud del usuario:", lngUsuario);

                    const distancia = calcularDistancia(latReferencia, lngReferencia, latUsuario, lngUsuario);

                    // console.log("Distancia calculada en metros:", distancia);

                    if (distancia <= distanciaPermitida) {
                        // alert("Estás dentro del radio");
                        // $.ajax({
                        //     url: location.href,
                        //     type: 'POST',
                        //     data: { action_type: 'activate_key_action', geo_permission_state: geo_permission_state },
                        //     success: function (response) {
                        //         $('#main_content').html(response);
                        //     },
                        //     error: function (error) {
                        //         console.log('fac');
                        //     }
                        // });
                    } else {
                        const distanciaFaltante = (distancia - distanciaPermitida).toFixed(0); // Distancia faltante en metros
                        alert(`Usted se encuentra fuera del área de gestión de llaves permitida (Oficina de Coordinación).\n\nLe faltan ${distanciaFaltante} metros para acceder a esta ubicación.`);
                        location.href = 'profesor';
                    }
                },
                (error) => {
                    // Manejo de errores de geolocalización
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            console.error("Permiso denegado por el usuario para acceder a la geolocalización.");
                            $('#no_location').modal('show');
                            break;
                        case error.POSITION_UNAVAILABLE:
                            console.error("La información de ubicación no está disponible.");
                            alert("No se pudo obtener la ubicación. Inténtalo de nuevo más tarde.");
                            location.href = 'profesor';
                            break;
                        case error.TIMEOUT:
                            console.error("La solicitud de geolocalización ha caducado.");
                            alert("La solicitud de ubicación ha tardado demasiado. Inténtalo de nuevo.");
                            location.href = 'profesor';
                            break;
                        default:
                            console.error("Error desconocido al obtener la ubicación:", error.message);
                            alert("Ocurrió un error al obtener la ubicación.");
                            location.href = 'profesor';
                            break;
                    }
                }
            );
        } else {
            // console.error("La geolocalización no está soportada en este navegador.");
            alert("La geolocalización no está soportada en este navegador.");
            location.href = 'profesor';
        }
    }

    // Función para calcular la distancia entre dos puntos en metros usando la fórmula de Haversine
    function calcularDistancia(lat1, lon1, lat2, lon2) {
        const R = 6371000; // Radio de la Tierra en metros
        const dLat = (lat2 - lat1) * (Math.PI / 180);
        const dLon = (lon2 - lon1) * (Math.PI / 180);

        const a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(lat1 * (Math.PI / 180)) * Math.cos(lat2 * (Math.PI / 180)) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);

        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        const distancia = R * c; // Distancia en metros
        // console.log("Distancia calculada entre referencia y usuario:", distancia);
        return distancia;
    }

    verificarDistancia();
});