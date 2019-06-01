<?php 
	
//Üyeyi autoload'a ekle
require "Uye.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class App
{
	private $girdiSayisi;
	private $kullaniciSayisi;

	private $isimler;
	private $soyisimler;
	private $uyeler;

	private $tablo;
	private $taslak;
	
	function __construct($girdiSayisi, $kullaniciSayisi)
	{
		$this->girdiSayisi 		= $girdiSayisi; //Kullanıcıdan alınacak isim, soyisim sayısı
		$this->kullaniciSayisi 	= $kullaniciSayisi; //Oluşturulacak kullanıcı profili
		$this->isimler 			= array();
		$this->soyisimler 		= array();
		$this->uyeler 			= array();
		$this->tablo 			= new Spreadsheet();
		$this->taslak			= $this->tablo->getActiveSheet();	
	}

	public function kullanicidanIsimAl()
	{
		for ($i=0; $i < $this->girdiSayisi; $i++)
		{ 
			echo "Lütfen isim giriniz:";
			$this->isimler[$i] = readline(); 
		}		
	}

	public function kullanicidanSoyisimAl()
	{
		for ($i=0; $i < $this->girdiSayisi; $i++)
		{ 
			echo "Lütfen soyisim giriniz:";
			$this->soyisimler[$i] = readline();	 
		}	
	}

	public function uyeleriOlustur()
	{
		while (count($this->uyeler) < $this->kullaniciSayisi)
		{
			$uye = array(
				"isimIndis" => rand(0, $this->girdiSayisi-1),
				"soyisimIndis" => rand(0, $this->girdiSayisi-1)
			);

			//Eğer oluşturulan üye, önceki üyelerle aynı değilse
			if (array_search($uye, $this->uyeler) === FALSE)
			{
				//Diziye ekle
				array_push($this->uyeler, $uye);
			}
		}
	}

	public function uyeleriTaslagaKayitEt()
	{
		$indis = 1;
		foreach ($this->uyeler as $secilenUye)
		{	
			$isim = $this->isimler[$secilenUye["isimIndis"]];
			$soyisim = $this->soyisimler[$secilenUye["soyisimIndis"]];
			$uye = new Uye($isim, $soyisim);
			$uye->exceleKayitEt($this->taslak, $indis);
			$indis++;
		}
	}

	public function taslagiDosyayaKayitEt()
	{
		$dosyaYazicisi = new Xlsx($this->tablo);
		$dosyaYazicisi->save('üyeler.xlsx');
	}

	public function baslat()
	{
		$this->kullanicidanIsimAl();
		$this->kullanicidanSoyisimAl();
		$this->uyeleriOlustur();
		$this->uyeleriTaslagaKayitEt();
		$this->taslagiDosyayaKayitEt();
	}

}
	
?>