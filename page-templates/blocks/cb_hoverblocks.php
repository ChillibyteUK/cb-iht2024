<div class="hoverblocks py-5">
    <div class="container-xl">
        <div class="row g-4 justify-content-center">
            <?php
            while(have_rows('blocks')) {
                the_row();
                ?>
            <div class="col-md-4 col-lg-6">
                <?php 
                $image = get_sub_field('image');
                if( !empty( $image ) ): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                <?php endif; ?>
                <h3><?=get_sub_field('title')?></h3>
                 <div class=""><?=get_sub_field('text')?></div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>