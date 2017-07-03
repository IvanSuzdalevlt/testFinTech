<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title></title>
	<meta name="generator" content="LibreOffice 4.2.7.2 (Linux)">
	<meta name="created" content="20170626;0">
	<meta name="changed" content="20170626;180904825538824">
	<style type="text/css">
	<!--
		@page { margin: 0.79in }
		p { margin-bottom: 0.1in; color: #000000; line-height: 120% }
		h2 { color: #000000 }
		h2.western { font-family: "Liberation Sans", sans-serif; font-size: 16pt }
		h2.cjk { font-family: "Droid Sans Fallback"; font-size: 16pt }
		h2.ctl { font-family: "FreeSans"; font-size: 16pt }
		a:link { so-language: zxx }
	-->
	</style>
</head>
<body lang="en-US" text="#000000" dir="ltr" style="background: transparent">
<p align="justify" style="margin-top: 0.17in; margin-bottom: 0.08in; line-height: 100%; page-break-after: avoid">
<font face="Liberation Sans, sans-serif"><font size="6" style="font-size: 28pt"><b>Projekto
dokumentacija</b></font></font></p>
<p align="justify" style="line-height: 150%"><br><br>
</p>
<p align="justify" style="line-height: 150%">Projektas yra atliktas
YII 1.1 framework'o pagrindu. Projekto aplanke yra framework –
aplankas su YII 1.1 framework'u. Jo vieta neturi kisti, nes yra
aprašyta <i><b>/protected/config/main.php</b></i> laikmenoje.</p>
<h2 class="western" align="justify">Projekto paleidimas</h2>
<p align="justify"><br><br>
</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%">Projektas
paleidžiamas per konsolę. Windows operacinėje sistemoje turi būti
užduota <strong><i><span style="font-weight: normal">Environment
Variables</span></i></strong><strong> </strong><strong><span style="font-weight: normal">nuorodą
į aplanką su php.exe laikmena. Pvz </span></strong><strong><i><span style="font-weight: normal">c:\xampp\php\</span></i></strong><strong>
</strong><strong><span style="font-weight: normal">Atitinkama nuoroda
į php&nbsp;</span></strong>interpretatoriaus<strong> </strong><strong><span style="font-weight: normal">paleidžiamąjį
failą turi būti užduota linux operacinėje sistemoje.</span></strong></p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><strong><span style="font-weight: normal">Paleidimui
reikia užeiti į projekto aplanką, jame bus </span></strong><strong><i><span style="font-weight: normal">/paysera/protected</span></i></strong><strong>
</strong><strong><span style="font-weight: normal">aplankas.
</span></strong><strong><i><span style="font-weight: normal">Protected</span></i></strong><strong>
</strong><strong><span style="font-weight: normal">aplanke bus </span></strong><strong>yiic
</strong><strong><span style="font-weight: normal">(linux) ir
</span></strong><strong>yiic.bat </strong><strong><span style="font-weight: normal">(windows)
paleidžiamieji</span></strong><strong> </strong><strong><span style="font-weight: normal">failai.
Paleidus šį failą per konsolę, konsolėje išmes </span></strong><strong>yiic
</strong><strong><span style="font-weight: normal">palaikomų komandų
sąrašą.&nbsp;Mus domina dvi komandos: </span></strong><strong>komisiniaitests
</strong><strong><span style="font-weight: normal">ir
</span></strong><strong>komisiniaiskaiciuoti</strong><strong><span style="font-weight: normal">.</span></strong></p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><strong><span style="font-weight: normal">Komanda
</span></strong><strong>komisiniaitests </strong><strong><span style="font-weight: normal">pasileidžia
be argumentų. Komanda </span></strong><strong>komisiniaiskaiciuoti
</strong><strong><span style="font-weight: normal">pasileidžia su
kelio iki *.csv laikmenos argumentu.</span></strong></p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><br>
</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i><b>Komisinių
skaičiavimo paleidimas</b></i></p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%">Linux
operacinėje sistemoje užeiti į projekto “paysera/protected”
alpanką. Paleisti komandą:</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%">./yiic
komisiniaiskaiciuoti /opt/lampp/htdocs/paysera/in.csv</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%">Windows
operacinėje sistemoje užeiti į projekto “paysera/protected”
aplanką. Paleisti</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%">yiic.bat
komisiniaiskaiciuoti c:\xampp\htdocs\paysera\in.csv</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><br>
</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i><b>Testų
paleidimas.</b></i></p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%">Linux
operacinėje sistemoje. Užeiti į “paysera/protected” aplanką.
Įvykdyti komandą:</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%">./yiic
komisiniaitests</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%">Windows
operacinėje sistemoje užeiti į projekto “paysera/protected”
aplanką. Paleisti</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%">yiic.bat
komisiniaitests</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><br>
</p>
<h2 class="western" align="justify"><b>Pagrindinės&nbsp;projekto
klasės</b></h2>
<p align="justify"><br><br>
</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i><b>protected/models/Komisiniai.php</b></i>
– Komisiniai - visos verslo logikos modelis/klasė. Čia yra
surašyti visi metodai, skaičiuojantys komisinius. Šio modelio
laukuose užduodami&nbsp;valiutų kursai, bei kita statinė
informacija, kurios reikia komisinių skaičiavimui.</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%">Laikmena
su mokėjimų istorija (*.csv) užkraunama į Komisiniai modelio
<i><b>csv_buffer</b></i> lauką, kuris yra visos šios laikmenos
buferis. Užkrovimo metu laikmena verčiama masyvu, išskleidžiant
eilutes pagal <i><b>csv</b></i> dokumentų “parsinimo” taisykles.
Skaičiuojant komisinį, šis buferis perrenkamas po vieną įrašą
nuo seniausio iki naujausio.&nbsp;Lygiagrečiai perrenkami įrašai
dedami į kitą Komisiniai modelio lauką/buferį – <i><b>week_buffer</b></i>.
Šis <i><b>week_buffer</b></i> masyvas reguliariai valomas, kad jame
būtu tik einamos savaitės įrašai. Šis buferis reikalingas komiso
skaičiavimo operacijoms,&nbsp;kurioms reikalinga mokėjimų istorija
per einamąją savaitę.</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%">Suskaičiuoti
komisai dedami atgal į <i><b>csv_buffer</b></i> buferį/masyvą.
Tokiu būdu po visų įrašų perrinkimo <i><b>csv_buffer</b></i>
masyve bus pradiniai&nbsp;mokėjimo operacijų duomenys ir
suskaičiuotasis komisinis kiekvienai operacijai. Po visų komisų
skaičiavimo iteracijų <i><b>csv_buffer</b></i> struktūra atrodys
taip:</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i>array(eilės
numeris=&gt;</i></p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i>array(
operacijos data, </i>
</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i>naudotojo
identifikatorius, </i>
</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i>naudotojo
tipas, </i>
</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i>operacijos
tipas, </i>
</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i>operacijos
suma, </i>
</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i>operacijos
valiuta, </i>
</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i>suskaičiuotasis
komisas</i></p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i>))</i></p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><br>
</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i><b>protected/tests/TestKomisiniai.php
</b></i>– TestKomisiniai testų klasė. Klasėje yra testai,
tikrinantys, ar teisingai skaičiuoja Komisiniai modelio metodai.
Metodų rezultatai lyginami su rankiniu būdu suskaičiuotaisiais
duomenimis. Jei bus pakeisti modelio laukai, pvz valiutų kursai,
ranka suskaičiuotus kontrolinius duomenys reikės perskaičiuoti.</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><br>
</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i><b>/protected/commands/KomisiniaiSkaiciuotiCommand.php</b></i>
– komiso skaičiavimo konsolės klasė. Klasė naudoja Komisiniai
modelio metodus, paleidžia komisinių skaičiavimus, kaip argumentą
naudodama nuorodą į *.csv laikmeną, išveda skaičiavimo
rezultatus į <i><b>stdout</b></i>.</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><br>
</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i><b>/protected/commands/KomisiniaiTestsCommand.php</b></i>
– testų paleidimų konsolės klasė. Klasė paleidžia
TestKomisiniai testų klasės metodus, kurie testuoja komisinių
skaičiavimą. Testų rezultatai išvedami į stdout.</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><br>
</p>
</body>
</html>
