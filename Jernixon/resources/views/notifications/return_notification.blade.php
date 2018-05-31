@if(!empty($notification->read_at) )
    <li class='list-group-item list-group-item-success hidden readNotif'>
            <h6><b>Return Item:</b>  {{$notification->data['itemname']}}</h6>
            
            <h6><b>Returned by :</b> {{$notification->data['Customer']}}
            <h6><b>Type:</b> {{$notification->data['type']}}
            <h6><b>Quantity:</b> {{$notification->data['quantity']}}
            </h6>                              
        </h6>         
    </li>
@else       
        <li class='list-group-item list-group-item-danger unreadreturn'>
            <h6><b>Return Item:</b>  {{$notification->data['itemname']}}</h6>
            
            <h6><b>Returned by :</b> {{$notification->data['Customer']}}
            <h6><b>Type:</b> {{$notification->data['type']}}
            <h6><b>Quantity:</b> {{$notification->data['quantity']}}
            </h6>                              
            <a href="/markAsRead/{{$notification->id}}" style="color:black;"><button class = "btn btn-success">Mark As Read</button></a>
        </li>
@endif


