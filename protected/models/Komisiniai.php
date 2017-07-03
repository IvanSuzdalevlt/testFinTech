<?php
/**
 * Klasė skirta komisinių skaičiavimui. Komisinių skaičiavimui reikiama informacija yra kraunama
 * į klasės laukus. Nuskaityta *.csv laikmena įkraunama į $csv_buffer klasės lauką.
 * Pagrindinis metodas, skaičiuojantis komisinius yra calculateKomis(). Šis metodas perrenka
 * visus mokėjimus, esančius $csv_buffer masyve po vieną ir pagal mokėjimų duomenys 
 * paleidžia atitinkamus komiso skaičiavimo metodus (įeinantis/išeinantis mokėjimai, fizinis/juridinis klientai).
 * Kiekvienas komiso skaičiavimo metodas suskaičiuoja komisą $csv_buffer šiuo metu iteruojamam laukui ir rezultatą įdedą į šio lauko polaukį.
 * Vienai iš komiso skaičiavimo operaciju reikia savaitės operacijų istorijos. Šiuo tikslu yra $week_buffer masyvas.
 * Šis masyvas reguliariai valomas, kad jame būtu tik šiuos savaitės duomenys.
 */

class Komisiniai extends CModel {
	
	//Masyvas, kuriame yra valiutų kursai, lyginant su EUR
	public $currency_array = array(
		
		'EUR' => 1,
		'USD' => 1.1497,
		'JPY' => 129.53,
		
		
	);
	
	
	public $after_dot = 2;//Apvalinimo tikslumas, iki kurio po kablelio vyks apvalinimas. Šiuo atveju euro centai - du ženklai po kablelio
	
	public $default_currency = 'EUR'; //Standartinė valiuta, į kurą vyksta visi tarpiniai perskaičiavimai
	
	public $in_komis = 0.03; //Įnešimo komiso reikšmė procentais. Bendra fiziniams ir juridiniams klientams
	
	public $fizinis_out_komis = 0.3; //Išėmimo komiso reikšmė fiziniams klientams
	
	public $juridinis_out_komis = 0.3; //Išėmimo komiso reikšmė juridiniams klientams
	
	public $csv_buffer = false; //Buferis, į kurį bus kraunamas visas CSV failas
	
	public $week_buffer = false; //Savaitės trukmės buferis, į kurį kraunami duomenys tik už paskutinę savaitę. Visi kiti duomenys yra išvalomi
	
	public $discount_limit = 1000; //Saveitės nuolaida, suteikiama fiziniams asmenims išsiimti pinigus
	
	public function attributeNames() {
		
		
	}
	
	/**
	* Metodas konvertuoja vieną valiutos sumą į kitą
	* Valiutos kursai imami iš public masyvo $currency_array
	* @params string - $currency_in_name - įėjimo valiutos, iš kurios konvertuojama, pavadinimas
	* @params string - $currency_out_name - įėjimo valiutos, į kurią konvertuojama, pavadinimas
	* @params int - $money_value - įėjimo valiutos suma
	 */
	public function convertCurrency($currency_in_name, $currency_out_name, $money_value) {
		
		if (array_key_exists($currency_in_name, $this->currency_array) && array_key_exists($currency_out_name, $this->currency_array) and $money_value) {
			
			$in_currency_rate = $this->currency_array[$currency_in_name];
			$out_currency_rate = $this->currency_array[$currency_out_name];
			
			$converted_value = ( (float)$money_value /(float)$in_currency_rate ) * (float)$out_currency_rate;
			
			return $converted_value;
		}
		else return false;
	}
	
	/**
	 * Metodas paima nuorodą į laikmeną, ją nuskaito ir rezultatą patalpina į modelio lauką - masyvą/buferį
	 * @param string $url_to_file - nuoroda į laikmeną
	 */
    public function parseCsv($url_to_file) {
		
		if(file_exists($url_to_file)) {
		
			$this->csv_buffer = array_map('str_getcsv', file($url_to_file));
		
			if($this->csv_buffer and count($this->csv_buffer) > 0) return true;
			
			else return false;
			
		} 
		else return false;
        
    }
    
    /**
	 * Metodas gauna paskutinį aktualų įrašą iš savaitės įrašų masyvo
	 * @param array $this->week_buffer - savaites buferis, kurio paskutinis elementas yra šiuo metu perrenkamas aktualus įrašas
	 * @return array/false
     */
    public function getActualFromSavaiteArray() {
		
		$actual_issue = false;
		//Gaunamas pats paskutinis savaitės buferio įrašas, kuris ir bus pats šviežiausias
		if(count($this->week_buffer) > 0) foreach($this->week_buffer as $actual_issue) {}
		
		return $actual_issue;
		
	}
	
    /**
	 * Metodas gauna šiuo metu aktualaus įrašo vartotojo visą savaitės mokėjimų istorija esant tam tikram operacijos tipui
	 * pavyzdžiui vartotojo ID = 1, operacijos tipas - pinigų išėmimas
	 * @param array $this->week_buffer - savaites buferis - modelio laukas, is kurio bus išrenkami visi įrašai,
	 * kurių darbuotojų ID ir operacijos tipas sutampa su paskutinio įrašo darbuotojo ID
	 * @return array/false
     */
    public function getAktualausIDSavaitesIrasai() {
		
		//Gaunamas dabar perrenkamo iraso vartotojo ID
		$actual_issue = $this->getActualFromSavaiteArray();
		
		if($actual_issue && count($actual_issue) > 0) {
			
			$user_id = $actual_issue[1];
			$oper_type = $actual_issue[3];
			
			$return_array = false;
			
			//Perrenkami visi įrašai ir paliekami tik tie, kuriuose vartotojo ID user_id sutampa su įrašais savaitės buferyje
			foreach ( $this->week_buffer as $issue ) {
				
				$iterated_user_id = $issue[1];
				$iterated_oper_type = $issue[3];
				
				//Jei sutampa vartotojo ID ir operacijos tipas, reiskia iraso eilutę reikia įtraukti į gražinamą masyvą
				if($user_id == $iterated_user_id && $oper_type == $iterated_oper_type) $return_array[] = $issue;
				
			}
			
			return $return_array;
				
		}
		else return false;
		
	}
    
    /**
     * Metodas yra skirtas skaičiuoti fizinio bei juridinio asmens įnešamų pinigų komisą
     * Kadangi komisui nereikia mokėjimų istorijos, komisui suskaičiuoti pakanka tik sumos ir valiutos 
     * Suma ir valiuta imami iš savaitės buferio pačio šviežiausio įrašo, nes jisai atitinka dabartinį skaičiuojamą komiso įrašą
     * @return - int
     */
    public function inesimoKomisas ( ) {
		
		$actual_issue = $this->getActualFromSavaiteArray();
		$actual_sum = $actual_issue[4];
		$actual_currency = $actual_issue[5];
		
		//Skaičiuojamas komisas, dalijama iš 100, nes komisinių dydis pvz 0.3 yra procentais
		$komisas = ( (float)$this->in_komis  * (float)$actual_sum ) / 100;
		
		//Konvertuojama į eurus, tam kad sutikrinti su sąlyga, jog komisas neturi viršyti 5 EUR
		$to_eur_komisas = SELF::convertCurrency($actual_currency, $this->default_currency, $komisas);
		
		//Tikrinama salyga, jog komisas neturi būti didesnis, nei 5 eurai
		if( $to_eur_komisas > 5 ) $komisas = SELF::convertCurrency($this->default_currency, $actual_currency, 5);
		
		return SELF::round_up($komisas, $this->after_dot);
	}
	
	
	/**
     * Metodas skaičiuoja vieno vartotojo komisą, naudodamas jo savaitės mokėjimų istoriją
	 * Savaites mokėjimu istorija yra saugoma savaites buferyje - modelio lauke
	 * @return int
	 */
	public function fiziniaiIsemimoKomisas () {
		
		
		//Gaunamas dabar aktualus irasas, kuriam bus skaičiuojamas komisinis
		$actual_issue = $this->getActualFromSavaiteArray();
		$actual_sum = $actual_issue[4];
		$actual_currency = $actual_issue[5];
		
		//Aktuali suma eurais
		$actual_default_sum = SELF::convertCurrency($actual_currency , $this->default_currency, $actual_sum);
		
		//Gaunama šiuo metu aktualaus iraso vieno konkretaus vartotojo visa savaitės mokėjimų istorija
		$savaites_isemimo_array = $this->getAktualausIDSavaitesIrasai();
		
		$komisas = 0;
		
		//Pradinė mokejimu savaites suma
		$mokejimu_savaites_suma = 0;
			
		//Perrenkamas savaites mokejimu masyvas, gaunama visu operacijų suma standartine valiuta (EUR)
		foreach ($savaites_isemimo_array as $mokejimas_array) {
			
			$curent_currency = $mokejimas_array['5'];
			$current_sum = $mokejimas_array['4'];
			
			$mokejimu_savaites_suma = $mokejimu_savaites_suma + SELF::convertCurrency($curent_currency , $this->default_currency, $current_sum );
			
		}

		//Pirmasis scenarijus - jei mokejimu suma yra mazesne, nei 1000 eurų taikomas 0 komisu taryfas
		if ($mokejimu_savaites_suma <= $this->discount_limit) {

			$komisas = 0;
			
		}
		//Antrasis scenarijus - Jei suma viršijama, bet mokėjimų į savaitę skaičius <= 3 - komisinis skaičiuojamas tik nuo viršytos sumos (t.y. vis dar galioja 1000 EUR be komiso). 
		elseif ($mokejimu_savaites_suma > $this->discount_limit && count($savaites_isemimo_array) <= 3) {
				
				
			//Sužinoma, kokia suma buvo ampokestinka komisiniu, atskaicius neapmokestinamą 1000 EU
			$likusi_suma_be_nuolaidos = $mokejimu_savaites_suma - $this->discount_limit;
			
			//Jei ši likusi suma didesnė už aktualią - reiškia 1000 EUR limitas jau išeikvotas ir apmokestinamas tik paskutinis aktualus mokejimas
			//Jei ši likusi suma mažesnę už aktualią, reiškia 1000 EUR limitas dar nėra visiškai išeikvotas ir apmokestinti reikia tik likutį
			if($likusi_suma_be_nuolaidos > $actual_default_sum) $komisas_default = ( ( (float)$actual_default_sum) * (float)$this->fizinis_out_komis )/ 100;
			else $komisas_default = ( ( (float)$likusi_suma_be_nuolaidos) * (float)$this->fizinis_out_komis )/ 100;
			
			$komisas = SELF::convertCurrency($this->default_currency, $actual_currency, $komisas_default);

		}
		//Trečiasis scenarijus - Jei suma viršijama ir mokėjimų į savaitę skaičius > 3, tai 1000 nuolaidos nebėra
		elseif ($mokejimu_savaites_suma > $this->discount_limit && count($savaites_isemimo_array) > 3) {
			
			//Pirmiausia suskaičiuojamas komisas einamojo mokėjimo sumai, paverstai EUR
			$komisas_default = ( ( (float)$actual_default_sum) * (float)$this->fizinis_out_komis )/ 100;
			//Tada komisas perkonvertuojamas į pradinę mokėjimo valiutą
			$komisas = SELF::convertCurrency($this->default_currency, $actual_currency, $komisas_default);
			
		}
		//Galutinis komisas suapvalinamas iki dveju zenklu po kablelio į didžiają pusę
		return SELF::round_up($komisas, $this->after_dot);

	}
	
	
	/**
	 * Metodas skaičiuoja juridinio asmens išėmimo komisą
	 * Kadangi komisui nereikia mokėjimų istorijos, komisui suskaičiuoti pakanka tik sumos ir valiutos 
	 * Suma ir valiuta imami iš savaitės buferio pačio šviežiausio įrašo, nes jisai atitinka dabartinį skaičiuojamą komiso įrašą
	 */
	public function juridiniaiIsemimoKomisas ( ) {
		
		$actual_issue = $this->getActualFromSavaiteArray();
		$actual_sum = $actual_issue[4];
		$actual_currency = $actual_issue[5];
		
		$komisas = (float)$this->juridinis_out_komis * (float)$actual_sum / 100;

		//Konvertuojama į eurus, tam kad sutikrinti su sąlyga
		$to_eur_komisas = SELF::convertCurrency($actual_currency, $this->default_currency, $komisas);

		//Sutikrinama su sąlygą, jei komisas mažesnis, nei 0.5 EUR, bet didesnis, nei 0, jisai prilyginamas 0.5 EUR ir konvertuojamas atgal į pradinę valiutą
		if($to_eur_komisas < 0.5 && $to_eur_komisas > 0) $komisas = SELF::convertCurrency($this->default_currency, $actual_currency, 0.5);
		
		//Gražiname rezultatą, apvalintą iki dvejų ženklų po kablelio į didžiąją pusę - iki centų
		return SELF::round_up($komisas, $this->after_dot);
		
	}
	
	/**
	 * Metodas apvalinantis į didžiąja pusę iki pasirinktojo ženklo po kablelio.
	 * Valiutų atžvilgiu apvalinimas dažniausiai vyksta iki 2 ženklų po kablelio - iki centų
	 * @param flot $in_value - skaičius kurį apvalinsim
	 */
    public function round_up($in_value, $after_dot) {

		return ceil($in_value * pow(10, $after_dot)) / pow(10, $after_dot);	
		
	}
	
	/**
	 * Metodas atiduoda dvejų datų skirtumą dienomis
	 * Metodas skaičiuoja įskaitomai ir pirmąją ir atrają datas
	 * Pavyzdžiui 2017-06-19 - 2017-06-25 skirtumas bus lygus ne 6 o 7 dienoms, nes įskaitomai ir 19 ir 25 dienos
	 * @param string - $date1 - pirmoji data
	 * @param string - $date2 - antroji data
`	 * @return int
	 */
	public function dateDayDiffDays($date1, $date2) {
		
		$timestamp1 = strtotime($date1);
		$timestamp2 = strtotime($date2);
		
		//Pridedama viena diena prie rezultato, nes skaiciuojama nuo tam tikros iki tam tikros datos iskaitomai
		return ( 1 + abs($timestamp1 - $timestamp2)/60/60/24 );
		
	}
	
	
	/**
	 * Metodas išvalo savaitės trukmės masyvą nuo pasenusiu įrašų, kurie yra už šios savaitės rybų
	 * Buferio valymas pasileidžia, jei skirtumas tarp einamosios datos ir pirmojo masyvo elemento datos
	 * yra didesnis, nei 7 dienos, arba seniausia savaitės data iškrenta už šios savaitės rybų. 
	 * To reikia, kad buferio perrinkimas nepasileistu per dažnai
	 */
	public function clearOldWeekBuffer() {
				
		//Gaunamas pirmojo masyvo elemento raktas
		foreach ($this->week_buffer as $first_issue) { break;}
		$oldest_date = $first_issue[0];
		
		//Perrinkus visą savaitės trukmės įrašų masyvą, jo paskutinis elementas bus šiuo metu šviežiausias įrašas
		foreach ($this->week_buffer as $last_issue) {}
		$current_date = $last_issue[0];
		
		//Sužinoma, koks yra einamojo įrašo dienos numeris (antradienis 2 ir t.t.)
		$current_day_nr =  strftime("%u, %d/%m/%Y", strtotime($current_date));

		
		//Jei skirtumas tarp seniausios ir naujaujos įrašų datų didesnis, nei einamosios savaitės dienos numeris, pasileidžia savaitės buferio valymas
		if($this->dateDayDiffDays($current_date, $oldest_date) > $current_day_nr) {
			
			foreach ($this->week_buffer as $key => $irasas) {
				
				$date = $irasas[0];
				
				//Tuo atveju, jei skirtumas tarp einamosios ir iteruojamo iraso datos yra didesnis, nei actualios dienos skaičius savaitėje, 
				//iteruojamas elementas yra pašalinamas iš masyvo
				if ( $this->dateDayDiffDays( $current_date, $date ) > $current_day_nr) unset( $this->week_buffer[$key] );
				
			}
			
		}
		
	}

	/**
	 * Metodas yra skitas suskaičiuoti komisui. Metodas veikia pagal kelys scenarijus
	 * Pirmasis scenarijus - vartotojas juridinis, vyksta pinigų įnešimas
	 * Antrasis scenarijus - vartotojas fizinis, vyksta pinigų įnešimas
	 * Trečiasis scenarijus - vartotojas juridinis, vyksta pinigų išėmimas
	 * Ketvirtasis scenarijus - vartotojas fizinis, vyksta pinigų išėmimas
	 */
    public function calculateKomis() {
						
			if($this->csv_buffer and count($this->csv_buffer) > 0) {
					
				foreach($this->csv_buffer as $key => $irasas) {
						
						//Nauja eilutė iškarto įdedama į savaitės buferį. Tokiu būdu savaitės buferyje visa laika 
						//aktuali dabartinė pinigų operacijos eilutė, su kuria dabar ir vyksta visas komisiniu skaičiavimas
						$this->week_buffer[] = $irasas;				
						
						//Masyvo laukai prilyginami kintamiesiems, kad nereiktu ju prisiminti pagal indeksus
						$date = $irasas[0];
						$id = $irasas[1];
						$naud_type = $irasas[2];
						$oper_type = $irasas[3];
						$oper_sum = $irasas[4];
						$oper_currency = $irasas[5];
						
						$this->clearOldWeekBuffer();
						
						
						
						//Komisiniu scenariju skaiciavimas, rezultatas idedamas i buferizuotos laikmenos pasyva, į lauką su indeksu 6
						
						//Pirmasis scenarijus - vartotojas juridinis, vyksta pinigų įnešimas
						if($naud_type == 'legal' && $oper_type == 'cash_in') {
							
							$this->csv_buffer[$key][6] = $this->inesimoKomisas();
							
						}
						
						//Antrasis scenarijus - vartotojas fizinis, vyksta pinigų įnešimas
						if($naud_type == 'natural' && $oper_type == 'cash_in') {
							
							$this->csv_buffer[$key][6] = $this->inesimoKomisas();
							
						}
						
						//Trečiasis scenarijus - vartotojas juridinis, vyksta pinigų išėmimas
						if($naud_type == 'legal' && $oper_type == 'cash_out') {
							
							$this->csv_buffer[$key][6] = $this->juridiniaiIsemimoKomisas();
							
						}
						
						//Ketvirtasis scenarijus - vartotojas fizinis, vyksta pinigų išėmimas
						if($naud_type == 'natural' && $oper_type == 'cash_out') {
							
							$this->csv_buffer[$key][6] = $this->fiziniaiIsemimoKomisas();
							
						}

					}
					return true;	
				}
		else return false;
		
	}

}
?>
