<?php if(!empty($notification->read_at) ): ?>
    <li class='list-group-item list-group-item-success'>
        <p><b>Item Name:</b>  <?php echo e($notification->data['itemname']); ?></p>
        <p><b>Quantity:</b>  <?php echo e($notification->data['quantity']); ?></p>
        <p><b>Status:</b> <?php echo e($notification->data['status']); ?></p>
        <p><b>User:</b> <?php echo e($notification->data['user']); ?></p>         
    </li>
<?php else: ?>       
    <li class='list-group-item list-group-item-danger'>
        <p><b>Item Name:</b>  <?php echo e($notification->data['itemname']); ?></p>
        <p><b>Quantity:</b>  <?php echo e($notification->data['quantity']); ?></p>
        <p><b>Status:</b> <?php echo e($notification->data['status']); ?></p>
        <p><b>User:</b> <?php echo e($notification->data['user']); ?></p>   
        <a href="/markAsRead/<?php echo e($notification->id); ?>" style="color:black;"><button >Mark As Read</button></a>
    </li>
<?php endif; ?>
