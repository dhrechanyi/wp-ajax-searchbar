jQuery(function($) {
    var smd_search_plugin = new Vue({
        el: '#wp-ajax-searchbar-plugin',
        data: {
            none: '',
            input: '',
            results: [],
            ajax_url: __wp_ajax_searchbar.ajax_url,
            ajax: null,
            loaded: false
        },
        mounted: function () {
            this.nonce = $('.wp-ajax-searchbar-plugin').data('none');
            this.loaded = true;
        },
        methods: {
            getResults: function (e) {
                if(e.keyCode === 13) {
                    return;
                }
                
                var self = this;
                
                if(self.ajax !== null) {
                    self.ajax.abort();
                }
                
                self.ajax = $.ajax({
                    type : 'post',
                    dataType : 'json',
                    url : self.ajax_url,
                    data : {
                        action: 'wp_ajax_searchbar_run_query',
                        nonce: self.nonce,
                        search_query: self.input
                    },
                    complete: function () {
                        self.ajax = null                    
                    },
                    success: function(response) {
                        self.results = response;
                    }
                })         
            }
        }
    });
});