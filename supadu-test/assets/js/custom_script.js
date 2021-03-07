(function($) {

  var elms = [ "#author-biography", "#book-description" ];

  elms.forEach( elm => {
    $( elm ).on( 'click', () => {

      var icon = $( elm ).children(".dashicons-insert"), close = $( elm + '-content' ).children(".close");

      var action = () => {
        $( elm ).attr( "aria-pressed", ( _, attr) => Number(attr) === 1 ? 0 : 1 );
        icon.addClass("rotate");
        setTimeout( () => {
          icon.removeClass("rotate");
        }, 800 );
      }      

      $( elm + '-content' ).toggle( 'slow' );
      $(action);

      $(close).on( 'click', () => {
        $( elm + '-content' ).hide( 'slow' );
        $(action);
      })

    });    
  });

})( jQuery );