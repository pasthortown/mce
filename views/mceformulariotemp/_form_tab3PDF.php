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
    <h3><?= Yii::t("formulario", "Use of the mark") ?></h3>
    <table style="width:100%;" class="tabDetalle">
        <tbody>
            <tr>
                <td class="marcoCelBottom">
                    <span><?php echo mb_strtoupper($usoMarca[0]["umar_nombre"]) ?></span>
                </td>
            </tr>
            <tr>
                <td class="marcoCelTop">
                    <span><?php echo $usoMarca[0]["umar_detalle"] //echo mb_strtoupper($usoMarca[0]["umar_detalle"])    ?></span>
                </td>
            </tr>
        </tbody>
    </table> 
    <br>
    <br>
    <table style="width:100%;" class="tabDetalle">
        <tbody>
            <?php
            switch ($solicitud[0]['umar_id']) {
                case '1':
                    ?>
                    <tr>
                        <td class="">
                            <h4><?= Yii::t("formulario", "Exports its services") ?>: <?= $solicitud[0]["ExporServicio"] ?> </h4>
                        </td>
                    </tr>
                    <?php if ($solicitud[0]["ExporServicio"] == 'SI') { ?>
                        <tr>
                            <td class="marcoCelTop">
                                <span><?php echo mb_strtoupper($solicitud[0]["DefinicionSector"],$utfvar) ?></span>
                            </td>                
                        </tr>
                    <?php } ?>
                    <tr>
                        <td class="">
                            <br>
                            <h4><?= Yii::t("formulario", "Other uses of the brand") ?></h4> 
                        </td>
                    </tr>
                    <?php
                    for ($i = 0; $i < sizeof($otrosUsos); $i++) {
                        ?>
                        <tr>
                            <td class="marcoCel">
                                <span><?php echo mb_strtoupper($otrosUsos[$i]["ous_nombre"]) ?></span>
                            </td>                
                        </tr>
                        <?php
                    }
                    break;
                case '2':
                    ?>
                    <tr>
                        <td class="">
                            <br>
                            <h4><?= Yii::t("formulario", "Product Information") ?></h4> 
                        </td>
                    </tr>
                    <tr>
                        <td class="marcoCel">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width: 10px">#<span id="transmark"></span></th>
                                        <th><?= Yii::t("formulario", "Product") ?></th>
                                        <th><?= Yii::t("formulario", "Production %") ?></th>
                                        <th style="width: 50px"><?= Yii::t("formulario", "Detail") ?></th>
                                    </tr>
                                    <?php
                                    for ($i = 0; $i < sizeof($producto); $i++) {
                                        ?>
                                        <tr>
                                            <td><?= $i + 1 ?></td>
                                            <td><?php echo mb_strtoupper($producto[$i]["Nombre"]) ?></td>
                                            <td><?php echo mb_strtoupper($producto[$i]["Porcentaje"]) ?></td>
                                            <td><?php echo mb_strtoupper($producto[$i]["Detalle"]) ?></td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>


                    <?php
                    break;
                case '3':
                    ?>

                    <tr>
                        <td class="">
                            <br>
                            <h3><?= Yii::t("formulario", "Event information") ?></h3> 
                        </td>
                    </tr>
                    <tr>
                        <td class="marcoCelBottom">
                            <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Name")) ?>:</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="marcoCelTop">
                            <span><?= mb_strtoupper($eventos[0]["Nombre"],$utfvar) ?></span>
                        </td>                
                    </tr>
                    <tr>
                        <td class="marcoCelBottom">
                            <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Date and Place")) ?>:</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="marcoCelTop">
                            <span><?= mb_strtoupper($eventos[0]["Lugar"],$utfvar) ?></span>
                        </td>                
                    </tr>
                    <tr>
                        <td class="marcoCelBottom">
                            <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Description")) ?>:</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="marcoCelTop">
                            <span><?= mb_strtoupper($eventos[0]["Descripcion"],$utfvar) ?></span>
                        </td>                
                    </tr>
                    <tr>
                        <td class="marcoCelBottom">
                            <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Reference")) ?>:</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="marcoCelTop">
                            <span><?= mb_strtoupper($eventos[0]["Referencia"],$utfvar) ?></span>
                        </td>                
                    </tr>

                    <?php
                    break;
                case '4':
                    ?>
                    <tr>
                        <td class="">
                            <br>
                            <h4><?= Yii::t("formulario", "Other uses of the brand") ?></h4> 
                        </td>
                    </tr>
                    <?php
                    for ($i = 0; $i < sizeof($otrosUsos); $i++) {
                        ?>
                        <tr>
                            <td class="marcoCel">
                                <span><?php echo mb_strtoupper($otrosUsos[$i]["ous_nombre"],$utfvar) ?></span>
                            </td>                
                        </tr>
                        <?php
                    }
                    break;
                default:
            }
            ?>  
        </tbody>
    </table>
</div><br>