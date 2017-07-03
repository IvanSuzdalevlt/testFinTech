<?php

/**
 * SiteController is the default controller to handle user requests.
 */
class KomisiniaiController extends CController
{
	/**
	 * Index action is the default action in a controller.
	 */
	public function actionIndex()
	{	
		echo 'Hello World';
	}
	
	public function actionSkaiciuoti() {
		
		$model = new Komisiniai(); 
		$model->parseCsv('in.csv');
		$model->calculateKomis();
		
		print_r($model->csv_buffer);
		print_r($model->week_buffer);
		
	}
}
