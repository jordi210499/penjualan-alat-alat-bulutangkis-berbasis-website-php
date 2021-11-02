<?php
/**
 * index.php
 *
 * The main template file.
 */
get_header();

get_template_part( 'template-parts/header/content', 'blog-header' );
$blog_setting = '';
if( defined('FW')) {
    $blog_setting = fw_get_db_customizer_option('news_settings');
}

$column = ($blog_setting == 'fullwidth' || !is_active_sidebar('sidebar-1')) ? 'col-lg-12' : 'col-lg-8 col-md-12';

if( $blog_setting == 'rightsidebar' ) {

?>

<section id="main-container" class="blog main-container" role="main">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<!-- 1st post start -->
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/post/content', get_post_format() ); ?>
					<?php endwhile; ?>
					<?php geobin_paging_nav(); ?>
				<?php else : ?>
					<?php get_template_part( 'template-parts/post/content', 'none' ); ?>
				<?php endif; ?>

			</div><!-- Content Col end -->

			<?php get_sidebar(); ?>
		</div><!-- Main row end -->

	</div><!-- Container end -->
</section><!-- Main container end -->
<?php } elseif ($blog_setting == 'fullwidth') { ?>

    <section id="main-container" class="blog main-container" role="main">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- 1st post start -->
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'template-parts/post/content', get_post_format() ); ?>
                    <?php endwhile; ?>
                        <?php geobin_paging_nav(); ?>
                    <?php else : ?>
                        <?php get_template_part( 'template-parts/post/content', 'none' ); ?>
                    <?php endif; ?>

                </div><!-- Content Col end -->

            </div><!-- Main row end -->

        </div><!-- Container end -->
    </section><!-- Main container end -->

<?php } elseif($blog_setting == 'leftsidebar') { ?>

    <section id="main-container" class="blog main-container" role="main">
        <div class="container">
            <div class="row">
                <?php get_sidebar(); ?>
                <div class="col-md-8">
                    <!-- 1st post start -->
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'template-parts/post/content', get_post_format() ); ?>
                    <?php endwhile; ?>
                        <?php geobin_paging_nav(); ?>
                    <?php else : ?>
                        <?php get_template_part( 'template-parts/post/content', 'none' ); ?>
                    <?php endif; ?>

                </div><!-- Content Col end -->

            </div><!-- Main row end -->

        </div><!-- Container end -->
    </section><!-- Main container end -->

<?php } else { ?>

    <section id="main-container" class="blog main-container" role="main">
        <div class="container">
            <div class="row">
                <div class="<?php echo esc_attr($column);?>">
                    <!-- 1st post start -->
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'template-parts/post/content', get_post_format() ); ?>
                    <?php endwhile; ?>
                        <?php geobin_paging_nav(); ?>
                    <?php else : ?>
                        <?php get_template_part( 'template-parts/post/content', 'none' ); ?>
                    <?php endif; ?>

                </div><!-- Content Col end -->

            </div><!-- Main row end -->

        </div><!-- Container end -->
    </section><!-- Main container end -->

<?php } ?>

<?php get_footer(); ?>

