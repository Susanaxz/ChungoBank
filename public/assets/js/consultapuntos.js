function consultaPuntos() {
    var idPersona = document.getElementById('persona_id').value;


    fetch('/alta-mto-puntos/consulta-puntos/' + idPersona)
        .then(function (respuesta) {
            return respuesta.json();
        }
    )
        .then(function(data) {
            if (data.codigo == '00') {
                // Actualizar la interfaz de usuario con los datos de la cuenta
                document.getElementById('id').value = data.respuesta.id;
                document.getElementById('descripcion').value = data.respuesta.descripcion;
                // Habilita los botones
                document.querySelector('#modifpuntos').removeAttribute('disabled');
                document.querySelector('#bajapuntos').removeAttribute('disabled');
                document.querySelector('#movimientos').removeAttribute('disabled');
                // Desactiva el botón de alta
                document.querySelector('#altapuntos').setAttribute('disabled', true);
            } else {
                // Manejar el error
                document.getElementById('id').value = '';
                document.getElementById('descripcion').value = '';
                // Deshabilita los botones
                document.querySelector('#modifpuntos').setAttribute('disabled', true);
                document.querySelector('#bajapuntos').setAttribute('disabled', true);
                document.querySelector('#movimientos').setAttribute('disabled', true);
                // Activa el botón de alta
                document.querySelector('#altapuntos').removeAttribute('disabled');
            }
        }
    )
        .catch(function (error) {
            console.error(error);
        }
    );
}