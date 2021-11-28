<?php
get_header();
?>
<div class="sp-container">
    <div class="slider-section-title">
        <h2>Featured products</h2>
    </div>
    <div class="shp-slider-section">
        <div class="featured-product featured-product-wrap">
            <?php
            $featured_tax_query[] = array(
                'taxonomy' => 'product_visibility',
                'fields'   => 'name',
                'terms'    => 'featured',
                'operator' => 'IN',
            );
            $featured_product_args = array(
                'posts_per_page' => 2,
                'tax_query'      => $featured_tax_query,
            );
            $featured_product_query = new WP_Query($featured_product_args);
            while ($featured_product_query->have_posts()) : $featured_product_query->the_post();
                wc_get_template_part('content', 'product');
            endwhile;
            ?>
        </div>
        <div class="carousel-area bg-img">
            <?php
            $slider_args = array(
                'category_name'  => 'slider',
                'posts_per_page' => 3,
            );
            $slider_query = new WP_Query($slider_args);
            if ($slider_query->have_posts()) {
                echo '<ul class="main-slider cS-hidden">';
                while ($slider_query->have_posts()) : $slider_query->the_post();
                    if (has_post_thumbnail()) {
            ?>
                        <div class="single-slider bg-img overlay" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);">
                            <div class="slider-content-area content-wrap">
                                <h2 class="slider-title"><?php echo the_title(); ?></h2>
                                <div class="slider-content"><?php echo the_excerpt() ?></div>
                                <div class="slider-btn">
                                    <a href="<?php echo get_page_link(6); ?>"> Shop Now</a>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                endwhile;
                echo '</ul>';
            }
            ?>
            <div class="offer-area">
                <?php
                $popular_product_args = array(
                    'category_name' => 'popular',
                    'posts_per_page' => 2,
                );
                $popular_product_query = new WP_Query($popular_product_args);
                while ($popular_product_query->have_posts()) : $popular_product_query->the_post();
                ?>
                    <div class="popular-prod-wrapper">
                        <h2 class="popular-prod-title"><?php the_title(); ?></h2>
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="thumbnail">
                    </div>
                <?php
                endwhile;
                ?>
            </div>
        </div>
    </div>
    <div class="isotope-area">
        <h2><?php echo __('Discover more products', 'shp'); ?></h2>

        <?php $category_list = get_categories(
            array(
                'taxonomy' => 'product_cat',
                'title_li' => '',
                'hierarchical' => true,
                'parent' => 0
            )
        );
        echo '<ul class="category_titles_wrap">';
        foreach ($category_list as $category) {
        ?>
            <li class="category-title" data-filter=".product_cat-<?php echo $category->slug ?>"><a><?php echo $category->name ?></a></li>
        <?php
        }
        echo '</ul>';
        echo '<ul class="product-wrap">';
        foreach ($category_list as $cat) {
            $product_query_args = array(
                'post_type' => 'product',
                'post_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'name',
                        'terms' => $cat->name,
                    )
                )
            );
            $product_query = new WP_Query($product_query_args);
            while ($product_query->have_posts()) : $product_query->the_post();
                wc_get_template_part('content', 'product');
            endwhile;
        }
        echo '</ul>';
        ?>
    </div>
</div>
<?php
get_footer();
