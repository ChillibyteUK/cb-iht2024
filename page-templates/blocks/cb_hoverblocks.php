<style>
/* The flip card container - set the width and height to whatever you want. We have added the border property to demonstrate that the flip itself goes out of the box on hover (remove perspective if you don't want the 3D effect */
.flip-card {
  background-color: transparent;
  width: 300px;
  height: 200px;
  border: 1px solid #f1f1f1;
  perspective: 1000px; /* Remove this if you don't want the 3D effect */
}

/* This container is needed to position the front and back side */
.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.8s;
  transform-style: preserve-3d;
}

/* Do an horizontal flip when you move the mouse over the flip box container */
.flip-card:hover .flip-card-inner {
  transform: rotateY(180deg);
}

/* Position the front and back side */
.flip-card-front, .flip-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden; /* Safari */
  backface-visibility: hidden;
}

/* Style the front side (fallback if image is missing) */
.flip-card-front {
  background-color: #bbb;
  color: black;
}

/* Style the back side */
.flip-card-back {
  background-color: dodgerblue;
  color: white;
  transform: rotateY(180deg);
}
</style>
<div class="hoverblocks py-5">
    <div class="container-xl">
        <div class="row g-4 justify-content-center">
            <?php
            while(have_rows('blocks')) {
                the_row();
                ?>
            <div class="card flip-card col-md-4 col-lg-4">
                <div class="flip-card-inner">
                    <?php 
                    $image = get_sub_field('image');
                    if( !empty( $image ) ): ?>
                    <div class="flip-card-front">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="image" />
                    </div>
                    <?php endif; ?>
                    <div class="flip-card-back">
                        <h5 class="card-title"><?=get_sub_field('title')?></h5>
                        <?=get_sub_field('text')?>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>