<?php
// Add metabox
function dfw_admin_agenda_metabox() {
    add_meta_box(
        'dfw-agenda-metabox',
        'Detalhes do evento',
        'dfw_admin_agenda_metabox_content',
        'agenda',
        'advanced'
    );
}
add_action('admin_init', 'dfw_admin_agenda_metabox');

// Set numbers
function dfw_agenda_set_zeros($number, $n) {
    return str_pad((int) $number, $n, '0', STR_PAD_LEFT);
}

// Add contant for metabox
function dfw_admin_agenda_metabox_content() {
    global $post;
?>
<script src="<?php bloginfo('template_url');?>/agenda/js/agenda-admin-metabox.js" type="text/javascript"></script>
<div id="dfw-agenda-box-wrap">
    <h4><?php _e('Atrações:'); ?></h4>
    <table class="dfw-agenda-metabox">
        <tr>
            <th>
                <label for="dfw_agenda_bandas"><?php _e('Banda(s):'); ?></label>
            </th>
            <td>
                <textarea name="dfw_agenda_bandas" id="dfw_agenda_bandas" cols="50" rows="5"><?php echo get_post_meta($post->ID, 'dfw_agenda_bandas', true); ?></textarea>
            </td>
        </tr>
    </table>
    <h4><?php _e('Local e Data'); ?></h4>
    <table class="dfw-agenda-metabox">
        <tr>
            <th>
                <label for="dfw_agenda_local"><?php _e('Local:'); ?></label>
            </th>
            <td>
                <input value="<?php echo get_post_meta($post->ID, 'dfw_agenda_local', true); ?>" name="dfw_agenda_local" id="dfw_agenda_local" type="text" class="regular-text" placeholder="<?php _e('Nome da casa de eventos'); ?>" />
            </td>
        </tr>
        <tr>
            <th>
                <label for="dfw_agenda_date"><?php _e('Data e hora:'); ?></label>
            </th>
            <td>
                <input value="<?php echo get_post_meta($post->ID, 'dfw_agenda_date', true); ?>" name="dfw_agenda_date" id="dfw_agenda_date" type="text" class="regular-text" />
                <?php _e('às'); ?>
                <select name="dfw_agenda_date_h" class="dfw-agenda-date-select">
                    <?php
                    for($d = 0; $d <= 23; $d++) :

                        $dfw_agenda_hour = dfw_agenda_set_zeros($d, 2);
                        if (get_post_meta($post->ID, 'dfw_agenda_date_h', true) == $dfw_agenda_hour) :
                            $current = ' selected="selected"';
                        else :
                            $current = '';
                        endif;

                        echo '<option'. $current .'>'. $dfw_agenda_hour .'</option>';

                    endfor;
                    ?>
                </select>
                :
                <select name="dfw_agenda_date_m" class="dfw-agenda-date-select">
                    <?php
                    for($d = 0; $d <= 59; $d++) :

                        $dfw_agenda_min = dfw_agenda_set_zeros($d, 2);
                        if (get_post_meta($post->ID, 'dfw_agenda_date_m', true) == $dfw_agenda_min) :
                            $current = ' selected="selected"';
                        else :
                            $current = '';
                        endif;

                        echo '<option'. $current .'>'. $dfw_agenda_min .'</option>';

                    endfor;
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>
                <label for="dfw_agenda_end"><?php _e('Endereço:'); ?></label>
            </th>
            <td>
                <input value="<?php echo get_post_meta($post->ID, 'dfw_agenda_end', true); ?>" name="dfw_agenda_end" id="dfw_agenda_end" type="text" class="regular-text" placeholder="<?php _e('Rua e número (separados por vírgula)'); ?>" />
            </td>
        </tr>
        <tr>
            <th>
                <label for="dfw_agenda_nei"><?php _e('Bairro:'); ?></label>
            </th>
            <td>
                <input value="<?php echo get_post_meta($post->ID, 'dfw_agenda_nei', true); ?>" name="dfw_agenda_nei" id="dfw_agenda_nei" type="text" class="regular-text" />
            </td>
        </tr>
        <tr>
            <th>
                <label for="dfw_agenda_city"><?php _e('Cidade:'); ?></label>
            </th>
            <td>
                <input value="<?php echo get_post_meta($post->ID, 'dfw_agenda_city', true); ?>" name="dfw_agenda_city" id="dfw_agenda_city" type="text" class="regular-text" />
            </td>
        </tr>
        <tr>
            <th>
                <label for="dfw_agenda_state"><?php _e('Estado:'); ?></label>
            </th>
            <td>
                <select name="dfw_agenda_state" id="dfw_agenda_state" class="dfw-agenda-date-select">
                <?php
                    $dfw_agenda_states = array('AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO');
                    $dfw_agenda_current_state = get_post_meta($post->ID, 'dfw_agenda_state', true);

                    foreach ($dfw_agenda_states as $state) { ?>
                    <option <?php if ($dfw_agenda_current_state == $state) { echo 'selected="selected"'; } ?>><?php echo $state; ?></option><?php } ?>
                </select>
            </td>
        </tr>
    </table>
    <h4>Produtora</h4>
    <table class="dfw-agenda-metabox">
        <tr>
            <th>
                <label for="dfw_agenda_prod"><?php _e('Nome:'); ?></label>
            </th>
            <td>
                <input value="<?php echo get_post_meta($post->ID, 'dfw_agenda_prod', true); ?>" name="dfw_agenda_prod" id="dfw_agenda_prod" type="text" class="regular-text" />
            </td>
        </tr>
        <tr>
            <th>
                <label for="dfw_agenda_prod_s"><?php _e('Website:'); ?></label>
            </th>
            <td>
                <input value="<?php echo get_post_meta($post->ID, 'dfw_agenda_prod_s', true); ?>" name="dfw_agenda_prod_s" id="dfw_agenda_prod_s" type="text" class="regular-text" placeholder="<?php _e('http://'); ?>" />
                <span class="description"><?php _e('Campo opcional'); ?></span>
            </td>
        </tr>
        <tr>
            <th>
                <label for="dfw_agenda_prod_e"><?php _e('E-mail:'); ?></label>
            </th>
            <td>
                <input value="<?php echo get_post_meta($post->ID, 'dfw_agenda_prod_e', true); ?>" name="dfw_agenda_prod_e" id="dfw_agenda_prod_e" type="text" class="regular-text" />
                <span class="description"><?php _e('Campo opcional'); ?></span>
            </td>
        </tr>
        <tr>
            <th>
                <label for="dfw_agenda_prod_t"><?php _e('Telefone:'); ?></label>
            </th>
            <td>
                <input value="<?php echo get_post_meta($post->ID, 'dfw_agenda_prod_t', true); ?>" name="dfw_agenda_prod_t" id="dfw_agenda_prod_t" type="text" class="regular-text" placeholder="<?php _e('(xx) xxxx-xxxx'); ?>" />
                <span class="description"><?php _e('Campo opcional'); ?></span>
            </td>
        </tr>
    </table>
    <h4>Ingressos</h4>
    <table class="dfw-agenda-metabox">
        <tr>
            <th>
                <label for="dfw_agenda_tickets"><?php _e('Valores:'); ?></label>
            </th>
            <td>
                <textarea name="dfw_agenda_tickets" id="dfw_agenda_tickets" cols="50" rows="5"><?php echo get_post_meta($post->ID, 'dfw_agenda_tickets', true); ?></textarea>
            </td>
        </tr>
        <tr>
            <th>
                <label for="dfw_agenda_sale"><?php _e('Pontos de venda:'); ?></label>
            </th>
            <td>
                <textarea name="dfw_agenda_sale" id="dfw_agenda_sale" cols="50" rows="5" placeholder="Endereços de websites com http://"><?php echo get_post_meta($post->ID, 'dfw_agenda_sale', true); ?></textarea>
            </td>
        </tr>
    </table>
    <h4>Fonte</h4>
    <table class="dfw-agenda-metabox">
        <tr>
            <th>
                <label for="dfw_agenda_source"><?php _e('Nome:'); ?></label>
            </th>
            <td>
                <input value="<?php echo get_post_meta($post->ID, 'dfw_agenda_source', true); ?>" name="dfw_agenda_source" id="dfw_agenda_source" type="text" class="regular-text" />
            </td>
        </tr>
        <tr>
            <th>
                <label for="dfw_agenda_source_s"><?php _e('Website:'); ?></label>
            </th>
            <td>
                <input value="<?php echo get_post_meta($post->ID, 'dfw_agenda_source_s', true); ?>" name="dfw_agenda_source_s" id="dfw_agenda_source_s" type="text" class="regular-text" placeholder="<?php _e('http://'); ?>" />
            </td>
        </tr>
    </table>
</div>
    <?php
}

// Save metabox
function dfw_admin_agenda_save_metabox($post_id) {
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;

    if (!current_user_can('edit_post', $post_id))
        return $post_id;

    if (get_post_type($post_id) == 'agenda' && $_POST) {
        
        $agenda_fields = array(
            'dfw_agenda_bandas',
            'dfw_agenda_date',
            'dfw_agenda_date_h',
            'dfw_agenda_date_m',
            'dfw_agenda_local',
            'dfw_agenda_end',
            'dfw_agenda_nei',
            'dfw_agenda_city',
            'dfw_agenda_state',
            'dfw_agenda_prod',
            'dfw_agenda_prod_s',
            'dfw_agenda_prod_e',
            'dfw_agenda_prod_t',
            'dfw_agenda_tickets',
            'dfw_agenda_sale',
            'dfw_agenda_source',
            'dfw_agenda_source_s',
        );
        
        foreach ($agenda_fields as $field) :

            $value_old = get_post_meta($post_id, $field, true);
            $value_new = esc_attr($_POST[$field]);

            if (!$value_new) {
                if ($value_old)
                    delete_post_meta($post_id, $field, $value_old);
            } else {
                update_post_meta($post_id, $field, $value_new);
            }
        
        endforeach;
        
    }

    return $post_id;
}
add_action('save_post', 'dfw_admin_agenda_save_metabox');
?>