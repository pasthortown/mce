<?php

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
use yii\helpers\Html;
$utfvar='utf-8';
$this->title = "<br />".Yii::t("formulario","Country Brand Application Form");
?>
<style>
    .marcoDiv{
        border: 1px solid #165480;
        padding: 2mm;
    }
    .marcoCel{
        border: 1px solid #165480;
        padding: 1mm;
    }
    .marcoCelLine{
        //border-left: 1px solid #165480;
        //border-top: 1px solid #165480;
        //border-bottom: 1px solid #165480;
        padding: 1mm;
    }
    .marcoCelLine2{
        //border-right:1px solid #165480;
        //border-top: 1px solid #165480;
        //border-bottom: 1px solid #165480;
        padding: 1mm;
    }
    .marcoCelTop{
        border-left: 1px solid #165480;
        border-right:1px solid #165480;
        border-bottom: 1px solid #165480;
        padding: 1mm;
    }
    .marcoCelBottom{
        border-left: 1px solid #165480;
        border-right:1px solid #165480;
        border-top: 1px solid #165480;
        padding: 1mm;
    }
    .titleLabel{
        font-size:8pt;
        font-weight: bold ;
    }
    .titleWidth{
        width: 10%;
    }
    .dataWidth{
        width: 40%;
    }
    .tabDetalle{
        border-spacing:0;
        border-collapse: collapse;
    }
    .table-bordered {
        /*border: 1px solid #f4f4f4;*/
        border-top: 1px solid #f4f4f4;
    }

</style>
    
<div class="row">
    <?php
        if ($solicitud !== null) {
    ?>
    <table style="width:100%;">
        <tbody>
            <tr>
                <td style="width:100%">
                    <?=
                    $this->render('_form_tab1PDF', [
                        'utfvar' => $utfvar,
                        'solicitud' => $solicitud,
                        'origen' => $origen,
                        'personeria' => $personeria,
                        'cppData' => $cppData,
                        'industria' => $industria,
                        'genero' => $genero,
                        'etnica' => $etnica,
                        'tipopyme' => $tipopyme]);
                    ?>
                </td>
            </tr>
            <tr>
                <td style="width:100%">
                    <?=
                    $this->render('_form_tab2PDF', [
                        'utfvar' => $utfvar,
                        'solicitud' => $solicitud,
                        'nivelInt' => $nivelInt,
                        'nivelNac' => $nivelNac,
                        'objetivo' => $objetivo]);
                    ?>
                </td>
            </tr>
            <tr>
                <td style="width:100%">
                    <?=
                    $this->render('_form_tab3PDF', [
                        'utfvar' => $utfvar,
                        'solicitud' => $solicitud,
                        'usoMarca' => $usoMarca,
                        'otrosUsos' => $otrosUsos,
                        'eventos' => $eventos,
                        'producto' => $producto]);
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
    <?php } ?>
</div>
<!-- Imagenes -->
<?php
if(count($filesImages)>0){
    ?>
<div><br /><br />
    <h3><?= Yii::t("formulario", "Attached Files") ?></h3><br /><br />
    <?php 
    
    for($i=0; count($filesImages)>$i; $i++){
        echo "<div align='center'><img src='".$filesImages[$i]."' /></div><br/><br/>";
    }
    ?>
</div>
<?php 
}
?>
