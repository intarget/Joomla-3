//2. Убрать вкладку Описание

function formCheck(){

    var errMsg = {'both':'Заполните обязательные поля'};

    var formError = '';
    if ((jQuery('#jform_params_app_key').val() == '') || (jQuery('#jform_params_email').val() == '')) {
        formError = 'both';
    }
    if (formError == '') {
        Joomla.submitbutton('plugin.apply');
    } else {
        alert(errMsg[formError]);
        return false;
    }

}

jQuery(document).ready(function(){
    jQuery('a[href="#description"]').hide();

    //кнопка проверить ключ
    var text_after = "Введите email и ключ API из личного кабинета inTarget. <br>"+
        "Если вы еще не регистрировались в сервисе inTarget это можно сделать по ссылке <a href='http://intarget.ru'>inTarget.ru</a>";
    var support_text =   "<br><br>Служба поддержки: <a href='mailto:plugins@intarget.ru'>plugins@intarget.ru</a><br>Joomla inTarget v1.0.0";
    var success_text = "Поздравляем! Ваш сайт успешно привязан к аккаунту <a href='http://intarget.ru'>intarget.ru</a>. Войдите в личный кабинет для просмотра статистики."

    ////проверка на успешную регистрацию.
    //function validateEmail(email) {
    //    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    //    return re.test(email);
    //}

    if ((jQuery('#jform_params_app_key').val() !== '') && (jQuery('#jform_params_email').val() !== '')) {
        if (window.intarget_succes_reg == true) {
            console.log("1");
            jQuery('#jform_params_app_key').after('<img title="Введен правильный ключ!" class="intrg_ok" src="../plugins/system/intarget/ok.png">');
            jQuery('#jform_params_email').after('<img title="Введен правильный email!" class="intrg_ok" src="../plugins/system/intarget/ok.png">');
            jQuery('#jform_params_intarget_id').val(window.intarget_id);
           //выключаем поля
           // jQuery('#jform_params_app_key').attr('disabled', 'disabled');
           // jQuery('#jform_params_email').attr('disabled', 'disabled');
            jQuery('[id=jform_params_app_key-lbl]').parent().parent().after(success_text+support_text);
            //jQuery('button#intrgt_auth_btn').hide();
        } else if (window.intarget_succes_reg == false) {
            jQuery('[id=jform_params_app_key-lbl]').parent().parent().after(text_after+support_text);
            console.log("2");
            if (window.intarget_reg_error == 403){
                jQuery('.alert.alert-success').hide();
                var error_text = 'Неверно введен email или ключ API.';
                //jQuery('#intrgt_auth_btn').after('<div><span class="intrg_err"> <b>Ошибка!</b> Неверно введен email или ключ API.</span></div>')
                //jQuery('#jform_params_app_key').after('<img title="Ошибка! Введен неверный ключ." class="intrg_err" src="../plugins/content/intarget/error.png"><span class="intrg_err"> Ошибка! Введен неверный ключ.</span>')
            }
            if (window.intarget_reg_error == 500) {
                jQuery('.alert.alert-success').hide();
                var error_text = 'Данный сайт уже используется в другом аккаунте на сайте <a href="http://intarget.ru">http://intarget.ru</a>';
                //jQuery('#intrgt_auth_btn').after('<span class="intrg_err"> <b>Ошибка!</b> Данный сайт уже используется в другом аккаунте на сайте <a href="http://intarget.ru">http://intarget.ru</a></span>')
            }
            if (window.intarget_reg_error == 404) {
                jQuery('.alert.alert-success').hide();
                var error_text = 'Данный email не зарегистрирован на сайте <a href="http://intarget.ru">http://intarget.ru</a>';
                //jQuery('#intrgt_auth_btn').after('<span class="intrg_err"> <b>Ошибка!</b> Данный email не зарегистрирован на сайте <a href="http://intarget.ru">http://intarget.ru</a></span>')
            }
            var intrg_btn_html = '<div style="width:100%;margin-top: 20px;">'+
                '<button style="float:left;" id="intrgt_auth_btn" onclick="formCheck(); return false;"> Авторизация </button>'+
                '<div style="padding-top: 2px;">'+
                '<span class="intrg_err" style="margin-left: 5px;"> <b>Ошибка!</b> '+ error_text +
                '</span>'+
                '</div>'+
                '</div>';
            jQuery('input#jform_params_app_key').parent().after(intrg_btn_html)
        } else {
            console.log('3');
            jQuery('input#jform_params_app_key').parent().after('<button style="float:left;margin-top: 15px;" id="intrgt_auth_btn" onclick="formCheck(); return false;"> Авторизация </button>')
            jQuery('[id=jform_params_app_key-lbl]').parent().parent().after(text_after+support_text);};


    } else {
        jQuery('input#jform_params_app_key').parent().after('<button style="float:left;margin-top: 15px;" id="intrgt_auth_btn" onclick="formCheck(); return false;"> Авторизация </button>')
        jQuery('[id=jform_params_app_key-lbl]').parent().parent().after(text_after+support_text);};

    //правим отступ
    jQuery('#jform_params_app_key').parent().css('margin-left','70px')
    jQuery('#jform_params_email').parent().css('margin-left','70px')


   /* jQuery('#intrgt_auth_btn').attr('disabled', 'disabled');
    jQuery('#jform_params_app_key, #jform_params_email').change(function() {

        var empty = false;
        jQuery('#jform_params_app_key, #jform_params_email').each(function() {
            if (jQuery(this).val() == '') {
                empty = true;
            }
        });
        if (empty) {
            jQuery('#intrgt_auth_btn').attr('disabled', 'disabled');
        } else {
            jQuery('#intrgt_auth_btn').removeAttr('disabled');
        }
    });
    */

})



//добавляем вместо краткого описания нужный текст.
var  text_after2 = "<p><b>inTarget</b> - сервис повышения продаж и аналитика посетителей сайта.</p>" +
    "<p>Оцените принципиально новый подход к просмотру статистики. Общайтесь со своей аудиторией, продавайте лучше, зарабатывайте больше. И все это бесплатно!</p>";
jQuery('.readmore').parent().hide();
jQuery('.info-labels').after(text_after2);





