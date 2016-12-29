<template>
    <div :class="'entity-selector ' + size" >
        <input type="hidden" :name="name" v-bind:value="value">
        <input type="text" :placeholder="trans('common.search')" v-on:keydown.enter.prevent v-model="search" v-on:input="searchEntitiesDebounced">
        <div class="text-center loading" v-show="loading">
            <loading></loading>
        </div>
        <div v-show="!loading" ref="results" v-html="entityResults"></div>
    </div>
</template>
<script>

    function debounce(func, wait, context, immediate) {
        let timeout;
        return function() {
            let args = arguments;
            let later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            let callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    import axios from "axios";

    export default {
        props: {
            entityTypes: {
                type: String,
                default: 'book,chapter,page'
            },
            size: {
                type: String,
                default: ''
            },
            name: {
                type: String,
                required: true
            }
        },
        mounted() {

            let $results = $(this.$refs.results);
            $results.on('click', '.entity-list a', event => {
                event.preventDefault();
                event.stopPropagation();
                let $item = $(event.currentTarget).closest('[data-entity-type]');
                this.itemSelect($item, this.isDoubleClick());
            });
            $results.on('click', '[data-entity-type]', event => {
                this.itemSelect($(event.currentTarget), this.isDoubleClick());
            });

            axios.get(this.searchUrl).then(resp => {
                this.entityResults = resp.data;
                this.loading = false;
            });
        },
        data() {
            return {
                loading: true,
                entityResults: false,
                search: '',
                lastClick: 0,
                value: ''
            }
        },
        computed: {
            searchUrl() {
                let types = this.entityTypes;
                return window.baseUrl('/ajax/search/entities?types=' + encodeURIComponent(types));
            },
            searchEntitiesDebounced() {
                return debounce(this.searchEntities, 300, this);
            }
        },
        methods: {
            itemSelect($item, doubleClick) {
                let entityType = $item.attr('data-entity-type');
                let entityId = $item.attr('data-entity-id');
                let isSelected = !$item.hasClass('selected') || doubleClick;
                $(this.$refs.results).find('.selected').removeClass('selected').removeClass('primary-background');
                if (isSelected) $item.addClass('selected').addClass('primary-background');
                this.value = isSelected ? entityType +':'+ entityId : '';

                if (!isSelected) {
                    Events.emit('entity-select-change', null);
                }

                if (!doubleClick && !isSelected) return;

                let link = $item.find('.entity-list-item-link').attr('href');
                let name = $item.find('.entity-list-item-name').text();

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
            isDoubleClick() {
                let now = Date.now();
                let isDblClick = now - this.lastClick < 300;
                this.lastClick = now;
                return isDblClick;
            },
            searchEntities() {
                this.loading = true;
                this.value = '';
                let url = this.searchUrl + '&term=' + encodeURIComponent(this.search);
                axios.get(url).then(resp => {
                    this.entityResults = resp.data;
                    this.loading = false;
                });
            }
        }
    }
</script>
