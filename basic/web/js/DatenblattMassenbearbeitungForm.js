var DatenblattMassenbearbeitungForm = function () {
    var _ = this;
    var abschlagTable = $(".abschlag-tabelle");

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
            tr.find('.sortable.meilenstein').sortable("destroy");
            $(".projekt-meilensteine .sortable:first").append(tr.find(".sortable.meilenstein li"));
            tr.remove();

            _.updateInputNames();
        });

    }

    function _updateMeilensteinZuordnungen() {
        abschlagTable.find("tbody tr").each(function () {
            var elm = $(this);

            if (elm.attr("data-is-editable") == 1) {
                var prozentSumme = 0;

                // get meilenstein ids
                var meilensteinIds = new Array();
                elm.find(".meilenstein.zuordnung li").each(function () {
                    meilensteinIds.push($(this).attr("data-meilenstein-id"));
                    prozentSumme += parseFloat($(this).attr("data-prozent"));
                });

                elm.find(".prozent-summe").html(prozentSumme.toFixed(2));

                // set meileinstein ids
                elm.find(".abschlag-zuordnungen").val(
                    meilensteinIds
                );
            }
        });
    }

    _.initSortables = function (container) {
        container.find(".meilenstein").sortable({
            group: "meilenstein",
            onDrop: function ($item, container, _super) {
                _updateMeilensteinZuordnungen();
            }
        });
    }

    _.updateInputNames = function() {
        var startIndex = abschlagTable.attr('data-existing-abschlag-count');
        abschlagTable.find("tr:not(:first-child)").each(function (key, elm) {
            startIndex++;
            var tr = $(this);
            var abschlagNameInput = tr.find('td:first-child [name*="Abschlag"]');
            abschlagNameInput.attr('name', 'Abschlag[' + key + '][name]');
            abschlagNameInput.val('Abschlag ' + startIndex);

            var abschlagNameInput = tr.find('td').last().find('[name*="AbschlagMeilensteinZuordnung"]');
            abschlagNameInput.attr('name', 'AbschlagMeilensteinZuordnung['+key+']');
        });

        abschlagTable.find('tr:last-child td:first-child [name*="Abschlag"]').val('Schlussrechnung');
    }

    _.init = function () {

        _.initSortables($(document));
        _.initPlusMinusIcons();
    }

    _.init();
}