<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

function bacaHTML($url){
     // inisialisasi CURL
     $data = curl_init();
     // setting CURL
     curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($data, CURLOPT_URL, $url);
     // menjalankan CURL untuk membaca isi file
     $hasil = curl_exec($data);
     curl_close($data);
     return $hasil;
}

$kodeHTML =  bacaHTML('http://www.syariahmandiri.co.id/en');
$pecah = explode('<table width="225" border="0" cellspacing="0" cellpadding="2" bgcolor="#fff">', $kodeHTML);

$pecahLagi = explode('<div id="btm-footer">', $pecah[1]);

$pecahL = explode('<div class="btn-kurs">', $pecahLagi[0]); 

$doc = new DOMDocument;
libxml_use_internal_errors(true);
$doc->loadHTML($pecahL[0]);
libxml_clear_errors();
$items = $doc->getElementsByTagName('td');

 for ($i = 1; $i < $items->length; $i++) {
     $test1 = $items->item($i)->nodeValue;
		$test1 = str_replace(',', '.', $test1);
$json1 .= $test1;			
}		
$json2 = preg_replace('/[^a-zA-Z0-9\']/', '', $json1);
//echo $json2;
  $t1 = substr($json2, 0, 4);
$json3 = '{"hasil":[{';
/*
$json3 .= '"kurs"';
$json3 .= ':';
$json3 .= '"'.$t1.'"';
$json3 .= ',';
$t1 = substr($json2, 4, 4);
$json3 .= '"beli"';
$json3 .= ':';
$json3 .= '"'.$t1.'"';
$json3 .= ',';
$t1 = substr($json2, 8, 4);
$json3 .= '"jual"';
$json3 .= ':';
$json3 .= '"'.$t1.'"';
$json3 .= '},{'; 
*/
$json3 .= '"kurs"';
$t1 = substr($json2, 12, 3);
$json3 .= ':';
$json3 .= '"'.$t1.'"';
//$json3 .= '"baris1 kolom1"';
$json3 .= ',';
$json3 .= '"beli"';
$t1 = substr($json2, 15, 5);
$json3 .= ':';
$json3 .= '"'.$t1.'"';
//$json3 .= '"baris1 kolom2"';
$json3 .= ',';
$json3 .= '"jual"';
$json3 .= ':';
$t1 = substr($json2, 20, 5);
$json3 .= '"'.$t1.'"';
//$json3 .= '"baris1 kolom3"';
//$json3 .= '}]}';

$json3 .= '},{';
$json3 .= '"kurs"';
$json3 .= ':';
$t1 = substr($json2, 25, 3);
$json3 .= '"'.$t1.'"';
$json3 .= ',';
$json3 .= '"beli"';
$json3 .= ':';
$t1 = substr($json2, 28, 5);
$json3 .= '"'.$t1.'"';
$json3 .= ',';
$json3 .= '"jual"';
$json3 .= ':';
$t1 = substr($json2, 33, 5);
$json3 .= '"'.$t1.'"';
$json3 .= '},{';
$json3 .= '"kurs"';
$json3 .= ':';
$t1 = substr($json2, 38, 3);
$json3 .= '"'.$t1.'"';
$json3 .= ',';
$json3 .= '"beli"';
$json3 .= ':';
$t1 = substr($json2, 41, 4);
$json3 .= '"'.$t1.'"';
$json3 .= ',';
$json3 .= '"jual"';
$json3 .= ':';
$t1 = substr($json2, 45, 4);
$json3 .= '"'.$t1.'"';
$json3 .= '},{';
$json3 .= '"kurs"';
$json3 .= ':';
$t1 = substr($json2, 49, 3);
$json3 .= '"'.$t1.'"';
$json3 .= ',';
$json3 .= '"beli"';
$json3 .= ':';
$t1 = substr($json2, 52, 3);
$json3 .= '"'.$t1.'"';
$json3 .= ',';
$json3 .= '"jual"';
$json3 .= ':';
$t1 = substr($json2, 55, 3);
$json3 .= '"'.$t1.'"';
$json3 .= '},{';
$json3 .= '"kurs"';
$json3 .= ':';
$t1 = substr($json2, 58, 3);
$json3 .= '"'.$t1.'"';
$json3 .= ',';
$json3 .= '"beli"';
$json3 .= ':';
$t1 = substr($json2, 61, 5);
$json3 .= '"'.$t1.'"';
$json3 .= ',';
$json3 .= '"jual"';
$json3 .= ':';
$t1 = substr($json2, 66, 5);
$json3 .= '"'.$t1.'"';
$json3 .= '},{';
$json3 .= '"kurs"';
$json3 .= ':';
$t1 = substr($json2, 71, 3);
$json3 .= '"'.$t1.'"';
$json3 .= ',';
$json3 .= '"beli"';
$json3 .= ':';
$t1 = substr($json2, 74, 4);
$json3 .= '"'.$t1.'"';
$json3 .= ',';
$json3 .= '"jual"';
$json3 .= ':';
$t1 = substr($json2, 78, 4);
$json3 .= '"'.$t1.'"';
$json3 .= '}]}';

echo $json3; 

?>