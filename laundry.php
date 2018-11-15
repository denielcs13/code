<!DOCTYPE html>
<html>
<head>
<title></title>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!-- REMOVE THIS >> <script src="js/jquery.js" type="text/javascript"></script> -->
<!--<script src="js/jquery.datetimepicker.full.js"></script>-->
<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
</head>
<body>
<div class="container">
 
    <table border='1' id="res" style='border-collapse: collapse;'>
  <thead>
   <tr>
    <th>Product name</th>   
    <th>Category</th>
    <th>Total</th>
    <th>In Use</th>
     <th>Available</th>
   </tr>
  </thead>
  <tbody>
      
   <tr class='tr_input'>    
    <td><input type='text' class='username' id='username_1' name='product[]' placeholder='Select Product'></td>    
    <td><input type='text' class='category' name='category[]' id='category_1' placeholder="Select Category" ></td>
    <td><input type='text' class='total' name="total[]" id='total_1'  placeholder="Total" ></td>
    <td><input type='text' class='inuse' name="inuse[]" id='inuse_1' placeholder="In Use" ></td>
    <td><input type='text' class='availabe' name="availabe[]" id='availabe_1' value=""></td>
   </tr>
  </tbody>

 </table>
 <br>
 <input type='button' value='Add more' id='addmore'><br/>

     <button type="button" name="save" id="save" class="btn btn-info">Save</button>
    <br />
<div id="inserted_item_data"></div>
</div>
    <script type="text/javascript">
    $(document).ready(function(){

 $(document).on('keydown', '.username', function() {
 
  var id = this.id;
  var splitid = id.split('_');
  var index = splitid[1];

  // Initialize jQuery UI autocomplete
  $( '#'+id ).autocomplete({
   source: function( request, response ) {
    $.ajax({
     url: "ajaxfile/getLaundryProduct.php",
     type: 'post',
     dataType: "json",
     data: {
      search: request.term,request:1
     },
     success: function( data ) {
      response( data );
     }
    });
   },
   select: function (event, ui) {
    $(this).val(ui.item.label); // display the selected text
    var prid = ui.item.value; // selected value

    // AJAX
    $.ajax({
     url: 'ajaxfile/getLaundryProduct.php',
     type: 'post',
     data: {proid:prid,request:2},
     dataType: 'json',
     success:function(response){
 
      var len = response.length;
      if(len > 0){
       var id = response[0]['id'];
       var name = response[0]['name'];       
       var prc1 = response[0]['prc'];
       
       document.getElementById('category_'+index).value = prc1;
       
      }
      //document.getElementById('availabe_'+index').value = 
        
             
            
 
     }
    });

    return false;
   }
  });
  
 });
 
  $(document).on('input', "[name='inuse[]']", function() {
 
  var id = this.id;
  var splitid = id.split('_');
  var index = splitid[1];
  
  var v1;
  var v2;
  var r=0;
     $("[name='inuse[]']").each(function(){
         v1 = parseInt(document.getElementById('total_'+index).value);
         v2 = parseInt(document.getElementById('inuse_'+index).value);
       r = parseInt(v1-v2);
       document.getElementById('availabe_'+index).value= r;
        console.log(v1);
        console.log(v2);
        //console.log(index);
     });   
            
    });
 
 
 //calculate diffences
//function parseOrZero(val){
//    return parseFloat(val) || 0;
//}
//$('.total, .inuse').blur(function () {
//    var total = 0;
//    for(i =0, as = $(".total, .inuse"), asl = as.size(); i < asl; i++){
//        if(i <1){
//            total += parseOrZero(as.eq(i).val());
//        }else{
//            total -= parseOrZero(as.eq(i).val());
//        }
//        console.log(total);
//        $('#availabe_'+i).text(total.toFixed(2));
//        //$('availabe_'+i).text(total);
//        //document.getElementById('availabe_'+i).value = total;
//    }     
//     //document.getElementById('availabe_'+i).value = total;
//    //$('#availabe_'+i).text(total);
//    //$('#availabe_'+i).text(sum.toFixed(2));
//});

 // Add more
 $('#addmore').click(function(){

  // Get last id 
  var lastname_id = $('.tr_input input[type=text]:nth-child(1)').last().attr('id');
  var split_id = lastname_id.split('_');

  // New index
  var index = Number(split_id[1]) + 1;

  // Create row with input elements
  var html = "<tr class='tr_input' id='row"+index+"'><td><input type='text' class='username' name='product[]' id='username_"+index+"' placeholder='Select name'></td><td><input type='text' class='category' name='category[]' placeholder='Select Category' id='category_"+index+"' ></td><td><input type='text' class='total' name='total[]' placeholder='Total' id='total_"+index+"' ></td><td><input type='text' class='inuse' name='inuse[]'  placeholder='In Use' id='inuse_"+index+"' ></td><td><input type='text' class='availabe' name='availabe[]' placeholder='Available' id='availabe_"+index+"' ></td><td><button type='button' name='remove' data-row='row"+index+"' class='btn btn-danger btn-xs remove'>-</button></td></tr>";

  // Append data
  $('#res').append(html);
 
 });
 
 $(document).on('click', '.remove', function(){
  var delete_row = $(this).data("row");
  $('#' + delete_row).remove();
  $("#g_t").load(location.href + " #g_t>*", "");
 });
 
 $('#save').click(function(){
  var room = $("#room_1").val();
  var total = $("#total").val();
  var item_prod = [];
  var item_price = [];
  
  $("[name='category[]']").each(function(){
            item_price.push(this.value);
        });
  $("[name='product[]']").each(function(){
            item_prod.push(this.value);
      });  
  
  $.ajax({
   url:"ajaxfile/add_pos.php",
   method:"POST",
   data:{room:room, total:total, item_prod:item_prod, item_price:item_price},
   //dataType: 'JSON',
   success:function(data){
    alert(data);
//    $("td[contentEditable='true']").text("");
//    for(var i=2; i<= count; i++)
//    {
//     $('tr#'+i+'').remove();
//    }
   fetch_item_data();
   }
  }); 
  });
  
  //substract the number
  
  
  
 function fetch_item_data()
 {
  $.ajax({
   url:"ajaxfile/fetchpos.php",
   method:"POST",
   success:function(data)
   {
    $('#inserted_item_data').html(data);
   }
  })
 }
 fetch_item_data();

});

//this is for second 
//var $tblrows = $("#res tbody tr");
//$tblrow.find('.total').on('change', function () {
// 
//var qty = $tblrow.find("[name=total]").val();
//var price = $tblrow.find("[name=inuse]").val();
//var subTotal = parseInt(qty,10) - parseFloat(price);
//if (!isNaN(subTotal)) {
// 
//    $tblrow.find('.availabe').val(subTotal.toFixed(2));
//   
//}
//
//});


//insert data


</script>
    

</body>
</html>
