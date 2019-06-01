<?php

/**
 * Türkçe karakterleri ingilizce karşılığına çeviren sınıf
 */
class KarakterCevirici
{
	public static function turkceKarakterleriCevir($metin)
	{
		$metin = trim($metin);
		$arananKarakter = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ');
		$degistirilecekKarakter = array('c','c','g','g','i','i','o','o','s','s','u','u','-');
		$sonuc = str_replace($arananKarakter,$degistirilecekKarakter,$metin);
		return $sonuc;
	}
}

?>