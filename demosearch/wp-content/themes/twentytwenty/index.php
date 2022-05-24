<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>
	<!-- <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
		<select name="tinh_tp" id="tinh_tp">
		<?php 
		echo '<option value="all" data-idp="-1">Chọn Huyện/Thành Phố</option>';
		$terms = get_terms( array(
			'taxonomy' => 'dia_diem',
			'hide_empty' => 0,
			'parent' => 0
		) );	
		foreach ($terms  as $term ) {?>
			<option data-idp="<?=$term->term_id?>" value="<?php echo $term->slug ?>"><?php echo $term->name ?></option>
			<?php 
		}
		?>
		</select>
			<select name="xa_huyen" id="xa_huyen">
			<?php 
		echo '<option value="all">Chọn xã phường</option>';
					?>
		</select>
		<select class="form-control tag-select">
			<option value="">Loại nhà đất</option>
			<option value="Căn hộ">Căn hộ</option>
			<option value="Chung cư">Chung cư</option>
			<option value="Nhà ở">Nhà ở</option>
        </select>
		<select class="form-control tag-select" name="category4">
			<option value="">Hướng</option>
			<option value="Hướng Bắc">Hướng Bắc</option>
			<option value="Hướng Đông Bắc">Hướng Đông Bắc</option>	
			<option value="Hướng Đông Nam">Hướng Đông Nam</option>
			<option value="Hướng Nam">Hướng Nam</option>
			<option value="Hướng Tây Bắc">Hướng Tây Bắc</option>
    		<option value="Hướng Tây Nam">Hướng Tây Nam</option>
		</select>
		<button type="button" class="btn btn-default search-filter-button">Tìm kiếm</button>
	</form> -->

<!-- <div style="display:none">
		<?php
			$terms = get_terms( array(
				'taxonomy' => 'dia_diem',
				'hide_empty' => 0,
				'parent' => 0
			) ); 
			foreach ($terms  as $term ) {?>
			<div class="datadiadiem" id="<?php echo $term->slug; ?>">
			 	<option value="all">Chọn xã phường</option>
				 <?php
				 	$terms2 = get_terms( array(
						'taxonomy' => 'dia_diem',
						'hide_empty' => 0,
						'parent' => $term->term_id
					) ); 
					foreach ($terms2 as $term2) {  ?>
						<option value="<?php echo $term2->slug; ?>"><?php echo $term2->name; ?></option>
					<?php } ?>
			</div>
			<?php }?>
</div> -->
<form method="GET" action="<?php echo home_url( '/' ); ?>" >
	
	<select name="tinh_tp">
		<?php 
		echo '<option value="all" data-idp="-1">Chọn Huyện/Thành Phố</option>';
		$terms = get_terms( array(
			'taxonomy' => 'dia_diem',
			'hide_empty' => 0,
			'parent' => 0
		) );	
		foreach ($terms  as $term ) {
			?>
			<option data-idp="<?=$term->term_id?>" value="<?php echo $term->slug ?>"><?php echo $term->name ?></option>
			<?php 
		}
		?>
	</select>
	<select name="xa_huyen">
    	<?php 
			echo '<option value="all">Chọn xã phường</option>';
    	?>
    </select>
	<select name="loai_nha_dat">
		<?php 
		echo '<option value="all">Chọn loại nhà đất</option>';
		$terms2 = get_terms( array(
			'taxonomy' => 'loai_nha_dat',
			'hide_empty' => 0,
			'parent' => 0
		) );	
		foreach ($terms2  as $term2 ) {
			?>
			<option value="<?php echo $term2->slug ?>"><?php echo $term2->name ?></option>
			<?php 
		}
		?>
	</select>
	<select name="huong_nha">
		<option value="">Chọn hướng nhà</option>
		<?php
			$field = get_field_object('huong_nha');
			echo '<pre>';
			print_r($label);
			echo '</pre>';
			if( $field ){
				// build the form
				echo '<select name="' . $field['key'] . '">';
					foreach( $field['choices'] as $k => $v )
					{
						echo '<option value="' . $k . '">' . $v . '</option>';
					}
				echo '</select>';
			}
		?>
	</select>
	<div class="box-sub order-lg-2 ">
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Tìm kiếm', 'submit button' ); ?>" />
    </div>
</form>
<?php var_dump($_GET); ?>
<main id="site-content" role="main">

	<?php

	$archive_title    = '';
	$archive_subtitle = '';

	if ( is_search() ) {
		global $wp_query;

		$archive_title = sprintf(
			'%1$s %2$s',
			'<span class="color-accent">' . __( 'Search:', 'twentytwenty' ) . '</span>',
			'&ldquo;' . get_search_query() . '&rdquo;'
		);

		if ( $wp_query->found_posts ) {
			$archive_subtitle = sprintf(
				/* translators: %s: Number of search results. */
				_n(
					'We found %s result for your search.',
					'We found %s results for your search.',
					$wp_query->found_posts,
					'twentytwenty'
				),
				number_format_i18n( $wp_query->found_posts )
			);
		} else {
			$archive_subtitle = __( 'We could not find any results for your search. You can give it another try through the search form below.', 'twentytwenty' );
		}
	} elseif ( is_archive() && ! have_posts() ) {
		$archive_title = __( 'Nothing Found', 'twentytwenty' );
	} elseif ( ! is_home() ) {
		$archive_title    = get_the_archive_title();
		$archive_subtitle = get_the_archive_description();
	}

	if ( $archive_title || $archive_subtitle ) {
		?>

		<header class="archive-header has-text-align-center header-footer-group">

			<div class="archive-header-inner section-inner medium">

				<?php if ( $archive_title ) { ?>
					<h1 class="archive-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
				<?php } ?>

				<?php if ( $archive_subtitle ) { ?>
					<div class="archive-subtitle section-inner thin max-percentage intro-text"><?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?></div>
				<?php } ?>

			</div><!-- .archive-header-inner -->

		</header><!-- .archive-header -->

		<?php
	}

	if ( have_posts() ) {

		$i = 0;

		while ( have_posts() ) {
			$i++;
			if ( $i > 1 ) {
				echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
			}
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

		}
	} elseif ( is_search() ) {
		?>

		<div class="no-search-results-form section-inner thin">

			<?php
			get_search_form(
				array(
					'label' => __( 'search again', 'twentytwenty' ),
				)
			);
			?>

		</div><!-- .no-search-results -->

		<?php
	}
	?>

	<?php get_template_part( 'template-parts/pagination' ); ?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php
get_footer();
