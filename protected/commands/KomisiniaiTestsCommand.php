<?php
class KomisiniaiTestsCommand extends CConsoleCommand
{
   
	public function run($args)
	{			
			$tests = new TestKomisiniai;
			echo "\n*********************************************\n\n";
			echo "1 testas. Valiutų konversijos convertCurrency() metode tikrinimas \n";
			
			if($tests->testConvertCurrencyCalcCorrection()) echo "Valiutų konversijos skaičiavimas Komisiniai modelyje, convertCurrency() metode yra korrektiškas. Testas sekmingai atliktas. \n\n";
			else echo "Valiutų konversijos skaičiacimas nekorrektiškas. Prašome patikrinti Komisiniai klasės convertCurrency() metodą \n\n";
				
			echo "\n*********************************************\n\n";
			echo "2 testas. Neteisingos valiutos pateikimo convertCurrency() metodui tikrinimas \n";
			
			if($tests->testConvertCurrencyNoData())  echo "Metodas convertCurrency() nekonvertuoja valiutos, jei bent vieną iš dvejų konversiojoje dalyvaujančių valiutų neegzistuoja valiutų masyve. Testas atliktas sėkmingai\n\n";
			else echo "Metodas convertCurrency() suskaičiavo valiųtų konversiją, nors viena iš valiųtų CAD neėgzistavo valiutų masyve. Testas neatliktas\n\n";
			
			echo "\n*********************************************\n\n";
			echo "3 testas. Testas tikrina, ar is savaitės masyvo korrektiškai gaunamos tik vieno vartotojo operacijos\n";
			
			if($tests->testGetAktualausIDSavaitesIrasai()) echo "Metodas getAktualausIDSavaitesIrasai() generuoja teisingą vartotojo savaitės operacijų masyvą. Testas atliktas sėkmingai\n\n";
			else echo "Metodas getAktualausIDSavaitesIrasai() generuoja klaidingą vartotojo savaitės operacijų masyvą. Testas neatliktas sėkmingai\n\n";
			
			echo "\n*********************************************\n\n";
			echo "4 testas. Įnešimo operacijos komiso skaičiavimo tikrinimas. Įnešimo komisui, fiziniams bei juridiniams asmenims galioja tos pačios taisyklės.";
			
			if($tests->testInesimoKomisas()) echo "Metodas InesimoKomisas() skaičiuoja teisingai. Visi testai atlikti sekmingai\n\n";
			else echo "Metodas InesimoKomisas() skaičiuoja klaidingai. Kai kurie atsakimai yra klaidingi\n\n";
			
			echo "\n*********************************************\n\n";
			echo "5 testas. Išėmimo operacijos juridiniams asmenims komiso skaičiavimo tikrinimas.";
			
			if($tests->testJuridiniaiIsemimoKomisas()) echo "Metodas JuridiniaiIsemimoKomisas() skaičiuoja teisingai. Visi testai atlikti sekmingai\n\n";
			else echo "Metodas JuridiniaiIsemimoKomisas() skaičiuoja klaidingai. Buvo panaudoti įvairus išėmimo mokėjimų skaičiai. Kai kurie atsakimai yra klaidingi\n\n";
			
			echo "\n*********************************************\n\n";
			echo "6 testas. Išėmimo operacijos fiziniams asmenims komiso skaičiavimo tikrinimas.";
			
			if($tests->testFiziniaiIsemimoKomisas()) echo "Metodas FiziniaiIsemimoKomisas() skaičiuoja teisingai.  Visi testai atlikti sekmingai\n\n";
			else echo "Metodas FiziniaiIsemimoKomisas() skaičiuoja klaidingai. Buvo panaudoti įvairus išėmimo mokėjimų skaičiai. Kai kurie atsakimai yra klaidingi\n\n";
			
			echo "\n*********************************************\n\n";
		
	}

}
?>
