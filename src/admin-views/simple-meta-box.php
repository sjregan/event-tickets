<?php
/**
 * @var WP_Post $post
 * @var bool $show_global_stock
 * @var Tribe__Tickets__Global_Stock $global_stock
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$rsvp_enabled	= get_post_meta( get_the_ID(), $this->enable_rsvp_field, true );
$rsvp_questions  = get_post_meta( get_the_ID(), $this->rsvp_question_field, true );

if ( !is_array($rsvp_questions)) {
	$rsvp_questions = [1 => ''];	
}
?>

<table id="event_tickets" class="eventtable">
	<?php wp_nonce_field( 'tribe-tickets-simple-meta-box', 'tribe-tickets-post-settings' ); ?>
	<tr class="event-wide-settings">
		<td colspan="2" class="tribe_sectionheader updated">
			<table class="eventtable ticket_list eventForm">
				<tr class="tribe-tickets-enable-simple-rsvp">
					<td>
						<input type="checkbox" name="tribe_ticket_enable_rsvp" id="tribe-tickets-enable-simple-rsvp" value="1" <?php checked( $rsvp_enabled ); ?> />
						<label for="tribe-tickets-enable-simple-rsvp">
							<?php esc_html_e( 'Allow members to RSVP', 'event-tickets' ); ?>
						</label>
					</td>
				</tr>
				<tr class="tribe-tickets-simple-rsvp-question">
					<td>
						<p class="heading"><?php esc_html_e( 'Questions to Members', 'event-tickets' ); ?></p>
						<p class="description"><?php esc_html_e( 'Members will have the option of answering these questions when indicating their attendence.', 'event-tickets' ); ?></p>
					</td>
				</tr>
				
				<?php
					$i = 0;
					
					foreach ($rsvp_questions as $key => $question):
						$i++;
				?>
					<tr class="tribe-tickets-rsvp-question" data-questionkey="<?php echo $i; ?>">
						<td class="question">
							<span class="num"><?php echo $i; ?>. </span>
							<input type="hidden" name="tribe_ticket_rsvp_question_id[]" value="<?php echo $key; ?>" />
							<input type="text" id="tribe-ticket-simple-rsvp-question" name="tribe_ticket_rsvp_question[]" value="<?php echo esc_attr( $question ); ?>" />
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
			
			<p class="add-rsvp-question"><a href="#" class="add button button-primary"><?php esc_html_e( 'Add Question', 'event-tickets' ); ?></a></p>
		</td>
	</tr>
</table>
