<?php get_header(); ?>
    <article>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <header>
            <h1 id="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
        </header>
        <div id="post-content">
            <div class="entry">
                <p><?php _e('Publicado em: '); ?><time class="updated" datetime="<?php echo get_the_date('c'); ?>" pubdate="pubdate"><?php the_time('j \d\e F \d\e Y'); ?></time></p>
                <?php the_content(); ?>
                <h5>Serviço:</h5>
                <div class="group">
                    <div class="agenda-column float-left">
                        <p>
                            <strong><?php _e('Banda(s):'); ?></strong><br />
                            <?php
                                $dfw_agenda_bandas = str_replace("\n", '<br />', get_post_meta($post->ID, 'dfw_agenda_bandas', true)); 
                                echo $dfw_agenda_bandas;
                            ?>
                        </p>
                        <p>
                            <strong>Local:</strong><br />
                            <?php echo get_post_meta($post->ID, 'dfw_agenda_local', true); ?>
                        </p>
                        <p>
                            <strong><?php _e('Data/Hora:'); ?></strong><br />
                            <?php echo get_post_meta($post->ID, 'dfw_agenda_date', true); ?> às <?php echo get_post_meta($post->ID, 'dfw_agenda_date_h', true). ':' . get_post_meta($post->ID, 'dfw_agenda_date_m', true); ?>
                        </p>
                        <p>
                            <strong><?php _e('Endereço:'); ?></strong><br />
                            <?php 
                                $dfw_agenda_end = get_post_meta($post->ID, 'dfw_agenda_end', true);
                                $dfw_agenda_nei = get_post_meta($post->ID, 'dfw_agenda_nei', true);
                                $dfw_agenda_city = get_post_meta($post->ID, 'dfw_agenda_city', true);
                                $dfw_agenda_state = get_post_meta($post->ID, 'dfw_agenda_state', true);

                                echo $dfw_agenda_end . '<br />' . $dfw_agenda_nei . '<br />' . $dfw_agenda_city . '/' . $dfw_agenda_state . '';
                            ?>
                        </p>
                        <p>
                            <strong><?php _e('Realização:'); ?></strong><br />
                            <?php
                                $dfw_agenda_prod = get_post_meta($post->ID, 'dfw_agenda_prod', true);
                                $dfw_agenda_prod_s = get_post_meta($post->ID, 'dfw_agenda_prod_s', true);
                                $dfw_agenda_prod_e = get_post_meta($post->ID, 'dfw_agenda_prod_e', true);
                                $dfw_agenda_prod_t = get_post_meta($post->ID, 'dfw_agenda_prod_t', true);
                                if($dfw_agenda_prod_s) {
                                    echo '<a href="'. $dfw_agenda_prod_s .'" target="_blank" rel="nofollow">' . $dfw_agenda_prod . '</a>';
                                }
                                else {
                                    echo $dfw_agenda_prod;
                                }
                                if($dfw_agenda_prod_e) {
                                    echo '<br /><a href="mailto:'. $dfw_agenda_prod_e .'">'. $dfw_agenda_prod_e .'</a>';
                                }
                                if($dfw_agenda_prod_t) {
                                    echo '<br />'. $dfw_agenda_prod_t;
                                }
                            ?>
                        </p>
                    </div>
                    <div class="agenda-column float-right">
                        <p>
                            <strong><?php _e('Ingressos:'); ?></strong><br />
                            <?php
                                $dfw_agenda_tickets = str_replace("\n", '<br />', get_post_meta($post->ID, 'dfw_agenda_tickets', true)); 
                                echo $dfw_agenda_tickets;
                            ?>
                        </p>
                        <p>
                            <strong><?php _e('Pontos de venda:'); ?></strong><br />
                            <?php
                                $dfw_agenda_sale =  str_replace("\n", '<br />', get_post_meta($post->ID, 'dfw_agenda_sale', true));
                                $dfw_agenda_sale = preg_replace("#((http)://(\S*?\.\S*?))(\s|\;|\)|\]|\[|\{|\}|,|\"|'|:|\<|$|\.\s)#ie", "'<a href=\"$1\" target=\"_blank\">$1</a>$4'", $dfw_agenda_sale);
                                echo $dfw_agenda_sale;
                            ?>
                        </p>
                    </div>
                </div>
                <?php                   
                    $dfw_google_maps = $dfw_agenda_end . ',' . $dfw_agenda_city . '-' . $dfw_agenda_state;
                    $dfw_google_maps = urlencode($dfw_google_maps);
                ?>
                <p><iframe width="620" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt-BR&amp;geocode=&amp;q=<?php echo $dfw_google_maps; ?>&amp;ie=UTF8&amp;output=embed"></iframe></p>
                <p><strong><?php _e('Fonte: '); ?></strong><?php
                $dfw_agenda_source = get_post_meta($post->ID, 'dfw_agenda_source', true);
                $dfw_agenda_source_s = get_post_meta($post->ID, 'dfw_agenda_source_s', true);
                if($dfw_agenda_source_s) {
                    echo '<a href="'. $dfw_agenda_source_s .'" target="_blank" rel="nofollow">' . $dfw_agenda_source . '</a>';
                }
                else {
                    echo $dfw_agenda_source;
                }
                ?></p>
            </div>
            <?php endwhile; endif; ?>
        </div>
    </article>
    <div id="sidebar">
        <?php get_sidebar(); ?>
    </div>
<?php get_footer(); ?>
