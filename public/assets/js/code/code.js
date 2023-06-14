$(function () {

    $(document).on("click", "#delete", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Eliminar",
            text: "¿Desea eliminar la data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, Eliminar!!",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
                Swal.fire(
                    "Eliminado!",
                    "El registro ha sido eliminado.",
                    "success"
                );
            }
        });
    });

    $(document).on("click", "#enable_user", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Habilitar Cliente",
            text: "¿Desea habilitar al cliente?",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, Habilitar!!",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
                Swal.fire(
                    "Habilitado!",
                    "El usuario ha sido habilitado.",
                    "success"
                );
            }
        });
    });

    $(document).on("click", "#disable_user", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Deshabilitar Cliente",
            text: "¿Desea deshabilitar al cliente?",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, Deshabilitar!!",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
                Swal.fire(
                    "Deshabilitado!",
                    "El usuario ha sido deshabilitado.",
                    "success"
                );
            }
        });
    });

    $(document).on("click", "#close_comment", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: "Cerrar Comentario",
            text: "¿Desea cerrar los comentarios?",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, Cerrar!!",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
                Swal.fire(
                    "Cerrado!",
                    "Los comentarios han sido revisados.",
                    "success"
                );
            }
        });
    });

});
