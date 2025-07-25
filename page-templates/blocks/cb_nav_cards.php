<?php
$count = 0;
$cards = get_field('cards');
if (is_array($cards)) {
    $count = count($cards);
}
$numcards = $count == '4' ? 'col-md-6 col-lg-6' : 'col-md-6 col-lg-4';
?>
<div class="nav_cards py-5">
    <div class="container-xl">
        <div class="row g-4 justify-content-center">
            <?php
            $d = 0;
            while(have_rows('cards')) {
                the_row();
                $colour = get_sub_field('background') ?? 'black';
                $link_cta = get_sub_field('link_cta');
                if ( $link_cta == "" ) {
                     $link_cta = 'Learn more';
                }
                $l = get_sub_field('link') ?? null;
                if ( $l == null ) {
                    $nav_cards__link = "d-none";
                } else {
                    $nav_cards__link = "";
                }

                if (str_ends_with($l, ".pdf")) {
                    $target = "_blank";
                } else {
                    $target = "";
                }
                ?>
            <div class="<?=$numcards?>" data-aos="fade-up" data-aos-delay="<?=$d?>">
                <div class="nav_cards__card w-100">
                    <div class="nav_cards__icon bg--<?=$colour?>">
                        <img src="<?=get_sub_field('icon')?>" alt="<?=get_sub_field('title')?>">
                    </div>
                    <div class="nav_cards__inner bg--<?=$colour?>">
                        <h3><?=get_sub_field('title')?></h3>
                        <div class="nav_cards__content"><?=get_sub_field('content')?></div>
                        <a href="<?=$l?>" target="<?=$target?>" class="nav_cards__link text-white <?=$nav_cards__link?>"><i class="fa-solid fa-angle-right"></i> <?=$link_cta?></a>

                        <?php
                        $term = get_sub_field('event');
                        if( $term ):

                            $has_events = new WP_Query([
                                'post_type'      => 'tribe_events',
                                'post_status'    => 'publish',
                                'posts_per_page' => 1,
                                'tax_query'      => [
                                    [
                                        'taxonomy' => 'tribe_events_cat',
                                        'field'    => 'slug', // or 'term_id' or 'name'
                                        'terms'    => $term->slug
                                    ],
                                ],
                            ]);

                            if ( $has_events->have_posts() ) {
                            ?>
                            <a href="/courses/<?=$term->slug?>/" class="nav_cards__link text-white <?=$nav_cards__link?>"><i class="fa-solid fa-angle-right"></i> View available dates</a>
                            <?php
                            } else {
                            ?>
                            <a href="/contact/" class="nav_cards__link text-white <?=$nav_cards__link?>"><i class="fa-solid fa-angle-right"></i> Contact us for availability</a>
                            <?php
                            }

                            wp_reset_postdata(); // always good practice after WP_Query

                        endif;
                        ?>

                    </div>
                </div>
            </div>
                <?php
                $d+=100;
            }
            ?>
        </div>
    </div>
</div>