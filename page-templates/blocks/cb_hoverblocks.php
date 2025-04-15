<style>
.flip-card {
    perspective: 1000px;
}
.flip-card-inner {
    position: relative;
    width: 100%;
    height: 300px;
    transition: transform 0.6s;
    transform-style: preserve-3d;
}
.flip-card:hover .flip-card-inner {
    transform: rotateY(180deg);
}
.flip-card-front,
.flip-card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    border-radius: 0.5rem;
    overflow: hidden;
}
.flip-card-front img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.flip-card-back {
    background-color: #f8f9fa;
    color: #333;
    transform: rotateY(180deg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
}
</style>
<div class="hoverblocks py-5">
    <div class="container-xl">
        <div class="row g-4 justify-content-center">
            <?php
            while(have_rows('blocks')) {
                the_row();
                ?>
            <div class="col-md-4 col-lg-4">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <?php
                            $image = get_sub_field('image');
                            ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="image" />
                        </div>
                        <div class="flip-card-back">
                            <div class="p-4">
                                <h5 class="fs-6"><?=get_sub_field('title')?></h5>
                                <?=get_sub_field('text')?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>