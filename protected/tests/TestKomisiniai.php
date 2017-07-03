<?php
class TestKomisiniai
{
	
	/**
	 * Testas tikrina, ar teisingai vyksta valiutų konversija pagal iš anksto užduotosius valiutų kursūs
	 */
	public function testConvertCurrencyCalcCorrection () {
	
		$model = new Komisiniai();	
		
		//Pagal užduotąjį kursą, 5 eurai yra lygūs 647.65 jienos (apvalinta iki dvejų ženklų po kablelio)
		$eur_to_jpy_default = 647.65;
		//Pagal užduotąjį kursą, 5 eurai yra lygūs 5.7485 JAV doleriams (apvalinta iki dvejų ženklų po kablelio)
		$eur_to_usd_default = 5.75;	
		//Pagal užduotąjį kursą, 5 eurai yra lygūs 563.32 jienoms (apvalinta iki dvejų ženklų po kablelio)
		$usd_to_jpy_default = 563.32;	
		
		
		
		$eur_to_jpy = round($model->convertCurrency('EUR', 'JPY', 5), 2);
		$eur_to_usd = round($model->convertCurrency('EUR', 'USD', 5), 2);
		$usd_to_jpy = round($model->convertCurrency('USD', 'JPY', 5), 2);

		if($eur_to_jpy == $eur_to_jpy_default && $eur_to_usd == $eur_to_usd_default && $usd_to_jpy == $usd_to_jpy_default) return true;
		else return false;

	}
	
	/**
	 * Metodas testuoja, kas bus su valiutos konvertoriumi, jei jisai gaus neegzistuojančią valiutą
	 */
	public function testConvertCurrencyNoData () {
		
		$model = new Komisiniai();	
		
		$eur_to_cad = $model->convertCurrency('EUR', 'CAD', 5);
			
		if( $eur_to_cad == false ) return true;

		else return false;
		
	}
	
	/**
	 * Metodas tikrina, ar savaitės masyve galima teisingai išskirti tik vieno vartotojo, vienos operacijos tipo įrašus
	 * Įėjimo masyvas yra MOCK objektas
	 */
	public function testGetAktualausIDSavaitesIrasai() {
		
		$model = new Komisiniai();	

		$mock = array(
		
			'0'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'200.00', 'EUR'),
			'1'=>array('0'=>'2016-01-04', '1'=>'2', '2'=>'natural', '3'=>'cash_in', '4'=>'200.00', 'EUR'),
			'2'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'200.00', 'EUR'),
			'3'=>array('0'=>'2016-01-05', '1'=>'3', '2'=>'natural', '3'=>'cash_in', '4'=>'200.00', 'EUR'),
			'4'=>array('0'=>'2016-01-05', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'200.00', 'EUR'),
			'5'=>array('0'=>'2016-01-06', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'200.00', 'EUR'),
			'6'=>array('0'=>'2016-01-07', '1'=>'6', '2'=>'natural', '3'=>'cash_in', '4'=>'200.00', 'EUR'),
			'7'=>array('0'=>'2016-01-08', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'200.00', 'EUR'),
			'8'=>array('0'=>'2016-01-08', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'200.00', 'EUR'),
			'9'=>array('0'=>'2016-01-09', '1'=>'3', '2'=>'natural', '3'=>'cash_in', '4'=>'200.00', 'EUR'),
			'10'=>array('0'=>'2016-01-10', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'200.00', 'EUR'),
		
		);
		
		
		
		$correct_mock = array(
		
		
			'0'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'200.00', 'EUR'),
			'1'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'200.00', 'EUR'),
			'2'=>array('0'=>'2016-01-05', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'200.00', 'EUR'),
			'3'=>array('0'=>'2016-01-06', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'200.00', 'EUR'),
			'4'=>array('0'=>'2016-01-08', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'200.00', 'EUR'),
			'5'=>array('0'=>'2016-01-08', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'200.00', 'EUR'),
			'6'=>array('0'=>'2016-01-10', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'200.00', 'EUR'),
		
		);
		
		$model->week_buffer = $mock;
		$actual_user_id_week_buffer = $model->getAktualausIDSavaitesIrasai(); 

		$correct_flag = true;
		
		if( count($actual_user_id_week_buffer) == count($correct_mock)) {
			
			foreach($actual_user_id_week_buffer as $key => $issue) {
				
				if(count(array_diff($issue, $correct_mock[$key])) > 0) $correct_flag = false;
				
			}
			
			return $correct_flag;
			
		}
		else return false;
		
	}
	
	/**
	 * Metodas testuoja inesimo komiso korrektiskuma. Naudojamas testinis mokejimų masyvas, kiekvienas kurio laukas yra įrašas, kurio komisinis bus skaičiuojamas
	 * Taip pat naudojamas ranka suskaičiuotų atsakymų masyvas. Vieninteris reikalavimas - testinio ir atsakimų masyvo raktai turi sutapti.
	 */
	public function testInesimoKomisas() {
		
		$model = new Komisiniai();	
		
		//Testinis masyvas
		$mock = array(
		
			'0'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'200.00', 'EUR'),
			'1'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'10000.00', 'EUR'),
			'2'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'20000.00', 'EUR'),
			'3'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'2500.00', 'EUR'),
			'4'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'0.00', 'EUR'),
			'5'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'100.00', 'EUR'),
			'6'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'12000.00', 'EUR'),
			'7'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'300.00', 'EUR'),
			'8'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'50.00', 'EUR'),
			'9'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'natural', '3'=>'cash_in', '4'=>'50000.00', 'EUR'),
				
		);
		
		//Suskaičiuotasis ranka atsakimų masyvas (skaiciai turi buti suvesti dveju zenklu po kablelio tikslumu, apvalinant i didziają pusę)
		$komis_correct = array(
			'0'=>0.06, 
			'1'=>3, 
			'2'=>5, 
			'3'=>0.75,
			'4'=>0,
			'5'=>0.03,
			'6'=>3.6,
			'7'=>0.09,
			'8'=>0.02,
			'9'=>5,
			
		);
		
		$correct_flag = true;
		
		//Perrenkami 10 mokėjimų su iš anksto žinomais atsakimais ir tikrinama, ar komisas skaičiuojamas teisingai
		foreach($mock as $key => $issue) {
			
			//Vienintelis įrašas įrašomas į buverius, iš kurių komiso skaičiavimo metodas ims ir į kuriuos rašys duomenys
			$model->week_buffer = array($issue);

			$komisas = $model->inesimoKomisas();

			if($komisas != $komis_correct[$key]) $correct_flag = false;
			
			
		}
		return $correct_flag;

	}
	
	/**
	 * Metodas testuoja išėmimo komiso juridiniams klientams korrektiskumą. Naudojamas testinis mokejimų masyvas, kiekvienas kurio laukas yra įrašas, kurio komisinis bus skaičiuojamas
	 * Taip pat naudojamas ranka suskaičiuotų atsakymų masyvas. Vieninteris reikalavimas - testinio ir atsakimų masyvo raktai turi sutapti.
	 */
	 
	public function testJuridiniaiIsemimoKomisas() {
		
		$model = new Komisiniai();	
		//Testinis masyvas
		$mock = array(
		
			'0'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'legal', '3'=>'cash_out', '4'=>'200.00', 'EUR'),
			'1'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'legal', '3'=>'cash_out', '4'=>'10000.00', 'EUR'),
			'2'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'legal', '3'=>'cash_out', '4'=>'20000.00', 'EUR'),
			'3'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'legal', '3'=>'cash_out', '4'=>'2500.00', 'USD'),
			'4'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'legal', '3'=>'cash_out', '4'=>'0.00', 'EUR'),
			'5'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'legal', '3'=>'cash_out', '4'=>'100.00', 'EUR'),
			'6'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'legal', '3'=>'cash_out', '4'=>'12000.00', 'EUR'),
			'7'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'legal', '3'=>'cash_out', '4'=>'300.00', 'EUR'),
			'8'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'legal', '3'=>'cash_out', '4'=>'500.00', 'JPY'),
			'9'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'legal', '3'=>'cash_out', '4'=>'50000.00', 'JPY'),
				
		);
		
		//Suskaičiuotasis ranka atsakimų masyvas (skaiciai turi buti suvesti dveju zenklu po kablelio tikslumu, apvalinant i didziają pusę)
		$komis_correct = array(
			'0'=>0.6, 
			'1'=>30, 
			'2'=>60, 
			'3'=>7.5,
			'4'=>0.5,
			'5'=>0.5,
			'6'=>36,
			'7'=>0.9,
			'8'=>64.77,
			'9'=>150,
			
		);
		
		$correct_flag = true;
		
		//Perrenkami 10 mokėjimų su iš anksto žinomais atsakimais ir tikrinama, ar komisas skaičiuojamas teisingai
		foreach($mock as $key => $issue) {
			
			//Vienintelis įrašas įrašomas į buverius, iš kurių komiso skaičiavimo metodas ims ir į kuriuos rašys duomenys
			$model->week_buffer = array($issue);

			$komisas = $model->juridiniaiIsemimoKomisas();

			if($komisas != $komis_correct[$key]) $correct_flag = false;
			
			
		}
		return $correct_flag;
		
	}
	
	/**
	 * 
	 */
	public function testfiziniaiIsemimoKomisas() {
		
		$model = new Komisiniai();	
		//Testinis masyvas
		$mock = array(
		
			'0'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'natural', '3'=>'cash_out', '4'=>'200.00', 'EUR'),
			'1'=>array('0'=>'2016-01-04', '1'=>'1', '2'=>'natural', '3'=>'cash_out', '4'=>'500.00', 'EUR'),
			'2'=>array('0'=>'2016-01-05', '1'=>'1', '2'=>'natural', '3'=>'cash_out', '4'=>'900.00', 'EUR'),
			'3'=>array('0'=>'2016-01-05', '1'=>'1', '2'=>'natural', '3'=>'cash_out', '4'=>'250.00', 'EUR'),
			'4'=>array('0'=>'2016-01-06', '1'=>'1', '2'=>'natural', '3'=>'cash_out', '4'=>'0.00', 'EUR'),
			'5'=>array('0'=>'2016-01-07', '1'=>'1', '2'=>'natural', '3'=>'cash_out', '4'=>'100.00', 'EUR'),

				
		);
		
		//Suskaičiuotasis ranka atsakimų masyvas (skaiciai turi buti suvesti dveju zenklų po kablelio tikslumu, apvalinant i didziają pusę)
		$komis_correct = array(
			'0'=>0, 
			'1'=>0, 
			'2'=>1.8, 
			'3'=>0.75,
			'4'=>0,
			'5'=>0.3,
			
		);
		
		$correct_flag = true;
		//Vienintelis įrašas įrašomas į buverius, iš kurių komiso skaičiavimo metodas ims ir į kuriuos rašys duomenys
		
			
		//Perrenkami 10 mokėjimų su iš anksto žinomais atsakimais ir tikrinama, ar komisas skaičiuojamas teisingai
		foreach($mock as $key => $issue) {
			$model->week_buffer[] = $issue;
			$komisas = $model->fiziniaiIsemimoKomisas();
			if($komisas != $komis_correct[$key]) $correct_flag = false;
			
			
		}
		return $correct_flag;
		
	}
    
}
?>
