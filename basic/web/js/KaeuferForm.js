var KaeuferForm = function () {

    var _ = this;
    var _form = $('#kaeufer-form');

    _.initProjektZuweisung = function(){

        var table = $('.kaeufer-projekts');

        $('[name="kaeuferProjektId"]').change(function() {
            var selectedOption = $(this).find('option:selected');
            var projektId = this.value;

            if (projektId == 0) {
                return;
            }

            var searchProjektId = $('[name="KaeuferProjekt[]"][value="' + projektId + '"]');
            console.log(searchProjektId);
            console.log(searchProjektId.length);
            if (0 == searchProjektId.length) {

                var tr = $('<tr>');
                var td = $('<td>')
                    .append($('<input>').attr('name', 'KaeuferProjekt[]').attr('type', 'hidden').attr('value', projektId))
                    .append(selectedOption.text());
                tr.append(td);

                tr.append($('<td>').html('<span class="delete-button btn btn-danger btn-xl"><span class="fa fa-minus"></span></span>'));

                table.append(tr);
            }

        });

        table.on('click', '.delete-button', function(){
            $(this).closest('tr').remove();
        });
    }

    _.initTeileigentumseinheitZuweisung = function() {

        var self = this;

        $('[name="teileigentumseinheits"]').change(function() {
            var elm = $(this);
            var selectedOptionValue = elm.find(":selected").val();

            window.location.href = 'index.php?r=kaeufer/assign-teileigentumseinheit&kaeuferId=' + _form.data('id') + '&teId=' + selectedOptionValue;

        });

    }

    _.init = function() {

        if(!_form) return;

        _.initProjektZuweisung();
        _.initTeileigentumseinheitZuweisung();

    }

    _.init();
}