var QueryBuilderProfileForm = function (filters, rules) {
    var _ = this;

    _modal = $('#query-builder-profile-modal');
    _plusIcon = $('.add-query-builder-profile');
    _minusIcon = $('.remove-query-builder-profile');
    _profileDropdown = $('[name="queryBuilderProfileId"]');

    var form = $('.query-builder-form');
    var builder = $('#querybuilder');
    _filters = filters;
    _rules = (rules) ? rules : [];

    _.initQueryBuilder = function() {

        builder.queryBuilder({
            lang_code: 'de',
            allow_empty: true,
            filters: _filters
        });
        builder.queryBuilder('setRules', _rules);

        form.find('[type=\"reset\"]').on('click', function(){
            builder.queryBuilder('reset');
        });
        form.on('submit', function(){
            var rules = builder.queryBuilder('getRules');
            var input = $(this).find("input[name='QueryBuilderProfile[filter_rules]']");
            input.val(JSON.stringify(rules));
        });
    }

    _.initDropdown = function () {

        _profileDropdown.change(function () {
            location.href = 'index.php?r=query-builder-profile/set-active&id=' + this.value;
        });
    }

    _.initPlusIcon = function() {

        _plusIcon.click(function(e) {
            e.preventDefault();

            _modal.find(".modal-body").load(_plusIcon.attr('href'), function() {
                _modal.modal('show');

                console.log('rules: ');
                console.log(builder.queryBuilder('getRules'));
                console.log('hidden element: ');
                console.log($(this).find('[name="QueryBuilderProfile[filter_rules]"]'));

                $(this).find('[name="QueryBuilderProfile[filter_rules]"]')
                    .val(JSON.stringify(builder.queryBuilder('getRules')));
            });
        });

        // // form submit
        // _modal.on('form', 'submit', function(e) {
        //     e.preventDefault();
        //
        //     // POST Request
        //     $.post(plusIcon.attr('href'), $(this).serialize(), function (data) {
        //         //console.log(data);
        //         var jsonData = JSON.parse(data);
        //
        //         if (jsonData.result == 'ok') {
        //             // location.reload(true);
        //             // _modal.modal('hide');
        //         }
        //     });
        //
        //     return false;
        // });
    }

    _.initMinusIcon = function() {

        _minusIcon.click(function(e) {
            e.preventDefault();
            var url = _minusIcon.attr('href') + _profileDropdown.val();
            $.get(url, function (data) {
                var jsonData = JSON.parse(data);

                if (jsonData.result == 'ok') {
                    location.reload(true);
                    // _modal.modal('hide');
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