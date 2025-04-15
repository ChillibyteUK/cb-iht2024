<div class="hoverblocks py-5">
    <div class="container-xl">
        <div class="row g-4 justify-content-center">
            <?php
            while(have_rows('blocks')) {
                the_row();
                ?>
            <div class="card col-md-4 col-lg-4">
                <?php 
                $image = get_sub_field('image');
                if( !empty( $image ) ): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?=get_sub_field('title')?></h5>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>