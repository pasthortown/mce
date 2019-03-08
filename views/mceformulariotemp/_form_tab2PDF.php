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
?>
<div>
    <br>
    <br>
    <h3><?= Yii::t("formulario", "Objective Using the Brand") ?></h3>
    <table style="width:100%;" class="tabDetalle">
        <tbody>
            <tr>
                <td class="marcoCelLine titleWidth">
                    <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Objective")) ?>:</span>                    
                </td>
                <td  class="marcoCelLine2">
                    <span><?php echo mb_strtoupper($objetivo[0]["obj_nombre"],$utfvar) ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="marcoCelBottom">
                    <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Because you want to use the country brand Ecuador loves life?")) ?>:</span>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="marcoCelTop">
                    <span><?php echo mb_strtoupper($solicitud[0]["DetalleObjetivo"]) ?></span>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <h3><?= Yii::t("formulario", "Business commitment with Ecuador") ?></h3> 
    <table style="width:100%;" class="tabDetalle">
        <tbody>
            <tr>
                <td class="marcoCelBottom">
                    <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Activity")) ?>:</span>
                </td>
            </tr>
            <tr>
                <td class="marcoCelTop">
                    <span><?php echo mb_strtoupper($solicitud[0]["Actividad"]) ?></span>
                </td>                
            </tr>
<!--            <tr>
                <td class="marcoCelBottom">
                    <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Vision")) ?>:</span>
                </td>
            </tr>
            <tr>
                <td class="marcoCelTop">
                    <span><?php echo mb_strtoupper($solicitud[0]["Vision"]) ?></span>
                </td>                
            </tr>-->
            <tr>
                <td class="marcoCelBottom">
                    <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Mission")) ?>:</span>
                </td>
            </tr>
            <tr>
                <td class="marcoCelTop">
                    <span><?php echo mb_strtoupper($solicitud[0]["Mision"]) ?></span>
                </td>                
            </tr>
            <tr>
                <td class="marcoCelBottom">
                    <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Reference")) ?>:</span>
                </td>
            </tr>
            <tr>
                <td class="marcoCelTop">
                    <span><?php echo mb_strtoupper($solicitud[0]["Referencia"]) ?></span>
                </td>                
            </tr>
            <?php
            if ($nivelInt !== null or $nivelNac !== null) {
                ?>
                <tr>
                    <td class="">
                        <br>
                        <h3><?= Yii::t("formulario", "Ability to raise the countrys image") ?></h3>
                        <h5><?= Yii::t("formulario", "Where the Country Brand is sold") ?></h5>
                    </td>
                </tr>
                <?php
                if ($nivelNac !== null) {
                    $textNac = "";
                    for ($i = 0; $i < sizeof($nivelNac); $i++) {
                        $textNac .=($i == 0) ? $nivelNac[$i]["Provincia"] : ", " . $nivelNac[$i]["Provincia"];
                    }
                    ?>
                    <tr>
                        <td class="marcoCelBottom">
                            <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Level National")) ?>:</span>
                        </td> 
                    </tr>
                    <tr>
                        <td class="marcoCelTop">
                            <span><?php echo mb_strtoupper($textNac) ?></span>
                        </td>                
                    </tr>
                <?php } ?>

                <?php
                if ($nivelInt !== null) {
                    $textInt = "";
                    for ($i = 0; $i < sizeof($nivelInt); $i++) {
                        $textInt .=($i == 0) ? $nivelInt[$i]["Pais"] : ", " . $nivelInt[$i]["Pais"];
                    }
                    ?>
                    <tr>
                        <td class="marcoCelBottom">
                            <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Level International")) ?>:</span>
                        </td> 
                    </tr>
                    <tr>
                        <td class="marcoCelTop">
                            <span><?php echo mb_strtoupper($textInt) ?></span>
                        </td>                
                    </tr>
                <?php } ?>

            <?php } ?>
            
        </tbody>
    </table>
</div><br>