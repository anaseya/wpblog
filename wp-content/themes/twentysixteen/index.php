/* 
   Template Name: Theme Name: TwentySixteen
 */

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<?php get_header() ?>

<div class="container">

    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <h2 class="text-center">
                    <strong>Write Post</strong>
                </h2>
                <div class="row"><!-- separator -->&nbsp;</div>
                <form id="blogform" class="form-horizontal" role="form" name="blogform" method="post" action="">

                    <div class="form-group">
<!--                        <label class="col-sm-1 control-label" for="post-title">--><?php //_e('Title', 'framework') ?><!--</label>-->
                        <div class="col-sm-12">
                            <input class="form-control" id="post-title" name="post-title" placeholder="Title" value="" type="text">
                        </div>
                    </div>
                    <div class="row"><!-- separator -->&nbsp;</div>
                    <div class="form-group ajx-err">
                        <div class="col-sm-12">
                            <input style="width:100%" class="form-control required mceEditor" id="blogtextarea" name="blogtextarea" value="" type="text">
                        </div>
                    </div>
                    <fieldset>
                        <p align="right"><button type="submit" id="blogSubmit" class="btn btn-primary"   name="blogSubmit" value="Publish" ><?php _e('Publish', 'framework') ?></button></p>

                        <?php wp_nonce_field( 'blog_form_ajax_callback' ); ?>
                    </fieldset>
                </form>

                <hr/>

            </div>
            <!-- startlistposts-ajaxcall9382 -->
            <div id="ajax9382">
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                    'posts_per_page' => 20,// 20<<< posts per page
                    'paged' => $paged
                );
                $myposts = query_posts( $args );

                if ( ! empty($myposts) && count($myposts) > 0 ) :

                    foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
                        <div class="col-lg-12 text-left listposts">
                            <h2> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <br />
                                <small><?php _e(get_the_modified_date()); ?></small>
                            </h2>

                            <p><div class="excerpt"><?php the_excerpt(); ?></div></p>
                            <p><div class="content">
                                <?php
                                the_content();
                                ?>
                                <div class="cleared"></div>
                                <div id="comment"><div class="cleared"></div>
                                    <?php
                                    comments_template();
                                    comment_form(customCommentForm());
                                    ?>
                                    <div id="view-less-icon">
                                        <a href="#" class="view-less">view less <span class="glyphicon glyphicon-circle-arrow-up"></span></a>
                                    </div>
                                </div>
                            </div>
                            </p>
                            <hr/>
                        </div>

                    <?php endforeach;
                    wp_reset_postdata();

                else :
                    echo '<h1>Posts are not founded</h1>';

                endif;

                ?>
            </div>
        </div>

        <!-- endlistposts-ajaxcall9382 -->
    </div> <!-- end ajax9382 response -->
    <?php wp_numeric_posts_nav(); ?>
</div>
<!-- /.container -->

<?php get_footer() ?>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src= <?php echo get_template_directory_uri() ?>/js/bootstrap.min.js></script>
<script type="text/javascript" src= <?php echo get_template_directory_uri() ?>/js/custom.js></script>
<script type="text/javascript" src= <?php echo get_template_directory_uri() ?>/js/tinymce/tinymce.min.js></script>


</body>

</html>