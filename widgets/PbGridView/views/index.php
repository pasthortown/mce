<?php
use app\widgets\PbGridView\PbGridView;
use yii\helpers\Html;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div style="text-align: right;" <?php if(!$isSummary): echo "class='barexport'"; endif;?> >
    <?php if($showExport): ?>
    <div class="btn-group">
        <button id="exportbutton" class="btn btn-default dropdown-toggle" href="javascript:" title="<?= Html::encode(PbGridView::t("gridview", "Export")) ?>" data-toggle="dropdown" aria-expanded="false">
            <i class="glyphicon glyphicon-export"></i>
            <span class="caret"></span>
        </button>
        <ul id="ulexportbutton" class="dropdown-menu dropdown-menu-right ">
            <li role="presentation" class="dropdown-header"><?= PbGridView::t("gridview", "Export Page Data") ?></li>
            <?php /* 
            <li title="Hyper Text Markup Language">
                <a class="export-html" href="#" data-format="text/html" tabindex="-1">
                    <i class="text-info fa fa-file-text"></i> HTML
                </a>
            </li>
            <li title="Tab Delimited Text">
                <a class="export-txt" href="#" data-format="text/plain" tabindex="-1">
                    <i class="text-muted fa fa-file-text-o"></i> Text
                </a>
            </li>

            <li title="JavaScript Object Notation">
                <a class="export-json" href="#" data-format="application/json" tabindex="-1">
                    <i class="text-warning fa fa-file-code-o"></i> JSON
                </a>
            </li>
            <li title="Comma Separated Values">
                <a class="export-csv" href="javascript:" data-format="application/csv" tabindex="-1">
                    <i class="text-primary fa fa-file-code-o"></i> <?= PbGridView::t("gridview", "CSV") ?>
                </a>
            </li>
             */ ?>
            <li title="Microsoft Excel 95+">
                <a class="export-xls" href="<?php echo $fnExportEXCEL;?>" data-format="application/vnd.ms-excel" tabindex="-1">
                    <i class="text-success fa fa-file-excel-o"></i> <?= PbGridView::t("gridview", "EXCEL") ?>
                </a>
            </li>
            <?php /*
            <li title="Portable Document Format">
                <a class="export-pdf" href="<?php echo $fnExportPDF;?>" data-format="application/pdf" tabindex="-1">
                    <i class="text-danger fa fa-file-pdf-o"></i> <?= PbGridView::t("gridview", "PDF") ?>
                </a>
            </li>
            */ ?>
        </ul>
    </div>
    <?php endif; ?>
</div>