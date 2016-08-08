<?php
/**
 * @version     1.0.3
 * @Project     inTarget https://intarget.ru
 * @author      intarget Team
 * @package
 * @copyright   Copyright (C) 2016 https://intarget.ru. All rights reserved.
 * @license     GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
jimport('joomla.plugin.plugin');

class plgSystemIntarget extends JPlugin
{
    public $app_key = '';
    public $email = '';
    public $url = '';
    public $projectId = '';
    public $error = '';
    public $regDomain = 'https://intarget.ru/';
    public  $rtDomain = "//rt.intarget.ru/loader.js";
    public $int_scrpt = '';
    public $VMAddToCartSelector = 'input.addtocart-button';
    public $VMSuccessOrderSelector = 'button#checkoutFormSubmit';
    public $VMViewCartSelector = 'body.view-cart';
    public $VMDelFromCartSelector = '.vm2-remove_from_cart';
    public $VMCatViewSelector = 'div.category-view';
    public $jsCode2 = <<<EOD
    (function () {
jQuery(document).ready(function () {
    //hikashop
    //////cat-view
    if (jQuery('body.com_hikashop.view-category').length) {
        (function (w, c) {
            w[c] = w[c] || [];
            w[c].push(function (inTarget) {
                inTarget.event('cat-view');
                console.log('cat-view');
            });
        })(window, 'inTargetCallbacks');
    }
    //////item-view
    if (jQuery('body.com_hikashop.view-product').length) {
        (function (w, c) {
            w[c] = w[c] || [];
            w[c].push(function (inTarget) {
                inTarget.event('item-view');
                console.log('item-view');
            });
        })(window, 'inTargetCallbacks');
    }
    //////add to cart
    jQuery("input.button.hikashop_cart_input_button[name=add]").each(function () {
        var my_funct = " inTarget.event('add-to-cart');console.log('add-to-cart');";
        if (jQuery(this).attr('onclick')) {
            if (jQuery(this).attr('onclick')) {
                jQuery(this).attr('onclick', my_funct + jQuery(this).attr('onclick'));
            } else jQuery(this).attr('onclick', my_funct);
        } else jQuery(this).attr('onclick', my_funct);
    });
    /////del from cart
    jQuery(".hikashop_cart_product_quantity_delete").each(function () {
        var my_funct = " inTarget.event('del-from-cart'); console.log('del-from-cart');";
        if (jQuery(this).attr('onclick')) {
            jQuery(this).attr('onclick', my_funct + jQuery(this).attr('onclick'));
        } else jQuery(this).attr('onclick', my_funct);
    });
    /////order_finish
    if (jQuery('span#hikashop_purchaseorder_end_message').length) {
        (function (w, c) {
            w[c] = w[c] || [];
            w[c].push(function (inTarget) {
                inTarget.event('success-order');
                console.log('success-order');
            });
        })(window, 'inTargetCallbacks');
    }
    ////user_reg
    jQuery("input.button.hikashop_cart_input_button[name=register]").each(function () {
        var my_funct = "inTarget.event('user-reg'); console.log('user-reg');";
        if (jQuery(this).attr('onclick')) {
            jQuery(this).attr('onclick', my_funct + jQuery(this).attr('onclick'));
        } else jQuery(this).attr('onclick', my_funct);
    });
    //joomshopping
    //////view-cat
    if (jQuery('div.jshop_list_category').length) {

        (function (w, c) {
            w[c] = w[c] || [];
            w[c].push(function (inTarget) {
                inTarget.event('cat-view');
                console.log('cat-view');
            });
        })(window, 'inTargetCallbacks');
    }
    //item-view
    if (jQuery('div.jshop.productfull').length) {
        (function (w, c) {
            w[c] = w[c] || [];
            w[c].push(function (inTarget) {
                inTarget.event('item-view');
                console.log('item-view');
            });
        })(window, 'inTargetCallbacks');
    }
    //add to cart
    //add to cart at view item page
    jQuery("a.btn.btn-success.button_buy").each(function () {
        var my_funct = "document.cookie = \"INTARGET_ADD=Y; path=/;\";";
        if (jQuery(this).attr('onclick')) {
            jQuery(this).attr('onclick', my_funct + jQuery(this).attr('onclick'));
        } else jQuery(this).attr('onclick', my_funct);
    });
    jQuery('.prod_buttons input.btn.btn-primary.button').each(function () {
        var my_funct = "document.cookie = \"INTARGET_ADD=Y; path=/;\";";
//        var my_funct = "inTarget.event('add-to-cart');";
        if (jQuery(this).attr('onclick')) {
            jQuery(this).attr('onclick', my_funct + jQuery(this).attr('onclick'));
        } else jQuery(this).attr('onclick', my_funct);
    });
    jQuery("a[href*='/cart/delete']").each(function () {
        var my_funct = "inTarget.event('del-from-cart'); console.log('del-from-cart');";
        if (jQuery(this).attr('onclick')) {
            jQuery(this).attr('onclick', my_funct + jQuery(this).attr('onclick'));
        } else jQuery(this).attr('onclick', my_funct);
    });
    jQuery("a[href*='/korzina/delete']").each(function () {
        var my_funct = "inTarget.event('del-from-cart'); console.log('del-from-cart');";
        if (jQuery(this).attr('onclick')) {
            jQuery(this).attr('onclick', my_funct + jQuery(this).attr('onclick'));
        } else jQuery(this).attr('onclick', my_funct);
    });
    //user reg
    if (jQuery("p.alert-message:contains('Учётная запись для вас была создана')").length) {
        (function (w, c) {
            w[c] = w[c] || [];
            w[c].push(function (inTarget) {
                inTarget.event('user-reg');
                console.log('user-reg');
            });
        })(window, 'inTargetCallbacks');
    }
    //order_finish
    jQuery("input[name='finish_registration']").each(function () {
        var my_funct = " inTarget.event('success-order'); console.log('success-order')";
        if (jQuery(this).attr('onclick')) {
            jQuery(this).attr('onclick', my_funct + jQuery(this).attr('onclick'));
        } else jQuery(this).attr('onclick', my_funct);
    });
    //virtuemart
    jQuery('input.addtocart-button').click(function () {
        inTarget.event('add-to-cart');
        console.log('add-to-cart');
    });
    jQuery('.vm2-remove_from_cart').click(function () {
        inTarget.event('del-from-cart');
        console.log('del-from-cart');
    });
    jQuery('button#checkoutFormSubmit[name=confirm]').each(function () {
        var my_funct = "inTarget.event('success-order'); console.log('success-order');";
        if (jQuery(this).attr('onclick')) {
            jQuery(this).attr('onclick', my_funct + jQuery(this).attr('onclick'));
        } else jQuery(this).attr('onclick', my_funct);
    });
    if (jQuery('body.com_virtuemart.view-productdetails').length) {
        (function (w, c) {
            w[c] = w[c] || [];
            w[c].push(function (inTarget) {
                inTarget.event('item-view');
                console.log('item-view');
            });
        })(window, 'inTargetCallbacks');
    }
    if (jQuery('div.category-view').length) {
        (function (w, c) {
            w[c] = w[c] || [];
            w[c].push(function (inTarget) {
                inTarget.event('cat-view');
                console.log('cat-view');
            });
        })(window, 'inTargetCallbacks');
    }
    //user reg
    jQuery("button[name=save]").each(function () {
        var my_funct = "inTarget.event('user-reg'); console.log('user-reg');";
        if (jQuery(this).attr('onclick')) {
            jQuery(this).attr('onclick', my_funct + jQuery(this).attr('onclick'));
        } else jQuery(this).attr('onclick', my_funct);
    });
    jQuery("button[name=register]").each(function () {
        var my_funct = "inTarget.event('user-reg'); console.log('user-reg');";
        if (jQuery(this).attr('onclick')) {
            jQuery(this).attr('onclick', my_funct + jQuery(this).attr('onclick'));
        } else jQuery(this).attr('onclick', my_funct);
    })
});

function intargetgetCookie(name) {
    var matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([.$?*|{}()[]\/+^])/g, '\$1') + "=([^;]*)"));
    return matches ? decodeURIComponent(matches[1]) : 'N';
}

var intarget_add = intargetgetCookie('INTARGET_ADD');
if (intarget_add && intarget_add == 'Y') {
    (function (w, c) {
        w[c] = w[c] || [];
        w[c].push(function (inTarget) {
            inTarget.event('add-to-cart');
            console.log('add-to-cart');
        });
    })(window, 'inTargetCallbacks');
    document.cookie = 'INTARGET_ADD=N; path=/;';
}
})();
/* INTARGET CODE END */
EOD;

    public function __construct(& $subject, $config)
    {
        parent::__construct($subject, $config);

        if (!function_exists('curl_init')) {
            echo "inTarget plugin problem. Php_curl not installed.
          Please install curl or disable plugin";
            exit();
        }

        // загрузка параметров плагина
        $this->isAdmin = JFactory::getApplication()->isAdmin();
        $this->app_key = $this->params->get('app_key', '');
        $this->email = $this->params->get('email', '');
        $this->projectId = $this->params->get('intarget_id','');
        $this->url = $this->currentUrl();

        //check and try to reg
        if (($this->email !== '') && ($this->app_key !== '') && empty($this->projectId)) {
            $id = $this->regbyApi();
            if (isset($id->payload->projectId)) {
                $this->projectId = $id->payload->projectId;
                $this->params->set('intarget_id', $id->payload->projectId);
            }
        }
        if (strlen($this->projectId) > 0) {
            JFactory::getDocument()->addScriptDeclaration($this->getjsCode());
            JFactory::getDocument()->addScriptDeclaration($this->jsCode2);
        }

        //проверка на успешно авторизированный проект
        if ($this->isAdmin) {
            if (strlen($this->projectId) > 0) {
                JFactory::getDocument()->addScriptDeclaration('(function () {   window.intarget_succes_reg = true;})();');
                JFactory::getDocument()->addScriptDeclaration('(function () {   window.intarget_id = ' . $this->projectId .';})();');

            } else {
                if (isset($id->code)) {
                    JFactory::getDocument()->addScriptDeclaration('(function () {window.intarget_succes_reg = false;window.intarget_reg_error = "' . $id->code . '";})();');
                } elseif (empty($id)) {
                    JFactory::getDocument()->addScriptDeclaration('(function () {window.intarget_succes_reg = false;window.intarget_reg_error = "0";})();');
                }
            }
        }
    }

    /**
     * Возвращает url
     */
    public function currentUrl()
    {
        $url = 'http';
        if (isset($_SERVER['HTTPS'])) {
            if ($_SERVER['HTTPS'] == 'on') {
                $url .= 's';
            }
        }
        $url .= '://';
        if ($_SERVER['SERVER_PORT'] != '80') {
            $url .= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
        } else {
            $url .= $_SERVER['SERVER_NAME'];
        }
        return $url;
    }

    /** Main script
     * @throws Exception
     */
    public function getjsCode()
    {

        if ((strlen($this->projectId) > 0) && (!$this->isAdmin)) {
            return '
            /* INTARGET CODE START */
            (function(d, w, c) {
                  w[c] = {
                    projectId:' . $this->projectId . '
                  };
                  var n = d.getElementsByTagName("script")[0],
                  s = d.createElement("script"),
                  f = function () { n.parentNode.insertBefore(s, n); };
                  s.type = "text/javascript";
                  s.async = true;
                  s.src = "' . $this->rtDomain . '";
                  if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                  } else { f(); }
                })(document, window, "inTargetInit");
        ' . $this->int_scrpt;
        } else return;
    }

    public function onBeforeRender()
    {
    }

    public function onContentPrepare($context, &$article, &$params, $page = 0)
    {
    }

    public function onContentBeforeDisplay($context, &$product, &$params, $page = 0)
    {
        if ($context != 'com_virtuemart.productdetails')
            return;

        $this->productView();
    }

    private function productView()
    {
        if (!empty($this->projectId)) {
            $int_scrpt = "jQuery(document).ready(function(){
                            (function(w, c) {
                                w[c] = w[c] || [];
                                w[c].push(function(inTarget) {
                                    inTarget.event('item-view');
                                    console.log('item-view');
                                });
                            })(window, 'inTargetCallbacks');
                          })";
            $this->int_scrpt = $int_scrpt;
            JFactory::getDocument()->addScriptDeclaration($int_scrpt);
        }
    }

    /** Virtuemart on add to cart
     *
     * @param $cart
     */
    public function plgVmOnAddToCart($cart)
    {
        $this->virtuemartSubmitCart($cart);
    }

    public function regbyApi()
    {
        $domain = $this->regDomain;
        $email = $this->email;
        $key = $this->app_key;
        $url = $this->url;
        $projectId = $this->projectId;

        if (($domain == '') OR ($email == '') OR ($key == '') OR ($url == '') OR (!empty($projectId))) {
            return;
        }

        $ch = curl_init();
        $jsondata = json_encode(array(
            'email' => $email,
            'key' => $key,
            'url' => $url,
            'cms' => 'joomla'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Accept: application/json'));
        curl_setopt($ch, CURLOPT_URL, $domain . "/api/registration.json");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        file_put_contents(JPATH_PLUGINS . '/system/intarget/log.txt', $server_output, FILE_APPEND);
        $json_result = json_decode($server_output);
        return $json_result;
    }

    public function onAfterOrderCreate(&$order, &$send_email)
    {
        $input = JFactory::getApplication()->input;
        $task = $input->getCmd('task', '');
        $ctrl = $input->getCmd('ctrl', '');
        $option = $input->getCmd('option', '');

        if ($option != 'com_hikashop' || !($ctrl == 'checkout' && $task == 'step' && !$this->isAdmin)) {
            return;
        }

        if (!empty($this->projectId)) {
            $int_scrpt = "jQuery(document).ready(function(){
                            (function(w, c) {
                                w[c] = w[c] || [];
                                w[c].push(function(inTarget) {
                                    inTarget.event('success-order');
                                    console.log('success-order');
                                });
                            })(window, 'inTargetCallbacks');
                          })";
            $this->int_scrpt = $int_scrpt;
            JFactory::getDocument()->addScriptDeclaration($int_scrpt);
        }
    }
}
