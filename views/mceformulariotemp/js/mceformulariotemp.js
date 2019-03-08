/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Data fecha
var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

//Obtener Extencion de Archivo
function getExtension(filename) {
    return filename.substring(filename.lastIndexOf('.') + 1);
}

function retornarIndexArray(array, property, value) {
    var index = -1;
    for (var i = 0; i < array.length; i++) {
        //alert(array[i][property]+'-'+value)
        if (array[i][property] == value) {
            index = i;
            return index;
        }
    }
    return index;
}
function codigoExiste(value, property, lista) {
    if (lista) {
        var array = JSON.parse(lista);
        for (var i = 0; i < array.length; i++) {
            if (array[i][property] == value) {
                return false;
            }
        }
    }
    return true;
}

function findAndRemove(array, property, value) {
    for (var i = 0; i < array.length; i++) {
        if (array[i][property] == value) {
            array.splice(i, 1);
        }
    }
    return array;
}

function iniciarUpload() {

    //if ($("#txt_ftem_cedula_file")) {
    $("#txt_ftem_cedula_file").fileinput({
        language: FileIdioma,
        //type: "POST",
        previewFileType: "any",
        showPreview: false,
        showUpload: false, // hide upload button
        showRemove: true, // hide remove button
        uploadUrl: $('#txth_base').val() + "/mceformulariotemp/uploadfile",
        //deleteUrl: "/Message/AsyncRemoveAction",
        maxFileSize: FileSize,
        browseLabel: browseLabel,
        //initialCaption: "Adjuntar Documento Nacional de Identidad",
		initialCaption: "Otros",
        allowedFileExtensions: FileExtensions,
        msgInvalidFileExtension: 'Invalid extension for file {name}. Only "{extensions} files are supported.',
        msgSizeTooLarge: "File {name} ({size} KB) exceeds maximum upload size of {maxSize} KB. Please Try again",
        msgFilesTooMany: "Number of Files selected for upload ({n}) exceeds maximum allowed limit of {m}",
        msgInvalidFileType: 'Invalid type for file "{name}". Only {types} files are supported.',
        //msgInvalidFileExtension: 'Invalid extension for file {name}. Only "{extensions} files are supported.',
        uploadAsync: true,
        //deleteExtraData: function (previewId, index) { return { key: index, pId: previewId, action: 'delete' }; },
        uploadExtraData: function (previewId, index) {
            return {"numero":(AccionTipo=="Update")?$('#txt_ftem_cedula').val()+'_'+$('#txth_ftem_id').val():$('#txt_ftem_cedula').val(), "nombre": "cedula"};
        }
    });
    /*$("#txt_ftem_cedula_file").on('filepreupload', function (event, data, previewId, index) {
        $('#txt_ftem_cedula_file').fileinput('upload');
        //alert('i = ' + index + ', id = ' + previewId + ', file = ' + file.name);
        //var form = data.form, files = data.files, extra = data.extra,
        //response = data.response, reader = data.reader;
        alert(data.toSource());
    });*/
    $('#txt_ftem_cedula_file').on('filebatchselected ', function (event) {
        $('#txth_ftem_cedula_file').val($('#txt_ftem_cedula_file').val())
        $('#txt_ftem_cedula_file').fileinput('upload');
    });
    $('#txt_ftem_cedula_file').on('fileuploaderror', function (event, data, previewId, index) {
        $('#txth_ftem_cedula_file').val('');
        showAlert('NO_OK', 'error', {"wtmessage": $('#txth_errorFile').val(), "title":'Información'});
    });

    $("#txt_ftem_ruc_file").fileinput({
        language: FileIdioma,
        //type: "POST",
        previewFileType: "any",
        showPreview: false,
        showUpload: false, // hide upload button
        showRemove: true, // hide remove button
        uploadUrl: $('#txth_base').val() + "/mceformulariotemp/uploadfile",
        maxFileSize: FileSize,
        browseLabel: browseLabel,
        initialCaption: "Adjuntar Ruc",
        allowedFileExtensions: FileExtensions,
        //elErrorContainer: "#errorBlock",
        uploadExtraData: function (previewId, index) {
            //return {"numero": $('#txt_ftem_cedula').val(), "nombre": "ruc"};
            return {"numero":(AccionTipo=="Update")?$('#txt_ftem_cedula').val()+'_'+$('#txth_ftem_id').val():$('#txt_ftem_cedula').val(), "nombre": "ruc"};
        }
    });
    $('#txt_ftem_ruc_file').on('filebatchselected ', function (event) {
        $('#txth_ftem_ruc_file').val($('#txt_ftem_ruc_file').val())
        $('#txt_ftem_ruc_file').fileinput('upload');
    });
    $('#txt_ftem_ruc_file').on('fileuploaderror', function (event, data, previewId, index) {
        $('#txth_ftem_ruc_file').val('');
        showAlert('NO_OK', 'error', {"wtmessage": $('#txth_errorFile').val(), "title":'Información'});
    });

    $("#txt_ftem_cer_file").fileinput({
        language: FileIdioma,
        //type: "POST",
        previewFileType: "any",
        showPreview: false,
        showUpload: false, // hide upload button
        showRemove: true, // hide remove button
        uploadUrl: $('#txth_base').val() + "/mceformulariotemp/uploadfile",
        maxFileSize: FileSize,
        browseLabel: browseLabel,
        //initialCaption: "Adjuntar Certificado Votación",
		initialCaption: "Otros 2",
        allowedFileExtensions: FileExtensions,
        //elErrorContainer: "#errorBlock",
        uploadExtraData: function (previewId, index) {
            //return {"numero": $('#txt_ftem_cedula').val(), "nombre": "certificado_votacion"};
            return {"numero":(AccionTipo=="Update")?$('#txt_ftem_cedula').val()+'_'+$('#txth_ftem_id').val():$('#txt_ftem_cedula').val(), "nombre": "certificado_votacion"};
        }
    });
    $('#txt_ftem_cer_file').on('filebatchselected ', function (event) {
        $('#txth_ftem_cer_file').val($('#txt_ftem_cer_file').val())
        $('#txt_ftem_cer_file').fileinput('upload');
    });
    $('#txt_ftem_cer_file').on('fileuploaderror', function (event, data, previewId, index) {
        $('#txth_ftem_cer_file').val('');
        showAlert('NO_OK', 'error', {"wtmessage": $('#txth_errorFile').val(), "title":'Información'});
    });

    $("#txt_ftem_cert_super_compania_file").fileinput({
        language: FileIdioma,
        //type: "POST",
        previewFileType: "any",
        showPreview: false,
        showUpload: false, // hide upload button
        showRemove: true, // hide remove button
        uploadUrl: $('#txth_base').val() + "/mceformulariotemp/uploadfile",
        maxFileSize: FileSize,
        browseLabel: browseLabel,
        initialCaption: "Adjunte certificado de Superintendencia de compañias",
        allowedFileExtensions: FileExtensions,
        //elErrorContainer: "#errorBlock",
        uploadExtraData: function (previewId, index) {
            //return {"numero": $('#txt_ftem_cedula').val(), "nombre": "super_compania"};
            return {"numero":(AccionTipo=="Update")?$('#txt_ftem_cedula').val()+'_'+$('#txth_ftem_id').val():$('#txt_ftem_cedula').val(), "nombre": "super_compania"};
        }
    });
    $('#txt_ftem_cert_super_compania_file').on('filebatchselected ', function (event) {
        $('#txth_ftem_cert_super_compania_file').val($('#txt_ftem_cert_super_compania_file').val())
        $('#txt_ftem_cert_super_compania_file').fileinput('upload');
    });
    $('#txt_ftem_cert_super_compania_file').on('fileuploaderror', function (event, data, previewId, index) {
        $('#txth_ftem_cert_super_compania_file').val('');
        showAlert('NO_OK', 'error', {"wtmessage": $('#txth_errorFile').val(), "title":'Información'});
    });

    $("#txt_ftem_registro_sanitario_file").fileinput({
        language: FileIdioma,
        //type: "POST",
        previewFileType: "any",
        showPreview: false,
        showUpload: false, // hide upload button
        showRemove: true, // hide remove button
        uploadUrl: $('#txth_base').val() + "/mceformulariotemp/uploadfile",
        maxFileSize: FileSize,
        browseLabel: browseLabel,
        initialCaption: "Registro Sanitario",
        allowedFileExtensions: FileExtensions,
        //elErrorContainer: "#errorBlock",
        uploadExtraData: function (previewId, index) {
            //return {"numero": $('#txt_ftem_cedula').val(), "nombre": "registro_sanitario"};
            return {"numero":(AccionTipo=="Update")?$('#txt_ftem_cedula').val()+'_'+$('#txth_ftem_id').val():$('#txt_ftem_cedula').val(), "nombre": "registro_sanitario"};
        }
    });
    $('#txt_ftem_registro_sanitario_file').on('filebatchselected ', function (event) {
        $('#txth_ftem_registro_sanitario_file').val($('#txt_ftem_registro_sanitario_file').val())
        $('#txt_ftem_registro_sanitario_file').fileinput('upload');
    });
    $('#txt_ftem_registro_sanitario_file').on('fileuploaderror', function (event, data, previewId, index) {
        $('#txth_ftem_registro_sanitario_file').val('');
        showAlert('NO_OK', 'error', {"wtmessage": $('#txth_errorFile').val(), "title":'Información'});
    });

    $("#txt_ftem_perm_func_mitur_file").fileinput({
        language: FileIdioma,
        //type: "POST",
        previewFileType: "any",
        showPreview: false,
        showUpload: false, // hide upload button
        showRemove: true, // hide remove button
        uploadUrl: $('#txth_base').val() + "/mceformulariotemp/uploadfile",
        maxFileSize: FileSize,
        browseLabel: browseLabel,
        initialCaption: "Adjuntar Permiso de Funcionamiento Mintur",
        allowedFileExtensions: FileExtensions,
        //elErrorContainer: "#errorBlock",
        uploadExtraData: function (previewId, index) {
            //return {"numero": $('#txt_ftem_cedula').val(), "nombre": "permiso_mintur"};
            return {"numero":(AccionTipo=="Update")?$('#txt_ftem_cedula').val()+'_'+$('#txth_ftem_id').val():$('#txt_ftem_cedula').val(), "nombre": "permiso_mintur"};
        }
    });
    $('#txt_ftem_perm_func_mitur_file').on('filebatchselected ', function (event) {
        $('#txth_ftem_perm_func_mitur_file').val($('#txt_ftem_perm_func_mitur_file').val())
        $('#txt_ftem_perm_func_mitur_file').fileinput('upload');
    });
    $('#txt_ftem_perm_func_mitur_file').on('fileuploaderror', function (event, data, previewId, index) {
        $('#txth_ftem_perm_func_mitur_file').val('');
        showAlert('NO_OK', 'error', {"wtmessage": $('#txth_errorFile').val(), "title":'Información'});
    });

    $("#txt_ftem_trayectoria_file").fileinput({
        language: FileIdioma,
        //type: "POST",
        previewFileType: "any",
        showPreview: false,
        showUpload: false, // hide upload button
        showRemove: true, // hide remove button
        uploadUrl: $('#txth_base').val() + "/mceformulariotemp/uploadfile",
        maxFileSize: FileSize,
        browseLabel: browseLabel,
        initialCaption: "Adjuntar Referencia sobre Trayectoría (Opcional)",
        allowedFileExtensions: FileExtensions,
        //elErrorContainer: "#errorBlock",
        uploadExtraData: function (previewId, index) {
            //return {"numero": $('#txt_ftem_cedula').val(), "nombre": "trayectoria"};
            return {"numero":(AccionTipo=="Update")?$('#txt_ftem_cedula').val()+'_'+$('#txth_ftem_id').val():$('#txt_ftem_cedula').val(), "nombre": "trayectoria"};
        }
    });
    $('#txt_ftem_trayectoria_file').on('filebatchselected ', function (event) {
        $('#txth_ftem_trayectoria_file').val($('#txt_ftem_trayectoria_file').val())
        $('#txt_ftem_trayectoria_file').fileinput('upload');
    });
    $('#txt_ftem_trayectoria_file').on('fileuploaderror', function (event, data, previewId, index) {
        $('#txth_ftem_trayectoria_file').val('');
        showAlert('NO_OK', 'error', {"wtmessage": $('#txth_errorFile').val(), "title":'Información'});
    });

    $("#txt_ftem_imp_renta_file").fileinput({
        language: FileIdioma,
        //type: "POST",
        previewFileType: "any",
        showPreview: false,
        showUpload: false, // hide upload button
        showRemove: true, // hide remove button
        uploadUrl: $('#txth_base').val() + "/mceformulariotemp/uploadfile",
        maxFileSize: FileSize,
        browseLabel: browseLabel,
        initialCaption: "Adjuntar Impuesto a la renta (Trayectoria > 1 Año)",
        allowedFileExtensions: FileExtensions,
        //elErrorContainer: "#errorBlock",
        uploadExtraData: function (previewId, index) {
            //return {"numero": $('#txt_ftem_cedula').val(), "nombre": "impuesto_renta"};
            return {"numero":(AccionTipo=="Update")?$('#txt_ftem_cedula').val()+'_'+$('#txth_ftem_id').val():$('#txt_ftem_cedula').val(), "nombre": "impuesto_renta"};
        }
    });
    $('#txt_ftem_imp_renta_file').on('filebatchselected ', function (event) {
        $('#txth_ftem_imp_renta_file').val($('#txt_ftem_imp_renta_file').val())
        $('#txt_ftem_imp_renta_file').fileinput('upload');
    });
    $('#txt_ftem_imp_renta_file').on('fileuploaderror', function (event, data, previewId, index) {
        $('#txth_ftem_imp_renta_file').val('');
        showAlert('NO_OK', 'error', {"wtmessage": $('#txth_errorFile').val(), "title":'Información'});
    });

    $("#txt_producto_foto").fileinput({
        language: FileIdioma,
        //type: "POST",
        previewFileType: "any",
        showPreview: false,
        showUpload: false, // hide upload button
        showRemove: true, // hide remove button
        uploadUrl: $('#txth_base').val() + "/mceformulariotemp/uploadfile",
        maxFileSize: FileSize,
        browseLabel: browseLabel,
        initialCaption: "Foto del Producto",
        allowedFileExtensions: FileExtensions,
        //elErrorContainer: "#errorBlock",
        uploadExtraData: function (previewId, index) {
            //return {"numero": $('#txt_ftem_cedula').val(), "nombre": "producto"};
            return {"numero":(AccionTipo=="Update")?$('#txt_ftem_cedula').val()+'_'+$('#txth_ftem_id').val():$('#txt_ftem_cedula').val(), "nombre": "producto"};
        },
        slugCallback: function (text) {
            return (text=='') ? '' : String(text).replace(/[\-\[\]\/\{}:;#%=\(\)\*\+\?\\\^\$\|<>&"']/g, '_');
        }
    });
    $('#txt_producto_foto').on('filebatchselected ', function (event) {
        var nameProduct=limpiarFake($('#txt_producto_foto').val());
        nameProduct=String(nameProduct).replace(/[\-\[\]\/\{}:;#%=\(\)\*\+\?\\\^\$\|<>&"']/g, '_');
        $('#txth_producto_foto').val(nameProduct);
        $('#txt_producto_foto').fileinput('upload');
    });
    $('#txt_producto_foto').on('fileuploaderror', function (event, data, previewId, index) {
        $('#txth_producto_foto').val('');
        showAlert('NO_OK', 'error', {"wtmessage": $('#txth_errorFile').val(), "title":'Información'});
    });

}

function subirDocumentos(op, valor) {
    var estado = true;
    //Valores Obligatorios
    var mensaje = '';

//    if(sessionStorage.dataSolicitud_1){
//        var datArray = JSON.parse(sessionStorage.dataSolicitud_1);
//        if(datArray.length > 0){
//            alert(datArray[0]['ftem_cedula_file']);
//        }
//    }

    if ($('#txt_ftem_cedula').val() == '') {//Verifico si tiene Datos
        mensaje += 'Ingresar Documento Nacional de Identidad (DNI o Cédula), <br>';
        estado = false;//Retorna Error
    }
    switch (op) {
        case 1:
            //Primera Fase
            /*if ($('#txt_ftem_cedula_file').val() == '') {//Verifico si tiene Datos (Datos No Obligatorios)
             mensaje += 'Adjuntar Documento Nacional de Identidad (DNI o Cédula), <br>';
             estado = false;//Retorna Error
             }*/
            if ($('#txth_ftem_ruc_file').val() == '') {//Verifico si tiene Datos
                mensaje += 'Adjuntar Registro Único de Contribuyentes (RUC), <br>';
                estado = false;//Retorna Error
            }
            if (!($('#div_SuperCompania').is(':hidden'))) {//DIV es visible
                if ($('#txth_ftem_cert_super_compania_file').val() == '') {//Verifico si tiene Datos
                    mensaje += 'Adjuntar Documento de Súper de Compañías, <br>';
                    estado = false;//Retorna Error
                }
            }
            /*if (!($('#div_certificadoVotacion').is(':hidden'))) {
                if ($('#txth_ftem_cer_file').val() == '') {//Verifico si tiene Datos
                    mensaje += 'Adjuntar Certificado de Votación, <br>';
                    estado = false;//Retorna Error
                }
            }*/
            if (!($('#div_RegisSanitario').is(':hidden'))) {
                if ($('#txth_ftem_registro_sanitario_file').val() == '') {//Verifico si tiene Datos
                    mensaje += 'Adjuntar Documento  Registro Sanitario, <br>';
                    estado = false;//Retorna Error
                }

            }
            if (!($('#div_PermisoMitur').is(':hidden'))) {
                if ($('#txth_ftem_perm_func_mitur_file').val() == '') {//Verifico si tiene Datos
                    mensaje += 'Adjuntar Permiso de Funcionamiento de Mintur , <br>';
                    estado = false;//Retorna Error
                }
            }
            break;
        case 2:
            //Segunda Fase
            /*if ($('#txth_ftem_trayectoria_file').val() == '') {//Verifico si tiene Datos (Datos No Obligatorios)
             mensaje += 'Adjuntar Referencia sobre Trayectoría (Opcional), <br>';
             estado = false;//Retorna Error
             }*/
            if (!($('#div_ftem_imp_renta').is(':hidden'))) {
                if ($('#txth_ftem_imp_renta_file').val() == '') {//Verifico si tiene Datos
                    mensaje += 'Adjuntar Impuesto a la renta (Trayectoria > 1 Año), <br>';
                    estado = false;//Retorna Error
                }
            }

            break;
        default:

    }
    if (estado && valor) {//Subir Documentos si todo esta Correcto
        switch (op) {
            case 1:
                //Primera Fase
                if ($('#txt_ftem_cedula_file').val() != '') {
                    //$('#txt_ftem_cedula_file').fileinput('upload');
                }
                if ($('#txt_ftem_ruc_file').val() != '') {
                    //$('#txt_ftem_ruc_file').fileinput('upload');
                }
                if ($('#txt_ftem_cert_super_compania_file').val() != '') {
                    //$('#txt_ftem_cert_super_compania_file').fileinput('upload');
                }
                if ($('#txt_ftem_cer_file').val() != '') {
                    //$('#txt_ftem_cer_file').fileinput('upload');
                }
                if ($('#txt_ftem_registro_sanitario_file').val() != '') {
                    //$('#txt_ftem_registro_sanitario_file').fileinput('upload');
                }
                if ($('#txt_ftem_perm_func_mitur_file').val() != '') {
                    //$('#txt_ftem_perm_func_mitur_file').fileinput('upload');
                }
                break;
            case 2:
                if ($('#txt_ftem_trayectoria_file').val() != '') {
                    //$('#txt_ftem_trayectoria_file').fileinput('upload');
                }
                if ($('#txt_ftem_imp_renta').val() != '') {
                    //$('#txt_ftem_imp_renta').fileinput('upload');
                }
                break;
            default:
        }
    } else {
        if (!estado) {//Muestra Mensaje en Caso de que Exista un error
            var message = {
                "wtmessage": mensaje,
                "title": "Información",
            };
            showAlert("NO_OK", "error", message);
        }

    }
    return estado;

}


function menssajeModal(valor, tipo, body, title, accion, evento, op) {
    switch (op) {
        case '1':
            //alerta Normal
            var message = {
                "wtmessage": body,
                "title": title,
            };
            break;
        case '2':
            var message = {
                "wtmessage": body,
                "title": title,
                "acciones": [
                    {
                        "id": "btnl",
                        "class": "btn-primary clclass",
                        "value": accion,
                        "callback": evento, //guardafuncion
                    },
                ],
            };
            break;
        default:

    }
    showAlert(valor, tipo, message);
}
function ModalTipoPersona() {
    var origen = $('#cmb_ftem_origen option:selected').val();
    var personeria = $('#cmb_ftem_personeria option:selected').val();
    var bodyM = '';
    //Eliminar Campos Segun su Eleccion
    $("#div_ruc_persona").html('');
    $("#div_razonSocial").html('');
    $("#div_ruc_empresa").html('');

    if (origen == '1') {
        controlDniExtrangero(false);
        if (personeria == '1') {
            //Nacional - > Natural
            agregarCamposPerNatural();
            bodyM = '<div class="box-body">';
            bodyM += '<ol>';
            //bodyM += '<li>Copia de cédula de ciudadanía de la persona natural</li>';
            //bodyM += '<li>Copia de papeleta de votación</li>';
            //bodyM += '<li>Copia del RUC</li>';
			bodyM += '<li>Copia de RUC - SRI</li>';
            //bodyM += '<li>Registro sanitario (En caso de pertenecer a las categorías \'Alimentos, bebidas y licores\' o \'Café y cacao\')</li>';
			bodyM += '<li>Registro Sanitario - ARCSA (En caso de pertenecer a las categorías \'Alimentos, bebidas y licores\' o \'Café y cacao\')</li>';
            //bodyM += '<li>Permiso de funcionamiento del Ministerio de Turismo (en caso de pertenecer a la categoría Hotelería y turismo)</li>';
			bodyM += '<li>Permiso de funcionamiento Sector turístico - MINTUR (en caso de pertenecer a la categoría Hotelería y turismo)</li>';
			bodyM += '<li>Certificado de ser artesano - JNDA (en caso de pertenecer a la categoría)</li>';
            //bodyM += '<li>Declaración jurada</li>';
            bodyM += '</ol>';
            bodyM += '</div>';
            $('#lbl_Personeria').text("Datos Persona Natural");
            $('#div_SuperCompania').hide();
            //$('#div_razonSocial').hide();
            $('#div_certificadoVotacion').show();
            disableSolicitudPart1(false);
            //disableSolicitudPart2(false);
            //disableSolicitudPart3(false);
        } else if (personeria == '2') {
            //Nacional - > Juridica
            agregarCamposPerJuridica();
            bodyM = '<div class="box-body">';
            bodyM += '<ol>';
            //bodyM += '<li>Copia de cédula de ciudadanía del representante legal</li>';
            //bodyM += '<li>Copia de papeleta de votación</li>';
            //bodyM += '<li>Copia del RUC</li>';
			bodyM += '<li>Copia de RUC - SRI</li>';
            bodyM += '<li>Certificado de Existencia y Cumplimiento de obligaciones - SUPER CIAS</li>';
            //bodyM += '<li>Registro sanitario (En caso de pertenecer a las categorías \'Alimentos, bebidas y licores\' o \'Café y cacao\')</li>';
			bodyM += '<li>Registro Sanitario - ARCSA (En caso de pertenecer a las categorías \'Alimentos, bebidas y licores\' o \'Café y cacao\')</li>';
            //bodyM += '<li>Permiso de funcionamiento del Ministerio de Turismo (en caso de pertenecer a la categoría Hotelería y turismo)</li>';
			bodyM += '<li>Permiso de funcionamiento Sector turístico - MINTUR (en caso de pertenecer a la categoría Hotelería y turismo)</li>';
			bodyM += '<li>Certificado de ser artesano - JNDA (en caso de pertenecer a la categoría)</li>';
            //bodyM += '<li>Declaración jurada</li>';
            bodyM += '</ol>';
            bodyM += '</div>';
            $('#lbl_Personeria').text("Datos Representante Legal");//Legal representative
            $('#div_SuperCompania').show();
            //$('#div_razonSocial').show();
            $('#div_certificadoVotacion').show();
            disableSolicitudPart1(false);
            //disableSolicitudPart2(false);
            //disableSolicitudPart3(false);
            //Mostrar Datos Juridicos
        } else {
            bodyM = 'Seleccionar su tipo de Persona';
            $('#div_SuperCompania').hide();
            //$('#div_razonSocial').hide();
            disableSolicitudPart1(true);
            disableSolicitudPart2(true);
            disableSolicitudPart3(true);
        }
    } else if (origen == '2') {
        controlDniExtrangero(true);
        if (personeria == '1') {
            //Extranjero - > Natural
            agregarCamposPerNatural();
            bodyM = '<div class="box-body">';
            bodyM += '<ol>';
            bodyM += '<li>Copia de la cédula de ciudadanía o pasaporte la persona natural</li>';
            bodyM += '<li>Copia certificada del registro fiscal de la persona natural en el país en el que desarrolla las actividades legalizadas por agente diplomático o Cónsul del Ecuador acreditado en ese territorio extranjero</li>';
            bodyM += '<li>Registro sanitario (En caso de pertenecer a las categorías \'Alimentos, bebidas y licores\' o \'Café y cacao\')</li>';
            bodyM += '<li>Declaración jurada</li>';
            bodyM += '</ol>';
            bodyM += '</div>';
            $('#lbl_Personeria').text("Datos Persona Natural");
            $('#div_SuperCompania').hide();
            //$('#div_razonSocial').hide();
            $('#div_certificadoVotacion').hide();
            disableSolicitudPart1(false);
            //disableSolicitudPart2(false);
            //disableSolicitudPart3(false);
        } else if (personeria == '2') {
            //Extranjero - > Juridico
            agregarCamposPerJuridica();
            bodyM = '<div class="box-body">';
            bodyM += '<ol>';
            bodyM += '<li>Copia de la cédula de ciudadanía o pasaporte del representante legal</li>';
            bodyM += '<li>Copia certificada del registro fiscal de la empresa en el país en el que desarrolla las actividades legalizada por agente diplomático o Cónsul del Ecuador acreditado en ese territorio extranjero</li>';
            bodyM += '<li>Certificado de existencia y cumplimiento de obligaciones emitido por el ente regulador del país en el que desarrolla las actividades</li>';
            bodyM += '<li>Registro sanitario (En caso de pertenecer a las categorías \'Alimentos, bebidas y licores\' o \'Café y cacao\')</li>';
            bodyM += '<li>Declaración jurada</li>';
            bodyM += '</ol>';
            bodyM += '</div>';
            $('#lbl_Personeria').text("Datos Representante Legal");//Legal representative
            $('#div_SuperCompania').show();
            //$('#div_razonSocial').show();
            $('#div_certificadoVotacion').hide();
            disableSolicitudPart1(false);
            //disableSolicitudPart2(false);
            //disableSolicitudPart3(false);
        } else {
            bodyM = 'Seleccionar su tipo de Persona';
            $('#div_SuperCompania').hide();
            //$('#div_razonSocial').hide();
            disableSolicitudPart1(true);
            disableSolicitudPart2(true);
            disableSolicitudPart3(true);
        }
    } else {
        controlDniExtrangero(false);
        bodyM = 'Seleccionar su Origen y Tipo de Persona';
        $('#div_SuperCompania').hide();
        //$('#div_razonSocial').hide();
        disableSolicitudPart1(true);
        disableSolicitudPart2(true);
        disableSolicitudPart3(true);
    }
    var message = {
        "wtmessage": bodyM,
        "title": "Información",
    };
    showAlert("OK", "info", message);
}

function controlDniExtrangero(valor){
    if(valor){
        //valida control DNI extrangero
        $('#txt_ftem_cedula').attr("data-type", "all");
        $('#txt_ftem_cedula').attr("maxlength", 15);
        $('#txt_ftem_cedula').attr("placeholder", "Documento Extranjero de Identidad");

    }else{
        //Valida control DNI Local
        $('#txt_ftem_cedula').attr("data-type", "cedula");
        $('#txt_ftem_cedula').attr("maxlength", 10);
        $('#txt_ftem_cedula').attr("placeholder", "Documento Nacional de Identidad");
    }

}

function mostrarDatosPersoneria() {
    $('#div_SuperCompania').show();
    $('#div_razonSocial').hide();
}


function loadDataCreate() {
    iniciarUpload();
    disableSolicitudPart1(true);
    disableSolicitudPart2(true);
    disableSolicitudPart3(true);

}
function InicioFormulario() {
    if (AccionTipo == "Update") {
        loadDataUpdate();
    } else if (AccionTipo == "Create") {
        loadDataCreate();
    }
}
function mostrarTrayectoria() {
    if ($('#cmb_ftem_trayectoria option:selected').val() > 0) {
        $('#div_ftem_imp_renta').show();
    } else {
        $('#div_ftem_imp_renta').hide();
    }
}

function obtenerCanton() {
    var link = $('#txth_base').val() + "/mceformulariotemp/create";
    var arrParams = new Object();
    arrParams.prov_id = $('#cmb_provincia').val();
    arrParams.getcantones = true;
    requestHttpAjax(link, arrParams, function (response) {
        if (response.status == "OK") {
            data = response.message;
            setComboData(data.cantones, "cmb_ciudad");
        }
    }, true);
}

$(document).ready(function () {
    InicioFormulario();//Inicia Datos de Formulario
    //loadDataCreate();

    $('#cmb_provincia').change(function () {
        obtenerCanton();
    });

    $('#cmb_objetivo').change(function () {
        //changeObjetivos();
    });

    $('#cmb_usomarca').change(function () {
        changeUsoMarca();
    });
    $('#cmb_ftem_origen').change(function () {
        //Valor por Defecto
        $("#cmb_ftem_personeria").val(0);
    });

    $('#cmb_ftem_personeria').change(function () {
        ModalTipoPersona();
    });

    $('#cmb_ftem_giroprincipal').change(function () {
        //Muestra Campos dependiendo de la opcion
        sectorEmpresa();
    });

    $('#cmb_ftem_trayectoria').change(function () {
        //Muestra Campos para adjuntar Impuesto a la Renta
        mostrarTrayectoria();
    });

    /* DESPLAZAR TAB */
    $('#paso1next').click(function () {
//        $('#paso2').attr('class','active')disable
//         $('#paso1').attr('class','')
        if ($('#cmb_ftem_origen').val() > 0 && $('#cmb_ftem_personeria').val() > 0) {
            if (subirDocumentos(1, false)) {//Subir Documentos
                dataSolicitudPart1();
                disableSolicitudPart2(false);
                $('.nav-tabs a[href="#paso2"]').tab('show')
            }
        } else {
            //alert('Debe seleccionar datos Origen y Tipo de Persona');
            showAlert('NO_OK', 'error', {"wtmessage": 'Debe seleccionar datos Origen y Tipo de Persona', "title":'Información'});
        }

    });
    $('#paso2back').click(function () {
        $('.nav-tabs a:first').tab('show')
    });
    $('#paso2next').click(function () {
        if ($('#cmb_objetivo').val() > 0) {
            if (subirDocumentos(2, false)) {//Subir Documentos
                dataSolicitudPart2();
                disableSolicitudPart3(false);
                capacidadNacional('cmb_provincia_uso');
                capacidadInternacional('cmb_pais_uso');
                $('.nav-tabs a:last').tab('show');
            }
        } else {
            //alert('Debe seleccionar datos de Objetivo de Uso de la Marca');
            showAlert('NO_OK', 'error', {"wtmessage": 'Debe seleccionar datos de Objetivo de Uso de la Marca', "title":'Información'});
        }

    });
    $('#paso3back').click(function () {
        $('.nav-tabs a[href="#paso2"]').tab('show')
    });

    $('#paso3next').click(function () {
        dataSolicitudPart3();
        if(AccionTipo=='Update'){
           guardarSolicitud('Update');
        }else if(AccionTipo=='Create'){
           guardarSolicitud('Create');
        }
    });
    /*GUARDAR INFORMACION*/
    $('#btn_save_1').click(function () {
        dataSolicitudPart1();
        guardarSolicitud('Create', '1');
    });
    $('#btn_save_2').click(function () {
        dataSolicitudPart1();
        dataSolicitudPart2();
        guardarSolicitud('Update', '2');
    });
    $('#btn_save_3').click(function () {
        dataSolicitudPart1();
        dataSolicitudPart2();
        dataSolicitudPart3();
        guardarSolicitud('Update', '3');
    });
    /*DECLARACION*/

    $('#ver_declaracion').click(function () {
        var f = new Date();
        $("#lbl_nombredeclaracion").html($('#txt_ftem_apellido').val() + ' ' + $('#txt_ftem_nombre').val());
        $("#lbl_fechadeclaracion").html(f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
    });

    /*DATOS DE TABLA PRODUCTO*/
    $('#add_Producto').click(function () {
        agregarItemsProducto('new');
    });




});



/*
 OPCIONES DE OTROS USOS DE LA MARCA
 */
function opcionUsoMarca(ids) {
    var link = $('#txth_base').val() + "/mceformulariotemp/usomarca";
    var arrParams = new Object();
    arrParams.umar_id = ids;
    requestHttpAjax(link, arrParams, function (response) {
        if (response.status == "OK") {
            data = response.message;
            mostrarOtrosUsos(data.otrosusos, "div_otrasMarca");
            mensajeOtrosUsos(data.usomarca, "div_mensOtrosUsos");
        }
    }, true);
}

function mensajeOtrosUsos(arr_data, element_id) {
    var option_arr = '';
    option_arr += '<div class="info-alertpb">';
    option_arr += '<h4>' + $('#cmb_usomarca option:selected').text() + '</h4>';
    option_arr += '<p>' + arr_data[0].umar_detalle + '</p>';
    option_arr += '</div>';
    $("#" + element_id).html(option_arr);
}

function mostrarOtrosUsos(arr_data, element_id) {
    var option_arr = '';
    for (var i = 0; i < arr_data.length; i++) {
        var id = arr_data[i].ous_id;
        var value = arr_data[i].ous_nombre;
        option_arr += '<div class="col-md-6">';
        option_arr += '<div class="form-group">';
        option_arr += '<div class="checkbox">';
        option_arr += '<label>';
        option_arr += '<input id="chk_ous' + i + '" type="checkbox" name="orderBox[]" value="' + id + '">';
        option_arr += value;
        option_arr += '</label>';
        option_arr += '</div>';
        option_arr += '</div>';
        option_arr += '</div>';
    }
    $("#" + element_id).html(option_arr);
}

/****** Funcion Change de Marca *****/
function changeUsoMarca() {
    //Se Ejecuta al Cambiar el Select de Uso Marca
    var ids = $('#cmb_usomarca').val();
    //Datos de Evento
    $("#txt_eve_referencia").removeClass("PBvalidation");
    $("#txt_eve_descripcion").removeClass("PBvalidation");
    $("#txt_eve_lugar").removeClass("PBvalidation");
    $("#txt_eve_nombre").removeClass("PBvalidation");

    //Datos de Productos
    $("#txt_detalle_uso").removeClass("PBvalidation");
    $("#txt_prod_nombre").removeClass("PBvalidation");

    //Elimina Datos Expor Servicios
    $("#div_ExporServicio").html('');

    //Aceptar Terminos de Solicitud
    if (ids > 0) {
        $('#chk_aceptar').attr("disabled", false);
    } else {
        $('#chk_aceptar').attr("disabled", true);
        $("#chk_aceptar").prop("checked", false);
    }

    switch (ids) {
        case '1':
            agregarExporServicios();
            opcionUsoMarca(ids);
            $('#div_otrasMarcaOp3').hide();
            $('#div_otrasMarcaOp2').hide();
            break;
        case '2':
            //opcionUsoMarca(ids);
            $('#div_otrasMarcaOp2').show();
            $("#div_otrasMarca").html("");
            $('#div_otrasMarcaOp3').hide();
            //Recarta tabla si existe SessionStore
            //$("#txt_detalle_uso").addClass("PBvalidation");
            //$("#txt_prod_nombre").addClass("PBvalidation");
            if (sessionStorage.dts_Producto) {
                recargarGridProducto();
            }
            break;
        case '3':
            opcionUsoMarca(ids);
            $('#div_otrasMarcaOp3').show();
            $('#div_otrasMarcaOp2').hide();
            //Agrega Clase de Validacion
            $("#txt_eve_referencia").addClass("PBvalidation");
            $("#txt_eve_descripcion").addClass("PBvalidation");
            $("#txt_eve_lugar").addClass("PBvalidation");
            $("#txt_eve_nombre").addClass("PBvalidation");

            break;
        case '4':
            opcionUsoMarca(ids);
            $('#div_otrasMarcaOp3').hide();
            $('#div_otrasMarcaOp2').hide();
            break;
        default:
            $("#div_otrasMarca").html("");
            $('#div_otrasMarcaOp3').hide();
            $('#div_otrasMarcaOp2').hide();

    }
}



function obtenerOtrosUsos() {
    var datArray = [];
    $('input[name="orderBox[]"]:checked').each(function (i, checked) {
        //alert($(checked).val());
        datArray[i] = $(checked).val();
    });
    sessionStorage.chk_otrosUsos = JSON.stringify(datArray);
    return datArray;
}

function recargarOtrosUsos() {
    if (sessionStorage.chk_otrosUsos) {
        var datArray = JSON.parse(sessionStorage.chk_otrosUsos);
        if (datArray.length > 0) {
            for (var i = 0; i < datArray.length; i++) {
                $("#chk_ous" + datArray[i]['ous_id']).prop("checked", true);//Check Los Guardados en la Sesion
            }
        }
    }
}
function sectorEmpresa() {
    var ids = $('#cmb_ftem_giroprincipal option:selected').val();
    switch (ids) {
        case '2':
            $('#div_RegisSanitario').show();
            $('#div_PermisoMitur').hide();
            break;
        case '7':
            $('#div_RegisSanitario').show();
            $('#div_PermisoMitur').hide();
            break;
        case '16':
            $('#div_PermisoMitur').show();
            $('#div_RegisSanitario').hide();
            break;
        default:
            $('#div_PermisoMitur').hide();
            $('#div_RegisSanitario').hide();

    }

}

/******** RECARGA DATOS DINAMICOS ******/
function agregarExporServicios() {
    var option_arr = '';
    option_arr += '<div class="col-md-12">';
    option_arr += '<h3>Exporta sus Servicios</h3>';
    option_arr += '</div>';
    option_arr += '<div class="col-md-2">';
    option_arr += '<div class="form-group">';
    option_arr += '<label class="col-sm-2 control-label" for="txt_prod_nombre"></label>';
    option_arr += '<label class="radio-inline">';
    option_arr += '<input type="radio" value="si" id="rbt_si" name="inlineRadioOptions">Si</label>';
    option_arr += '<label class="radio-inline">';
    option_arr += '<input type="radio" value="no" id="rbt_no" name="inlineRadioOptions">No</label>';
    option_arr += '</div>';
    option_arr += '</div>';
    option_arr += '<div class="col-md-6">';
    option_arr += '<div class="form-group">';
    option_arr += '<label class="col-sm-3 control-label" for="txt_ftem_definicion_sector">Defina su Sector</label>';
    option_arr += '<div class="col-sm-9">';
    option_arr += '<textarea placeholder="Ejemplo: Exporta Software Agropecuario" data-keydown="true" data-type="alfanumerico" id="txt_ftem_definicion_sector" rows="2" class="form-control PBvalidation keyupmce"></textarea>';
    option_arr += '</div>';
    option_arr += '</div>';
    option_arr += '</div>';

    $("#div_ExporServicio").html(option_arr);
}
function agregarCamposPerNatural() {
    var option_arr = '';
    option_arr += '<div class="form-group">';
    option_arr += '<label class="col-sm-3 control-label keyupmce" for="txt_ftem_ruc_persona">RUC</label>';
    option_arr += '<div class="col-sm-9">';
    option_arr += '<input type="text" placeholder="RUC" data-keydown="true" data-type="number" id="txt_ftem_ruc_persona" class="form-control PBvalidation keyupmce" maxlength="15" disabled="disabled">';
    option_arr += '</div>';
    option_arr += '</div>';
    $("#div_ruc_persona").html(option_arr);
}
function agregarCamposPerJuridica() {
    //Agrega Datos Razon Social
    var option_arr = '';
    option_arr += '<div style="display: block;" class="form-group" id="div_razonSocial">';
    option_arr += '<label class="col-sm-3 control-label" for="txt_ftem_razon_social">Razón Social</label>';
    option_arr += '<div class="col-sm-9">';
    option_arr += '<input type="text" placeholder="Razón Social" data-keydown="true" data-type="all" id="txt_ftem_razon_social" class="form-control PBvalidation keyupmce">';
    option_arr += '</div>';
    option_arr += '</div>';
    $("#div_razonSocial").html(option_arr);

    option_arr = '';
    option_arr += '<div class="form-group">';
    option_arr += '<label class="col-sm-3 control-label keyupmce" for="txt_ftem_ruc_empresa">RUC</label>';
    option_arr += '<div class="col-sm-9">';
    option_arr += '<input type="text" placeholder="RUC" data-keydown="true" data-type="number" id="txt_ftem_ruc_empresa" class="form-control PBvalidation keyupmce" maxlength="15">';
    option_arr += '</div>';
    option_arr += '</div>';
    $("#div_ruc_empresa").html(option_arr);

}


/******* GUARDAR SOLICITUD ***********/
function accionGuardar() {
    var message = {
        "wtmessage": "Guardar o enviar datos de solicitud",
        "title": "Información",
        "acciones": [
            {
                "id": "btnl",
                "class": "btn-primary clclass",
                "value": 'Guardar',
                "callback": 'data', //guardarSolicitud('Create'), //guardafuncion
            },
            {
                "id": "btn2",
                "class": "btn-primary clclass",
                "value": 'Enviar',
                "callback": "enviarSolicitud(\"create\")", //guardafuncion
                //"paramCallback":[{"accion":'var1'}],
            },
        ],
    };
    showAlert("OK", "info", message);
    return true;
}
function guardarSolicitud(accion) {
    if ($("#chk_aceptar").prop("checked")) {
        var ID = (accion == "Update") ? $('#txth_ftem_id').val() : 0;
        var link = $('#txth_base').val() + "/mceformulariotemp/save";
        var arrParams = new Object();
        arrParams.DATA_1 = dataSolicitudPart1(ID);
        arrParams.DATA_2 = dataSolicitudPart2();
        arrParams.DATA_3 = dataSolicitudPart3();
        if($('#txt_ftem_usernamen').val() != ""){
            var objDat4 = new Object();
            var darArr4 = new Array;
            objDat4.user_name = $('#txt_ftem_usernamen').val();
            objDat4.user_lastname = $('#txt_ftem_userlastn').val();
            objDat4.user_email = $('#txt_ftem_useremailn').val();
            darArr4[0] = objDat4;
            arrParams.DATA_4 = darArr4;
            sessionStorage.dataSolicitud_4 = JSON.stringify(darArr4);
        }

        arrParams.ACCION = accion;
        //Subir Imagenes

        var validation = validateForm();
        if (!validation) {
            //subirDocumentos(1, true);
            //subirDocumentos(2, true);
            requestHttpAjax(link, arrParams, function (response) {
                var message = response.message;
                if (response.status == "OK") {
                    //var data =response.data;
                    //$('#txth_ftem_id').val(data.ids);
                    //AccionTipo=data.accion;
                    menssajeModal(response.status, response.type, message.info, response.label, "", "", "1");
                    limpiarDatos();
                    var renderurl = $('#txth_base').val() + "/mceformulariotemp/index";
                    window.location = renderurl;
                }else{
                    menssajeModal(response.status, response.type, message.info, response.label, "", "", "1");
                }
            }, true);
        }
    } else {
        //alert('Debe Aceptar los términos de la Declaración Jurada');
        showAlert('NO_OK', 'error', {"wtmessage": 'Debe Aceptar los términos de la Declaración Jurada', "title":'Información'});
    }
}

/*function guardarSolicitud(accion,tab){
 var ID=(accion=="Update")?$('#txth_ftem_id').val():0;
 var link = $('#txth_base').val() + "/mceformulariotemp/save";
 var arrParams = new Object();
 switch (tab) {
 case '1':
 arrParams.DATA_1 = dataSolicitudPart1(ID);
 break;
 case '2':
 arrParams.DATA_1 = dataSolicitudPart1(ID);
 arrParams.DATA_2 = dataSolicitudPart2();
 break;
 case '3':
 arrParams.DATA_1 = dataSolicitudPart1(ID);
 arrParams.DATA_2 = dataSolicitudPart2();
 arrParams.DATA_3 = dataSolicitudPart3();
 break;
 default:
 //$('#div_PermisoMitur').hide();
 }
 arrParams.ACCION = accion;
 requestHttpAjax(link, arrParams, function (response) {
 var message = response.message;
 if (response.status == "OK") {
 var data =response.data;
 $('#txth_ftem_id').val(data.ids);
 AccionTipo=data.accion;
 }
 menssajeModal(response.status, response.type,message.info,response.label,"","","1");
 });
 }*/

function enviarSolicitud(accion) {
    alert(accion);
}

function imgSolicitudPart1() {
    if (sessionStorage.dataSolicitud_1) {
        var datArray = JSON.parse(sessionStorage.dataSolicitud_1);
        if (datArray.length > 0) {
            //Retorna valores de Imagenes guardadas.
            if ($('#txt_ftem_cedula_file').val() == '') {
                $('#txt_ftem_cedula_file').val(datArray[0]['ftem_cedula_file']);
            }
            if ($('#txt_ftem_ruc_file').val() == '') {
                $('#txt_ftem_ruc_file').val(datArray[0]['ftem_ruc_file']);
            }
            if (!($('#div_SuperCompania').is(':hidden'))) {//DIV es visible
                if ($('#txt_ftem_cert_super_compania_file').val() == '') {
                    $('#txt_ftem_cert_super_compania_file').val(datArray[0]['ftem_cert_super_compania_file']);
                }
            }
            if (!($('#div_certificadoVotacion').is(':hidden'))) {
                if ($('#txt_ftem_cer_file').val() == '') {
                    $('#txt_ftem_cer_file').val(datArray[0]['ftem_cert_file']);
                }
            }
            if (!($('#div_RegisSanitario').is(':hidden'))) {
                if ($('#txt_ftem_registro_sanitario_file').val() == '') {
                    $('#txt_ftem_registro_sanitario_file').val(datArray[0]['ftem_registro_sanitario_file']);
                }
            }
            if (!($('#div_PermisoMitur').is(':hidden'))) {
                if ($('#txt_ftem_perm_func_mitur_file').val() == '') {
                    $('#txt_ftem_perm_func_mitur_file').val(datArray[0]['ftem_perm_func_mitur_file']);
                }
            }
        }
    }
}
function imgSolicitudPart2() {
    if (sessionStorage.dataSolicitud_2) {
        var datArray = JSON.parse(sessionStorage.dataSolicitud_2);
        if (datArray.length > 0) {
            //Retorna valores de Imagenes guardadas.
            if ($('#txt_ftem_trayectoria_file').val() == '') {
                $('#txt_ftem_trayectoria_file').val(datArray[0]['ftem_trayectoria_file']);
            }
            if (!($('#div_ftem_imp_renta').is(':hidden'))) {
                if ($('#txt_ftem_imp_renta_file').val() == '') {
                    $('#txt_ftem_imp_renta_file').val(datArray[0]['ftem_imp_renta_file']);
                }
            }
        }
    }
}

/******* DATOS SOLICITUD ***********/
function dataSolicitudPart1(ID) {
    //imgSolicitudPart1();
    var datArray = new Array();
    var objDat = new Object();
    objDat.ftem_id = ID;//Genero Automatico
    objDat.can_id = $('#cmb_ciudad option:selected').val();
    objDat.reg_id = '1';//Ids de Registro
    objDat.ind_id = $('#cmb_ftem_giroprincipal option:selected').val();
    objDat.ftem_origen = $('#cmb_ftem_origen option:selected').val();
    objDat.ftem_personeria = $('#cmb_ftem_personeria option:selected').val();
    objDat.ftem_nombre = $('#txt_ftem_nombre').val();
    objDat.ftem_apellido = $('#txt_ftem_apellido').val();
    objDat.ftem_cedula = $('#txt_ftem_cedula').val();
    objDat.ftem_ruc = (objDat.ftem_personeria == 1) ? $('#txt_ftem_ruc_persona').val() : $('#txt_ftem_ruc_empresa').val();
    objDat.ftem_direccion = $('#txt_ftem_direccion').val();
    objDat.ftem_sitio_web = $('#txt_ftem_sitio_web').val();
    objDat.ftem_cargo_persona = $('#txt_ftem_cargo_persona').val();

    objDat.ftem_contacto = $('#txt_ftem_contacto').val();
    objDat.ftem_contacto_cargo = $('#txt_ftem_contacto_cargo').val();
    objDat.ftem_contacto_correo = $('#txt_ftem_contacto_correo').val();
    objDat.ftem_contacto_telefono = $('#txt_ftem_contacto_telefono').val();
    objDat.pai_id_ext = 56;//$('#cmb_ftem_personeria option:selected').val();
    objDat.ftem_ciudad_ext = '';//$('#txt_ftem_ciudad_ext').val();
    objDat.ftem_correo = $('#txt_ftem_correo').val();
    objDat.ftem_telefono = $('#txt_ftem_telefono').val();
    objDat.ftem_genero = $('#cmb_ftem_genero option:selected').val();
    objDat.ftem_raza_etnica = $('#cmb_ftem_raza_etnica option:selected').val();
    objDat.ftem_tipo_pyme = $('#cmb_ftem_tipo_pyme option:selected').val();
    objDat.ftem_razon_social = (objDat.ftem_personeria == 2) ? $('#txt_ftem_razon_social').val() : '';//Verifica si es juridica para la Razon Soclial
    objDat.ftem_cedula_file = ($('#txth_ftem_cedula_file').val() != '') ? 'cedula.' + getExtension($('#txth_ftem_cedula_file').val()) : '';
    objDat.ftem_ruc_file = ($('#txth_ftem_ruc_file').val() != '') ? 'ruc.' + getExtension($('#txth_ftem_ruc_file').val()) : '';
    objDat.ftem_cert_file = ($('#txth_ftem_cer_file').val() != '') ? 'certificado_votacion.' + getExtension($('#txth_ftem_cer_file').val()) : '';
    objDat.ftem_registro_sanitario_file = ($('#txth_ftem_registro_sanitario_file').val() != '') ? 'registro_sanitario.' + getExtension($('#txth_ftem_registro_sanitario_file').val()) : '';
    objDat.ftem_perm_func_mitur_file = ($('#txth_ftem_perm_func_mitur_file').val() != '') ? 'permiso_mintur.' + getExtension($('#txth_ftem_perm_func_mitur_file').val()) : '';
    objDat.ftem_cert_super_compania_file = ($('#txth_ftem_cert_super_compania_file').val() != '') ? 'super_compania.' + getExtension($('#txth_ftem_cert_super_compania_file').val()) : '';
    objDat.ftem_cert_obligaciones_file = '';//$('#ftem_cert_obligaciones_file').val();

    datArray[0] = objDat;
    sessionStorage.dataSolicitud_1 = JSON.stringify(datArray);
    //return JSON.stringify(datArray);
    return datArray;
}

function dataSolicitudPart2() {
    //imgSolicitudPart2();
    var datArray = new Array();
    //if (sessionStorage.dataSolicitud) {
    //var datArray = JSON.parse(sessionStorage.dataSolicitud);
    var objDat = new Object();
    objDat.obj_id = $('#cmb_objetivo option:selected').val();
    objDat.ftem_detalle = $('#txt_ftem_detalle').val();
    objDat.ftem_giroprincipal = $('#txt_ftem_giroprincipal').val();
    objDat.ftem_mision = $('#txt_ftem_mision').val();
    objDat.ftem_vision = '';
    $('#txt_ftem_vision').val();
    objDat.ftem_referencia = $('#txt_ftem_referencia').val();
    objDat.ftem_trayectoria = $('#cmb_ftem_trayectoria option:selected').val();
    objDat.ftem_trayectoria_file = ($('#txth_ftem_trayectoria_file').val() != '') ? 'trayectoria.' + getExtension($('#txth_ftem_trayectoria_file').val()) : '';
    objDat.ftem_imp_renta_file = ($('#txth_ftem_imp_renta_file').val() != '') ? 'impuesto_renta.' + getExtension($('#txth_ftem_imp_renta_file').val()) : '';
    objDat.ftem_nivelNacional = capacidadNacional('cmb_provincia_uso');
    objDat.ftem_nivelInternacional = capacidadInternacional('cmb_pais_uso');
    //objDat.sobj_id = $('#cmb_subobjetivo option:selected').val();
    //objDat.ftem_motivo = $('#cmb_objetivo option:selected').val();//Cambiar por SubObjetivo
    datArray[0] = objDat;
    sessionStorage.dataSolicitud_2 = JSON.stringify(datArray);
    //return JSON.stringify(datArray);
    return datArray;
    //}
}

function dataSolicitudPart3() {
    var datArray = new Array();
    //if (sessionStorage.dataSolicitud) {
    //var datArray = JSON.parse(sessionStorage.dataSolicitud);
    var objDat = new Object();
    objDat.etem_nombre = $('#txt_eve_nombre').val();
    objDat.ftem_condiciones = ($("#chk_aceptar").prop("checked")) ? 1 : 0;
    //objDat.ftem_decl_jurada_file = $('#txt_ftem_decl_jurada_file').val();
    objDat.umar_id = $('#cmb_usomarca option:selected').val();//Uso Marca
    objDat.ftem_otrosUsos = obtenerOtrosUsos();
    objDat.etem_nombre = $('#txt_eve_nombre').val();
    objDat.etem_descripcion = $('#txt_eve_descripcion').val();
    objDat.etem_referencia = $('#txt_eve_referencia').val();
    objDat.etem_fecha = '';//$('#txt_eve_fecha').val();
    objDat.etem_lugar = $('#txt_eve_lugar').val();
    //Datos de Servicios
    objDat.ftem_exporta_servicio = ($("#rbt_si").prop("checked")) ? 'SI' : 'NO';
    objDat.ftem_definicion_sector = $('#txt_ftem_definicion_sector').val();
    //Datos de Producto
    objDat.data_producto = (sessionStorage.dts_Producto) ? sessionStorage.dts_Producto : new Array();
    datArray[0] = objDat;
    //alert(datArray.toSource());
    sessionStorage.dataSolicitud_3 = JSON.stringify(datArray);
    //return JSON.stringify(datArray);
    return datArray;
    //}

}

/* INFORMACION DE OTROS USOS OPCION 2*/
function agregarItemsProducto(opAccion) {
    var tGrid = 'TbG_Productos';
    var nombre = $('#txt_prod_nombre').val();
    //Verifica que tenga nombre producto y tenga foto
    if ($('#txt_prod_nombre').val() != "" && $('#txth_producto_foto').val() != "") {
        var valor = $('#txt_prod_nombre').val();
        if (opAccion != "edit") {
            //*********   AGREGAR ITEMS *********
            var arr_Grid = new Array();
            if (sessionStorage.dts_Producto) {
                /*Agrego a la Sesion*/
                arr_Grid = JSON.parse(sessionStorage.dts_Producto);
                var size = arr_Grid.length;
                if (size > 0) {
                    //Varios Items
                    if (codigoExiste(nombre, 'pro_nombre', sessionStorage.dts_Producto)) {//Verifico si el Codigo Existe  para no Dejar ingresar Repetidos
                        arr_Grid[size] = objProducto(size); //objAntDep(retornarIndexArray(JSON.parse(sessionStorage.atc_antDeporte),'DEP_NOMBRE',valor),JSON.parse(sessionStorage.atc_antDeporte));
                        sessionStorage.dts_Producto = JSON.stringify(arr_Grid);
                        addVariosItemProducto(tGrid, arr_Grid, -1);
                        limpiarDetalle();
                    } else {
                        menssajeModal("OK", "error", "Item ya existe en su lista", "Información", "", "", "1");
                    }
                } else {
                    /*Agrego a la Sesion*/
                    //Primer Items
                    //arr_Grid[0] = objAntDep(retornarIndexArray(JSON.parse(sessionStorage.atc_antDeporte),'DEP_NOMBRE',valor),JSON.parse(sessionStorage.atc_antDeporte));
                    arr_Grid[0] = objProducto(0);
                    sessionStorage.dts_Producto = JSON.stringify(arr_Grid);
                    addPrimerItemProducto(tGrid, arr_Grid, 0);
                    limpiarDetalle();
                }
            } else {
                //No existe la Session
                //Primer Items
                //arr_Grid[0] = objAntDep(retornarIndexArray(JSON.parse(sessionStorage.dts_Producto),'pro_nombre',valor),JSON.parse(sessionStorage.dts_Producto));
                arr_Grid[0] = objProducto(0);
                sessionStorage.dts_Producto = JSON.stringify(arr_Grid);
                addPrimerItemProducto(tGrid, arr_Grid, 0);
                limpiarDetalle();
            }
        } else {
            //data edicion
        }
    } else {
        menssajeModal("NO_OK", "Error", "No Existe datos de Producto Y/o Imagen", "Información", "", "", "1");
    }
}
function limpiarDetalle() {
    $('#txt_prod_nombre').val("");
    $('#txt_detalle_uso').val("");
    $("#cmb_por_id option[value=3]").attr("selected", true);
    $('#chk_envase').prop('checked', false);
    $('#chk_empaque').prop('checked', false);
    $('#chk_etiqueta').prop('checked', false);
    $('#chk_publicidad').prop('checked', false);
    $('#chk_otros').prop('checked', false);
    //Quita los Alertas
    removeIco('#txt_prod_nombre');
    removeIco('#txt_detalle_uso');
    //$('#txt_producto_foto').fileinput('upload');
    $('#txth_producto_foto').val("");
    $('#txt_producto_foto').val("");
    $('#txt_producto_foto').fileinput('enable');
    $('#txt_producto_foto').fileinput('refresh');
}

function objProducto(indice) {
    ItemNum=indice;
    var rowGrid = new Object();
    rowGrid.pro_id = indice;
    rowGrid.pro_ftem_id = 0;
    rowGrid.pro_nombre = $('#txt_prod_nombre').val();
    rowGrid.pro_porcentaje = $('#cmb_por_id option:selected').val();
    rowGrid.pro_porcentaje_value = $('#cmb_por_id option:selected').text();
    rowGrid.pro_foto = limpiarFake($('#txth_producto_foto').val());
    rowGrid.pro_detalle_uso = $('#txt_detalle_uso').val();
    rowGrid.pro_envase = ($("#chk_envase").prop("checked")) ? 1 : 0;
    rowGrid.pro_empaque = ($("#chk_empaque").prop("checked")) ? 1 : 0;
    rowGrid.pro_etiqueta = ($("#chk_etiqueta").prop("checked")) ? 1 : 0;
    rowGrid.pro_publicidad = ($("#chk_publicidad").prop("checked")) ? 1 : 0;
    rowGrid.pro_otros = ($("#chk_otros").prop("checked")) ? 1 : 0;
    rowGrid.accion = "new";
    return rowGrid;
}

function limpiarFake(ruta){
    var pro_fotoFile=ruta;
    pro_fotoFile = pro_fotoFile.replace( /C:\\fakepath\\/i, "" );
    pro_fotoFile = pro_fotoFile.replace( /C:\/fakepath\//i, "" );
    return pro_fotoFile;
}

function addPrimerItemProducto(TbGtable, lista, i) {
    /*Remuevo la Primera fila*/
    $('#' + TbGtable + ' >table >tbody').html("");
    /*Agrego a la Tabla de Detalle*/
    $('#' + TbGtable + ' tr:last').after(retornaFilaProducto(i, lista, TbGtable, true));
}

function addVariosItemProducto(TbGtable, lista, i) {
    //i=(i==-1)?($('#'+TbGtable+' tr').length)-1:i;
    i = ($('#' + TbGtable + ' tr').length) - 1;
    //$('#'+TbGtable+' >table >tbody').append(retornaFilaProducto(i,lista,TbGtable,true));
    $('#' + TbGtable + ' tr:last').after(retornaFilaProducto(i, lista, TbGtable, true));
}

function retornaFilaProducto(c, Grid, TbGtable, op) {
    //var RutaImagenAccion='ruta IMG'//$('#txth_rutaImg').val();
    var strFila = "";
    //var imgCol='<img class="btn-img" src="'+RutaImagenAccion+'/acciones/eliminar.png" >';
    strFila += '<td style="display:none; border:none;">' + Grid[c]['pro_id'] + '</td>';
    strFila += '<td>' + Grid[c]['pro_nombre'] + '</td>';
    strFila += '<td>' + Grid[c]['pro_porcentaje_value'] + '</td>';
    //strFila +='<td>'+ Grid[c]['pro_foto']+'</td>';
    strFila += '<td>';
    //Cuando hay Actualizacion de Datos
    if(AccionTipo=="Update"){
        var imgFoto=(Grid[c]['accion']=='edit')?Grid[c]['pro_foto']:limpiarFake($('#txth_producto_foto').val());
        strFila += (Grid[c]['pro_foto'] != "") ? '<a data-title="'+ Grid[c]['pro_nombre'] +'" data-lightbox="image-'+Math.floor((Math.random() * 10) + 1)+'" href="' + $('#txth_imgfolder').val() + $('#txt_ftem_cedula').val()+'_'+$('#txth_ftem_id').val() + '/productos/' + imgFoto + '">Ver Foto</a>' : '<span class="label label-danger">No Tiene Foto</span>';
    }else{
        strFila += (Grid[c]['pro_foto'] != "") ? '<a data-title="'+ Grid[c]['pro_nombre'] +'" data-lightbox="image-'+Math.floor((Math.random() * 10) + 1)+'" href="' + $('#txth_imgfolder').val() + $('#txt_ftem_cedula').val() + '/productos/' + limpiarFake($('#txth_producto_foto').val()) + '">Ver Foto</a>' : '<span class="label label-danger">No Tiene Foto</span>';
    }
    strFila += '</td>';
    //strFila +='<td>'+ Grid[c]['pro_detalle_uso']+'</td>';
    strFila += '<td>';//¿Está seguro de eliminar este elemento?
    //strFila +='<a class="btn-img" onclick="eliminarItemsProducto('+Grid[c]['DEP_ID']+',\''+TbGtable+'\')" >'+imgCol+'</a>';
    strFila += '<a onclick="eliminarItemsProducto(\'' + Grid[c]['pro_id'] + '\',\'' + TbGtable + '\')" ><span class="glyphicon glyphicon-trash"></span></a>';
    strFila += '</td>';

    if (op) {
        strFila = '<tr>' + strFila + '</tr>';
    }
    return strFila;
}

// Recarga la Grid de Productos si Existe
function recargarGridProducto() {
    var tGrid = 'TbG_Productos';
    if (sessionStorage.dts_Producto) {
        var arr_Grid = JSON.parse(sessionStorage.dts_Producto);
        if (arr_Grid.length > 0) {
            $('#' + tGrid + ' > tbody').html("");
            for (var i = 0; i < arr_Grid.length; i++) {
                $('#' + tGrid + ' > tbody:last-child').append(retornaFilaProducto(i, arr_Grid, tGrid, true));
            }
        }
    }
}

function eliminarItemsProducto(val, TbGtable) {
    var ids = "";
    //var count=0;
    if (sessionStorage.dts_Producto) {
        var Grid = JSON.parse(sessionStorage.dts_Producto);
        if (Grid.length > 0) {
            $('#' + TbGtable + ' tr').each(function () {
                ids = $(this).find("td").eq(0).html();
                if (ids == val) {
                    var array = findAndRemove(Grid, 'pro_id', ids);
                    sessionStorage.dts_Producto = JSON.stringify(array);
                    //if (count==0){sessionStorage.removeItem('detalleGrid')}
                    $(this).remove();
                }
            });
        }
    }
}

/* FIN INFORMACION DE OTROS USOS OPCION 2*/

/********CAPACIDAD DE ELEVAR LA IMAGEN PAIS
 // NIVEL NACIONAL y INTERNACIONAL
 // SELEC MULTIPLES *****/
function capacidadNacional(elemento) {
    var dat = [];
    $('#' + elemento + ' :selected').each(function (i, selected) {
        //alert($(selected).text());
        dat[i] = $(selected).val();
    });
    sessionStorage.cmb_dataNacional = JSON.stringify(dat);
    return dat;
}
function capacidadInternacional(elemento) {
    var dat = [];
    $('#' + elemento + ' :selected').each(function (i, selected) {
        dat[i] = $(selected).val();
    });
    sessionStorage.cmb_dataInternacional = JSON.stringify(dat);
    return dat;
}
/*************  FIN SELECT  **********/

/***** OBJETIVOS DE LA MARCA  *******/
function changeObjetivos() {
    var link = $('#txth_base').val() + "/mceformulariotemp/create";
    var arrParams = new Object();
    arrParams.obj_id = $('#cmb_objetivo').val();
    arrParams.getobjetivos = true;
    requestHttpAjax(link, arrParams, function (response) {
        if (response.status == "OK") {
            var data = response.message;
            setComboData(data.subObjetivo, "cmb_subobjetivo");
        }
    });
}
/***** FIN OBJETIVOS DE LA MARCA  *******/

/********************************************
 * DATOS
 * VALIDACIN DE SOLICITUD
 ********************************************/
function disableSolicitudPart1(valor) {
    var estado = (!valor) ? 'enable' : 'disable';
    //$('#cmb_ftem_origen').attr("disabled", valor);
    //$('#cmb_ftem_personeria').attr("disabled", valor);
    $('#cmb_provincia').attr("disabled", valor);
    $('#cmb_ciudad').attr("disabled", valor);
    $('#cmb_ftem_giroprincipal').attr("disabled", valor);
    $('#cmb_ftem_tipo_pyme').attr("disabled", valor);
    $('#txt_ftem_razon_social').attr("disabled", valor);
    $('#txt_ftem_nombre').attr("disabled", valor);
    $('#txt_ftem_apellido').attr("disabled", valor);
    $('#txt_ftem_cedula').attr("disabled", valor);
    $('#txt_ftem_ruc_persona').attr("disabled", valor);
    $('#txt_ftem_ruc_empresa').attr("disabled", valor);
    $('#txt_ftem_direccion').attr("disabled", valor);
    $('#txt_ftem_sitio_web').attr("disabled", valor);
    $('#txt_ftem_contacto').attr("disabled", valor);
    $('#txt_ftem_direccion').attr("disabled", valor);
    $('#txt_ftem_correo').attr("disabled", valor);
    $('#txt_ftem_telefono').attr("disabled", valor);
    $('#txt_ftem_cargo_persona').attr("disabled", valor);
    $('#txt_ftem_contacto_cargo').attr("disabled", valor);
    $('#txt_ftem_contacto_correo').attr("disabled", valor);
    $('#txt_ftem_contacto_telefono').attr("disabled", valor);
    $('#cmb_ftem_genero').attr("disabled", valor);
    $('#cmb_ftem_raza_etnica').attr("disabled", valor);

    //Habilita Uploader

    //$('#txt_ftem_cedula_file').attr("disabled", valor);
    //$('#txt_ftem_ruc_file').attr("disabled", valor);
    //$('#txt_ftem_cer_file').attr("disabled", valor);

    if (!valor) {
        $('#txt_ftem_cedula_file').fileinput('enable');
        $('#txt_ftem_ruc_file').fileinput('enable');
        $('#txt_ftem_cer_file').fileinput('enable');
    } else {
        $('#txt_ftem_cedula_file').attr("disabled", valor);
        $('#txt_ftem_ruc_file').attr("disabled", valor);
        $('#txt_ftem_cer_file').attr("disabled", valor);
    }

}
function disableSolicitudPart2(valor) {
    $('#cmb_objetivo').attr("disabled", valor);
    //$('#cmb_subobjetivo').attr("disabled", valor);
    $('#txt_ftem_detalle').attr("disabled", valor);
    $('#txt_ftem_giroprincipal').attr("disabled", valor);
    $('#txt_ftem_vision').attr("disabled", valor);
    $('#txt_ftem_mision').attr("disabled", valor);
    $('#txt_ftem_referencia').attr("disabled", valor);
    $('#cmb_ftem_trayectoria').attr("disabled", valor);
    $('#cmb_provincia_uso').attr("disabled", valor);
    $('#cmb_pais_uso').attr("disabled", valor);

    //$('#txt_ftem_imp_renta').attr("disabled", valor);
    $('#txt_ftem_trayectoria_file').attr("disabled", valor);
}
function disableSolicitudPart3(valor) {
    $('#cmb_usomarca').attr("disabled", valor);
    $('#chk_aceptar').attr("disabled", true);
}

function limpiarDatos() {
    //PARTE 1
    $('#cmb_ftem_origen').val(0);
    $('#cmb_ftem_personeria').val(0);
    $('#cmb_provincia').val(0);
    $('#cmb_ciudad').val(0);
    $('#cmb_ftem_genero').val(0);
    $('#cmb_ftem_raza_etnica').val(0);
    $('#cmb_ftem_giroprincipal').val(0);
    $('#cmb_ftem_tipo_pyme').val(0);

    $('#txt_ftem_razon_social').val('');
    $('#txt_ftem_nombre').val('');
    $('#txt_ftem_apellido').val('');
    $('#txt_ftem_cedula').val('');
    $('#txt_ftem_ruc_persona').val('');
    $('#txt_ftem_ruc_empresa').val('');
    $('#txt_ftem_cargo_persona').val('');
    $('#txt_ftem_direccion').val('');
    $('#txt_ftem_sitio_web').val('');
    $('#txt_ftem_correo').val('');
    $('#txt_ftem_telefono').val('');
    $('#txt_ftem_contacto').val('');
    $('#txt_ftem_contacto_cargo').val('');
    $('#txt_ftem_contacto_correo').val('');
    $('#txt_ftem_contacto_telefono').val('');

    //PARTE 2
    $('#cmb_objetivo').val(0);
    $('#cmb_ftem_trayectoria').val(0);
    //$('#cmb_subobjetivo').attr("disabled", valor);
    $('#txt_ftem_detalle').val('');
    $('#txt_ftem_giroprincipal').val('');
    //$('#txt_ftem_vision').val('');
    $('#txt_ftem_mision').val('');
    $('#txt_ftem_referencia').val('');
    //$('#cmb_provincia_uso').val('');
    //$('#cmb_pais_uso').val('');

    //PARTE 3
    $('#cmb_usomarca').val(0);
    $('#txt_ftem_definicion_sector').val('');
    $('#txt_eve_nombre').val('');
    $('#txt_eve_lugar').val('');
    $('#txt_eve_descripcion').val('');
    $('#txt_eve_referencia').val('');

    //Clear Uploads
    if ($('#txt_ftem_cedula_file').val() != '') {//Verifico si tiene Datos
        $('#txt_ftem_cedula_file').fileinput('refresh');
    }
    if ($('#txt_ftem_ruc_file').val() != '') {//Verifico si tiene Datos
        $('#txt_ftem_ruc_file').fileinput('refresh');
    }
    if (!($('#div_SuperCompania').is(':hidden'))) {//DIV es visible
        $('#txt_ftem_cert_super_compania_file').fileinput('refresh');
    }
    if (!($('#div_certificadoVotacion').is(':hidden'))) {
        $('#txt_ftem_cer_file').fileinput('refresh');
    }
    if (!($('#div_RegisSanitario').is(':hidden'))) {
        $('#txt_ftem_registro_sanitario_file').fileinput('refresh');
    }
    if (!($('#div_PermisoMitur').is(':hidden'))) {
        $('#txt_ftem_perm_func_mitur_file').fileinput('refresh');
    }
    if ($('#txt_ftem_trayectoria_file').val() != '') {//Verifico si tiene Datos
        $('#txt_ftem_trayectoria_file').fileinput('refresh');
    }
    if (!($('#div_ftem_imp_renta').is(':hidden'))) {
        $('#txt_ftem_imp_renta').fileinput('refresh');
    }

    //removeIco('#txt_eve_referencia');
    removeIcos();//Remover Alertas Iconos Todos

    //Destruir Sesiones
    sessionStorage.removeItem('chk_otrosUsos');
    sessionStorage.removeItem('cmb_dataInternacional');
    sessionStorage.removeItem('cmb_dataNacional');
    sessionStorage.removeItem('dataSolicitud_1');
    sessionStorage.removeItem('dataSolicitud_2');
    sessionStorage.removeItem('dataSolicitud_3');
    sessionStorage.removeItem('dts_Producto');
}

/********************************************
 * DATOS
 * VER COMENTARIOS DE SOLICITUD
 * Retorno de Valores a  los campos
 ********************************************/
function verCorrecciones(ids) {
    var link = $('#txth_base').val() + "/mceformulariotemp/viewmessage";
    var arrParams = new Object();
    arrParams.ids = ids;
    requestHttpAjax(link, arrParams, function (response) {
        var data = response.message;
        if (response.status == "OK") {
            divComentario(data.dataComentario);
        }
        //showAlert(response.status, response.type, {"wtmessage": data.info, "title": response.label});
    }, true);
}

function divComentario(data) {
    //$("#countMensaje").html(data.length);
    var option_arr = '';
    option_arr += '<div style="overflow-y: scroll;height:200px;">';
    for (var i = 0; i < data.length; i++) {
        option_arr += '<div class="post clearfix">';
            option_arr += '<div class="user-block">';
                option_arr += '<span>';
                    option_arr += '<a href="#">'+(data[i]["Nombres"]).toUpperCase()+'</a>';
                    //option_arr += '<a onclick="deleteComentario(\'' + data[i]['Ids'] + '\')" class="pull-right btn-box-tool" href="#"><i class="fa fa-times"></i></a>';
                option_arr += '</span><br>';
                option_arr += '<span>'+(data[i]["fecha"]).toUpperCase()+'</span>';
            option_arr += '</div>';
            option_arr += '<p>'+(data[i]["Mensaje"]).toUpperCase()+'</p>';
        option_arr += '</div>';
    }
    option_arr += '</div>';
    showAlert("OK", "info", {"wtmessage": option_arr, "title": "Correcciones"});
}


/********************************************
 * DATOS
 * MODIFICAION DE LA SOLICITUD
 * Retorno de Valores a  los campos
 ********************************************/
function loadDataUpdate() {
    mostrarDatosSolicitud(varSolicitud, varnivelInt, varnivelNac, vareventos,varotrousos,varproducto);
}

function mostrarDatosSolicitud(varSol, valInt, valNac, valEvent,valOtroUso,valProducto) {
    iniciarUpload();
    sessionStorage.removeItem('dts_Producto');
    //PARTE 1
    $('#txth_ftem_id').val(varSol[0]['Ids']);
    $("#cmb_ftem_origen option[value=" + varSol[0]['Origen'] + "]").attr("selected", true);
    $("#cmb_ftem_personeria option[value=" + varSol[0]['Personeria'] + "]").attr("selected", true);
    ModalTipoPersona();//Actualiza Datos Tipo Persona
    $('#cmb_provincia').val(varSol[0]['prov_id']);
    $('#cmb_ciudad').val(varSol[0]['can_id']);
    //obtenerCanton();


    $("#cmb_ftem_giroprincipal option[value=" + varSol[0]['ind_id'] + "]").attr("selected", true);
    sectorEmpresa();//Datos Dependiendo del Sector
    $("#cmb_ftem_tipo_pyme option[value=" + varSol[0]['Pyme'] + "]").attr("selected", true);

    $('#txt_ftem_razon_social').val(varSol[0]['RazonSocial']);
    $('#txt_ftem_nombre').val(varSol[0]['Nombre']);
    $('#txt_ftem_apellido').val(varSol[0]['Apellido']);
    $('#txt_ftem_cedula').val(varSol[0]['Cedula']);
    if (varSol[0]['Personeria'] == '1') {$('#txt_ftem_ruc_persona').val(varSol[0]['Ruc'])}else{$('#txt_ftem_ruc_empresa').val(varSol[0]['Ruc'])}

    $('#txt_ftem_direccion').val(varSol[0]['Direccion']);
    $('#txt_ftem_sitio_web').val(varSol[0]['Sitio']);

    $('#txt_ftem_correo').val(varSol[0]['Correo']);
    $('#txt_ftem_cargo_persona').val(varSol[0]['Cargo_Persona']);
    $('#txt_ftem_telefono').val(varSol[0]['Telefono']);
    $('#cmb_ftem_raza_etnica').val(varSol[0]['Etnica']);

    $('#txt_ftem_contacto').val(varSol[0]['Contacto']);
    $('#txt_ftem_contacto_cargo').val(varSol[0]['ContactoCargo']);
    $('#txt_ftem_contacto_correo').val(varSol[0]['ContactoCorreo']);
    $('#txt_ftem_contacto_telefono').val(varSol[0]['ContactoTelefono']);

    //PARTE 2
    $('#cmb_objetivo').val(varSol[0]['obj_id']);
    $('#txt_ftem_detalle').val(varSol[0]['DetalleObjetivo'])
    $('#txt_ftem_giroprincipal').val(varSol[0]['Actividad']);
    $('#txt_ftem_vision').val(varSol[0]['Vision']);
    $('#txt_ftem_mision').val(varSol[0]['Mision']);
    $('#txt_ftem_referencia').val(varSol[0]['Referencia']);
    $('#cmb_ftem_trayectoria').val(varSol[0]['Trayectoria']);
    mostrarTrayectoria();

    //PARTE 3
    $("#cmb_usomarca option[value=" + varSol[0]['umar_id'] + "]").attr("selected", true);
    changeUsoMarca();
    if(varSol[0]['Condiciones']==1){$("#chk_aceptar").prop("checked", true);}

    for (var i = 0; i < valInt.length; i++) {
        $("#cmb_pais_uso option[value=" + valInt[i]['pai_id'] + "]").attr("selected", true);
    }
    for (var i = 0; i < valNac.length; i++) {
        $("#cmb_provincia_uso option[value=" + valNac[i]['prov_id'] + "]").attr("selected", true);
    }
    switch (varSol[0]['umar_id']) {
        case '1':
            //Habilita los Check
            setTimeout(function(){recuperaOtrosUsos(valOtroUso)},nsegundos);
            if(varSol[0]['ExporServicio']=='SI'){$("#rbt_si").prop("checked", true)}else{$("#rbt_no").prop("checked", true)}
            $('#txt_ftem_definicion_sector').val(varSol[0]['DefinicionSector']);
            break;
        case '2':
            //valProducto
            mostrarGridProducto(valProducto);
            break;
        case '3':
            $('#txt_eve_nombre').val(valEvent[0]['Nombre']);
            $('#txt_eve_lugar').val(valEvent[0]['Lugar']);
            $('#txt_eve_descripcion').val(valEvent[0]['Descripcion']);
            $('#txt_eve_referencia').val(valEvent[0]['Referencia']);
            break;
        case '4':
            //Habilita los Check
            setTimeout(function(){recuperaOtrosUsos(valOtroUso)},nsegundos);
            break;
        default:

    }
    //IMAGENES 
    $('#txth_ftem_cedula_file').val((varSol[0]['CedulaFile']!= '')?varSol[0]['CedulaFile']:'');
    $('#txth_ftem_ruc_file').val((varSol[0]['RucFile']!= '')?varSol[0]['RucFile']:'');
    $('#txth_ftem_cer_file').val((varSol[0]['CertFile']!= '')?varSol[0]['CertFile']:'');
    $('#txth_ftem_registro_sanitario_file').val((varSol[0]['RegSanFile']!= '')?varSol[0]['RegSanFile']:'');
    $('#txth_ftem_perm_func_mitur_file').val((varSol[0]['PermMinturFile']!= '')?varSol[0]['PermMinturFile']:'');
    $('#txth_ftem_cert_super_compania_file').val((varSol[0]['CertSuperFile']!= '')?varSol[0]['CertSuperFile']:'');
    $('#txth_ftem_trayectoria_file').val((varSol[0]['TrayectoriaFile']!= '')?varSol[0]['TrayectoriaFile']:'');
    $('#txth_ftem_imp_renta_file').val((varSol[0]['ImpRentFile']!= '')?varSol[0]['ImpRentFile']:'');
    
}

function opcionUsoMarcaUpdate(ids,valOtroUso) {
    var link = $('#txth_base').val() + "/mceformulariotemp/usomarca";
    var arrParams = new Object();
    arrParams.umar_id = ids;
    requestHttpAjax(link, arrParams, function (response) {
        if (response.status == "OK") {
            data = response.message;
            mostrarOtrosUsos(data.otrosusos, "div_otrasMarca");
            mensajeOtrosUsos(data.usomarca, "div_mensOtrosUsos");
            recuperaOtrosUsos(valOtroUso);
        }
    }, true);
}

function recuperaOtrosUsos(valOtroUso) {
    for (var i = 0; i < valOtroUso.length; i++) {
        //alert("#chk_ous"+valOtroUso[i]['ous_id']);
        $("#chk_ous"+ valOtroUso[i]['ous_id']).prop("checked", true);
    }
}

function mostrarGridProducto(Grid){
    var tGrid='TbG_Productos';
    var datArray = new Array();
    if(Grid.length > 0){
        $('#' + tGrid + ' > tbody').html("");
        for(var i=0; i<Grid.length; i++){
            datArray[i]=objProductoUpdate(i,Grid)
            $('#' + tGrid + ' > tbody:last-child').append(retornaFilaProducto(i, datArray, tGrid, true));
        }
        sessionStorage.dts_Producto = JSON.stringify(datArray);
    }
}

function objProductoUpdate(i,Grid) {
    var rowGrid = new Object();
    rowGrid.pro_id = Grid[i]['ProId'];
    rowGrid.pro_ftem_id = Grid[i]['FtemId'];
    rowGrid.pro_nombre = Grid[i]['Nombre'];
    rowGrid.pro_porcentaje = Grid[i]['PorId'];
    rowGrid.pro_porcentaje_value = Grid[i]['Porcentaje'];
    rowGrid.pro_foto = Grid[i]['foto'];
    rowGrid.pro_detalle_uso = Grid[i]['Detalle'];
    rowGrid.pro_envase = Grid[i]['ptem_envase'];
    rowGrid.pro_empaque = Grid[i]['ptem_empaque'];
    rowGrid.pro_etiqueta = Grid[i]['ptem_etiqueta'];
    rowGrid.pro_publicidad = Grid[i]['ptem_publicidad'];
    rowGrid.pro_otros = Grid[i]['ptem_otros'];
    rowGrid.accion = "edit";
    return rowGrid;
}
