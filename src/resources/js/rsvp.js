var tribe_tickets_rsvp = {
	num_attendees: 0,
	event: {}
};

(function( $, my ) {
	'use strict';

	my.init = function() {
		this.$rsvp = $( '.tribe-events-tickets-rsvp' );
		this.$changeContainer = $( '.tribe-events-tickets-change-rsvp' );
		
		this.$customQuestion = this.$rsvp.find('.tribe-ticket-rsvp-custom-question');
		this.$options = this.$rsvp.find('INPUT[name="attending"]');
		
		this.$change = this.$changeContainer.find('A');
		this.$change.click( this.show_form );
		
		this.$options.change( this.rsvp_changed );
		
		if ( this.$rsvp.find('INPUT[name="attending"]:checked').val() != 'yes' ) {
			this.$customQuestion.hide();
		}
		
		this.$rsvp.closest( '.cart' ).hide();
		
		/*
		this.attendee_template = $( document.getElementById( 'tribe-tickets-rsvp-tmpl' ) ).html();

		this.$rsvp.on( 'change', '.tribe-ticket-quantity', this.event.quantity_changed );

		this.$rsvp.closest( '.cart' )
			.on( 'submit', this.event.handle_submission );

		$( '.tribe-rsvp-list' ).on( 'click', '.attendee-meta-row .toggle', function() {
			$( this )
				.toggleClass( 'on' )
				.siblings( '.attendee-meta-details' )
				.slideToggle();
		});
		*/
	};
	
	my.show_form = function (e) {
		e.preventDefault();
		
		my.$changeContainer.hide();
		my.$rsvp.closest( '.cart' ).show();
		
		return false;
	};
	
	my.rsvp_changed = function () {
		if ( $(this).val() == 'yes' ) {
			my.$customQuestion.show();
		} else {
			my.$customQuestion.hide();
		}
	};

	/*
	my.quantity_changed = function( $quantity ) {
		var i = 0;
		var $rsvp = $quantity.closest( '.tribe-events-tickets-rsvp' );
		var quantity = parseInt( $quantity.val(), 10 );

		if ( ! quantity ) {
			$rsvp.removeClass( 'tribe-tickets-has-rsvp' );
		} else {
			$rsvp.addClass( 'tribe-tickets-has-rsvp' );
		}
	};
	*/
   
	my.validate_submission = function() {
		var $name = $( document.getElementById( 'tribe-tickets-full-name' ) );
		var $email = $( document.getElementById( 'tribe-tickets-email' ) );

		if ( ! $.trim( $name.val() ).length || ! $.trim( $email.val() ).length ) {
			return false;
		}

		return true;
	};

	/*
	my.event.quantity_changed = function() {
		my.quantity_changed( $( this ) );
	};
	*/
   
	my.event.handle_submission = function( e ) {
		if ( ! my.validate_submission() ) {
			e.preventDefault();
			var $form = $( this ).closest( 'form' );

			$form.addClass( 'tribe-rsvp-message-display' );
			$form.find( '.tribe-rsvp-message-confirmation-error' ).show();

			$( 'html, body').animate({
				scrollTop: $form.offset().top
			}, 300 );
			return false;
		}
	};

	$( function() {
		my.init();
	} );
})( jQuery, tribe_tickets_rsvp );