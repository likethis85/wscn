<?php
$theme_wscn = array(
    'x_recommand_rendered' => false,
    'x_topnews_rendered' => false,
    'x_recent_rendered' => false,
    'x_click_rendered' => false,
    'x_comments_rendered' => false,
);

drupal_theme_rebuild();
system_rebuild_theme_data();
// Auto-rebuild the theme registry during theme development.
if (theme_get_setting('clear_registry')) {
    // Rebuild .info data.
    system_rebuild_theme_data();
    // Rebuild theme registry.
    drupal_theme_rebuild();
}


function wscn_image_url($item) {
    if ($item->file_managed_field_data_upload_uri) {
        return file_create_url($item->file_managed_field_data_upload_uri);
    } elseif($item->field_field_image_1) {
        return file_create_url($item->field_field_image_1[0]['raw']['uri']);
    }
    return '';
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

/**
* Implements hook_form_alter().
*/
function bootstrap_form_alter(&$form, &$form_state, $form_id) {
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

/**
* Implements hook_form_FORM_ID_alter() for search_form().
*/
function bootstrap_form_search_form_alter(&$form, &$form_state) {
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

/**
* Implements hook_form_FORM_ID_alter() for search_block_form().
*/
function bootstrap_form_search_block_form_alter(&$form, &$form_state) {
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

/**
* Returns HTML for a form element.
*/
function bootstrap_form_element(&$variables) {
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

/**
* Returns HTML for a form element label and required marker.
*/
function bootstrap_form_element_label(&$variables) {
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

/**
* Preprocessor for theme('button').
*/
function bootstrap_preprocess_button(&$vars) {
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

/**
* Returns HTML for a button form element.
*/
function bootstrap_button($variables) {
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

/**
* Returns an array containing ids of any whitelisted drupal elements
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
