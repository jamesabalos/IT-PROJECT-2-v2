@if(!empty($notification->read_at) )
    <li class='list-group-item list-group-item-success'>
        <h6><b>Reorder Item:</b>  {{$notification->data['description']}}</h6>
        
        <h6><b>Remaining Quantity:</b> {{$notification->data['quantity']}}
        </h6>         
    </li>
@else       
    <li class='list-group-item list-group-item-danger'>
        <h6><b>Reorder Item:</b>  {{$notification->data['description']}}</h6>
        
        <h6><b>Remaining Quantity:</b> {{$notification->data['quantity']}}
        </h6>                              
        <a href="/markAsRead/{{$notification->id}}" style="color:black;"><button class = "btn btn-success">Mark As Read</button></a>
    </li>
@endif
