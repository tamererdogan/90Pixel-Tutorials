<?php

/**
 * 
 */

namespace App;

class Uye
{
	private $isim;
	private $soyisim;
	private $parola;
	private $ePosta;

	//Sınıf kurucusu
	function __construct($isim, $soyisim)
	{
		$this->setIsim($isim);
		$this->setSoyisim($soyisim);
		$this->parolaOlustur();
		$this->epostaOlustur();
	}

	public function setIsim($isim)
	{
		$this->isim = $isim;
	}

	public function setSoyisim($soyisim)
	{
		$this->soyisim = $soyisim;	
	}

	public function setParola($parola)
	{
		$this->parola = $parola;
	}

	public function setEposta($ePosta)
	{
		$this->ePosta = $ePosta;
	}

	public function getIsim()
	{
		return $this->isim;
	}

	public function getSoyisim()
	{
		return $this->soyisim;	
	}

	public function getParola()
	{
		return $this->parola;
	}

	public function getEposta()
	{
		return $this->ePosta;
	}

	//İsim ve Soyisim değişkenlerini baz alarak eposta
	//oluşturan fonksiyon
	public function epostaOlustur()
	{
		$isim = KarakterCevirici::turkceKarakterleriCevir($this->isim);
		$soyisim = KarakterCevirici::turkceKarakterleriCevir($this->soyisim);
		$this->setEposta(strtolower($isim).".".strtolower($soyisim)."@gmail.com");
	}

	//Eşsiz ve rastgele parola oluşturan fonksiyon
	public function parolaOlustur()
	{
		$sifre = md5(uniqid());
		$sifre = substr($sifre, 1, 8);
		$this->setParola($sifre);
	}	

	//Referans olarak aldığı tablo içerisine üye bilgilerini
	//kayıt eden fonksiyon
	public function exceleKayitEt($tablo, $indis)
	{
		$a = "A".$indis;
		$b = "B".$indis;
		$c = "C".$indis;
		$d = "D".$indis;

		$tablo->setCellValue($a, $this->getIsim());
		$tablo->setCellValue($b, $this->getSoyisim());
		$tablo->setCellValue($c, $this->getParola());
		$tablo->setCellValue($d, $this->getEposta());
	}
}

?>