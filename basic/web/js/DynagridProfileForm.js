var DynagridProfileForm = function () {
    var _ = this;

    _modal = $('#dynagrid-profile-modal');
    _plusIcon = $('.add-dyngrid-profile');
    _minusIcon = $('.remove-dynagrid-profile');
    _profileDropdown = $('[name="dynagridProfileId"]');


    _.initDropdown = function () {

        _profileDropdown.change(function () {
            console.log(this.value);
            location.href = 'index.php?r=dynagrid-profile/set-active&id=' + this.value;
        });
    }

    _.initPlusIcon = function() {

        _plusIcon.click(function(e) {
            e.preventDefault();

            _modal.find(".modal-body").load(_plusIcon.attr('href'), function() {
                _modal.modal('show');
            });
        });

        // form submit
        _modal.on('form', 'submit', function(e) {
            e.preventDefault();
            // POST Request
            $.post(plusIcon.attr('href'), _form.serialize(), function (data) {
                console.log(data);
                var jsonData = JSON.parse(data);

                if (jsonData.result == 'ok') {
                    // location.reload(true);
                    // _modal.modal('hide');
                }
            });

            return false;
        });
    }

    _.initMinusIcon = function() {

        _minusIcon.click(function(e) {
            e.preventDefault();
            console.log(_profileDropdown);
            var url = $(this) .attr('href') + _profileDropdown.val();
            $.get(url, function (data) {
                console.log(data);
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
    }

    _.init();
}