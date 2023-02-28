  <!-- banner area start -->
  @if (!$bannarInfo->isEmpty())
      <div class="hero-area container" id="home">
          <div class="">
              <div class="hero-area-slider">

                  @foreach ($bannarInfo as $data)
                      {{-- banner image --}}
                      @if ($data->banner_type === 'image')
                          <div class="row hero-area-slide hero-area-slide-image">
                              <img src="{{ URL::to('/') }}/uploads/banner/{{ $data->banner_image ?? 'no.jpeg' }}"
                                  alt="">
                          </div>
                      @endif
                      {{-- banner image --}}

                      {{-- banner video --}}
                      @if ($data->banner_type === 'video')
                          <div class="row hero-area-slide">
                              <div class="col-lg-8 col-md-12 order2">
                                  <div class="hero-area-content pr-50">

                                      {{-- title & description --}}
                                      <div class="slider-title-before"></div>
                                      <h2>{{ $data->video_title }}</h2>
                                      <div class="slider-imdb slider-title-after">
                                          <span> <i class="icofont icofont-star"></i> {!! !empty($tmdbRatingArr[$data->video_id]['vote_average']) ? $tmdbRatingArr[$data->video_id]['vote_average'] . ' TMDB' : '' !!}
                                          </span>
                                      </div> &nbsp;

                                      <div class="slider-title-after slider-title-after-break "></div> &nbsp;
                                      <div class="slider-title-after">
                                          {{ $data->hour ? $data->hour . ' Hr' : '' }}
                                          {{ $data->min ? $data->min . ' Min' : '' }}
                                          {{ $data->sec ? $data->sec . ' Sec' : '' }}
                                      </div>

                                      <p>{{ $data->video_description }}</p>
                                      {{-- title & description --}}

                                      {{-- genres --}}
                                      @if (!empty($genreArr))
                                          <ul id="primary-menu" class="slider-menu mt-30">
                                              @if (!empty($genreArr[$data->video_id]))
                                                  @foreach ($genreArr[$data->video_id] as $id => $name)
                                                      <li>
                                                          <a class="theme-btn"
                                                              href="{{ url('/video?type=genre&genre_id=' . $id) }}">
                                                              {{ $name }}
                                                          </a>
                                                      </li>
                                                  @endforeach
                                              @endif
                                          </ul>
                                      @endif
                                      {{-- genres --}}

                                      {{-- celebrities --}}
                                      @if (!empty($celibritiesArr))
                                          <div class="slide-cast">
                                              <h4 class="ptb-30">CAST & CREW</h4>

                                              @if (!$celibritiesArr[$data->video_id]->isEmpty())
                                                  <?php $count = '1'; ?>
                                                  @foreach ($celibritiesArr[$data->video_id] as $celebrity)
                                                      <div class="slide-cast-image">
                                                          @if (!empty($celebrity->image))
                                                              <img src="{{ URL::to('/') }}/uploads/celebrity/{{ $celebrity->image }}"
                                                                  alt="{{ $celebrity->name }}"
                                                                  title="{{ $celebrity->name }}" />
                                                          @else
                                                              <img src="{{ URL::to('/') }}/uploads/no.jpeg" />
                                                          @endif
                                                          <h4 class="ptb-10">{{ $celebrity->name }}</h4>
                                                      </div>

                                                      <?php
                                                      if ($count === '5') {
                                                          break;
                                                      }
                                                      $count++;
                                                      ?>
                                                  @endforeach
                                              @endif
                                          </div>
                                      @endif
                                      {{-- celebrities --}}
                                  </div>
                              </div>
                              <div class="col-lg-4 col-md-12">
                                  <div class="banner">
                                      <div id="bannerVideoImage" class="dg-container">

                                          <div class="dg-wrapper">
                                              @if (!empty($data->thumbnail))
                                                  <img src="{{ URL::to('/') }}/uploads/video/thumbnail/{{ $data->thumbnail }}"
                                                      alt="{{ $data->video_title }}"
                                                      title="{{ $data->video_title }}" />
                                              @else
                                                  <img src="{{ URL::to('/') }}/uploads/no.jpeg" />
                                              @endif

                                              @if ($data->type == 'premium')
                                                  <div class="premium-ribbon">Premium</div>
                                              @endif

                                              <a class="slider-card-action" href="/videoshow/{{ $data->video_id }}">
                                                  <i class="fa fa-play" aria-hidden="true"></i>
                                              </a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      @endif
                      {{-- banner video --}}
                  @endforeach
              </div>

          </div>
      </div>
  @endif

  <!-- Banner area end -->
