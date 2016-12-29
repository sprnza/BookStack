<script>
    export default {
        template: '#book-dashboard-template',
        props: ['bookId'],
        data: function() {
            return {
                searching: false,
                searchTerm: '',
                searchResults: ''
            }
        },
        methods: {
            searchBook: function(event) {
                event.preventDefault();
                var _this = this;
                if (this.searchTerm.length === 0) return;
                this.searching = true;
                this.searchResults = '';
                var searchUrl = window.baseUrl('/search/book/' + this.bookId);
                searchUrl += '?term=' + encodeURIComponent(this.searchTerm);
                axios.get(searchUrl).then(function(resp) {
                    _this.searchResults = resp.data;
                });
            },
            checkSearching: function() {
                if (this.searchTerm.length < 1) this.searching = false;
            },
            clearSearch: function() {
                this.searching = false;
                this.searchTerm = '';
            }
        }
    }
</script>
