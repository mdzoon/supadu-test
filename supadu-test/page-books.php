<?php
/**
 * The template for displaying book data
 *
 * Template Name: Book
 * Template Post Type: post
 * 
 */

get_header();

$address = '9780060577315';

function return_api_data($arg) {
	$curl_href = curl_init('https://v3-static.supadu.io/dev/products/' . $arg . '.json');
	curl_setopt($curl_href, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl_href, CURLOPT_HEADER, 0);
	$result = curl_exec($curl_href);
	curl_close($curl_href);
	
	return json_decode($result);
}

$book = return_api_data($address);

$sale_date = '';
if ( !empty( $book->sale_date->date ) ) {
	$sale_date = date( 'Y-m-d', strtotime( $book->sale_date->date ) );
}
$book_image = substr( $book->image, 0, strpos( $book->image, "/x" ) ) . '/x600.jpg';

?>

	<div class="alignwide book-container">

		<?php
		if ( !empty($book->retailers) ) { ?>
			<div class="book-retailers-wrapper data-container">
				<div>Available from established retailers:</div>
				<div class="retailers-container data-container">
					<?php
						foreach ($book->retailers as $retailer) {
							echo '<div class="retailer-card">';
							echo '<div class="retailer-format note"><i>Book format: ' . esc_html( $retailer->format ) . '</i></div>';
							echo '<a class=retailer-link" href="' . esc_url( $retailer->path ) . '" target="_blank">';
							echo '<h6 class=retailer-name">' . esc_html( $retailer->label ) . '</h6>';
							echo '</a>';
							echo '</div>';
						}
					?>
				</div>
			</div>
		<?php } ?>

		<hr style="margin-bottom: 2rem">

		<div class="row">
		
			<div class="col left">

				<?php
					if ( !empty($sale_date) ) { ?>
						<div class="book-sale-wrapper top">
							On sale from:
							<span class="sale-date"><?php echo $sale_date; ?></span>
						</div>
					<?php }
				?>

				<div class="wp-block-image size-large alignfull size-full is-style-twentytwentyone-border">
					<img class="book-image" src="<?php echo esc_url( $book_image ); ?>" alt="<?php echo esc_attr( $book->title ); ?>" />
				</div>

				<?php
					if ( !empty($sale_date) ) { ?>
						<div class="book-sale-wrapper bottom">
							On sale from:
							<span class="sale-date"><?php echo $sale_date; ?></span>
						</div>
					<?php }
				?>
			</div>

			<div class="col right">
				<h2 class="book-title"><?php echo esc_html( $book->title ); ?></h2>

				<div class="book-author-wrapper data-container">
				<?php 
					foreach ($book->contributors as $contributor) { ?>
						<h6 id="author-biography" class="author-name" role="button" aria-pressed="false">
							<span>By <?php echo esc_html( $contributor->contributor->name ); ?></span>
							<span alt="show-more" class="dashicons dashicons-dashicons dashicons-insert" aria-hidden="true"></span>
						</h6>
						<div id="author-biography-content" class="author-biography" style="display: none;">
							<?php echo wp_kses_post( $contributor->contributor->bio ); ?>
						</div>
					<?php } ?>
				</div>

				<?php
				if ( !empty( $book->description) ) { ?>
					<h6 id="book-description" class="show-book-description" role="button" aria-pressed="false">
						Learn more about
						<span alt="show-more" class="dashicons dashicons-dashicons dashicons-insert" aria-hidden="true"></span>
					</h6>
					<div id="book-description-content" class="book-description data-container" style="display: none">
						<?php echo wp_kses_post( $book->description ); ?>
						<div class="close" role="button">close</div>
					</div>
					<div class="book-price-wrapper data-container">
						<?php
							foreach ($book->prices as $price) {
								echo '<h5 class="book-price">$' . esc_html( $price->amount ) . '<span> ' . esc_html( $price->locale ) . '</span></h5>';
							}
						?>
					</div>
				<?php } ?>

			</div>

		</div>

		<hr>

		<div class="book-review-wrapper">
			<h5>Opinions about: <em><?php echo esc_html( $book->title ); ?></em></h5>
			<div class="data-container">
				<?php
					foreach ($book->reviews as $review) {
						echo '<div class="review-description">' . wp_kses_post( $review->review->description ) . '</div>';
						echo '<div class="review-score">' . esc_html( $review->review->score ) . '</div>';
						echo '<div class="review-reviewer"><strong>' . wp_kses_post( $review->review->reviewer ) . '</strong></div>';
						echo '<div class="review-source note"><i>Source: ' . esc_html( $review->review->source ) . '</i></div>';
					}
				?>			
			</div>
		</div>

	</div>

<?php
get_footer();