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
                <a class="nav_cards__card w-100" href="<?=$l?>" target="<?=$target?>">
                    <div class="nav_cards__icon bg--<?=$colour?>">
                        <img src="<?=get_sub_field('icon')?>" alt="<?=get_sub_field('title')?>">
                    </div>
                    <div class="nav_cards__inner bg--<?=$colour?>">
                        <h3><?=get_sub_field('title')?></h3>
                        <div class="nav_cards__content"><?=get_sub_field('content')?></div>
                        <div class="nav_cards__link <?=$nav_cards__link?>"><i class="fa-solid fa-angle-right"></i> Learn more</div>
                        <?php
                        if (str_ends_with($l, ".pdf")) {
                        ?>
                        <a href="/courses/" class="text-white nav_cards__link <?=$nav_cards__link?>"><i class="fa-solid fa-angle-right"></i> View available dates</a>
                        <?php
                        }
                        ?>
                    </div>
                </a>
            </div>
                <?php
                $d+=100;
            }
            ?>
        </div>
    </div>
</div>