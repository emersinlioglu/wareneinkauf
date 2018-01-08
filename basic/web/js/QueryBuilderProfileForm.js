var QueryBuilderProfileForm = function (filters, rules) {
    var _ = this;

    _.modal = $('#query-builder-profile-modal');
    _.plusIcon = $('.add-query-builder-profile');
    _.minusIcon = $('.remove-query-builder-profile');
    _.profileDropdown = $('[name="queryBuilderProfileId"]');

    _.form = $('.query-builder-form');
    _.builder = $('#querybuilder');
    _filters = filters;
    _rules = (rules) ? rules : [];

    _.initQueryBuilder = function() {

        _.builder.queryBuilder({
            lang_code: 'de',
            allow_empty: true,
            filters: _filters
        });
        _.builder.queryBuilder('setRules', _rules);

        _.form.find('[type=\"reset\"]').on('click', function(){
            _.builder.queryBuilder('reset');
        });
        _.form.on('submit', function(){
            var rules = _.builder.queryBuilder('getRules');
            var input = $(this).find("input[name='QueryBuilderProfile[filter_rules]']");
            input.val(JSON.stringify(rules));
        });
    }

    _.initDropdown = function () {

        _.profileDropdown.change(function () {
            location.href = 'index.php?r=query-builder-profile/set-active&id=' + this.value;
        });
    }

    _.initPlusIcon = function() {

        _.plusIcon.click(function(e) {
            e.preventDefault();

            _.modal.find(".modal-body").load(_.plusIcon.attr('href'), function() {
                _.modal.modal('show');

                console.log('rules: ');
                console.log(_.builder.queryBuilder('getRules'));
                console.log('hidden element: ');
                console.log($(this).find('[name="QueryBuilderProfile[filter_rules]"]'));

                $(this).find('[name="QueryBuilderProfile[filter_rules]"]')
                    .val(JSON.stringify(_.builder.queryBuilder('getRules')));
            });
        });

        // // form submit
        // _.modal.on('form', 'submit', function(e) {
        //     e.preventDefault();
        //
        //     // POST Request
        //     $.post(plusIcon.attr('href'), $(this).serialize(), function (data) {
        //         //console.log(data);
        //         var jsonData = JSON.parse(data);
        //
        //         if (jsonData.result == 'ok') {
        //             // location.reload(true);
        //             // _.modal.modal('hide');
        //         }
        //     });
        //
        //     return false;
        // });
    }

    _.initMinusIcon = function() {

        _.minusIcon.click(function(e) {
            e.preventDefault();
            var url = _.minusIcon.attr('href') + _.profileDropdown.val();
            $.get(url, function (data) {
                var jsonData = JSON.parse(data);

                if (jsonData.result == 'ok') {
                    location.reload(true);
                    // _.modal.modal('hide');
                }
            });
        });

    }

    _.init = function () {

        _.initDropdown();
        _.initPlusIcon();
        _.initMinusIcon();
        _.initQueryBuilder();
    }

    _.init();
}