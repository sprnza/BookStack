<template>
    <div class="image-manager">
        <div class="overlay" @click="hide">
            <div class="popup-body" @click.stop>

                <div class="popup-header primary-background">
                    <div class="popup-title" v-text="trans('components.imagem_select')"></div>
                    <button class="popup-close neg corner-button button">x</button>
                </div>

                <div class="flex-fill image-manager-body">

                    <div class="image-manager-content">
                        <div v-if="imageType === 'gallery'" class="container">
                            <div class="image-manager-header row faded-small nav-tabs">
                                <div class="col-xs-4 tab-item" :title="trans('components.imagem_all_title')" :class="{selected: (view=='all')}" @click="setView('all')"><i class="zmdi zmdi-collection-image"></i> <span v-text="trans('components.imagem_all')"></span></div>
                                <div class="col-xs-4 tab-item" :title="trans('components.imagem_book_title')" :class="{selected: (view=='book')}" @click="setView('book')"><i class="zmdi zmdi-book text-book"></i> <span v-text="trans('entities.book')"></span></div>
                                <div class="col-xs-4 tab-item" :title="trans('components.imagem_page_title')" :class="{selected: (view=='page')}" @click="setView('page')"><i class="zmdi zmdi-file-text text-page"></i> <span v-text="trans('entities.page')"></span></div>
                            </div>
                        </div>
                        <div v-show="view === 'all'">
                            <form @submit="searchImages" class="contained-search-box">
                                <input type="text" :placeholder="trans('components.imagem_search_hint')" v-model="searchTerm">
                                <button :class="{active: searching}" :title=" trans('common.search_clear')" type="button" @click="cancelSearch" class="text-button cancel"><i class="zmdi zmdi-close-circle-o"></i></button>
                                <button :title="trans('common.search')" class="text-button" type="submit"><i class="zmdi zmdi-search"></i></button>
                            </form>
                        </div>
                        <div class="image-manager-list">
                            <div v-for="image, $index in images">
                                <div class="image anim fadeIn" :style="{animationDelay: ($index > 26) ? '160ms' : ($index * 25) + 'ms'}"
                                     :class="{selected: (image==selectedImage)}" @click="imageSelect(image)">
                                    <img :src="image.thumbs.gallery" :alt="image.title" :title="image.name">
                                    <div class="image-meta">
                                        <span class="name" v-text="image.name"></span>
                                        <span class="date" v-text="trans('components.imagem_uploaded', {uploadedDate: getDate(image.created_at)})"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="load-more" v-show="hasMore" @click="fetchData" v-text="trans('components.imagem_load_more')"></div>
                        </div>
                    </div>

                    <div class="image-manager-sidebar">
                        <div class="inner">

                            <div class="image-manager-details anim fadeIn" v-if="selectedImage">

                                <form @submit.prevent="saveImageDetails">
                                    <div>
                                        <a :href="selectedImage.url" target="_blank" style="display: block;">
                                            <img :src="selectedImage.thumbs.gallery" :alt="selectedImage.title" :title="selectedImage.name">
                                        </a>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" v-text="trans('components.imagem_image_name')"></label>
                                        <input type="text" id="name" name="name" v-model="selectedImage.name">
                                    </div>
                                </form>

                                <div v-if="dependantPages">
                                    <p class="text-neg text-small" v-text="trans('components.imagem_delete_confirm')"></p>
                                    <ul class="text-neg">
                                        <li v-for="page in dependantPages">
                                            <a :href="page.url" target="_blank" class="text-neg" v-text="page.name"></a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="clearfix">
                                    <form class="float left" @submit.prevent="deleteImage">
                                        <button class="button icon neg"><i class="zmdi zmdi-delete"></i></button>
                                    </form>
                                    <button class="button pos anim fadeIn float right" v-show="selectedImage" @click="callbackAndHide(selectedImage)">
                                        <i class="zmdi zmdi-square-right"></i><span v-text="trans('components.imagem_select_image')"></span>
                                    </button>
                                </div>

                            </div>

                            <drop-zone :message="trans('components.imagem_dropzone')" :upload-url="uploadUrl" :uploaded-to="uploadedTo" :event-success="uploadSuccess"></drop-zone>


                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            imageType: {
                type: String,
                default: 'gallery'
            },
            uploadedTo: {
                type: null
            }
        },
        data() {
            return {
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
            };
        },
        mounted() {
            window.ImageManagerService = this;
        },
        computed: {
            uploadUrl() {
                return window.baseUrl('/images/' + this.imageType + '/upload');
            }
        },
        methods: {
            show(doneCallback) {
                this.callback = doneCallback;
                this.showing = true;
                $(this.$el).find('.overlay').css('display', 'flex').hide().fadeIn(240);
                // Get initial images if they have not yet been loaded in.
                if (!this.dataLoaded) {
                    this.fetchData();
                    this.dataLoaded = true;
                }
            },
            hide() {
                this.showing = false;
                $(this.$el).find('.overlay').fadeOut(240);
            },
            fetchData() {
                let imageEndpoint = this.searching ? 'search' : this.view;
                let url = window.baseUrl('/images/' + this.imageType + '/' + imageEndpoint + '/');
                url += this.page + '?';

                if (this.uploadedTo) url += 'page_id=' + encodeURIComponent(this.uploadedTo) + '&';
                if (this.searching) url += 'term=' + encodeURIComponent(this.searchTerm);

                axios.get(url).then(resp => {
                    this.images = resp.data.images;
                    this.hasMore = resp.data.hasMore;
                    this.page++;
                });
            },
            cancelSearch() {
                this.searching = false;
                this.searchTerm = '';
                this.images = this.preSearch.images;
                this.hasMore = this.preSearch.hasMore;
            },
            setView(viewName) {
                this.cancelSearch();
                this.images = [];
                this.hasMore = false;
                this.page = 0;
                this.view = viewName;
                this.fetchData();
            },
            searchImages() {
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
            imageSelect(image) {
                let dblClickTime = 300;
                let currentTime = Date.now();
                let timeDiff = currentTime - this.prevClick.time;

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
            callbackAndHide(image) {
                if (this.callback) this.callback(image);
                this.hide();
            },
            getDate(stringDate) {
                return new Date(stringDate);
            },
            saveImageDetails() {
                let url = window.baseUrl('/images/update/' + this.selectedImage.id);
                axios.put(url, this.selectedImage).then(function (resp) {
                    Events.emit('success', 'Image details updated');
                }).catch(function (error) {
                    if (error.response.status === 422) {
                        let errors = error.data;
                        let message = '';
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
            deleteImage() {
                let force = this.dependantPages !== false;
                let url = window.baseUrl('/images/' + this.selectedImage.id);
                if (force) url += '?force=true';
                let _this = this;
                axios.delete(url).then(function (response) {
                    _this.images.splice(_this.images.indexOf(_this.selectedImage), 1);
                    _this.selectedImage = false;
                    Events.emit('success', 'Image successfully deleted');
                }).catch(function (error) {
                    // Pages failure
                    if (error.response.status === 400) {
                        _this.dependantPages = error.response.data;
                    } else if (error.response.status === 403) {
                        Events.emit('error', error.response.data.error);
                    }
                });
            },
            uploadSuccess(file, data) {
                this.images.unshift(data);
                Events.emit('success', 'Image uploaded');
            }
        }
    };
</script>
