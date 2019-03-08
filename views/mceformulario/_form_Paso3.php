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

use yii\helpers\Url;
use yii\helpers\Html;
use branchonline\lightbox\Lightbox;
?>
<h3><?= Yii::t("formulario", "Use of the mark") ?></h3>
<div class="col-md-12">
    <div class="form-group">
        <label for="lbl_origen" ><?= mb_strtoupper($usoMarca[0]["umar_nombre"]) ?></label>
        <div class="info-alertpb">
            <?= $usoMarca[0]["umar_detalle"] ?>
        </div>
    </div>
</div>
<?php
switch ($solicitud[0]['umar_id']) {
    case '1':
        ?>

        <h4><?= Yii::t("formulario", "Exports its services") ?></h4>

        <div class="col-md-6">
            <div class="form-group">
        <!--                <label for="lbl_ExporServicio" class="col-sm-3"><?= mb_strtoupper($solicitud[0]["ExporServicio"]) ?></label>-->
                <div>
                    <?= Html::textarea('DefinicionSector', mb_strtoupper($solicitud[0]["ExporServicio"] . ': ' . $solicitud[0]["DefinicionSector"]), ['class' => 'form-control', 'readonly' => true]) ?>
                </div>
            </div>
        </div>
        <div class="row"></div>
        <h4><?= Yii::t("formulario", "Other uses of the brand") ?></h4>
        <div class="col-md-12">
            <div class="form-group">
                <div>
                    <?php for ($i = 0; $i < sizeof($otrosUsos); $i++) { ?>
                        <?= mb_strtoupper($otrosUsos[$i]["ous_nombre"], $utfvar) ?><br>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
        break;
    case '2':
        ?>
        <h4><?= Yii::t("formulario", "Product Information") ?></h4>
        <div class="col-md-12">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 10px">#<span id="transmark"></span></th>
                        <th><?= Yii::t("formulario", "Product") ?></th>
                        <th><?= Yii::t("formulario", "Production %") ?></th>
                        <th><?= Yii::t("formulario", "Presentation") ?></th>
                        <th><?= Yii::t("formulario", "Imagen") ?></th>
                        <th style="width: 50px"><?= Yii::t("formulario", "Detail") ?></th>
                    </tr>
                    <?php
                    for ($i = 0; $i < sizeof($producto); $i++) {
                        $presenta = "";
                        $presenta.=($producto[$i]["ptem_envase"] == 1) ? Yii::t("formulario", "Pack") . ',' : '';
                        $presenta.=($producto[$i]["ptem_empaque"] == 1) ? Yii::t("formulario", "Packing") . ',' : '';
                        $presenta.=($producto[$i]["ptem_etiqueta"] == 1) ? Yii::t("formulario", "Label") . ',' : '';
                        $presenta.=($producto[$i]["ptem_publicidad"] == 1) ? Yii::t("formulario", "Publicity") . ',' : '';
                        $presenta.=($producto[$i]["ptem_otros"] == 1) ? Yii::t("formulario", "Others.") : '';
                        ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?php echo mb_strtoupper($producto[$i]["Nombre"]) ?></td>
                            <td><?php echo mb_strtoupper($producto[$i]["Porcentaje"]) ?></td>
                            <td><?php echo mb_strtoupper($presenta) ?></td>
                            <td>
                                <?= ($producto[$i]["foto"] <> "") ? '<a data-title="' . $producto[$i]["Nombre"] . '" data-lightbox="image-'.uniqid().'" href="' . Url::base(true) . Yii::$app->params["imgFolder"] . $solicitud[0]["Cedula"] .'_'.$solicitud[0]["Ids"] . '/productos/' . $producto[$i]["foto"] . '">Ver Foto</a>' : '<span class="label label-danger">No Tiene Foto</span>'; ?>
                            </td>
                            <td><?php echo mb_strtoupper($producto[$i]["Detalle"]) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php
        break;
    case '3':
        ?>
        <h3><?= Yii::t("formulario", "Event information") ?></h3>
        <div class="col-md-12">
            <div class="form-group">
                <label for="lbl_origen" ><?= Yii::t("formulario", "Name") ?></label>
                <div>
                    <?= Html::input('text', 'Nombre',mb_strtoupper($eventos[0]["Nombre"],$utfvar), ['class' => 'form-control','readonly' => true]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="lbl_origen" ><?= Yii::t("formulario", "Date and Place") ?></label>
                <div>
                    <?= Html::input('text', 'Lugar',mb_strtoupper($eventos[0]["Lugar"],$utfvar), ['class' => 'form-control','readonly' => true]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="lbl_origen" ><?= Yii::t("formulario", "Description") ?></label>
                <div>
                    <?= Html::input('text', 'Descripcion',mb_strtoupper($eventos[0]["Descripcion"],$utfvar), ['class' => 'form-control','readonly' => true]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="lbl_origen" ><?= Yii::t("formulario", "Reference") ?></label>
                <div>
                    <?= Html::input('text', 'Referencia',mb_strtoupper($eventos[0]["Referencia"],$utfvar), ['class' => 'form-control','readonly' => true]) ?>
                </div>
            </div>
        </div>
        <?php
        break;
    case '4':
        ?>
        <h4><?= Yii::t("formulario", "Other uses of the brand") ?></h4>
        <div class="col-md-12">
            <div class="form-group">
                <div>
                    <?php for ($i = 0; $i < sizeof($otrosUsos); $i++) { ?>
                        <?= mb_strtoupper($otrosUsos[$i]["ous_nombre"], $utfvar) ?><br>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
        break;
    default:
}
?>
<div class="row"></div>
<?php
echo Lightbox::widget([
    'files' => [
        [
        //'thumb' => 'url/to/thumb.ext',
        //'original' => 'url/to/original.ext',
        //'title' => 'optional title',
        ],
    ]
]);
?>
