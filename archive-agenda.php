<?php get_header(); ?>
    <article>
        <header>
            <h2>Agenda de shows</h2>   
        </header>
        <div class="entry">
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    $('#dfw-calendar').fullCalendar({
                        timeFormat: {
                            '': 'HH:mm'
                        },
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,basicWeek,basicDay'
                        },
                        editable: false,
                        events: [
                            
                            <?php
                                $dfw_agenda_args = array(
                                    'post_type' => 'agenda',
                                    'posts_per_page' => 30,
                                    'meta_key' => 'dfw_agenda_date',
                                    'meta_value' => dfw_agenda_meta_value(),
                                    'meta_compare' => 'IN'
                                );
                                $dfw_agenda_query = new WP_Query($dfw_agenda_args);
                                $dfw_agenda_total = $dfw_agenda_query->post_count;
                                while ( $dfw_agenda_query->have_posts() ) : $dfw_agenda_query->the_post();
                                $dfw_agenda_date = explode('/', get_post_meta($post->ID, 'dfw_agenda_date', true));
                                $dfw_agenda_year = $dfw_agenda_date[2];
                                $dfw_agenda_month = $dfw_agenda_date[1] - 1;
                                $dfw_agenda_day = $dfw_agenda_date[0];
                                $dfw_agenda_hour = get_post_meta($post->ID, 'dfw_agenda_date_h', true);
                                $dfw_agenda_min = get_post_meta($post->ID, 'dfw_agenda_date_m', true);
                            ?>
                            {
                                title: '<?php the_title(); ?>',
                                start: new Date(<?php echo $dfw_agenda_year . ', ' . $dfw_agenda_month . ', ' . $dfw_agenda_day . ', ' . $dfw_agenda_hour . ', ' . $dfw_agenda_min; ?>),
                                allDay: false,
                                url: '<?php the_permalink(); ?>'
                            }<?php 
                            // Removes the last comma to work in internet explorer
                            if($dfw_agenda_query->current_post != $dfw_agenda_total -1) : ?>,<?php endif; ?>
                            
                            <?php endwhile; ?>
                        ]
                    });	
                });
            </script>            
            <div id="dfw-calendar"></div>
        </div>
    </article>
<?php get_footer(); ?>