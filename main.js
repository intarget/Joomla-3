function formCheck() {
    var errMsg = {'both': 'Заполните обязательные поля'};
    var formError = '';
    if ((jQuery('#jform_params_app_key').val() == '') || (jQuery('#jform_params_email').val() == '')) {
        formError = 'both';
    }
    if (formError == '') {
        Joomla.submitbutton('plugin.apply');
        return true;
    } else {
        alert(errMsg[formError]);
        return false;
    }
}

jQuery(document).ready(function () {
    jQuery('a[href="#description"]').hide();

    var text_after = "Введите email и ключ API из личного кабинета inTarget. <br>" +
        "Если вы еще не регистрировались в сервисе inTarget это можно сделать по ссылке <a href='http://intarget.ru'>inTarget.ru</a>";
    var support_text = "<br><br>Служба поддержки: <a href='mailto:plugins@intarget.ru'>plugins@intarget.ru</a><br>Joomla inTarget v1.0.2";
    var success_text = "Поздравляем! Ваш сайт успешно привязан к аккаунту <a href='http://intarget.ru'>intarget.ru</a>. Войдите в личный кабинет для просмотра статистики.";

    if ((jQuery('#jform_params_app_key').val() !== '') && (jQuery('#jform_params_email').val() !== '')) {
        if (window.intarget_succes_reg == true && jQuery('#jform_params_intarget_id').val() !== '') {
            jQuery('#jform_params_app_key').after('<img title="Введен правильный ключ!" class="intrg_ok" src="../plugins/system/intarget/ok.png">');
            jQuery('#jform_params_email').after('<img title="Введен правильный email!" class="intrg_ok" src="../plugins/system/intarget/ok.png">');
            jQuery('[id=jform_params_app_key-lbl]').parent().parent().after(success_text + support_text);
        } else if (window.intarget_succes_reg == true && jQuery('#jform_params_intarget_id').val() == ''){
            jQuery('#jform_params_intarget_id').val(window.intarget_id);
            Joomla.submitbutton('plugin.apply');
        } else if (window.intarget_succes_reg == false) {
            jQuery('[id=jform_params_app_key-lbl]').parent().parent().after(text_after + support_text);
            if (window.intarget_reg_error == 403) {
                jQuery('.alert.alert-success').hide();
                var error_text = 'Неверно введен email или ключ API.';
            }
            if (window.intarget_reg_error == 500) {
                jQuery('.alert.alert-success').hide();
                var error_text = 'Данный сайт уже используется в другом аккаунте на сайте <a href="http://intarget.ru">http://intarget.ru</a>';
            }
            if (window.intarget_reg_error == 404) {
                jQuery('.alert.alert-success').hide();
                var error_text = 'Данный email не зарегистрирован на сайте <a href="http://intarget.ru">http://intarget.ru</a>';
            }
            if (window.intarget_reg_error == 0) {
                jQuery('.alert.alert-success').hide();
                var error_text = 'Ответ от <a href="http://intarget.ru">inTarget</a> не был получен. Возможно, вы исползуете модуль локально!';
            }
            var intrg_btn_html = '<div style="width:100%;margin-top: 20px;">' +
                '<button style="float:left;" id="intrgt_auth_btn" onclick="formCheck(); return false;"> Авторизация </button>' +
                '<div style="padding-top: 2px;">' +
                '<span class="intrg_err" style="margin-left: 5px;"> <b>Ошибка!</b> ' + error_text +
                '</span>' +
                '</div>' +
                '</div>';
            jQuery('input#jform_params_app_key').parent().after(intrg_btn_html)
        } else {
            if (jQuery('#jform_enabled').val() == 0) {
                var error_text = 'Для начала работы необходимо включить плагин.';
            }
            jQuery('input#jform_params_app_key').parent().after('<button style="float:left;margin-top: 15px;" id="intrgt_auth_btn" onclick="formCheck(); return false;"> Авторизация </button>' +
                '<div style="padding-top: 20px;">' +
                '<span class="intrg_err" style="margin-left: 5px;"> <b>Ошибка!</b> ' + error_text +
                '</span>' +
                '</div>');
            jQuery('[id=jform_params_app_key-lbl]').parent().parent().after(text_after + support_text);
        }
    } else {
        jQuery('input#jform_params_app_key').parent().after('<button style="float:left;margin-top: 15px;" id="intrgt_auth_btn" onclick="formCheck(); return false;"> Авторизация </button>');
        jQuery('[id=jform_params_app_key-lbl]').parent().parent().after(text_after + support_text);
    }
    //правим отступ
    jQuery('#jform_params_app_key').parent().css('margin-left', '70px');
    jQuery('#jform_params_email').parent().css('margin-left', '70px')
});

//добавляем вместо краткого описания нужный текст.
var text_after2 = "<p><b>inTarget</b> - сервис повышения продаж и аналитика посетителей сайта.</p>" +
    "<p>Оцените принципиально новый подход к просмотру статистики. Общайтесь со своей аудиторией, продавайте лучше, зарабатывайте больше. И все это бесплатно!</p>";
jQuery('.readmore').parent().hide();
jQuery('.info-labels').after(text_after2);

if (jQuery("p.alert-message:contains('Учётная запись для вас была создана')").length) {
    (function(w, c) {
        w[c] = w[c] || [];
        w[c].push(function(inTarget) {
            inTarget.event('user-reg');
        });
    })(window, 'inTargetCallbacks');
}
