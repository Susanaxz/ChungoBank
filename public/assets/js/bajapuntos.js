$(document).ready(function () {
    $("#bajapuntos").click(function () {
        var cuentaId = $(this).data("id");
        console.log(cuentaId);

        if (cuentaId) {
            var confirmation = confirm(
                "¿Estás seguro de que quieres eliminar esta persona y su cuenta?"
            );
            if (confirmation) {
                $.ajax({
                    url: "/destroy/" + cuentaId,
                    type: "DELETE",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function (response) {
                        if (response.codigo == "00") {
                            alert(response.respuesta[0]);
                            window.location.href = "/gestion";
                        } else {
                            alert(response.respuesta[0]);
                        }
                    },
                    error: function (response) {
                        alert("Error al eliminar persona y cuenta");
                    },
                });
            }
        } else {
            alert("No hay cuenta vinculada a esta persona");
        }
    });
});
