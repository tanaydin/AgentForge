<?php if($response): ?>
<?php echo $response->body; ?>

<?php else: ?>
<script data-page="<?php echo e($id); ?>" type="application/json"><?php echo $pageJson; ?></script><div id="<?php echo e($id); ?>"></div>
<?php endif; ?><?php /**PATH /var/www/html/storage/framework/views/dca1a29b69452d307c2c30a7b9cc0a6e.blade.php ENDPATH**/ ?>