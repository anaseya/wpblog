
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<?php get_header() ?>





<div class="container">

    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center">
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong>
                </h2>
                <?php the_content(); ?>
                <div class="cleared"></div>
                <div id="comment"><div class="cleared"></div>
                    <?php
                    comments_template();
                    comment_form(customCommentForm());
                    ?>
                </div>
                <?php endwhile; else: ?>
                    <?php _e( 'Sorry, no pages matched your criteria.', 'textdomain' ); ?>
                <?php endif; ?>
                <hr>
            </div>


        </div>
    </div>
</div>


<?php get_footer() ?>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src= <?php echo get_template_directory_uri() ?>/js/bootstrap.min.js></script>
<script type="text/javascript" src= <?php echo get_template_directory_uri() ?>/js/custom.js></script>
<script type="text/javascript" src= <?php echo get_template_directory_uri() ?>/js/tinymce/tinymce.min.js></script>

</body>

</html>