@if(!empty($notification->read_at) )
    <li class='list-group-item list-group-item-success'>
        <p><b>Item Name:</b>  {{$notification->data['itemname']}}</p>
        <p><b>Quantity:</b>  {{$notification->data['quantity']}}</p>
        <p><b>Status:</b> {{$notification->data['status']}}</p>
        <p><b>User:</b> {{$notification->data['user']}}</p>         
    </li>
@else       
    <li class='list-group-item list-group-item-danger'>
        <p><b>Item Name:</b>  {{$notification->data['itemname']}}</p>
        <p><b>Quantity:</b>  {{$notification->data['quantity']}}</p>
        <p><b>Status:</b> {{$notification->data['status']}}</p>
        <p><b>User:</b> {{$notification->data['user']}}</p>   
        <a href="/markAsRead/{{$notification->id}}" style="color:black;"><button >Mark As Read</button></a>
    </li>
@endif
