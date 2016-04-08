App.Controllers.PostmanViewController = Frontend.AppController.extend({
    startup: function() {
        $('.show-request-detail').click(this._onRequestRowClick.bind(this));
    },
    _onRequestRowClick: function(e) {
        var $target = $(e.currentTarget);
        $target.parentsUntil('table').next().toggleClass('hidden');
        if ($target.html() == 'Show') {
            $target.html('Hide');
        } else {
            $target.html('Show');
        }
    }
});
