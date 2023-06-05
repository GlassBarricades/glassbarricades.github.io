<?php
$product[0] = "11528";	//Пицца
$product[1] = "05010";	//Добавка к пицце - сыр
$product[2] = "05010";	//Добавка к пицце - бекон
$product[3] = "0202020299";	//Сок
 
//количество товаров
$product_kol[0] = "1";
$product_kol[1] = "1";
$product_kol[2] = "1";
$product_kol[3] = "1";
 
//модификаторы, если есть 
$product_mod[1] = "0";  //товар с ключом 1 является модификатором товара с ключом 0
$product_mod[2] = "0";  //товар с ключом 2 является модификатором товара с ключом 0
           	 
//детали заказа в кодировке utf-8
$param['secret'] = "dR8itATaDfrtYr4tdrSaTyTTtyGtDatGRrT8RB9eHnBsErNHFsHkQr78NDrbDKKf3seETdKss9KYnitTE47ef4bTstZY5z4TR7kz9ZRrZnaaAtT5iR9sFa92yZGnfz8Zshhs72HSaHTB5BsberyKstAQe64ks38H8e466AN67ty3YN435kBiG22NTR29EZHD4AyYZ7RSr9G9NA2FKnReaDSYeFTKrrafQz5BtGfHGQGhayQNHsSKTAy35b";				//ключ api
$param['street']  = urlencode("Мира");		//улица
$param['home']	= "17"; 				//дом
$param['apart']	= "6";	 			//квартира
$param['phone'] = "79000000001";		//телефон
$param['descr']	= urlencode("Быстрее!"); 	//комментарий
$param['name']	= urlencode("Иван"); 		//имя клиента
$tags = array(1,5);				//отметки заказа - необязательно
$hook_status = array(3,4);			//запрос вебхука - необязательно

//подготовка запроса				
foreach ($param as $key => $value) { 
$data .= "&".$key."=".$value;
}

if($tags) {
foreach ($tags as $key => $value){
		$data .= "&tags[".$key."]=".$value."";
}
}

if($hook_status) {
foreach ($hook_status as $key => $value){
		$data .= "&hook_status[".$key."]=".$value."";
}
}
 
//содержимое заказа
foreach ($product as $key => $value){ 
$data .= "&product[".$key."]=".$value."";
$data .= "&product_kol[".$key."]=".$product_kol[$key].""; 
if(isset($product_mod[$key])) { 
$data .= "&product_mod[".$key."]=".$product_mod[$key].""; 
} 
} 

//отправка
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://app.frontpad.ru/api/index.php?new_order");
curl_setopt($ch, CURLOPT_FAILONERROR, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$result = curl_exec($ch);
curl_close($ch);
 
//результат
echo $result;

?>
