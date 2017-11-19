var DatenblattMassenbearbeitungForm = function () {
    var _ = this;
    var abschlagTable = $(".abschlag-tabelle");
    var form = $("#abschlag-meileinstein-form");

    _.initPlusMinusIcons = function () {

        $(".add-button").click(function () {
            var table = $(this).closest("table");
            var template = $(".zeilenvorlage tbody").html();
            table.find("tbody").append(template);

            _.initSortables(table.find("tr").last());

            _.updateInputNames();
        });

        abschlagTable.on("click", ".delete-button", function () {
            var tr = $(this).closest("tr");
            tr.find('.sortable.meilenstein').sortable2("destroy");
            $(".projekt-meilensteine .sortable:first").append(tr.find(".sortable.meilenstein li"));
            tr.remove();

            _.updateInputNames();
        });

    }

    function _updateMeilensteinZuordnungen() {

        var totalProzentSumme = parseFloat($('.abschlag-tabelle').attr('data-angeforderte-prozent-summe')) | 0;
        abschlagTable.find("tbody tr").each(function () {
            var elm = $(this);

            var prozentSumme = 0;
            if (elm.attr("data-is-editable") == 1) {

                // get meilenstein ids
                var meilensteinIds = new Array();
                elm.find(".meilenstein.zuordnung li").each(function () {
                    meilensteinIds.push($(this).attr("data-meilenstein-id"));
                    prozentSumme += parseFloat($(this).attr("data-prozent"));
                });

                elm.find(".prozent-summe").html(prozentSumme.toFixed(2));

                totalProzentSumme += prozentSumme;

                // set meileinstein ids
                elm.find(".abschlag-zuordnungen").val(
                    meilensteinIds
                );
            }
        });

        $('.prozent-summe-zugewiesen').text(totalProzentSumme.toFixed(2));
    }

    _.initSortables = function (container) {
        container.find(".meilenstein").sortable2({
            group: "meilenstein",
            onDrop: function ($item, container, _super) {
                _updateMeilensteinZuordnungen();
            }
        });
    }

    _.updateInputNames = function() {
        var startIndex = abschlagTable.attr('data-existing-abschlag-count') - 1;
        abschlagTable.find("tr:not(:first-child)").each(function (key, elm) {
            startIndex++;
            var tr = $(this);
            var abschlagNameInput = tr.find('td:first-child [name*="Abschlag"]');
            abschlagNameInput.attr('name', 'Abschlag[' + startIndex + '][name]');
            abschlagNameInput.val('Abschlag ' + (startIndex + 1) );

            var input = tr.find('[name*="AbschlagMeilensteinZuordnung"]');
            input.attr('name', 'AbschlagMeilensteinZuordnung['+startIndex+']');
        });

        abschlagTable.find('tr:last-child td:first-child [name*="Abschlag"]').val('Schlussrechnung');
    }

    _.initFormSubmit = function() {
        form.submit(function(e) {
            e.preventDefault();

            $.post(
                form.attr('action'),
                form.serialize(),
                function(data) {
                    // alert(data);

                    var jsonData = JSON.parse(data);

                    var modalDialogContent = $('#myModal .modal-body .links');
                    modalDialogContent.empty();
                    for(var index in jsonData.datenblattUrls) {
                        var url = jsonData.datenblattUrls[index];

                        console.log(modalDialogContent);
                        console.log($('<a>').attr('href', url).val('Datenblatt ' + index));

                        var element = document.createElement('a');
                        element.href = url;
                        element.text = 'Datenblatt ' + index;
                        element.target = '_blank';
                        modalDialogContent.append(element);
                        modalDialogContent.append($('<br>'));
                        // $('<a>').attr('href', url).appendTo(modalDialogContent);
                    }

                    $('#myModal').modal({show: true});
                }
            );

            return false;
        });
    }

    _.init = function () {

        _.initFormSubmit();
        _.initSortables($(document));
        _.initPlusMinusIcons();

    }

    _.init();
}