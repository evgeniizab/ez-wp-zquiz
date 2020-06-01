<?php
/*
* Plugin Name: WP ZQUIZ
* Plugin URI: https://zabairachnyi.com
* Description: Квиз [zquiz] или [zquiz v="1"] для всплывающих окон
* Version: 0.0.1
* Author: Evgenii Z
* Author URI: https://zabairachnyi.com
* License: GPLv2 or later
*/
add_action('wp_print_scripts', 'zquiz_register_scripts');
add_action('wp_print_styles', 'zquiz_register_styles');
function zquiz_register_scripts() {
  wp_register_script('js.wp.quiz', plugins_url('script.js', __FILE__));
  wp_enqueue_script('jquery');
  wp_enqueue_script('js.wp.quiz');
}
function zquiz_register_styles() {
  wp_register_style('wp.quiz', plugins_url('style.css', __FILE__));
  wp_enqueue_style('wp.quiz');

}
add_shortcode( 'zquiz', 'quizStart' );
function quizStart($atts){
extract(shortcode_atts(array('v' => '',), $atts));
if ($v == '1') {$version = 'di_version_1';$razmer_block1='md-12';$razmer_block2='md-12';$nav='text-center';}else{$version='di_version_0';$razmer_block1='md-6';$razmer_block2='md-6';}

$out ='

<div id="diface_quiz" class="">

<div class="di_quiz '.$version.'" id="di_quiz">
<div class="quiz_block__nav '.$nav.'"><span class="nav__text">Вопрос <span id="quiz_count">1</span> из 5</span>
	<a class="btn_quiz quiz_visible btn_quiz__active" data-slide="1">Ваши долги</a>
	<a class="btn_quiz" data-slide="2">Ваши доходы</a>
	<a class="btn_quiz" data-slide="3">Ваше имущество</a>
	<a class="btn_quiz" data-slide="4">Ваши сделки</a>
	<a class="btn_quiz" data-slide="5">Ваша ситуация</a>
	<a class="btn_quiz" data-slide="6">Итог</a>
</div>


<div id="quiz_1" class="quiz_block quiz_active">
<div class="row">
<div class="col-'.$razmer_block1.'">
	<div class="quiz_block__ques">

<form id="quiz_form" class="" method="post" action="javascript:void(0);" onsubmit="sendAjaxForm(`result_form`, `quiz_form`, `form.php`);">


<p class="quiz_bold">Сумма Ваших долгов, руб.</p>

<input id="first_sum" type="text" class="quiz_di" name="summa_dolga" value="500000" maxlength="12"><br>
<div class="quiz_ran" style="float:left;" content="telephone=no">100 000</div><div style="float:right;" class="quiz_ran" content="telephone=no">10 000 000</div>
<input type="range" class="quiz_range" list="tickmarks" id="dog_price" name="price" value="500000" min="100000" max="10000000" step="50000">
<p class="quiz_dop">В этом поле укажите текущую сумму долгов (без учета пеней  и процентов за будущий период)</p>

		</div>
</div>
<div class=" col-'.$razmer_block2.'">
	<div class="quiz_block__desc">


	<p class="quiz_bold">Укажите текущую сумму Ваших долгов в рублях:</p>
<p>• долги по кредитам и кредитным картам,<br>
• займы в микрофинансовых организациях,<br>
• займы по распискам у физических лиц,<br>
• долги по коммунальным услугам,<br>
• задолженность по налогам, штрафам, пеням,<br>
• долги по договорам поставки, подряда и т.д.,<br>
• любые другие долги.<br><br>

<p class="quiz_bold">За исключением:</p>
<p>• алиментов,<br>
• долгов за причинение вреда здоровью,<br>
• долгов за причинение морального вреда,<br>
• долгов, связанных с преступными действиями.<br>
</p>
</div>
</div>
</div>

<div id="quiz_ansfer" class="quiz_block__ansfer"></div>
<div class="text-center" id="btn_slide_1"><a class="sr-btn sr-btn-bg-color-2 sr-glass btn_quiz" data-slide="2">Далее</a></div>

</div>

<!-- slide 2-->

<div id="quiz_2" class="quiz_block">
<div class="row">
<div class="col-'.$razmer_block1.'">
<div class="quiz_block__ques">


<p class="quiz_bold">Размер Вашего дохода, руб.<p>
<input id="quiz_input_dohod" class="quiz_di" type="text" name="summa_dohoda" value="100000" maxlength="12"><br>
<p class="quiz_bold">Количество несовершеннолетних детей на иждивении:<p>
<input id="quiz_input_deti" class="quiz_di" type="text" name="summa_deti" value="1" maxlength="2"><br>

<p class="quiz_bold">Выплаты по алиментам, % от дохода:<p>
<input id="quiz_input_alim" type="text" class="quiz_di" name="summa_alimenti" value="0" maxlength="3"><br>
<p class="quiz_bold">Род занятий:<p>
	<div class="control-group">
		<label class="control control-radio">Работаю<input type="radio" class="quiz_radio" id="color1" name="rod_zanatii" checked value="Работаю"><div class="control_indicator"></div></label>
 		<label class="control control-radio">Пенсионер<input type="radio" class="quiz_radio" id="color2" name="rod_zanatii" value="Пенсионер"><div class="control_indicator"></div></label>
		<label class="control control-radio">Безработный<input type="radio" class="quiz_radio" id="color3" name="rod_zanatii" value="Безработный"><div class="control_indicator"></div></label>
	</div><div style="clear:both;"></div>
<p class="quiz_bold">Регион:</p>
<!-- по состоянию на 18 мая 2020 года, рублей в месяц) https://www.gks.ru/vpm  -->
<select id="quiz_input_region" class="quiz_di" name="region">
<!--  <option value="" hidden disabled selected>Выбрать</option>-->
<option value="г. Москва" data-st="19233" data-pe="11952" data-de="14440">г. Москва</option>
<option value="г. Санкт-Петербург" data-st="12622" data-pe="9332" data-de="11210">г. Санкт-Петербург</option>
<option value="Республика Адыгея" data-st="9955" data-pe="8354" data-de="9568">Республика Адыгея</option>
<option value="Республика Алтай" data-st="10380" data-pe="7669" data-de="10094">Республика Алтай</option>
<option value="Республика Башкортостан" data-st="9816" data-pe="7530" data-de="9200">Республика Башкортостан </option>
<option value="Республика Бурятия" data-st="11726" data-pe="8931" data-de="11745">Республика Бурятия </option>
<option value="Республика Дагестан " data-st="10058" data-pe="7720" data-de="9890">Республика Дагестан </option>
<option value="Республика Ингушетия " data-st="10534" data-pe="7848" data-de="10375">Республика Ингушетия </option>
<option value="Кабардино-Балкарская Республика" data-st="11330" data-pe="8551" data-de="11472">Кабардино-Балкарская Республика</option>
<option value="Республика Калмыкия " data-st="10383" data-pe="7972" data-de="10114">Республика Калмыкия </option>
<option value="Карачаево-Черкесская Республика" data-st="10203" data-pe="7806" data-de="9824">Карачаево-Черкесская Республика</option>
<option value="Республика Карелия" data-st="14495" data-pe="11179" data-de="12436">Республика Карелия </option>
<option value="Республика Коми " data-st="14868" data-pe="11366" data-de="13691">Республика Коми </option>
<option value="Республика Крым " data-st="11102" data-pe="8522" data-de="8522">Республика Крым </option>
<option value="Республика Марий Эл " data-st="10081" data-pe="7742" data-de="9779">Республика Марий Эл </option>
<option value="Республика Мордовия " data-st="9914" data-pe="7592" data-de="10375">Республика Мордовия </option>
<option value="Республика Саха (Якутия)" data-st="18327" data-pe="13888" data-de="17950">Республика Саха (Якутия) </option>
<option value="Республика Северная Осетия - Алания " data-st="9794" data-pe="7468" data-de="9371">Республика Северная Осетия - Алания </option>
<option value="Республика Татарстан" data-st="9841" data-pe="7546" data-de="9333">Республика Татарстан</option>
<option value="Республика Тыва" data-st="10694" data-pe="8218" data-de="10947">Республика Тыва </option>
<option value="Удмуртская Республика" data-st="10029" data-pe="7687" data-de="9481">Удмуртская Республика </option>
<option value="Республика Хакасия" data-st="11397" data-pe="8684" data-de="11387">Республика Хакасия </option>
<option value="Чеченская Республика" data-st="11430" data-pe="9097" data-de="10957">Чеченская Республика</option>
<option value="Чувашская Республика" data-st="9875" data-pe="7576" data-de="9254">Чувашская Республика</option>
<option value="Алтайский край" data-st="10365" data-pe="8392" data-de="9773">Алтайский край</option>
<option value="Забайкальский край" data-st="12828" data-pe="9744" data-de="13000">Забайкальский край</option>
<option value="Камчатский край" data-st="21796" data-pe="16478" data-de="22326">Камчатский край</option>
<option value="Краснодарский край" data-st="11507" data-pe="8816" data-de="10072">Краснодарский край</option>
<option value="Красноярский край" data-st="13321" data-pe="9843" data-de="13170">Красноярский край</option>
<option value="Пермский край" data-st="11338" data-pe="8703" data-de="10703">Пермский край</option>
<option value="Приморский край" data-st="14422" data-pe="10984" data-de="15003">Приморский край</option>
<option value="Ставропольский край" data-st="10058" data-pe="7682" data-de="9779">Ставропольский край</option>
<option value="Хабаровский край" data-st="15328" data-pe="11622" data-de="15248">Хабаровский край</option>
<option value="Амурская область" data-st="13161" data-pe="10059" data-de="12877">Амурская область </option>
<option value="Архангельская область" data-st="13873" data-pe="10590" data-de="12524">Архангельская область</option>
<option value="Астраханская область" data-st="10776" data-pe="8611" data-de="11011">Астраханская область </option>
<option value="Белгородская область" data-st="9971" data-pe="7664" data-de="9126">Белгородская область</option>
<option value="Брянская область" data-st="11305" data-pe="8751" data-de="10334">Брянская область </option>
<option value="Владимирская область" data-st="11205" data-pe="8657" data-de="10380">Владимирская область </option>
<option value="Волгоградская область" data-st="10026" data-pe="7613" data-de="9310">Волгоградская область </option>
<option value="Вологодская область" data-st="11659" data-pe="8910" data-de="10490">Вологодская область </option>
<option value="Воронежская область" data-st="9689" data-pe="7513" data-de="8697">Воронежская область </option>
<option value="Ивановская область" data-st="11012" data-pe="8477" data-de="10140">Ивановская область </option>
<option value="Иркутская область" data-st="12098" data-pe="9209" data-de="11756">Иркутская область </option>
<option value="Калининградская область" data-st="12259" data-pe="9361" data-de="10788">Калининградская область</option>
<option value="Калужская область" data-st="11393" data-pe="8795" data-de="8795">Калужская область </option>
<option value="Кемеровская область" data-st="10356" data-pe="7913" data-de="10088">Кемеровская область </option>
<option value="Кировская область" data-st="11054" data-pe="8453" data-de="10461">Кировская область </option>
<option value="Костромская область" data-st="11277" data-pe="8679" data-de="10234">Костромская область </option>
<option value="Курганская область" data-st="10466" data-pe="8148" data-de="10200">Курганская область </option>
<option value="Курская область" data-st="10156" data-pe="7890" data-de="9355">Курская область </option>
<option value="Ленинградская область" data-st="11944" data-pe="9397" data-de="10600">Ленинградская область </option>
<option value="Липецкая область" data-st="9914" data-pe="7710" data-de="9308">Липецкая область </option>
<option value="Магаданская область" data-st="21162" data-pe="15871" data-de="21157">Магаданская область</option>
<option value="Московская область" data-st="13598" data-pe="9240" data-de="11887">Московская область </option>
<option value="Мурманская область" data-st="17379" data-pe="13869" data-de="16670">Мурманская область </option>
<option value="Нижегородская область" data-st="10450" data-pe="8037" data-de="9800">Нижегородская область </option>
<option value="Новгородская область" data-st="11842" data-pe="9055" data-de="10761">Новгородская область </option>
<option value="Новосибирская область" data-st="12158" data-pe="9196" data-de="11874">Новосибирская область </option>
<option value="Омская область" data-st="10439" data-pe="7957" data-de="10143">Омская область</option>
<option value="Оренбургская область" data-st="9608" data-pe="7473" data-de="9214">Оренбургская область </option>
<option value="Орловская область" data-st="10788" data-pe="8371" data-de="10108">Орловская область </option>
<option value="Пензенская область" data-st="9953" data-pe="7629" data-de="9420">Пензенская область </option>
<option value="Псковская область" data-st="11772" data-pe="8964" data-de="10680">Псковская область </option>
<option value="Ростовская область" data-st="10699" data-pe="8146" data-de="10402">Ростовская область </option>
<option value="Рязанская область" data-st="10710" data-pe="8250" data-de="9875">Рязанская область </option>
<option value="Самарская область" data-st="11421" data-pe="8246" data-de="10285">Самарская область </option>
<option value="Саратовская область" data-st="9849" data-pe="7565" data-de="9451">Саратовская область </option>
<option value="Сахалинская область" data-st="15854" data-pe="11921" data-de="16256">Сахалинская область </option>
<option value="Свердловская область" data-st="11053" data-pe="8486" data-de="11030">Свердловская область </option>
<option value="г. Севастополь" data-st="11483" data-pe="8820" data-de="11349">г. Севастополь </option>
<option value="Смоленская область" data-st="11179" data-pe="8647" data-de="10154">Смоленская область </option>
<option value="Тамбовская область" data-st="10650" data-pe="8478" data-de="9748">Тамбовская область </option>
<option value="Тверская область" data-st="11234" data-pe="8633" data-de="10827">Тверская область </option>
<option value="Томская область" data-st="12234" data-pe="9310" data-de="12115">Томская область </option>
<option value="Тульская область" data-st="11100" data-pe="8840" data-de="10066">Тульская область</option>
<option value="Тюменская область" data-st="11798" data-pe="9011" data-de="11511">Тюменская область </option>
<option value="Ульяновская область" data-st="10351" data-pe="7931" data-de="9723">Ульяновская область </option>
<option value="Челябинская область" data-st="11183" data-pe="8661" data-de="10849">Челябинская область </option>
<option value="Ярославская область" data-st="11082" data-pe="8228" data-de="10184">Ярославская область</option>
<option value="Еврейская АО" data-st="15831" data-pe="12074" data-de="15538">Еврейская АО</option>
<option value="Ненецкий АО" data-st="22572" data-pe="17464" data-de="22119">Ненецкий АО</option>
<option value="Ханты-Мансийский АО" data-st="16472" data-pe="12500" data-de="15343">Ханты-Мансийский АО</option>
<option value="Чукотский АО" data-st="22982" data-pe="17233" data-de="23142">Чукотский АО</option>
<option value="Ямало-Ненецкий АО" data-st="16636" data-pe="12526" data-de="15887">Ямало-Ненецкий АО</option>
</select>
</div>


</div>
<div class=" col-'.$razmer_block2.'">
<div class="quiz_block__desc">


<p class="quiz_bold">Важно:</p>
<p>• Укажите официальный ежемесячный доход в рублях.<br><br>
• Наличие дохода не влияет на вероятность признания Вас банкротом. Определяющий фактор — соотношение размера дохода и суммы долгов.<br><br>
• Суд не может заставить Вас расплачиваться по долгам из той суммы, что является неприкосновенным прожиточным минимумом на Вас и находящихся на Вашем иждивении несовершеннолетних детей. В том числе из той суммы, что приходится на выплату алиментов.<br><br>
• Указание рода Ваших занятий и региона необходимо для определения неприкосновенного минимума.<br>
</p>
</div>
</div>

</div>
<div id="quiz_ansfer_2" class="quiz_block__ansfer"></div>
<div class="text-center" id="btn_slide_2" ><a class="sr-btn sr-btn-bg-color-2 sr-glass btn_quiz" data-slide="3">Далее</a></div>

</div>

<!-- slide 3 -->
<div id="quiz_3" class="quiz_block">
<div class="row">
<div class="col-'.$razmer_block1.'">
<div class="quiz_block__ques">


<p class="quiz_bold">Стоимость имущества, руб.</p>

<input id="quiz_input_im_summa" class="quiz_di" type="text" name="quiz_input_im_summa" value="200000" maxlength="12"><br>
<div style="float:left;" class="quiz_ran" content="telephone=no">100 000</div><div style="float:right;" class="quiz_ran" content="telephone=no">10 000 000</div>
<input type="range" class="quiz_range" list="tickmarks" id="quiz_input_im_range" name="quiz_input_im_range" value="500000" min="100000" max="10000000" step="50000">
<p class="quiz_bold">Есть ли у Вас имущество в залоге?</p>
<div class="control-group">
	<label class="control control-radio">Да<input type="radio" class="quiz_radio2" id="quiz_input_imushestvo1" name="quiz_input_imushestvo_z" value="Да"><div class="control_indicator"></div></label>
	<label class="control control-radio">Нет<input type="radio" class="quiz_radio2" id="quiz_input_imushestvo2" name="quiz_input_imushestvo_z" checked value="Нет"><div class="control_indicator"></div></label>
</div><div style="clear:both;"></div>

	</div>
</div>
<div class=" col-'.$razmer_block2.'">
<div class="quiz_block__desc">


<p class="quiz_bold">Укажите примерную рыночную стоимость всего принадлежащего Вам имущества:</p>
<p>• недвижимость (квартиры, дома, участки),<br>
• транспортные средства,<br>
• акции и доли в уставном капитале,<br>
• предметы роскоши (золото, бриллианты, предметы искусства и т.д.).
</p>
<p class="quiz_bold">За исключением:</p>
<p>
• недвижимости, в которой Вы проживаете (если она не в ипотеке),<br>
• предметов домашнего обихода.<br>
</p>
</div>
</div>
</div>


<div id="quiz_ansfer_3" class="quiz_block__ansfer"></div>
<div class="text-center" id="btn_slide_3"><a class="sr-btn sr-btn-bg-color-2 sr-glass btn_quiz" data-slide="4">Далее</a></div>

</div>



<!-- slide 3 -->
<div id="quiz_4" class="quiz_block">
<div class="row">
<div class="col-'.$razmer_block1.'">
<div class="quiz_block__ques">


<p class="quiz_bold">Совершали ли Вы сделки с имуществом за последние 12 месяцев?</p>
<div class="control-group">
	<label class="control control-radio">Да<input type="radio" class="quiz_radio2 checkbox" id="quiz_input_sdelki1" name="quiz_input_sdelki1" value="Да"><div class="control_indicator"></div></label>
	<label class="control control-radio">Нет<input type="radio" class="quiz_radio2 checkbox" id="quiz_input_sdelki2" name="quiz_input_sdelki1" checked value="Нет"><div class="control_indicator"></div></label>
</div><div style="clear:both;"></div>
<p class="quiz_bold">А за период от 1 года до 3 лет?</p>
<div class="control-group">
	<label class="control control-radio">Да<input type="radio" class="quiz_radio2 checkbox" id="quiz_input_sdelki3" name="quiz_input_sdelki2" value="Да"><div class="control_indicator"></div></label>
	<label class="control control-radio">Нет<input type="radio" class="quiz_radio2 checkbox" id="quiz_input_sdelki4" name="quiz_input_sdelki2" checked value="Нет"><div class="control_indicator"></div></label>
</div><div style="clear:both;"></div>
<div id="quiz_slide3_block">
<p class="quiz_bold">Сколько было сделок?
<select class="quiz_di" name="kolvo_sdelok">
<option value="0" style="display:none;">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5 и более</option>
</select></p>
<p class="quiz_bold">Кому перешло Ваше имущество?</p>
<div class="control-group">
	<label class="control control-radio">Родственникам<input type="radio" class="quiz_radio2" id="quiz_input_sdelki_r" name="quiz_input_sdelki_r" value="Родственникам"><div class="control_indicator"></div></label>
	<label class="control control-radio">Третьим лицам<input type="radio" class="quiz_radio2" id="quiz_input_sdelki1_3" name="quiz_input_sdelki_r" value="Третьим лицам"><div class="control_indicator"></div></label>
</div><div style="clear:both;"></div>
<p class="quiz_bold">Тип сделок:</p>
<div class="control-group">
	<label class="control control-radio">Купля-продажа<input type="checkbox" name="option5" value="Купля-продажа"><div class="control_indicator"></div></label>
	<label class="control control-radio">Дарение<input type="checkbox" name="option6" value="Дарение"><div class="control_indicator"></div></label>
		<label class="control control-radio">Иное<input type="checkbox" name="option7" value="Иное"><div class="control_indicator"></div></label>
</div><div style="clear:both;"></div>

</div>
	</div>
</div>
<div class=" col-'.$razmer_block2.'">
<div class="quiz_block__desc">


<p class="quiz_bold">Укажите примерную рыночную стоимость всего принадлежащего Вам имущества:</p>
<p>• недвижимость (квартиры, дома, участки),<br>
• транспортные средства,<br>
• акции и доли в уставном капитале,<br>
• предметы роскоши (золото, бриллианты, предметы искусства и т.д.).
</p>
<p class="quiz_bold">За исключением:</p>
<p>
• недвижимости, в которой Вы проживаете (если она не в ипотеке),<br>
• предметов домашнего обихода.
</p>
</div>
</div>
</div>


<div id="quiz_ansfer_4" class="quiz_block__ansfer"></div>
<div class="text-center" id="btn_slide_4"><a class="sr-btn sr-btn-bg-color-2 sr-glass btn_quiz" data-slide="5">Далее</a></div>

</div>


<!-- slide 5 -->
<div id="quiz_5" class="quiz_block">
	<br>
<p class="quiz_bold">Поздравляем! У Вас есть возможность полностью освободиться от долгов в рамках процедуры банкротства.<br>Чтобы узнать более точную стоимость наших услуг в Вашей ситуации, ответьте ещё на несколько вопросов.</p>
<div class="quiz_block__ques">


<div class="row">
<div class="col-'.$razmer_block1.'">

		<p class="quiz_bold">Количество банков и микрофинансовых организаций, которым Вы должны:</p>
		<input id="quiz_input_im_summa2" class="quiz_di"  type="text" name="quiz_input_kolbankov" value="1" maxlength="3"><br>

	</div>

<div class=" col-'.$razmer_block1.'">

		<p class="quiz_bold">Количество дебиторов, <br>которые должны Вам:</p>
		<input id="quiz_input_im_summa3"  class="quiz_di"  type="text" name="quiz_input_koldolshnikov" value="0" maxlength="4"><br>

</div>
</div>

<div class="row">
<div class="col-'.$razmer_block1.'">

		<p class="quiz_bold">Количество других кредиторов (физические лица, налоговая и т.д.):</p>
		<input id="quiz_input_im_summa4" class="quiz_di"  type="text" name="quiz_input_kolkreditorov" value="0" maxlength="4"><br>

</div>

<div class="col-'.$razmer_block1.'">

		<p class="quiz_bold">Являетесь ли Вы учредителем юрлица?

			<div class="control-group">
				<label class="control control-radio">Да<input type="radio" class="quiz_radio5 checkbox" id="quiz_input_firms" name="quiz_input_firms" value="Да"><div class="control_indicator"></div></label>
				<label class="control control-radio">Нет<input type="radio" class="quiz_radio5 checkbox" id="quiz_input_firms2" name="quiz_input_firms" checked value="Нет"><div class="control_indicator"></div></label>

			</div><div style="clear:both;"></div>

		</p><div id="quiz_slide4_block">
			<p class="quiz_bold">Число юрлиц где Вы учредитель:</p>
			<input id="quiz_input_im_summa5" class="quiz_di" type="text" name="quiz_input_kolfirms" value="0" maxlength="4"><br>
		</div>

</div>
</div>
<div class="">
<p class="quiz_bold">Ваш статус:</p>

 <div class="control-group">
 	<label class="control control-radio">Физическое лицо<input type="radio" class="quiz_radio51 checkbox" id="quiz_input_status1" name="quiz_input_status" checked value="Физическое лицо"><div class="control_indicator"></div></label>
 	<label class="control control-radio">Индивидуальный предприниматель<input type="radio" class="quiz_radio52 checkbox" id="quiz_input_status2" name="quiz_input_status"  value="Индивидуальный предприниматель"><div class="control_indicator"></div></label>
 		<label class="control control-radio">Поручитель<input type="radio" class="quiz_radio53 checkbox" id="quiz_input_status3" name="quiz_input_status"  value="Поручитель"><div class="control_indicator"></div></label>
 </div><div style="clear:both;"></div>


</div>
</div>
<div id="quiz_ansfer_4" class="quiz_block__ansfer"></div>
<div class="text-center" id="btn_slide_5"><a class="sr-btn sr-btn-bg-color-2 sr-glass btn_quiz" data-slide="6">Далее</a></div>

</div>
<!-- Slide 6 -->
<div id="quiz_6" class="quiz_block">
<br>
<p class="quiz_bold text-center">
Оставьте заявку и мы отправим Вам на электронную почту полный расчёт стоимости наших услуг, а также чек лист и все необходимые документы.
</p>
<div class="text-center">



<br>
<input id="quiz_input_na" contenteditable type="text" class="quiz_te quiz_form quiz_input_na quiz_di_final" minlength="2" required name="quiz_input_na" placeholder="Ваше имя" maxlength="30"><br>
<input id="quiz_input_te" contenteditable class="qph quiz_form quiz_di_final" type="text" name="quiz_input_te" required placeholder="Телефон"><br>
<input id="quiz_input_em" contenteditable type="text" class="quiz_em quiz_form quiz_di_final" name="quiz_input_em" required placeholder="E-mail" maxlength="50"><br>
<input type="hidden" name="quiz_link" value="'.get_permalink().'">
<input type="hidden" name="utm_medium" value="'.$_GET['utm_medium'].'">
<input type="hidden" name="utm_source" value="'.$_GET['utm_source'].'">
<input type="hidden" name="utm_campaign" value="'.$_GET['utm_campaign'].'">
<input type="hidden" name="utm_term" value="'.$_GET['utm_term'].'">
<input type="hidden" name="utm_content" value="'.$_GET['utm_content'].'">
<br>

	</div>






<div id="quiz_ansfer_4" class="quiz_block__ansfer"></div>
<div class="text-center">
<button type="submit" id="quiz_send" class="sr-btn sr-btn-bg-color-2 sr-glass" disabled style="background:gray;">Узнать стоимость</button></div>
</form>

</div>

<div id="result_form"></div>

<!-- -->



<div class="text-center" id="btn_consult" class="quiz_cons" style="display:none;"><a href="#callbackxx"  class="sr-btn sr-btn-bg-color-2 sr-glass fancybox">Получить консультацию</a></div>
</div>

</div>';
return $out;
}
