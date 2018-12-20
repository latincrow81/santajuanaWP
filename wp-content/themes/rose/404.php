<?php get_header(); ?>
	<section id="404">
            <div class="container">
                <div class="page-404 text-center">
                    <div class="tb">
                        <dib class="tb-cell ver-middle">
                            <h2><?php echo esc_html__('404', 'rose') ?></h2>
                            <h6><?php echo esc_html__('SORRY, PAGE NOT FOUND !', 'rose') ?></h6>
                            <form action="<?php echo esc_url( home_url( '/' ) ); ?>"  method="get" class="form-search">
                                <input type="search" name="s" class="input-text" value="<?php echo esc_attr(the_search_query()); ?>" placeholder="<?php echo esc_attr_e('Search...', 'rose') ?>">
                                <button class="submit"><i class="fa fa-search"></i></button>
                            </form>
                            <p><?php echo esc_html__('Please try your search again or go to.', 'rose') ?></p>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button"><i class="fa fa-home"></i><?php echo esc_html__('Home page', 'rose') ?></a>
                        </dib>
                    </div>
                </div>
            </div>
        </section>
<?php get_footer(); ?>