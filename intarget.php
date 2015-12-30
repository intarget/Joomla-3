<?php
/**
 * @version		1.0.0
 * @Project		InTarget
 * @author 		intarget.ru
 * @package
 * @copyright	Copyright (C) 2015 intarget.ru. All rights reserved.
 * @license 	GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 */

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.plugin.plugin');
/*
: email: String, key: String, url: String
[12:46:36] Dmitry Modin: /api/registration.json
domain: dev.intarget.ru

content type:apliation"json
accepted application;json

*/



class plgSystemIntarget extends JPlugin
{

    private $debug = false;
    public $app_key = '';
    public $email = '';
    public $url = '';
    public $projectId = '';
    public $regDomain = 'http://intarget-dev.lembrd.com';
    //public $regDomain = 'http://intarget.ru';
    public $rtDomain = "//rt.intarget-dev.lembrd.com/loader.js";
    //public  $rtDomain = ""//rt.intarget.ru/loader.js";
    public $int_scrpt = '';
    public $VMAddToCartSelector = 'input.addtocart-button';
    public $VMSuccessOrderSelector = 'button#checkoutFormSubmit';
    public $VMViewCartSelector = 'body.view-cart';
    public $VMDelFromCartSelector = '.vm2-remove_from_cart';
    public $VMCatViewSelector = 'div.category-view';
    public $jsCode2 = <<<EOD

jQuery(document).ready(function(){
    //hikashop

        //////cat-view
              if (jQuery('body.com_hikashop.view-category').length) {
                           (function(w, c) {
                    w[c] = w[c] || [];
                    w[c].push(function(inTarget) {
                        inTarget.event('cat-view');
                    });
                })(window, 'inTargetCallbacks');
            }
        //////item-view
              if (jQuery('body.com_hikashop.view-product').length) {
                            (function(w, c) {
                w[c] = w[c] || [];
                w[c].push(function(inTarget) {

                inTarget.event('item-view')
                    });
                })(window, 'inTargetCallbacks');
            }
        //////add to cart
            jQuery("input.button.hikashop_cart_input_button[name=add]").each(function() {
                var my_funct = " inTarget.event('add-to-cart');";
            jQuery(this).attr('onclick',my_funct+jQuery(this).attr('onclick'));
            })
        /////del from cart

            jQuery(".hikashop_cart_product_quantity_delete").each(function() {
                var my_funct = " inTarget.event('del-from-cart') ;";
            jQuery(this).attr('onclick',my_funct+jQuery(this).attr('onclick'));
            })
         /////order_finish
           if (jQuery('span#hikashop_purchaseorder_end_message').length) {

                                                      (function(w, c) {
                w[c] = w[c] || [];
                w[c].push(function(inTarget) {

                inTarget.event('success-order')
                    });
                })(window, 'inTargetCallbacks');


            }
        ////user_reg
            jQuery("input.button.hikashop_cart_input_button[name=register]").each(function() {
                var my_funct = "inTarget.event('user-reg');";
                jQuery(this).attr('onclick',my_funct+jQuery(this).attr('onclick'));
            })



    //joomshopping
        //////view-cat
        //div class="jshop_list_category"

        if (jQuery('div.jshop_list_category').length) {

                        (function(w, c) {
                    w[c] = w[c] || [];
                    w[c].push(function(inTarget) {
                        inTarget.event('cat-view');
                    });
                })(window, 'inTargetCallbacks');




        }

        //item-view
        /////div class=jshop productfull
        if (jQuery('div.jshop.productfull').length) {
            (function(w, c) {
                w[c] = w[c] || [];
                w[c].push(function(inTarget) {

                inTarget.event('item-view')
                    });
            })(window, 'inTargetCallbacks');
             }


        //add to cart
        ////onclick="jQuery('#to').val('cart');"
        //<input type="submit" class="btn btn-primary button" value="В корзину" onclick="jQuery('#to').val('cart');">
        //<a class="btn btn-success button_buy" href="/korzina/add?category_id=4&amp;product_id=6" target="_self">Купить</a>
        //add to cart at view item page


        jQuery("a.btn.btn-success.button_buy").each(function() {
            var my_funct = " inTarget.event('add-to-cart');";
        jQuery(this).attr('onclick',my_funct+jQuery(this).attr('onclick'));
        })
        /*
        2)при нажатии на кнопку В корзину на странице http://joomla03.lembrd.com/index.php/magazin/category1/product01 ,
        нет события add-to-cart
        */
        jQuery('.prod_buttons input.btn.btn-primary.button').each(function() {
            var my_funct = " inTarget.event('add-to-cart');";
        jQuery(this).attr('onclick',my_funct+jQuery(this).attr('onclick'));
        })




        //add to cart from car view
        ////btn btn-success button_buy
        //  jQuery('a.btn.btn-success.button_buy').click(function(){  inTarget.event('add-to-cart') });

        //del from cart
        //<a class="button-img" href="/korzina/delete?number_id=0" onclick="return confirm('Действительно удалить?')" target="_self">
        //                    <img src="http://joomshopping.aliexpress-skidka.ru/components/com_jshopping/images/remove.png" alt="Удалить" title="Удалить">
        //                </a>
        ////jQuery("a[href^='/korzina/delete']")
        //http://local-joomshop/index.php/shop/cart/delete?number_id=0

        jQuery("a[href*='/cart/delete']").each(function() {
            var my_funct = " inTarget.event('del-from-cart') ;";
        jQuery(this).attr('onclick',my_funct+jQuery(this).attr('onclick'));
        })

        jQuery("a[href*='/korzina/delete']").each(function() {
            var my_funct = " inTarget.event('del-from-cart') ;";
        jQuery(this).attr('onclick',my_funct+jQuery(this).attr('onclick'));
        })

        //user reg
        // location.href='/magazin/user/register';
        //jQuery('input[onclick*="register"]')


        if (jQuery( ".alert-message p:contains('Учётная запись для вас была создана')" ).length) {

                (function(w, c) {
                    w[c] = w[c] || [];
                    w[c].push(function(inTarget) {
                        inTarget.event('user-reg');
                    });
                })(window, 'inTargetCallbacks');
            };


        /*
        срабатывало при незаполненных полях
        jQuery("input[onclick*='register']").each(function() {
            var my_funct = "inTarget.event('user-reg');";
        jQuery(this).attr('onclick',my_funct+jQuery(this).attr('onclick'));
        })

        */
        //order_finish

        //jQuery("input[name='finish_registration']")

        jQuery("input[name='finish_registration']").each(function() {
            var my_funct = " inTarget.event('success-order') ;";
        jQuery(this).attr('onclick',my_funct+jQuery(this).attr('onclick'));
        })

    //virtuemart
          jQuery('input.addtocart-button').click(function(){  inTarget.event('add-to-cart')      });
          jQuery('.vm2-remove_from_cart').click(function(){ inTarget.event('del-from-cart') });

            jQuery('button#checkoutFormSubmit[name=confirm]').each(function() {
                var my_funct = "inTarget.event('success-order');";
            jQuery(this).attr('onclick',my_funct+jQuery(this).attr('onclick'));
            })

            if (jQuery('body.com_virtuemart.view-productdetails').length) {

                (function(w, c) {
                    w[c] = w[c] || [];
                    w[c].push(function(inTarget) {
                        inTarget.event('item-view');
                    });
                })(window, 'inTargetCallbacks');
            };

            if (jQuery('div.category-view').length) {

                (function(w, c) {
                    w[c] = w[c] || [];
                    w[c].push(function(inTarget) {
                        inTarget.event('cat-view');
                    });
                })(window, 'inTargetCallbacks');
            };

          //if (jQuery('body.view-cart').length) { inTarget.event('cart-view')  };
        //user reg
            jQuery("button[name=save]").each(function() {
                var my_funct = "inTarget.event('user-reg');";
            jQuery(this).attr('onclick',my_funct+jQuery(this).attr('onclick'));
        })
        jQuery("button[name=register]").each(function() {
            var my_funct = "inTarget.event('user-reg');";
        jQuery(this).attr('onclick',my_funct+jQuery(this).attr('onclick'));
        })

})
EOD;


    public $jsCode2_old = <<<EOD

jQuery(document).ready(function(){
  jQuery('input.addtocart-button').click(function(){

    (function(w, c) {
        w[c] = w[c] || [];
        w[c].push(function(inTarget) {

  inTarget.event('add-to-cart')
        });
})(window, 'inTargetCallbacks');



  })
})

jQuery(document).ready(function(){
  jQuery('button#checkoutFormSubmit').click(function(){
    (function(w, c) {
    w[c] = w[c] || [];
    w[c].push(function(inTarget) {

  inTarget.event('success-order')
        });
})(window, 'inTargetCallbacks');

  })
})

jQuery(document).ready(function(){
  if (jQuery('div.category-view').length) {
    (function(w, c) {
    w[c] = w[c] || [];
    w[c].push(function(inTarget) {

    inTarget.event('cat-view')
        });
})(window, 'inTargetCallbacks');

  }
})

jQuery(document).ready(function(){
  if (jQuery('body.view-cart').length) {

    (function(w, c) {
    w[c] = w[c] || [];
    w[c].push(function(inTarget) {

    inTarget.event('cart-view')
        });
})(window, 'inTargetCallbacks');

  }
})

//user reg


jQuery(document).ready(function(){
  jQuery('.vm2-remove_from_cart').click(function(){
    (function(w, c) {
    w[c] = w[c] || [];
    w[c].push(function(inTarget) {

    inTarget.event('del-from-cart')
        });
})(window, 'inTargetCallbacks');

  })

//var elements2 = document.getElementsByClassName('vm2-remove_from_cart'),j,len2,el2;
//for (j = 0, len2 = elements2.length; j < len2; j++) {
//    el2 = elements2[j];
//    el2.onclick = function() {inTarget.event('del-from-cart')}    
//}

})
EOD;

    public $jsCodeDebug = <<<EOD





jQuery(document).ready(function(){

  jQuery('input.addtocart-button').click(function(){alert('added to cart')})

})

jQuery(document).ready(function(){
  jQuery('button#checkoutFormSubmit').click(function(){alert('success-order')})
})

jQuery(document).ready(function(){
  if (jQuery('div.category-view').length) {
    alert('cat-view')
  }
})

jQuery(document).ready(function(){
  if (jQuery('body.view-cart').length) {
    alert('cart-view')
  }
})

jQuery(document).ready(function(){
  jQuery('.vm2-remove_from_cart').click(function(){alert('del-from-cart')})

//var elements2 = document.getElementsByClassName('vm2-remove_from_cart'),j,len2,el2;
//for (j = 0, len2 = elements2.length; j < len2; j++) {
//    el2 = elements2[j];
//    el2.onclick = function() {alert('del-from-cart')}    
//}

})
EOD;


  public function __construct(& $subject, $config)
  {
    parent::__construct($subject, $config);

      if(!function_exists('curl_init'))
      {
          echo "Intarget plugin problem. Php_curl not installed.
          Please install curl or disable plugin";
          exit();
      }

        $this->isAdmin = JFactory::getApplication()->isAdmin();
        if ($this->debug) {
            $this->app_key = 'TW11RrYsczhpluVFFBABruIEmPDq2Z8Z';
        } else $this->app_key = $this->params->get('app_key', '');

        //$this->projectId = $this->getProjectIdFromFile();

      $this->projectId = $this->getProjectIdFromFile();
        if (strlen($this->projectId) > 0) {
            JFactory::getDocument()->addScriptDeclaration('window.intarget_projectId = '.$this->projectId.';');
            if ($this->debug) {
                JFactory::getDocument()->addScriptDeclaration($this->getjsCode().$this->jsCodeDebug);
            } else JFactory::getDocument()->addScriptDeclaration($this->getjsCode().$this->jsCode2);
        }

     /* if(!empty($this->app_key) && !$this->isAdmin)
      {
          if ($this->debug) {
              JFactory::getDocument()->addScriptDeclaration($this->getjsCode().$this->jsCodeDebug);
          } else JFactory::getDocument()->addScriptDeclaration($this->getjsCode().$this->jsCode2);

      }*/



        $uri = JUri::getInstance();
        $url = $uri->toString(array('host'));
        $this->url = $url;
        if ($this->params->get('email') != '') {
            $this->email = $this->params->get('email');
        }

      //check adn try to reg
      if (($this->params->get('email') !== '') && ($this->params->get('app_key') !== '') && ($this->projectId == '')){
          $id = $this->regbyApi();
          //$id = '';
          //$this->saveProjectId('41');
          if (strlen($id) > 0 ) {

              $this->saveProjectIdToFile($id);
              //echo 'saved';exit();
              //$this->projectId = $this->getProjectIdFromFile();
          }
      }
      $this->projectId = $this->getProjectIdFromFile();

        //проверка на успешно авторизированный проект
      if ($this->isAdmin) {
          if  (strlen($this->projectId) > 0) {
              JFactory::getDocument()->addScriptDeclaration('window.intarget_succes_reg = true');
          } elseif (file_get_contents(JPATH_PLUGINS.'/system/intarget/error.txt')) {
              JFactory::getDocument()->addScriptDeclaration('window.intarget_succes_reg = false;window.intarget_reg_error = "'.file_get_contents(JPATH_PLUGINS.'/system/intarget/error.txt'). '"');
              //file_put_contents(JPATH_PLUGINS.'/content/intarget/error.txt'
          }
      }




    }



     /** Main script
     * @throws Exception
     */
    public function getjsCode(){

        if ((strlen($this->projectId) > 0) && (!$this->isAdmin) )  {
            return  '
            /*INTARGET CODE START */

            (function(d, w, c) {
                  w[c] = {
                    projectId:'.$this->projectId.'
                  };

                  var n = d.getElementsByTagName("script")[0],
                  s = d.createElement("script"),
                  f = function () { n.parentNode.insertBefore(s, n); };
                  s.type = "text/javascript";
                  s.async = true;
                  s.src = "'.$this->rtDomain.'";
                  if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                  } else { f(); }

                })(document, window, "inTargetInit");

               /*INTARGET CODE END */

        '.$this->int_scrpt;
        } else return;
    }
    public function onBeforeRender()
    {
      /*  if(!empty($this->app_key) && !$this->isAdmin)
        {
            if ($this->debug) {
                JFactory::getDocument()->addScriptDeclaration($this->getjsCode().$this->jsCodeDebug);
            } else JFactory::getDocument()->addScriptDeclaration($this->getjsCode().$this->jsCode2);

        }*/
    }


    public function onContentPrepare($context, &$article, &$params, $page = 0)
    {

    }


     public function onContentBeforeDisplay($context, &$product, &$params, $page = 0)
    {

      //JFactory::getDocument()->addScriptDeclaration('alert("'.$context.'")');
       /* $pos = strpos($context,'com_virtuemart');
        if ($pos === false) {
            return;
        }*/
        if($context != 'com_virtuemart.productdetails')
            return;

        //$category_id = JFactory::getApplication()->input->getInt('virtuemart_category_id', 0);
        //if($category_id == 0)
        //{
        //    $category_id = $product->virtuemart_category_id;
        //}
       /* if(!empty($this->app_key) && !$this->isAdmin)
        {
            if ($this->debug) {
                JFactory::getDocument()->addScriptDeclaration($this->getjsCode().$this->jsCodeDebug);
            } else JFactory::getDocument()->addScriptDeclaration($this->getjsCode().$this->jsCode2);

        }*/
        $this->productView();
    }

     private function productView()
    {
        if(!empty($this->app_key))
        {
            //$uri = JUri::getInstance()->toString();
          if ($this->debug) { $int_scrpt = "
          
jQuery(document).ready(function(){
alert('itemview')
})
            

          ";} else  $int_scrpt = "



jQuery(document).ready(function(){

   (function(w, c) {
    w[c] = w[c] || [];
    w[c].push(function(inTarget) {

    inTarget.event('item-view')
        });
})(window, 'inTargetCallbacks');


})

          ";
            $this->int_scrpt = $int_scrpt;
            JFactory::getDocument()->addScriptDeclaration($int_scrpt);
        }
    }

    /** Virtuemart on add to cart
     * @param $cart
     */
    public function plgVmOnAddToCart($cart)
    {
        $this->virtuemartSubmitCart($cart);
    }

    public function regbyApi(){
        //$domain = 'dev.intarget.ru'
        $domain = $this->regDomain;
        $email = $this->email; //'wixapp@ya.ru';
        $key = $this->app_key;//'TW11RrYsczhpluVFFBABruIEmPDq2Z8Z';
        $url = 'http://'.$this->url; //'aliexpress-skidka.ru';

        if (($domain == '') OR ($email == '') OR ($key == '') OR ($url == '') ){
            return;
        }
        //var_dump(array($domain,$email,$key,$url));exit();
        $ch = curl_init();

        //$jsondata ='            "email={$email}&key={$key}&url={$url}"'
        $jsondata = json_encode(array(
            'email' => $email,
            'key' => $key,
            'url' => $url,
            'cms' => 'joomla'));

        //print_r($jsondata);exit();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Accept: application/json'));

        curl_setopt($ch, CURLOPT_URL, $domain."/api/registration.json");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$jsondata);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);
        file_put_contents(JPATH_PLUGINS.'/system/intarget/log.txt',$server_output,FILE_APPEND);
        /*

        {"result":"OK","projectId":25}
        {"status":"error","code":500,"message":"Can't create project","payload":null}

        */

        $json_result = json_decode($server_output);
        if (isset($json_result->status)) {
            if (($json_result->status == 'OK') && (isset($json_result->payload))){
                if (isset($json_result->payload->projectId)) return $json_result->payload->projectId;
            } elseif ($json_result->status = 'error') {
                file_put_contents(JPATH_PLUGINS.'/system/intarget/error.txt',$json_result->code);
            }
        }
        curl_close ($ch);


    }

    public function testCurl(){
        $strSearch = 'joomla';
        $url = "http://www.google.com/search?q=".$strSearch."&hl=en&start=0&sa=N";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = curl_exec($ch);
        curl_close($ch);
        return   $response;
    }
    public function saveProjectIdToFile($projectId){
        file_put_contents(JPATH_PLUGINS.'/system/intarget/project.cfg', $projectId);
    }
    public function getProjectIdFromFile(){
        $projectId = file_get_contents(JPATH_PLUGINS.'/system/intarget/project.cfg');
        if (strlen($projectId) > 0 ) {
            return $projectId;
        } else return;
    }
    public function saveProjectId($projectId) {

        $params = $this->params;
        $params->set('projectId', $projectId);

        try
        {
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->update($db->quoteName('#__extensions'));
            $query->set($db->quoteName('params') . '= ' . $db->quote((string)$params));
            $query->where($db->quoteName('element') . ' = ' . $db->quote('intarget'));
            $query->where($db->quoteName('type') . ' = ' . $db->quote('plugin'));

            $db->setQuery($query);
            //echo $query; exit();
            $db->execute();
            //$db->setQuery($query);
            //$result = $db->loadResult();
        }
        catch (RuntimeException $e)
        {
            echo $e->getMessage(); exit();
        }



    }

}
