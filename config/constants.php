<?php
return [
    'langs' => [
        'es' => 'www.domain.es',
        'en' => 'www.domain.us'
        // etc
    ],
	'adminFromEmail'=>'noreply@lifeinbalancecareers.com.au',
	 'Settingmodel' => App\User::class,
	
];
//dynamic data get from AppService Provider
//{{ $globalSetting->id }}