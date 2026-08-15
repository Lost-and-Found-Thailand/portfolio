<?php
/**
 * Required fallback template (every WordPress theme needs one).
 * This theme is built around the front-page.php + page-{slug}.php
 * set for its six known pages, so this only renders for anything
 * outside that — e.g. a stray Page without a matching template, a
 * search result, or a 404. Kept plain rather than trying to imitate
 * the bespoke per-page designs above.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

  <section class="ldm-page-header container">
    <span class="eyebrow">Liam Digital Marketing</span>
    <h1 class="fs-h1"><?php echo have_posts() ? esc_html__( 'Nothing here yet.', 'liam-digital-marketing' ) : esc_html__( "This page doesn't exist.", 'liam-digital-marketing' ); ?></h1>
    <p class="lede"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">&larr; <?php esc_html_e( 'Back to the homepage', 'liam-digital-marketing' ); ?></a></p>
  </section>

  <?php if ( have_posts() ) : ?>
    <section class="ldm-section container container-narrow">
      <?php
      while ( have_posts() ) :
        the_post();
        ?>
        <article <?php post_class( 'card' ); ?> style="margin-bottom:24px;">
          <h2 class="fs-h3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <div class="text-gray"><?php the_excerpt(); ?></div>
        </article>
        <?php
      endwhile;
      ?>
    </section>
  <?php endif; ?>

<?php get_footer(); ?>
