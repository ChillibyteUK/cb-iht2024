<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();

$theme = get_field('theme') ?: 'blue';
?>
<main id="main" class="theme--<?=$theme?>">
    <?php
    // Get current page ID
    $current_id = get_queried_object_id();

    // Get its parent ID (0 if no parent)
    $parent_id  = wp_get_post_parent_id( $current_id );

    if ( $current_id === 275 || $parent_id === 275 ) {
    ?>
    <section class="hero  hero--short">
        <img fetchpriority="high" decoding="async" width="1811" height="574" src="/wp-content/uploads/2025/03/Education-Training.jpg" class="hero__bg" alt="Course Calendar" sizes="(max-width: 1811px) 100vw, 1811px">
        <div class="container-xl py-4">
            <div class="row">
                <div class="col-lg-8">
                    <h1 data-aos="fade-right" class="aos-init aos-animate"><? the_title(); ?></h1>
                </div>
            </div>
        </div>
    </section>
    <?php
    }
    
    the_post();    
    the_content(); 
    ?>
</main>
<?php
get_footer();