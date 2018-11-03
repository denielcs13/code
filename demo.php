
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
    <th>Room Number</th>   
    <th>Product Name</th>
    <th>Product Price</th>
   </tr>
  </thead>
  <tbody>
      
   <tr class='tr_input'>
    <td><input type='text' class='room' id='room_1' ></td>
    <td><input type='text' class='username' id='username_1' placeholder='Enter Product'></td>    
    <td><input type='text' class='salary' name='salary[]' id='salary_1' ></td>
   </tr>
  </tbody>
  <tfoot>
			                                <tr>
			                                    <td><strong>TOTAL</strong></td>
			                                    <td></td>			                                    
                                                            <td><input type='text' class='salary'  id='total' disabled="" ></td>
			                                </tr>
			                            </tfoot>
 </table>
 <br>
 <input type='button' value='Add more' id='addmore'>
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
     url: "ajaxfile/getProduct.php",
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
     url: 'ajaxfile/getProduct.php',
     type: 'post',
     data: {proid:prid,request:2},
     dataType: 'json',
     success:function(response){
 
      var len = response.length;
      if(len > 0){
       var id = response[0]['id'];
       var name = response[0]['name'];       
       var prc1 = response[0]['prc'];
       
       document.getElementById('salary_'+index).value = prc1;
 
      }
             //alert($("[name='salary[]']").length)  ;
             var sum=0;
             $("[name='salary[]']").each(function(){
             sum +=parseInt($(this).val());
               console.log(sum);    
             })
             document.getElementById('total').value = sum;
//            for(var i=0;i<$("[name='salary[]']").length;i++){
//
//            	
//            }
 
     }
    });

    return false;
   }
  });
 });
 
 // Add more
 $('#addmore').click(function(){

  // Get last id 
  var lastname_id = $('.tr_input input[type=text]:nth-child(1)').last().attr('id');
  var split_id = lastname_id.split('_');

  // New index
  var index = Number(split_id[1]) + 1;

  // Create row with input elements
  var html = "<tr class='tr_input'><td></td><td><input type='text' class='username' id='username_"+index+"' placeholder='Enter product'></td><td><input type='text' class='salary' name='salary[]' id='salary_"+index+"' ></td></tr>";

  // Append data
  $('tbody').append(html);
 
 });
});


    </script>
    
<script type="text/javascript">
    //total
$(document).on('keyup','input.salary',function(){

 var tds = document.getElementById('res').getElementsByTagName('td');
            var sum = 0;
            for(var i = 0; i < tds.length; i ++) {
                if(tds[i].className == 'salary') {
                    sum += isNaN(tds[i].innerHTML) ? 0 : parseInt(tds[i].innerHTML);
                }
            }
            document.getElementById('res').innerHTML += '<tr><td>' + sum + '</td><td>total</td></tr>';
    //alert('sum is ' + sum);
});
    </script>
</body>
</html>
