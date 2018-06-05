<script>
$(document).ready(function(){
    $.ajax({
            type:'Get',
            url: 'stockAjustment/getAdjustedItems',
            data: {
                'stockid': {{$notification->data['stock_id']}},
            },

            success:function(data){

            },
        })
    });

</script>
@if(!empty($notification->read_at) )
    <li class='list-group-item list-group-item-success hidden readNotif'>
        <h6><b>Item Name:</b>  {{$notification->data['itemname']}}</h6>
        
    </li>
@else       
        <li class='list-group-item list-group-item-danger hidden unreadstock'>
            <h6><b>Item Name:</b>  {{$notification->data['itemname']}}</h6>
            <div class="stockitems"></div>
            <a href="/markAsRead/{{$notification->id}}" style="color:black;"><button class = "btn btn-success">Mark As Read</button></a>
        </li>
@endif

