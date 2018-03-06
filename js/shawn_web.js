$(document).ready(function () {
    $(document).ajaxStart(function () {
        $("#wait").css("display", "block");
    });

    $(document).ajaxComplete(function () {
        $("#wait").css("display", "none");
    });

    $('#selected_preset_name').on('change paste keyup', function () {
        if ($(this).val().length >= 4) {
            $('#btn-save-user-preset')
                .attr('disabled', false)
                .removeClass('disabled');
        } else {
            $('#btn-save-user-preset')
                .attr('disabled', true)
                .addClass('disabled');
        }
    });

    $('#vis_configs_table').on('click', '.remove-tr', function (e) {
        $(this).closest('tr').remove()
    })

});

function compilar() {
    var select_option_id = $('#compil_proy_simul option:selected').attr('id');
    var proyecto_id = select_option_id.substr(select_option_id.indexOf("_") + 1);
    var url = ('href', location.protocol + '//' + window.location.host +
    '/modulos/simulacion/controlador/simulacion.class.php?compilar&proyecto_id=' + proyecto_id);
    $.ajax({
        url: url,
        type: "get",
        cache: false,
        error: function () {
            alert("Error al procesar la solicitud");
        },
        success: function (data) {
            $("#txa_copilar").empty().append(data);
        }
    });
}


function ejecutar_proyecto() {
    var select_option_id = '';
    var proyecto_id;
    select_option_id = $('#ejec_proy_simul option:selected').attr('id');
    var proyecto_id = select_option_id.substr(select_option_id.indexOf("_") + 1);
    var nombre_arch_conf = $('#ejec_arch_conf').val();
    var url = ('href', location.protocol + '//' + window.location.host + '/modulos/simulacion/controlador/simulacion.class.php?ejecutar&proyecto_id=' + proyecto_id + '&nombre_arch_conf=' + nombre_arch_conf);

    $.ajax({
        url: url,
        type: "get",
        cache: false,
        error: function () {
            alert("Error al procesar la solicitud");
        },
        success: function (data) {
            $("#txa_ejecutar").empty().append(data);
        }
    });
}

function cargar_datos_modif_proy(proyecto_id) {

    var url = ('href', location.protocol + '//' + window.location.host + '/modulos/proyectos/controlador/proyectos.class.php?cargar-datos-proy&proyecto_id=' + proyecto_id);

    $.ajax({
        url: url,
        type: "get",
        dataType: 'json',
        cache: false,
        error: function () {
            alert("Error al procesar la solicitud");
        },
        success: function (data) {
            $('#txt_nom_proy').val('');
            $('#txt_nom_proy').val(data.nombre);
            $('#txa_descrip').val('');
            $('#txa_descrip').val(data.descripcion);
            $('#txt_proyecto_id').val('');
            $('#txt_proyecto_id').val(proyecto_id);
        }
    });
}

function confirma_eliminar_proyecto(proyecto_id) {
    var url = ('href', location.protocol + '//' + window.location.host + '/modulos/proyectos/controlador/proyectos.class.php?eliminar-proyecto&proyecto_id=' + proyecto_id);
    var resultado = confirm("¿Confirma elminiar el proyecto?");
    if (resultado == true) {
        $.ajax({
            url: url,
            type: "get",
            cache: false,
            error: function () {
                alert("Error al procesar la solicitud");
            },
            success: function (data) {
                location.reload();
            }
        });

    } else {
        false;
    }

}

function cargarArchConf(dom_select_proy_id, dom_div_archivos_id, dom_select_archivo_conf_id) {
    var select_option_id = '';
    var proyecto_id;
    select_option_id = $('#' + dom_select_proy_id + ' option:selected').attr('id');
    var proyecto_id = select_option_id.substr(select_option_id.indexOf("_") + 1);
    $('#proyecto_id_ejecucion').val(proyecto_id);
    var url = ('href', location.protocol + '//' + window.location.host + '/modulos/simulacion/controlador/simulacion.class.php?cargar-archivo-conf&proyecto_id=' + proyecto_id + '&dom_select_archivo_conf_id=' + dom_select_archivo_conf_id);
    $.ajax({
        url: url,
        type: "get",
        cache: false,
        error: function () {
            alert("Error al procesar la solicitud");
        },
        success: function (data) {

            $("#" + dom_div_archivos_id).empty().append(data);
            //carga url para visualizar pdf generados en la salida
            crearUrlVisualizacion(proyecto_id)
            $('#count').val('');
            $('#count_anterior').val('');

            $('#range').val('');
            $('#range_anterior').val('');

            $('#rect_world_width').val('');
            $('#rect_world_width_anterior').val('');

            $('#rect_world_height').val('');
            $('#rect_world_height_anterior').val('');

            $('#seed').val('');
            $('#seed_anterior').val('');

            $('#max_iterations').val('');
            $('#max_iterations_anterior').val('');

            $('#modelo_borde').attr("disabled", "true");
            $('#modelo_borde').val('0');
            $('#modelo_borde_anterior').val('');

            $('#modelo_comunicacion').attr("disabled", "true");
            $('#modelo_comunicacion').val('0');
            $('#modelo_comunicacion_anterior').val('');

            $('#modelo_transmision').attr("disabled", "true");
            $('#modelo_transmision').val('0');
            $('#modelo_transmision_anterior').val('');

        }
    });

}

function crearUrlVisualizacion(proyecto_id) {

    var url_pdf = ('href', location.protocol + '//' + window.location.host + '/modulos/simulacion/controlador/simulacion.class.php?visualizar-proyecto&proyecto_id=' + proyecto_id);
    $('#link_salida_pdf').attr("href", url_pdf);
}

function cargarParamArchConf() {
    var select_option_id = '';
    var proyecto_id;
    select_option_id = $('#control_proy_simul option:selected').attr('id');
    var proyecto_id = select_option_id.substr(select_option_id.indexOf("_") + 1);
    var nombre_arch_conf = $('#control_archivo_conf').val();
    var url = ('href', location.protocol + '//' + window.location.host + '/modulos/simulacion/controlador/simulacion.class.php?cargar-param-arch-conf&proyecto_id=' + proyecto_id + '&nombre_arch_conf=' + nombre_arch_conf);
    $.ajax({
        url: url,
        type: "get",
        dataType: 'json',
        cache: false,
        error: function () {
            alert("Error al procesar la solicitud");
        },
        success: function (data) {
            $('#count').val('');
            $('#count').val(data.count);
            $('#count_anterior').val('');
            $('#count_anterior').val(data.count);

            $('#range').val('');
            $('#range').val(data.range);
            $('#range_anterior').val('');
            $('#range_anterior').val(data.range);

            $('#rect_world_width').val('');
            $('#rect_world_width').val(data.rect_world_width);
            $('#rect_world_width_anterior').val('');
            $('#rect_world_width_anterior').val(data.rect_world_width);

            $('#rect_world_height').val('');
            $('#rect_world_height').val(data.rect_world_height);
            $('#rect_world_height_anterior').val('');
            $('#rect_world_height_anterior').val(data.rect_world_height);

            $('#seed').val('');
            $('#seed').val(data.seed);
            $('#seed_anterior').val('');
            $('#seed_anterior').val(data.seed);

            $('#max_iterations').val('');
            $('#max_iterations').val(data.max_iterations);
            $('#max_iterations_anterior').val('');
            $('#max_iterations_anterior').val(data.max_iterations);

            $('#modelo_borde').removeAttr("disabled");
            $('#modelo_borde').val(data.edge_model);
            $('#modelo_borde_anterior').val('');
            $('#modelo_borde_anterior').val(data.edge_model);

            $('#modelo_comunicacion').removeAttr("disabled");
            $('#modelo_comunicacion').val(data.comm_model);
            $('#modelo_comunicacion_anterior').val('');
            $('#modelo_comunicacion_anterior').val(data.comm_model);

            $('#modelo_transmision').removeAttr("disabled");
            $('#modelo_transmision').val(data.transm_model);
            $('#modelo_transmision_anterior').val('');
            $('#modelo_transmision_anterior').val(data.transm_model);

        }
    });
}

function guardar_param_arch_conf() {
    var select_option_id = '';
    var proyecto_id;
    select_option_id = $('#control_proy_simul option:selected').attr('id');
    var proyecto_id = select_option_id.substr(select_option_id.indexOf("_") + 1);
    var nombre_arch_conf = $('#control_archivo_conf').val();

    var count = $('#count').val();
    var count_anterior = $('#count_anterior').val();

    var range = $('#range').val();
    var range_anterior = $('#range_anterior').val();

    var rect_world_width = $('#rect_world_width').val();
    var rect_world_width_anterior = $('#rect_world_width_anterior').val();

    var rect_world_height = $('#rect_world_height').val();
    var rect_world_height_anterior = $('#rect_world_height_anterior').val();

    var seed = $('#seed').val();
    var seed_anterior = $('#seed_anterior').val();

    var max_iterations = $('#max_iterations').val();
    var max_iterations_anterior = $('#max_iterations_anterior').val();

    var edge_model = $('#modelo_borde').val();
    var edge_model_anterior = $('#modelo_borde_anterior').val();

    var comm_model = $('#modelo_comunicacion').val();
    var comm_model_anterior = $('#modelo_comunicacion_anterior').val();

    var transm_model = $('#modelo_transmision').val();
    var transm_model_anterior = $('#modelo_transmision_anterior').val();

    var url = ('href', location.protocol + '//' + window.location.host +
    '/modulos/simulacion/controlador/simulacion.class.php?guardar-param-arch-conf&proyecto_id=' + proyecto_id +
    '&nombre_arch_conf=' + nombre_arch_conf + "&count=" + count +
    "&range=" + range + "&rect_world_width=" + rect_world_width + "&rect_world_height=" + rect_world_height +
    "&seed=" + seed + "&max_iterations=" + max_iterations + "&count_anterior=" + count_anterior + "&range_anterior=" + range_anterior +
    "&rect_world_width_anterior=" + rect_world_width_anterior + "&rect_world_height_anterior=" + rect_world_height_anterior +
    "&seed_anterior=" + seed_anterior + "&max_iterations_anterior=" + max_iterations_anterior +
    "&edge_model=" + edge_model + "&edge_model_anterior=" + edge_model_anterior +
    "&comm_model=" + comm_model + "&comm_model_anterior=" + comm_model_anterior +
    "&transm_model=" + transm_model + "&transm_model_anterior=" + transm_model_anterior);


    $.ajax({
        url: url,
        type: "get",
        dataType: 'json',
        cache: false,
        error: function () {
            alert("Error al procesar la solicitud");
        },
        success: function (data) {
            if (data.resul == true) {
                alert('Parámetros guardados correctamente');
                $('#count_anterior').val(count);
                $('#range_anterior').val(range);
                $('#rect_world_width_anterior').val(rect_world_width);
                $('#rect_world_height_anterior').val(rect_world_height);
                $('#seed_anterior').val(seed);
                $('#max_iterations_anterior').val(max_iterations);
                $('#modelo_borde_anterior').val(edge_model);
                $('#modelo_comunicacion_anterior').val(comm_model);
                $('#modelo_transmision_anterior').val(transm_model);

            } else {
                alert("Error al guardar los parámetros");
                cargarParamArchConf();
            }
        }
    });
}

/**
 * Funciones especificas para modulo de visualizacion
 */
function cargarArchConfVis() {
    var select_option_id = $('#vis_proy_simul option:selected').attr('id');

    var proyecto_id = select_option_id.substr(select_option_id.indexOf("_") + 1);

    $('#proyecto_id_ejecucion').val(proyecto_id);

    var url = ('href', location.protocol + '//' + window.location.host + '/modulos/simulacion/controlador/simulacion.class.php?cargar-archivo-conf-vis&proyecto_id=' + proyecto_id + '&dom_select_archivo_conf_id=vis_archivo_conf');

    $.ajax({
        url: url,
        type: "get",
        cache: false,
        error: function () {
            alert("Error al procesar la solicitud");
        },
        success: function (data) {

            $("#vis_archivos_conf_div").empty().append(data);

            crearUrlVisualizacion(proyecto_id);
        }
    });
}

function cargarParamArchConfVis() {
    var select_option_id = $('#vis_proy_simul option:selected').attr('id');

    var proyecto_id = select_option_id.substr(select_option_id.indexOf("_") + 1);

    var nombre_arch_conf = $('#vis_archivo_conf').val();

    var url = ('href', location.protocol + '//' + window.location.host + '/modulos/simulacion/controlador/simulacion.class.php?cargar-param-arch-conf&proyecto_id=' + proyecto_id + '&nombre_arch_conf=' + nombre_arch_conf);

    $.ajax({
        url: url,
        type: "get",
        dataType: 'json',
        cache: false,
        error: function () {
            alert("Error al procesar la solicitud");
        },
        success: function (data) {

            //todo: obtener presets de usuario para el proyecto+archivo en cuestion y mostrar en tabla


        }
    });
}

function cargarCamposPreset() {
    var preset_id = $('#vis_preset option:selected').val();

    if (preset_id !== 'default') {
        var url = ('href', location.protocol + '//' + window.location.host + '/modulos/simulacion/controlador/simulacion.class.php?cargar-preset&preset_id=' + preset_id);

        $.ajax({
            url: url,
            type: "get",
            dataType: 'json',
            cache: false,
            error: function () {
                alert("Error al procesar la solicitud");
            },
            success: function (response) {
                //set preset data
                $('#selected_preset_color').val(response.data.node_color_rgb);
                $('#selected_preset_color').colorpicker('setValue', response.data.node_color_rgb);

                $('#selected_preset_color_x').val(response.data.node_color_x);
                $('#selected_preset_color_y').val(response.data.node_color_y);
                $('#selected_preset_color_z').val(response.data.node_color_z);
                $('#selected_preset_size').val(response.data.node_size);
                $('#selected_preset_shape').val(response.data.node_shape);

                $('#selected_preset_edge_color').val(response.data.node_edge_color_rgb);
                $('#selected_preset_edge_color').colorpicker('setValue', response.data.node_edge_color_rgb);

                $('#selected_preset_edge_color_x').val(response.data.node_edge_color_x);
                $('#selected_preset_edge_color_y').val(response.data.node_edge_color_y);
                $('#selected_preset_edge_color_z').val(response.data.node_edge_color_z);
                $('#selected_preset_edge_width').val(response.data.node_edge_line_width);

                $('#btn-delete-preset').attr('disabled', false);
            }
        });

    }

}

//todo:fix
function guardar_param_arch_conf_vis() {
    var select_option_id = $('#vis_proy_simul option:selected').attr('id');

    var proyecto_id = select_option_id.substr(select_option_id.indexOf("_") + 1);

    var nombre_arch_conf = $('#vis_archivo_conf').val();

    var max_nodes = $('#max_nodes').val();

    var export_scenario = $('#save_world').prop('checked') === true ? 'on' : 'off';

    var load_scenario = false;

    var id_snapshot = null;

    var url = (
        'href', location.protocol + '//' + window.location.host +
        '/modulos/simulacion/controlador/simulacion.class.php?guardar-param-arch-conf-vis' +
        '&proyecto_id=' + proyecto_id +
        '&nombre_arch_conf=' + nombre_arch_conf +
        "&max_nodes=" + max_nodes +
        "&export_scenario=" + export_scenario
    );

    $.ajax({
        url: url,
        type: "get",
        dataType: 'json',
        cache: false,
        error: function () {
            alert("Error al procesar la solicitud");
        },
        success: function (data) {
            if (data.resul == true) {
                alert('Parámetros de visualización guardados correctamente');
            } else {
                alert("Error al guardar los parámetros");
                cargarParamArchConfVis();
            }
        }
    });
}

function guardar_preset_usuario() {

    var color = $('#selected_preset_color').val();
    var color_x = $('#selected_preset_color_x').val();
    var color_y = $('#selected_preset_color_y').val();
    var color_z = $('#selected_preset_color_z').val();
    var size = $('#selected_preset_size').val();
    var shape = $('#selected_preset_shape').val();
    var edge_color = $('#selected_preset_edge_color').val();
    var edge_color_x = $('#selected_preset_edge_color_x').val();
    var edge_color_y = $('#selected_preset_edge_color_y').val();
    var edge_color_z = $('#selected_preset_edge_color_z').val();
    var edge_width = $('#selected_preset_edge_width').val();
    var preset_name = $('#selected_preset_name').val();

    var url = ('href', location.protocol +
        "//" + window.location.host +
        "/modulos/simulacion/controlador/simulacion.class.php?guardar-preset&color=" + color +
        "&color_x=" + color_x +
        "&color_y=" + color_y +
        "&color_z=" + color_z +
        "&size=" + size +
        "&shape=" + shape +
        "&edge_color=" + edge_color +
        "&edge_color_x=" + edge_color_x +
        "&edge_color_y=" + edge_color_y +
        "&edge_color_z=" + edge_color_z +
        "&edge_width=" + edge_width +
        "&preset_name=" + preset_name
    );

    $.ajax({
        url: url,
        type: "get",
        dataType: 'json',
        cache: false,
        error: function () {
            alert("Error al procesar la solicitud");
        },
        success: function (response) {
            if (response.resul == true) {
                alert("Preset guardado correctamente!");
            } else {
                alert("Error al guardar el preset");
            }
        }
    });
}

function eliminar_preset_usuario() {
    var preset_id = $('#vis_preset option:selected').val();

    var url = ('href', location.protocol +
    "//" + window.location.host +
    "/modulos/simulacion/controlador/simulacion.class.php?eliminar-preset&preset_id=" + preset_id);

    $.ajax({
        url: url,
        type: "get",
        dataType: 'json',
        cache: false,
        error: function () {
            alert("Error al procesar la solicitud");
        },
        success: function (response) {
            if (response.resul == true) {
                alert("Preset eliminado correctamente!");
            } else {
                alert("Error al eliminar el preset");
            }
        }
    });
}

function load_config_to_vis_table() {
    var color = $('#selected_preset_color').val();
    var color_x = $('#selected_preset_color_x').val();
    var color_y = $('#selected_preset_color_y').val();
    var color_z = $('#selected_preset_color_z').val();
    var size = $('#selected_preset_size').val();
    var shape = $('#selected_preset_shape').val();
    var edge_color = $('#selected_preset_edge_color').val();
    var edge_color_x = $('#selected_preset_edge_color_x').val();
    var edge_color_y = $('#selected_preset_edge_color_y').val();
    var edge_color_z = $('#selected_preset_edge_color_z').val();
    var edge_line_width = $('#selected_preset_edge_width').val();

    $('#vis_configs_table > tbody:last-child').append('<tr>' +
        '<td>' + '' + '</td>' +
        '<td>' + '<input type="checkbox" name="default" />' + '</td>' +
        '<td>' + color + '</td>' +
        '<td style="display:none;">' + color_x + '</td>' +
        '<td style="display:none;">' + color_y + '</td>' +
        '<td style="display:none;">' + color_z + '</td>' +
        '<td>' + size + '</td>' +
        '<td>' + shape + '</td>' +
        '<td>' + edge_color + '</td>' +
        '<td style="display:none;">' + edge_color_x + '</td>' +
        '<td style="display:none;">' + edge_color_y + '</td>' +
        '<td style="display:none;">' + edge_color_z + '</td>' +
        '<td>' + edge_line_width + '</td>' +
        '<td>' + '<button class="btn btn-sm btn-outline-danger remove-tr"><i class="fas fa-eraser"></i></button>' + '</td>' +
        '</tr>');
}

/**
 * Fin Funciones especificas para modulo de visualizacion
 */


function visualizar() {
    var url = "../ver_pdf.php";
    window.location.href = url;
}

function crear_proyecto() {
    $(location).attr('href', location.protocol + '//' + window.location.host + '/modulos/proyectos/vistas/crear_proyecto_simulacion.php');
}

function eliminar_proyecto() {
    $(location).attr('href', location.protocol + '//' + window.location.host + '/modulos/proyectos/vistas/eliminar_proyecto_simulacion.php');
}

function modificar_proyecto() {
    $(location).attr('href', location.protocol + '//' + window.location.host + '/modulos/proyectos/vistas/modificar_proyecto_simulacion.php');
}

function clearElement(element_id) {
    $('#' + element_id).empty();
}