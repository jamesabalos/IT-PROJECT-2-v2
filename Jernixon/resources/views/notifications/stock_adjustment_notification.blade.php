 <script>
 $(document).ready(function(){
    $.ajax({
            type:'Get',
            url: 'stockAjustment/getAdjustedItems',
            data: {
                'stockid': {{$notification->data['stock_id']}},
            },

            success:function(data){
                $m = "<p><b>Adjusted by: </b>"+data[0].employee_name+"</p>\
                        <p><b>Quantity: </b>"+data[0].quantity+"</p>\
                        <p><b>Type: </b>"+data[0].type+"</p>\
                        <p><b>Remarks: </b>"+data[0].remarks+"</p>";
                if(data[0].status == "Pending"){
                    $m = $m +"<button>Accept</button>";
                }else{
                    $m = $m +"<p><b>Status: </b>"+data[0].status+"</p>";
                }
                $('#stocks'+data[0].stock_adjustments_id).append($m);
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
            <div id="stocks{{$notification->data['stock_id']}}"></div>
            <a href="/markAsRead/{{$notification->id}}" style="color:black;"><button class = "btn btn-success">Mark As Read</button></a>
        </li>
@endif

