<div id="image-manager" image-type="{{ $imageType }}" uploaded-to="{{ $uploaded_to or 0 }}">
    <div class="overlay" v-on:click="hide">
        <div class="popup-body" v-on:click.stop>

            <div class="popup-header primary-background">
                <div class="popup-title">{{ trans('components.imagem_select') }}</div>
                <button class="popup-close neg corner-button button">x</button>
            </div>

            <div class="flex-fill image-manager-body">

                <div class="image-manager-content">
                    <div v-if="imageType === 'gallery'" class="container">
                        <div class="image-manager-header row faded-small nav-tabs">
                            <div class="col-xs-4 tab-item" title="{{ trans('components.imagem_all_title') }}" v-bind:class="{selected: (view=='all')}" v-on:click="setView('all')"><i class="zmdi zmdi-collection-image"></i> {{ trans('components.imagem_all') }}</div>
                            <div class="col-xs-4 tab-item" title="{{ trans('components.imagem_book_title') }}" v-bind:class="{selected: (view=='book')}" v-on:click="setView('book')"><i class="zmdi zmdi-book text-book"></i> {{ trans('entities.book') }}</div>
                            <div class="col-xs-4 tab-item" title="{{ trans('components.imagem_page_title') }}" v-bind:class="{selected: (view=='page')}" v-on:click="setView('page')"><i class="zmdi zmdi-file-text text-page"></i> {{ trans('entities.page') }}</div>
                        </div>
                    </div>
                    <div v-show="view === 'all'">
                        <form v-on:submit="searchImages" class="contained-search-box">
                            <input type="text" placeholder="{{ trans('components.imagem_search_hint') }}" v-model="searchTerm">
                            <button v-bind:class="{active: searching}" title="{{ trans('common.search_clear') }}" type="button" v-on:click="cancelSearch" class="text-button cancel"><i class="zmdi zmdi-close-circle-o"></i></button>
                            <button title="{{ trans('common.search') }}" class="text-button" type="submit"><i class="zmdi zmdi-search"></i></button>
                        </form>
                    </div>
                    <div class="image-manager-list">
                        <div v-for="image, $index in images">
                            <div class="image anim fadeIn" v-bind:style="{animationDelay: ($index > 26) ? '160ms' : ($index * 25) + 'ms'}"
                                 v-bind:class="{selected: (image==selectedImage)}" v-on:click="imageSelect(image)">
                                <img v-bind:src="image.thumbs.gallery" v-bind:alt="image.title" v-bind:title="image.name">
                                <div class="image-meta">
                                    <span class="name" v-text="image.name"></span>
                                    <span class="date">{!! trans('components.imagem_uploaded', ['uploadedDate' => "<span v-text='getDate(image.created_at)'></span>"]) !!}</span>
                                </div>
                            </div>
                        </div>
                        <div class="load-more" v-show="hasMore" v-on:click="fetchData">{{ trans('components.imagem_load_more') }}</div>
                    </div>
                </div>

                <div class="image-manager-sidebar">
                    <div class="inner">

                        <div class="image-manager-details anim fadeIn" v-if="selectedImage">

                            <form v-on:submit.prevent="saveImageDetails">
                                <div>
                                    <a v-bind:href="selectedImage.url" target="_blank" style="display: block;">
                                        <img v-bind:src="selectedImage.thumbs.gallery" v-bind:alt="selectedImage.title" v-bind:title="selectedImage.name">
                                    </a>
                                </div>
                                <div class="form-group">
                                    <label for="name">{{ trans('components.imagem_image_name') }}</label>
                                    <input type="text" id="name" name="name" v-model="selectedImage.name">
                                </div>
                            </form>

                            <div v-if="dependantPages">
                                <p class="text-neg text-small">
                                    {{ trans('components.imagem_delete_confirm') }}
                                </p>
                                <ul class="text-neg">
                                    <li v-for="page in dependantPages">
                                        <a v-bind:href="page.url" target="_blank" class="text-neg" v-text="page.name"></a>
                                    </li>
                                </ul>
                            </div>

                            <div class="clearfix">
                                <form class="float left" v-on:submit.prevent="deleteImage">
                                    <button class="button icon neg"><i class="zmdi zmdi-delete"></i></button>
                                </form>
                                <button class="button pos anim fadeIn float right" v-show="selectedImage" v-on:click="callbackAndHide(selectedImage)">
                                    <i class="zmdi zmdi-square-right"></i>{{ trans('components.imagem_select_image') }}
                                </button>
                            </div>

                        </div>

                        <drop-zone message="{{ trans('components.imagem_dropzone') }}" v-bind:upload-url="uploadUrl" v-bind:uploaded-to="uploadedTo" v-bind:event-success="uploadSuccess"></drop-zone>


                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@include('components.dropzone')
<script>

    window.ImageManagerService = new Vue({
        el: '#image-manager',
        data: {
            images: [],
            selectedImage: false,
            dependantPages: false,
            showing: false,
            hasMore: false,
            view: 'all',
            searching: false,
            searchTerm: '',
            dataLoaded: false,
            page: 0,
            callback: null,
            preSearch: {
                images: [],
                hasMore: false
            },
            prevClick: {
                time: 0,
                image: 0
            }
        },
        computed: {
            imageType: function() {
                return this.$el.getAttribute('image-type');
            },
            uploadedTo: function() {
                return this.$el.getAttribute('uploaded-to');
            },
            uploadUrl: function() {
                return window.baseUrl('/images/' + this.imageType + '/upload');
            }
        },
        methods: {
            show: function(doneCallback) {
                this.callback = doneCallback;
                this.showing = true;
                $(this.$el).find('.overlay').css('display', 'flex').hide().fadeIn(240);
                // Get initial images if they have not yet been loaded in.
                if (!this.dataLoaded) {
                    this.fetchData();
                    this.dataLoaded = true;
                }
            },
            hide: function() {
                this.showing = false;
                $(this.$el).find('.overlay').fadeOut(240);
            },
            fetchData: function() {
                var _this = this;
                var imageEndpoint = this.searching ? 'search' : this.view;
                var url = window.baseUrl('/images/' + this.imageType + '/' +  imageEndpoint + '/');
                url += this.page + '?';

                if (this.uploadedTo) url += 'page_id=' + encodeURIComponent(this.uploadedTo) + '&';
                if (this.searching) url += 'term=' + encodeURIComponent(this.searchTerm);

                axios.get(url).then(function(resp) {
                    _this.images = resp.data.images;
                    _this.hasMore = resp.data.hasMore;
                    _this.page++;
                });
            },
            cancelSearch: function() {
                this.searching = false;
                this.searchTerm = '';
                this.images = this.preSearch.images;
                this.hasMore = this.preSearch.hasMore;
            },
            setView: function(viewName) {
                this.cancelSearch();
                this.images = [];
                this.hasMore = false;
                this.page = 0;
                this.view = viewName;
                this.fetchData();
            },
            searchImages: function() {
                if (this.searchTerm === '') {
                    this.cancelSearch();
                    return;
                }
                if (!this.searching) {
                    this.preSearch.images = this.images;
                    this.preSearch.hasMore = this.hasMore;
                }
                this.searching = true;
                this.images = [];
                this.hasMore = false;
                this.page = 0;
                this.fetchData();
            },
            imageSelect: function(image) {
                var dblClickTime = 300;
                var currentTime = Date.now();
                var timeDiff = currentTime - this.prevClick.time;

                if (timeDiff < dblClickTime && image.id === this.prevClick.image) {
                    // If double click
                    this.callbackAndHide(image);
                } else {
                    // If single
                    this.selectedImage = image;
                    this.dependantPages = false;
                }
                this.prevClick.time = currentTime;
                this.prevClick.image = image.id;
            },
            callbackAndHide: function(image) {
                if (this.callback) this.callback(image);
                this.hide();
            },
            getDate: function(stringDate) {
                return new Date(stringDate);
            },
            saveImageDetails: function() {
                var url = window.baseUrl('/images/update/' + this.selectedImage.id);
                axios.put(url, this.selectedImage).then(function(resp) {
                    Events.emit('success', 'Image details updated');
                }).catch(function(error) {
                    if (error.response.status === 422) {
                        var errors = error.data;
                        var message = '';
                        Object.keys(errors).forEach((key) => {
                            message += errors[key].join('\n');
                        });
                        Events.emit('error', message);
                    } else if (error.response.status === 403) {
                        Events.emit('error', error.data.error);
                    } else {
                        Events.emit('error', 'An error occurred while updating the selected image');
                        console.dir(error);
                    }
                });
            },
            deleteImage: function() {
                var force = this.dependantPages !== false;
                var url = window.baseUrl('/images/' + this.selectedImage.id);
                if (force) url += '?force=true';
                var _this = this;
                axios.delete(url).then(function(response) {
                    _this.images.splice(_this.images.indexOf(_this.selectedImage), 1);
                    _this.selectedImage = false;
                    Events.emit('success', 'Image successfully deleted');
                }).catch(function(error) {
                    // Pages failure
                    if (error.response.status === 400) {
                        _this.dependantPages = error.response.data;
                    } else if (error.response.status === 403) {
                        Events.emit('error', error.response.data.error);
                    }
                });
            },
            uploadSuccess: function(file, data) {
                this.images.unshift(data);
                Events.emit('success', 'Image uploaded');
            }
        }
    });
</script>