var Serienbrief = function ()
{
    var _ = this;

    _.initUpdateAbschlagDatum = function() {

        $('.sendAbschlagMailsForm').submit(function(e) {

            var ladeIcon = $( ".modal-body .lade-icon" );
            ladeIcon.show();
            $('#exampleModal').modal({show: true});

            var data = {};
            $( ".modal-body .message" ).load(
                "index.php?r=abschlag/update-abschlag-datum",
                $('.sendAbschlagMailsForm').serialize(),
                function( response, status, xhr ) {

                    ladeIcon.hide();

                    if ( status == "error" ) {
                        var msg = "Sorry but there was an error: ";
                        $( ".modal-body .message" ).html( msg + xhr.status + " " + xhr.statusText );
                    }
                }
            );

            e.preventDefault();
        });
    }

    _.init = function () {

        _.initUpdateAbschlagDatum();
    }

    _.init();
}