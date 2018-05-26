@if(!empty($notification->read_at) )
    <li class='list-group-item list-group-item-success'>
        <h6><b>Item Name:</b>  {{$notification->data['itemname']}}</h6>
        <h6><b>Quantity:</b>  {{$notification->data['quantity']}}</h6>
        <h6><b>Status:</b> {{$notification->data['status']}}</h6>
        <h6><b>User:</b> {{$notification->data['user']}}</h6>         
    </li>
@else       
    <li class='list-group-item list-group-item-danger'>
        <h6><b>Item Name:</b>  {{$notification->data['itemname']}}</h6>
        <h6><b>Quantity:</b>  {{$notification->data['quantity']}}</h6>
        <h6><b>Status:</b> {{$notification->data['status']}}</h6>
        <h6><b>User:</b> {{$notification->data['user']}}</h6>   
        <a href="/markAsRead/{{$notification->id}}" style="color:black;"><button class = "btn btn-success">Mark As Read</button></a>
    </li>
@endif
