<?php

// This is the main Web application configuration. Any writable
// application properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Paysera',

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.tests.*',
	),

	// application components
	'components'=>array(
		/*
		'db'=>array(
			'connectionString'=>'sqlite:protected/data/phonebook.db',
		),
		*/
		'urlManager'=>array(
            'urlFormat'=>'path',
        ),
	),
);
