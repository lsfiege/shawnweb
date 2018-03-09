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
        var id = $(this).parent().siblings(":first").text();

        if (id) {
            var url = ('href', location.protocol + '//' + window.location.host +
            '/modulos/simulacion/controlador/simulacion.class.php?eliminar-preset-proyecto&id=' + id);

            $.ajax({
                url: url,
                type: "get",
                cache: false,
                error: function () {
                    swal(
                        'Error',
                        'Error al procesar la solicitud',
                        'error'
                    );
                },
                success: function (data) {
                    swal(
                        'Ok',
                        'Preset de proyecto eliminado',
                        'success'
                    );
                }
            });
        }

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
            swal(
                'Error',
                'Error al procesar la solicitud',
                'error'
            );
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
            swal(
                'Error',
                'Error al procesar la solicitud',
                'error'
            );
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
            swal(
                'Error',
                'Error al procesar la solicitud',
                'error'
            );
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
                swal(
                    'Error',
                    'Error al procesar la solicitud',
                    'error'
                );
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
            swal(
                'Error',
                'Error al procesar la solicitud',
                'error'
            );
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
    $("#div_snapshots").empty();
    $("#world_settings").show();
    $("#load_snapshot").prop('checked', false);

    var select_option_id = $('#control_proy_simul option:selected').attr('id');
    var proyecto_id = select_option_id.substr(select_option_id.indexOf("_") + 1);
    var nombre_arch_conf = $('#control_archivo_conf').val();
    var url = ('href', location.protocol + '//' + window.location.host + '/modulos/simulacion/controlador/simulacion.class.php?cargar-param-arch-conf&proyecto_id=' + proyecto_id + '&nombre_arch_conf=' + nombre_arch_conf);

    $.ajax({
        url: url,
        type: "get",
        dataType: 'json',
        cache: false,
        error: function () {
            swal(
                'Error',
                'Error al procesar la solicitud',
                'error'
            );
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
            swal(
                'Error',
                'Error al procesar la solicitud',
                'error'
            );
        },
        success: function (data) {
            if (data.resul == true) {
                swal(
                    'Ok',
                    'Parametros guardados correctamente',
                    'success'
                );

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
                swal(
                    'Error',
                    'Error al guardar los parametros',
                    'error'
                );
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
            swal(
                'Error',
                'Error al procesar la solicitud',
                'error'
            );
        },
        success: function (data) {

            $("#vis_archivos_conf_div").empty().append(data);

            crearUrlVisualizacion(proyecto_id);
        }
    });
}

function loadSelectSnapshots() {
    var load_snapshot = $('#load_snapshot').prop('checked');

    if (load_snapshot) {

        var url = ('href', location.protocol + '//' + window.location.host + '/modulos/simulacion/controlador/simulacion.class.php?cargar-select-snapshots');

        $.ajax({
            url: url,
            type: "get",
            cache: false,
            error: function () {
                swal(
                    'Error',
                    'Error al procesar la solicitud',
                    'error'
                );
            },
            success: function (data) {
                $('#world_settings').hide();

                $('#save_world_div').hide();

                $('#save_world').prop('checked', false);

                $("#div_snapshots").empty().append(data);
            }
        });

    } else {
        $("#div_snapshots").empty();

        $('#world_settings').show();

        $('#save_world_div').show();
    }
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
            swal(
                'Error',
                'Error al procesar la solicitud',
                'error'
            );
        },
        success: function (data) {
            url = ('href', location.protocol + '//' + window.location.host + '/modulos/simulacion/controlador/simulacion.class.php?cargar-conf-vis-proyecto-archivo&proyecto_id=' + proyecto_id + '&nombre_arch_conf=' + nombre_arch_conf);

            $.ajax({
                url: url,
                type: "get",
                dataType: 'json',
                cache: false,
                error: function () {
                    swal(
                        'Error',
                        'Error al procesar la solicitud',
                        'error'
                    );
                },
                success: function (configs) {
                    configs.forEach(function (item) {
                        $('#vis_configs_table > tbody:last-child').append('<tr>' +
                            '<td>' + item.id + '</td>' +
                            '<td>' + item.node_color_rgb + '</td>' +
                            '<td style="display:none;">' + item.node_color_x + '</td>' +
                            '<td style="display:none;">' + item.node_color_y + '</td>' +
                            '<td style="display:none;">' + item.node_color_z + '</td>' +
                            '<td>' + item.node_size + '</td>' +
                            '<td>' + item.node_shape + '</td>' +
                            '<td>' + item.node_edge_color_rgb + '</td>' +
                            '<td style="display:none;">' + item.node_edge_color_x + '</td>' +
                            '<td style="display:none;">' + item.node_edge_color_y + '</td>' +
                            '<td style="display:none;">' + item.node_edge_color_z + '</td>' +
                            '<td>' + item.node_edge_line_width + '</td>' +
                            '<td>' + '<button class="btn btn-sm btn-outline-danger remove-tr"><i class="fas fa-eraser"></i></button>' + '</td>' +
                            '</tr>');

                    })
                }
            });
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
                swal(
                    'Error',
                    'Error al procesar la solicitud',
                    'error'
                );
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

function guardar_param_arch_conf_vis() {
    var select_option_id = $('#vis_proy_simul option:selected').attr('id');

    var proyecto_id = select_option_id.substr(select_option_id.indexOf("_") + 1);

    var nombre_arch_conf = $('#vis_archivo_conf').val();

    var export_scenario = $('#save_world').prop('checked') === true ? 'on' : 'off';

    var load_snapshot = $('#load_snapshot').prop('checked') === true ? 'on' : 'off';

    var id_snapshot = $('#select_proyect_snapshot option:selected').val() !== -1 ? $('#select_proyect_snapshot option:selected').val() : null;

    var vis_configs = $('#vis_configs_table tr:has(td)').map(function (i, v) {
        var $td = $('td', this);

        return {
            id: $td.eq(0).text().length ? $td.eq(0).text() : null,
            node_color_rgb: $td.eq(1).text().length ? $td.eq(1).text() : null,
            node_color_x: $td.eq(2).text().length ? $td.eq(2).text() : null,
            node_color_y: $td.eq(3).text().length ? $td.eq(3).text() : null,
            node_color_z: $td.eq(4).text().length ? $td.eq(4).text() : null,
            node_size: $td.eq(5).text().length ? $td.eq(5).text() : null,
            node_shape: $td.eq(6).text().length ? $td.eq(6).text() : null,
            edge_color_rgb: $td.eq(7).text().length ? $td.eq(7).text() : null,
            edge_color_x: $td.eq(8).text().length ? $td.eq(8).text() : null,
            edge_color_y: $td.eq(9).text().length ? $td.eq(9).text() : null,
            edge_color_z: $td.eq(10).text().length ? $td.eq(10).text() : null,
            edge_size: $td.eq(11).text().length ? $td.eq(11).text() : null,
        }
    }).get();

    if (select_option_id.length === 0 &&
        proyecto_id.length === 0 &&
        nombre_arch_conf.length === 0
    ) {
        return false;
    }

    if (load_snapshot === 'on' && id_snapshot === -1) {
        return false;
    }

    //Parametros de escenario
    var count = $('#count').val();
    var range = $('#range').val();
    var rect_world_width = $('#rect_world_width').val();
    var rect_world_height = $('#rect_world_height').val();
    var seed = $('#seed').val();
    var max_iterations = $('#max_iterations').val();
    var edge_model = $('#modelo_borde').val();
    var comm_model = $('#modelo_comunicacion').val();
    var transm_model = $('#modelo_transmision').val();

    var url = (
        'href', location.protocol + '//' + window.location.host +
        '/modulos/simulacion/controlador/simulacion.class.php?guardar-param-arch-conf-vis' +
        '&proyecto_id=' + proyecto_id +
        '&nombre_arch_conf=' + nombre_arch_conf +
        "&export_scenario=" + export_scenario +
        "&load_snapshot=" + load_snapshot +
        "&id_snapshot=" + id_snapshot +
        "&vis_configs=" + JSON.stringify(vis_configs) +
        "&count=" + count +
        "&range=" + range +
        "&world_width=" + rect_world_width +
        "&world_height=" + rect_world_height +
        "&seed=" + seed +
        "&max_iterations=" + max_iterations +
        "&edge_model=" + edge_model +
        "&comm_model=" + comm_model +
        "&transm_model=" + transm_model
    );

    console.log(url);

    /*$.ajax({
        url: url,
        type: "get",
        dataType: 'json',
        cache: false,
        error: function () {
            swal(
                'Error',
                'Error al procesar la solicitud',
                'error'
            );
        },
        success: function (data) {
            if (data.resul == true) {
                swal(
                    'Ok',
                    'Parámetros de visualización guardados correctamente',
                    'success'
                );
            } else {
                swal(
                    'Error',
                    'Error al guardar los parámetros',
                    'error'
                );
                cargarParamArchConfVis();
            }
        }
    });*/
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
            swal(
                'Error',
                'Error al procesar la solicitud',
                'error'
            );
        },
        success: function (response) {
            if (response.resul == true) {
                swal(
                    'Ok',
                    'Preset guardado correctamente',
                    'success'
                );
            } else {
                swal(
                    'Error',
                    'Error al guardar el preset',
                    'error'
                );
            }
        }
    });
}

function show_vis_panel() {
    $('#control').removeClass('active');
    $('#control').removeClass('show');

    $('#profile-tab').removeClass('active');
    $('#profile-tab').removeClass('show');

    $('#contact-tab-vis').addClass('active');
    $('#contact-tab-vis').addClass('show');

    $('#visualizacion').addClass('active');
    $('#visualizacion').addClass('show');

    $('html, body').animate({scrollTop: 0}, 'fast');
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
            swal(
                'Error',
                'Error al procesar la solicitud',
                'error'
            );
        },
        success: function (response) {
            if (response.resul == true) {
                swal(
                    'Ok',
                    'Preset eliminado',
                    'success'
                );
            } else {
                swal(
                    'Error',
                    'Error al eliminar el preset',
                    'error'
                );
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