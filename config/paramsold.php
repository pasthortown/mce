<?php
return [
    'copyright' => 'Ministerio de Turismo',
    'alias' => 'mce',
    'adminRegister' => true,// permite al usuario administrador realizar el registro de manera manual de un licenciatario con sus documentos
    'siteName' => 'Ecuador Ama La Vida',
    'web' => 'http://www.turismo.gob.ec/',
    'version' => '1.0',
    'adminEmail' => 'noreplay@turismo.gob.ec',
    'contactoEmail' => 'tecnologia@turismo.gob.ec',
    'culture' => 'es-ES',
    'cookieSession' => 3600*24*30,
    'logfile' => __DIR__ . '/../runtime/logs/mce.log',
    'limitRow' => 10,
    'pageSize' => 20,
    'dateTimeByDefault' => 'Y-m-d H:i:s',
    'dateByDefault' => 'Y-m-d',
    'datePickerDefault' => 'yyyy-mm-dd',
    'themesIconsFolder' => '/assets/img/accions/',
    'themesLogosFolder' => '/assets/img/logos/',
    'themesModulesFolder' => '/assets/img/modules/',
    'documentFolder' => '/uploads/',
    'imgFolder' => '/site/getimage/?route=/uploads/',
    'FileExtensions' => ['jpg','png','pdf'],
    'MaxFileSize' => 1024,//Tamaño 1 MB
    'timeRecursive' => '2',// segundos
    'numRecursive' => '3',
    'keywordEncription' => 'PBdoHUHYU909854874HNGFGKO',
    'tokenid' => 'HU787390kdnhyyejkKJHWFDSYWUQB72573LOSNQ2JKTDCA67253',
    'numbersecret' => '2983981321',
    'socialNetworks' => [
        'facebook' => 'https://www.facebook.com/EcuadorMarca/',
        'instagram' => 'https://www.instagram.com/marcaecuador/',
        'twitter'  => 'https://twitter.com/Ecuador_marca',
        'link'  => 'https://ecuador.travel/marca-pais',
    ],
];
