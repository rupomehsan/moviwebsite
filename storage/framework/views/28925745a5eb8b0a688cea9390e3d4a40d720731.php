<div class="video-area">
    <?php if($tvInfo->is_parental == 'on'): ?>
        <div class="premium-content-alert text-center">
            To Watch This Parental Content Please Do <br> <br>
            <button type="button" class="premium-content-alert-btn" data-id="<?php echo e($tvInfo->id); ?>" data-toggle="modal"
                data-target="#parentalPassword">
                Login Your Parental Password
            </button>
        </div>
    <?php else: ?>
        <?php if($tvInfo->stream_type == 'youtube'): ?>
            <?php echo $embeded; ?>

        <?php else: ?>
            <video-js id="my_video_1" class="vjs-default-skin" controls preload="auto" height="100%">
                <source src="<?php echo e($embeded); ?>" type="application/x-mpegURL">
            </video-js>
            <script src="https://unpkg.com/video.js/dist/video.js"></script>
            <script src="https://unpkg.com/@videojs/http-streaming/dist/videojs-http-streaming.js"></script>
            <script>
                var player = videojs('my_video_1');
            </script>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php /**PATH /home/tausif/Desktop/rupom/mainProject/ movieflix/resources/views/frontend/client/tvChannelRender.blade.php ENDPATH**/ ?>