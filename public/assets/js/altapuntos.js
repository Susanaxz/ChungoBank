
function altaPuntos(cuentaId) {
    if (cuentaId) {
        $.ajax({
            url: "/alta_puntos/" + cuentaId,
            type: "PUT",
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function (response) {
                alert("Puntos dados con éxito");
                window.location.href = "alta-mto-puntos";
            },
            error: function (response) {
                
            },
        });
    } else {
        alert("No hay cuenta vinculada a esta persona");
    }
}