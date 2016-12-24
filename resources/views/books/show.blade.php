@extends('base')

@section('content')

    <div class="faded-small toolbar" xmlns:v-on="http://www.w3.org/1999/xhtml"
         xmlns:v-on="http://www.w3.org/1999/xhtml" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div class="container">
            <div class="row">
                <div class="col-md-6 faded">
                    @include('books._breadcrumbs', ['book' => $book])
                </div>
                <div class="col-md-6">
                    <div class="action-buttons faded">
                        @if(userCan('page-create', $book))
                            <a href="{{ $book->getUrl('/page/create') }}" class="text-pos text-button"><i class="zmdi zmdi-plus"></i>{{ trans('entities.pages_new') }}</a>
                        @endif
                        @if(userCan('chapter-create', $book))
                            <a href="{{ $book->getUrl('/chapter/create') }}" class="text-pos text-button"><i class="zmdi zmdi-plus"></i>{{ trans('entities.chapters_new') }}</a>
                        @endif
                        @if(userCan('book-update', $book))
                            <a href="{{$book->getEditUrl()}}" class="text-primary text-button"><i class="zmdi zmdi-edit"></i>{{ trans('common.edit') }}</a>
                        @endif
                        @if(userCan('book-update', $book) || userCan('restrictions-manage', $book) || userCan('book-delete', $book))
                            <div dropdown class="dropdown-container">
                                <a dropdown-toggle class="text-primary text-button"><i class="zmdi zmdi-more-vert"></i></a>
                                <ul>
                                    @if(userCan('book-update', $book))
                                        <li><a href="{{ $book->getUrl('/sort') }}" class="text-primary"><i class="zmdi zmdi-sort"></i>{{ trans('common.sort') }}</a></li>
                                    @endif
                                    @if(userCan('restrictions-manage', $book))
                                        <li><a href="{{ $book->getUrl('/permissions') }}" class="text-primary"><i class="zmdi zmdi-lock-outline"></i>{{ trans('entities.permissions') }}</a></li>
                                    @endif
                                    @if(userCan('book-delete', $book))
                                        <li><a href="{{ $book->getUrl('/delete') }}" class="text-neg"><i class="zmdi zmdi-delete"></i>{{ trans('common.delete') }}</a></li>
                                    @endif
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container" id="book-dashboard" data-book-id="{{ $book->id }}">
        <div class="row">
            <div class="col-md-7">

                <h1>{{$book->name}}</h1>
                <div class="book-content" v-show="!searching">
                    <p class="text-muted">{{$book->description}}</p>

                    <div class="page-list">
                        <hr>
                        @if(count($bookChildren) > 0)
                            @foreach($bookChildren as $childElement)
                                @if($childElement->isA('chapter'))
                                    @include('chapters/list-item', ['chapter' => $childElement])
                                @else
                                    @include('pages/list-item', ['page' => $childElement])
                                @endif
                                <hr>
                            @endforeach
                        @else
                            <p class="text-muted">{{ trans('entities.books_empty_contents') }}</p>
                            <p>
                                <a href="{{ $book->getUrl('/page/create') }}" class="text-page"><i class="zmdi zmdi-file-text"></i>{{ trans('entities.books_empty_create_page') }}</a>
                                &nbsp;&nbsp;<em class="text-muted">-{{ trans('entities.books_empty_or') }}-</em>&nbsp;&nbsp;&nbsp;
                                <a href="{{ $book->getUrl('/chapter/create') }}" class="text-chapter"><i class="zmdi zmdi-collection-bookmark"></i>{{ trans('entities.books_empty_add_chapter') }}</a>
                            </p>
                            <hr>
                        @endif
                        @include('partials.entity-meta', ['entity' => $book])
                    </div>
                </div>
                <div class="search-results" v-show="searching">
                    <h3 class="text-muted">{{ trans('entities.search_results') }} <a v-if="searching" v-on:click="clearSearch()" class="text-small"><i class="zmdi zmdi-close"></i>{{ trans('entities.search_clear') }}</a></h3>
                    <div v-if="!searchResults">
                        @include('partials/loading-icon')
                    </div>
                    <div v-html="searchResults"></div>
                </div>

            </div>

            <div class="col-md-4 col-md-offset-1">
                <div class="margin-top large"></div>
                @if($book->restricted)
                    <p class="text-muted">
                        @if(userCan('restrictions-manage', $book))
                            <a href="{{ $book->getUrl('/permissions') }}"><i class="zmdi zmdi-lock-outline"></i>{{ trans('entities.books_permissions_active') }}</a>
                        @else
                            <i class="zmdi zmdi-lock-outline"></i>{{ trans('entities.books_permissions_active') }}
                        @endif
                    </p>
                @endif
                <div class="search-box">
                    <form v-on:submit="searchBook">
                        <input v-model="searchTerm" v-on:input="checkSearching" type="text" name="term" placeholder="{{ trans('entities.books_search_this') }}">
                        <button type="submit"><i class="zmdi zmdi-search"></i></button>
                        <button v-if="searching" v-on:click="clearSearch" type="button"><i class="zmdi zmdi-close"></i></button>
                    </form>
                </div>
                <div class="activity anim fadeIn">
                    <h3>{{ trans('entities.recent_activity') }}</h3>
                    @include('partials/activity-list', ['activity' => Activity::entityActivity($book, 20, 0)])
                </div>
            </div>
        </div>
    </div>

    <script>
        new Vue({
            el: '#book-dashboard',
            data: {
                searching: false,
                searchTerm: '',
                searchResults: ''
            },
            methods: {
                searchBook: function(event) {
                    event.preventDefault();
                    var _this = this;
                    if (this.searchTerm.length === 0) return;
                    this.searching = true;
                    this.searchResults = '';
                    var searchUrl = window.baseUrl('/search/book/' + this.$el.getAttribute('data-book-id'));
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
        })
    </script>

@stop