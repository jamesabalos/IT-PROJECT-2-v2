 <script>
 $(document).ready(function(){
    var notif= {{$notification->data['stock_id']}};
    $.ajax({
            type:'Get',
            url: 'stockAjustment/getAdjustedItems',
            data: {
                'stockid': notif,
            },

            success:function(data){
                $m = "<p><b>Adjusted by: </b>"+data[0].employee_name+"</p>\
                        <p><b>Quantity: </b>"+data[0].quantity+"</p>\
                        <p><b>Type: </b>"+data[0].type+"</p>\
                        <p><b>Remarks: </b>"+data[0].remarks+"</p>";
                if(data[0].status == "Pending"){
                    $m = $m +"<a href='/StockStatus/"+data[0].stock_adjustments_id+"/Accepted'>\
                            <button class = 'btn btn-success'>Accept</button></a>\
                            <a href='/StockStatus/"+data[0].stock_adjustments_id+"/Declined'>\
                            <button class = 'btn btn-danger'>Declined</button></a>";
                    $('#mark'+data[0].stock_adjustments_id).addClass('hidden');
                }else{
                    $m = $m +"<p><b>Status: </b>"+data[0].status+"</p>";
                    $('#mark'+data[0].stock_adjustments_id).removeClass('hidden');
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
            <a href="/markAsRead/{{$notification->id}}" id="mark{{$notification->data['stock_id']}}" style="color:black;"><button class = "btn btn-success">Mark As Read</button></a>
        </li>
@endif

