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
 * mb_strtoupper($cadena, "UTF-8");
 */
$utfvar = 'utf-8';

use yii\helpers\Url;
use yii\helpers\Html;
?>
<h3><?= Yii::t("formulario", "Data Source") ?></h3>
<div class="col-md-6">
    <div class="form-group">
        <label for="lbl_origen" class="col-sm-3 "><?= Yii::t("formulario", "Source") ?></label>
        <div class="col-sm-9">
            <?php //echo mb_strtoupper($origen[$solicitud[0]["Origen"]], $utfvar) ?>
<?= Html::input('text', 'id_origen', mb_strtoupper($origen[$solicitud[0]["Origen"]], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Type person") ?></label>
        <div class="col-sm-9">
            <?php //echo mb_strtoupper($personeria[$solicitud[0]["Personeria"]], $utfvar) ?>
<?= Html::input('text', 'Personeria', mb_strtoupper($personeria[$solicitud[0]["Personeria"]], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
        </div>
    </div>
</div>
<br>
<?php if ($solicitud[0]["Personeria"] == 1) { ?>
    <h3><?= Yii::t("formulario", "Natural Person Data") ?></h3>

    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "First Name") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Nombres', mb_strtoupper($solicitud[0]["Nombres"], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "DNI") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Cedula', mb_strtoupper($solicitud[0]["Cedula"], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "RUC") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Ruc', mb_strtoupper($solicitud[0]["Ruc"], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Gender") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Genero', mb_strtoupper($genero[$solicitud[0]["Genero"]], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Position") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Cargo_Persona', mb_strtoupper($solicitud[0]["Cargo_Persona"], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Email") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Correo', $solicitud[0]["Correo"], ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Ethnic self") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Etnica', mb_strtoupper($etnica[$solicitud[0]["Etnica"]], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="row"></div>
    <h3><?= Yii::t("formulario", "Information Company") ?></h3>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Sector") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Sector', mb_strtoupper($industria[0]["Sector"], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Size company") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Pyme', mb_strtoupper($tipopyme[$solicitud[0]["Pyme"]], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "State") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Provincia', mb_strtoupper($cppData[0]["Provincia"], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "City") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Canton', mb_strtoupper($cppData[0]["Canton"], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Address") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Direccion', mb_strtoupper($solicitud[0]["Direccion"], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Phone") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Telefono', mb_strtoupper($solicitud[0]["Telefono"], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Web page") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Sitio', $solicitud[0]["Sitio"], ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">

        </div>
    </div>

<?php } else { ?>

    <h3><?= Yii::t("formulario", "Legal Representative Data") ?></h3>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "First Name") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Nombres', mb_strtoupper($solicitud[0]["Nombres"], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "DNI") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Cedula', mb_strtoupper($solicitud[0]["Cedula"], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Gender") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Genero', mb_strtoupper($genero[$solicitud[0]["Genero"]], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Position") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Cargo_Persona', mb_strtoupper($solicitud[0]["Cargo_Persona"], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Email") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Correo', $solicitud[0]["Correo"], ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Ethnic self") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Etnica', mb_strtoupper($etnica[$solicitud[0]["Etnica"]], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="row"></div>
    <h3><?= Yii::t("formulario", "Information Company") ?></h3>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Business name") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'RazonSocial', mb_strtoupper($solicitud[0]["RazonSocial"], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "RUC") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Ruc', mb_strtoupper($solicitud[0]["Ruc"], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Sector") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Sector', mb_strtoupper($industria[0]["Sector"], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Size company") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Pyme', mb_strtoupper($tipopyme[$solicitud[0]["Pyme"]], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "State") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Provincia', mb_strtoupper($cppData[0]["Provincia"], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "City") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Canton', mb_strtoupper($cppData[0]["Canton"], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Address") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Direccion', mb_strtoupper($solicitud[0]["Direccion"], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Phone") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Telefono', mb_strtoupper($solicitud[0]["Telefono"], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Web page") ?></label>
            <div class="col-sm-9">
    <?= Html::input('text', 'Sitio', $solicitud[0]["Sitio"], ['class' => 'form-control', 'readonly' => true]) ?>
            </div>
        </div>
    </div>
<?php } ?>
<div class="row"></div>

<h3><?= Yii::t("formulario", "Information Contac") ?></h3>


<div class="col-md-6">
    <div class="form-group">
        <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Contact") ?></label>
        <div class="col-sm-9">
<?= Html::input('text', 'Contacto', mb_strtoupper($solicitud[0]["Contacto"], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Position") ?></label>
        <div class="col-sm-9">
<?= Html::input('text', 'ContactoCargo', mb_strtoupper($solicitud[0]["ContactoCargo"], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Email") ?></label>
        <div class="col-sm-9">
<?= Html::input('text', 'Sitio', $solicitud[0]["ContactoCorreo"], ['class' => 'form-control', 'readonly' => true]) ?>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="lbl_origen" class="col-sm-3"><?= Yii::t("formulario", "Phone") ?></label>
        <div class="col-sm-9">
<?= Html::input('text', 'ContactoTelefono', mb_strtoupper($solicitud[0]["ContactoTelefono"], $utfvar), ['class' => 'form-control', 'readonly' => true]) ?>
        </div>
    </div>
</div>

<h3><?= Yii::t("formulario", "File Uploads") ?></h3>
<div class="col-md-12">
    <div class="form-group">
        <div class="col-sm-9">
            <?= ($solicitud[0]["CedulaFile"] <> "") ? '<a data-title="' . Yii::t("formulario", "DNI") . '" '. ((array_pop(explode('.', $solicitud[0]["CedulaFile"]))<> "pdf")?' data-lightbox="image-'.uniqid().'"':' target="_blank"') .' href="' . Url::base(true) . Yii::$app->params["imgFolder"] . $solicitud[0]["Cedula"] . '_' . $solicitud[0]["Ids"] . '/' . $solicitud[0]["CedulaFile"] . '"><b>' . mb_strtoupper(Yii::t("formulario", "Show") . ' ' . Yii::t("formulario", "National identity document"), $utfvar) . '</b></a><br>' : '' . mb_strtoupper(Yii::t("formulario", "It has no Photo") . ' ' . Yii::t("formulario", "National identity document"), $utfvar) . '<br>'; ?>
            <?= ($solicitud[0]["RucFile"] <> "") ? '<a data-title="' . Yii::t("formulario", "Unique Taxpayer Registry (RUC)") . '" '. ((array_pop(explode('.', $solicitud[0]["RucFile"]))<> "pdf")?' data-lightbox="image-'.uniqid().'"':' target="_blank"') .'  href="' . Url::base(true) . Yii::$app->params["imgFolder"] . $solicitud[0]["Cedula"] . '_' . $solicitud[0]["Ids"] . '/' . $solicitud[0]["RucFile"] . '"><b>' . mb_strtoupper(Yii::t("formulario", "Show") . ' ' . Yii::t("formulario", "Unique Taxpayer Registry (RUC)"), $utfvar) . '</b></a><br>' : '<span class="label label-danger">"' . mb_strtoupper(Yii::t("formulario", "It has no Photo") . ' ' . Yii::t("formulario", "Unique Taxpayer Registry (RUC)"), $utfvar) . '"</span><br>'; ?>
            <?= ($solicitud[0]["CertFile"] <> "") ? '<a data-title="' . Yii::t("formulario", "Certificates of voting") . '" '. ((array_pop(explode('.', $solicitud[0]["CertFile"]))<> "pdf")?' data-lightbox="image-'.uniqid().'"':' target="_blank"') .'  href="' . Url::base(true) . Yii::$app->params["imgFolder"] . $solicitud[0]["Cedula"] . '_' . $solicitud[0]["Ids"] . '/' . $solicitud[0]["CertFile"] . '"><b>' . mb_strtoupper(Yii::t("formulario", "Show") . ' ' . Yii::t("formulario", "Certificates of voting"), $utfvar) . '</b></a><br>' : '' . mb_strtoupper(Yii::t("formulario", "It has no Photo") . ' ' . Yii::t("formulario", "Certificates of voting"), $utfvar) . '<br>'; ?>

            <?php if ($solicitud[0]["ind_id"] == 2 || $solicitud[0]["ind_id"]==7) { ?>
                <?= ($solicitud[0]["RegSanFile"] <> "") ? '<a data-title="' . Yii::t("formulario", "Veterinary") . '" '. ((array_pop(explode('.', $solicitud[0]["RegSanFile"]))<> "pdf")?' data-lightbox="image-'.uniqid().'"':' target="_blank"') .' href="' . Url::base(true) . Yii::$app->params["imgFolder"] . $solicitud[0]["Cedula"] . '_' . $solicitud[0]["Ids"] . '/' . $solicitud[0]["RegSanFile"] . '"><b>' . mb_strtoupper(Yii::t("formulario", "Show") . ' ' . Yii::t("formulario", "Veterinary"), $utfvar) . '</b></a><br>' : '<span class="label label-danger">"' . mb_strtoupper(Yii::t("formulario", "It has no Photo") . ' ' . Yii::t("formulario", "Veterinary"), $utfvar) . '"</span><br>'; ?>
            <?php } elseif($solicitud[0]["ind_id"]==16) { ?>
                <?= ($solicitud[0]["PermMinturFile"] <> "") ? '<a data-title="' . Yii::t("formulario", "MINTUR operating permit") . '" '. ((array_pop(explode('.', $solicitud[0]["PermMinturFile"]))<> "pdf")?' data-lightbox="image-'.uniqid().'"':' target="_blank"') .' href="' . Url::base(true) . Yii::$app->params["imgFolder"] . $solicitud[0]["Cedula"] . '_' . $solicitud[0]["Ids"] . '/' . $solicitud[0]["PermMinturFile"] . '"><b>' . mb_strtoupper(Yii::t("formulario", "Show") . ' ' . Yii::t("formulario", "MINTUR operating permit"), $utfvar) . '</b></a><br>' : '<span class="label label-danger">"' . mb_strtoupper(Yii::t("formulario", "It has no Photo") . ' ' . Yii::t("formulario", "MINTUR operating permit"), $utfvar) . '"</span><br>'; ?>
            <?php } else { ?>

            <?php } ?>

            <?php if ($solicitud[0]["Trayectoria"] >0 ) { ?>
                <?= ($solicitud[0]["ImpRentFile"] <> "") ? '<a data-title="' . Yii::t("formulario", "Income tax") . '" '. ((array_pop(explode('.', $solicitud[0]["ImpRentFile"]))<> "pdf")?' data-lightbox="image-'.uniqid().'"':' target="_blank"') .' href="' . Url::base(true) . Yii::$app->params["imgFolder"] . $solicitud[0]["Cedula"] . '_' . $solicitud[0]["Ids"] . '/' . $solicitud[0]["ImpRentFile"] . '"><b>' . mb_strtoupper(Yii::t("formulario", "Show") . ' ' . Yii::t("formulario", "Income tax"), $utfvar) . '</b></a><br>' : '<span class="label label-danger">"' . mb_strtoupper(Yii::t("formulario", "It has no Photo") . ' ' . Yii::t("formulario", "Income tax"), $utfvar) . '"</span><br>'; ?>
            <?php } ?>


            <?php if ($solicitud[0]["Personeria"] == 1) { ?>

            <?php } else { ?>
                <?= ($solicitud[0]["CertSuperFile"] <> "") ? '<a data-title="' . Yii::t("formulario", "Certificate Superintendency of Companies") . '" '. ((array_pop(explode('.', $solicitud[0]["CertSuperFile"]))<> "pdf")?' data-lightbox="image-'.uniqid().'"':' target="_blank"') .' href="' . Url::base(true) . Yii::$app->params["imgFolder"] . $solicitud[0]["Cedula"] . '_' . $solicitud[0]["Ids"] . '/' . $solicitud[0]["CertSuperFile"] . '"><b>' . mb_strtoupper(Yii::t("formulario", "Show") . ' ' . Yii::t("formulario", "Certificate Superintendency of Companies"), $utfvar) . '</b></a><br>' : '<span class="label label-danger">"' . mb_strtoupper(Yii::t("formulario", "It has no Photo") . ' ' . Yii::t("formulario", "Certificate Superintendency of Companies"), $utfvar) . '"</span><br>'; ?>
            <?php } ?>
            <?= ($solicitud[0]["TrayectoriaFile"] <> "") ? '<a data-title="' . Yii::t("formulario", "Reference path (Optional)") . '" '. ((array_pop(explode('.', $solicitud[0]["TrayectoriaFile"]))<> "pdf")?' data-lightbox="image-'.uniqid().'"':' target="_blank"') .' href="' . Url::base(true) . Yii::$app->params["imgFolder"] . $solicitud[0]["Cedula"] . '_' . $solicitud[0]["Ids"] . '/' . $solicitud[0]["TrayectoriaFile"] . '"><b>' . mb_strtoupper(Yii::t("formulario", "Show") . ' ' . Yii::t("formulario", "Reference path (Optional)"), $utfvar) . '</b></a><br>' : '' . mb_strtoupper(Yii::t("formulario", "It has no Photo") . ' ' . Yii::t("formulario", "Reference path (Optional)"), $utfvar) . '<br>'; ?>
        </div>
    </div>
</div>

<div class="row"></div>
