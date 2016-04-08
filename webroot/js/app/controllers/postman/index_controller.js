App.Controllers.PostmanIndexController = Frontend.AppController.extend({
    startup: function() {
        $('.show-collection-detail').click(this._onCollectionRowClick.bind(this));
    },
    _onCollectionRowClick: function(e) {
        var $target = $(e.currentTarget);
        $target.parentsUntil('table').next().toggleClass('hidden');
        if ($target.html() == 'Show') {
            $target.html('Hide');
        } else {
            $target.html('Show');
        }
    }
});
