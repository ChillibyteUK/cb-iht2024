<?php
$count = 0;
?>
<div class="hoverblocks py-5">
    <div class="container-xl">
        <div class="row g-4 justify-content-center">
            <?php
            $d = 0;
            while(have_rows('cards')) {
                the_row();
                ?>
            <div class="<?=$numcards?>" data-aos="fade-up" data-aos-delay="<?=$d?>">
                <div class="nav_cards__card w-100">
                    <div class="nav_cards__inner bg--<?=$colour?>">
                        <h3><?=get_sub_field('title')?></h3>
                        <div class="nav_cards__content"><?=get_sub_field('content')?></div>
                        <a href="<?=$l?>" target="<?=$target?>" class="nav_cards__link text-white <?=$nav_cards__link?>"><i class="fa-solid fa-angle-right"></i> Learn more</a>
                        <?php if (str_ends_with($l, ".pdf")) { ?>
                        <a href="/courses/" class="nav_cards__link text-white <?=$nav_cards__link?>"><i class="fa-solid fa-angle-right"></i> View available dates</a>
                        <?php } ?>
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