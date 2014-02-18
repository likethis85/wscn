<?php
$theme_wscn = array(
    'x_recommand_rendered' => false,
    'x_topnews_rendered' => false,
    'x_recent_rendered' => false,
    'x_click_rendered' => false,
    'x_comments_rendered' => false,
);


//drupal_theme_rebuild();
//system_rebuild_theme_data();
// Auto-rebuild the theme registry during theme development.
if (theme_get_setting('clear_registry')) {
    // Rebuild .info data.
    system_rebuild_theme_data();
    // Rebuild theme registry.
    drupal_theme_rebuild();
}

function wscn_tagmapping($tid) {
    $mapping = array(
        '7350' => 'america',
        '4' => 'economy',
        '7353' => 'centralbank',
        '3562' => 'breakfast',
        '7349' => 'europe',
        '7351' => 'china',
        '48' => 'market',
        '7354' => 'company',
    );
    if(isset($mapping[$tid])){
        return url($mapping[$tid]);
    }
    return url('taxonomy/term/' . $tid);
}

function wscn_image_domain($url){
    $img_domain = variable_get('site_image_domain_enable') ? variable_get('site_image_domain') : '';
    if($img_domain){
        $url = parse_url($url);
        $url['host'] = $img_domain;
        $query = isset($url['query']) ? $url['query'] : '';
        $url = 'http://' . $url['host'] . $url['path'] . $query;
    }
    return $url;
}

function wscn_image_url($item) {
    $url = '';
    if ($item->file_managed_field_data_upload_uri) {
        $url = file_create_url($item->file_managed_field_data_upload_uri);
    } elseif($item->field_field_image_1) {
        $url = file_create_url($item->field_field_image_1[0]['raw']['uri']);
    }

    if (isset($item->upload['und'][0]['filename'])) {
        $url = file_create_url('./sites/default/files/' . $item->upload['und'][0]['filename']);
    }


    return $url;
}

function wscn_is_channel() {
    $path = current_path();
    $path = explode('/', $path);
    $path = $path[0];

    $channels = array(
        'breakfast',
        'china',
        'europe',
        'america',
        'economy',
        'centralbank',
        'market',
        'company',
        'taxonomy',
    );
    if(in_array($path, $channels)) {
        return true;
    }
    return false;
}

function wallstcn_preprocess_html(&$variables) {
    $parameters = drupal_get_query_parameters();
    if(isset($parameters['page']) && $parameters['page'] > 0) {
        $variables['head_title_array']['title'] .= '_第' .  ($parameters['page'] + 1) . '页';
    }

    $variables['head_title'] = $variables['head_title_array']['title'] ?
        $variables['head_title_array']['title'] . '_' . $variables['head_title_array']['name']
        :  $variables['head_title_array']['name'] . '_' .  $variables['head_title_array']['slogan'];
}

function wallstcn_js_alter(&$javascript) {
    // Update jquery version for non-administration pages
    if (arg(0) != 'admin' && arg(0) != 'panels' && arg(0) != 'ctools') {
        $jquery_file = drupal_get_path('theme', 'wallstcn') . '/js/jquery-1.9.1.min.js';
        $jquery_version = '1.9.1';
        $migrate_file = drupal_get_path('theme', 'wallstcn') . '/js/jquery-migrate-1.1.1.min.js';
        $migrate_version = '1.1.1';
        $javascript['misc/jquery.js']['data'] = $jquery_file;
        $javascript['misc/jquery.js']['version'] = $jquery_version;
        $javascript['misc/jquery.js']['weight'] = 0;
        $javascript['misc/jquery.js']['group'] = -101;
        drupal_add_js($migrate_file);
        if (isset($javascript["$migrate_file"])) {
            $javascript["$migrate_file"]['version'] = $migrate_version;
            $javascript["$migrate_file"]['weight'] = 1;
            $javascript["$migrate_file"]['group'] = -101;
        }
    }
}

function wallstcn_menu_tree(&$variables) {
    return '<ul class="nav">' . $variables['tree'] . '</ul>';
}


function wallstcn_menu_link(array $variables) {
    $element = $variables['element'];
    $sub_menu = '';

    if ($element['#below']) {
        // Ad our own wrapper
        unset($element['#below']['#theme_wrappers']);
        $sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';
        $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
        $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';

        // Check if this element is nested within another
        if ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] > 1)) {
            // Generate as dropdown submenu
            $element['#attributes']['class'][] = 'dropdown-submenu';
        }
        else {
            // Generate as standard dropdown
            $element['#attributes']['class'][] = 'dropdown';
            $element['#localized_options']['html'] = TRUE;
            $element['#title'] .= '<span class="caret"></span>';
        }

        // Set dropdown trigger element to # to prevent inadvertant page loading with submenu click
        $element['#localized_options']['attributes']['data-target'] = '#';
    }

    $output = l($element['#title'], $element['#href'], $element['#localized_options']);
    return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}


/*
function wallstcn_form_alter(&$form, &$form_state, $form_id) {
    if ($form_id == 'search_block_form') {
        $form['search_block_form']['#title_display'] = 'invisible';
        $form['search_block_form']['#attributes']['class'][] = 'input-medium search-query';
        $form['search_block_form']['#attributes']['placeholder'] = t('Search this site...');
        $form['actions']['submit']['#attributes']['class'][] = 'btn-search';
        $form['actions']['submit']['#type'] = 'image_button';
        //$form['actions']['submit']['#src'] = drupal_get_path('theme', 'open_framework') . '/images/searchbutton.png';
    }
}
*/


function wallstcn_pager($variables) {
    $output = "";
    $tags = $variables['tags'];
    $element = $variables['element'];
    $parameters = $variables['parameters'];
    $quantity = $variables['quantity'];

    global $pager_page_array, $pager_total;

    // Calculate various markers within this pager piece:
    // Middle is used to "center" pages around the current page.
    $pager_middle = ceil($quantity / 2);
    // current is the page we are currently paged to
    $pager_current = $pager_page_array[$element] + 1;
    // first is the first page listed by this pager piece (re quantity)
    $pager_first = $pager_current - $pager_middle + 1;
    // last is the last page listed by this pager piece (re quantity)
    $pager_last = $pager_current + $quantity - $pager_middle;
    // max is the maximum page number
    $pager_max = $pager_total[$element];
    // End of marker calculations.

    // Prepare for generation loop.
    $i = $pager_first;
    if ($pager_last > $pager_max) {
        // Adjust "center" if at end of query.
        $i = $i + ($pager_max - $pager_last);
        $pager_last = $pager_max;
    }
    if ($i <= 0) {
        // Adjust "center" if at start of query.
        $pager_last = $pager_last + (1 - $i);
        $i = 1;
    }

    // End of generation loop preparation.
    $li_first = theme('pager_first', array('text' => (isset($tags[0]) ? $tags[0] : t('first')), 'element' => $element, 'parameters' => $parameters));
    $li_previous = theme('pager_previous', array('text' => (isset($tags[1]) ? $tags[1] : t('previous')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
    $li_next = theme('pager_next', array('text' => (isset($tags[3]) ? $tags[3] : t('next')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
    $li_last = theme('pager_last', array('text' => (isset($tags[4]) ? $tags[4] : t('last')), 'element' => $element, 'parameters' => $parameters));

    if ($pager_total[$element] > 1) {
        /*
        if ($li_first) {
            $items[] = array(
                'class' => array('pager-first'),
                'data' => $li_first,
            );
        }
        */
        if ($li_previous) {
            $items[] = array(
                'class' => array('prev'),
                'data' => $li_previous,
            );
        }

        // When there is more than one page, create the pager list.
        if ($i != $pager_max) {
            if ($i > 1) {
                $items[] = array(
                    'class' => array('pager-ellipsis', 'disabled'),
                    'data' => '<a>…</a>',
                );
            }
            // Now generate the actual pager piece.
            for (; $i <= $pager_last && $i <= $pager_max; $i++) {
                if ($i < $pager_current) {
                    $items[] = array(
                        // 'class' => array('pager-item'),
                        'data' => theme('pager_previous', array('text' => $i, 'element' => $element, 'interval' => ($pager_current - $i), 'parameters' => $parameters)),
                    );
                }
                if ($i == $pager_current) {
                    $items[] = array(
                        'class' => array('active'), // Add the active class
                        'data' => l($i, '#', array('fragment' => '','external' => TRUE)),
                    );
                }
                if ($i > $pager_current) {
                    $items[] = array(
                        //'class' => array('pager-item'),
                        'data' => theme('pager_next', array('text' => $i, 'element' => $element, 'interval' => ($i - $pager_current), 'parameters' => $parameters)),
                    );
                }
            }
            if ($i < $pager_max) {
                $items[] = array(
                    'class' => array('pager-ellipsis', 'disabled'),
                    'data' => '<a>…</a>',
                );
            }
        }
        // End generation.
        if ($li_next) {
            $items[] = array(
                'class' => array('next'),
                'data' => $li_next,
            );
        }
        /*
        if ($li_last) {
            $items[] = array(
                'class' => array('pager-last'),
                'data' => $li_last,
            );
        }
        */

        return '<div class="pagination pagination-centered">'. theme('item_list', array(
                'items' => $items,
                //'attributes' => array('class' => array('pager')),
            )) . '</div>';
    }

    return $output;
}

function wscn_get_image_thumbnail($url, $width, $height) {
    $url = str_ireplace('img.wallstreetcn.com', 'thumbnail.wallstreetcn.com/thumb', $url);

    $url_arr = explode('.', $url);

    $suffix = array_pop($url_arr);

    $new_url = implode('.', $url_arr) . ",c_fill,h_$height,w_$width" . '.' . $suffix;

    return $new_url;
}


function wscn_get_user_comments($uid) {

  $query = db_select('comment', 'c');
  $query->join('node', 'n', 'c.nid = n.nid');
  $query->condition('c.uid', $uid, '=');
  //$query->condition('n.type', '&lt;content-type&gt;', '=');
  //$query->condition('n.status', '1', '=');
  $query->condition('c.status', '1', '=');
  $query->addExpression('c.subject', 'subject');
  $query->addExpression('c.created', 'created');
  $query->addExpression('c.nid', 'nid');
  $query->addExpression('n.title', 'title');
  $query->orderBy('c.created', 'DESC');
  $result = $query->execute();
  if ($comments = $result->fetchAll())
        return $comments;

  return array();
}

function wscn_get_user_picture($uid) {

  $query = db_select('file_managed', 'f');
  $query->condition('f.uid', $uid, '=');
  $query->addExpression('filename', 'filename');
  $result = $query->execute();
  if ($row = $result->fetchAssoc())
        return $row;

  return array();
}

function wscn_get_node_totalcount($nid) {

  $query = db_select('node_counter', 'n');
  $query->condition('n.nid', $nid, '=');
  $query->addExpression('totalcount', 'totalcount');
  $result = $query->execute();

  $totalcount = 0;
  $row = $result->fetchAssoc();
  if (isset($row['totalcount'])) {
    return get_counter_totalcount($row['totalcount']);
  }
  return $totalcount;
}

function get_counter_totalcount ($number) {
    return round($number*2.1);
}


/*
function wallstcn_form_alter(&$form, &$form_state, $form_id) {
    // Id's of forms that should be ignored
    // Make this configurable?
    $form_ids = array(
        'node_form',
        'system_site_information_settings',
        'user_profile_form',
        'node_delete_confirm',
    );

    // Only wrap in container for certain form
    if (isset($form['#form_id']) && !in_array($form['#form_id'], $form_ids) && !isset($form['#node_edit_form'])) {
        $form['actions']['#theme_wrappers'] = array();
    }
}

function wallstcn_form_search_form_alter(&$form, &$form_state) {
    $form['#attributes']['class'][] = 'form-search';
    $form['#attributes']['class'][] = 'pull-left';

    $form['basic']['keys']['#title'] = '';
    $form['basic']['keys']['#attributes']['class'][] = 'search-query';
    $form['basic']['keys']['#attributes']['class'][] = 'span2';
    $form['basic']['keys']['#attributes']['placeholder'] = t('Search');

    // Hide the default button from display and implement a theme wrapper to add
    // a submit button containing a search icon directly after the input element.
    $form['basic']['submit']['#attributes']['class'][] = 'element-invisible';
    $form['basic']['keys']['#theme_wrappers'][] = 'bootstrap_search_form_wrapper';

    // Apply a clearfix so the results don't overflow onto the form.
    $form['#suffix'] = '<div class="clearfix"></div>';
    $form['#attributes']['class'][] = 'content-search';
}

function wallstcn_form_search_block_form_alter(&$form, &$form_state) {
    $form['#attributes']['class'][] = 'form-search';
    $form['#attributes']['class'][] = 'pull-left';

    $form['search_block_form']['#title'] = '';
    $form['search_block_form']['#attributes']['class'][] = 'search-query';
    $form['search_block_form']['#attributes']['class'][] = 'span2';
    $form['search_block_form']['#attributes']['placeholder'] = t('Search');

    // Hide the default button from display and implement a theme wrapper to add
    // a submit button containing a search icon directly after the input element.
    $form['actions']['submit']['#attributes']['class'][] = 'element-invisible';
    $form['search_block_form']['#theme_wrappers'][] = 'bootstrap_search_form_wrapper';

    // Apply a clearfix so the results don't overflow onto the form.
    $form['#attributes']['class'][] = 'content-search';
}

function wallstcn_form_element(&$variables) {
    $element = &$variables['element'];
    // This is also used in the installer, pre-database setup.
    $t = get_t();

    // This function is invoked as theme wrapper, but the rendered form element
    // may not necessarily have been processed by form_builder().
    $element += array(
        '#title_display' => 'before',
    );

    // Add element #id for #type 'item'.
    if (isset($element['#markup']) && !empty($element['#id'])) {
        $attributes['id'] = $element['#id'];
    }

    $exclude_control = FALSE;
    $control_wrapper = '<div class="controls">';
        // Add bootstrap class
        if (isset($element['#type']) && ($element['#type'] == "radio" || $element['#type'] == "checkbox")){
            $exclude_control = TRUE;
        }
        else {
            $attributes['class'] = array('control-group');
        }

        // Check for errors and set correct error class
        if (isset($element['#parents']) && form_get_error($element)) {
            $attributes['class'][] = 'error';
        }

        if (!empty($element['#type'])) {
            $attributes['class'][] = 'form-type-' . strtr($element['#type'], '_', '-');
        }
        if (!empty($element['#name'])) {
            $attributes['class'][] = 'form-item-' . strtr($element['#name'], array(' ' => '-', '_' => '-', '[' => '-', ']' => ''));
        }
        // Add a class for disabled elements to facilitate cross-browser styling.
        if (!empty($element['#attributes']['disabled'])) {
            $attributes['class'][] = 'form-disabled';
        }
        $attributes['class'][] = 'form-item';
        $output = '<div' . drupal_attributes($attributes) . '>' . "\n";

            // If #title is not set, we don't display any label or required marker.
            if (!isset($element['#title'])) {
                $element['#title_display'] = 'none';
            }
            $prefix = isset($element['#field_prefix']) ? '<span class="field-prefix">' . $element['#field_prefix'] . '</span> ' : '';
            $suffix = isset($element['#field_suffix']) ? ' <span class="field-suffix">' . $element['#field_suffix'] . '</span>' : '';

            // Prepare input whitelist - added to ensure ajax functions don't break
            $whitelist = _bootstrap_element_whitelist();

            switch ($element['#title_display']) {
                case 'before':
                case 'invisible':
                $output .= ' ' . theme('form_element_label', $variables);
                // Check if item exists in element whitelist
                if (isset($element['#id']) && in_array($element['#id'], $whitelist)) {
                    $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
                    $exclude_control = TRUE;
                }
                else {
                    $output = $exclude_control ? $output : $output.$control_wrapper;
                    $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
                }
                break;

                case 'after':
                $output = $exclude_control ? $output : $output.$control_wrapper;
                $variables['#children'] = ' ' . $prefix . $element['#children'] . $suffix;
                $output .= ' ' . theme('form_element_label', $variables) . "\n";
                break;

                case 'none':
                case 'attribute':
                // Output no label and no required marker, only the children.
                $output = $exclude_control ? $output : $output.$control_wrapper;
                $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
                break;
            }

            if ( !empty($element['#description']) ) {
                $output .= '<p class="help-block">' . $element['#description'] . "</p>\n";
            }

            // Check if control wrapper was added to ensure we close div correctly
            if ($exclude_control) {
                $output .= "</div>\n";
        }
        else {
            $output .= "</div></div>\n";
}
return $output;
}

function wallstcn_form_element_label(&$variables) {
    $element = $variables['element'];
    // This is also used in the installer, pre-database setup.
    $t = get_t();

    // If title and required marker are both empty, output no label.
    if ((!isset($element['#title']) || $element['#title'] === '') && empty($element['#required'])) {
        return '';
    }

    // If the element is required, a required marker is appended to the label.
    $required = !empty($element['#required']) ? theme('form_required_marker', array('element' => $element)) : '';

    $title = filter_xss_admin($element['#title']);

    $attributes = array();
    // Style the label as class option to display inline with the element.
    if ($element['#title_display'] == 'after') {
        $attributes['class'][] = 'option';
        $attributes['class'][] = $element['#type'];
    }
    // Show label only to screen readers to avoid disruption in visual flows.
    elseif ($element['#title_display'] == 'invisible') {
        $attributes['class'][] = 'element-invisible';
    }

    if (!empty($element['#id'])) {
        $attributes['for'] = $element['#id'];
    }

    // @Bootstrap: Add Bootstrap control-label class except for radio.
    if ($element['#type'] != 'radio') {
        $attributes['class'][] = 'control-label';
    }
    // @Bootstrap: Insert radio and checkboxes inside label elements.
    $output = '';
    if ( isset($variables['#children']) ) {
        $output .= $variables['#children'];
    }

    // @Bootstrap: Append label
    $output .= $t('!title !required', array('!title' => $title, '!required' => $required));

    // The leading whitespace helps visually separate fields from inline labels.
    return ' <label' . drupal_attributes($attributes) . '>' . $output . "</label>\n";
}

function wallstcn_preprocess_button(&$vars) {
    $vars['element']['#attributes']['class'][] = 'btn';

    if (isset($vars['element']['#value'])) {
        $classes = array(
            //specifics
            t('Save and add') => 'btn-info',
            t('Add another item') => 'btn-info',
            t('Add effect') => 'btn-primary',
            t('Add and configure') => 'btn-primary',
            t('Update style') => 'btn-primary',
            t('Download feature') => 'btn-primary',

            //generals
            t('Save') => 'btn-primary',
            t('Apply') => 'btn-primary',
            t('Create') => 'btn-primary',
            t('Confirm') => 'btn-primary',
            t('Submit') => 'btn-primary',
            t('Export') => 'btn-primary',
            t('Import') => 'btn-primary',
            t('Restore') => 'btn-primary',
            t('Rebuild') => 'btn-primary',
            t('Search') => 'btn-primary',
            t('Add') => 'btn-info',
            t('Update') => 'btn-info',
            t('Delete') => 'btn-danger',
            t('Remove') => 'btn-danger',
        );
        foreach ($classes as $search => $class) {
            if (strpos($vars['element']['#value'], $search) !== FALSE) {
                $vars['element']['#attributes']['class'][] = $class;
                break;
            }
        }
    }
}

function wallstcn_button($variables) {
    $element = $variables['element'];
    $label = $element['#value'];
    element_set_attributes($element, array('id', 'name', 'value', 'type'));

    $element['#attributes']['class'][] = 'form-' . $element['#button_type'];
    if (!empty($element['#attributes']['disabled'])) {
        $element['#attributes']['class'][] = 'form-button-disabled';
    }

    // Prepare input whitelist - added to ensure ajax functions don't break
    $whitelist = _bootstrap_element_whitelist();

    if (in_array($element['#id'], $whitelist)) {
        return '<input' . drupal_attributes($element['#attributes']) . ">\n"; // This line break adds inherent margin between multiple buttons
    }
    else {
        return '<button' . drupal_attributes($element['#attributes']) . '>'. $label ."</button>\n"; // This line break adds inherent margin between multiple buttons
    }
}
*/

function _bootstrap_element_whitelist() {
    /**
    * Why whitelist an element?
    * The reason is to provide a list of elements we wish to exclude
    * from certain modifications made by the bootstrap theme which
    * break core functionality - e.g. ajax.
    */
    return array(
        'edit-refresh',
        'edit-pass-pass1',
        'edit-pass-pass2',
        'panels-ipe-cancel',
        'panels-ipe-customize-page',
        'panels-ipe-save',
    );
}

function get_discovery_index_side_item() {
    $discovery = get_discovery_arr();

    $discovery_item  = array();
    // 这里加外部广告

    // 第9头条

    $topnews9_response = curl_get('http://www.topnews9.com/plus/api/wallstreetcn.php');
    $topnews9 = json_decode($topnews9_response, 1);
    if ($topnews9 !== false) {
        $topnews9 = array_shift($topnews9);
        $discovery_item[1] = array('title' => $topnews9['title'],
                                   'url'   => substr($topnews9['arcurl'], 7),
                                   'img'   => $topnews9['litpic'],
                                   'not_thumbnail' => true,
                             );
    }

    // pingwest
    $pingwest_response = curl_get('http://www.pingwest.com/feed/?f&b');
    if ($pingwest_response != '') {
        $pingwest_xml = simplexml_load_string($pingwest_response);
        if ($pingwest_xml !== false) {
            $pingwest_arr = @json_decode(@json_encode($pingwest_xml),1);
            $pingwest_item = $pingwest_arr['channel']['item'][0];
            $discovery_item[2] = array('title' => $pingwest_item['title'],
                                       'url'   => substr($pingwest_item['link'], 7),
                                       'img'   => trim($pingwest_item['img']),
                                       'not_thumbnail' => true,
                                 );
        }
    }

    // 亿邦动力
    $discovery_item[4] = array('title' => '腾讯未必生，阿里未必死',
                               'url'   => 'home.ebrun.com/blog-45526.html',
                               'img'   => 'http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_ebrun_20140128_1.jpg',
                         );
    // 搜房网

    $discovery_item[0] = array('title' => '中国房价坚不可摧的10大城市 买在这里一生无惧房地产泡沫',
                               'url'   =>'esf.tj.soufun.com/newsecond/news/11952156.htm?utm_source=tjhezuo&utm_medium=click&utm_term=mei&utm_content=esf&utm_campaign=hua',
                               'img'   => 'http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_soufun_3.jpeg',
                         );

    $discovery_item[5] = array('title' => '买房最后窗口期 房价坚不可摧的15个城市',
                               'url'   =>'esf.sh.soufun.com/newsecond/news/12075935.htm?utm_source=shhezuo&utm_medium=click&utm_term=lgq_sh&utm_content=shwalls&utm_campaign=20140212walls',
                               'img'   => 'http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__link_soufun_2.jpg',
                         );

    $numbers = range(0, 400);
    shuffle($numbers);

    $key  = array_slice($numbers, 0, 6);

    for ($i=0; $i<6; $i++) {
        if (isset($discovery_item[$i])) {
            continue;
        }

        $discovery_item[$i] = $discovery[$key[$i]];
    }
    ksort($discovery_item);
    return $discovery_item;
}

function get_discovery_discovery_side_item() {
    $discovery = get_discovery_arr();

    $discovery_item  = array();
    // 这里加外部广告

    // 第9头条
    $topnews9_response = curl_get('http://topnews9.com:82/plus/api/wallstreetcn.php');
    $topnews9 = json_decode($topnews9_response, 1);
    if ($topnews9 !== false) {
        array_shift($topnews9);
        $topnews9_1 = array_shift($topnews9);
        $topnews9_2 = array_shift($topnews9);
        $discovery_item[0] = array('title' => $topnews9_1['title'],
                                   'url'   => substr($topnews9_1['arcurl'], 7),
                                   'img'   => $topnews9_1['litpic'],
                                   'not_thumbnail' => true,
                             );

        $discovery_item[1] = array('title' => $topnews9_2['title'],
                                   'url'   => substr($topnews9_2['arcurl'], 7),
                                   'img'   => $topnews9_2['litpic'],
                                   'not_thumbnail' => true,
                             );
    }


    $numbers = range(0, 400);
    shuffle($numbers);

    $key  = array_slice($numbers, 0, 6);

    for ($i=0; $i<6; $i++) {
        if (isset($discovery_item[$i])) {
            continue;
        }

        $discovery_item[$i] = $discovery[$key[$i]];
    }
    ksort($discovery_item);
    return $discovery_item;
}

function curl_get($url, $timeout=3) {
    $ch = curl_init($url) ;
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ;
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ;
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    $response = curl_exec($ch) ;

    if($response === false) {
        //$error = curl_error($ch);
        return '';
    }
    return $response;
}



function get_discovery_item() {
    $discovery = get_discovery_arr();

    $discovery_item  = array();
    // 这里加外部广告
    $discovery_item[0] = array('title' => '2014年中国房地产行业政策趋向分析',
                               'url'   =>'www.qianzhan.com/indynews/detail/214/140115-de4bf39a.html',
                               'img'   => 'http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_qianzhan_1.jpg',
                         );

    $discovery_item[1] = array('title' => '为什么牛逼互联网公司都在开曼群岛注册？',
                               'url'   =>'new.iheima.com/detail/2014/0212/58584.html',
                               'img'   => 'http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__link_iheima_1.png',
                         );


    $discovery_item[2] = array('title' => '创业启示录：25个创业失败案例的分析',
                               'url'   =>'blog.jobbole.com/275/',
                               'img'   => 'http://img.wallstreetcn.com/sites/all/themes/wallstcn/ads/__ads_wscn_index_jobbole_1.jpg',
                         );


    $numbers = range(0, 400);
    shuffle($numbers);

    $key  = array_slice($numbers, 0, 6);

    for ($i=0; $i<6; $i++) {
        if (isset($discovery_item[$i])) {
            continue;
        }

        $discovery_item[$i] = $discovery[$key[$i]];
    }
    ksort($discovery_item);
    return $discovery_item;
}


function get_discovery_arr() {
    return array(
        array("title"=>"Gregor Macdonald：黄金、石油和美元的未来（之黄金篇）","url"=>"wallstreetcn.com/node/19233","img"=>"http://img.wallstreetcn.com/sites/default/files/201210171124.jpg"),
        array("title"=>"中国江苏陷入债务噩梦？","url"=>"wallstreetcn.com/node/51034","img"=>"http://img.wallstreetcn.com/sites/default/files/main_banner_00322333221111.jpg"),
        array("title"=>"全球至少500台超级计算机都被用来比特币挖矿","url"=>"wallstreetcn.com/node/64643","img"=>"http://img.wallstreetcn.com/sites/default/files/20131122ku-xlarge.jpg"),
        array("title"=>"伦敦鲸的覆灭-摩根大通巨亏全解析（1）","url"=>"wallstreetcn.com/node/13913","img"=>"http://img.wallstreetcn.com/sites/default/files/201205111140.jpg"),
        array("title"=>"铜融资时代的终结是中国的雷曼时刻？","url"=>"wallstreetcn.com/node/25187","img"=>"http://img.wallstreetcn.com/sites/default/files/tck01a.jpg"),
        array("title"=>"2013年伯克希尔股东大会直播：倾听巴菲特和芒格","url"=>"wallstreetcn.com/node/24506","img"=>"http://img.wallstreetcn.com/sites/default/files/livebuffett1.jpg"),
        array("title"=>"高盛奥尼尔：中国股市怎么了？","url"=>"wallstreetcn.com/node/17806","img"=>"http://img.wallstreetcn.com/sites/default/files/123214343242334234.jpg"),
        array("title"=>"一笔赚钱的生意：走私宝马到中国","url"=>"wallstreetcn.com/node/66147","img"=>"http://img.wallstreetcn.com/sites/default/files/20131203bmw.jpg"),
        array("title"=>"Gregor Macdonald：黄金、石油和美元的未来（之石油篇）","url"=>"wallstreetcn.com/node/19314","img"=>"http://img.wallstreetcn.com/sites/default/files/201210212101.jpeg"),
        array("title"=>"摩根士丹利：8张图掌握中国经济运行现状","url"=>"wallstreetcn.com/node/25315","img"=>"http://img.wallstreetcn.com/sites/default/files/mogenshidanli1111111111111.jpg"),
        array("title"=>"二十年内，中国将成为第二个日本","url"=>"wallstreetcn.com/node/64892","img"=>"http://img.wallstreetcn.com/sites/default/files/screen shot 2013-11-24 at 8.47.23 pm.png"),
        array("title"=>"彭博社：中国熊市吸引国际资金抄底","url"=>"wallstreetcn.com/node/17138","img"=>"http://img.wallstreetcn.com/sites/default/files/20120815shanghaiequity.jpg"),
        array("title"=>"朝鲜向中国出售大量黄金 或意味着严重的经济崩溃","url"=>"wallstreetcn.com/node/67556","img"=>"http://img.wallstreetcn.com/sites/default/files/20131211chaoxian.jpg"),
        array("title"=>"高盛高管纽约时报辞职信全文：我为什么离开高盛？","url"=>"wallstreetcn.com/node/11749","img"=>"http://img.wallstreetcn.com/sites/default/files/0314goldman.jpg"),
        array("title"=>"法兴解释中国的钱流向了哪里","url"=>"wallstreetcn.com/node/25356","img"=>"http://img.wallstreetcn.com/sites/default/files/China-debt-crisis-581x435.jpg"),
        array("title"=>"解读中国式光大银行违约传闻","url"=>"wallstreetcn.com/node/25630","img"=>"http://img.wallstreetcn.com/sites/default/files/20130402022538496.jpg"),
        array("title"=>"索罗斯教给你的十二大投资真理","url"=>"wallstreetcn.com/node/51939","img"=>"http://img.wallstreetcn.com/sites/default/files/20130804george soros.jpg"),
        array("title"=>"中国房地产价格泡沫卷土重来","url"=>"wallstreetcn.com/node/57300","img"=>"http://img.wallstreetcn.com/sites/default/files/房价0.jpg"),
        array("title"=>"再见石油美元、你好农业美元","url"=>"wallstreetcn.com/node/20137","img"=>"http://img.wallstreetcn.com/sites/default/files/201211251537.jpg"),
        array("title"=>"FT/高盛2012年度商业类书籍名单","url"=>"wallstreetcn.com/node/16923","img"=>"http://img.wallstreetcn.com/sites/default/files/201208092025-guoguo.jpg"),
        array("title"=>"中国的钱去了哪里？","url"=>"wallstreetcn.com/node/24466","img"=>"http://img.wallstreetcn.com/sites/default/files/money123.jpg"),
        array("title"=>"高盛：图解大宗商品基本面","url"=>"wallstreetcn.com/node/50554","img"=>"http://img.wallstreetcn.com/sites/default/files/201307180851.jpg"),
        array("title"=>"【见闻访谈】ACM陈凯丰（一）：奥巴马连任长期将不利于美国经济","url"=>"wallstreetcn.com/node/19705","img"=>"http://img.wallstreetcn.com/sites/default/files/wallsttalk.jpg"),
        array("title"=>"花旗：战争效应","url"=>"wallstreetcn.com/node/54683","img"=>"http://img.wallstreetcn.com/sites/default/files/asset20130829190542.jpg"),
        array("title"=>"分析师点评央行利率市场化改革：影响有限，期待存款利率放开","url"=>"wallstreetcn.com/node/50534","img"=>"http://img.wallstreetcn.com/sites/default/files/201307180836.jpg"),
        array("title"=>"华尔街人必读的22本金融佳作","url"=>"wallstreetcn.com/node/67107","img"=>"http://img.wallstreetcn.com/sites/default/files/five-books-you-should-read-before-you-turn-30.jpg"),
        array("title"=>"罗奇：中美央行如今站在同一条道路上","url"=>"wallstreetcn.com/node/48500","img"=>"http://img.wallstreetcn.com/sites/default/files/201306270843.jpg"),
        array("title"=>"激辩中国铜融资","url"=>"wallstreetcn.com/node/25370","img"=>"http://img.wallstreetcn.com/sites/default/files/201306011203.jpg"),
        array("title"=>"BI：投资必看的67张图表（一）","url"=>"wallstreetcn.com/node/16129","img"=>"http://img.wallstreetcn.com/sites/default/files/2012717图表1.jpg"),
        array("title"=>"Icahn VS.Ackman：金融电视节目史上最伟大口水战（上）","url"=>"wallstreetcn.com/node/21798","img"=>"http://img.wallstreetcn.com/sites/default/files/201301270913.jpg"),
        array("title"=>"关于投资的50个真相（上）","url"=>"wallstreetcn.com/node/65690","img"=>"http://img.wallstreetcn.com/sites/default/files/20131129wall-street-1987-1.jpg"),
        array("title"=>"神交易：今年如何将1000变成2640亿","url"=>"wallstreetcn.com/node/68447","img"=>"http://img.wallstreetcn.com/sites/default/files/42446360.jpeg"),
        array("title"=>"【疯狂的比特币】比特币大亨：温克莱沃斯兄弟","url"=>"wallstreetcn.com/node/23802","img"=>"http://img.wallstreetcn.com/sites/default/files/winklevii443235.jpg"),
        array("title"=>"赌徒和交易员的相似之处","url"=>"wallstreetcn.com/node/24302","img"=>"http://img.wallstreetcn.com/sites/default/files/QQ截图20130427171711.jpg"),
        array("title"=>"高盛百张图表解析美国经济（一）：消费、支出现状分析及展望","url"=>"wallstreetcn.com/node/17305","img"=>"http://img.wallstreetcn.com/sites/default/files/001.JPG"),
        array("title"=>"克强经济学：三大支柱与朱镕基","url"=>"wallstreetcn.com/node/48322","img"=>"http://img.wallstreetcn.com/sites/default/files/201306270824.jpg"),
        array("title"=>"你不应错过的十八大经济纪录片：有视频有真相","url"=>"wallstreetcn.com/node/19320","img"=>"http://img.wallstreetcn.com/sites/default/files/20121022economy documentary.jpg"),
        array("title"=>"香港经济：暴风雨前的宁静","url"=>"wallstreetcn.com/node/63826","img"=>"http://img.wallstreetcn.com/sites/default/files/hong-kong-storm.jpg"),
        array("title"=>"雷•达里奥（Ray Dalio）——对冲基金教父的人生“禅”（上）","url"=>"wallstreetcn.com/node/21871","img"=>"http://img.wallstreetcn.com/sites/default/files/raydalio0130.jpg"),
        array("title"=>"【中国经济样本之三】鄂尔多斯：中国最富的城市在找钱","url"=>"wallstreetcn.com/node/16936","img"=>"http://img.wallstreetcn.com/sites/default/files/ajtb.jpg"),
        array("title"=>"史上最大的庞氏骗局——美元的故事","url"=>"wallstreetcn.com/node/48169","img"=>"http://img.wallstreetcn.com/sites/default/files/ponzi-dollar-shrinked.jpg"),
        array("title"=>"残酷的世界——前私人银行家揭秘投行生活（上）","url"=>"wallstreetcn.com/node/57490","img"=>"http://img.wallstreetcn.com/sites/default/files/touhangshenghuo218731978239.jpg"),
        array("title"=>"【中国经济样本之二】杭州：担保圈火烧连营","url"=>"wallstreetcn.com/node/16940","img"=>"http://img.wallstreetcn.com/sites/default/files/56261.jpeg"),
        array("title"=>"读懂日本债务谜团（上）","url"=>"wallstreetcn.com/node/17334","img"=>"http://img.wallstreetcn.com/sites/default/files/QQ截图20120821133035.jpg"),
        array("title"=>"【中国经济样本之一】郑州：担保狂城","url"=>"wallstreetcn.com/node/16941","img"=>"http://img.wallstreetcn.com/sites/default/files/51864.jpeg"),
        array("title"=>"图示全球黄金开采成本","url"=>"wallstreetcn.com/node/25208","img"=>"http://img.wallstreetcn.com/sites/default/files/20130527cost mining gold1.jpg"),
        array("title"=>"GMO白皮书：中国信贷全景图（一）","url"=>"wallstreetcn.com/node/21691","img"=>"http://img.wallstreetcn.com/sites/default/files/201301231025.jpg"),
        array("title"=>"全球央行创纪录的“美债大逃亡”","url"=>"wallstreetcn.com/node/48485","img"=>"http://img.wallstreetcn.com/sites/default/files/U1396P167T1D10728F5DT20050909174707.jpg"),
        array("title"=>"以史为鉴：94年金融市场波动给今天带来的教训","url"=>"wallstreetcn.com/node/25827","img"=>"http://img.wallstreetcn.com/sites/default/files/fed1232222.jpg"),
        array("title"=>"一张图列示16.8万亿美债持有人分布","url"=>"wallstreetcn.com/node/59616","img"=>"http://img.wallstreetcn.com/sites/default/files/QQ图片20131012142718.jpg"),
        array("title"=>"不为夺伊石油？密件披露美国发动伊拉克战争真正企图","url"=>"wallstreetcn.com/node/23459","img"=>"http://img.wallstreetcn.com/sites/default/files/20130401iraq war .jpg"),
        array("title"=>"罗杰斯：全球储户正被血洗 警告各国央行勿致历史大动荡","url"=>"wallstreetcn.com/node/22818","img"=>"http://img.wallstreetcn.com/sites/default/files/rogers-jim.sisss_.jpg"),
        array("title"=>"各国黄金储备最新排行榜","url"=>"wallstreetcn.com/node/15810","img"=>"http://img.wallstreetcn.com/sites/default/files/20120710gold.jpg"),
        array("title"=>"GMO白皮书：中国信贷全景图（三）-影子银行","url"=>"wallstreetcn.com/node/21806","img"=>"http://img.wallstreetcn.com/sites/default/files/201301271932.jpeg"),
        array("title"=>"逆天的Dalio（一）——全天候交易策略","url"=>"wallstreetcn.com/node/21796","img"=>"http://img.wallstreetcn.com/sites/default/files/ray dalio111_0.jpg"),
        array("title"=>"趋势大逆转：资本正在流出中国","url"=>"wallstreetcn.com/node/17108","img"=>"http://img.wallstreetcn.com/sites/default/files/20120815flow.jpg"),
        array("title"=>"ESM指引：史上最全面ESM介绍","url"=>"wallstreetcn.com/node/18805","img"=>"http://img.wallstreetcn.com/sites/default/files/20121002ESM.jpg"),
        array("title"=>"MFI：一张图详析中国第三轮改革逻辑体系","url"=>"wallstreetcn.com/node/51340","img"=>"http://img.wallstreetcn.com/sites/default/files/gaigeluojitu1298198248 - 副本.jpeg"),
        array("title"=>"美银美林：解密人民币套利","url"=>"wallstreetcn.com/node/25149","img"=>"http://img.wallstreetcn.com/sites/default/files/20130524USD CNY.jpg"),
        array("title"=>"交易员的奢靡生活","url"=>"wallstreetcn.com/node/24524","img"=>"http://img.wallstreetcn.com/sites/default/files/20130506banker benefits.jpg"),
        array("title"=>"中国的流动性风险之二：影子银行","url"=>"wallstreetcn.com/node/16732","img"=>"http://img.wallstreetcn.com/sites/default/files/2012.0803.1552.jpg"),
        array("title"=>"经济学人：16%的富人已离开中国 ，44%的正准备离开","url"=>"wallstreetcn.com/node/16994","img"=>"http://img.wallstreetcn.com/sites/default/files/20120804_CND001_0.jpeg"),
        array("title"=>"日本——下一场全球金融危机的发源地","url"=>"wallstreetcn.com/node/21317","img"=>"http://img.wallstreetcn.com/sites/default/files/20130110japan.jpg"),
        array("title"=>"三大策略教你如何从泡沫中获利","url"=>"wallstreetcn.com/node/60506","img"=>"http://img.wallstreetcn.com/sites/default/files/20131020bubble.jpg"),
        array("title"=>"【投资大佬经验谈系列】Gerald Loeb的市场智慧","url"=>"wallstreetcn.com/node/24108","img"=>"http://img.wallstreetcn.com/sites/default/files/20130422GeraldLoeb.jpg"),
        array("title"=>"关于投资的50个真相（下）","url"=>"wallstreetcn.com/node/65762","img"=>"http://img.wallstreetcn.com/sites/default/files/20131130truth.jpg"),
        array("title"=>"谢国忠：全球经济面临比08年更大的泡沫","url"=>"wallstreetcn.com/node/63000","img"=>"http://img.wallstreetcn.com/sites/default/files/jp-morgan-bubbles-cartoon.jpg"),
        array("title"=>"美国天然气出口的问题","url"=>"wallstreetcn.com/node/17074","img"=>"http://img.wallstreetcn.com/sites/default/files/MI-BQ594A_LNGHE_NS_20120812173916.jpg"),
        array("title"=>"美联储永远不会告诉你的一个QE3动因——人民币","url"=>"wallstreetcn.com/node/17333","img"=>"http://img.wallstreetcn.com/sites/default/files/20120821RMB.jpg"),
        array("title"=>"无处不在的办公室政治——前私人银行家揭秘投行生活（中）","url"=>"wallstreetcn.com/node/57539","img"=>"http://img.wallstreetcn.com/sites/default/files/bangonghsizhengzhi91237126383.jpg"),
        array("title"=>"伯南克普林斯顿毕业典礼演讲：给他们点颜色看看！！","url"=>"wallstreetcn.com/node/25393","img"=>"http://img.wallstreetcn.com/sites/default/files/201306022155.jpg"),
        array("title"=>"下一个避险天堂：德国房地产","url"=>"wallstreetcn.com/node/17083","img"=>"http://img.wallstreetcn.com/sites/default/files/20120814GM.jpg"),
        array("title"=>"摩根士丹利八图解读中国经济最热点","url"=>"wallstreetcn.com/node/48803","img"=>"http://img.wallstreetcn.com/sites/default/files/20130703china.jpg"),
        array("title"=>"高盛：中国信贷泡沫全景图","url"=>"wallstreetcn.com/node/19693","img"=>"http://img.wallstreetcn.com/sites/default/files/20111106China Corporate Debt GS.jpg"),
        array("title"=>"伯南克公开课第一节：“美联储与金融危机”","url"=>"wallstreetcn.com/node/12220","img"=>"http://img.wallstreetcn.com/sites/default/files/QQ截图201203211627592.png"),
        array("title"=>"意大利：下一个日本","url"=>"wallstreetcn.com/node/57576","img"=>"http://img.wallstreetcn.com/sites/default/files/2013090520713.jpg"),
        array("title"=>"美国学生贷款泡沫","url"=>"wallstreetcn.com/node/16942","img"=>"http://img.wallstreetcn.com/sites/default/files/20120810021439-5A8.jpg"),
        array("title"=>"Wilbur Ross：希腊局势比你想象的要糟","url"=>"wallstreetcn.com/node/17090","img"=>"http://img.wallstreetcn.com/sites/default/files/ross814.jpg"),
        array("title"=>"九张图秒懂中国现状","url"=>"wallstreetcn.com/node/50870","img"=>"http://img.wallstreetcn.com/sites/default/files/中国_0.jpg"),
        array("title"=>"世界金融大牛的网络论战——索罗斯 Vs. Sinn","url"=>"wallstreetcn.com/node/24743","img"=>"http://img.wallstreetcn.com/sites/default/files/U23VSL.jpg"),
        array("title"=>"如何理解商品巨头持有仓储业务的逻辑","url"=>"wallstreetcn.com/node/50748","img"=>"http://img.wallstreetcn.com/sites/default/files/201307111727_2.jpg"),
        array("title"=>"李迅雷：房地产泡沫必破 并将引爆金融危机","url"=>"wallstreetcn.com/node/62421","img"=>"http://img.wallstreetcn.com/sites/default/files/201310140839_2.jpg"),
        array("title"=>"谢国忠：套利交易支撑资产泡沫，改革核心应是政府职能转变","url"=>"wallstreetcn.com/node/64699","img"=>"http://img.wallstreetcn.com/sites/default/files/images (1)_3.jpeg"),
        array("title"=>"图解全球经济杠杆循环","url"=>"wallstreetcn.com/node/65510","img"=>"http://img.wallstreetcn.com/sites/default/files/2B{DFU4PZLZEEDC]{5{)8RY.jpg"),
        array("title"=>"花旗：油价在今年已经见顶","url"=>"wallstreetcn.com/node/51168","img"=>"http://img.wallstreetcn.com/sites/default/files/QQ截图20130727111943.jpg"),
        array("title"=>"中国疯狂囤积黄金的真相","url"=>"wallstreetcn.com/node/18007","img"=>"http://img.wallstreetcn.com/sites/default/files/201209080gold.jpg"),
        array("title"=>"高盛图表：全球货币战争战况","url"=>"wallstreetcn.com/node/18905","img"=>"http://img.wallstreetcn.com/sites/default/files/20121007moneywar.jpg"),
        array("title"=>"资产泡沫之美国页岩气狂潮（一）","url"=>"wallstreetcn.com/node/19516","img"=>"http://img.wallstreetcn.com/sites/default/files/201210291347.jpg"),
        array("title"=>"【见闻访谈】ACM合伙人（五）：日元贬值空间不大，大宗商品大势已去 ","url"=>"wallstreetcn.com/node/23253","img"=>"http://img.wallstreetcn.com/sites/default/files/201303240853.jpg"),
        array("title"=>"BATS：金融战的牺牲品？","url"=>"wallstreetcn.com/node/12927","img"=>"http://img.wallstreetcn.com/sites/default/files/201204041454.png"),
        array("title"=>"摩根士丹利：2013年17大宏观黑天鹅","url"=>"wallstreetcn.com/node/20716","img"=>"http://img.wallstreetcn.com/sites/default/files/201212170829.jpg"),
        array("title"=>"交易员学堂第一课 我们倒卖风险（下）","url"=>"wallstreetcn.com/node/14658","img"=>"http://img.wallstreetcn.com/sites/default/files/wayofturtle.jpg"),
        array("title"=>"交易员学堂第二课 一动感情，你就输了（上）","url"=>"wallstreetcn.com/node/14785","img"=>"http://img.wallstreetcn.com/sites/default/files/201206101051.jpg"),
        array("title"=>"BI：全球最重要的100张图表（一）","url"=>"wallstreetcn.com/node/59564","img"=>"http://img.wallstreetcn.com/sites/default/files/most-important-charts-in-the-world.jpg"),
        array("title"=>"成为交易员，你需要做哪些准备？","url"=>"wallstreetcn.com/node/15765","img"=>"http://img.wallstreetcn.com/sites/default/files/201207072124.jpg"),
        array("title"=>"选择的错觉：十大公司控制着我们的生活","url"=>"wallstreetcn.com/node/64862","img"=>"http://img.wallstreetcn.com/sites/default/files/图_0.jpg"),
        array("title"=>"天网战争：骑士资本陨落始末","url"=>"wallstreetcn.com/node/16721","img"=>"http://img.wallstreetcn.com/sites/default/files/201208031102.jpg"),
        array("title"=>"高盛：八大可能改变世界的领域","url"=>"wallstreetcn.com/node/52709","img"=>"http://img.wallstreetcn.com/sites/default/files/201308110916.jpg"),
        array("title"=>"疯狂的比特币——关于比特币你需要知道的一切","url"=>"wallstreetcn.com/node/64080","img"=>"http://img.wallstreetcn.com/sites/default/files/20131119bitheji.jpg"),
        array("title"=>"华尔街菜鸟们的成功秘诀","url"=>"wallstreetcn.com/node/50030","img"=>"http://img.wallstreetcn.com/sites/default/files/无标题.jpg"),
        array("title"=>"一张图告诉你十大投行最赚钱业务","url"=>"wallstreetcn.com/node/24262","img"=>"http://img.wallstreetcn.com/sites/default/files/investingbank897897副本.jpg"),
        array("title"=>"【经济学人看中国】房价要稳，不会崩盘；地方债增，没啥危险","url"=>"wallstreetcn.com/node/16755","img"=>"http://img.wallstreetcn.com/sites/default/files/20120728_CND001_0 拷贝.jpg"),
        array("title"=>"华尔街交易员热传的一张图","url"=>"wallstreetcn.com/node/64746","img"=>"http://img.wallstreetcn.com/sites/default/files/screen shot 2013-11-22 at 5.43.20 am.png"),
        array("title"=>"贝莱德：白银与黄金投资的三大重要区别","url"=>"wallstreetcn.com/node/51940","img"=>"http://img.wallstreetcn.com/sites/default/files/20130226gold_0.jpg"),
        array("title"=>"对冲基金大佬谈最新投资心得","url"=>"wallstreetcn.com/node/25752","img"=>"http://img.wallstreetcn.com/sites/default/files/W020130302259419141124.jpg"),
        array("title"=>"索罗斯：日本这么搞“很危险”","url"=>"wallstreetcn.com/node/23577","img"=>"http://img.wallstreetcn.com/sites/default/files/201304030735.jpg"),
        array("title"=>"GMO白皮书：中国信贷全景图（完结篇）","url"=>"wallstreetcn.com/node/21994","img"=>"http://img.wallstreetcn.com/sites/default/files/201301231028.jpg"),
        array("title"=>"利率飙升，中国债券市场面临质变？","url"=>"wallstreetcn.com/node/62982","img"=>"http://img.wallstreetcn.com/sites/default/files/2013091420356.jpg"),
        array("title"=>"为什么黄金创30年来最大跌幅？多空分析大全","url"=>"wallstreetcn.com/node/23935","img"=>"http://img.wallstreetcn.com/sites/default/files/20130416gold crash.jpg"),
        array("title"=>"人民币可能已经升值过快过多？","url"=>"wallstreetcn.com/node/48965","img"=>"http://img.wallstreetcn.com/sites/default/files/19351783.jpg"),
        array("title"=>"Icahn VS.Ackman：金融电视节目史上最伟大口水战（下）","url"=>"wallstreetcn.com/node/21801","img"=>"http://img.wallstreetcn.com/sites/default/files/201301270914.jpg"),
        array("title"=>"WSJ：朝鲜冰毒泛滥，40-50%成年人成瘾","url"=>"wallstreetcn.com/node/54148","img"=>"http://img.wallstreetcn.com/sites/default/files/chaoxianduping9018289319821983.jpg"),
        array("title"=>"BI：华尔街的19大经济学家","url"=>"wallstreetcn.com/node/18463","img"=>"http://img.wallstreetcn.com/sites/default/files/20120909221010.jpg"),
        array("title"=>"Byron Wien：我刚去了中国，情况不容乐观","url"=>"wallstreetcn.com/node/49839","img"=>"http://img.wallstreetcn.com/sites/default/files/byron-wien.jpg"),
        array("title"=>" 论苹果债与中石油","url"=>"wallstreetcn.com/node/25918","img"=>"http://img.wallstreetcn.com/sites/default/files/201306210850.jpg"),
        array("title"=>"关于马里奥的英雄传说","url"=>"wallstreetcn.com/node/15451","img"=>"http://img.wallstreetcn.com/sites/default/files/201206281032.jpg"),
        array("title"=>"GMO：当下的中国，投资者的墓地","url"=>"wallstreetcn.com/node/52197","img"=>"http://img.wallstreetcn.com/sites/default/files/墓地.jpg"),
        array("title"=>" 全球投资者从中国股市撤资创2008年以来最高 ","url"=>"wallstreetcn.com/node/48946","img"=>"http://img.wallstreetcn.com/sites/default/files/201307040748.jpg"),
        array("title"=>"两百万年一遇的“黄金黑天鹅”","url"=>"wallstreetcn.com/node/23909","img"=>"http://img.wallstreetcn.com/sites/default/files/Gold-price-vol-590x404.jpg"),
        array("title"=>"美银美林：“全世界最重要的一张图表”","url"=>"wallstreetcn.com/node/17261","img"=>"http://img.wallstreetcn.com/sites/default/files/20120819chart.jpg"),
        array("title"=>"一张图解释中国的美元短缺","url"=>"wallstreetcn.com/node/17166","img"=>"http://img.wallstreetcn.com/sites/default/files/20120816pbc.jpg"),
        array("title"=>"中国的流动性风险之一：资本外流","url"=>"wallstreetcn.com/node/16678","img"=>"http://img.wallstreetcn.com/sites/default/files/201208021116-guoguo.jpg"),
        array("title"=>"那些在华尔街学到的事儿","url"=>"wallstreetcn.com/node/49138","img"=>"http://img.wallstreetcn.com/sites/default/files/wall_street_2.jpg"),
        array("title"=>"德银：全球市场的中国地位","url"=>"wallstreetcn.com/node/51178","img"=>"http://img.wallstreetcn.com/sites/default/files/201307280900.jpg"),
        array("title"=>"漫步金融街---回顾金融市场200年（一）","url"=>"wallstreetcn.com/node/17300","img"=>"http://img.wallstreetcn.com/sites/default/files/QQ截图20120820231437.jpg"),
        array("title"=>"全面剖析美联储潜在新工具的“前世今生”","url"=>"wallstreetcn.com/node/54901","img"=>"http://img.wallstreetcn.com/sites/default/files/bernanke-titanic-cartoon.jpg"),
        array("title"=>"交易员学堂第三课 海龟交易法则：如何避免赌徒心态？","url"=>"wallstreetcn.com/node/15044","img"=>"http://img.wallstreetcn.com/sites/default/files/dl20110120710000852191.jpg"),
        array("title"=>"为什么大多数投机者的结局总是失败？","url"=>"wallstreetcn.com/node/58743","img"=>"http://img.wallstreetcn.com/sites/default/files/chenggong.jpg"),
        array("title"=>"美联储通讯社：为啥伯南克恨“Tapering”这个词儿","url"=>"wallstreetcn.com/node/25633","img"=>"http://img.wallstreetcn.com/sites/default/files/QQ截图201306111657253344543.jpg"),
        array("title"=>"【见闻2013年投资展望】ACM陈凯丰：美股一季度或有大跌 明年不看好大宗商品 ","url"=>"wallstreetcn.com/node/20884","img"=>"http://img.wallstreetcn.com/sites/default/files/shutterstock_67628746.jpg"),
        array("title"=>"华尔街面试系列之一：高盛的12条黄金法则","url"=>"wallstreetcn.com/node/61275","img"=>"http://img.wallstreetcn.com/sites/default/files/lloyd-blankfein-19.png_.jpeg"),
        array("title"=>"席勒谈中国房价的“非理性繁荣”：100年全部工作收入才能买套房子","url"=>"wallstreetcn.com/node/59830","img"=>"http://img.wallstreetcn.com/sites/default/files/robert-shiller.top1015.jpg"),
        array("title"=>"穆迪：中国影子银行体系","url"=>"wallstreetcn.com/node/24807","img"=>"http://img.wallstreetcn.com/sites/default/files/201305141013.jpg"),
        array("title"=>"2014年最热门的12大高薪职业","url"=>"wallstreetcn.com/node/68030","img"=>"http://img.wallstreetcn.com/sites/default/files/Img358995950.jpg"),
        array("title"=>"10件最影响下半年全球经济的事情","url"=>"wallstreetcn.com/node/17283","img"=>"http://img.wallstreetcn.com/sites/default/files/cnceo_com1198033986207.jpg"),
        array("title"=>"美国参议院通过移民政策修订案 一张图详解如何根据新法案拿绿卡","url"=>"wallstreetcn.com/node/48428","img"=>"http://img.wallstreetcn.com/sites/default/files/immigration11111111111111.jpg"),
        array("title"=>"华尔街面试系列之二：最让人抓狂的面试题","url"=>"wallstreetcn.com/node/61284","img"=>"http://img.wallstreetcn.com/sites/default/files/exam-stress.jpg"),
        array("title"=>"高盛：黄金与原油的成本曲线","url"=>"wallstreetcn.com/node/24059","img"=>"http://img.wallstreetcn.com/sites/default/files/oil-gold_1867604c.jpg"),
        array("title"=>"交易员成长之路","url"=>"wallstreetcn.com/node/20833","img"=>"http://img.wallstreetcn.com/sites/default/files/ksdfldsk123.jpeg"),
        array("title"=>"美国步入拼爹时代？","url"=>"wallstreetcn.com/node/20809","img"=>"http://img.wallstreetcn.com/sites/default/files/image001.jpg"),
        array("title"=>"华尔街交易员痴迷于技术分析背后隐含的哲学","url"=>"wallstreetcn.com/node/59635","img"=>"http://img.wallstreetcn.com/sites/default/files/new-york-stock-exchange-trader-computer-charts-5.jpg"),
        array("title"=>"金融危机后传：标普VS上证 一个天堂一个地狱","url"=>"wallstreetcn.com/node/17372","img"=>"http://img.wallstreetcn.com/sites/default/files/20120822stocks.JPG"),
        array("title"=>"华尔街大佬Jack Bogle推荐：投资者必读的六本书","url"=>"wallstreetcn.com/node/20976","img"=>"http://img.wallstreetcn.com/sites/default/files/20121227jack bogle.jpg"),
        array("title"=>"“僵尸企业”正在啃食中国经济","url"=>"wallstreetcn.com/node/17374","img"=>"http://img.wallstreetcn.com/sites/default/files/20120822js11.jpg"),
        array("title"=>"图解真相：谁的工资涨了，哪的外资跑了？","url"=>"wallstreetcn.com/node/17865","img"=>"http://img.wallstreetcn.com/sites/default/files/-1 拷贝.jpg"),
        array("title"=>"天然气传奇交易员John Arnold关闭旗舰基金Centaurus","url"=>"wallstreetcn.com/node/13790","img"=>"http://img.wallstreetcn.com/sites/default/files/201205071640.jpg"),
        array("title"=>"高盛“迷雾四国”表现远超“金砖四国”","url"=>"wallstreetcn.com/node/16821","img"=>"http://img.wallstreetcn.com/sites/default/files/itIfKh_VQO5g20120807.jpg"),
        array("title"=>"克鲁格曼：中国撞上了一面墙","url"=>"wallstreetcn.com/node/50559","img"=>"http://img.wallstreetcn.com/sites/default/files/Paul-Krugman-008.jpg"),
        array("title"=>"黄金与美元的堕落：揭开纸黄金的秘密","url"=>"wallstreetcn.com/node/20346","img"=>"http://img.wallstreetcn.com/sites/default/files/dd23432f.jpg"),
        array("title"=>"三张图说明老龄化将拖死日本经济","url"=>"wallstreetcn.com/node/16834","img"=>"http://img.wallstreetcn.com/sites/default/files/Japan Demo 2.jpg"),
        array("title"=>"中国经济两大难题","url"=>"wallstreetcn.com/node/17522","img"=>"http://img.wallstreetcn.com/sites/default/files/20120824_CNY4.jpg"),
        array("title"=>"一大波中国式坏账正在逼近？","url"=>"wallstreetcn.com/node/64271","img"=>"http://img.wallstreetcn.com/sites/default/files/jZH6e.jpg"),
        array("title"=>"图解QE的经济循环","url"=>"wallstreetcn.com/node/67942","img"=>"http://img.wallstreetcn.com/sites/default/files/20131212_QE_3xxx.gif"),
        array("title"=>"揭密你从未听说的全球最大对冲基金","url"=>"wallstreetcn.com/node/18756","img"=>"http://img.wallstreetcn.com/sites/default/files/20121001 map 730 Sandhill.jpg"),
        array("title"=>"高盛：九大大宗商品价格预期","url"=>"wallstreetcn.com/node/51023","img"=>"http://img.wallstreetcn.com/sites/default/files/images_6.jpg"),
        array("title"=>"南方周末：李嘉诚，从“超人”到“万恶的资本家”","url"=>"wallstreetcn.com/node/62975","img"=>"http://img.wallstreetcn.com/sites/default/files/2013091420343.jpg"),
        array("title"=>"外资大撤退","url"=>"wallstreetcn.com/node/16251","img"=>"http://img.wallstreetcn.com/sites/default/files/20120712094454250_0.jpg"),
        array("title"=>"对冲基金的下一个目标：卡尼交易","url"=>"wallstreetcn.com/node/22290","img"=>"http://img.wallstreetcn.com/sites/default/files/201302191601.jpg"),
        array("title"=>"图解全球外汇制度演变史","url"=>"wallstreetcn.com/node/17430","img"=>"http://img.wallstreetcn.com/sites/default/files/201208241605.jpg"),
        array("title"=>"中国经济最大风险图解汇总（三）：房地产泡沫","url"=>"wallstreetcn.com/node/50464","img"=>"http://img.wallstreetcn.com/sites/default/files/20130719china 04.jpg"),
        array("title"=>"美银美林：中国劳动力人口拐点提前三年到来","url"=>"wallstreetcn.com/node/54266","img"=>"http://img.wallstreetcn.com/sites/default/files/劳动年龄3.jpg"),
        array("title"=>"中国锯断了美元与黄金的跷跷板","url"=>"wallstreetcn.com/node/17608","img"=>"http://img.wallstreetcn.com/sites/default/files/ 拷贝.jpg"),
        array("title"=>"日本人口老龄化的三大惊人事实","url"=>"wallstreetcn.com/node/65788","img"=>"http://img.wallstreetcn.com/sites/default/files/japanelderly.jpg"),
        array("title"=>"Icahn VS.Ackman：紫禁之巅的“逼空之战”（上）","url"=>"wallstreetcn.com/node/22225","img"=>"http://img.wallstreetcn.com/sites/default/files/201302141033.jpg"),
        array("title"=>"在华尔街工作的16项隐性成本","url"=>"wallstreetcn.com/node/68110","img"=>"http://img.wallstreetcn.com/sites/default/files/20131215wolf-of-wall-street-9.jpg"),
        array("title"=>"漫步金融街---回顾金融市场200年（二）","url"=>"wallstreetcn.com/node/17507","img"=>"http://img.wallstreetcn.com/sites/default/files/QQ截图20120825112019.jpg"),
        array("title"=>"影子业务101：银行是如何绕开信贷监管的","url"=>"wallstreetcn.com/node/63018","img"=>"http://img.wallstreetcn.com/sites/default/files/Shadow.jpg"),
        array("title"=>"Ray Dalio：历史眼光看国家经济发展的五个阶段","url"=>"wallstreetcn.com/node/19840","img"=>"http://img.wallstreetcn.com/sites/default/files/dfasdf123dd123.jpg"),
        array("title"=>"坑爹的华尔街股票分析师？","url"=>"wallstreetcn.com/node/24319","img"=>"http://img.wallstreetcn.com/sites/default/files/StockMarketRiskManagement.jpg"),
        array("title"=>"格罗斯：政府偷钱的4个方法","url"=>"wallstreetcn.com/node/24534","img"=>"http://img.wallstreetcn.com/sites/default/files/201305052015_0.jpg"),
        array("title"=>"成为大佬之前——9大华尔街巨头的传奇人生","url"=>"wallstreetcn.com/node/17399","img"=>"http://img.wallstreetcn.com/sites/default/files/20120822warren buffett.jpg"),
        array("title"=>"中国经济最大风险图解汇总（一）：信贷泡沫","url"=>"wallstreetcn.com/node/50357","img"=>"http://img.wallstreetcn.com/sites/default/files/20130716china 04.jpg"),
        array("title"=>"逆天的Dalio（二）——最完美的“Betas”对冲","url"=>"wallstreetcn.com/node/21814","img"=>"http://img.wallstreetcn.com/sites/default/files/what-is-beta.jpg"),
        array("title"=>"中国房地产如何冲击世界经济","url"=>"wallstreetcn.com/node/16731","img"=>"http://img.wallstreetcn.com/sites/default/files/hainan0120803190122_0.jpg"),
        array("title"=>"白话版解释商品库存问题","url"=>"wallstreetcn.com/node/50835","img"=>"http://img.wallstreetcn.com/sites/default/files/20130724wheatinventory.jpg"),
        array("title"=>"路透：中国经济走向僵尸化","url"=>"wallstreetcn.com/node/54050","img"=>"http://img.wallstreetcn.com/sites/default/files/original.jpg"),
        array("title"=>"哈佛2013届本科毕业生就业去向调查","url"=>"wallstreetcn.com/node/25284","img"=>"http://img.wallstreetcn.com/sites/default/files/201305290939.jpg"),
        array("title"=>"石磊专栏：中国的利率水平为什么这么高？--流动性、杠杆、与人民币汇率之二","url"=>"wallstreetcn.com/node/62112","img"=>"http://img.wallstreetcn.com/sites/default/files/02101016711414.jpg"),
        array("title"=>"付鹏专栏：近期原油的波动来源分析 ","url"=>"wallstreetcn.com/node/49619","img"=>"http://img.wallstreetcn.com/sites/default/files/tu1.jpg"),
        array("title"=>"高盛CEO布兰克梵恩：年轻人要多去尝试，未来不是直线","url"=>"wallstreetcn.com/node/24483","img"=>"http://img.wallstreetcn.com/sites/default/files/screen shot 2013-03-10 at 6.51.23 pm.jpg"),
        array("title"=>"机构调查：中国可能成为全球最“现实”的国家","url"=>"wallstreetcn.com/node/68706","img"=>"http://img.wallstreetcn.com/sites/default/files/Chinaluxurygoods.jpg"),
        array("title"=>"华尔街与美联储的罗曼史","url"=>"wallstreetcn.com/node/16714","img"=>"http://img.wallstreetcn.com/sites/default/files/pig1.jpg"),
        array("title"=>"QE3他爹：大萧条","url"=>"wallstreetcn.com/node/18273","img"=>"http://img.wallstreetcn.com/sites/default/files/CCA237.jpg"),
        array("title"=>"一笔巨额空单引发的黄金血案","url"=>"wallstreetcn.com/node/59615","img"=>"http://img.wallstreetcn.com/sites/default/files/gold20131012095351.jpg"),
        array("title"=>"巴菲特办公室什么样？“股神”“指挥部”探秘","url"=>"wallstreetcn.com/node/54904","img"=>"http://img.wallstreetcn.com/sites/default/files/20130831buffetts office11.jpg"),
        array("title"=>"美银美林：中国行业经济活动指标指南","url"=>"wallstreetcn.com/node/16649","img"=>"http://img.wallstreetcn.com/sites/default/files/201208012159.jpg"),
        array("title"=>"吉姆·罗杰斯：中国选择宽松货币将是一个错误","url"=>"wallstreetcn.com/node/17375","img"=>"http://img.wallstreetcn.com/sites/default/files/Rogers_Jim_in_China_200.jpg"),
        array("title"=>"摩根士丹利预测13种主要商品未来走势","url"=>"wallstreetcn.com/node/48183","img"=>"http://img.wallstreetcn.com/sites/default/files/basket_1870914b.jpg"),
        array("title"=>"道德是如何沦陷的——一个华尔街员工的自白","url"=>"wallstreetcn.com/node/65261","img"=>"http://img.wallstreetcn.com/sites/default/files/20131127wolf-of-wall-street-6.jpg"),
        array("title"=>"比特币的前世今生：自由与黑暗的气质并存（上）","url"=>"wallstreetcn.com/node/23616","img"=>"http://img.wallstreetcn.com/sites/default/files/bitcoin_logo_flat_coin_star_by_carbonism-d3h79mu.jpg"),
        array("title"=>"高盛的木马计：那笔摧毁希腊的交易","url"=>"wallstreetcn.com/node/11035","img"=>"http://img.wallstreetcn.com/sites/default/files/201203071338.jpg"),
        array("title"=>"美国将独享页岩繁荣？","url"=>"wallstreetcn.com/node/48474","img"=>"http://img.wallstreetcn.com/sites/default/files/oil-usd-bns.jpg"),
        array("title"=>"高盛1张图概括对美国经济及市场预期","url"=>"wallstreetcn.com/node/16997","img"=>"http://img.wallstreetcn.com/sites/default/files/goldman-sachs-outlook.jpg"),
        array("title"=>"WSJ：澳元已经见底？","url"=>"wallstreetcn.com/node/51171","img"=>"http://img.wallstreetcn.com/sites/default/files/QQ截图20130727145409.jpg"),
        array("title"=>" 菜鸟投资黄金法则","url"=>"wallstreetcn.com/node/67805","img"=>"http://img.wallstreetcn.com/sites/default/files/threeinvestorspundit.jpg"),
        array("title"=>"华尔街投行解读三中全会《决定》的市场影响","url"=>"wallstreetcn.com/node/63909","img"=>"http://img.wallstreetcn.com/sites/default/files/wall-street_2424019c_0.jpg"),
        array("title"=>"Paul Ryan是何方神圣？","url"=>"wallstreetcn.com/node/17000","img"=>"http://img.wallstreetcn.com/sites/default/files/0809.jpg"),
        array("title"=>"伯南克为QE做辩护 称收益超过风险","url"=>"wallstreetcn.com/node/22481","img"=>"http://img.wallstreetcn.com/sites/default/files/20130227Ben-Bernanke.jpg"),
        array("title"=>"美国国债两百年变迁史","url"=>"wallstreetcn.com/node/24200","img"=>"http://img.wallstreetcn.com/sites/default/files/screen shot 2013-04-23 at 12.10.29 pm副本.jpg"),
        array("title"=>"罗奇：我们可能处于下一场全球危机的早期阶段","url"=>"wallstreetcn.com/node/54633","img"=>"http://img.wallstreetcn.com/sites/default/files/crisis0829.jpg"),
        array("title"=>"资产泡沫之澳洲故事","url"=>"wallstreetcn.com/node/19493","img"=>"http://img.wallstreetcn.com/sites/default/files/201210261345.jpg"),
        array("title"=>"索罗斯vs.Ackman 又一场大战爆发","url"=>"wallstreetcn.com/node/52945","img"=>"http://img.wallstreetcn.com/sites/default/files/1375796061.Ackman_Soros_Getty_web112233221211.jpg"),
        array("title"=>"投资者的新避险天堂：挪威、瑞典、加拿大和澳大利亚","url"=>"wallstreetcn.com/node/16858","img"=>"http://img.wallstreetcn.com/sites/default/files/gswiss 02_0.jpg"),
        array("title"=>"傻瓜版入门级QE3解读","url"=>"wallstreetcn.com/node/18199","img"=>"http://img.wallstreetcn.com/sites/default/files/20120914absolute morons QE.jpg"),
        array("title"=>"Dennis Gartman：“我交易黄金近四十年 从来都没见过这样的情况……”","url"=>"wallstreetcn.com/node/23885","img"=>"http://img.wallstreetcn.com/sites/default/files/20130415gartman.JPG"),
        array("title"=>"经济学人：交易员vs.经济学家——解读市场的启示","url"=>"wallstreetcn.com/node/49843","img"=>"http://img.wallstreetcn.com/sites/default/files/libor_crisis.jpg"),
        array("title"=>"人民币国际化被高估，实际结算量不足全球1%","url"=>"wallstreetcn.com/node/68432","img"=>"http://img.wallstreetcn.com/sites/default/files/121309781.jpg"),
        array("title"=>"一大波机器人袭来 改变制造业（一）","url"=>"wallstreetcn.com/node/17306","img"=>"http://img.wallstreetcn.com/sites/default/files/robot-popup.jpg"),
        array("title"=>"Pettis:中国可能难以应对经济增速下滑的恶性循环","url"=>"wallstreetcn.com/node/24448","img"=>"http://img.wallstreetcn.com/sites/default/files/W020120927593844678002.jpg"),
        array("title"=>"巴伦周刊封面文章：欧元的命运","url"=>"wallstreetcn.com/node/16033","img"=>"http://img.wallstreetcn.com/sites/default/files/201207152015.jpg"),
        array("title"=>"QE3的亲妈：博客达人","url"=>"wallstreetcn.com/node/18234","img"=>"http://img.wallstreetcn.com/sites/default/files/scott-sumner.jpg"),
        array("title"=>"放弃美国国籍人数创历史记录 ","url"=>"wallstreetcn.com/node/63465","img"=>"http://img.wallstreetcn.com/sites/default/files/Citizen.jpg"),
        array("title"=>"机器怎么炒股？高频交易经典案例告诉你","url"=>"wallstreetcn.com/node/25651","img"=>"http://img.wallstreetcn.com/sites/default/files/20130612SPEED HFT.jpg"),
        array("title"=>"万余彭博用户信息在网上被曝光多年","url"=>"wallstreetcn.com/node/24799","img"=>"http://img.wallstreetcn.com/sites/default/files/blooomberg21213.jpg"),
        array("title"=>"美国跨国企业：现金为王","url"=>"wallstreetcn.com/node/16846","img"=>"http://img.wallstreetcn.com/sites/default/files/cash20120808.jpg"),
        array("title"=>"格罗斯：时代造就了伟大的投资者","url"=>"wallstreetcn.com/node/23622","img"=>"http://img.wallstreetcn.com/sites/default/files/mirror28937832624.jpg"),
        array("title"=>"30岁交易员获利20亿美元 成就2012年最赚钱债券交易","url"=>"wallstreetcn.com/node/23832","img"=>"http://img.wallstreetcn.com/sites/default/files/20130413trade James levin .jpg"),
        array("title"=>"基础货币与真实利率：金价因谁而动？","url"=>"wallstreetcn.com/node/20503","img"=>"http://img.wallstreetcn.com/sites/default/files/201212102310.jpg"),
        array("title"=>"Steven Sears版投资者必读的十大金融好书推荐","url"=>"wallstreetcn.com/node/20205","img"=>"http://img.wallstreetcn.com/sites/default/files/books-thumb-400x266.jpg"),
        array("title"=>"你真的了解利差交易吗？","url"=>"wallstreetcn.com/node/24532","img"=>"http://img.wallstreetcn.com/sites/default/files/201305052013.jpg"),
        array("title"=>"1957年以来的巴菲特致投资者信 能够告诉你什么？","url"=>"wallstreetcn.com/node/17008","img"=>"http://img.wallstreetcn.com/sites/default/files/20120812buffet.jpg"),
        array("title"=>"揭秘全球5大顶尖资产管理人2013年投资策略","url"=>"wallstreetcn.com/node/22873","img"=>"http://img.wallstreetcn.com/sites/default/files/201212051407366667-xDj.jpg"),
        array("title"=>"华尔街面试系列之三：最让人抓狂的面试题之答案版","url"=>"wallstreetcn.com/node/62137","img"=>"http://img.wallstreetcn.com/sites/default/files/20120807094543359.jpg"),
        array("title"=>"为保证粮食安全，中国买下乌克兰1/20国土","url"=>"wallstreetcn.com/node/57797","img"=>"http://img.wallstreetcn.com/sites/default/files/ukraine-farmland-web.jpg"),
        array("title"=>"五十图详解失落的黄金牛市（一）","url"=>"wallstreetcn.com/node/60510","img"=>"http://img.wallstreetcn.com/sites/default/files/20131020gold 00.jpg"),
        array("title"=>"索罗斯净赚10亿背后的人","url"=>"wallstreetcn.com/node/22214","img"=>"http://img.wallstreetcn.com/sites/default/files/20130216Scott Bessent.jpg"),
        array("title"=>"激进的创新——前私人银行家揭秘投行生活（下）","url"=>"wallstreetcn.com/node/57540","img"=>"http://img.wallstreetcn.com/sites/default/files/jijinchuangxi293749872398.jpg"),
        array("title"=>"经济学人：欧洲能从日本学到什么？","url"=>"wallstreetcn.com/node/16765","img"=>"http://img.wallstreetcn.com/sites/default/files/QQ截图20120805134653_LPS.jpg"),
        array("title"=>"BI：投资必看的67张图表（二）","url"=>"wallstreetcn.com/node/16215","img"=>"http://img.wallstreetcn.com/sites/default/files/2012719图表6.jpg"),
        array("title"=>"【付鹏专栏】十年大宗背后那些不为人知的故事（二）","url"=>"wallstreetcn.com/node/52150","img"=>"http://img.wallstreetcn.com/sites/default/files/201307291760.jpg"),
        array("title"=>"“末日博士”麦嘉华珍藏五十图——那些经济的阴暗面（一）","url"=>"wallstreetcn.com/node/20160","img"=>"http://img.wallstreetcn.com/sites/default/files/marcfaber 2.jpg"),
        array("title"=>"欧债危机特写：拯救全球金融体系的四晚三天（一）","url"=>"wallstreetcn.com/node/23834","img"=>"http://img.wallstreetcn.com/sites/default/files/20130413three days saved world.jpg"),
        array("title"=>"图表详释：美联储、欧洲央行 VS. 全球市场","url"=>"wallstreetcn.com/node/17957","img"=>"http://img.wallstreetcn.com/sites/default/files/20120906qeltro chart.jpg"),
        array("title"=>"辜朝明揭秘日本股市崩溃内幕","url"=>"wallstreetcn.com/node/25468","img"=>"http://img.wallstreetcn.com/sites/default/files/20130605Nikkei Fall.jpg"),
        array("title"=>"'幽灵基金'传奇——基金中的幽灵战舰","url"=>"wallstreetcn.com/node/25482","img"=>"http://img.wallstreetcn.com/sites/default/files/20130605ghost 01.JPG"),
        array("title"=>"法兴：“最悲观版”中国经济完全报告（上）","url"=>"wallstreetcn.com/node/21583","img"=>"http://img.wallstreetcn.com/sites/default/files/20130119china 004.JPG"),
        array("title"=>"失踪的官方PMI数据","url"=>"wallstreetcn.com/node/48731","img"=>"http://img.wallstreetcn.com/sites/default/files/201306270915.jpg"),
        array("title"=>"高盛CEO谈风险：最坏的绝对会发生","url"=>"wallstreetcn.com/node/51181","img"=>"http://img.wallstreetcn.com/sites/default/files/blankfein1123322122.jpg"),
        array("title"=>"前QE操盘手的自白：对不起，美国！","url"=>"wallstreetcn.com/node/63699","img"=>"http://img.wallstreetcn.com/sites/default/files/2013091420430.jpg"),
        array("title"=>"图解欧债危机如何在十年内全面爆发","url"=>"wallstreetcn.com/node/16957","img"=>"http://img.wallstreetcn.com/sites/default/files/20120810000.jpg"),
        array("title"=>"全球资金不断流入美国","url"=>"wallstreetcn.com/node/17032","img"=>"http://img.wallstreetcn.com/sites/default/files/7675514_221423690000_2.jpg"),
        array("title"=>"中国影子银行家在互联网上蓬勃发展","url"=>"wallstreetcn.com/node/16783","img"=>"http://img.wallstreetcn.com/sites/default/files/58c3acb70d95729231add1bb.jpg"),
        array("title"=>"投行：一门“关系”生意","url"=>"wallstreetcn.com/node/67383","img"=>"http://img.wallstreetcn.com/sites/default/files/2013091420722_0.jpg"),
        array("title"=>"中国要警惕“富裕危机”","url"=>"wallstreetcn.com/node/16641","img"=>"http://img.wallstreetcn.com/sites/default/files/20120801affluent.jpg"),
        array("title"=>"你所不知道的金融危机：美联储瞒天过海拯救欧洲银行","url"=>"wallstreetcn.com/node/24775","img"=>"http://img.wallstreetcn.com/sites/default/files/201305081422.jpg"),
        array("title"=>"新债王Jeffrey Gundlach：天才的世界你不懂","url"=>"wallstreetcn.com/node/24188","img"=>"http://img.wallstreetcn.com/sites/default/files/Gundlachhhh4444.jpg"),
        array("title"=>"石油与铜的库存黑箱","url"=>"wallstreetcn.com/node/13679","img"=>"http://img.wallstreetcn.com/sites/default/files/201205022355.jpg"),
        array("title"=>"中国大量的煤炭需求或引发一场“水危机”","url"=>"wallstreetcn.com/node/17158","img"=>"http://img.wallstreetcn.com/sites/default/files/20120816water.JPG"),
        array("title"=>"五年前的今天——雷曼破产众生相","url"=>"wallstreetcn.com/node/56713","img"=>"http://img.wallstreetcn.com/sites/default/files/222.jpg"),
        array("title"=>"巴菲特：债限是大规模杀伤性武器；信用如贞操，失去就难复原","url"=>"wallstreetcn.com/node/60069","img"=>"http://img.wallstreetcn.com/sites/default/files/20131016Buffettbuy.jpg"),
        array("title"=>"恶棍伯南克","url"=>"wallstreetcn.com/node/12420","img"=>"http://img.wallstreetcn.com/sites/default/files/6fc2c0e5gw1drarw8gmodj(2).jpg"),
        array("title"=>"QE之殇","url"=>"wallstreetcn.com/node/16818","img"=>"http://img.wallstreetcn.com/sites/default/files/QQ截图20120807133218_LPS.jpg"),
        array("title"=>"法兴：不要相信伯南克 QE永不停","url"=>"wallstreetcn.com/node/48473","img"=>"http://img.wallstreetcn.com/sites/default/files/bernanke-qe3_2339084b.jpg"),
        array("title"=>"新型经济指标：Google关键字搜索量","url"=>"wallstreetcn.com/node/17241","img"=>"http://img.wallstreetcn.com/sites/default/files/20120818bw.jpg"),
        array("title"=>"七块屏幕都不够 交易员们戴上谷歌眼镜","url"=>"wallstreetcn.com/node/53099","img"=>"http://img.wallstreetcn.com/sites/default/files/201308140026.jpg"),
        array("title"=>"法兴：中国经济硬着陆将使GDP增速骤降至3%","url"=>"wallstreetcn.com/node/51104","img"=>"http://img.wallstreetcn.com/sites/default/files/u=196494闲置.jpg"),
        array("title"=>"图解美国金融体系的日内资金流动","url"=>"wallstreetcn.com/node/16817","img"=>"http://img.wallstreetcn.com/sites/default/files/2012.0807.1103.jpg"),
        array("title"=>"欧元迷局的三个答案","url"=>"wallstreetcn.com/node/16673","img"=>"http://img.wallstreetcn.com/sites/default/files/20120802904-guoguo.jpg"),
        array("title"=>"【经济学人看中国】华为威胁论，从无到有十四年（1）","url"=>"wallstreetcn.com/node/16870","img"=>"http://img.wallstreetcn.com/sites/default/files/20120804_ldp001.jpg"),
        array("title"=>"五幅图展示你应该了解的黄金","url"=>"wallstreetcn.com/node/21696","img"=>"http://img.wallstreetcn.com/sites/default/files/20130123gold five charts.jpg"),
        array("title"=>"四图解析中国“前所未有的”信贷泡沫","url"=>"wallstreetcn.com/node/25820","img"=>"http://img.wallstreetcn.com/sites/default/files/20130618credit 02.jpg"),
        array("title"=>"罗杰斯：安倍可能已经毁了日本","url"=>"wallstreetcn.com/node/25716","img"=>"http://img.wallstreetcn.com/sites/default/files/luojies12128712368128612.jpg"),
        array("title"=>"BI：投资必看的67张图表（六）","url"=>"wallstreetcn.com/node/18333","img"=>"http://img.wallstreetcn.com/sites/default/files/20120918图表41.jpg"),
        array("title"=>"黄金正由西方搬往东方","url"=>"wallstreetcn.com/node/16605","img"=>"http://img.wallstreetcn.com/sites/default/files/201207312032-guoguo.jpg"),
        array("title"=>"2015年后全球迎来石油供应大繁荣","url"=>"wallstreetcn.com/node/16970","img"=>"http://img.wallstreetcn.com/sites/default/files/Oil_Rigs20120810.jpg"),
        array("title"=>"谁是史上最成功的魔鬼交易员","url"=>"wallstreetcn.com/node/19770","img"=>"http://img.wallstreetcn.com/sites/default/files/20121109John Pierpont Morgan.jpg"),
        array("title"=>"华尔街面试系列之四：实习生面试的9个经典问题","url"=>"wallstreetcn.com/node/63869","img"=>"http://img.wallstreetcn.com/sites/default/files/20131117interview.jpg"),
        array("title"=>"逆天的Dalio（三）——两个重要的投资原理","url"=>"wallstreetcn.com/node/21939","img"=>"http://img.wallstreetcn.com/sites/default/files/now-dalio-and-his-wife-barbara-live-on-a-5500-sq-foot-estate-in-a-gated-section-of-greenwich.jpg"),
        array("title"=>"中国资产证券化为谁而生？","url"=>"wallstreetcn.com/node/56657","img"=>"http://img.wallstreetcn.com/sites/default/files/Img352449967.jpg"),
        array("title"=>"华尔街的债券世界","url"=>"wallstreetcn.com/node/21964","img"=>"http://img.wallstreetcn.com/sites/default/files/201302012308.jpg"),
        array("title"=>"一幅图告诉你白银是怎样的投资","url"=>"wallstreetcn.com/node/21601","img"=>"http://img.wallstreetcn.com/sites/default/files/20130120 silver investment potential .jpg"),
        array("title"=>"美国违约若成真 世界将会怎样？","url"=>"wallstreetcn.com/node/59779","img"=>"http://img.wallstreetcn.com/sites/default/files/20131014default.jpg"),
        array("title"=>"中国式金融危机路线图","url"=>"wallstreetcn.com/node/23978","img"=>"http://img.wallstreetcn.com/sites/default/files/102108866.jpg"),
        array("title"=>"性、电脑和VaR","url"=>"wallstreetcn.com/node/19430","img"=>"http://img.wallstreetcn.com/sites/default/files/20121024Sex Computer VaR3.JPG"),
        array("title"=>"谁是真正的页岩油气之王？","url"=>"wallstreetcn.com/node/25876","img"=>"http://img.wallstreetcn.com/sites/default/files/20130620Shale boom.jpg"),
        array("title"=>"你必须认识的十大主动投资超级大佬（上）","url"=>"wallstreetcn.com/node/23233","img"=>"http://img.wallstreetcn.com/sites/default/files/20130323guru.jpg"),
        array("title"=>"【付鹏专栏】十年大宗背后那些不为人知的故事（七）","url"=>"wallstreetcn.com/node/54526","img"=>"http://img.wallstreetcn.com/sites/default/files/20132308282240.jpg"),
        array("title"=>"研报流行语：一个时代的结束","url"=>"wallstreetcn.com/node/23618","img"=>"http://img.wallstreetcn.com/sites/default/files/201304030810.jpg"),
        array("title"=>"【欧洲央行OMT专题】OMT购债的十大关键条款","url"=>"wallstreetcn.com/node/17963","img"=>"http://img.wallstreetcn.com/sites/default/files/20120907ECBOMT.jpeg"),
        array("title"=>"制裁背后的美伊博弈","url"=>"wallstreetcn.com/node/17004","img"=>"http://img.wallstreetcn.com/sites/default/files/201208120849.jpg"),
        array("title"=>"克鲁格曼大战德马科","url"=>"wallstreetcn.com/node/16692","img"=>"http://img.wallstreetcn.com/sites/default/files/20120802firecover.jpg"),
        array("title"=>"股票市场和商品市场的分化——一边是火，一边是冰","url"=>"wallstreetcn.com/node/23611","img"=>"http://img.wallstreetcn.com/sites/default/files/200507080903331.jpg"),
        array("title"=>"中国大米供应充足 为何将成为全球第一大进口国？","url"=>"wallstreetcn.com/node/53724","img"=>"http://img.wallstreetcn.com/sites/default/files/20130821rice.jpg"),
        array("title"=>"传奇空头查诺斯的22句名言（一）","url"=>"wallstreetcn.com/node/64844","img"=>"http://img.wallstreetcn.com/sites/default/files/22_quotesjameschanos.jpg"),
        array("title"=>"彭博杂志：全球金融界最有影响力50人","url"=>"wallstreetcn.com/node/5637","img"=>"http://img.wallstreetcn.com/sites/default/files/20110911most50influential1.jpg"),
        array("title"=>"全球最大外汇对冲基金FX Concepts的兴衰史（上）","url"=>"wallstreetcn.com/node/68105","img"=>"http://img.wallstreetcn.com/sites/default/files/jTaylorBig.jpg"),
        array("title"=>"华尔街为什么突然讨厌黄金","url"=>"wallstreetcn.com/node/23898","img"=>"http://img.wallstreetcn.com/sites/default/files/TamikoThiel_ReignOfGold-NYStockExchange_2-1024w.jpg"),
        array("title"=>"统领当今全球经济的十大新趋势（下）","url"=>"wallstreetcn.com/node/58771","img"=>"http://img.wallstreetcn.com/sites/default/files/20131003global 02.jpg"),
        array("title"=>"美国影子银行的衰落","url"=>"wallstreetcn.com/node/20498","img"=>"http://img.wallstreetcn.com/sites/default/files/ddfa22.jpg"),
        array("title"=>"“伦敦鲸”交易员一人扰动全球债券市场","url"=>"wallstreetcn.com/node/12989","img"=>"http://img.wallstreetcn.com/sites/default/files/20120406WSJ.jpg"),
        array("title"=>"GMO：债券之死","url"=>"wallstreetcn.com/node/50729","img"=>"http://img.wallstreetcn.com/sites/default/files/gmo20130723112939.jpg"),
        array("title"=>"宝宝的蝴蝶效应：“单独二胎”施压中国改革","url"=>"wallstreetcn.com/node/52301","img"=>"http://img.wallstreetcn.com/sites/default/files/蝴蝶效应.jpg"),
        array("title"=>"对冲基金巨头Ray Dalio谈欧元区危机、谈黄金、谈全球经济","url"=>"wallstreetcn.com/node/14748","img"=>"http://img.wallstreetcn.com/sites/default/files/20120520Ray Dalio.JPG"),
        array("title"=>"欧洲金融体系分裂加速","url"=>"wallstreetcn.com/node/17009","img"=>"http://img.wallstreetcn.com/sites/default/files/201208122108.jpg"),
        array("title"=>"高盛涉嫌操控铝价","url"=>"wallstreetcn.com/node/50557","img"=>"http://img.wallstreetcn.com/sites/default/files/aluminum-2.jpg"),
        array("title"=>"图解中国经济失衡的根源——并非政策惹的祸","url"=>"wallstreetcn.com/node/55394","img"=>"http://img.wallstreetcn.com/sites/default/files/D0409BB1.jpg"),
        array("title"=>"人与机器-Ray Dalio的经济学理念","url"=>"wallstreetcn.com/node/13413","img"=>"http://img.wallstreetcn.com/sites/default/files/201204212228.jpg"),
        array("title"=>"德拉吉不能拯救欧元","url"=>"wallstreetcn.com/node/16802","img"=>"http://img.wallstreetcn.com/sites/default/files/201208060734.jpg"),
        array("title"=>"通过“伦敦定盘价”操纵黄金价格的隐秘路线图","url"=>"wallstreetcn.com/node/65096","img"=>"http://img.wallstreetcn.com/sites/default/files/421449528_1a5ba076d9_z.jpg"),
        array("title"=>"国际铜市的异象","url"=>"wallstreetcn.com/node/25329","img"=>"http://img.wallstreetcn.com/sites/default/files/20130529_copper1_0.jpg"),
        array("title"=>"解读中国理财产品监管新规","url"=>"wallstreetcn.com/node/23569","img"=>"http://img.wallstreetcn.com/sites/default/files/20130219091751559.jpg"),
        array("title"=>"【见闻访谈】ACM陈凯丰（九）：长期看空日股，商品对QE减缓最敏感","url"=>"wallstreetcn.com/node/25397","img"=>"http://img.wallstreetcn.com/sites/default/files/photo_kevin chen.JPG"),
        array("title"=>"中国的坏账梦魇","url"=>"wallstreetcn.com/node/17654","img"=>"http://img.wallstreetcn.com/sites/default/files/QQ截图20120829170022.jpg"),
        array("title"=>"Seth Klarman：鲜为人知的对冲基金传奇","url"=>"wallstreetcn.com/node/15851","img"=>"http://img.wallstreetcn.com/sites/default/files/201207102249.jpg"),
        array("title"=>"努力干活吧，金融精英们","url"=>"wallstreetcn.com/node/24934","img"=>"http://img.wallstreetcn.com/sites/default/files/201305171806.jpg"),
        array("title"=>"美国复苏的4大风险","url"=>"wallstreetcn.com/node/16856","img"=>"http://img.wallstreetcn.com/sites/default/files/201208081247-guoguo.jpg"),
        array("title"=>"黄金与美元的堕落：供求关系失效","url"=>"wallstreetcn.com/node/19792","img"=>"http://img.wallstreetcn.com/sites/default/files/fgfd20121112011426.jpg"),
        array("title"=>"非洲为何选择从中国贷款？","url"=>"wallstreetcn.com/node/20491","img"=>"http://img.wallstreetcn.com/sites/default/files/QQ截图20121210161837.jpg"),
        array("title"=>"夏斌：中国已经存在事实上的金融危机现象 决策者须寻求逐步刺破泡沫","url"=>"wallstreetcn.com/node/49860","img"=>"http://img.wallstreetcn.com/sites/default/files/U2629P31T1D8661008F46DT201009151607501123.jpg"),
        array("title"=>"QE大富翁","url"=>"wallstreetcn.com/node/59115","img"=>"http://img.wallstreetcn.com/sites/default/files/1959efe8a38cb2bcf262de35d41ea8502628.jpg"),
        array("title"=>"【见闻访谈】奥本海默基金李山泉（一）：全球市场剧烈波动将持续至少一两年","url"=>"wallstreetcn.com/node/25577","img"=>"http://img.wallstreetcn.com/sites/default/files/3-shanquan-li.jpg"),
        array("title"=>"MFI：价格货币债务——中国本轮改革第一阶段必闯的三大关口","url"=>"wallstreetcn.com/node/52490","img"=>"http://img.wallstreetcn.com/sites/default/files/gaige129731947987459712.jpeg"),
        array("title"=>"资产泡沫五十年回顾：谁是下一个？","url"=>"wallstreetcn.com/node/25122","img"=>"http://img.wallstreetcn.com/sites/default/files/20130523asset bubblejpg.JPG"),
        array("title"=>"中非合作论坛：中国的非洲战略","url"=>"wallstreetcn.com/node/16896","img"=>"http://img.wallstreetcn.com/sites/default/files/201208090813.jpg"),
        array("title"=>"为何投资者仍应投资中国相关的股票","url"=>"wallstreetcn.com/node/50722","img"=>"http://img.wallstreetcn.com/sites/default/files/morgan.JPG"),
        array("title"=>"中国谜团：信贷资金去哪儿了","url"=>"wallstreetcn.com/node/25540","img"=>"http://img.wallstreetcn.com/sites/default/files/screen shot 2013-06-06 at 10.00.08 am.jpg"),
        array("title"=>"高频交易Q&A","url"=>"wallstreetcn.com/node/16767","img"=>"http://img.wallstreetcn.com/sites/default/files/201208051431.jpg"),
        array("title"=>"一大波机器人袭来 改变制造业（二）","url"=>"wallstreetcn.com/node/17329","img"=>"http://img.wallstreetcn.com/sites/default/files/JP-ROBOT-2-popup.jpg"),
        array("title"=>"图解大宗商品抛售潮","url"=>"wallstreetcn.com/node/25190","img"=>"http://img.wallstreetcn.com/sites/default/files/201305261000.jpg"),
        array("title"=>"末日博士麦嘉华：全球经济衰退几率100%","url"=>"wallstreetcn.com/node/17469","img"=>"http://img.wallstreetcn.com/sites/default/files/QQ截图20120824144847.jpg"),
        array("title"=>"泡沫的形成与崩溃——图解市场泡沫必经的四大阶段","url"=>"wallstreetcn.com/node/23679","img"=>"http://img.wallstreetcn.com/sites/default/files/20130409bubble.jpg"),
        array("title"=>"中国：没有杠杆就没有增长？","url"=>"wallstreetcn.com/node/56271","img"=>"http://img.wallstreetcn.com/sites/default/files/china-currency222.jpg"),
        array("title"=>"婚姻经济学","url"=>"wallstreetcn.com/node/25378","img"=>"http://img.wallstreetcn.com/sites/default/files/1369842634698.cached.jpg"),
        array("title"=>"花旗深度解读“汇率战争”（上）","url"=>"wallstreetcn.com/node/21378","img"=>"http://img.wallstreetcn.com/sites/default/files/sdfasf123123.jpeg"),
        array("title"=>"毒品、妓女和低价股，《华尔街之狼》刻画人性原罪","url"=>"wallstreetcn.com/node/66952","img"=>"http://img.wallstreetcn.com/sites/default/files/wolf-articleLarge_0.jpg"),
        array("title"=>"彭博分析师：伦敦金库空空如也，都去了中国人那里","url"=>"wallstreetcn.com/node/69182","img"=>"http://img.wallstreetcn.com/sites/default/files/20131220Chinagoldappetite.jpg"),
        array("title"=>"窥探高频交易公司——千载难逢哦","url"=>"wallstreetcn.com/node/19099","img"=>"http://img.wallstreetcn.com/sites/default/files/dsfsd233.jpg"),
        array("title"=>"图解美国经济（二）：能源与贸易","url"=>"wallstreetcn.com/node/50845","img"=>"http://img.wallstreetcn.com/sites/default/files/20130723US 12.jpg"),
        array("title"=>"【投资大佬经验谈系列】对冲基金奇才Steve Clark的教训","url"=>"wallstreetcn.com/node/22544","img"=>"http://img.wallstreetcn.com/sites/default/files/20130228HD market wizards clark.jpg"),
        array("title"=>"摩根大通终极版市场指南：经济篇（上）","url"=>"wallstreetcn.com/node/21217","img"=>"http://img.wallstreetcn.com/sites/default/files/20130107morgan 5.jpg"),
        array("title"=>"创建人之一谈欧元区破裂：有的国家不得不走","url"=>"wallstreetcn.com/node/16905","img"=>"http://img.wallstreetcn.com/sites/default/files/wrench_副本.jpg"),
        array("title"=>"超级富豪的投资组合和令普通人悲伤的秘密","url"=>"wallstreetcn.com/node/53182","img"=>"http://img.wallstreetcn.com/sites/default/files/Pie-Chart12233433232.jpg"),
        array("title"=>"基金经理们对全球经济有多少信心？","url"=>"wallstreetcn.com/node/17259","img"=>"http://img.wallstreetcn.com/sites/default/files/20120819confidence.JPG"),
        array("title"=>" BI：全球最重要的100张图表（十）","url"=>"wallstreetcn.com/node/64779","img"=>"http://img.wallstreetcn.com/sites/default/files/most-important-charts-in-the-world2_7.jpg"),
        array("title"=>"那些年，我们一起猜的QE3","url"=>"wallstreetcn.com/node/15164","img"=>"http://img.wallstreetcn.com/sites/default/files/201206201923_0.jpg"),
        array("title"=>"芒格专访：我们不会投资苹果，银行家就像吸毒的","url"=>"wallstreetcn.com/node/24508","img"=>"http://img.wallstreetcn.com/sites/default/files/201305021552.jpg"),
        array("title"=>"未来十年间最聪明的投资","url"=>"wallstreetcn.com/node/19825","img"=>"http://img.wallstreetcn.com/sites/default/files/thumb.jpg"),
        array("title"=>"索罗斯最好的投资建议","url"=>"wallstreetcn.com/node/16014","img"=>"http://img.wallstreetcn.com/sites/default/files/hk97_1.jpg"),
        array("title"=>"全球财富金字塔——政策如何让富人更富有","url"=>"wallstreetcn.com/node/25740","img"=>"http://img.wallstreetcn.com/sites/default/files/20130613wealth 04.jpg"),
        array("title"=>"罗姆尼：美国2020年前实现能源独立","url"=>"wallstreetcn.com/node/17525","img"=>"http://img.wallstreetcn.com/sites/default/files/ENERGY-articleLarge-v211.jpg"),
        array("title"=>"十大最尴尬的经济预测","url"=>"wallstreetcn.com/node/67298","img"=>"http://img.wallstreetcn.com/sites/default/files/20131209_WORST1_0.png"),
        array("title"=>"变异的投行文化——华尔街交易员揭秘华尔街","url"=>"wallstreetcn.com/node/58666","img"=>"http://img.wallstreetcn.com/sites/default/files/dayinhang239820948284.jpg"),
        array("title"=>"金融圣经第X章：商品！商品！","url"=>"wallstreetcn.com/node/18478","img"=>"http://img.wallstreetcn.com/sites/default/files/QQ截图20120923112419.jpg"),
        array("title"=>"分配不平等导致经济低速增长？","url"=>"wallstreetcn.com/node/17527","img"=>"http://img.wallstreetcn.com/sites/default/files/bf3ad6bd9965864cde3a905bd14548c3.jpg"),
        array("title"=>"另类“大逆转”：纸黄金vs黄金","url"=>"wallstreetcn.com/node/22633","img"=>"http://img.wallstreetcn.com/sites/default/files/20130304gold 01.jpg"),
        array("title"=>"BI：投资必看的67张图表（三）","url"=>"wallstreetcn.com/node/16362","img"=>"http://img.wallstreetcn.com/sites/default/files/2012712图表13.jpg"),
        array("title"=>"维基解密：中国为什么要增持黄金","url"=>"wallstreetcn.com/node/5443","img"=>"http://img.wallstreetcn.com/sites/default/files/wikileaks.jpg"),
        array("title"=>"大多头战记：那些后金融危机时期的大赢家（一）","url"=>"wallstreetcn.com/node/63117","img"=>"http://img.wallstreetcn.com/sites/default/files/2013091420403.jpg"),
        array("title"=>"BI：投资必看的67张图表（四）","url"=>"wallstreetcn.com/node/16877","img"=>"http://img.wallstreetcn.com/sites/default/files/20120808图表21.jpg"),
        array("title"=>"逆天的Dalio（四）——增长与通胀的平衡","url"=>"wallstreetcn.com/node/21970","img"=>"http://img.wallstreetcn.com/sites/default/files/20130203223512.jpg"),
        array("title"=>"【投资大佬经验谈系列】黑石Byron Wien的教训","url"=>"wallstreetcn.com/node/22511","img"=>"http://img.wallstreetcn.com/sites/default/files/20130227ByronWein.JPG"),
        array("title"=>"花旗深度解读“汇率战争”（下）","url"=>"wallstreetcn.com/node/21379","img"=>"http://img.wallstreetcn.com/sites/default/files/fdgs12312.jpeg"),
        array("title"=>"图解全球白银","url"=>"wallstreetcn.com/node/22596","img"=>"http://img.wallstreetcn.com/sites/default/files/20130302demonocracy silver intro.jpg"),
        array("title"=>"经济学人： 全球楼市逼近钻石底","url"=>"wallstreetcn.com/node/17287","img"=>"http://img.wallstreetcn.com/sites/default/files/House-Prices_682_465851a.jpg"),
        array("title"=>"《黑天鹅》作者Taleb：要学会拥抱波动性，创造“逆碎性”（上）","url"=>"wallstreetcn.com/node/19961","img"=>"http://img.wallstreetcn.com/sites/default/files/2007126175412763_2.jpg"),
        array("title"=>"【疯狂的比特币】大转换：从黄金白银到比特币","url"=>"wallstreetcn.com/node/64006","img"=>"http://img.wallstreetcn.com/sites/default/files/2013091420447.jpg"),
        array("title"=>"到底谁在大量持有美国政府债务？","url"=>"wallstreetcn.com/node/54910","img"=>"http://img.wallstreetcn.com/sites/default/files/谁在买美债.jpg"),
        array("title"=>" El-Erian：理解当今世界的公式","url"=>"wallstreetcn.com/node/25159","img"=>"http://img.wallstreetcn.com/sites/default/files/201305221533.jpg"),
        array("title"=>"中国接近取代欧洲 成全球投资者最大忧虑","url"=>"wallstreetcn.com/node/24830","img"=>"http://img.wallstreetcn.com/sites/default/files/China-GDP-YoY20130514.jpg"),
        array("title"=>"美联储的货币政策是如何出台的？（上）","url"=>"wallstreetcn.com/node/17344","img"=>"http://img.wallstreetcn.com/sites/default/files/20120821漫画.jpg"),
        array("title"=>"理解中国CDS指南","url"=>"wallstreetcn.com/node/6216","img"=>"http://img.wallstreetcn.com/sites/default/files/20111002-China-CDS-Activity.jpg"),
        array("title"=>"两张图解释欧洲经济危机","url"=>"wallstreetcn.com/node/51500","img"=>"http://img.wallstreetcn.com/sites/default/files/grekandgermanexports.jpg"),
        array("title"=>"公司债投资者注定遭受利率损失？ ","url"=>"wallstreetcn.com/node/17024","img"=>"http://img.wallstreetcn.com/sites/default/files/MI-BQ583_ABREAS_NS_20120812174204.jpg"),
        array("title"=>"【付鹏专栏】十年大宗背后那些不为人知的故事（三）","url"=>"wallstreetcn.com/node/52295","img"=>"http://img.wallstreetcn.com/sites/default/files/201307291818.jpg"),
        array("title"=>"美国9月新屋开工数升至四年高点","url"=>"wallstreetcn.com/node/19202","img"=>"http://img.wallstreetcn.com/sites/default/files/housingstarts1017.jpg"),
        array("title"=>"高盛：2012、2013年，世界就是这个样","url"=>"wallstreetcn.com/node/7963","img"=>"http://img.wallstreetcn.com/sites/default/files/20111202Goldman sachs.jpg"),
        array("title"=>"理财产品，中国的次级债？","url"=>"wallstreetcn.com/node/16991","img"=>"http://img.wallstreetcn.com/sites/default/files/2012.0811.1604.jpg"),
        array("title"=>"罗杰斯谈黄金大跌、QE和美国国债收益率","url"=>"wallstreetcn.com/node/48582","img"=>"http://img.wallstreetcn.com/sites/default/files/rogers213123.jpg"),
        array("title"=>"“末日博士”鲁比尼：金价两年内可能跌至1000美元","url"=>"wallstreetcn.com/node/25376","img"=>"http://img.wallstreetcn.com/sites/default/files/20130602gold rush.JPG"),
        array("title"=>"银行的世界我们不懂 巴克莱Libor操纵案系列（1）","url"=>"wallstreetcn.com/node/15463","img"=>"http://img.wallstreetcn.com/sites/default/files/201206281447.jpg"),
        array("title"=>"顶级做空大师吉姆•查诺斯的14句名言","url"=>"wallstreetcn.com/node/21121","img"=>"http://img.wallstreetcn.com/sites/default/files/201301041455.jpg"),
        array("title"=>"学什么专业呢？美国劳工统计局预测未来各行业就业情况","url"=>"wallstreetcn.com/node/69004","img"=>"http://img.wallstreetcn.com/sites/default/files/BLS1.png"),
        array("title"=>"摩根士丹利谈A股“突发性暴涨”谜团","url"=>"wallstreetcn.com/node/20413","img"=>"http://img.wallstreetcn.com/sites/default/files/20121205market.jpg"),
        array("title"=>"黄金价格为什么下降？中国的麻烦就是黄金的麻烦","url"=>"wallstreetcn.com/node/17268","img"=>"http://img.wallstreetcn.com/sites/default/files/20120819china gold.JPG"),
        array("title"=>"年轻气盛，对冲基金巨头Ackman走麦城","url"=>"wallstreetcn.com/node/53926","img"=>"http://img.wallstreetcn.com/sites/default/files/201308221340.jpg"),
        array("title"=>"金融世界的银发“style”","url"=>"wallstreetcn.com/node/49184","img"=>"http://img.wallstreetcn.com/sites/default/files/201307040820.jpg"),
        array("title"=>"从高盛报告看开去：我们为何投资黄金","url"=>"wallstreetcn.com/node/56720","img"=>"http://img.wallstreetcn.com/sites/default/files/2013090520521.jpg"),
        array("title"=>"铜价：金融需求 VS 实体需求","url"=>"wallstreetcn.com/node/13574","img"=>"http://img.wallstreetcn.com/sites/default/files/201204271123.png"),
        array("title"=>"末日博士麦嘉华的警告","url"=>"wallstreetcn.com/node/25384","img"=>"http://img.wallstreetcn.com/sites/default/files/QQ截图20130603012335.jpg"),
        array("title"=>"聪明钱开始离场？","url"=>"wallstreetcn.com/node/24389","img"=>"http://img.wallstreetcn.com/sites/default/files/QQ截图20130501141139.jpg"),
        array("title"=>"一张图了解美国能源消费结构","url"=>"wallstreetcn.com/node/50661","img"=>"http://img.wallstreetcn.com/sites/default/files/20130722energy.jpg"),
        array("title"=>"《权力的游戏》—华尔街生活的写照","url"=>"wallstreetcn.com/node/25569","img"=>"http://img.wallstreetcn.com/sites/default/files/garden-of-bones-02-1920.jpg"),
        array("title"=>"【付鹏专栏】十年大宗背后那些不为人知的故事（四）","url"=>"wallstreetcn.com/node/52453","img"=>"http://img.wallstreetcn.com/sites/default/files/201307291841.jpg"),
        array("title"=>"经济学人：中国“鬼城”","url"=>"wallstreetcn.com/node/64266","img"=>"http://img.wallstreetcn.com/sites/default/files/The_Haunted_House_by_DAN_KA.jpg"),
        array("title"=>"全球最大商品对冲基金之一Clive Capital因亏损关闭","url"=>"wallstreetcn.com/node/57565","img"=>"http://img.wallstreetcn.com/sites/default/files/20130921CliveCapitaldown.jpg"),
        array("title"=>"日本——正式走向“癫狂”","url"=>"wallstreetcn.com/node/25154","img"=>"http://img.wallstreetcn.com/sites/default/files/20130522japan 02.jpg"),
        array("title"=>"印度加入货币战争？","url"=>"wallstreetcn.com/node/48412","img"=>"http://img.wallstreetcn.com/sites/default/files/QQ截图20130628125220.jpg"),
        array("title"=>"未来十年最聪明的投资（续）","url"=>"wallstreetcn.com/node/19945","img"=>"http://img.wallstreetcn.com/sites/default/files/201211182230.jpg"),
        array("title"=>"新兵训练营——华尔街投行敲门砖","url"=>"wallstreetcn.com/node/25409","img"=>"http://img.wallstreetcn.com/sites/default/files/camps1213676376.jpg"),
        array("title"=>"投资白银的20个理由","url"=>"wallstreetcn.com/node/21421","img"=>"http://img.wallstreetcn.com/sites/default/files/20130114silver bullion.jpg"),
        array("title"=>"BCG：终结庞氏骗局之路","url"=>"wallstreetcn.com/node/20913","img"=>"http://img.wallstreetcn.com/sites/default/files/20121223_BCG.jpg"),
        array("title"=>"Ray Dalio：看空欧洲，期待美联储救市；Bridgewater的军规","url"=>"wallstreetcn.com/node/5896","img"=>"http://img.wallstreetcn.com/sites/default/files/OB-KO160_102210_D_20101022091531.jpg"),
        array("title"=>"索罗斯正在大力做空美股？","url"=>"wallstreetcn.com/node/53261","img"=>"http://img.wallstreetcn.com/sites/default/files/bernake-soros3333112211.jpg"),
        array("title"=>"顶级投资者的21条箴言","url"=>"wallstreetcn.com/node/21467","img"=>"http://img.wallstreetcn.com/sites/default/files/20130115buffet.jpg"),
        array("title"=>"图示四十年来全球制造业格局变化","url"=>"wallstreetcn.com/node/20844","img"=>"http://img.wallstreetcn.com/sites/default/files/20121221global manufacturing pic.JPG"),
        array("title"=>"【付鹏专栏】十年大宗背后那些不为人知的故事（五）","url"=>"wallstreetcn.com/node/52699","img"=>"http://img.wallstreetcn.com/sites/default/files/201307291925.jpg"),
        array("title"=>"你真的理解巴菲特吗？","url"=>"wallstreetcn.com/node/56705","img"=>"http://img.wallstreetcn.com/sites/default/files/2013090520504.jpg"),
        array("title"=>"全球六大恶性通胀经济体及其货币","url"=>"wallstreetcn.com/node/51246","img"=>"http://img.wallstreetcn.com/sites/default/files/won20130729130725.jpg"),
        array("title"=>"神秘的中国央行或将与前瞻指引无缘","url"=>"wallstreetcn.com/node/53029","img"=>"http://img.wallstreetcn.com/sites/default/files/u=407chuan.jpg"),
        array("title"=>"一张图了解美国影子银行体系","url"=>"wallstreetcn.com/node/50666","img"=>"http://img.wallstreetcn.com/sites/default/files/201307221722.jpg"),
        array("title"=>"【付鹏专栏】十年大宗背后那些不为人知的故事（六）","url"=>"wallstreetcn.com/node/53719","img"=>"http://img.wallstreetcn.com/sites/default/files/201308140157.jpg"),
        array("title"=>"Dalio的经济学原理——传统经济学存在误导","url"=>"wallstreetcn.com/node/58011","img"=>"http://img.wallstreetcn.com/sites/default/files/Hedge-tmagArticle.jpg"),
        array("title"=>"历史上央行退出QE会发生什么？","url"=>"wallstreetcn.com/node/68871","img"=>"http://img.wallstreetcn.com/sites/default/files/20131219_taper2.jpg"),
        array("title"=>"2013年，钱都被这十个家伙赚走了！","url"=>"wallstreetcn.com/node/68838","img"=>"http://img.wallstreetcn.com/sites/default/files/0R0062939-0.jpg"),
        array("title"=>"Ray Dalio：在对人性下注的时候要小心","url"=>"wallstreetcn.com/node/15380","img"=>"http://img.wallstreetcn.com/sites/default/files/201206270937.jpg"),
        array("title"=>"Black-Scholes期权定价模型: 比你想象中有效","url"=>"wallstreetcn.com/node/20462","img"=>"http://img.wallstreetcn.com/sites/default/files/bsgraphic.gif"),
        array("title"=>"巴菲特：廉颇老矣，尚能饭否","url"=>"wallstreetcn.com/node/19302","img"=>"http://img.wallstreetcn.com/sites/default/files/cvcf.jpg"),
        array("title"=>"付鹏专栏：LME的‘舞龙’与‘红酒’的转变","url"=>"wallstreetcn.com/node/50145","img"=>"http://img.wallstreetcn.com/sites/default/files/201307161852.jpg"),
        array("title"=>"外汇市场的艰难世道：没有趋势、没有收益","url"=>"wallstreetcn.com/node/50759","img"=>"http://img.wallstreetcn.com/sites/default/files/john-taylor-fx-concepts-australian-dollar.jpg"),
        array("title"=>"一张图阐述诺贝尔经济学奖得主对房地产泡沫的“神准”预测","url"=>"wallstreetcn.com/node/59780","img"=>"http://img.wallstreetcn.com/sites/default/files/20131014robert shiller.jpg"),
        array("title"=>"摩根大通灾难性交易的背后：让戴蒙寝食难安的一个月","url"=>"wallstreetcn.com/node/14135","img"=>"http://img.wallstreetcn.com/sites/default/files/6fc2c0e5jw1dt0i40wihgj.jpg"),
        array("title"=>"当今华尔街的超级尤物：Olga Tselinina ","url"=>"wallstreetcn.com/node/14707","img"=>"http://img.wallstreetcn.com/sites/default/files/etc_opener23__01__630x420.jpg"),
        array("title"=>"CNN采访称高盛统治世界的“业余交易员”","url"=>"wallstreetcn.com/node/6070","img"=>"http://img.wallstreetcn.com/sites/default/files/0927bbc.jpg"),
        array("title"=>"来认识一下那些鼓吹“中国崩溃论”的空头们","url"=>"wallstreetcn.com/node/15430","img"=>"http://img.wallstreetcn.com/sites/default/files/20120628all.jpg"),
        array("title"=>"黄金：闪耀光芒下隐藏的罪恶","url"=>"wallstreetcn.com/node/66968","img"=>"http://img.wallstreetcn.com/sites/default/files/goldminekill.jpg"),
        array("title"=>"Dennis Gartman的19条交易法则","url"=>"wallstreetcn.com/node/65783","img"=>"http://img.wallstreetcn.com/sites/default/files/Dennis Gartman20131201.jpg"),
        array("title"=>"【赏鲸之旅】21世纪的对冲交易","url"=>"wallstreetcn.com/node/13447","img"=>"http://img.wallstreetcn.com/sites/default/files/201204231526.jpg"),
        array("title"=>"Libor操纵案背后的做局者：汤姆-海耶斯（上）","url"=>"wallstreetcn.com/node/22217","img"=>"http://img.wallstreetcn.com/sites/default/files/20130216traderstelephone.jpg"),

    );
}
