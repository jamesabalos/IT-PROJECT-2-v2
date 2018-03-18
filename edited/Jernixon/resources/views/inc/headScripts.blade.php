<script>
    
    function searchItem2(button){
        $.ajax({
            method: 'get',
            //url: 'items/' + document.getElementById("inputItem").value,
            url: 'items/' + button.value,
            dataType: "json",
            success: function(data){
                if(button.id === "addQuantity"){
                    $("#addQuantityTbody tr").remove();
                    for(var i=0; i < data.length; i++){
                        //alert(data[i].description);
                        var thatTable = document.getElementById("addQuantityTbody");
                        var newRow = thatTable.insertRow(-1);
                        var itemId = newRow.insertCell(-1);
                        itemId.innerHTML = "<td>" + data[i].product_id + "</td>";
                        var newCell = newRow.insertCell(-1);
                        newCell.innerHTML = "<td>" +data[i].description+ "</td>";
                        var secondCell = newRow.insertCell(-1); 
                        secondCell.innerHTML = "<td>?</td>";
                        var thirdCell = newRow.insertCell(-1);
                        thirdCell.innerHTML = "<td>\
                            <input value='' type='number' min='1'> \
                        </td>";
                        //<form action='items/3' 'method'='POST' id='form" +data[i].product_id+ "'> \
                            // <input type='text'> \
                            // </form> \
                            
                            var forthCell = newRow.insertCell(-1);
                            forthCell.innerHTML = "<td>" + data[i].price + "</td>";
                            var fifthCell = newRow.insertCell(-1);
                            fifthCell.innerHTML = "<td>?</td>";
                            var sixthCell = newRow.insertCell(-1);
                            //sixthCell.innerHTML = "<td><button type='submit' value='Submit' form='form" +data[i].product_id+"'"+">Submit</button></td>";
                            sixthCell.innerHTML = "<td><button onclick='addQuantitySubmit(this)' data-aq-id='" + data[i].product_id +"'>Submit</button></td>";
                        }
                    }else if(button.id === "subtractQuantity"){
                        $("#subtractQuantityTbody tr").remove();
                        for(var i=0; i < data.length; i++){
                            //alert(data[i].description);
                            var thatTable = document.getElementById("subtractQuantityTbody");
                            var newRow = thatTable.insertRow(-1);
                            var itemId = newRow.insertCell(-1);
                            itemId.innerHTML = "<td>" + data[i].product_id + "</td>";
                            var firstCell = newRow.insertCell(-1);
                            firstCell.innerHTML = "<td>" +data[i].description+ "</td>";
                            var secondCell = newRow.insertCell(-1); 
                            secondCell.innerHTML = "<td>?</td>";
                            var thirdCell = newRow.insertCell(-1);
                            thirdCell.innerHTML = "<td>\
                                <input value='' type='number' min='1'> \
                            </td>";
                            
                            
                            var forthCell = newRow.insertCell(-1);
                            forthCell.innerHTML = "<td>" + data[i].price + "</td>";
                            var fifthCell = newRow.insertCell(-1);
                            fifthCell.innerHTML = "<td>?</td>";
                            var sixthCell = newRow.insertCell(-1);
                            //sixthCell.innerHTML = "<td><button type='submit' value='Submit' form='form" +data[i].product_id+"'"+">Submit</button></td>";
                            sixthCell.innerHTML = "  <select name='reason'>\
                                <option value='Salable'>Salable</option>\
                                <option value='Damaged-Salable'>Damaged-Salable</option>\
                                <option value='Damaged'>Damaged</option>\
                            </select>";
                        }
                        
                        if(data.length == 1){
                            document.getElementById("mod_footer").innerHTML="<div class='col-md-12'>\
                                <button onclick='subtractQuantitySubmit(this)' class='btn btn-primary' data-sq-id='" + data[0].product_id +"'>Submit</button>\
                                <button class='btn btn-primary' data-dismiss='modal' >Cancel</button></div>";
                            }else{
                                $("#mod_footer div").remove();
                            }
                            
                        }else if(button.id === "returnItem"){
                            $("#returnItemTbody tr").remove();                        
                            for(var i=0; i < data.length; i++){
                                //<div class="btn-group" >
                                    //<button class="btn btn-success" type="button">Item1</button>
                                    //<button class="btn btn-danger" type="button"><i class="fa fa-close"></i></button>
                                    // </div>
                                    var thatTable = document.getElementById("returnItemTbody");
                                    var newRow = thatTable.insertRow(-1);
                                    var firstCell = newRow.insertCell(-1);
                                    firstCell.innerHTML = "<td>" +data[i].description+ "</td>";
                                    var secondCell = newRow.insertCell(-1); 
                                    secondCell.innerHTML = "<td>?</td>";
                                    var thirdCell = newRow.insertCell(-1);
                                    //sixthCell.innerHTML = "<td><button type='submit' value='Submit' form='form" +data[i].product_id+"'"+">Submit</button></td>";
                                    thirdCell.innerHTML = "<td><button class='btn btn-danger' onclick='displayReturnForm(this)'>Return</button></td>";
                                }
                            }else if(button.id === "removeItem"){
                                $("#removeItemTbody tr").remove();   
                                if(data.length === 0){
                                    var thatTable = document.getElementById("removeItemTbody");
                                    var newRow = thatTable.insertRow(-1);
                                    //newRow.setAttribute("align","center");
                                    var noResult = newRow.insertCell(-1);
                                    noResult.innerHTML = "<td col='6' style='align:center'><h3 >No item found.</h3></td>";
                                }else{
                                    for(var i=0; i < data.length; i++){
                                        var thatTable = document.getElementById("removeItemTbody");
                                        var newRow = thatTable.insertRow(-1);
                                        var itemId = newRow.insertCell(-1);
                                        itemId.innerHTML = "<td>" + data[i].product_id + "</td>";
                                        var firstCell = newRow.insertCell(-1);
                                        firstCell.innerHTML = "<td>" +data[i].description+ "</td>";
                                        var secondCell = newRow.insertCell(-1); 
                                        secondCell.innerHTML = "<td>query</td>";
                                        var thirdCell = newRow.insertCell(-1);
                                        thirdCell.innerHTML = "<td>" + data[i].price + "</td>";
                                        var fifthCell = newRow.insertCell(-1);
                                        fifthCell.innerHTML = "<td>query</td>";
                                        var sixthCell = newRow.insertCell(-1);
                                        //sixthCell.innerHTML = "<td><button type='submit' value='Submit' form='form" +data[i].product_id+"'"+">Submit</button></td>";
                                        sixthCell.innerHTML = "<td><button type='button' onclick='deleteItemButton(this)' class='btn btn-danger'>Delete</button></td>";
                                    }
                                }
                            }
                            
                            
                        }
                    });
                    
                }
                function addQuantitySubmit(button){
                    var input = button.parentNode.previousSibling.previousSibling.previousSibling.childNodes[1].value;
                    var itemId = button.getAttribute("data-aq-id");
                    if(input == ""){
                        button.parentNode.previousSibling.previousSibling.previousSibling.childNodes[1].focus();
                        button.parentNode.previousSibling.previousSibling.previousSibling.childNodes[1].setAttribute('style','border:1px solid red');
                    }else{
                        //alert('to be continue..');
                        $.ajax({
                            type:'POST',
                            url:'items/addQuantity',
                            //dataType:'json',
                            //contentType: "application/json",
                            //processData: false,
                            //data:{"inputValue":"input","id":"itemId"},
                            data: {
                                'itemId':itemId,
                                'inputValue':input
                            },
                            success:function(dataReceived){
                                alert(dataReceived)
                            },
                            error:function(dataReceived){
                                alert(dataReceived)
                            }
                        })
                        
                    }
                    
                }
                function displayReturnForm(button){
                    $("#returnFormDiv").css("display:block");
                    $("#returnFormDiv").slideDown("slow",function(){
                        //document.getElementById("itemName").value = button.parentNode.previousSibling.previousSibling.innerHTML;
                    });
                    
                }
                
                function deleteItemButton(button){
                    var itemId = button.parentNode.parentNode.cells[0].innerText;
                    var row = button.parentNode.parentNode; //row
                    $.ajax({
                        type:'DELETE',
                        url:'/items/' + itemId,
                        //dataType:'json',
                        success:function(data){
                            //$("#errorDivRemove p").remove();
                            $("#errorDivRemove").css("display:block");
                            $("#errorDivRemove").slideDown("slow",function(){
                                $(row).hide(1500);
                            })
                            .delay(1000)
                            .hide(1500);
                        },
                        error:function(data){
                            alert(data)
                        }
                    })
                }
                
                function subtractQuantitySubmit(button){
                    var itemId = button.getAttribute("data-sq-id");
                    var inputQuantity = $("#subtractQuantityTbody tr td:eq(3) input").val(); //third td element in the tr
                    var inputReason = $("#subtractQuantityTbody tr td:eq(6) select").val();
                    
                    $.ajax({
                        type:'POST',
                        url:'items/subtractQuantity',
                        //dataType:'json',
                        //contentType: "application/json",
                        //processData: false,
                        //data:{"inputValue":"input","id":"itemId"},
                        data: {
                            'itemId':itemId,
                            'inputQuantity':inputQuantity,
                            'inputReason':inputReason
                        },
                        success:function(dataReceived){
                            alert(dataReceived)
                        },
                        error:function(dataReceived){
                            alert(dataReceived)
                        }
                    })
                    
                }
                /*function displayItem(a){
                    var description = a.parentNode.previousSibling.previousSibling.innerHTML;
                    if(){
                        
                    }else{
                        $("#displayReturnedItem").append("<div class='btn-group' >\
                            <button class='btn btn-success'>"+ a.parentNode.previousSibling.previousSibling.innerHTML +"</button>\
                            <button class='btn btn-danger' id=''><i class='fa fa-close'></i></button>\
                        </div>");
                        
                    }
                    
                    
                }
                */ 
            </script>