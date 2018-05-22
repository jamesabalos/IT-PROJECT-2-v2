<?php if(!empty($notification->read_at) ): ?>
    <li class='list-group-item list-group-item-success'>
        <p><b>Reorder Item:</b>  <?php echo e($notification->data['description']); ?></p>
        
        <p><b>Remaining Quantity:</b> <?php echo e($notification->data['quantity']); ?>

        </p>         
    </li>
<?php else: ?>       
    <li class='list-group-item list-group-item-danger'>
        <p><b>Reorder Item:</b>  <?php echo e($notification->data['description']); ?></p>
        
        <p><b>Remaining Quantity:</b> <?php echo e($notification->data['quantity']); ?>

        </p>                              
        <a href="/markAsRead/<?php echo e($notification->id); ?>" style="color:black;"><button >Mark As Read</button></a>
    </li>
<?php endif; ?>
