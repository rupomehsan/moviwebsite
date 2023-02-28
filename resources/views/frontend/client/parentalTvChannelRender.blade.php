<div class="video-area">
    @if ($tvInfo->stream_type == 'youtube')
        {!! $embeded !!}
    @else
        <video-js id="my_video_1" class="vjs-default-skin" controls preload="auto" height="100%">
            <source src="{!! $embeded !!}" type="application/x-mpegURL">
        </video-js>

        <script src="https://unpkg.com/video.js/dist/video.js"></script>
        <script src="https://unpkg.com/@videojs/http-streaming/dist/videojs-http-streaming.js"></script>

        <script>
            var player = videojs('my_video_1');
        </script>
    @endif

</div>
