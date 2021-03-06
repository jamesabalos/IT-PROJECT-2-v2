@extends('layouts.navbar')
@section('returns_link')
class="active"
@endsection

@section('onload')
onload="refresh()"
@endsection

@section('linkName')
<div class="alert alert-success hidden" id="successDiv">

</div>
<h3><i class="fa fa-mail-reply" style="margin-right: 20px"></i>Returns</h3>
@endsection
{{--  @section('ng-app')
ng-app="ourAngularJsApp"
@endsection  --}}

@section('headScript')
<style>
    .autocomplete {
        /*the container must be positioned relative:*/
        position: relative;
        display: inline-block;
    }
    .searchResultDiv {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        /*position the autocomplete items to be the same width as the container:*/
        top: 100%;
        left: 0;
        right: 0;
    }
    .searchResultDiv div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff; 
        border-bottom: 1px solid #d4d4d4; 
    }
    .searchResultDiv div:hover {
        /*when hovering an item:*/
        background-color: #e9e9e9; 
    }
    .autocomplete-active {
        /*when navigating through the items using the arrow keys:*/
        background-color: DodgerBlue !important; 
        color: #ffffff; 
    }


     /* Popover */
/* .popover {
    border: 2px dotted red;
} */

/* Popover Header */
.popover-title {
    /* background-color: #73AD21;  */
    color: red; 
    /* font-size: 28px; */
    text-align:center;
}

/* Popover Body */
.popover-content {
    /* background-color: coral; */
    /* color: #FFFFFF; */
    padding: 20px;
}


/* Popover Arrow */
.arrow {
    border-right-color: red !important;
}
</style>
<!-- comment out scripts -->
{{--  <link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet"/>  --}}
{{--  <link href="{{asset('assets/css/buttons.dataTables.min.css')}}" rel="stylesheet"/>  --}}
{{--  <link href="{{asset('assets/css/jquery.dataTables.css')}}" rel="stylesheet"/ comment>  --}}
{{--  <script src="{{asset('assets/js/DataTables/dataTables.js')}}"></script comment>--}}
{{--  <script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>  --}}
{{--  <script src="{{asset('assets/js/DataTables/Buttons-1.5.1/js/buttons.html5.js')}}"></script>  --}}
{{--  <script src="{{asset('assets/js/DataTables/pdfmake-0.1.32/pdfmake.min.js')}}"></script comment>  --}}

<!--jquery-->
<script src="{{asset('assets/js/jquery-1.12.4.js')}}" type="text/javascript"></script>
{{--  plugin DataTable  --}}
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>

<link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/css/buttons.dataTables.min.css')}}" rel="stylesheet"/>
<script src="{{asset('assets/js/bbccc/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/js/jszip.min.js')}}"></script>
{{--  pdf    --}}
<script src="{{asset('assets/js/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/js/buttons.flash.min.js')}}"></script>

<script>
let today = new Date().toISOString().substr(0, 10);
        var d = new Date();
        var hours = "";
        var minutes = "";
        if( parseInt(d.getHours()) < 10  ){
            hours = "0"+d.getHours();
        }else{
            hours = d.getHours();
        }
        if( parseInt(d.getMinutes()) < 10){
            minutes = "0"+d.getMinutes();
        }else{
            minutes = d.getMinutes();
        }   
        var time=today+"T"+hours +":"+minutes;

    function removeRow(a){
        $(a.parentNode.parentNode).hide(500,function(){
            this.remove();  
        });

    }

    function addRow(divElement){
        var items =[];
        var thatTbody = $("#inExchangeTbody tr td:first-child");

        for (var i = 0; i < thatTbody.length; i++) {
            // items[i] = thatTbody[i].innerHTML;
            items[i] = thatTbody[i].childNodes[0].innerHTML;            
            // console.log(thatTbody[i].childNodes[0].value)
            // items[i] = thatTbody[i].childNodes[0].value;
        }

        if( items.indexOf(divElement.firstChild.innerHTML) == -1 ){ //if there is not yet in the table
            var thatTable = document.getElementById("inExchangeTbody");
            var newRow = thatTable.insertRow(-1);
            newRow.insertCell(-1).innerHTML = "<td><p>"+divElement.firstChild.innerHTML+"</p><input type='hidden' class='form-control' name='exchangeItemName[]' value='" +divElement.firstChild.innerHTML+ "'></td>";
            newRow.insertCell(-1).innerHTML = "<td><input type='number' name='exchangeQuantity[]' min='1' max='" +divElement.dataset.quantity+ "'class='form-control'></td>";
            newRow.insertCell(-1).innerHTML = "<td><input type='number' value='" +divElement.dataset.price+ "'class='form-control' disabled><input type='hidden'  name='price[]' min='1' value='" +divElement.dataset.price+ "'></td>";
            newRow.insertCell(-1).innerHTML = "<td><button type='button' onclick='removeRow(this)' class='btn btn-danger form-control'><i class='glyphicon glyphicon-remove'></i></button></td>";

        }

        document.getElementById("searchItemInput").value = "";
        document.getElementById("searchResultDiv").innerHTML = "";

    }
    function addSupplierRow(div){
        document.getElementById("searchSupplierResultDiv").innerHTML = "";
        var items =[];
        var thatTbody = $("#returnSupplierItemTbody tr td:first-child");
        $.ajax({
        method: 'get',
        url: "{{route('admin.getSupplierItems')}}",
        data:{
                'po_id': div.firstChild.innerHTML,
        },        
        success: function(data){
            console.log(data);
            $("#returnSupplierItemTbody tr").remove();
            var modalReturnItemTbody = document.getElementById("returnSupplierItemTbody");
            
            
                for(var i = 0; i < data.length; i++){
                        var newRow = modalReturnItemTbody.insertRow(-1);
                        document.getElementById("rspname").value = data[i].supplier_name;
                        document.getElementById("rspname2").value = data[i].supplier_name;
                        
                        newRow.insertCell(-1).innerHTML = "<td>"+data[i].description+ "</td>";
                        newRow.insertCell(-1).innerHTML = "<td>" +data[i].quantity+ "</td>";    
                        newRow.insertCell(-1).innerHTML = "<td><input class='form-control' onchange='checkQuantitySupplier(this)' oninput='inputDamageQuantityDamageSalableQuantity(this)' trigger='manual' placement='top' data-toggle='popover' title='Error' disabled id='damaged"+data[i].product_id+"' type='number' data-max='" +data[i].quantity+"' name='damaged[]' value='0' ></td>";
                        newRow.insertCell(-1).innerHTML = "<td><input class='form-control' onchange='checkQuantitySupplier(this)' oninput='inputDamageQuantityDamageSalableQuantity(this)' trigger='manual' placement='top' data-toggle='popover' title='Error' disabled id='salable"+data[i].product_id+" ' type='number' data-max='"+data[i].quantity+"' name='damagedsalable[]' value='0' ></td>";                            
                        newRow.insertCell(-1).innerHTML = "<td><input data-productId='" +data[i].product_id+ "' onchange='toggleCheckboxSupplier(this)' type='checkbox' class='form-control'><input class='form-control' type='hidden' disabled name='product_id[]' value='" +data[i].product_id+ "'><input class='form-control' type='hidden' disabled name='po_id[]' value='" +data[i].po_id+ "'><input type='hidden' name='supplierReturnTotalQuantity[]' value='0'></td>";
                    
                }

        }

        });

        // if(div.dataset.modal === "searchORNumberInput"){
            document.getElementById("searchDRreceipt").value = div.firstChild.innerHTML ;
        // }

    }

    function inputDamageUndamageDamageSaleble(input){
        var total = parseInt( $(input).closest("tr")[0].children[4].firstElementChild.value ) + parseInt($(input).closest("tr")[0].children[5].firstElementChild.value) + parseInt($(input).closest("tr")[0].children[6].firstElementChild.value)
        if( total > parseInt( $(input).closest("tr")[0].children[1].innerHTML ) ){
            $("#errorDivCreateReturns").removeClass("hidden").addClass("alert-danger text-center");
            $("#errorDivCreateReturns").html(function(){
                var addedHtml="";
                    addedHtml += "<h4>Total quantity return for "+ $(input).closest("tr")[0].children[0].innerHTML +" exceeded.</h4>";
                return addedHtml;
            });
        }else{          
            $("#errorDivCreateReturns").html("");

        }
        $(input).closest("tr")[0].children[3].children[3].setAttribute("value",total);
        

    }

    function inputDamageQuantityDamageSalableQuantity(input){
        var total = parseInt( $(input).closest("tr")[0].children[2].firstElementChild.value ) + parseInt($(input).closest("tr")[0].children[3].firstElementChild.value);
        if( total > parseInt( $(input).closest("tr")[0].children[1].innerHTML ) ){
            $("#errorDivCreateReturnsSupplier").removeClass("hidden").addClass("alert-danger text-center");
            $("#errorDivCreateReturnsSupplier").html(function(){
                var addedHtml="";
                    addedHtml += "<h4>Total quantity return for "+ $(input).closest("tr")[0].children[0].innerHTML +" exceeded.</h4>";
                return addedHtml;
            });
        }else{          
            $("#errorDivCreateReturnsSupplier").html("");

        }
        console.log( $(input).closest("tr")[0].children[4].children[3] )
        $(input).closest("tr")[0].children[4].children[3].setAttribute("value",total);
    }
    function checkQuantity(input){
        if( parseInt(input.value) > parseInt(input.dataset.max) ){
            input.setAttribute("data-content","Quantity exceeds the available stock on hand, quantity should not exceed "+input.dataset.max+"!");
            $(input).popover('show');
        }else if( parseInt(input.value) <= 0 ){
            input.setAttribute("data-content","Quantity is not sufficient!");
            $(input).popover('show');
        }else{
            $(input).popover('destroy');    
        }

        if( parseInt(document.getElementById("totalSalesDiv").firstChild.children[1].innerHTML) < 0 && parseInt(document.getElementById("discountInput").value) >= 1 ){
            $(document.getElementById("discountInput")).popover('show');
        }else{
            $(document.getElementById("discountInput")).popover('destroy');

        }
    }
    function checkQuantitySupplier(input){
        if( parseInt(input.value) > parseInt(input.dataset.max) ){
            input.setAttribute("data-content","Quantity should not exceed to "+input.dataset.max+"!");
            $(input).popover('show');
        }else if( parseInt(input.value) < 0 ){
            input.setAttribute("data-content","Quantity is not sufficient!");
            $(input).popover('show');
        }else{
            $(input).popover('destroy');    
        }

       
    }

    function checkTotalQuantityOfCheckedBox(){
        //get total quantity for every raw then check if the total Quantity == 0, if 0, then disabled save button
            var errorMessages = "";
            var status = false;
            var totalCheck = 0;
            if(document.getElementById("searchORNumberInput").value === ""){
                status = true;
                $("#errorDivCreateReturns").removeClass("hidden").addClass("alert-danger text-center");                
                document.getElementById("errorDivCreateReturns").innerHTML = "<h4>Please input the official receipt number first.</h4>";
                return status;
            }

            for(var i=0; i < $("#returnItemTbody tr").length ;i++ ){
                if( ($("#returnItemTbody tr td:nth-child(4)")[i].firstChild).checked && $("#returnItemTbody tr td:nth-child(4) :nth-child(4)")[i].value == 0 ){
                        $("#errorDivCreateReturns").removeClass("hidden").addClass("alert-danger text-center");
                        $("#errorDivCreateReturns").html(function(){
                                var addedHtml = errorMessages+"<h4>Quantity return for " + ($("#returnItemTbody tr td:nth-child(1)")[i]).innerHTML + " must be atleast 1</h4>";
                            return addedHtml;
                        });
                        errorMessages += document.getElementById("errorDivCreateReturns").innerHTML;
                        status = true;
                        return status;
                }

                if( !(($("#returnItemTbody tr td:nth-child(4)")[i].firstChild).checked) ) {
                    totalCheck++;
                }

                if(totalCheck == $("#returnItemTbody tr").length ){
                    status = true;
                    $("#errorDivCreateReturns").removeClass("hidden").addClass("alert-danger text-center");                
                    document.getElementById("errorDivCreateReturns").innerHTML = "<h4>Check an item to be return.</h4>";   
                    return status;
                }
            }
            
            // for(var i=0; i < $("#returnItemTbody tr").length ;i++ ){            
            //     if( !(($("#returnItemTbody tr td:nth-child(4)")[i].firstChild).checked) ){
            //         status = true;
            //         $("#errorDivCreateReturns").removeClass("hidden").addClass("alert-danger text-center");                
            //         document.getElementById("errorDivCreateReturns").innerHTML = "<h4>Check an item to be return.</h4>";
            //     return status;
            //     }
            // }

    }
    function checkTotalQuantityOfCheckedBoxSupplier(){
        //get total quantity for every raw then check if the total Quantity == 0, if 0, then disabled save button
            var errorMessages = "";
            var status = false;
            var totalCheck = 0;
            if(document.getElementById("searchDRreceipt").value === ""){
                status = true;
                $("#errorDivCreateReturnsSupplier").removeClass("hidden").addClass("alert-danger text-center");                
                document.getElementById("errorDivCreateReturnsSupplier").innerHTML = "<h4>Please input the delivery receipt number first.</h4>";
                return status;
            }

            for(var i=0; i < $("#returnSupplierItemTbody tr").length ;i++ ){
                //if first row's checkbox is checked and its  4th child element's value == 0
                if( ($("#returnSupplierItemTbody tr td:nth-child(5)")[i].firstChild).checked && ($("#returnSupplierItemTbody tr td:nth-child(5) :nth-child(4)")[i]).value == 0 ){
                        $("#errorDivCreateReturnsSupplier").removeClass("hidden").addClass("alert-danger text-center");
                        $("#errorDivCreateReturnsSupplier").html(function(){
                            var addedHtml = errorMessages+"<h4>Quantity return for " + ($("#returnSupplierItemTbody tr td:nth-child(1)")[i]).innerHTML + " must be atleast 1</h4>";
                            return addedHtml;
                        });
                        errorMessages += document.getElementById("errorDivCreateReturnsSupplier").innerHTML;
                        status = true;
                        return status;
                }

                if( !(($("#returnSupplierItemTbody tr td:nth-child(5)")[i].firstChild).checked) ) {
                    totalCheck++;
                }

                if( ($("#returnSupplierItemTbody tr td:nth-child(5) :nth-child(4)")[i]).value > parseInt( ($("#returnSupplierItemTbody tr td:nth-child(2)")[i]).innerHTML) ){
                    status = true;
                    $("#errorDivCreateReturnsSupplier").removeClass("hidden").addClass("alert-danger text-center");                
                    document.getElementById("errorDivCreateReturnsSupplier").innerHTML = "<h4>Total quantity return for " +($("#returnSupplierItemTbody tr td:nth-child(1)")[i]).innerHTML+ " exceeded.</h4>";   
                    return status;
                }

                if(totalCheck == $("#returnSupplierItemTbody tr").length ){
                    status = true;
                    $("#errorDivCreateReturnsSupplier").removeClass("hidden").addClass("alert-danger text-center");                
                    document.getElementById("errorDivCreateReturnsSupplier").innerHTML = "<h4>Check an item to be return.</h4>";   
                    return status;
                }
            }
            
    }
        
    function addReturnItem(div){
        var items =[];
        var thatTbody = $("#returnItemTbody tr td:first-child");
        
         $.ajax({
            method: 'get',
            url: "{{route('admin.getORNumberItems')}}",
            data:{
                 'ORNumber': div.firstChild.innerHTML,
            },        
            success: function(data){
                console.log(data)
                $("#returnItemTbody tr").remove();
                $("#refundTbody tr").remove();
                var modalReturnItemTbody = document.getElementById("returnItemTbody");
                var modalRefundTbody = document.getElementById("refundTbody");
                var today = new Date().toISOString().substr(0, 10);
                if(data[0].warranty == null){
                    var remainingDays = "No warranty";                    
                }else{
                    var timeDiff = Math.abs( (new Date(data[0].warranty)).getTime() - (new Date(data[0].created_at)).getTime());
                    var remainingDaysTemp = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
                    console.log(remainingDaysTemp)
                    var remainingDays = "";
                    if(remainingDaysTemp <= 0){
                        remainingDays = "0";
                    }else{
                        remainingDays = remainingDaysTemp;
                    }
                }
                // if( 7-parseInt(diffDays) <= 0 ){
                //     document.getElementById("remainingWarrantyDays").value = "0";
                // }else{
                //     document.getElementById("remainingWarrantyDays").value = 7-parseInt(remainingDays);
                // }
                for(var i = 0; i < data.length; i++){
                        var newRow = modalReturnItemTbody.insertRow(-1);
                        newRow.insertCell(-1).innerHTML = "<td>" +data[i].description+ "</td>";
                        newRow.insertCell(-1).innerHTML = "<td>" +data[i].quantity+ "</td>";//<input type='number' class='form-control' value='" +data[i].quantity+ "' max='" +data[i].quantity+ "' min='1' disabled>
                        newRow.insertCell(-1).innerHTML = "<td>" +data[i].price+ "</td>";
                        newRow.insertCell(-1).innerHTML = "<td><input data-productId='" +data[i].product_id+ "' onchange='toggleCheckboxRefund(this)' type='checkbox' class='form-control'><input type='hidden' disabled name='productId[]' value='" +data[i].product_id+  "'><input type='hidden' disabled name='price[]' value='" +data[i].price+ "'><input type='hidden' name='totalQuantity[]' value='0' disabled></td>";
                        // newRow.insertCell(-1).innerHTML = "<td><select class='form-control' name='status[]' style='width:100px'> <option class='form-control' value='damaged'>DAMAGED</option><option class='form-control' value='undamaged'>UNDAMAGED</option></select></td>";
                        newRow.insertCell(-1).innerHTML = "<td><input type='number' name='quantityDamage[]' oninput='inputDamageUndamageDamageSaleble(this)' disabled min='0' value='0'  data-max='" +data[i].quantity+ "'></td>";
                        newRow.insertCell(-1).innerHTML = "<td><input type='number' name='quantityUndamage[]' oninput='inputDamageUndamageDamageSaleble(this)' disabled min='0'  value='0' data-max='" +data[i].quantity+ "'></td>";
                        newRow.insertCell(-1).innerHTML = "<td><input type='number' name='quantityDamageSalable[]' oninput='inputDamageUndamageDamageSaleble(this)' disabled min='0'  value='0' data-max='" +data[i].quantity+ "'></td>";
                        newRow.insertCell(-1).innerHTML = "<td>" +remainingDays+ "</td>";
                        

                }

                // {{-- document.getElementById("Customer").value = data[0].customer_name; --}}
                document.getElementById("returnCustomerName").value = data[0].customer_name;
                document.getElementById("ORdate").value = data[0].created_at;

            }
            });

        if(div.dataset.modal === "searchORNumberInput"){
            document.getElementById("searchORNumberInput").value = div.firstChild.innerHTML ;
            document.getElementById("resultORNumberDiv").innerHTML = "";
        }else{
            document.getElementById("refundSearchORNumberInput").value = div.firstChild.innerHTML ;
            document.getElementById("refundORNumberDiv").innerHTML = "";
        }

    }
    
    function toggleCheckbox(button){
        var data  = $(button.parentNode.parentNode.innerHTML).slice(0,-1);
        var itemName = data[0].innerHTML;
        var itemsInExchangeTable = $("#inExchangeTbody tr td:first-child");
        var exchangeTable = document.getElementById("inExchangeTbody");
        
        if(button.checked){
            // var newRow = exchangeTable.insertRow(-1);
            // newRow.insertCell(-1).innerHTML = "<td><input type='hidden' name='productId[]' value='" +button.getAttribute("data-productId")+ "'>" +data[0].innerHTML+ "</td>";
            // newRow.insertCell(-1).innerHTML = "<td><input type='number' name='quantity[]' class='form-control' value='" +data[1].innerHTML+ "' max='" +data[1].innerHTML+ "' min='1'></td>";
            // newRow.insertCell(-1).innerHTML = "<td><input type='hidden' name='price[]' value='" +data[2].innerHTML+ "'>" +data[2].innerHTML+ "</td>";
            // button.parentNode.previousSibling.previousSibling.childNodes[0].removeAttribute("disabled");
            button.nextElementSibling.removeAttribute("disabled");

        }else{
            // for(var i = 0; i < itemsInExchangeTable.length; i++){
            //     if(itemsInExchangeTable[i].outerText === itemName){

            //         document.getElementById("inEchangeTable").deleteRow(i+1);
            //     }
            // }
            button.nextElementSibling.setAttribute("disabled",true);

        }
    }

    function toggleCheckboxRefund(button){
        if(button.checked){        
            button.nextElementSibling.removeAttribute("disabled");            
            button.nextElementSibling.nextElementSibling.removeAttribute("disabled");
            button.nextElementSibling.nextElementSibling.nextElementSibling.removeAttribute("disabled");
            button.parentNode.nextElementSibling.firstElementChild.removeAttribute("disabled");
            button.parentNode.nextElementSibling.nextElementSibling.firstElementChild.removeAttribute("disabled");
            button.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.firstElementChild.removeAttribute("disabled");
        }else{
            button.parentNode.nextElementSibling.firstElementChild.setAttribute("max",12);
            button.parentNode.nextElementSibling.nextElementSibling.firstElementChild.setAttribute("max",12);
            button.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.firstElementChild.setAttribute("max",12);
            button.nextElementSibling.setAttribute("disabled",true);                      
            button.nextElementSibling.nextElementSibling.setAttribute("disabled",true);
            button.nextElementSibling.nextElementSibling.nextElementSibling.setAttribute("disabled",true);
            button.parentNode.nextElementSibling.firstElementChild.setAttribute("disabled",true);
            button.parentNode.nextElementSibling.nextElementSibling.firstElementChild.setAttribute("disabled",true);
            button.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.firstElementChild.setAttribute("disabled",true);

        }
    }
    function toggleCheckboxSupplier(button){
        if(button.checked){        
            button.parentNode.previousElementSibling.firstChild.removeAttribute("disabled");            
            button.parentNode.previousElementSibling.previousElementSibling.firstChild.removeAttribute("disabled");
            button.nextElementSibling.removeAttribute("disabled");

            //button.nextElementSibling.nextElementSibling.nextElementSibling.removeAttribute("disabled");
            //button.parentNode.nextElementSibling.firstElementChild.removeAttribute("disabled");
            //button.parentNode.nextElementSibling.nextElementSibling.firstElementChild.removeAttribute("disabled");
            //button.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.firstElementChild.removeAttribute("disabled");
        }else{
            //button.parentNode.nextElementSibling.firstElementChild.setAttribute("max",12);
            //button.parentNode.nextElementSibling.nextElementSibling.firstElementChild.setAttribute("max",12);
            //button.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.firstElementChild.setAttribute("max",12);
            //button.nextElementSibling.setAttribute("disabled",true);                      
           // button.nextElementSibling.nextElementSibling.setAttribute("disabled",true);
            //button.nextElementSibling.nextElementSibling.nextElementSibling.setAttribute("disabled",true);
            //button.parentNode.nextElementSibling.firstElementChild.setAttribute("disabled",true);
            button.parentNode.previousElementSibling.firstChild.setAttribute("disabled",true);
            button.parentNode.previousElementSibling.previousElementSibling.firstChild.setAttribute("disabled",true);
            button.nextElementSibling.setAttribute("disabled",true);
            

        }
    }

    function searchItem(a){
        if(a.value === ""){
            document.getElementById("searchResultDiv").innerHTML ="";   
        }else{
            $.ajax({
                method: 'get',
                //url: 'items/' + document.getElementById("inputItem").value,
                url: 'searchItem/' + a.value,
                dataType: "json",
                success: function(data){
                    // <div>
                    //     <strong>Phi</strong>lippines
                    //     <input type="hidden" value="Philippines">
                    // </div>

                    var resultDiv = document.getElementById("searchResultDiv");
                    resultDiv.innerHTML = "";
                    for (var i = 0;  i< data.length; i++) {
                        var node = document.createElement("DIV");
                        // node.setAttribute("onclick","addRow(this.firstChild.innerHTML)")
                        node.setAttribute("onclick","addRow(this)")
                        node.setAttribute("data-quantity",data[i].quantity)
                        node.setAttribute("data-price",data[i].retail_price)
                        var pElement = document.createElement("P");
                        //add the price
                        //pElement.setAttribute("data-price" , data[i].) 
                        var textNode = document.createTextNode(data[i].description);
                        pElement.appendChild(textNode);
                        node.appendChild(pElement);          
                        resultDiv.appendChild(node);  

                    }
                }
            });

        }

    }
      
    function searchOfficialReceipt(a){
        document.getElementById("errorDivCreateReturns").innerHTML= "";
		var officialReceipt = a.value;
		var fullRoute = "/admin/returns/getORNumber/"+officialReceipt;
        if(a.value === ""){
            document.getElementById("resultORNumberDiv").innerHTML ="";
            $("#returnItemTbody tr").remove();
        }else{
            $.ajax({
                method: 'get',
                //url: 'items/' + document.getElementById("inputItem").value,
                url: fullRoute,
                
                success: function(data){
                    var resultORNumberDiv = document.getElementById("resultORNumberDiv");
                    resultORNumberDiv.innerHTML = "";

                    for (var i = 0;  i< data.length; i++) {
                        var node = document.createElement("DIV");
                        node.setAttribute("onclick","addReturnItem(this)")
                        node.setAttribute("data-modal",a.id)
                        var pElement = document.createElement("P");
                        //add the price
                        //pElement.setAttribute("data-price" , data[i].) 
                        var textNode = document.createTextNode(data[i].or_number);
                        pElement.appendChild(textNode);
                        node.appendChild(pElement);    
                        // if(a.id === "searchORNumberInput"){
                            resultORNumberDiv.appendChild(node);  
                        // }else{
                        //     refundORNumberDiv.appendChild(node);  
                        // }
                    }
                    console.log(data)  
                }
            });

        }
        
    }
function searchSupplier(a){
    if(a.value === ""){
        document.getElementById("searchSupplierResultDiv").innerHTML ="";   
    }
    $.ajax({
        method: 'get',
        //url: 'items/' + document.getElementById("inputItem").value,
        url: 'searchSupplier/' + a.value,
        dataType: "json",
        success: function(data){
            var resultDiv = document.getElementById("searchSupplierResultDiv");
            resultDiv.innerHTML = "";
            for (var i = 0;  i< data.length; i++) {
                var node = document.createElement("DIV");
                node.setAttribute("id",data[i].po_id)
              //   node.setAttribute("data-quantity",data[i].)
                node.setAttribute("onclick","addSupplierRow(this)")
                node.setAttribute("data-supplier",data[i].supplier_name)
                var pElement = document.createElement("P");
                var textNode = document.createTextNode(data[i].po_id);
                pElement.appendChild(textNode);
                node.appendChild(pElement);          
                resultDiv.appendChild(node);  

            }
        }
    });

}    	
	function getItems(button){
		
		var ORnumber = button.parentNode.parentNode.parentNode.firstChild.innerHTML;
		var date = button.parentNode.parentNode.parentNode.childNodes[1].innerHTML;
		// console.log(itemId);
		// var fullRoute = "/admin/returns/getReturnedItems/"+ORnumber;
		$.ajax({
			type:'GET',
			url: "{{route('admin.getReturnedItems')}}",
            data: {
                'ORNumber': ORnumber,
            },

			success:function(data){
                console.log(data)        
                $("#veiwReturnedItemTbody tr").remove();
                var returnedItemTable = document.getElementById("veiwReturnedItemTbody");
                for(var i = 0; i < data.length; i++){
                    var newRow = returnedItemTable.insertRow(-1);
                    // newRow.insertCell(-1).innerHTML = "<td>" +data[i].quantity+ "</td>";
                    // newRow.insertCell(-1).innerHTML = "<td>" +data[i].unit+ "</td>";
                    newRow.insertCell(-1).innerHTML = "<td>" +data[i].description+ "</td>";
                    newRow.insertCell(-1).innerHTML = "<td>" +data[i].price+ "</td>";
                    // newRow.insertCell(-1).innerHTML = "<td>" +data[i].price+ "</td>";
                    newRow.insertCell(-1).innerHTML = "<td>" +data[i].damagedQuantity + "</td>";
                    newRow.insertCell(-1).innerHTML = "<td>" +data[i].undamagedQuantity+ "</td>";
                    newRow.insertCell(-1).innerHTML = "<td>" +data[i].damagedSalableQuantity+ "</td>";
                    

                }

                document.getElementById("rDate").innerHTML= data[0].created_at;
                document.getElementById("address").innerHTML= data[0].address;
                document.getElementById("returnedORNumber").innerHTML = ORnumber;
                document.getElementById("customerName").innerHTML = data[0].customer_name;
                // {{-- document.getElementById("warrantyDay").value = data[0].created_at; --}}

			}
		});
         $.ajax({
            type:'GET',
            url: "{{route('admin.getReturnedItemsExchanged')}}",
            data: {
                'ORNumber': ORnumber,
            },
            success:function(data){
                var exchangeTbody = document.getElementById("veiwExchangedItemTbody");
                $("#veiwExchangedItemTbody tr").remove();
                for(var i = 0; i <data.length; i++){
                    var newRow = exchangeTbody.insertRow(-1);
                    newRow.insertCell(-1).innerHTML = "<td>" +data[i].quantity+ "</td>";
                    newRow.insertCell(-1).innerHTML = "<td>" +data[i].unit+ "</td>";
                    newRow.insertCell(-1).innerHTML = "<td>" +data[i].description+ "</td>";
                    newRow.insertCell(-1).innerHTML = "<td>" +data[i].price+ "</td>";
                    newRow.insertCell(-1).innerHTML = "<td>" +data[i].price*data[i].quantity+ "</td>";
                }
            },
            error:function(data){

            }
        });

	
	}
    function removeRowInSupplierExchangedItem(button){
        
        var exchangeItemTbody = document.getElementById("veiwReturnedItemTbody2");
        var exchangeItemTbodyRows = $("#veiwReturnedItemTbody2 tr td:first-child");
        for(var i = 0; i < exchangeItemTbody.rows.length; i++ ){
            // console.log("compare: "+exchangeItemTbodyRows[i].innerHTML + " to "+ button.parentNode.parentNode.childNodes[0].children[5].innerHTML)
            // console.log( exchangeItemTbodyRows[i].innerHTML === button.parentNode.parentNode.childNodes[0].children[5].innerHTML )
            if( (exchangeItemTbodyRows[i].innerHTML) === button.parentNode.parentNode.childNodes[0].children[5].innerHTML ){
                exchangeItemTbodyRows[i].parentNode.childNodes[3].innerHTML = button.dataset.buttontemp;
                   $(button.parentNode.parentNode).hide(500,function(){
                        this.remove();  
                    });
            }
        }
        // document.getElementById("saveSupplierExchangeItemButton").setAttribute("disabled",true)
    }
    function computeAmount(input){
        input.parentNode.parentNode.childNodes[5].firstChild.value = (parseInt( input.value )+parseInt(input.parentNode.nextElementSibling.firstChild.value))*parseInt(input.dataset.unitprice);
        if( parseInt(input.value) > parseInt(input.dataset.max) ){
            input.setAttribute("data-content","Damage quantity exceeded.");
            $(input).popover('show');
        }else if( parseInt(input.value) < 0 ){
            input.setAttribute("data-content","Quantity is not sufficient!");
            $(input).popover('show');
        }else{
            $(input).popover('destroy');    
        }
    }
    function computeAmount2(input){
        input.parentNode.parentNode.childNodes[5].firstChild.value = (parseInt( input.value )+parseInt(input.parentNode.previousElementSibling.firstChild.value))*parseInt(input.dataset.unitprice);
        if( parseInt(input.value) > parseInt(input.dataset.max) ){
            input.setAttribute("data-content","Damage salable quantity exceeded.");
            $(input).popover('show');
        }else if( parseInt(input.value) < 0 ){
            input.setAttribute("data-content","Quantity is not sufficient!");
            $(input).popover('show');
        }else{
            $(input).popover('destroy');    
        }
    }
    function Accept(button){
        // $(event).closest("tr").remove();
        var tbody = document.getElementById("supplierExchangeTbody");   
        var newRow = tbody.insertRow(-1);
        newRow.insertCell(-1).innerHTML = "<td><input type='hidden' class='form-control' name='productid[]' value="+button.dataset.product_id+"><input type='hidden' class='form-control' name='returnsid[]' value="+button.dataset.returnsid+"><input type='hidden' class='form-control' name='Supplier' value="+button.dataset.suppname+"><input type='hidden' class='form-control' name='id[]' value="+button.dataset.id+"><input type='hidden' class='form-control' name='unitprice[]' value="+button.dataset.unitprice+"><p>" +button.dataset.description+ "</p></td>";
        newRow.insertCell(-1).innerHTML = "<td><input trigger='manual' placement='top' data-toggle='popover' title='Error' data-content='Exceeded' onchange='computeAmount(this)' class='form-control' value='0' data-unitprice='"+button.dataset.unitprice+"' type='number' data-max='"+button.dataset.damaged_qty+"' name='damagedQuantityAccepted[]'></td>";
        newRow.insertCell(-1).innerHTML = "<td><input trigger='manual' placement='top' data-toggle='popover' title='Error' data-content='Exceeded' onchange='computeAmount2(this)' class='form-control' value='0' data-unitprice='"+button.dataset.unitprice+"' type='number' data-max='"+button.dataset.damagedsal_qty+"' name='damagedSalableAccepted[]'></td>";
        newRow.insertCell(-1).innerHTML = "<td><select class='form-control' name='unit[]' > <option class='form-control'  value='pcs'>Pcs</option><option class='form-control'  value='sets'>Sets</option></select>"+ "</td>";
        newRow.insertCell(-1).innerHTML = "<td>"+button.dataset.unitprice+ "</td>";
        newRow.insertCell(-1).innerHTML = "<td><input type='number' class='form-control' disabled name='amount[]'></td>";
        newRow.insertCell(-1).innerHTML = "<td><button type='button' data-buttontemp='"+button.parentNode.parentNode.outerHTML+"' data-returnsid='"+button.dataset.returnsid+"' onclick='removeRowInSupplierExchangedItem(this)' class='btn btn-danger form-control'><i class='glyphicon glyphicon-remove'></i></button></td>";
    
        $id =  button.dataset.id;
        document.getElementById('stat'+$id).innerHTML = "Accepted";
        // document.getElementById("saveSupplierExchangeItemButton").removeAttribute("disabled")

    }
    function undoRejected(button){
        button.parentNode.innerHTML = button.dataset.buttontemp;

    }
    function Rejected(button){
        $id = button.dataset.id;
        document.getElementById('saveSupplierExchangeItemButton').removeAttribute('disabled');
        document.getElementById('stat'+$id).innerHTML = "<p>Rejected</p><button type='button' data-buttontemp='"+button.parentNode.outerHTML+"' onclick='undoRejected(this)'>undo</button><input type='hidden' name='rejectedId[]' value='" +button.dataset.id+ "'><input type='hidden' name='rejected_returnsid[]' value='" +button.dataset.returnsid+ "'>";

    }
     
	 function getItems2(button){
         
        $("#supplierExchangeTbody tr").remove(); 
        // document.getElementById("saveSupplierExchangeItemButton").setAttribute("disabled",true)
                
		var rowId = button.dataset.id;
	 	$.ajax({
	 		type:'GET',
	 		url: "{{route('admin.getSupplierReturnedItems')}}",
             data: {
                 'return_supplier_id':rowId,
             },
     		success:function(data){
                 $("#veiwReturnedItemTbody2 tr").remove();
                 var returnedItemTable = document.getElementById("veiwReturnedItemTbody2");
                 document.getElementById("returnedSupplierName").innerHTML = data[0].supplier_name;
                 document.getElementById("supplierViewDate").innerHTML = data[0].created_at;
                 document.getElementById('returneddrNumber').innerHTML = data[0].po_id;
                 for(var i = 0; i < data.length; i++){
                     var newRow = returnedItemTable.insertRow(-1);
                     newRow.insertCell(-1).innerHTML = "<td>" +data[i].description+ "</td>";
                     newRow.insertCell(-1).innerHTML = "<td>" +data[i].damagedQty_return + "</td>";
                     newRow.insertCell(-1).innerHTML = "<td>" +data[i].damaged_salableQty_return + "</td>";

                     if(data[i].return_status == "Pending"){
                    newRow.insertCell(-1).innerHTML = "<td><div class='text-center'>\
                    <div id='stat"+data[i].return_supplier_id+"'> <input type='hidden' id='status"+data[i].return_supplier_id+"'> <button class='controll btn btn-success' id='accept"+data[i].return_supplier_id+"' data-id='"+data[i].return_supplier_id+"' data-suppname ='"+data[i].supplier_name+"'  data-damagedsal_qty='"+data[i].damaged_salableQty_return+"' data-product_id='"+data[i].product_id+"'\
                    data-description='"+data[i].description+"' data-unitPrice = '"+data[i].wholesale_price+"' data-returnsid = '"+data[i].returns_s_id+"' data-damaged_qty='"+data[i].damagedQty_return +"' onclick='Accept(this)' value='Accepted'>Accept</button>\
                    <button class='controll btn btn-danger' data-returnsid='"+data[i].returns_s_id+"' data-id='"+data[i].return_supplier_id+"' value='Rejected' onclick='Rejected(this)' >Reject</button></div></td>";
                     }else{
                          newRow.insertCell(-1).innerHTML = "<td>"+data[i].return_status+"</td>";
                     }
                     
                 }
                 $.ajax({
                        type:'GET',
                        url: "{{route('admin.getSupplierReturnedItems2')}}",
                        data: {
                            'return_s_id':data[0].returns_s_id,
                        },
                        success:function(data){
                            console.log(data);
                            if(!$.trim(data)){
                                console.log('no data');
                                
                                document.getElementById("returned_date").removeAttribute('disabled');
                                
                                $("#supplierExchangeTBody3 tr").remove();
                                document.getElementById('hid').removeAttribute('class','hidden');
                                document.getElementById('saveSupplierExchangeItemButton').setAttribute('class','btn btn-success');
                                document.getElementById('table1').setAttribute('class','table table-bordered table-striped');
                                document.getElementById('table2').setAttribute('class','hidden');
                            }else{
                                console.log('not here');
                                 $("#supplierExchangeTBody3 tr").remove();
                                var returnedItemTable2 = document.getElementById("supplierExchangeTBody3");
                                if(data[0].status == "Pending"){
                                    document.getElementById('hid').removeAttribute('class','hidden');
                                    document.getElementById('saveSupplierExchangeItemButton').setAttribute('class','btn btn-success');
                                    document.getElementById('table1').setAttribute('class','table table-bordered table-striped');
                                }else{
                                    document.getElementById('hid').setAttribute('class','hidden');
                                    document.getElementById('table2').setAttribute('class','table table-bordered table-striped');
                                    document.getElementById('saveSupplierExchangeItemButton').setAttribute('class','hidden');
                                    document.getElementById('table1').setAttribute('class','hidden');
                                }
                                
                                
                                for(var i = 0; i < data.length; i++){
                                    var newRow2 = returnedItemTable2.insertRow(-1);
                                    
                                    newRow2.insertCell(-1).innerHTML = "<td>" +data[i].created_at2+ "</td>";
                                    newRow2.insertCell(-1).innerHTML = "<td>" +data[i].returned_po_id+ "</td>";
                                    newRow2.insertCell(-1).innerHTML = "<td>" +data[i].description+ "</td>";
                                    newRow2.insertCell(-1).innerHTML = "<td>" +data[i].damaged_item_accepted + "</td>";
                                    newRow2.insertCell(-1).innerHTML = "<td>" +data[i].damaged_salable_accepted + "</td>";    
                                    newRow2.insertCell(-1).innerHTML = "<td><div class = 'text-center'>"+ data[i].unit + "</div></td>";
                                    newRow2.insertCell(-1).innerHTML = "<td><div class = 'text-center'>"+ data[i].price + "</div></td>";
                                    newRow2.insertCell(-1).innerHTML = "<td><div class = 'text-center'>"+ data[i].amount + "</div></td>";


                                }
                            }
                           
                            
                            
                        }
                    });
                 
                 
     		}
	 	});

     }
      function getItems3(button){
		var rowId = button.dataset.id;
	 	$.ajax({
	 		type:'GET',
	 		url: "{{route('admin.getSupplierReturnedItems2')}}",
             data: {
                 'return_s_id':rowId,
             },
     		success:function(data){
                 console.log(data);
                 $("#veiwReturnedItemTbody3 tr").remove();
                 $("#supplierExchangeTBody3 tr").remove();
                 var returnedItemTable = document.getElementById("veiwReturnedItemTbody3");
                 var returnedItemTable2 = document.getElementById("supplierExchangeTBody3");
                 
                 document.getElementById("returnedSname").innerHTML = data[0].supplier_name;
                 document.getElementById("supplierVDate").innerHTML = data[0].created_at;
                 document.getElementById('returnedDRNo').innerHTML = data[0].po_id;
                 
                 document.getElementById('rsDR').innerHTML = data[0].returned_po_id;
                 document.getElementById('returned_sdate').innerHTML = data[0].created_at2;
                 
                 
                 for(var i = 0; i < data.length; i++){
                     var newRow = returnedItemTable.insertRow(-1);
                     newRow.insertCell(-1).innerHTML = "<td>" +data[i].description+ "</td>";
                     newRow.insertCell(-1).innerHTML = "<td>" +data[i].damagedQty_return + "</td>";
                     newRow.insertCell(-1).innerHTML = "<td>" +data[i].damaged_salableQty_return + "</td>";    
                     newRow.insertCell(-1).innerHTML = "<td><div class = 'text-center'>"+ data[i].return_status + "</div></td>";
                     
                     var newRow2 = returnedItemTable2.insertRow(-1);
                    newRow2.insertCell(-1).innerHTML = "<td>" +data[i].description+ "</td>";
                     newRow2.insertCell(-1).innerHTML = "<td>" +data[i].damaged_item_accepted + "</td>";
                     newRow2.insertCell(-1).innerHTML = "<td>" +data[i].damaged_salable_accepted + "</td>";    
                     newRow2.insertCell(-1).innerHTML = "<td><div class = 'text-center'>"+ data[i].unit + "</div></td>";
                     newRow2.insertCell(-1).innerHTML = "<td><div class = 'text-center'>"+ data[i].price + "</div></td>";
                     newRow2.insertCell(-1).innerHTML = "<td><div class = 'text-center'>"+ data[i].amount + "</div></td>";


                 }
                 
                 
     		}
	 	});

     }
    function createReport(button){
        // var dateFrom = document.getElementById("from").value;
        // var dateTo = document.getElementById("to").value;
        var crsr = button.id;
        var dateFrom = button.parentNode.children[1].value;
        var dateTo = button.parentNode.children[3].value;
        var newDateFrom = new Date(dateFrom);
        newDateFrom.setDate(newDateFrom.getDate() - 1);
        
        var ddf = newDateFrom.getDate();
        var mmf = newDateFrom.getMonth() + 1;
        var yf = newDateFrom.getFullYear();

        var newDateTo = new Date(dateTo);
        newDateTo.setDate(newDateTo.getDate() + 1);

        var ddt = newDateTo.getDate();
        var mmt = newDateTo.getMonth() + 1;
        var yt = newDateTo.getFullYear();

        var formattedDateFrom = yf + '-' + mmf + '-' + ddf;
        var formattedDateTo = yt + '-' + mmt + '-' + ddt;
        console.log(formattedDateFrom);
        console.log(formattedDateTo);
        $.ajax({
            type:'GET',
            url: "{{route('reports.validateDateRange')}}",
            data: {
                'dateFrom':dateFrom,
                'dateTo':dateTo
            },
            success:function(data){
                // $(button.parentNode.parentNode.previousElementSibling).html("");    
                $("#errorDateRangeReport").html("");   
                if(crsr == "cr"){
                $('#returnsDataTable').DataTable({
                    "destroy": true,
                    "processing": true,
                    "serverSide": true,
                    "colReorder": true,  
                    //"autoWidth": true,
                    "pagingType": "full_numbers",
                    "ajax":  {
                                "url": "{{ route('returns.createReturnsFilter') }}",
                                "data":{
                                    "dateFrom":formattedDateFrom,
                                    "dateTo":formattedDateTo
                                }
                            },
                    "columns": [
                        {data: 'or_number'},
                        //   {data: 'price'},
                        {data: 'created_at'},
                        {data: 'action'},
                    ]
                });
        }
                            

            },
            error:function(data){
                var response = data.responseJSON;
                $("#errorDateRangeReport").hide(500);
                $("#errorDateRangeReport").removeClass("hidden");
                $("#errorDateRangeReport").slideDown("slow", function() {
                    $("#errorDateRangeReport").html(function(){
                          var addedHtml="";
                          for (var key in response.errors) {
                              addedHtml += "<p>"+response.errors[key]+"</p>";
                          }
                          return addedHtml;
                      });                  
                });
                
                // $("#errorDivReport").removeClass("hidden").addClass("alert-danger text-center");
                // $("#errorDivReport").html(function(){
                //           var addedHtml="";
                //           for (var key in response.errors) {
                //               addedHtml += "<p>"+response.errors[key]+"</p>";
                //           }
                //           return addedHtml;
                //       });
            }
        });
    }

    document.addEventListener("click", function (e) {
        document.getElementById("searchResultDiv").innerHTML = "";
    });

    $(document).ready(function(){
        if(localStorage.getItem('success') == 'Successful'){
            $("#successDiv p").remove();    
            $("#successDiv").removeClass("hidden")
                    .html("<h3>"+localStorage.getItem('message')+"</h3>");
            $("#successDiv").css("display:block");                             
            $("#successDiv").slideDown("slow")
                .delay(1000)                        
                .hide(1500);
            localStorage.removeItem('success');
            localStorage.removeItem('message');
        }

        document.querySelector("#today").value = today+"T"+hours +":"+minutes;
        document.querySelector("#suppliertoday").value = today+"T"+hours +":"+minutes;
        document.querySelector("#returned_date").value = today+"T"+hours +":"+minutes;

        var t = setInterval(function(){
            var d = new Date();
            var hours = "";
            var minutes = "";
            if( parseInt(d.getHours()) < 10  ){
                hours = "0"+d.getHours();
            }else{
                hours = d.getHours();
            }
            if( parseInt(d.getMinutes()) < 10){
                minutes = "0"+d.getMinutes();
            }else{
                minutes = d.getMinutes();
            }
            document.querySelector("#today").value = today+"T"+hours +":"+minutes;
        },60000)

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('#supplierexchange').on('submit',function(e){
            e.preventDefault();
                var data = $(this).serialize();  
            var arrayOfData = $(this).serializeArray();    
             console.log(arrayOfData)  
             //return true;    
                $.ajax({
                    type:'POST',
                    url: "{{route('admin.supplierExchange')}}",

                    data:arrayOfData,
                    success:function(data){
                        console.log(data);
                        if($.trim(data) == 'successful'){ 
                            $("#errorDivCreatePurchase").html("");
                            localStorage.setItem('message','Returned Items are settled');
                            localStorage.setItem('success','Successful');
                            location.reload(true);
                        }else{
                            $("#errorDivCreateSupplierReturns").removeClass("hidden").addClass("alert-danger text-center");
                            $("#errorDivCreateSupplierReturns").html('The delivery receipt is duplicated.');

                        }
                    },
                    error:function(data){
                        var response = data.responseJSON;
                        $("#errorDivCreateSupplierReturns").removeClass("hidden").addClass("alert-danger text-center");
                        $("#errorDivCreateSupplierReturns").html(function(){
                            var addedHtml="";
                            for (var key in response.errors) {
                                addedHtml += "<p>"+response.errors[key]+"</p>";
                            }
                            return addedHtml;
                        });
                    }
                });

            
                

        });

        $('#formReturnItem').on('submit',function(e){
            e.preventDefault();
            if( checkTotalQuantityOfCheckedBox() ){
                console.log("ifff")
            }else{
                var data = $(this).serialize();     
                var itemIds = [];    
                console.log(data)
                for(var i=0; i < $("#returnTbody tr").length ;i++ ){
                    if( ($("#refundTbody tr td:nth-child(4)")[i].firstChild).checked ){
                        itemIds.push( $("#refundTbody tr td:nth-child(4)")[i].firstChild.dataset.productid );
                    }
                }
                $.ajax({
                    type:'POST',
                    // url:'admin/storeNewItem',
                    url: "{{route('admin.createReturnItem')}}",
                    // data:{
                    //     'name': arrayOfData[1].value,
                    // },

                    // data:{data},
                    data:data,
                    //_token:$("#_token"),
                    success:function(data){
                        console.log(data)
                        //close modal
                        $('#return').modal('hide')                    
                        //prompt the message
                        $("#successDiv p").remove();    
                        $("#successDiv").removeClass("hidden")
                                .html("<h3>Return Item(s) successful</h3>");
                        $("#successDiv").css("display:block");                             
                        $("#successDiv").slideDown("slow")
                            .delay(1000)                        
                            .hide(1500);
                        $("#errorDivCreateReturns").html("");
                        $('#returnOrRefundPrompt').modal('show');
                        $("#returnsDataTable").DataTable().ajax.reload();//reload the dataTables
                        // $('#formReturnItem').reset();
                        $("#returnItemTbody tr").remove();
                        $("#returnsDataTable2").DataTable().ajax.reload();//reload the dataTables


                    },
                    error:function(data){
                        var response = data.responseJSON;
                        $("#errorDivCreateReturns").removeClass("hidden").addClass("alert-danger text-center");
                        $("#errorDivCreateReturns").html(function(){
                            var addedHtml="";
                            for (var key in response.errors) {
                                addedHtml += "<p>"+response.errors[key]+"</p>";
                            }
                            return addedHtml;
                        });
                    }
                });

            }
                

        });

        $('#formsupplierReturnItem').on('submit',function(e){   
            e.preventDefault();
            if( checkTotalQuantityOfCheckedBoxSupplier() ){
                console.log("error occured")
            }else{
                console.log("ready")
                var data = $(this).serialize(); 
                var arrayOfData = $("#formsupplierReturnItem").serializeArray(); 
                // console.log(arrayOfData) 
                // return true;
                var supplierret = []; 
                $.ajax({
                    type:'POST',
                    url: "{{route('admin.createSupplierReturnItem')}}",
                    data:data,
                    success:function(data){
                        localStorage.setItem('success','Successful');
                        localStorage.setItem('message',data);
                        location.reload(true);
                    },
                    error:function(data){
                  
                    }
                });
        }
      

        });
        
        $('#formRefund').on('submit',function(e){
            e.preventDefault();
            var data = $(this).serialize();           
            // var itemIds = [];
            // var quantity = [];
            // var status = [];
            // console.log( ($("#refundTbody tr td:nth-child(4)")[0].firstChild).checked )
            // for(var i=0; i < $("#refundTbody tr").length ;i++ ){
            //     if( ($("#refundTbody tr td:nth-child(4)")[i].firstChild).checked ){
            //         itemIds.push( $("#refundTbody tr td:nth-child(4)")[i].firstChild.dataset.productid );
            //         status.push( $("#refundTbody tr td:nth-child(5)")[i].firstChild.value );
            //     }
            // }
            
            $.ajax({
                type:'POST',
                url: "{{route('admin.createRefund')}}",
                // data:{
                //     'itemIds': itemIds,
                //     'status': status,
                // },
                data:data,

                success:function(data){
                    console.log(data)
                    //close modal
                    $('#refund').modal('hide')                    
                    //prompt the message
                    $("#successDiv p").remove();
                    $("#successDiv").removeClass("hidden")
                            .html("<h3>" +data+ "</h3>");
                    $("#successDiv").css("display:block");                             
                    $("#successDiv").slideDown("slow")
                        .delay(1000)                        
                        .hide(1500);
                },
                error:function(data){
                    var response = data.responseJSON;
                      $("#errorDivCreateRefund").removeClass("hidden").addClass("alert-danger text-center");
                      $("#errorDivCreateRefund").html(function(){
                          var addedHtml="";
                          for (var key in response.errors) {
                              addedHtml += "<p>"+response.errors[key]+"</p>";
                          }
                          return addedHtml;
                      });
                }
            });

        });

        $(document).ready(function(){
         $('#custReturnsDataTable').DataTable({
              "destroy": true,
              "processing": true,
              "serverSide": true,
              "colReorder": true,  
              //"autoWidth": true,
              "pagingType": "full_numbers",
            //   dom: 'Bfrtip',
            //   "buttons": [
            //       {
            //           extend: 'collection',
            //           text: 'EXPORT',
            //           buttons: [
            //              {extend: 'copy', title: 'Jernixon Motorparts - Returns'},
            //               {extend: 'excel', title: 'Jernixon Motorparts - Returns'},
            //               {extend: 'csv', title: 'Jernixon Motorparts - Returns'},
            //               {extend: 'pdf', title: 'Jernixon Motorparts - Returns'},
            //               {extend: 'print', title: 'Jernixon Motorparts - Returns'}
            //           ]
            //       }
            //   ],

              "ajax":  "{{ route('returns.getReturns') }}",
              "columns": [
                  {data: 'or_number'},
                  {data: 'customer_name'},
                //   {data: 'address'},
                  {data: 'action'},
              ]
          });

         $('#supReturnsDataTable').DataTable({
              "destroy": true,
              "processing": true,
              "serverSide": true,
              "colReorder": true,  
              //"autoWidth": true,
              "pagingType": "full_numbers",
            //   dom: 'Bfrtip',
            //   "buttons": [
            //       {
            //           extend: 'collection',
            //           text: 'EXPORT',
            //           buttons: [
            //              {extend: 'copy', title: 'Jernixon Motorparts - Returns'},
            //               {extend: 'excel', title: 'Jernixon Motorparts - Returns'},
            //               {extend: 'csv', title: 'Jernixon Motorparts - Returns'},
            //               {extend: 'pdf', title: 'Jernixon Motorparts - Returns'},
            //               {extend: 'print', title: 'Jernixon Motorparts - Returns'}
            //           ]
            //       }
            //   ],

              "ajax":  "{{ route('returns.getReturns') }}",
              "columns": [
                  {data: 'or_number'},
                //   {data: 'price'},
                  {data: 'created_at'},
                  {data: 'action'},
              ]
          });
        }); 

    $("#custButton").click(function(){
        document.getElementById("errorDateRangeReport").innerHTML ="";
        $("div[style='display: block;']").slideUp("slow");
        $("#custReturnDiv").slideDown("slow").removeClass('hidden');
            
            $("#custButton").addClass('active');
            $("#supButton").removeClass('active');
            $("#supReturnDiv").addClass('hidden');
    });
         $('#returnsDataTable2').DataTable({
              "destroy": true,
               "processing": true,
               "serverSide": true,
               "colReorder": true,  
               //"autoWidth": true,
              "pagingType": "full_numbers",

               "ajax":  "{{ route('returns.getReturns2') }}",
               "columns": [
                  {data: 'created_at'},
                  {data: 'po_id'},
                  {data: 'supplier_name'},
                  {data: 'address'},
                   {data: 'damagedQty_return'},
                   {data: 'damaged_salableQty_return'},
                   {data: 'status'},
                   {data: 'action'},
               ]
           });


    $("#supButton").click(function(){
        document.getElementById("errorDateRangeReport").innerHTML ="";
        $("div[style='display: block;']").slideUp("slow");
        $("#supReturnDiv").slideDown("slow").removeClass('hidden');
        
        $("#custButton").removeClass('active');
        $("#supButton").addClass('active');
        $("#custReturnDiv").addClass("hidden");
    });

}); 


    
    
    function supplier(){
        $('#supplierDiv').removeClass('hidden');
        $('#customerDiv').addClass('hidden');
        $('#customerButton').removeClass('active');
        $('#supplierButton').addClass('active');
        
        $('#supplierreturnbutton').removeClass('hidden');
        $('#returnSaveButton').addClass('hidden');
    }
    function customer(){
        $('#supplierDiv').addClass('hidden');
        $('#customerDiv').removeClass('hidden');        
        $('#customerButton').addClass('active');
        $('#supplierButton').removeClass('active');
        
        $('#supplierreturnbutton').addClass('hidden');
        $('#returnSaveButton').removeClass('hidden');
    }

</script>

<style>
    .autocomplete {
        /*the container must be positioned relative:*/
        position: relative;
        display: inline-block;
    }
    .searchResultDiv {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        /*position the autocomplete items to be the same width as the container:*/
        top: 100%;
        left: 0;
        right: 0;
    }
    .searchResultDiv div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff; 
        border-bottom: 1px solid #d4d4d4; 
    }
    .searchResultDiv div:hover {
        /*when hovering an item:*/
        background-color: #e9e9e9; 
    }
    .autocomplete-active {
        /*when navigating through the items using the arrow keys:*/
        background-color: DodgerBlue !important; 
        color: #ffffff; 
    }
    .searchSupplierResultDivs {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        /*position the autocomplete items to be the same width as the container:*/
        top: 100%;
        left: 0;
        right: 0;
    }
    .searchSupplierResultDivs div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff; 
        border-bottom: 1px solid #d4d4d4; 
    }
    .searchSupplierResultDivs div:hover {
        /*when hovering an item:*/
        background-color: #e9e9e9; 
    }
</style>

@endsection


@section('right')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class="hidden alert-danger text-center">
                    </div>
                    <div class="row">
                        <div class="col-md-4 ">
                            <p>
                                <a href = "#return" data-toggle="modal">
                                    <button type="button" class="btn btn-success"><i class="fa fa-reply"></i> Return Item</button>
                                </a>
                                {{-- <a href = "#refund" data-toggle="modal">
                                    <button type="button" class="btn btn-success"><i class="fa fa-reply"></i> Refund</button>
                                </a> --}}
                            </p>
                        </div>
                    </div>
                    <div class = "row">
                        <div id = "buttons" class = "text-center">
                          <button type="button" id="custButton" class="btn btn-basic active" style="width:48%;font-size: 20px">Returns from Customer</button>
                          <button type="button" id="supButton" class="btn btn-basic" style="width:48%; font-size: 20px">Returns to Supplier</button>
                        </div>
                        <div id="errorDateRangeReport" class="hidden alert-danger text-center" style = "margin-top: 10px">
                        </div>
                    </div>
                    <div id = "custReturnDiv" class = "">
                        <div class="" style="margin-top: 10px">
                                <label for="from">From</label>
                                <input type="date">
                                <label for="to">to</label>
                                <input type="date">
                                <button id = "cr" onclick="createReport(this)">Filter</button>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-bordered table-striped" style="width:100%" id="custReturnsDataTable">
                                <thead>
                                    <tr>
                                        <!-- <th class="text-left">OR Number</th>
                                        <th class="text-left">Date Created</th>
                                        <th class="text-left">Action</th> -->
                                        <th>OR Number</th>
                                        <th>Sold to</th>
                                        {{-- <th>Address</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id = "supReturnDiv" class = "hidden">
                        <div class="" style="margin-top: 10px">
                            <label for="from">From</label>
                            <input type="date">
                            <label for="to">to</label>
                            <input type="date">
                            <button id = "sr" onclick="createReport(this)">Filter</button>
                        </div>
                    <div class="content table-responsive table-full-width">
                            <table class="table table-bordered table-striped" style="width:100%" id="returnsDataTable2">
                                <thead>
                                    <tr>
                                        <th class="text-left" style = "width: 20%;">Date</th>
                                        <th class="text-left">Delivery Receipt Number</th>
                                        <th class="text-left">Supplier Name</th>
                                        <th class="text-left">Address</th>
                                        <th class="text-left">Damaged Quantity Return</th>
                                        <th class="text-left">Damaged Salable Quantity Return</th>
                                        <th class="text-left">Status</th>
                                        <th class="text-left">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('modals')
<div id="return" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true"> 
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">

            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title"><i class=" fa fa-reply" style="margin-right: 10px"></i> Returns</h3>
            </div>
            <div class = "modal-body">  
                <div class="panel panel-default">
                    <div id = "buttons">
                        <button type="button" id="customerButton" onclick="customer()" class="btn btn-basic active" style="width:49.6%;font-size: 16px">Customer Return Item(s)</button>
                        <button type="button" id="supplierButton" onclick="supplier()" class="btn btn-basic" style="width:49.6%; font-size: 16px">Supplier Return Item(s)</button>
                    </div>
                </div>
                    {!! Form::open(['method'=>'post','id'=>'formReturnItem']) !!}
                    <div id = "customerDiv">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                     Customer Return Information
                                </strong>
                            </div>
                            <div class="panel-body">

                                <div class="form-group">                                
                                    <div class="row">
                                        <div class="col-md-3">
                                            {{Form::label('Official Receipt No:')}}
                                        </div>
                                        <div class="col-md-9">
                                         
                                            <input autocomplete="off" id="searchORNumberInput" type="number" onkeyup="searchOfficialReceipt(this)" name="officialReceiptNumber" class="form-control border-input">
                                             <div id="resultORNumberDiv" class="searchResultDiv">
                                    </div>
                                        </div>
                                    </div>
                                </div>
        						
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            {{Form::label('Date', 'Date:')}}
                                        </div>
                                        <div class="col-md-9">
                                            <input type="datetime-local" name="Date" id="today" class="form-control"/>    
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            {{Form::label('OfficialReceiptDate', 'Official Receipt Date:')}}
                                        </div>
                                        <div class="col-md-9">
                                <input type="text" disabled id="ORdate" class="form-control"/>    
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">    
                                    <div class="row">
                                        <div class="col-md-3">
                                            {{Form::label('Customer', 'Customer:')}}
                                        </div>
                                        <div class="col-md-9">
                                           
                                            <input id="returnCustomerName" name="customerName" id="customerName" class="form-control border-input" >
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="form-group">    
                                    <div class="row">
                                        <div class="col-md-3">
                                            {{Form::label('remainingWarrantyDays', 'Remaining warranty day/s:')}}
                                        </div>
                                        <div class="col-md-9">
                                            {{Form::text('remainingWarrantyDays','',['class'=>'form-control','value'=>'','disabled'])}}
                                        </div>
                                    </div>
                                </div> --}}

                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>
                                    <span class="fa fa-reply"></span>
                                    Return Item
                                </strong>
                            </div>
                            <div class="modal-body">
                                <div class="content table-responsive">
                                    <table class="table table-bordered table-striped">

                                        <thead>
                                            <tr>
                                                <th class="text-left">Description</th>
                                                <th class="text-left">Qty</th>
                                                <th class="text-left">Selling Price</th>
                                                <th class="text-left">Check item to return</th>
                                                <th class="text-left">Damaged</th>
                                                <th class="text-left">Undamaged</th>
                                                <th class="text-left">Damage Salable</th>
                                                <th class="text-left">Remaining warranty day/s</th>
                                            </tr>
                                        </thead>

                                        <tbody id="returnItemTbody">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div id="errorDivCreateReturns" class="hidden">

                        </div>
                        <div class="row">
                            <div class="text-right">                                           
                                <div class="col-md-12">   
                                    <button type="submit" id="returnSaveButton" class="btn btn-success" form='formReturnItem'>Save</button>
                                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    {!! Form::open(['method'=>'post','id'=>'formsupplierReturnItem']) !!}
                    <div id = "supplierDiv" class = "hidden">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                     Return to Supplier Information
                                </strong>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            {{Form::label('Date', 'Date:')}}
                                        </div>
                                        <div class="col-md-9">
                                            <input type="datetime-local" name="SDate" id="suppliertoday" class="form-control"/>    
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">    
                                    <div class="row">
                                        <div class="col-md-3">
                                            {{Form::label('Delivery Receipy', 'Delivery Receipt:')}}
                                        </div>
                                        <div class="col-md-9">
                                           <div class="autocomplete" style="width:100%;">
                                            <input autocomplete="off" type="text" id="searchDRreceipt" name="DRreceipt" onkeyup="searchSupplier(this)" class="form-control border-input" placeholder="Enter the delivery receipt">
                                            <div id="searchSupplierResultDiv" class="searchSupplierResultDivs">
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            {{Form::label('Supplier Name', 'Supplier Name:')}}
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" disabled id='rspname' class="form-control"/>    
                                            <input type="hidden" name="Sname" id='rspname2' class="form-control"/>    
                                        </div>
                                    </div>
                                </div>

                        
                                <div class="form-group">    
                                    <div class="row">
                                        <div class="col-md-3">
                                            {{Form::label('Address', 'Address:')}}
                                        </div>
                                        <div class="col-md-9">
                                            {{Form::text('Address','',['class'=>'form-control','value'=>'','disabled'])}}
                                            <input id="supplier_address" type="hidden" name="saddress" class="form-control border-input" >
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>
                                    <span class="fa fa-reply"></span>
                                    Return to Supplier Item
                                </strong>
                            </div>
                            <div class="modal-body">
                                <div class="content table-responsive">
                                    <table class="table table-bordered table-striped" style='width:100%;'>

                                        <thead>
                                            <tr>
                                                <th class="text-left">Description</th>
                                                <th class="text-left">Quantity </th>
                                                <th class="text-left">Damaged Quantity</th>
                                                <th class="text-left">Damaged Salable Quantity</th>
                                                <th class="text-left">Check item to return</th>
                                            </tr>
                                        </thead>

                                        <tbody id="returnSupplierItemTbody">
                                        
                                        </tbody>
                                    </table>
                                </div>
                                        
                            </div>
                        </div>
                        <div id="errorDivCreateReturnsSupplier" class="hidden">

                        </div>
                        <div class="row">
                            <div class="text-right">                                           
                                <div class="col-md-12">   
                                    <button type="submit" id="supplierreturnbutton" class="btn btn-success hidden" form='formsupplierReturnItem'>Save</button>
                                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}

                        </div>
                
                
            </div>
        </div>
    </div>
</div>

<div id="viewReturn" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true"> 
    <div class = "modal-dialog modal-lg" style= "width:65%;">
        <div class = "modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Official Receipt Information</h3>
            </div>
            <div class="modal-body">
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                     Information
                                </strong>
                            </div>
                            <div class="panel-body">
        
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            {{Form::label('Date', 'Sold Date:')}}
                                        </div>
                                        <div class="col-md-9">                                          
                                            <p class="form-control" id="rDate"></p>   
                                        </div>
                                    </div>
                                </div>
        
                                <div class="form-group">                                
                                    <div class="row">
                                        <div class="col-md-3">
                                            {{Form::label('Official Receipt No:')}}
                                        </div>
                                        <div class="col-md-9">
                                            {{--  {{ Form::number('Official Receipt No','',['class'=>'form-control','min'=>'1']) }}  --}}
                                            <p class="form-control" id="returnedORNumber"></p>

                                        </div>
                                    </div>
                                </div>
        
                                <div class="form-group">    
                                    <div class="row">
                                        <div class="col-md-3">
                                            {{Form::label('Customer', 'Customer:')}}
                                        </div>
                                        <div class="col-md-9">
                                            {{--  {{Form::text('Customer','',['class'=>'form-control','value'=>'','disabled'])}}  --}}
                                        <p class="form-control" id="customerName"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">    
                                    <div class="row">
                                        <div class="col-md-3">
                                            {{Form::label('Customer', 'Address:')}}
                                        </div>
                                        <div class="col-md-9">
                                            {{--  {{Form::text('Customer','',['class'=>'form-control','value'=>'','disabled'])}}  --}}
                                        <p class="form-control" id="address"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="fa fa-reply"></span>
                            Returned Item
                        </strong>
                    </div>
                    <div class="modal-body">
                        <div class="content table-responsive">
                            <table class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th class="text-left">Description</th>
                                        <th class="text-left">Unit Price</th>
                                        <th class="text-left">Damaged</th>
                                        <th class="text-left">Undamaged</th>
                                        <th class="text-left">Damage Salable</th>
                                    </tr>
                                </thead>

                                <tbody id="veiwReturnedItemTbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">   
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-refresh"></span>
                            Exchanged Item
                        </strong>
                    </div>
                    <div class="modal-body">
                        <div class="content table-responsive">
                            <table class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th class="text-left">Qty.</th>
                                        <th class="text-left">Unit</th>
                                        <th class="text-left">Description</th>
                                        <th class="text-left">Unit Price</th>
                                        <th class="text-left">Amount</th>
                                    </tr>
                                </thead>

                                <tbody id="veiwExchangedItemTbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                        <div class="text-right">                                           
                            <div class="col-md-12">   
                                <button class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="viewReturn2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true"> 
    <div class = "modal-dialog modal-lg" style='width:65%;'>
        <div class = "modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Return to Supplier Information</h3>
            </div>
            <div class="modal-body">
              {!! Form::open(['method'=>'post','id'=>'supplierexchange']) !!}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-info-sign"></span>
                            Information
                        </strong>
                    </div>
                    <div class="panel-body">
                      
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Delivery Receipt number', 'Delivery Receipt Number:')}}
                                </div>
                                <div class="col-md-9">
                                    <p class="form-control" id="returneddrNumber" form="supplierexchange"></p>   
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Supplier Name', 'Supplier Name:')}}
                                </div>
                                <div class="col-md-9">
                                    <p class="form-control" id="returnedSupplierName" form="supplierexchange"></p>   
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Address', 'Address:')}}
                                </div>
                                <div class="col-md-9">
                                    <p class="form-control" id="returnedAddress" form="supplierexchange"></p>   
                                </div>
                            </div>
                        </div>

                        <div class="form-group">                                
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Date:')}}
                                </div>
                                <div class="col-md-9">
                                    
                                    <p class="form-control" id="supplierViewDate"></p>

                                </div>
                            </div>
                        </div>
                        <div class="content table-responsive">
                            <table class="table table-bordered table-striped no-wrap" style="width:100%;">

                                <thead>
                                    <tr>
                                        <th class="text-left" width="30%">Description</th>
                                        <th class="text-left" width="20%">Damaged Quantity Returned</th>
                                        <th class="text-left" width="20%">Damaged Salable Quantity Returned </th>
                                        <th class="text-left">Status</th>
                                    </tr>
                                </thead>

                                <tbody id="veiwReturnedItemTbody2">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-refresh"></span>
                            Supplier Exchanged Item
                        </strong>
                    </div>
                    <div class="modal-body">
                        <div id='hid'>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        {{Form::label('Date', 'Date:')}}
                                    </div>
                                    <div class="col-md-9">
                                        <input type="datetime-local" name="Date" id="returned_date"  class="form-control"/>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">                                
                                <div class="row">
                                    <div class="col-md-3">
                                        {{Form::label('num','Delivery Receipt Number:')}}
                                    </div>
                                    <div class="col-md-9">
                                        {{ Form::text('Delivery Receipt Number','',['class'=>'form-control','id'=>'returned_dr_id']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        <div class="content table-responsive">
                            <table class="table table-bordered table-striped" id="table1">

                                <thead>
                                    <tr>
                                        <th class="text-left" width="25%">Description</th>
                                        <th class="text-left" width="15%">Damaged Quantity Accepted</th>
                                        <th class="text-left" width="15%">Damaged Salable Quantity Accepted</th>
                                        <th class="text-left" width="15%">Unit</th>
                                        <th class="text-left">Unit Price</th>
                                        <th class="text-left">Amount</th>
                                        <th class="text-left">Remove</th>
                                    </tr>
                                </thead>

                                <tbody id="supplierExchangeTbody">
                                </tbody>
                            </table>

                            <table class="table table-bordered table-striped" id="table2">

                                <thead>
                                    <tr>
                                        <th class="text-left" >Date</th>
                                        <th class="text-left" >Delivery Receipt</th>
                                        <th class="text-left" width="15%">Description</th>
                                        <th class="text-left" width="15%">Damaged Quantity Accepted</th>
                                        <th class="text-left" width="15%">Damaged Salable Quantity Accepted</th>
                                        <th class="text-left">Unit</th>
                                        <th class="text-left">Unit Price</th>
                                        <th class="text-left">Amount</th>
                                    </tr>
                                </thead>

                                <tbody id="supplierExchangeTBody3">
                                </tbody>
                            </table>
                            <div id="errorDivCreateSupplierReturns" class="hidden"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="text-right">                                           
                        <div class="col-md-12">   
                            <button type="submit" id="saveSupplierExchangeItemButton" class="btn btn-success" form='supplierexchange'>Save</button>
                            <button class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div id="viewReturn3" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true"> 
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Return to Supplier Information</h3>
            </div>
            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-info-sign"></span>
                            Information
                        </strong>
                    </div>
                    <div class="panel-body">
                      
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Delivery Receipt number', 'Delivery Receipt Number:')}}
                                </div>
                                <div class="col-md-9">
                                    <p class="form-control" id="returnedDRNo"></p>   
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Supplier Name', 'Supplier Name:')}}
                                </div>
                                <div class="col-md-9">
                                    <p class="form-control" id="returnedSname"></p>   
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Address', 'Address:')}}
                                </div>
                                <div class="col-md-9">
                                    <p class="form-control" id="returnedAd" ></p>   
                                </div>
                            </div>
                        </div>

                        <div class="form-group">                                
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Date:')}}
                                </div>
                                <div class="col-md-9">
                                    
                                    <p class="form-control" id="supplierVDate"></p>

                                </div>
                            </div>
                        </div>
                        <div class="content table-responsive">
                            <table class="table table-bordered table-striped no-wrap" style="width:100%;">

                                <thead>
                                    <tr>
                                        <th class="text-left" width="30%">Description</th>
                                        <th class="text-left" width="20%">Damaged Quantity Returned</th>
                                        <th class="text-left" width="20%">Damaged Salable Quantity Returned </th>
                                        <th class="text-left">Status</th>
                                    </tr>
                                </thead>

                                <tbody id="veiwReturnedItemTbody3">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>
                            <span class="glyphicon glyphicon-refresh"></span>
                            Supplier Exchanged Item
                        </strong>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Date', 'Date:')}}
                                </div>
                                <div class="col-md-9">
                                    <p class="form-control" id="returned_sdate"></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">                                
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('Delivery Receipt Number:')}}
                                </div>
                                <div class="col-md-9">
                                    <p class="form-control" id="rsDR"></p>
                                </div>
                            </div>
                        </div>
                            
                        <div class="content table-responsive">
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="text-right">                                           
                        <div class="col-md-12">   
                            <button class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="returnOrRefundPrompt" class="modal fade" tabindex="-1" role = "dialog" aria-labelledby = "viewLabel" aria-hidden="true">
    <div class = "modal-dialog modal-md">
        <div class = "modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <p></p>
            </div>
            <div class = "modal-body">
                <div class="text-center">
                    <strong>
                        <h3>If you want to exchange item/s, please click Sales.</h3>
                        {{-- <p>There are still <span id="itemQuantityLeft"></span> left. Do you want to continue?</p> --}}
                    </strong>
                </div>
                <div class="panel-body">
                    <div class="text-center">

                        <button id="statusAndId" data-status="" data-item="" type="button" onclick="window.location.href='/admin/sales'" class="btn btn-success">Sales</button>
                        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>

                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>

@endsection


@section('js_link')
<!--   Core JS Files   -->
{{--  <script src="{{asset('assets/js/jquery-1.10.2.js')}}"></script>  --}}
{{--  <script src="{{asset('assets/js/jquery-1.12.4.js')}}"></script>  --}}
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
{{--  <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>  --}}
{{--  <script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>  --}}
@endsection