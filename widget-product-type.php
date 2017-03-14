<?php
/*
 * Image Text Widget
 *
 * This file displays the Image Text widget in Genesis themes.
 *
 * @package Image Text Widget
 * @author  Macchiato Marketing
 * @license GPL-2.0+
 * @link    http://macchiatomarketing.com
 */
?>
<?php $imageThumbURL = get_field('widget_image',$acfw);?>


<div class="product-type__widget">
    <h3 class="product-type__title"><?php echo get_field('widget_title',$acfw); ?></h3>

    <img class="product-type__image" src="<?php echo $imageThumbURL; ?>" alt="<?php echo get_field('widget_title',$acfw); ?>" />

    <div class="product-type__description"><?php echo get_field('widget_description',$acfw); ?></div>

    <a class="product-type__link" href="<?php get_field('page_link', $acfw); ?>"><button>Shop <?php echo get_field('widget_title',$acfw); ?></button></a>

</div>