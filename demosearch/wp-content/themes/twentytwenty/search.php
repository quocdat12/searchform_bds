<?php
	$post_type = isset($_GET['post_type']) && $_GET['post_type'] ? $_GET['post_type'] : 'post';
	$district = isset($_GET['tinh_tp']) && $_GET['tinh_tp'] ? $_GET['tinh_tp'] : '';
	$loaction = isset($_GET['xa_huyen']) && $_GET['xa_huyen'] ? $_GET['xa_huyen'] : $district;
	$loai = isset($_GET['loai_nha_dat']) && $_GET['loai_nha_dat'] ? $_GET['loai_nha_dat'] : '';
	$key = isset($_GET['s']) && $_GET['s'] ? $_GET['s'] : '';
	$args = array(
		'showpost' => 10,
		'post_type' => $post_type,
		's' => $key,
		'dia_diem' => $loaction
	);
	$the_query = new $WP_Query($args);
	if($the_query->have_posts()) :
		while($the_query->have_posts()) : $the_query->the_post() ; ?>
			<h2><?php echo the_title(); ?></h2>
	<?	endwhile;
	endif;	
?>