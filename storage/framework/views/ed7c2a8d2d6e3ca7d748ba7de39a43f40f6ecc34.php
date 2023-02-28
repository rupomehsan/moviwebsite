<?php if(!empty($videoImg->thumbnail)): ?>
    <img src="<?php echo e(URL::to('/')); ?>/uploads/video/thumbnail/<?php echo e($videoImg->thumbnail); ?>" alt="<?php echo e($videoImg->title); ?>"
        title="<?php echo e($videoImg->title); ?>" />
<?php else: ?>
    <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt="" />
<?php endif; ?>
<?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/topFeature/getVideoImage.blade.php ENDPATH**/ ?>