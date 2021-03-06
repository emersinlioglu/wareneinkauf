<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    //public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins/chartjs/';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/forms.css',
        'css/query-builder.default.min.css',
//        'font-awesome-4.5.0/css/font-awesome.css',
        'font-awesome-4.5.0/css/font-awesome.min.css',
        'js/jquery-ui-1.11.4.custom/jquery-ui.min.css',
//        'js/jquery-ui-1.11.4.custom/jquery-ui.structure.min.css',
//        'js/jquery-ui-1.11.4.custom/jquery-ui.theme.min.css',
    ];
    public $js = [
        'js/Chart.min.js',
        'js/jquery-ui-1.11.4.custom/jquery-ui.min.js',
        'js/DatenblattMassenbearbeitungForm.js',
        'js/DatenblattForm.js',
        'js/jquery-sortable.js',
        'js/TeileigentumseinheitForm.js',
        'js/KaeuferForm.js',
        'js/DynagridProfileForm.js',
        'js/QueryBuilderProfileForm.js',
        'js/ProjektForm.js',
        'js/Serienbrief.js',
        'js/tinymce/tinymce.min.js',
        'js/jquery.doubleScroll.js',
        'js/query-builder.standalone.min.js',

        'i18n/query-builder.de.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

     public $images = [
     'images/logo.jpg',
     'images/logo_pdf.jpg',
     ];
}
