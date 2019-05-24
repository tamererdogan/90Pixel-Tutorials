<?php 
	require "vendor/autoload.php";
	require "Uye.php";

	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

	$girdiSayisi = 10; //Kullanıcıdan alınacak isim, soyisim sayısı
	$kullaniciSayisi = 20; //Oluşturulacak kullanıcı profili

	$isimler 	= array();
	$soyisimler = array();
	$uyeler 	= array();

	$tablo 		= new Spreadsheet();
	$taslak		= $tablo->getActiveSheet();

	for ($i=0; $i < $girdiSayisi; $i++)
	{ 
		echo "Lütfen isim giriniz:";
		$isimler[$i] = Seld\CliPrompt\CliPrompt::prompt();		 
	}

	for ($j=0; $j < $girdiSayisi; $j++)
	{ 
		echo "Lütfen soyisim giriniz:";
		$soyisimler[$j] = Seld\CliPrompt\CliPrompt::prompt();		 
	}	


	while (count($uyeler) < $kullaniciSayisi)
	{
		$uye = array(
			"isimIndis" => rand(0, $girdiSayisi-1),
			"soyisimIndis" => rand(0, $girdiSayisi-1)
		);

		//Eğer oluşturulan üye, önceki üyelerle aynı değilse
		if (array_search($uye, $uyeler) === FALSE)
		{
			//Diziye ekle
			array_push($uyeler, $uye);
		}
	}

	$indis = 1;
	foreach ($uyeler as $secilenUye)
	{	
		$isim = $isimler[$secilenUye["isimIndis"]];
		$soyisim = $soyisimler[$secilenUye["soyisimIndis"]];
		$uye = new Uye($isim, $soyisim);
		$uye->exceleKayitEt($taslak, $indis);
		$indis++;
	}

	$dosyaYazicisi = new Xlsx($tablo);
	$dosyaYazicisi->save('üyeler.xlsx');
	
?>