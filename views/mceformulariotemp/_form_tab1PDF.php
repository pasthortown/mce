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
?>
<div>
    <h3><?= Yii::t("formulario", "Data Source") ?></h3>
    <table style="width:100%;" class="tabDetalle">
        <tbody>
            <tr>
                <td class="marcoCelLine titleWidth">
                    <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Source"),$utfvar) ?>:</span>
                </td>
                <td class="marcoCelLine2 dataWidth">
                    <span><?php echo mb_strtoupper($origen[$solicitud[0]["Origen"]],$utfvar) ?></span>
                </td>
                <td class="marcoCelLine titleWidth">
                    <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Type person"),$utfvar) ?>:</span>
                </td>
                <td class="marcoCelLine2 dataWidth">
                    <span><?php echo mb_strtoupper($personeria[$solicitud[0]["Personeria"]],$utfvar) ?></span>
                </td>                
            </tr>
        </tbody>
    </table>
    <br>
    <?php if ($solicitud[0]["Personeria"]==1) { ?>
        <h3><?= Yii::t("formulario", "Natural Person Data") ?></h3>
        
        <table style="width:100%;" class="tabDetalle">
            <tbody>
                <tr>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "First Name"),$utfvar) ?>:</span>
                    </td>
                    <td colspan="3" class="marcoCelLine2 dataWidth">
                        <span><?= mb_strtoupper($solicitud[0]["Nombres"],$utfvar) ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "DNI"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?= mb_strtoupper($solicitud[0]["Cedula"],$utfvar) ?></span>
                    </td>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "RUC"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?= mb_strtoupper($solicitud[0]["Ruc"],$utfvar) ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Gender"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?php echo mb_strtoupper($genero[$solicitud[0]["Genero"]],$utfvar) ?></span>
                    </td>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Position"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?php echo mb_strtoupper($solicitud[0]["Cargo_Persona"],$utfvar) ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Email"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?php echo $solicitud[0]["Correo"] ?></span>
                    </td>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "ÉTNIA"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?php echo mb_strtoupper($etnica[$solicitud[0]["Etnica"]],$utfvar) ?></span>
                    </td>
                </tr>  
            </tbody>
        </table>
        <br>
        <h3><?= Yii::t("formulario", "Information Company") ?></h3>
        <table style="width:100%;" class="tabDetalle">
            <tbody>
                <tr>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Sector"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?php echo mb_strtoupper(utf8_encode($industria[0]["Sector"]),$utfvar) ?></span>
                    </td>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Size company"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?php echo mb_strtoupper($tipopyme[$solicitud[0]["Pyme"]],$utfvar) ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "State"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?php echo mb_strtoupper($cppData[0]["Provincia"],$utfvar) ?></span>
                    </td>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "City"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?php echo mb_strtoupper($cppData[0]["Canton"],$utfvar) ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Address"),$utfvar) ?>:</span>
                    </td>
                    <td colspan="3" class="marcoCelLine2 dataWidth">
                        <span><?php echo mb_strtoupper($solicitud[0]["Direccion"],$utfvar) ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Phone"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?php echo mb_strtoupper($solicitud[0]["Telefono"],$utfvar) ?></span>
                    </td>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Web page"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?php echo $solicitud[0]["Sitio"] ?></span>
                    </td>
                </tr>
                
            </tbody>
        </table>
            
        
        
    <?php } else { ?>
        
        <h3><?= Yii::t("formulario", "Legal Representative Data") ?></h3>
        
        <table style="width:100%;" class="tabDetalle">
            <tbody>
                <tr>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "First Name"),$utfvar) ?>:</span>
                    </td>
                    <td colspan="3" class="marcoCelLine2 dataWidth">
                        <span><?= mb_strtoupper($solicitud[0]["Nombres"],$utfvar) ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "DNI"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?= mb_strtoupper($solicitud[0]["Cedula"],$utfvar) ?></span>
                    </td>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Gender"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?php echo mb_strtoupper($genero[$solicitud[0]["Genero"]],$utfvar) ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Position"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?php echo mb_strtoupper($solicitud[0]["Cargo_Persona"],$utfvar) ?></span>
                    </td>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Email"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?php echo $solicitud[0]["Correo"] ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "ÉTNIA"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?php echo mb_strtoupper($etnica[$solicitud[0]["Etnica"]],$utfvar) ?></span>
                    </td>
                    <td class="marcoCelLine titleWidth">
                        
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        
                    </td>
                </tr>
               
            </tbody>
        </table>

        <br>
        <h3><?= Yii::t("formulario", "Information Company") ?></h3>
        <table style="width:100%;" class="tabDetalle">
            <tbody>
                <tr>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Business name"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?= mb_strtoupper($solicitud[0]["RazonSocial"],$utfvar) ?></span>
                    </td>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "RUC"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?= mb_strtoupper($solicitud[0]["Ruc"],$utfvar) ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Sector"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?php echo mb_strtoupper($industria[0]["Sector"],$utfvar) ?></span>
                    </td>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Size company"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?php echo mb_strtoupper($tipopyme[$solicitud[0]["Pyme"]],$utfvar) ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "State"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?php echo mb_strtoupper($cppData[0]["Provincia"],$utfvar) ?></span>
                    </td>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "City"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?php echo mb_strtoupper($cppData[0]["Canton"],$utfvar) ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Address"),$utfvar) ?>:</span>
                    </td>
                    <td colspan="3" class="marcoCelLine2 dataWidth">
                        <span><?php echo mb_strtoupper($solicitud[0]["Direccion"],$utfvar) ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Phone"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?php echo mb_strtoupper($solicitud[0]["Telefono"],$utfvar) ?></span>
                    </td>
                    <td class="marcoCelLine titleWidth">
                        <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Web page"),$utfvar) ?>:</span>
                    </td>
                    <td class="marcoCelLine2 dataWidth">
                        <span><?php echo $solicitud[0]["Sitio"] ?></span>
                    </td>
                </tr>
                
            </tbody>
        </table>
    <?php } ?>

    <br>
    <h3><?= Yii::t("formulario", "Information Contac") ?></h3>
    <table style="width:100%;" class="tabDetalle">
        <tbody>
            <tr>
                <td class="marcoCelLine titleWidth">
                    <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Contact"),$utfvar) ?>:</span>
                </td>
                <td class="marcoCelLine2 dataWidth">
                    <span><?= mb_strtoupper($solicitud[0]["Contacto"],$utfvar) ?></span>
                </td>
                <td class="marcoCelLine titleWidth">
                    <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Position"),$utfvar) ?>:</span>
                </td>
                <td class="marcoCelLine2 dataWidth">
                    <span><?= mb_strtoupper($solicitud[0]["ContactoCargo"],$utfvar) ?></span>
                </td>
            </tr>
            <tr>
                <td class="marcoCelLine titleWidth">
                    <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Email"),$utfvar) ?>:</span>
                </td>
                <td class="marcoCelLine2 dataWidth">
                    <span><?= $solicitud[0]["ContactoCorreo"] ?></span>
                </td>
                <td class="marcoCelLine titleWidth">
                    <span class="titleLabel"><?= mb_strtoupper(Yii::t("formulario", "Phone"),$utfvar) ?>:</span>
                </td>
                <td class="marcoCelLine2 dataWidth">
                    <span><?= mb_strtoupper($solicitud[0]["ContactoTelefono"],$utfvar) ?></span>
                </td>
            </tr>
        </tbody>
    </table>
</div><br>