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
<div class="col-md-12">
    <ul class="list-inline">
        <li class="pull-right">
            <a class="link-black text-sm" href="#"><i class="fa fa-comments-o margin-r-5"></i><?= Yii::t("formulario", "Comments") ?> (<span id="countMensaje"><?= sizeof($mensaje) ?></span>)</a>
        </li>
    </ul>
</div>

<div id="activity" class="tab-pane active">
    <!-- Post -->
    <?php for ($i = 0; $i < sizeof($mensaje); $i++) { ?>
        <div class="post clearfix">
            <div class="user-block">
                <!--<img alt="User Image" src="../../dist/img/user7.jpg" class="img-circle img-bordered-sm">-->
                <span>
                    <a href="#"><?= mb_strtoupper($mensaje[$i]["Nombres"]) ?></a>
                    <a onclick="deleteComentario('<?= $mensaje[$i]['Ids'] ?>')" class="pull-right btn-box-tool" href="#"><i class="fa fa-times"></i></a>
                </span><br>
                <span><?= mb_strtoupper($mensaje[$i]["fecha"]) ?></span>
            </div>
            <!-- /.user-block -->
            <p>
                <?= mb_strtoupper($mensaje[$i]["Mensaje"]) ?>
            </p>
        </div>
    <?php } ?>
    <!-- /.post -->
</div>
<div class="form-group margin-bottom-none">
    <div class="col-sm-9">
        <textarea id="txt_message" rows="2" placeholder="<?= Yii::t("formulario", "Response") ?>" class="form-control input-sm"></textarea>
    </div>
    <div class="col-sm-3">                
        <a id="sendMessage" href="javascript:" class="btn btn-primary btn-block"> <?= Yii::t("formulario", "Send") ?> <span class="glyphicon glyphicon-menu-right"></span></a>
    </div>
</div>


