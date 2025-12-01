$(".add_item_to_cart").click(function(e){
  var this_id=$(this).attr('id');
  var attrs=this_id.split('_');
  var item_id=attrs[1];
  var item_name=attrs[2];
  var item_rate=attrs[attrs.length - 4];
  var avl_qty=attrs[attrs.length - 3];
  var unit_cost=attrs[attrs.length - 2];
  var unit_measure=attrs[attrs.length - 1];

  var row_str='<tr rel="'+avl_qty+'_'+unit_cost+'_'+unit_measure+'" id="item_'+item_id+'"><td class="hide">'+item_id+'</td><td>'+item_name+'</td><td><input type="number" name="item_unitprice[]" value="'+item_rate+'" class="form-control item_rate" onchange="update_item_total('+item_id+')"></td><td><input type="number" name="item_qty[]" value="1" class="form-control item_qty"  onchange="update_item_total('+item_id+')"></td><td>'+currency+' <span class="item_total">'+item_rate+'</span> <a href="#" rel="'+item_id+'" class="btn btn-danger btn-sm removeitem pull-right"><i class="ti-trash"></i></a></td></tr>';

  if($("tr#item_" + item_id).length == 0) {
    //it doesn't exist
    $("#cart_items").append(row_str);
  }else{
    var b4_qty=$("tr#item_" + item_id + " .item_qty").val();
    var b4_rate=$("tr#item_" + item_id + " .item_rate").val();

    var new_qty=parseFloat(b4_qty)+1;
    var new_total = new_qty * b4_rate;

    $("tr#item_" + item_id + " .item_total").text(new_total);
    $("tr#item_" + item_id + " .item_qty").val(new_qty);
  }

  $('.add_item_to_cart').show();
  $('#product_search_box').val('');
  $('#product_modal').modal('toggle');
  update_cart_total(contacts_data);
});

function removeitem(item_id,contacts_data){

  update_cart_total(contacts_data);
}

function update_item_total(item_id)
{
  var b4_qty=$("tr#item_" + item_id + " .item_qty").val();
  var b4_rate=$("tr#item_" + item_id + " .item_rate").val();


  var new_total = parseFloat(b4_qty) * parseFloat(b4_rate);

  $("tr#item_" + item_id + " .item_total").text(new_total);

  update_cart_total(contacts_data);
}

function update_cart_total(contacts_data)
{
  var discount = $('#discount').val();
  var amount_paid = $('#amount_paid').val();
  var payment_method = $('#payment_method').val();

  if(discount=='')
  {
    discount=0;
  }

  if(amount_paid=='')
  {
    amount_paid=0;
  }


  var sub_total = 0;

  $("#produutsincart tbody tr").each(function(){
    var row_id=$(this).attr('id');
    var row_rate = $("#"+row_id+ " .item_rate").val();
    var row_qty = $("#"+row_id+ " .item_qty").val();

    var this_total = parseFloat(row_rate) * parseFloat(row_qty);

    sub_total = parseFloat(sub_total) + parseFloat(this_total);

  });

  var selected_contact_details=$("#contact_name").val();
  var old_amount=contacts_data[selected_contact_details]['balance'];
  var old_status=contacts_data[selected_contact_details]['status'];

  var new_amount = 0;
  var new_status = '';

  grand_total = parseFloat(sub_total) - parseFloat(discount);
  remaining_balance = parseFloat(grand_total) - parseFloat(amount_paid);




  if(old_status=='debit')
  {
    new_status = 'receiveable';
    new_amount = parseFloat(old_amount) + parseFloat(remaining_balance);
  }else{
    if(old_amount >= remaining_balance )
    {
      new_status = 'payable';
      new_amount = parseFloat(old_amount) - parseFloat(remaining_balance);
    }else{
      new_status = 'receiveable';
      new_amount = parseFloat(remaining_balance) - parseFloat(old_amount);
    }
  }


  $('#old_balance_val').html(old_amount);
  $('#old_balance_status').html(old_status);

  $('#new_balance_val').html(new_amount);
  $('#new_balance_status').html(new_status);

  $("#sub_total").val(sub_total);
  $("#grand_total").val(grand_total);
  $("#remaining_balance").val(remaining_balance);


}

$("#discount").change(function(){
  update_cart_total(contacts_data);
});

$("#amount_paid").change(function(){
  update_cart_total(contacts_data);
});

$("#submitbtn").click(function(e){

  e.preventDefault();
  $('.preloader').show();
  $(this).attr('disabled',true);

    var data = $("#invoice_form").serialize();

    var cname = $("#contact_name").val();
    var date = $("#datepicker-autoclose").val();
    var sub_total = $("#sub_total").val();
    var discount = $("#discount").val();
    var grand_total = $("#grand_total").val();
    var amount_paid = $("#amount_paid").val();
    var payment_method = $("#payment_method").val();
    var remaining_balance = $("#remaining_balance").val();
    var notes = $("#notes").val();

    var cart_items = '[';

    $("#produutsincart tbody tr").each(function(){
      var row_id_=$(this).attr('id');
      var row_base=$(this).attr('rel');
      var row_rate = $("#"+row_id_+ " .item_rate").val();
      var row_qty = $("#"+row_id_+ " .item_qty").val();

      var attrs=row_id_.split('_');
      var bases=row_base.split('_');
      var row_id = attrs[1];
      var available_stock = bases[0];
      var purchase_cost = bases[1];
      var unit_measure = bases[2];

      cart_items += '{"item_id":"'+row_id+'","row_rate":"'+row_rate+'","row_qty":"'+row_qty+'","qty_before":"'+available_stock+'","cost_per_unit":"'+purchase_cost+'","unit_measure":"'+unit_measure+'"},';

      });

    cart_items = cart_items.slice(0,-1);
    cart_items += ']';


    $.post( post_url, { cart_items: cart_items, cname: cname, date: date, sub_total: sub_total, discount: discount, grand_total: grand_total, amount_paid: amount_paid, payment_method: payment_method, remaining_balance: remaining_balance, notes:notes })
      .done(function( data ) {

        if(data == 'error')
        {
          alert('Some error while processing invoice.');
        }else{
          swal({
             title: 'Submited!',
             text: 'Record has been saved successfully.',
             timer: 2000,
             type: 'success',
             showConfirmButton: false
          });
          window.location = invoice_url+data;
//                      window.location.reload();
        }
      });

    return false;

});

$("#contact_name").change(function(e){
  update_cart_total(contacts_data);
});

$('#product_search_box').keyup(function(e){
  var key = $(this).val();

  if(key.length>1)
  {
    $('.add_item_to_cart').hide();
    $("[rel*='"+key+"']").show();
  }else{
    $('.add_item_to_cart').show();
  }
});

$(document).on("click", "a.removeitem" , function(e) {
  e.preventDefault();
  var item_id=$(this).attr('rel');
  var row_id = 'item_'+item_id;
  $('#'+row_id).remove();
  update_cart_total(contacts_data);
});

$('#invoice_form input').on('focus click', function() {
  var this_val=$(this).val();
  if(this_val==0)
  {
    $(this).val('');
  }
});

$('#invoice_form input').on('focusout',function(){
  var this_val=$(this).val();
  if(this_val=='')
  {
    $(this).val(0);
  }
});
