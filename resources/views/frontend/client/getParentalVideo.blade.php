
    <div class="single-vidio-wrapper">
        <div class="video-area">
            @if ($selectedVideoInfo->video_type == '4')
                <video width="100%" height="100%" controls>
                    <source src="{{ URL::to('/') }}/uploads/video/{{ $selectedVideoInfo->video }}">
                </video>
            @elseif ($selectedVideoInfo->video_type == '5')
                <video width="100%" height="100%" controls>
                    <source src="{{ $selectedVideoInfo->url }}">
                </video>
            @elseif ($selectedVideoInfo->video_type == '1')
                {!! $embeded !!}
            @elseif ($selectedVideoInfo->video_type == '2')
                {!! $embeded !!}
            @elseif ($selectedVideoInfo->video_type == '3')
                {!! $embeded !!}
            @endif
        </div>
    </div>

    <div class="single-vidio-description ptb-30">
        <div class="row single-vidio-rs">
            <div class="col-md-9 left-part-rs col-sm-12">
                <div class="left-part">
                    @if (!empty($selectedVideoInfo->thumbnail_vertical))
                        <img src="{{ URL::to('/') }}/uploads/video/thumbnail/{{ $selectedVideoInfo->thumbnail_vertical }}"
                            alt="{{ $selectedVideoInfo->title }}" title="{{ $selectedVideoInfo->title }}" />
                    @else
                        <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt="" />
                    @endif
                    <div class="title">
                        <h3>{{ $selectedVideoInfo->title ?? '' }}</h3>
                        <p>
                            <span class="borR">{{ $selectedVideoInfo->category_name ?? '' }} </span> &nbsp;
                            <span class="borR">{{ $selectedVideoInfo->sub_category_name ?? '' }} </span>
                            &nbsp;
                            <span class="borR">{{ $genreNames }} </span> &nbsp;
                            <span class="">{{ $countryNames }} </span> &nbsp;
                        </p>
                        <div class="imdb">
                            <span> <i class="icofont icofont-star"></i> {!! !empty($tmdbRating['vote_average']) ? $tmdbRating['vote_average'] . ' TMDB' : '' !!} </span>

                            <div class="middle-devider-bold"></div>

                            <span
                                class="pl-2">{{ $selectedVideoInfo->duration_hour ? $selectedVideoInfo->duration_hour . ' Hour' : '' }}</span>
                            <span
                                class="">{{ $selectedVideoInfo->duration ? $selectedVideoInfo->duration . ' Min' : '' }}</span>
                            <span
                                class="">{{ $selectedVideoInfo->duration_sec ? $selectedVideoInfo->duration_sec . ' Sec' : '' }}</span>

                            <div class="middle-devider-bold"></div>

                            <button type="button" class="watch-trailer-btn-style {!! !empty($data->trailer) ? '' : 'no-trailer-avilable' !!}" data-toggle="modal"
                                data-target="#trailerModal">Watch Trailer</button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-3 col-sm-12 right-part">
                <ul>
                    <li>
                        <button type="button" class="share-button" data-toggle="modal"
                            data-target="#commentData">
                            <i class="far fa-comments"></i>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="share-button" data-toggle="modal"
                            data-target="#shareModal">
                            <i class="fas fa-share-alt"></i>
                        </button>
                    </li>
                    <li>

                        {{-- favorite btn --}}
                        @if (!empty(Auth()->id()))
                            <?php
                            $checked = '';
                            if (in_array($selectedVideoInfo->id, $favoriteList)) {
                                $checked = 'checked';
                            }
                            ?>
                            <input type="checkbox" class="video-id single-favorite" name="video_id"
                                value="{{ $selectedVideoInfo->id }}" {{ $checked }}>
                        @endif
                        {{-- end favorite btn --}}
                    </li>
                    <li>
                        @if (!empty(Auth()->id()))
                            <button type="button" id="reportButton" class="share-button" data-toggle="modal"
                                data-target="#reportModal" data-id="{{ $selectedVideoInfo->id }}">
                                <i class="fas fa-exclamation-triangle"></i>
                            </button>
                        @endif
                    </li>
                </ul>
            </div>
            <div class="col-md-12 decription">
                <p>{{ $selectedVideoInfo->description ?? '' }}</p>
            </div>
            <div class="col-md-12 dir-cast">
                <p><span class="cast-crew"> Cast & Crew :</span> &nbsp;{{ $celibrityNames }}</p>
            </div>
            {{-- Start::Comment Section --}}
            @if ($selectedVideoInfo->comment_on_off === 'on')
                <div class="comment-section col-md-12">
                    <h3 class="comment-tiltle">COMMENT</h3>
                    {{-- Start:: User Create Comment Section --}}
                    @if (!empty(Auth()->id()))
                        <form id="commentCreateForm" method="POST" enctype="multipart/form-data">
                            <div class="create-comment row">
                                <div class="comment-user-img">
                                    @if (!empty(Auth::user()->image))
                                        <img src="{{ URL::to('/') }}/uploads/user/{{ Auth::user()->image }}"
                                            alt="{{ Auth::user()->name }}" />
                                    @else
                                        <img src="{{ URL::to('/') }}/uploads/no.jpeg" />
                                    @endif
                                </div>
                                <div class="comment-submit">
                                    <input type="hidden" name="video_id" value="{{ $selectedVideoInfo->id }}">

                                    <input type="text" name="comment" id="commentInputSection" class=""
                                        placeholder="Add a public comment..">

                                    <div class="comment-send text-right margin-top-10">
                                        <button type="submit" id="createComment">Comment</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                    {{-- End:: User Create Comment Section --}}

                    {{-- Start:: Show Comment --}}
                    <div class="show-comment">
                        <div class="card">
                            <div class="card-header" id="headingComments">
                                <h5 class="mb-0">
                                    <button type="button" class="btn btn-link" data-toggle="collapse"
                                        id="allCommentsBtn" data-target="#allComments" aria-expanded="true"
                                        aria-controls="allComments">
                                        {!! !$commentInfo->isEmpty() ? sizeOf($commentInfo) : 0 !!} &nbsp; Comments
                                    </button>
                                </h5>
                            </div>
                            <div id="allComments" class="collapse" aria-labelledby="headingComments"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <div class="all-comments">
                                        @if (!$commentInfo->isEmpty())
                                            @foreach ($commentInfo as $comment)
                                                <div class="row margin-top-20">
                                                    <div class="col-md-1 comment-user-img">
                                                        @if (!empty($comment->user_image))
                                                            <img src="{{ URL::to('/') }}/uploads/user/{{ $comment->user_image }}"
                                                                alt="{{ $comment->user_name }}" />
                                                        @else
                                                            <img src="{{ URL::to('/') }}/uploads/no.jpeg" />
                                                        @endif
                                                    </div>
                                                    <div class="col-md-11">
                                                        <div class="comment-user-name">
                                                            {{ $comment->user_name }}&nbsp; <span
                                                                class="white font-12">.&nbsp;{{ $comment->created_at->diffForHumans() }}</span>
                                                        </div>
                                                        <div class="comment-user">
                                                            {{ $comment->comment }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End:: Show Comment --}}
                </div>
            @endif
            {{-- End::Comment Section --}}
        </div>
    </div>