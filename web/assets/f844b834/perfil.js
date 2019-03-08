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

function sentPassword(){
    var link = $('#txth_base').val() + "/perfil/save";
    var arrParams = new Object();
    arrParams.current = $("#frm_actual_clave").val();
    arrParams.new = $("#frm_nueva_clave").val();
    arrParams.confirm = $("#frm_nueva_clave_repeat").val();
    if(arrParams.new != arrParams.confirm){
        // error verificar 
        showAlert("NOOK", "Error", {"wtmessage": "Contraseñas no coinciden. Ingrese correctamente la nueva contraseña.", "title":"Exito"});
    }else{
        requestHttpAjax(link, arrParams, function (response) {
                showAlert(response.status, response.label, response.message);
        }, true);
    }
}

function sentActivation(){
    var link = $('#txth_base').val() + "/perfil/save";
    var arrParams = new Object();
    arrParams.activatemenu = true;

    requestHttpAjax(link, arrParams, function (response) {
        //showAlert(response.status, response.label, response.message);
        location.reload(); 
    }, true);

}
