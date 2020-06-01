
jQuery(document).ready(function(){

 jQuery(".qph").mask("+7 (999) 999-99-99");


// slide 1
var cval = jQuery('#first_sum').val();
if (cval == '') {jQuery('#first_sum').val('0');} else {get_sum(cval);}

  jQuery('#first_sum').keyup(function() {
      var cval = jQuery('#first_sum').val();
      if (cval == '') {cval=0;}
      jQuery('#dog_price').val(parseInt(cval));
      get_sum(cval);

    });

jQuery('#dog_price').change(function() {
var cval = jQuery('#dog_price').val();

jQuery('#first_sum').val(cval);
get_sum(cval);

});
function get_sum(cval) {
cval = parseInt(cval);
if ((cval >= 100001) & (cval <= 499999)) {
jQuery('#btn_slide_1').css('display','none');jQuery('#btn_consult').css('display','block');blockSlide(1);
jQuery('#quiz_ansfer').html('<p><span class="quiz_ansfer_w">!</span>Проведение процедуры банкротсва возможно, однако могут возникнуть сложности при принятии заявления к производству и при признании его обоснованным. Всё зависит от ситуации, поэтому мы рекомендуем Вам получить дополнительную консультацию у нашего специалиста.</p>');
}
else if (cval >= 500000) {jQuery('#btn_slide_1').css('display','block');jQuery('#btn_consult').css('display','none');jQuery('#quiz_ansfer').html('<p><span class="quiz_ansfer_w">!</span>Проведение процедуры банкротства возможно!</p>')}
else {jQuery('#btn_consult').css('display','none');jQuery('#btn_slide_1').css('display','none');jQuery('#quiz_ansfer').html('<p><span class="quiz_ansfer_w">!</span>Проведение процедуры банкротства не возможно</p>');blockSlide(1);}

}


//slide 2
jQuery('#quiz_input_dohod').keyup(function() {check();});
jQuery('#quiz_input_deti').keyup(function() {check();});
jQuery('#quiz_input_alim').keyup(function() {check();});
jQuery('#quiz_input_region').change(function() {check();});
jQuery('.quiz_radio').click(function() {check();});
function check() {
first_sum = parseInt(jQuery('#first_sum').val())
pm = parseInt(jQuery('#quiz_input_region').children('option:selected').data('st'));
pm_deti = parseInt(jQuery('#quiz_input_region').children('option:selected').data('de'));
pm_pensioner = parseInt(jQuery('#quiz_input_region').children('option:selected').data('pe'));

deti = parseInt(jQuery('#quiz_input_deti').val());
dohod = parseInt(jQuery('#quiz_input_dohod').val());
alim = parseInt(jQuery('#quiz_input_alim').val());

if ((jQuery('#color1').is(':checked')) || (jQuery('#color3').is(':checked'))) {
nm = pm + (deti * pm_deti) + ((dohod/100) * alim);
} else if (jQuery('#color2').is(':checked')) {
nm = pm_pensioner + (deti * pm_deti) + ((dohod/100) * alim);
}

result = (dohod - nm)/(parseInt(first_sum)/36);

if (result <= 0.8) {jQuery('#quiz_ansfer_2').html('<p><span class="quiz_ansfer_w">!</span>Вы вправе рассчитывать на освобождение от долгов в рамках процедуры банкротства. Однако существует вероятность, что суд введет техническую процедуру реструктуризации, поэтому мы рекомендуем доверить процедуру банкротства опытным юристам компании "ДолговНЕТ".</p>');jQuery('#btn_slide_2').css('display','block');jQuery('#btn_consult').css('display','none');}
else if ((result > 0.8) & (result <= 1)) {jQuery('#quiz_ansfer_2').html('<span class="quiz_ansfer_w">!</span>Ваша ситуация погранична: Вы не можете рассчитаться со всеми долгами за 3 года, однако Вы можете погасить существенную их часть. В подобных случаях суд может ввести процедуру реструктуризации и заставить частично выплатить долги. Для оценки возможности полного освобождения от долгов необходим более глубокий анализ ситуации и участие в деле опытных юристов.');jQuery('#btn_slide_2').css('display','block');jQuery('#btn_consult').css('display','none');}
else if (result > 1) {jQuery('#quiz_ansfer_2').html('<p><span class="quiz_ansfer_w">!</span>Ваших доходов хватает, чтобы полностью рассчитаться с долгами за 3 года. Согласно норм закона, суд введёт процедуру реструктуризации долгов. Для получения рекомендаций по минимизации выплат обратитесь за консультацией к нашим специалистам.!</p>');jQuery('#btn_slide_2').css('display','none');jQuery('#btn_consult').css('display','block');blockSlide(2);}

if ((dohod == 0) || jQuery('#color3').is(':checked')) {
jQuery('#quiz_ansfer_2').append('<p><span class="quiz_ansfer_w">!</span>При отсутствии официального дохода суд может запросить справку из центра занятости, либо попросить предоставить доказательства попыток трудоустройства.</p>');

}
console.log(result);
}

///slide 3


jQuery('#quiz_input_im_summa').keyup(function() {
  var cval2 = jQuery('#quiz_input_im_summa').val();
  jQuery('#quiz_input_im_range').val(parseInt(cval2));
  get_sum2(cval2);

});

jQuery('#quiz_input_im_range').change(function() {
var cval2 = jQuery('#quiz_input_im_range').val();
jQuery('#quiz_input_im_summa').val(parseInt(cval2));
get_sum2(cval2);
});

function get_sum2(cval2) {
cval2 = parseInt(cval2);
dolgi = jQuery('#first_sum').val();

if (cval2 >= parseInt(dolgi)) {
jQuery('#btn_slide_3').css('display','none');jQuery('#btn_consult').css('display','block');blockSlide(3);
jQuery('#quiz_ansfer_3').html('<p><span class="quiz_ansfer_w">!</span>Стоимость имущества, которое может быть реализовано, превышает сумму Ваших долгов. Суд может признать Ваше заявление на банкротство необоснованным.</p>');
}
else {jQuery('#btn_consult').css('display','none');jQuery('#btn_slide_3').css('display','block');
jQuery('#quiz_ansfer_3').html('');}
}



jQuery(".checkbox").change(function() {
if ((jQuery('#quiz_input_sdelki1').is(':checked')) || (jQuery('#quiz_input_sdelki3').is(':checked')) ) {
jQuery('#quiz_slide3_block').css('display','block');
jQuery('#quiz_ansfer_4').html('<p><span class="quiz_ansfer_w">!</span>Сделки по продаже, дарению и другим действиям с имуществом, совершенные за последние 3 года, могут быть оспорены (отменены). Перед началом процедуры банкротства рекомендуем провести анализ сделок на оспоримость.</p>');
} else {jQuery('#quiz_slide3_block').css('display','none');jQuery('#quiz_ansfer_4').html(''); }
});

// slide 4

//slide 5


jQuery(".quiz_radio5").change(function() {
if (jQuery('#quiz_input_firms').is(':checked'))  {
jQuery('#quiz_slide4_block').css('display','block');} else {jQuery('#quiz_slide4_block').css('display','none');}
});
// end slides
function blockSlide(blockid)
{
jQuery('.quiz_block__nav').children('.btn_quiz').each(function(i,elem) {
xpo = jQuery(elem).data('slide');
if (parseInt(xpo) > parseInt(blockid)) {jQuery(elem).removeClass('btn_quiz__active');jQuery(elem).removeClass('quiz_visible');jQuery(elem).hide();}
});

}


var pattern = /^[a-z0-9_-]+@[a-z0-9-]+\.[a-z]{2,6}$/i;
var mail = jQuery('#quiz_input_em');

mail.blur(function(){
if(mail.val() != ''){
if(mail.val().search(pattern) == 0){
jQuery('#valid').text('Подходит');
jQuery('#quiz_send').attr('disabled', false); jQuery('#quiz_send').css('background', '#0274be');jQuery('#quiz_input_em').css('border-color', '#0274be');
mail.removeClass('error').addClass('ok');
}else{
jQuery('#valid').text('Не подходит');
jQuery('#quiz_send').attr('disabled', true); jQuery('#quiz_send').css('background', 'gray');jQuery('#quiz_input_em').css('border-color', 'red');
mail.addClass('ok');
}
}else{
jQuery('#valid').text('Поле e-mail не должно быть пустым!');
mail.addClass('error');
jQuery('#quiz_send').attr('disabled', true); jQuery('#quiz_send').css('background', 'gray');jQuery('#quiz_input_em').css('border-color', 'red');
}
});

// slide 6

jQuery('.quiz_di').on('keydown', function(e){
if(e.key.length == 1 && e.key.match(/[^0-9]/)){
return false;
};
})
jQuery('.quiz_te').on('keydown', function(e){
if(e.key.length == 1 && e.key.match(/[^A-Za-zА-Яа-я]/)){
return false;
};
})
jQuery('.quiz_em').on('keydown', function(e){
if(e.key.length == 1 && e.key.match(/[^0-9A-Za-z.\-\@_]/)){
return false;
};
})



jQuery('.btn_quiz').click(function() {

slide = jQuery(this).data('slide');
if (slide == '6') {jQuery('#quiz_send').prop('disabled' , false);} else if (mail.val().search(pattern) == 0)  {jQuery('#quiz_send').prop('disabled' , true);jQuery('#quiz_send').css('background', '#0274be');}
if (slide == '1') {get_sum(jQuery('#first_sum').val());}
if (slide == '2') {check();console.log('check');}
if (slide == '3') {get_sum2(jQuery('#quiz_input_im_summa').val());}

jQuery('.quiz_block__nav').children('.btn_quiz[data-slide="'+slide+'"]').addClass('quiz_visible');
jQuery('.quiz_block__nav').children('.btn_quiz').removeClass('btn_quiz__active');
jQuery('.quiz_block__nav').children('.btn_quiz[data-slide="'+slide+'"]').addClass('btn_quiz__active');
console.log(slide+':slide');
jQuery('#quiz_count').html(slide);
jQuery('.quiz_block').hide();
jQuery('#quiz_'+slide).show();

});


 });


function sendAjaxForm(result_form, ajax_form, url) {
  username = jQuery('#quiz_input_na').val();
  finalmessage = '<p>Уважаемый '+username+'! У Вас есть возможность полностью освободиться от долгов в рамках процедуры банкротства.</p><p>На указанную электронную почту мы отправим список всех необходимых документов и полный расчет стоимости наших услуг.</p>';

    $.ajax({
        url:     '/wp-content/plugins/wp-zquiz/'+url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: jQuery("#"+ajax_form).serialize(),  // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
  jQuery('#di_quiz').html(finalmessage);

    	},
    	error: function(response) { // Данные не отправлены
            jQuery('#result_form').html('Ошибка. Данные не отправлены.');
    	}
 	});
}
