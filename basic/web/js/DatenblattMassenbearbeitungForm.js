var DatenblattMassenbearbeitungForm = function () {
    var _ = this;

    _.initSortables = function () {

        var oldContainer;
        $("ol.abschlag").sortable({
            drag: false,
            drop: false
            // group: 'nested_with',
            // afterMove: function (placeholder, container) {
            //     if(oldContainer != container){
            //         if(oldContainer)
            //             oldContainer.el.removeClass("active");
            //         container.el.addClass("active");
            //
            //         oldContainer = container;
            //     }
            // },
            // onDrop: function ($item, container, _super) {
            //     container.el.removeClass("active");
            //     _super($item, container);
            // }
        });
        $(".milestone").sortable({
            group: 'milestone',
            // afterMove: function (placeholder, container) {
            //     if(oldContainer != container){
            //         if(oldContainer)
            //             oldContainer.el.removeClass("active");
            //         container.el.addClass("active");
            //
            //         oldContainer = container;
            //     }
            // },
            // onDrop: function ($item, container, _super) {
            //     container.el.removeClass("active");
            //     _super($item, container);
            // }
        });

    };

    _.init = function() {

        _.initSortables();

    }
    
    _.init();
}