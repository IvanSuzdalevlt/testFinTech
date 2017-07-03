<?php
class KomisiniaiSkaiciuotiCommand extends CConsoleCommand
{
   
	public function run($args)
	{
		//Metodas pasileis, jei yra laikmenos URL
		if(isset($args) && count($args) > 0) {
			
			$url_to_file = $args[0];	
			$model = new Komisiniai(); 
			//Megina gauti išparsintą laikmeną 
			$model->parseCsv($url_to_file);
		
				if($model->csv_buffer and count($model->csv_buffer)) {
					
					//Pasileidžia komiso skaičiavimas, po kurio $model->csv_buffer masyvas pasipildo komiso laukų
					$model->calculateKomis();
					
					//print_r($model->csv_buffer);
					foreach ($model->csv_buffer as $issue) {
						
						//6 masyvo lauke yra suskaičiuotasis operacijos komisinis
						echo $issue[6] . "\n";
						
					}	
					
					//print_r($model->week_buffer);			
						
				}
				else echo "Laikmena yra tuščia\n";
				
			}
			else echo "Negautas laikmenos kelio argumentas\n";		
		
	}

}
?>
