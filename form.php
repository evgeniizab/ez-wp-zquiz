<?php

if (isset($_POST["quiz_input_na"]) && isset($_POST["quiz_input_te"]) ) {

	// Формируем массив для JSON ответа
    $result = array(
'quiz_input_na' => $_POST["quiz_input_na"],
'quiz_input_te' => $_POST["quiz_input_te"],

'quiz_input_em' => $_POST["quiz_input_em"],
'summa_dolga' => $_POST["summa_dolga"],
'summa_dohoda' => $_POST["summa_dohoda"],
'summa_deti' => $_POST["summa_deti"],
'summa_alimenti' => $_POST["summa_alimenti"],
'rod_zanatii' => $_POST["rod_zanatii"],
'region' => $_POST["region"],
'quiz_input_im_summa' => $_POST["quiz_input_im_summa"],
'quiz_input_imushestvo_z' => $_POST["quiz_input_imushestvo_z"],

'quiz_input_sdelki1' => $_POST["quiz_input_sdelki1"],
'quiz_input_sdelki2' => $_POST["quiz_input_sdelki2"],
'kolvo_sdelok' => $_POST["kolvo_sdelok"],
'quiz_input_sdelki_r' => $_POST["quiz_input_sdelki_r"],
'option5' => $_POST["option5"],
'option6' => $_POST["option6"],
'option7' => $_POST["option7"],
'quiz_input_kolbankov' => $_POST["quiz_input_kolbankov"],
'quiz_input_koldolshnikov' => $_POST["quiz_input_koldolshnikov"],
'quiz_input_kolkreditorov' => $_POST["quiz_input_kolkreditorov"],
'quiz_input_firms' => $_POST["quiz_input_firms"],
'quiz_input_kolfirms' => $_POST["quiz_input_kolfirms"],
'quiz_link' => $_POST["quiz_link"],
'utm_medium' => $_POST["utm_medium"],
'utm_source' => $_POST["utm_source"],
'utm_campaign' => $_POST["utm_campaign"],
'utm_term' => $_POST["utm_term"],
'utm_source' => $_POST["utm_source"],
'utm_content' => $_POST["utm_content"]);

    // Переводим массив в JSON
    echo json_encode($result);

    /////// Отправляем их на почт
$from = 'info@xxx';
$to = "xxxx";

$headers = "From: ".$from."\r\n";
$headers .= 'Cc: xxx' . "\r\n";
$headers .= "Content-type: text/html; charset=utf-8 \r\n";
$subject = "Заявка Квиз XXX";

$msg ="Имя : ".$result["quiz_input_na"]."<br>";
$msg .="Телефон : ".$result["quiz_input_te"]. "<br>";
$msg .="Почта : ".$result["quiz_input_em"]. "<br>";
$msg .="<br>------------------------------<br>";
$msg .="Сумма долга : ".$result["summa_dolga"]. "<br>";
$msg .="Размер дохода : ".$result["summa_dohoda"]. "<br>";
$msg .="<br>------------------------------<br>";
$msg .="Количество несовершеннолетних детей : ".$result["summa_deti"]. "<br>";
$msg .="Выплаты по алиментам, % от доход : ".$result["summa_alimenti"]. "<br>";
$msg .="Род занятий : ".$result["rod_zanatii"]. "<br>";
$msg .="Регион : ".$result["region"]. "<br>";
$msg .="Стоимость имущества, руб. : ".$result["quiz_input_im_summa"]. "<br>";
$msg .="Имущество в залоге? : ".$result["quiz_input_imushestvo_z"]. "<br>";

$msg .="Сделки за последние 12 месяцев? : ".$result["quiz_input_sdelki1"]. "<br>";
$msg .="Сделки от 1 года до 3 лет : ".$result["quiz_input_sdelki2"]. "<br>";
$msg .="Кол-во сделок? : ".$result["kolvo_sdelok"]. "<br>";
$msg .="Кому перешло имущество? : ".$result["quiz_input_sdelki_r"]. "<br>";
$msg .="Тип сделок : ".$result["option5"]. " ".$result["option6"]. " ".$result["option7"]. "<br>";

$msg .="Количество банков и микрофинансовых организаций, которым должны: ".$result["quiz_input_kolbankov"]. "<br>";
$msg .="Количество дебиторов, которые должны ему : ".$result["quiz_input_koldolshnikov"]. "<br>";
$msg .="Количество других кредиторов : ".$result["quiz_input_kolkreditorov"]. "<br>";
$msg .="Являетесь ли учредителем юрлица? : ".$result["quiz_input_firms"]. "<br>";
$msg .="Число юрлиц : ".$result["quiz_input_kolfirms"]. "<br>";
$msg .="Ваш статус : ".$result["quiz_input_status"]. "<br>";

$msg .="<br>------------------------------<br>";
$msg .="Страница: ".$result["quiz_link"]."<br>";
$msg .="IP Клиента: ".$_SERVER['REMOTE_ADDR']."<br>";

$msg .="Тип рекламы: ".$result["utm_medium"]."<br>";
$msg .="Аккаунт: ".$result["utm_source"]."<br>";
$msg .="Рекламная компания: ".$result["utm_campaign"]."<br>";
$msg .="Ключевое слово: ".$result["utm_term"]."<br>";
$msg .="Объявление: ".$result["utm_content"]."<br>";

echo '<div id="messagedialog4"><b>'.$name.'</b><br>Благодарим Вас за то, что оставили заявку на нашем сайте.<br /><br />
В ближайшее время мы позвоним Вам, чтобы подробно проконсультировать по интересующему Вас вопросу.
<br><br><img src="http://pozhex.ru/loyer/images/ok.png" width=120px />';

mail($to, $subject, $msg, $headers);

}



?>
