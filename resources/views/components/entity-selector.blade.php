<div class="form-group" >
    <div id="entity-selector" class="entity-selector {{$selectorSize or ''}}" entity-types="{{ $entityTypes or 'book,chapter,page' }}">
        <input type="hidden" name="{{$name}}" v-bind:value="value">
        <input type="text" placeholder="{{ trans('common.search') }}" v-on:keydown.enter.prevent v-model="search" v-on:input="searchEntitiesDebounced">
        <div class="text-center loading" v-show="loading">@include('partials.loading-icon')</div>
        <div v-show="!loading" ref="results" v-html="entityResults"></div>
    </div>
</div>

<script>

    function debounce(func, wait, context, immediate) {
        var timeout;
        return function() {
            var args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    new Vue({
        el: '#entity-selector',
        props: ['entityTypes'],
        mounted: function() {

            var $results = $(this.$refs.results);
            $results.on('click', '.entity-list a', function(event) {
                event.preventDefault();
                event.stopPropagation();
                var $item = $(event.currentTarget).closest('[data-entity-type]');
                this.itemSelect($item, this.isDoubleClick());
            }.bind(this));
            $results.on('click', '[data-entity-type]', function(event) {
                this.itemSelect($(event.currentTarget), this.isDoubleClick());
            }.bind(this));

            axios.get(this.searchUrl).then(function(resp) {
                this.entityResults = resp.data;
                this.loading = false;
            }.bind(this));
        },
        data: {
            loading: true,
            entityResults: false,
            search: '',
            lastClick : 0,
            value: ''
        },
        computed: {
            searchUrl: function() {
                var types = this.entityTypes ? this.entityTypes : 'page,book,chapter';
                return window.baseUrl('/ajax/search/entities?types=' + encodeURIComponent(types));
            },
            entityTypes: function() {
                return this.$el.getAttribute('entity-types');
            },
            searchEntitiesDebounced: function() {
                return debounce(this.searchEntities, 300, this);
            }
        },
        methods: {
            itemSelect: function($item, doubleClick) {
                var entityType = $item.attr('data-entity-type');
                var entityId = $item.attr('data-entity-id');
                var isSelected = !$item.hasClass('selected') || doubleClick;
                $(this.$refs.results).find('.selected').removeClass('selected').removeClass('primary-background');
                if (isSelected) $item.addClass('selected').addClass('primary-background');
                this.value = isSelected ? entityType +':'+ entityId : '';

                if (!isSelected) {
                    Events.emit('entity-select-change', null);
                }

                if (!doubleClick && !isSelected) return;

                var link = $item.find('.entity-list-item-link').attr('href');
                var name = $item.find('.entity-list-item-name').text();

                if (doubleClick) {
                    Events.emit('entity-select-confirm', {
                        id: Number(entityId),
                        name: name,
                        link: link
                    });
                }

                if (isSelected) {
                    Events.emit('entity-select-change', {
                        id: Number(entityId),
                        name: name,
                        link: link
                    });
                }
            },
            isDoubleClick: function() {
                var now = Date.now();
                var isDblClick = now - this.lastClick < 300;
                this.lastClick = now;
                return isDblClick;
            },
            searchEntities:function() {
                this.loading = true;
                this.value = '';
                var url = this.searchUrl + '&term=' + encodeURIComponent(this.search);
                axios.get(url).then(function(resp) {
                    this.entityResults = resp.data;
                    this.loading = false;
                }.bind(this))
            }
        }
    })
</script>