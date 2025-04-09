<?php
$accordion = random_str(5);
$counter = 0;
$show = '';
$collapsed = 'collapsed';
$expanded = 'false';
$collapse = '';
$button = 'collapsed';
?>
<section class="faqs faqs pb-4 pt-2">
    <div class="container-xl">
        <div id="accordion<?=$accordion?>" class="accordion">
        <?php
            while (have_rows('faqs')) {
                the_row();
                $ac = $accordion . '_' . $counter;
                ?>
            <div class="accordion-item" style="background-color: <?=get_sub_field("background_colour")?>; color: <?=get_sub_field("text_colour")?>;">
                <div class="accordion-header">
                    <button class="accordion-button <?=$button?>"
                        type="button" data-bs-toggle="collapse"
                        data-bs-target="#c<?=$ac?>"
                        aria-expanded="<?=$expanded?>"
                        aria-controls="c<?=$ac?>">
                        <?=get_sub_field('question')?>
                    </button>
                </div>
                <div id="c<?=$ac?>"
                    class="answer collapse <?=$show?>" itemscope=""
                    data-bs-parent="#accordion<?=$accordion?>">
                    <div class="accordion-body" itemprop="text">
                        <?=get_sub_field('answer')?>
                    </div>
                </div>
            </div>
                <?php
                $counter++;
                $show = '';
                $collapsed = 'collapsed';
            }
            ?>
        </div>
    </div>
</section>