(function( $ ) {
	'use strict';

	$( document ).ready( function() {
		var $tribe_tickets = $( '#tribetickets' );
	
		// Add new question
		$tribe_tickets.on( 'click', '.add-rsvp-question .add', function(e) {
			e.preventDefault();
			
			var $table = $('#event_tickets');
			var $row = $table.find('TR.tribe-tickets-rsvp-question:last-child');
			var key = Math.floor($row.data('questionkey')) + 1;
			var $newRow = $table.find('TR.tribe-tickets-rsvp-question:last-child').clone();
			
			$newRow.find('.num').html(key + '. ');
			$newRow.find('INPUT[type=hidden]').val(Math.floor($newRow.find('INPUT[type=hidden]').val()) + 1);
			$newRow.find('INPUT[type=text]').val('');
			$newRow.data('questionkey', key);
			
			$row.after($newRow);
			$newRow.find('INPUT').focus();
		} );
	} );

})( jQuery );
