<style>
.hover_container {
    position: relative;
    width: 50%;
}

.image {
    display: block;
    width: 100%;
    height: auto;
}

.overlay {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    height: 100%;
    width: 100%;
    opacity: 0;
    transition: .5s ease;
    background-color: #008CBA;
}

.hover_container:hover .overlay {
    opacity: 1;
}

.text {
    color: white;
    font-size: 20px;
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    text-align: center;
}
</style>
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
                    <div class="hover_container">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="image" />
                        <div class="overlay">
                            <div class="text"><?=get_sub_field('text')?></div>
                        </div>
                    </div>
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