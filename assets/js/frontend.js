jQuery( document ).ready( function ( e ) {


    $('.mash-key-delete-btn').click(function(e){
        e.preventDefault();
        if (confirm('Are you sure? (for demo purposes, this key will not be deleted for real - refreshing the page will restore the row).')) {
            $(this).closest( "tr" ).hide();
        }
    });

});
