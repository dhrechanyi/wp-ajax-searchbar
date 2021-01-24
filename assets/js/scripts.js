jQuery(function($) {
    var wp_ajax_searchbar_plugin = new Vue({
        el: '#wp-ajax-searchbar-plugin',
        data: {
            nonce: '',
            language: '',
            input: '',
            results: [],
            ajax_url: __wp_ajax_searchbar.ajax_url,
            ajax: null,
            loaded: false
        },
        mounted: function () {
            var self = this;
            
            $(document).on('click', function (e) {
                if(self.ajax !== null) {
                    self.ajax.abort();
                }
                
                self.results = [];
            });
            
            $(document).on('click', '#wp-ajax-searchbar-plugin', function (e) {
                e.stopPropagation();
            })
            
            $('.ast-header-widget-area aside.widget.widget_text').remove();
            self.nonce = $('.wp-ajax-searchbar-plugin').data('nonce');
            self.language = $('.wp-ajax-searchbar-plugin').data('language');
            self.loaded = true;
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
                        language: self.language,
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