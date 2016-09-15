<?php
/**
 * This template renders the RSVP ticket form
 *
 * @version 4.3
 *
 * @var bool $must_login
 */

ob_start();
$messages = Tribe__Tickets__RSVP::get_instance()->get_messages();
$messages_class = $messages ? 'tribe-rsvp-message-display' : '';
$now = current_time( 'timestamp' );
$past = function_exists( 'tribe_is_past_event' ) && tribe_is_past_event();
	
if ( $must_login ):
	$login_url = Tribe__Tickets__Tickets::get_login_url();
?>

	<a href="<?php echo $login_url; ?>" class="rsvp-login"><?php esc_html_e( 'Login to RSVP', 'event-tickets' );?></a>
	
<?php elseif ( !$past ): ?>
	
	<div class="tribe-rsvp-message tribe-events-tickets-change-rsvp">
		
	<?php
		if ( isset( $rsvp_status ) ):
			if ( $rsvp_status == 'yes' ) {
				$message = _x( 'You indicated you will be attending this event.', 'event-tickets' );
			} else {
				$message = _x( 'You indicated you will not be attending this event.', 'event-tickets' );
			}
	?>
	
		<?php echo $message; ?> <a href="#"><?php echo _x( 'Change', 'event-tickets' ) ?></a>
	
	<?php else: ?>
	
		<?php echo _x( 'Are you attending?', 'event-tickets' ); ?> <a href="#"><?php echo _x( 'RSVP Now', 'event-tickets' ) ?></a>
	
	<?php endif; ?>
		
	</div>

	<form action="" class="cart <?php echo esc_attr( $messages_class ); ?>" method="post" enctype='multipart/form-data'>
	<input type="hidden" name="event_id" value="<?php the_ID(); ?>" />

		<h2 class="tribe-events-tickets-title"><?php echo esc_html_x( 'RSVP', 'form heading', 'event-tickets' ) ?></h2>
		<div class="tribe-rsvp-messages">
			<?php
			if ( $messages ) {
				foreach ( $messages as $message ) {
					?>
					<div class="tribe-rsvp-message tribe-rsvp-message-<?php echo esc_attr( $message->type ); ?>">
						<?php echo esc_html( $message->message ); ?>
					</div>
					<?php
				}//end foreach
			}//end if
			?>
			<div class="tribe-rsvp-message tribe-rsvp-message-error tribe-rsvp-message-confirmation-error" style="display:none;">
				<?php echo esc_html_e( 'Please fill in the RSVP confirmation name and email fields.', 'event-tickets' ); ?>
			</div>
		</div>
		<table width="100%" class="tribe-events-tickets tribe-events-tickets-rsvp">
			<tr>
				<td class="tribe-ticket quantity" data-product-id="">
					<div class="tribe-ticket-rsvp-attending no">
						<input type="radio" name="attending" value="no" id="tribe-ticket-rsvp-attending-no" <?php checked( $rsvp_status == 'no' ) ?> />
						<label for="tribe-ticket-rsvp-attending-no"><?php esc_html_e( 'No, I will not be attending.', 'event-tickets' );?></label>
					</div>

					<div class="tribe-ticket-rsvp-attending yes">
						<input type="radio" name="attending" value="yes" id="tribe-ticket-rsvp-attending-yes" <?php checked( $rsvp_status == 'yes' ) ?> />
						<label for="tribe-ticket-rsvp-attending-yes"><?php esc_html_e( 'Yes, I will be attending.', 'event-tickets' );?></label>
					</div>
				</td>
			</tr>

			<?php if ( $rsvp_question ): ?>
			<tr class="tribe-ticket-rsvp-custom-question">
				<td>
					<p><?php echo $rsvp_question; ?></p>
					<textarea name="custom_question" rows="3"><?php echo esc_html($rsvp_answer); ?></textarea>
				</td>
			</tr>
			<?php
				endif;

			/**
			 * Allows injection of HTML after an RSVP ticket table row
			 *
			 * @var Event ID
			 * @var Tribe__Tickets__Ticket_Object
			 */
			do_action( 'event_tickets_rsvp_after_ticket_row', tribe_events_get_ticket_event( $ticket->id ), $ticket );
			?>

			<tr>
				<td colspan="4" class="add-to-cart">
					<button type="submit" name="tickets_process" value="1" class="button alt"><?php esc_html_e( 'Confirm RSVP', 'event-tickets' );?></button>
				</td>
			</tr>
		</table>
	</form>

<?php
endif; // past

$content = ob_get_clean();
echo $content;