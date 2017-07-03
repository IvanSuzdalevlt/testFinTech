<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=windows-1251"/>
	<title></title>
	<meta name="generator" content="LibreOffice 4.4.5.2 (Windows)"/>
	<meta name="created" content="2017-06-26T00:00:00"/>
	<meta name="changed" content="2017-07-03T14:04:09.180000000"/>
	<style type="text/css">
		@page { margin: 0.79in }
		p { margin-bottom: 0.1in; color: #000000; line-height: 120% }
		h2 { color: #000000 }
		h2.western { font-family: "Liberation Sans", sans-serif; font-size: 16pt }
		h2.cjk { font-family: "Droid Sans Fallback"; font-size: 16pt }
		h2.ctl { font-family: "FreeSans"; font-size: 16pt }
		a:link { so-language: zxx }
	</style>
</head>
<body lang="en-US" text="#000000" dir="ltr">
<p align="justify" style="margin-top: 0.17in; margin-bottom: 0.08in; line-height: 100%; page-break-after: avoid">
<font face="Liberation Sans, sans-serif"><font size="6" style="font-size: 28pt"><b>Projekto
dokumentacija</b></font></font></p>
<p align="justify" style="line-height: 150%"><br/>
<br/>

</p>
<p align="justify" style="line-height: 150%">Projektas yra atliktas
YII 1.1 framework'o pagrindu. Projekto aplanke yra framework &ndash;
aplankas su YII 1.1 framework'u. Jo vieta neturi kisti, nes yra
apra&scaron;yta <i><b>/protected/config/main.php</b></i> laikmenoje.</p>
<h2 class="western" align="justify">Projekto paleidimas</h2>
<p align="justify"><br/>
<br/>

</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%">Projektas
paleid&#382;iamas per konsol&#281;. Windows operacin&#279;je
sistemoje turi b&#363;ti u&#382;duota <strong><i><span style="font-weight: normal">Environment
Variables</span></i></strong><strong> </strong><strong><span style="font-weight: normal">nuorod&#261;
&#303; aplank&#261; su php.exe laikmena. Pvz </span></strong><strong><i><span style="font-weight: normal">c:\xampp\php\</span></i></strong><strong>
</strong><strong><span style="font-weight: normal">Atitinkama nuoroda
&#303; php&nbsp;</span></strong>interpretatoriaus<strong>
</strong><strong><span style="font-weight: normal">paleid&#382;iam&#261;j&#303;
fail&#261; turi b&#363;ti u&#382;duota linux operacin&#279;je
sistemoje.</span></strong></p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><strong><span style="font-weight: normal">Paleidimui
reikia u&#382;eiti &#303; projekto aplank&#261;, jame bus
</span></strong><strong><i><span style="font-weight: normal">/</span></i></strong><strong><i><span style="font-weight: normal">projekto_aplankas</span></i></strong><strong><i><span style="font-weight: normal">/protected</span></i></strong><strong>
</strong><strong><span style="font-weight: normal">aplankas.
</span></strong><strong><i><span style="font-weight: normal">Protected</span></i></strong><strong>
</strong><strong><span style="font-weight: normal">aplanke bus </span></strong><strong>yiic
</strong><strong><span style="font-weight: normal">(linux) ir
</span></strong><strong>yiic.bat </strong><strong><span style="font-weight: normal">(windows)
paleid&#382;iamieji</span></strong><strong> </strong><strong><span style="font-weight: normal">failai.
Paleidus &scaron;&#303; fail&#261; per konsol&#281;, konsol&#279;je
i&scaron;mes </span></strong><strong>yiic </strong><strong><span style="font-weight: normal">palaikom&#371;
komand&#371; s&#261;ra&scaron;&#261;.&nbsp;Mus domina dvi komandos:
</span></strong><strong>komisiniaitests </strong><strong><span style="font-weight: normal">ir
</span></strong><strong>komisiniaiskaiciuoti</strong><strong><span style="font-weight: normal">.</span></strong></p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><strong><span style="font-weight: normal">Komanda
</span></strong><strong>komisiniaitests </strong><strong><span style="font-weight: normal">pasileid&#382;ia
be argument&#371;. Komanda </span></strong><strong>komisiniaiskaiciuoti
</strong><strong><span style="font-weight: normal">pasileid&#382;ia
su kelio iki *.csv laikmenos argumentu.</span></strong></p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><br/>

</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i><b>Komisini&#371;
skai&#269;iavimo paleidimas</b></i></p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%">Linux
operacin&#279;je sistemoje u&#382;eiti &#303; projekto
&ldquo;projekto_aplankas/protected&rdquo; alpank&#261;. Paleisti
komand&#261;:</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%">./yiic
komisiniaiskaiciuoti /opt/lampp/htdocs/projekto_aplankas/in.csv</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%">Windows
operacin&#279;je sistemoje u&#382;eiti &#303; projekto
&ldquo;projekto_aplankas/protected&rdquo; aplank&#261;. Paleisti</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%">yiic.bat
komisiniaiskaiciuoti c:\xampp\htdocs\projekto_aplankas\in.csv</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><br/>

</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i><b>Test&#371;
paleidimas.</b></i></p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%">Linux
operacin&#279;je sistemoje. U&#382;eiti &#303;
&ldquo;projekto_aplankas/protected&rdquo; aplank&#261;. &#302;vykdyti
komand&#261;:</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%">./yiic
komisiniaitests</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%">Windows
operacin&#279;je sistemoje u&#382;eiti &#303; projekto
&ldquo;projekto_aplankas/protected&rdquo; aplank&#261;. Paleisti</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%">yiic.bat
komisiniaitests</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><br/>

</p>
<h2 class="western" align="justify"><b>Pagrindin&#279;s&nbsp;projekto
klas&#279;s</b></h2>
<p align="justify"><br/>
<br/>

</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i><b>protected/models/Komisiniai.php</b></i>
&ndash; Komisiniai - visos verslo logikos modelis/klas&#279;. &#268;ia
yra sura&scaron;yti visi metodai, skai&#269;iuojantys komisinius. &Scaron;io
modelio laukuose u&#382;duodami&nbsp;valiut&#371; kursai, bei kita
statin&#279; informacija, kurios reikia komisini&#371; skai&#269;iavimui.</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%">Laikmena
su mok&#279;jim&#371; istorija (*.csv) u&#382;kraunama &#303;
Komisiniai modelio <i><b>csv_buffer</b></i> lauk&#261;, kuris yra
visos &scaron;ios laikmenos buferis. U&#382;krovimo metu laikmena
ver&#269;iama masyvu, i&scaron;skleid&#382;iant eilutes pagal <i><b>csv</b></i>
dokument&#371; &ldquo;parsinimo&rdquo; taisykles. Skai&#269;iuojant
komisin&#303;, &scaron;is buferis perrenkamas po vien&#261; &#303;ra&scaron;&#261;
nuo seniausio iki naujausio.&nbsp;Lygiagre&#269;iai perrenkami &#303;ra&scaron;ai
dedami &#303; kit&#261; Komisiniai modelio lauk&#261;/bufer&#303; &ndash;
<i><b>week_buffer</b></i>. &Scaron;is <i><b>week_buffer</b></i>
masyvas reguliariai valomas, kad jame b&#363;tu tik einamos savait&#279;s
&#303;ra&scaron;ai. &Scaron;is buferis reikalingas komiso skai&#269;iavimo
operacijoms,&nbsp;kurioms reikalinga mok&#279;jim&#371; istorija per
einam&#261;j&#261; savait&#281;.</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%">Suskai&#269;iuoti
komisai dedami atgal &#303; <i><b>csv_buffer</b></i> bufer&#303;/masyv&#261;.
Tokiu b&#363;du po vis&#371; &#303;ra&scaron;&#371; perrinkimo
<i><b>csv_buffer</b></i> masyve bus pradiniai&nbsp;mok&#279;jimo
operacij&#371; duomenys ir suskai&#269;iuotasis komisinis kiekvienai
operacijai. Po vis&#371; komis&#371; skai&#269;iavimo iteracij&#371;
<i><b>csv_buffer</b></i> strukt&#363;ra atrodys taip:</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i>array(eil&#279;s
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
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i>suskai&#269;iuotasis
komisas</i></p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i>))</i></p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><br/>

</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i><b>protected/tests/TestKomisiniai.php
</b></i>&ndash; TestKomisiniai test&#371; klas&#279;. Klas&#279;je
yra testai, tikrinantys, ar teisingai skai&#269;iuoja Komisiniai
modelio metodai. Metod&#371; rezultatai lyginami su rankiniu b&#363;du
suskai&#269;iuotaisiais duomenimis. Jei bus pakeisti modelio laukai,
pvz valiut&#371; kursai, ranka suskai&#269;iuotus kontrolinius
duomenys reik&#279;s perskai&#269;iuoti.</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><br/>

</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i><b>/protected/commands/KomisiniaiSkaiciuotiCommand.php</b></i>
&ndash; komiso skai&#269;iavimo konsol&#279;s klas&#279;. Klas&#279;
naudoja Komisiniai modelio metodus, paleid&#382;ia komisini&#371;
skai&#269;iavimus, kaip argument&#261; naudodama nuorod&#261; &#303;
*.csv laikmen&#261;, i&scaron;veda skai&#269;iavimo rezultatus &#303;
<i><b>stdout</b></i>.</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><br/>

</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><i><b>/protected/commands/KomisiniaiTestsCommand.php</b></i>
&ndash; test&#371; paleidim&#371; konsol&#279;s klas&#279;. Klas&#279;
paleid&#382;ia TestKomisiniai test&#371; klas&#279;s metodus, kurie
testuoja komisini&#371; skai&#269;iavim&#261;. Test&#371; rezultatai
i&scaron;vedami &#303; stdout.</p>
<p align="justify" style="margin-bottom: 0in; line-height: 150%"><br/>

</p>
</body>
</html>
