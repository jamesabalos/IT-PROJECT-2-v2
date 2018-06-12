@if(!empty($notification->read_at) )
    <li class='list-group-item list-group-item-success hidden readNotif'>
        <h6><b>Item Name:</b>  {{$notification->data['itemname']}}</h6>
        <h6><b>Adjusted By:</b>  {{$notification->data['stock_adjustedby']}}</h6>
        <h6><b>Item Quantity:</b>  {{$notification->data['stock_quantity']}}</h6>
        <h6><b>Type:</b>  {{$notification->data['stock_type']}}</h6>
        <h6><b>Remarks:</b>  {{$notification->data['stock_remarks']}}</h6>
        <div id="stocks{{$notification->data['stock_id']}}"></div>
        
        
    </li>

@else       
        <li class='list-group-item list-group-item-danger hidden unreadstock'>
            <h6><b>Item Name:</b>  {{$notification->data['itemname']}}</h6>
            <h6><b>Adjusted By:</b>  {{$notification->data['stock_adjustedby']}}</h6>
            <h6><b>Item Quantity:</b>  {{$notification->data['stock_quantity']}}</h6>
            <h6><b>Type:</b>  {{$notification->data['stock_type']}}</h6>
            <h6><b>Remarks:</b>  {{$notification->data['stock_remarks']}}</h6>
            {{-- <a href="stockAjustment/{{$notification->data['stock_id']}}">View stock adjustment</a> --}}
            {{-- {{url('stockAjustment/getAdjustedItems/'+$notification->data['stock_id'])}}admin --}}
            <a href="/markAsRead/{{$notification->id}}" id="mark{{$notification->data['stock_id']}}" style="color:black;"><button class = "btn btn-success">Mark As Read</button></a>
        </li>
@endif

