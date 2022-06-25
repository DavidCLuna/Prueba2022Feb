$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    //Código que se ejecutará al cargar la página
    getData()
});

$("#btn_agregar").click(function(event) {

    // disabled the submit button
    $("#btn_agregar").prop("disabled", true);

    event.preventDefault();

    // valida todos los campos del formulario
    if (!validate_form('')) {
        $("#btn_agregar").prop("disabled", false);
        return
    }

    var form = $('#form_agregar')[0];
    var data = new FormData(form);

    $.ajax({
        url: '/api/gce_caracteristicas',
        enctype: 'multipart/form-data',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        success: function(response) {
            $("#btn_agregar").prop("disabled", false);
            clear_form('')
            toastr.success('Registro agregado con éxito');
            getData()
        },
        statusCode: {
            404: function() {
                toastr.error('web not found')
            }
        },
        error: function(x, xs, xt) {
            //nos dara el error si es que hay alguno
            // window.open(JSON.stringify(x));
            $("#btnSubmit").prop("disabled", false);
            toastr.error('error: ' + JSON.stringify(x) + "\n error string: " + xs + "\n error throwed: " + xt);
        }
    });
    $("#btnSubmit").prop("disabled", false);
});

// función para eliminar registro de la bd
function eliminar_registro(id) {

    $("#btn_delete").prop("disabled", true);

    let data = []
    data.push({ "id": id });

    $.ajax({
        url: `/api/gce_caracteristicas/${id}`,
        enctype: 'multipart/form-data',
        data: data,
        type: 'DELETE',
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        success: function(response) {
            assignDataTable(response)
            $("#btn_delete").prop("disabled", false);
            toastr.success('Registro eliminado con éxito');
            getData()
        },
        statusCode: {
            404: function() {
                toastr.error('web not found');
            }
        },
        error: function(x, xs, xt) {
            //nos dara el error si es que hay alguno
            // window.open(JSON.stringify(x));
            $("#btn_delete").prop("disabled", false);
            toastr.error('error: ' + JSON.stringify(x) + "\n error string: " + xs + "\n error throwed: " + xt);
        }
    });
}

// función que consulta la información del registro a actualizar
function show_update_registro(id) {
    $("#ModalUpdate").modal("show")

    $.ajax({
        url: `/api/gce_caracteristicas/${id}`,
        type: 'get',
        success: function(response) {
            clear_form('_update')
            assign_data_update(response)
        },
        statusCode: {
            404: function() {
                toastr.error('web not found');
            }
        },
        error: function(x, xs, xt) {
            //nos dara el error si es que hay alguno
            //window.open(JSON.stringify(x));
            toastr.error('error: ' + JSON.stringify(x) + "\n error string: " + xs + "\n error throwed: " + xt);
        }
    });
}

// función para asignar datos a formulario a editar
function assign_data_update(response) {
    $('#id_update').val(response['id'])
    $(`#gce_nombre_equipo_update`).val(response['gce_nombre_equipo'])
    $(`#gce_board_update`).val(response['gce_board'])
    $(`#gce_case_update`).val(response['gce_case'])
    $(`#gce_procesador_update`).val(response['gce_procesador'])
    $(`#gce_grafica_update`).val(response['gce_grafica'])
    $(`#gce_ram_update`).val(response['gce_ram'])
    $(`#gce_disco_duro_update`).val(response['gce_disco_duro'])
    $(`#gce_teclado_update`).val(response['gce_teclado'])
    $(`#gce_mouse_update`).val(response['gce_mouse'])
    $(`#gce_pantalla_update`).val(response['gce_pantalla'])
    $(`#gce_estado_update`).val(response['gce_estado'])
}

$("#btn_update").click(function(event) {

    // disabled the submit button
    $("#btn_update").prop("disabled", true);

    event.preventDefault();

    // valida todos los campos del formulario
    if (!validate_form('_update')) {
        $("#btn_update").prop("disabled", false);
        return
    }

    var form = $('#form_update')[0];
    var data = new FormData(form);

    data.append('_method', 'PUT')
    let id = $('#id_update').val()

    $.ajax({
        url: `/api/gce_caracteristicas/${id}`,
        enctype: 'multipart/form-data',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        success: function(response) {
            $("#btn_update").prop("disabled", false);
            $("#ModalUpdate").modal("hide")
            toastr.success('Registro modificado con éxito');
            getData()
        },
        statusCode: {
            404: function() {
                toastr.error('web not found');
            }
        },
        error: function(x, xs, xt) {
            //nos dara el error si es que hay alguno
            // window.open(JSON.stringify(x));
            $("#btnSubmit").prop("disabled", false);
            toastr.error('error: ' + JSON.stringify(x) + "\n error string: " + xs + "\n error throwed: " + xt);
        }
    });
    $("#btnSubmit").prop("disabled", false);

})

// funcion que obtiene todos los registros y los asigna a la tabla
function getData() {

    $.ajax({
        url: '/api/gce_caracteristicas',
        type: 'get',
        success: function(response) {
            assignDataTable(response)
        },
        statusCode: {
            404: function() {
                toastr.error('web not found');
            }
        },
        error: function(x, xs, xt) {
            //nos dara el error si es que hay alguno
            //window.open(JSON.stringify(x));
            toastr.error('error: ' + JSON.stringify(x) + "\n error string: " + xs + "\n error throwed: " + xt);
        }
    });
}

function assignDataTable(response) {

    $('#tbody_table').empty()

    $.each(response.data, (index, value) => {

        let clase_estado = (value['gce_estado'] == 1 ? "align-middle" : "bg-red text-light align-middle")
        let check_estado = (value['gce_estado'] == 1 ? "checked" : "")

        $('#tbody_table').append(
            `<tr class="${clase_estado}">` +
            `<td>${value['gce_nombre_equipo']}</td>` +
            `<td>${value['gce_board']}` +
            `<td>${value['gce_case']}</td>` +
            `<td>${value['gce_procesador']}</td>` +
            `<td>${value['gce_grafica']}</td>` +
            `<td>${value['gce_ram']}</td>` +
            `<td>${value['gce_disco_duro']}</td>` +
            `<td>${value['gce_teclado']}</td>` +
            `<td>${value['gce_mouse']}</td>` +
            `<td>${value['gce_pantalla']}</td>` +
            `<td class="align-middle"><div class="form-check form-switch toggle-switch d-flex justify-content-center "><input ${check_estado} disabled class="form-check-input opacity-1" type="checkbox" id="toggleSwitch1"></div></td>` +
            `<td class="text-center"><button class="btn btn-circle btn-circle-sm m-1" onclick="show_update_registro('${value['id']}')"><i class="fa fa-pencil" style="color: #29628D"></i></button><button id="btn_delete" class="btn btn-circle btn-circle-sm m-1" onclick="eliminar_registro('${value['id']}')"><i class="fa fa-trash" style="color: #FF4269"></i></button></td>` +
            `</tr`)
    });

}

function validate_form(type) {

    let status = true

    if ($(`#gce_nombre_equipo${type}`).length == 0 || $(`#gce_nombre_equipo${type}`).val() == "") {
        toastr.error('Error, falta ingresar el nombre del equipo')
        status = false
    }
    if ($(`#gce_board${type}`).length == 0 || $(`#gce_board${type}`).val() == "") {
        toastr.error('Error, falta ingresar el nombre de la board')
        status = false
    }
    if ($(`#gce_case${type}`).length == 0 || $(`#gce_case${type}`).val() == "") {
        toastr.error('Error, falta ingresar el nombre del case')
        status = false
    }
    if ($(`#gce_procesador${type}`).length == 0 || $(`#gce_procesador${type}`).val() == "") {
        toastr.error('Error, falta ingresar el nombre del procesador')
        status = false
    }
    if ($(`#gce_grafica${type}`).length == 0 || $(`#gce_grafica${type}`).val() == "") {
        toastr.error('Error, falta ingresar el nombre de la gráfica')
        status = false
    }
    if ($(`#gce_ram${type}`).length == 0 || $(`#gce_ram${type}`).val() == "") {
        toastr.error('Error, falta ingresar la cantidad de memoria ram')
        status = false
    }
    if ($(`#gce_ram${type}`).length == 0 || $(`#gce_ram${type}`).val() > 100) {
        toastr.error('Error, la cantidad máxima de memoria que se puede agregar es 100')
        status = false
    }
    if ($(`#gce_disco_duro${type}`).length == 0 || $(`#gce_disco_duro${type}`).val() == "") {
        toastr.error('Error, falta ingresar el nombre del disco duro')
        status = false
    }
    if ($(`#gce_teclado${type}`).length == 0 || $(`#gce_teclado${type}`).val() == "") {
        toastr.error('Error, falta ingresar la marca del teclado')
        status = false
    }
    if ($(`#gce_mouse${type}`).length == 0 || $(`#gce_mouse${type}`).val() == "") {
        toastr.error('Error, falta ingresar la marca del mouse')
        status = false
    }
    if ($(`#gce_pantalla${type}`).length == 0 || $(`#gce_pantalla${type}`).val() == "") {
        toastr.error('Error, falta ingresar las pulgadas de la pantalla')
        status = false
    }
    if ($(`#gce_pantalla${type}`).length == 0 || $(`#gce_pantalla${type}`).val() > 100) {
        toastr.error('Error, la cantidad máxima de pulgadas que se puede agregar es 100')
        status = false
    }

    return status
}

function clear_form(type) {
    $(`#gce_nombre_equipo${type}`).val('')
    $(`#gce_board${type}`).val('')
    $(`#gce_case${type}`).val('')
    $(`#gce_procesador${type}`).val('')
    $(`#gce_grafica${type}`).val('')
    $(`#gce_ram${type}`).val('')
    $(`#gce_disco_duro${type}`).val('')
    $(`#gce_teclado${type}`).val('')
    $(`#gce_mouse${type}`).val('')
    $(`#gce_pantalla${type}`).val('')
}