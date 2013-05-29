<?php
function wallstcnmobile_js_alter(&$scripts) {
    unset($scripts['sites/all/themes/wallstcn/js/bootstrap.min.js']);
}
function wallstcnmobile_css_alter(&$css) {
    unset($css['sites/all/themes/wallstcn/css/style.css']);
}
