<div id="wp-ajax-searchbar-plugin" class="wp-ajax-searchbar-plugin" data-nonce="<?php echo wp_create_nonce('wp_ajax_searchbar_nonce'); ?>">
    <div class="wrapper">
        <div class="input-box">
            <input type="text" class="input-field" :class="ajax ? 'is-loading' : ''" placeholder="<?php _e( 'Search here', 'wp-ajax-searchbar-plugin' ); ?>" v-model="input" @keyup="getResults($event)">
        </div>
        <div v-if="results.length" class="autocomplete-box" :class="loaded ? 'loaded' : ''">
            <ul>
                <li v-for="post in results" :key="post.id">
                    <a :href="post.url" v-text="post.title"></a>
                </li>
            </ul>
        </div>
    </div>
</div>