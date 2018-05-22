@if(!empty($notification->read_at) )
    <li class='list-group-item list-group-item-success'>
        <p><b>Reorder Item:</b>  {{$notification->data['description']}}</p>
        
        <p><b>Remaining Quantity:</b> {{$notification->data['quantity']}}
        </p>         
    </li>
@else       
    <li class='list-group-item list-group-item-danger'>
        <p><b>Reorder Item:</b>  {{$notification->data['description']}}</p>
        
        <p><b>Remaining Quantity:</b> {{$notification->data['quantity']}}
        </p>                              
        <a href="/markAsRead/{{$notification->id}}" style="color:black;"><button >Mark As Read</button></a>
    </li>
@endif
