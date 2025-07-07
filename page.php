<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();

$theme = get_field('theme') ?: 'blue';
?>
<main id="main" class="theme--<?=$theme?>">
    <?php
    if ( is_page(275) || has_post_parent(275) ) {
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