/* 
 * The PenBlu framework is free software. It is released under the terms of
 * the following BSD License.
 *
 * Copyright (C) 2015 by PenBlu Software (http://www.penblu.com)
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *  - Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 *  - Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in
 *    the documentation and/or other materials provided with the
 *    distribution.
 *  - Neither the name of PenBlu Software nor the names of its
 *    contributors may be used to endorse or promote products derived
 *    from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * PenBlu is based on code by
 * Yii Software LLC (http://www.yiisoft.com) Copyright Â© 2008
 *
 * Authors:
 *
 * Eduardo Cueva <edu19432@gmail.com>
 * Byron Villacreses <byronvillacreses@gmail.com>
 */

$(document).ready(function () {

    $('#cmb_estado').change(function () {
        actualizarGrid();
    });
    $('#cmb_usomarca').change(function () {
        actualizarGrid();
    });
    $('#cmd_buscarData').click(function () {
        actualizarGrid();
    });
    $('#sendMessage').click(function(){
        enviarComentario();    
    });
    $('#deleteComentario').click(function(){
        deleteComentario();    
    });
}); 

function retornarIndLista(array,property,value,ids){
    var index=-1;
    for(var i=0; i<array.length; i++){
        if(array[i][property]==value){
            index=array[i][ids];
            return index;
        }
    }
    //Retorna  -1 si no esta en ls lista
    return index;
}

function rechazarSolicitud(ids) {
    //$('#TbG_SOLICITUD').PbGridView('applyFilterData',{'ids':ids,'op':'Delete'});
    if (confirm("Está seguro de que desea continuar?") == true) {
        var link = $('#txth_base').val() + "/mceformulario/rechazar";
        var arrParams = new Object();
        arrParams.ids = ids;
        //arrParams.ACCION = "Rechazar";
        requestHttpAjax(link, arrParams, function (response) {
            var data = response.message;
            if (response.status == "OK") {
                //$('#TbG_SOLICITUD').PbGridView('updatePAjax');
                actualizarGrid();
            }
            //var message = {"wtmessage": data.info,"title": response.label};
            showAlert(response.status, response.type, {"wtmessage": data.info, "title": response.label});
        },true);
    }
}

function autorizarSolicitud(ids) {
    if (confirm("Está seguro de que desea continuar?") == true) {
        //x = "You pressed OK!";
        var link = $('#txth_base').val() + "/mceformulario/autorizar";
        var arrParams = new Object();
        arrParams.ids = ids;
        //arrParams.ACCION = "Autorizar";
        requestHttpAjax(link, arrParams, function (response) {
            var data = response.message;
            if (response.status == "OK") {
                actualizarGrid();
            }
            showAlert(response.status, response.type, {"wtmessage": data.info, "title": response.label});
        },true);
    }
}

function actualizarGrid(){
    var estado=$('#cmb_estado option:selected').val();
    var licencia=$('#cmb_usomarca option:selected').val();
    var f_ini =$('#dtp_f_inicio').val();
    var f_fin =$('#dtp_f_fin').val();
    var valor='';//$('#txt_buscarData').val();
    //Codigo para AutoComplete
    if(sessionStorage.src_buscIndex){
        //var arrayList = JSON.parse(sessionStorage.src_buscIndex);
        //Cedula=retornarIndLista(arrayList,'RazonSocial',$('#txt_buscarData').val(),'Cedula');
        valor=$('#txth_ids').val();
    } 
    //Buscar almenos una clase con el nombre para ejecutar
    if(!$(".blockUI").length){
        showLoadingPopup();
        $('#TbG_SOLICITUD').PbGridView('applyFilterData',{'estado':estado,'f_ini':f_ini,'f_fin':f_fin,'licencia':licencia,'valor':valor,'op':'1'});
        setTimeout(hideLoadingPopup,2000);
    }
}

function enviarComentario() {
    if ($('#txt_message').val() != '') {
        if (confirm("Está seguro de que desea continuar?") == true) {
            var link = $('#txth_base').val() + "/mceformulario/message";
            var arrParams = new Object();
            arrParams.ids = $('#txth_ftem_id').val();
            arrParams.message = $('#txt_message').val();
            requestHttpAjax(link, arrParams, function (response) {
                var data = response.message;
                if (response.status == "OK") {
                    divComentario(data.dataComentario);
                    $('#txt_message').val('');
                }
                showAlert(response.status, response.type, {"wtmessage": data.info, "title": response.label});
            },true);
        }
    } else {
        showAlert('NO_OK', 'error', {"wtmessage": "Ingresar Mensaje!!!", "title": "Información"});
    }

}

function divComentario(data) {
    $("#countMensaje").html(data.length);
    var option_arr = '';
    for (var i = 0; i < data.length; i++) {
        option_arr += '<div class="post clearfix">';
            option_arr += '<div class="user-block">';
                option_arr += '<span>';
                    option_arr += '<a href="#">'+(data[i]["Nombres"]).toUpperCase()+'</a>';
                    option_arr += '<a onclick="deleteComentario(\'' + data[i]['Ids'] + '\')" class="pull-right btn-box-tool" href="#"><i class="fa fa-times"></i></a>';
                option_arr += '</span><br>';
                option_arr += '<span>'+(data[i]["fecha"]).toUpperCase()+'</span>';
            option_arr += '</div>';
            option_arr += '<p>'+(data[i]["Mensaje"]).toUpperCase()+'</p>';
        option_arr += '</div>';
    }   
    $("#activity").html(option_arr);
}

function deleteComentario(ids) {
    if (confirm("Está seguro de que desea continuar?") == true) {
        var link = $('#txth_base').val() + "/mceformulario/deletemessage";
        var arrParams = new Object();
        arrParams.ids = ids;
        arrParams.ftem = $('#txth_ftem_id').val();
        requestHttpAjax(link, arrParams, function (response) {
            var data = response.message;
            if (response.status == "OK") {
                divComentario(data.dataComentario);
                $('#txt_message').val('');
            }
            showAlert(response.status, response.type, {"wtmessage": data.info, "title": response.label});
        }, true);
    }
}

function exportExcel(){
    estado   = $('#cmb_estado').val();
    usomarca = $('#cmb_usomarca').val();
    finicio  = $('#dtp_f_inicio').val();
    ffin     = $('#dtp_f_fin').val();
    valor    = ($('#txth_ids').val()!='')?$('#txth_ids').val():''; 
    window.location.href = $('#txth_base').val() + "/mceformulario/expexcel?valor="+valor+"&estado="+estado+"&licencia="+usomarca+"&finicio="+finicio+"&ffin="+ffin;
}

function autocompletarBuscarPersona(request, response, control, op) {
    var link = $('#txth_base').val() + "/mceformulario/buscarpersonas";
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url:link,
        data:{
            valor: $('#' + control).val(),
            op: op
        },
        success:function(data){
            var arrayList =new Array;
            for(var i=0;i<data.length;i++){
                row=new Object();
                row.Cedula = data[i]['Cedula'];
                row.RazonSocial = data[i]['RazonSocial'];     
                // Campos Importandes relacionados con el  CJuiAutoComplete
                row.id = data[i]['Cedula'];
                row.label = data[i]['RazonSocial'] + ' - ' + data[i]['Cedula'];
                row.value = data[i]['RazonSocial'];//lo que se almacena en en la caja de texto
                arrayList[i] = row;
            }
            sessionStorage.src_buscIndex = JSON.stringify(arrayList);
            response(arrayList);  
        }
    })
}

function clearGrid(){
    //Limpia la Caja de Texto y actualiza la Grid
    if($('#txt_buscarData').val()==''){
        $('#txth_ids').val('');
        actualizarGrid();
    }
}
