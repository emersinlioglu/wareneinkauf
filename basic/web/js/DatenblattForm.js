var DatenblattForm = function () {
    var _ = this;
    _form = null;
    
    _selectedFirma      = null;
    _selectedProjekt    = null;
    _selectedHaus       = null;

    /**
     * Init betrag validation
     * @param newContent
     */
    _.initBetragValidation = function(newContent) {
        // betrag validierung
        newContent.delegate('input[name*="betrag"]', 'change', function() {

            //yii.validation.number(this.value, [{"message": "Betrag muss eine Zahl sein."}], {"message": "Betrag muss eine Zahl sein."});

            var pattern = /^\s*[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?\s*$/;
            var msg = '';
            if (this.value && !pattern.test(this.value)) {
                var msg = 'Betrag muss eine Zahl sein.';
                $(this).closest('.form-group').addClass('has-error');
                $(this).closest('.form-group').removeClass('has-success');
            } else {
                $(this).closest('.form-group').addClass('has-success');
                $(this).closest('.form-group').removeClass('has-error');
            }
            $(this).next('.help-block').html(msg);

        });
    }

    /**
     * Init datepickers
     * @param panelId
     */
    _.initDatepickers = function(panelId) {
        // init datepickers
        _form.find('#' + panelId + ' .box-body').find('.input-group.date').each(function(index, value) {

            _.initDatepicker(value);

        });
    };

    _.initDatepicker = function(value) {
        var inputGroup = $(value);
        var datecontrol_options = {
            "idSave": "", //"sonderwunsch-0-angebot_datum"
            "url":"\/index.php?r=datecontrol%2Fparse%2Fconvert",
            "type":"date",
            "saveFormat":"Y-m-d",
            "dispFormat":"d.m.Y",
            "saveTimezone":"Europe\/Berlin",
            "dispTimezone":"Europe\/Berlin",
            "asyncRequest":true,
            "language":"de",
            "dateSettings":{"days":["Sonntag","Montag","Dienstag","Mittwoch","Donnerstag","Freitag","Samstag","Sonntag"],
                "daysShort":["Son","Mon","Die","Mit","Don","Fre","Sam","Son"],
                "months":["Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember"],
                "monthsShort":["Jan","Feb","Mär","Apr","Mai","Jun","Jul","Aug","Sep","Okt","Nov","Dez"],
                "meridiem":["Vorm.","Nachm."]}
        };
        var kvDatepicker_options = {"autoclose":true,"format":"dd.mm.yyyy","language":"de"};
        var dateId = inputGroup.next('input[type="hidden"]').attr('id');
        datecontrol_options.idSave = dateId;
        inputGroup.find('.krajee-datepicker').datecontrol(datecontrol_options);
        if (inputGroup.find('.krajee-datepicker').data('kvDatepicker')) {
            inputGroup.find('.krajee-datepicker').kvDatepicker('destroy');
        }
        inputGroup.kvDatepicker(kvDatepicker_options);
    };

    /**
     * Init maskmoney
     * @param panelId
     */
    _.initMaskmoney = function(panelId) {

        _form.find('#' + panelId + ' .box-body').find('input[name*="id-disp"]').each(function(index, elm) {

            var inputDisplay = $(elm);
            var input = inputDisplay.next();
            var maskMoneyConfig = {
                decimal: ",",
                thousands: ".",
                allowNegative: true
            };

            inputDisplay.maskMoney(maskMoneyConfig);
            var val = parseFloat(input.val());
            inputDisplay.maskMoney('mask', val);
            inputDisplay.on('change', function () {
                var numDecimal = inputDisplay.maskMoney('unmasked')[0];
                input.val(numDecimal);
                input.trigger('change');
            });


        });
    }

    _.postPluMinusIcon = function(elm) {

        var panelId     = elm.closest('.panel-collapse').attr('id');

        // POST Request
        $.post(elm.attr('href') , _form.serialize(), function(data) {

            $('.skin-blue.sidebar-mini').html($(data).find('.skin-blue.sidebar-mini').html());
            var newContent = $(data).find('#' + panelId + ' .box-body');

            // init plus minus icons
            _.initPlusMinusIcons(newContent);

            //// init betrag validation
            //_.initBetragValidation(newContent);

            // set html
            var boxBody = _form.find('#' + panelId + ' .box-body');
            boxBody.replaceWith(newContent);

            // init datepickers
            _.initDatepickers(panelId);

            // init maskmoney
            _.initMaskmoney(panelId);

            if (boxBody.find('#search-teileigentumseinheit').length) {
                _.initAutocompleteTeileigentumseinheiten();
            }

            $("#myModal").modal('hide');

        });
    }

    /**
     * init plus/minus icons
     * @param container
     */
    _.initPlusMinusIcons = function(container) {

        _cnt = _form;
        if (typeof container !== 'undefined') {
            _cnt = $(container);
        }

        _cnt.find('.add-button, .delete-button').click(function(e) {
            e.preventDefault();

            var elm = $(this);

            if (elm.hasClass('delete-button')) {
                $("#myModal").modal('show');

                $("#myModal").on("click",".btn-primary",function(){
                    _.postPluMinusIcon(elm)
                });
            } else {
                _.postPluMinusIcon(elm)
            }

            return false;
        });

    }

    /**
     * Format mysql date string
     * @param dateString
     * @returns {*}
     */
    _.formatDate = function(dateString) {

        if (dateString == null || dateString.length == 0) {
            return '';
        }

        var date = $.datepicker.parseDate("yy-mm-dd", dateString);
        var day = date.getDate();
        day = (day < 10 ? '0' : '') + day;
        var month = (date.getMonth() + 1);
        month = (month < 10 ? '0' : '') + month;

        return  day + '.' + month + '.' + date.getFullYear();
    }

    /**
     * init autocomplete kunden
     */
    _.initAutocompleteKunden = function() {

        var self = this;

        $('#search-kaufer')
            .keydown(function(e){
                if(e.which == 13) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            })
            .autocomplete({
                source: "index.php?r=datenblatt/autocompletekunden",
                minLength: 1,
                select: function (event, ui) {

                    if (ui.item && ui.item.id) {
                        // item selected and has an id

                        $('[name="Datenblatt[kaeufer_id]"]').val(ui.item.id);
                        $('[name="Kaeufer[id]"]').val(ui.item.id);
                        $('#kaeufer-debitor_nr').val(ui.item.debitor_nr);

                        //$('#kaeufer-beurkundung_am-disp').val(self.formatDate(ui.item.beurkundung_am));
                        //$('#kaeufer-verbindliche_fertigstellung-disp').val(self.formatDate(ui.item.verbindliche_fertigstellung));
                        //$('#kaeufer-abnahme_se-disp').val(self.formatDate(ui.item.abnahme_se));
                        //$('#kaeufer-uebergang_bnl-disp').val(self.formatDate(ui.item.uebergang_bnl));
                        //$('#kaeufer-abnahme_ge-disp').val(self.formatDate(ui.item.abnahme_ge));

                        $('[name="Kaeufer[anrede]"]').val(ui.item.anrede);
                        $('[name="Kaeufer[titel]"]').val(ui.item.titel);
                        $('[name="Kaeufer[vorname]"]').val(ui.item.vorname);
                        $('[name="Kaeufer[nachname]"]').val(ui.item.nachname);

                        $('[name="Kaeufer[anrede2]"]').val(ui.item.anrede2);
                        $('[name="Kaeufer[titel2]"]').val(ui.item.titel2);
                        $('[name="Kaeufer[vorname2]"]').val(ui.item.vorname2);
                        $('[name="Kaeufer[nachname2]"]').val(ui.item.nachname2);

                        $('[name="Kaeufer[strasse]"]').val(ui.item.strasse);
                        $('[name="Kaeufer[hausnr]"]').val(ui.item.hausnr);
                        $('[name="Kaeufer[plz]"]').val(ui.item.plz);
                        $('[name="Kaeufer[ort]"]').val(ui.item.ort);

                        $('[name="Kaeufer[email]"]').val(ui.item.email);
                        $('[name="Kaeufer[festnetz]"]').val(ui.item.festnetz);
                        $('[name="Kaeufer[handy]"]').val(ui.item.handy);

                    }

                    $(this).val(' ');
                }
            })
            .data( "ui-autocomplete" )._renderItem = function( ul, item ) {

                var columns = [
                    // 'debitor_nr',
                    'vorname',
                    'nachname'
                ];

                var a = $('<a>');
                for (var i in columns) {
                    var columnName = columns[i];
                    a.append(
                        $('<span>')
                            .css('width', '100px')
                            .css('display', 'inline-block')
                            .text(item[columnName])
                    );
                }

                return $( "<li>" )
                    .data( "item.autocomplete", item )
                    .append( a )
                    .appendTo( ul );
            };
    }

    /**
     * init autocomplete kunden
     */
    _.initAutocompleteTeileigentumseinheiten = function() {

        var self = this;

        $('#search-teileigentumseinheit')
            .keydown(function(e){
                if(e.which == 13) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            })
            .autocomplete({
                source: "index.php?r=teileigentumseinheit/autocomplete",
                minLength: 1,
                select: function (event, ui) {

                    if (ui.item && ui.item.id) {

                        $.get(
                            'index.php?r=datenblatt/add-teileigentumseinheit&datenblattId=' + $('#datenblatt-form').data('datenblatt-id')  + '&teId=' + ui.item.id,
                            function(data) {
                                $('.table.te-einheiten').replaceWith($(data).find('.table.te-einheiten'));

                                _.initPlusMinusIcons('#collapse-te');
                            }
                        );

                    }

                    $(this).val(' ');
                }
            })
            .data( "ui-autocomplete" )._renderItem = function( ul, item ) {

                var columns = [
                    'te_nummer',
                ];

                var a = $('<a>');
                for (var i in columns) {
                    var columnName = columns[i];
                    a.append(
                        $('<span>')
                            .css('width', '100px')
                            .css('display', 'inline-block')
                            .text(item[columnName])
                    );
                }

                return $( "<li>" )
                    .data( "item.autocomplete", item )
                    .append( a )
                    .appendTo( ul );
            };
    }

    /**
     *
     */
    _.initFirmaProjektHausDropdown = function() {

        _form.find('[name="Datenblatt[firma_id]"]').on('focus', function () {
            _selectedFirma = this.value;
        }).change(function() {
            //if (_selectedFirma !== this.value) {
                _form.find('[name="Datenblatt[projekt_id]"]').val('');
                _form.find('[name="Datenblatt[haus_id]"]').val('');
                //_form.submit();
                _form.find('[type="submit"]').click();
            //}
        });

        _form.find('[name="Datenblatt[projekt_id]"]').on('focus', function () {
            _selectedProjekt = this.value;
        }).change(function() {
            //if (_selectedProjekt !== this.value) {
                _form.find('[name="Datenblatt[haus_id]"]').val('');
                _form.find('[type="submit"]').click();
            //}
        });

        _form.find('[name="Datenblatt[haus_id]"]').on('focus', function () {
            _selectedHaus = this.value;
        }).change(function() {
            //if (_selectedHaus !== this.value) {
                _form.find('[type="submit"]').click();
            //}
        });
    }

    _.initUpdateAbschlagDatum = function() {

        $('.update-erstelldatum').click(function(e) {
            e.preventDefault();
            var elm = $(this);

            var ladeIcon = $( ".modal-body .lade-icon" );
            ladeIcon.show();
            $('#exampleModal').modal({show: true});

            var data = {};
            $( ".modal-body .message" ).empty().load(
                elm.attr('href'),
                // $('.updateAbschlagDatumForm').serialize(),
                function( response, status, xhr ) {

                    ladeIcon.hide();

                    if ( status == "error" ) {
                        var msg = "Sorry but there was an error: ";
                        $( ".modal-body .message" ).html( msg + xhr.status + " " + xhr.statusText );
                    } else {

                        // var today = new Date();
                        // var dd = today.getDate();
                        // var mm = today.getMonth()+1; //January is 0!
                        // var yy = today.getFullYear();
                        // if (dd < 10) { dd = '0' + dd; }
                        // if (mm < 10) { mm = '0' + mm; }
                        // elm.closest('tr').find('.erstell-datum').html(dd + '.' + mm + '.' + yy);

                        _.initUpdateErstelldatumVorlageForm();
                    }
                }
            );

        });
    };

    _.initUpdateErstelldatumVorlageForm = function() {
        var form = $('.updateErstelldatumVorlageForm');
        var elm = form.find('.input-group.date');
        _.initDatepicker(elm[0]);

        form.submit(function(e) {
            e.preventDefault();

            form.find( ".submit-message" ).empty().load(
                form.attr('action'),
                form.serialize(),
                function( response, status, xhr ) {

                    if ( status == "error" ) {
                        var msg = "Sorry but there was an error: ";
                        form.find( ".submit-message" ).html( msg + xhr.status + " " + xhr.statusText );
                    } else {

                        $('#exampleModal').on('hidden.bs.modal', function () {
                            location.reload();
                        })
                    }

                }
            );

        });
    }

    _.initAbschlagMailVorlageForm = function() {

        $('.sendEinzelAbschlagMailForm').submit(function(e) {
            e.preventDefault();

            var form = $(this);

            $( ".sendEinzelAbschlagMailForm .submit-message" ).empty().load(
                form.attr('action'),
                form.serialize(),
                function( response, status, xhr ) {

                    if ( status == "error" ) {
                        var msg = "Sorry but there was an error: ";
                        $( ".modal-body .message" ).html( msg + xhr.status + " " + xhr.statusText );
                    } else {

                        $('#exampleModal').on('hidden.bs.modal', function () {
                            location.reload();
                        })
                    }

                }
            );

        });
    }

    _.initSendEinzelAbschlagMailBtn = function() {

        $('.einzel-abschlag-email-senden').click(function(e) {
            e.preventDefault();
            var elm = $(this);

            var ladeIcon = $( ".modal-body .lade-icon" );
            ladeIcon.show();
            $('#exampleModal').modal({show: true});

            var data = {};
            $( ".modal-content .modal-title" ).html('Vorlage auswählen');
            $( ".modal-body .message" ).empty().load(
                elm.attr('href'),
                // $('.updateAbschlagDatumForm').serialize(),
                function( response, status, xhr ) {

                    ladeIcon.hide();

                    if ( status == "error" ) {
                        var msg = "Sorry but there was an error: ";
                        $( ".modal-body .message" ).html( msg + xhr.status + " " + xhr.statusText );
                    }

                    _.initAbschlagMailVorlageForm();
                }
            );

        });
    };

    _.initChangingDebitorenNr = function () {
        $('#datenblatt-sap_debitor_nr').change(function () {

            var self = $(this);
            var internDebitorNr = self.val();

            $('.te-einheiten tbody tr').each(function (key, value) {
                internDebitorNr +=
                    $(this).data('prefix-debitor-nr') + $(this).data('te-nummer');
            });

            $('#datenblatt-intern_debitor_nr').val(internDebitorNr);
            console.log(internDebitorNr);
        });
    };

    _.init = function() {
        _form = $('#datenblatt-form');
        
        if(!_form) return;
        
        _.initFirmaProjektHausDropdown();
        _.initAutocompleteKunden();
        _.initAutocompleteTeileigentumseinheiten();
        _.initPlusMinusIcons();

        _.initUpdateAbschlagDatum();
        _.initSendEinzelAbschlagMailBtn();

        _.initChangingDebitorenNr();
    }
    
    _.init();
}