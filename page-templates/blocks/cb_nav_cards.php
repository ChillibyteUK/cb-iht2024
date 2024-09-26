<?php
?>
<div class="nav_cards py-5">
    <div class="container-xl">
        <div class="row g-4">
            <?php
            while(have_rows('cards')) {
                the_row();
                $colour = get_sub_field('background') ?? 'black';
                ?>
            <div class="col-md-6 col-lg-4">
                <a class="nav_cards__card" href="<?=get_sub_field('link')['url'] ?? null?>">
                    <div class="nav_cards__icon bg--<?=$colour?>">
                        <img src="<?=get_sub_field('icon')?>" alt="<?=get_sub_field('title')?>">
                    </div>
                    <div class="nav_cards__inner bg--<?=$colour?>">
                        <h3><?=get_sub_field('title')?></h3>
                        <div class="nav_cards__content"><?=get_sub_field('content')?></div>
                        <div class="nav_cards__link"><i class="fa-solid fa-angle-right"></i> Learn more</div>
                    </div>
                </a>
            </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>