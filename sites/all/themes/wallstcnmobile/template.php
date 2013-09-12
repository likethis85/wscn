<?php

function wallstcnmobile_html_head_alter(&$head_elements) {
    unset($head_elements['system_meta_generator']);
    $path =  current_path();
    if(false === is_numeric(str_replace('node/', '', $path))) {
        return false;
    }
    foreach($head_elements as $key => $element) {
        if($element['#tag'] == 'link' && $element['#attributes']['rel'] == 'canonical') {
            $head_elements[$key]['#attributes']['href'] = 'http://' . variable_get('site_domain') . '/' . $path;
        }
    }
}


function wallstcnmobile_js_alter(&$scripts) {
    unset($scripts['sites/all/themes/wallstcn/js/bootstrap.min.js']);
    unset($scripts['sites/all/themes/wallstcn/js/main.js']);
}
function wallstcnmobile_css_alter(&$css) {
    unset($css['sites/all/themes/wallstcn/css/style.css']);
}
