if(typeof lend_inventory === 'undefined') {
  lend_inventory = 'off';
}



function isValidJSONString(str)
{
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

function show_invoice_details()
{
    var sub_total = $('#sub_total').val();
    if(parseFloat(sub_total)>0)
    {
      $('#invoice_details').removeClass('hide');
    }
}

function view_item_history(item_id)
{
  $('.preloader').show();
  var customer_number = $('#contact_name').val();
  var customer_name = $('#contact_name option:selected').text();
  $('.history_customer_name ').html(customer_name);

  $.get( "h-item_history_for_customer.php?item_id="+item_id+"&c_num="+customer_number, function( data ) {
    // the contents is now in the variable data
    $('#item_history_modal .modal-body .row').html(data);
    $('#item_history_modal').modal('show');
    $('.preloader').hide();
  }).fail(
    function (jqXHR, textStatus, errorThrown) {
      console.log('jqXHR:');
      console.log(jqXHR);
      console.log('textStatus = ' + textStatus);
      console.log('errorThrown = ' + errorThrown);
      swal({
         title: 'Failed!',
         text: 'These has been some issue loading data, please refresh your screen and try again. If this issue continue, Please report to technical support. <ul><li>'+ jqXHR +'</li> <li>'+textStatus+'</li></ul>',
         timer: 2000,
         type: 'danger',
         showConfirmButton: false
      });
      setTimeout(function(){ window.location.reload(); }, 5000);
      $('.preloader').hide();
    });


}

function view_invoice(table,invoice_id)
{
  $('.preloader').show();

  $.get( "h-view-invoice.php?invoice_id="+invoice_id+"&table="+table, function( data ) {
    // the contents is now in the variable data

    $('#invoice_response_modal').html(data);
    $('#invoice_response_modal').modal('show');
    $('.preloader').hide();
  }).fail(
    function (jqXHR, textStatus, errorThrown) {
      console.log('jqXHR:');
      console.log(jqXHR);
      console.log('textStatus = ' + textStatus);
      console.log('errorThrown = ' + errorThrown);
      swal({
         title: 'Failed!',
         text: 'These has been some issue loading data, please refresh your screen and try again. If this issue continue, Please report to technical support. <ul><li>'+ jqXHR +'</li> <li>'+textStatus+'</li></ul>',
         timer: 2000,
         type: 'danger',
         showConfirmButton: false
      });
      setTimeout(function(){ window.location.reload(); }, 5000);
      $('.preloader').hide();
    });


}

function removeitem(item_id,contacts_data){

  update_cart_total(contacts_data);
}

function update_item_total(item_id)
{
  var b4_qty=$("tr#item_" + item_id + " .item_qty").val();
  var b4_rate=$("tr#item_" + item_id + " .item_rate").val();


  var new_total = parseFloat(b4_qty) * parseFloat(b4_rate);

  new_total = new_total.toFixed(2);
  $("tr#item_" + item_id + " .item_total").text(new_total);

  update_cart_total(contacts_data);
}


function update_cart_total(contacts_data)
{
  var discount = $('#discount').val();
  var amount_paid = $('#amount_paid').val();
  var payment_method = $('#payment_method').val();
  var tax_amount = 0;

  if(discount=='')
  {
    discount=0;
  }

  if(amount_paid=='')
  {
    amount_paid=0;
  }




  var sub_total = 0;
  var total_product_qty = 0;

  $("#produutsincart tbody tr").each(function(){
    var row_id=$(this).attr('id');
    var row_available_stock=parseFloat($(this).attr('data-available_stock'));
    var row_tax_type=$(this).attr('data-tax-type');
    var row_rate = $("#"+row_id+ " .item_rate").val();
    var row_tax_rate = $("#"+row_id+ " .tax_rate").html();
    var row_qty = parseFloat($("#"+row_id+ " .item_qty").val());
    var this_total = parseFloat(row_rate) * parseFloat(row_qty);
    total_product_qty = total_product_qty+parseFloat(row_qty);
    this_total =  this_total.toFixed(2);
    $("#"+row_id+ " .item_total").html(this_total);
    var row_tax_amount = this_total/100*row_tax_rate;
      tax_amount = parseFloat(tax_amount) + parseFloat(row_tax_amount);
      sub_total = parseFloat(sub_total) + parseFloat(this_total);

      if(this_module == 'purchase' || this_module == 'sale-return')
      {
        // do nothing for purchase
      }
      else{
        if(parseFloat(row_qty)>parseFloat(row_available_stock))
        {
            $(this).addClass('has-danger');
            alert('you dont have enough stock available for an item, if you procceed like this, it may cause problems calculating profit.');
        }else{
            $(this).removeClass('has-danger');
        }
      }

      if(lend_inventory=='on')
      {
//        console.log(row_id);
        var row_pure_id = row_id.replace('item_','');
//        console.log(row_pure_id);
        $('#new_lend_'+row_pure_id).val(row_qty);
      }
  });

  $("#product_total_qty").html(total_product_qty);
  if(total_product_qty>0)
  {
    $('#products_footer').show();
    $('#products_footer').removeClass('hide');
  }else{
    $('#products_footer').hide();
  }
  var services_total = update_services_total();

  sub_total = sub_total+services_total;

  var selected_contact_details=$("#contact_name").val();
  var old_amount=contacts_data[selected_contact_details]['balance'];
  var old_status=contacts_data[selected_contact_details]['status'];
  if(old_amount=='')
  {
    old_amount=0;
  }
  var new_amount = 0;
  var new_status = '';

  grand_total = (parseFloat(sub_total)+tax_amount) - parseFloat(discount);
  remaining_balance = parseFloat(grand_total) - parseFloat(amount_paid);


  if(this_module == 'purchase' || this_module == 'sale-return')
  {
    if(old_status=='credit' || old_status == 'payable')
    {
      new_status = 'payable';
      new_amount = parseFloat(old_amount) + parseFloat(remaining_balance);
    }else{
      if(old_amount >= remaining_balance )
      {
        new_status = 'receiveable';
        new_amount = parseFloat(old_amount) - parseFloat(remaining_balance);
      }else{
        new_status = 'payable';
        new_amount = parseFloat(remaining_balance) - parseFloat(old_amount);
      }
    }

  }else{

    if(old_status=='debit' || old_status == 'receiveable')
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
  }

  old_amount = parseFloat(old_amount).toFixed(2);
  new_amount = parseFloat(new_amount).toFixed(2);
  tax_amount = parseFloat(tax_amount).toFixed(2);
  sub_total = parseFloat(sub_total).toFixed(2);
  grand_total = parseFloat(grand_total).toFixed(2);
  remaining_balance = parseFloat(remaining_balance).toFixed(2);


  $('#old_balance_val').html(old_amount);
  $('#old_balance_status').html(old_status);

  $('#new_balance_val').html(new_amount);
  $('#new_balance_status').html(new_status);

  $("#sub_total").val(sub_total);
  $("#tax").val(tax_amount);
  $("#grand_total").val(grand_total);
  $("#remaining_balance").val(remaining_balance);

  show_invoice_details();

  get_lend_data(lend_inventory)


}

$(document).on('change','.this_secondary_qty',function(){
  var this_product_id = $(this).attr('data-item-id');

  var total_qty = 0;
  var this_qty = 0;
  var this_primary_unit_qty = '';

  $('#cart_items #item_'+this_product_id+' .this_secondary_qty').each(function (){

    this_secondary_qty = parseFloat($(this).val());
    this_primary_unit_qty = parseFloat($(this).attr('data-primary_unit_qty'));
    this_qty = this_secondary_qty*this_primary_unit_qty;
    total_qty = parseFloat(total_qty) + parseFloat(this_qty);
  });

  $('#item_'+this_product_id+" .item_qty").val(total_qty);
  update_cart_total(contacts_data);
});


$(document).on('change','.item_variant_qty',function(){
  var this_variant_id = $(this).closest(".item_variant").attr('id');
  var this_item_id = $(this).closest("tr").attr('id');
  var this_product_id = this_item_id.replace('item_','');

  var total_qty = 0;
  var this_qty = 0;
  $('#cart_items #item_'+this_product_id+' li input').each(function (){
    this_qty = $(this).val();
    total_qty = parseFloat(total_qty) + parseFloat(this_qty);
  });

  $('#item_'+this_product_id+" .item_qty").val(total_qty);
  update_cart_total(contacts_data);
});


$(document).on( "click", "#product_variants_modal #update_variants_with_secondary", function(e) {
  e.preventDefault();

  var total_qty=0;
  var qty_array = [];
  var secondary_variants_array =[];
  var html_content_vs = '';
  var this_product_id = $('#product_variants_modal .product_id').val();
  $('#item_'+this_product_id+" .variants_cart").html('');


    $('.variant_secondary_unit').each(function(){
      var this_secondary_name = $(this).attr('name');
      var this_secondary_qty = parseFloat($(this).val());
      var this_primary_qty = parseFloat($(this).attr('data-primary-unit-qty'));
      var this_variant_id = parseFloat($(this).attr('data-variant-id'));
      var this_qty_before = parseFloat($(this).attr('data-qty-before'));
      var this_variant_name = $(this).attr('data-variant-name');
      var this_variant_qty = 0;
      var this_qty = (parseFloat(this_secondary_qty)*parseFloat(this_primary_qty));

      this_secondary_name = this_secondary_name.replace('secondary_unit_','');


      if(this_secondary_qty>0)
      {
        if(secondary_variants_array.hasOwnProperty(this_variant_id)){

          secondary_variants_array[this_variant_id]['qty']=secondary_variants_array[this_variant_id]['qty']+this_qty;

        }else{
          secondary_variants_array[this_variant_id]={'name':this_variant_name, 'qty':this_qty, 'qty_before':this_qty_before};
        }
         var this_secondary_data = {'item':this_product_id,'variant_id':this_variant_id,'variant_name':this_variant_name,'secondary_unit':this_secondary_name,'secondary_unit_qty':this_secondary_qty,'primary_unit_qty':this_primary_qty,'this_net_qty':this_qty};
         qty_array.push(this_secondary_data);

//        qty_array[this_variant_id][]=(parseFloat(this_secondary_qty)*parseFloat(this_primary_qty));
        total_qty = parseFloat(total_qty) + (parseFloat(this_secondary_qty)*parseFloat(this_primary_qty));

      }
    });
    $('#item_'+this_product_id+' .secondary_cart').html('');

    $.each(secondary_variants_array, function(key, value)
    {
      if(typeof value != "undefined")
      {
//        $('#item_'+this_product_id+' .variants_cart').append('<li>'+value['name']+'</li>');
        $('#item_'+this_product_id+' .variants_cart').append('<li id="item_variant_'+key+'" data-variant_name="'+value['name']+'" data-variant-qty="'+value['qty']+'" data-qty-before="'+value['qty_before']+'" data-variant="'+key+'" class="list-group-item item_variant">'+value['name']+' <span class="item_variant_qty"> <input type="number" class="item_variant_qty form-control pull-right" value="'+value['qty']+'" readonly="readonly"></span></li>');
      }
    });

    $.each( qty_array, function( key, value ) {
      $('#item_'+value['item']+' .secondary_cart').append('<li id="item_variant_secondary_'+value['variant_id']+'" data-secondary_name="'+value['variant_name']+'" data-secondary_qty="'+value['secondary_unit_qty']+'" class="list-group-item item_variant_secondary_li">'+value['variant_name']+' <span class="this_secondary_qty_span"> '+value['secondary_unit_qty']+' '+value['secondary_unit']+' </span></li>');
    });
    total_qty = total_qty.toFixed(2);
  $('#item_'+this_product_id+" .item_qty").val(total_qty);
//  $('#item_'+this_product_id+" .item_qty").attr('readonly','readonly');
  $('#product_variants_modal').modal('hide');
  update_cart_total(contacts_data);
});

$(document).on( "click", "#product_variants_modal #update_secondary_units", function(e) {
  e.preventDefault();

  var total_qty=0;
  var this_product_id = $('#product_variants_modal .product_id').val();
  $('#item_'+this_product_id+" .variants_cart").html('');

  $('.secondary_unit').each(function(){
    var this_secondary_name = $(this).attr('name');
    var this_secondary_qty = parseFloat($(this).val());
    var this_primary_qty = parseFloat($(this).attr('data-primary-unit-qty'));
    var this_qty = (parseFloat(this_secondary_qty)*parseFloat(this_primary_qty));

    this_secondary_name = this_secondary_name.replace('secondary_unit_','');
    if(this_secondary_qty>0){
      total_qty = parseFloat(total_qty) + (parseFloat(this_secondary_qty)*parseFloat(this_primary_qty));
      if ( $( '#item_'+this_product_id+" .secondary_cart #item_secondary_"+this_secondary_name ).length ) {
           alert("variant id exists!!");
          // do nothing
      }else{
        $('#item_'+this_product_id+" .secondary_cart").append('<li id="item_secondary_'+this_secondary_name+'" data-secondary_name="'+this_secondary_name+'" data-secondary_qty="'+this_secondary_qty+'" class="list-group-item item_secondary_li">'+this_secondary_name+' <span class="this_secondary_qty_span"> <input type="number" data-primary_unit_qty="'+this_primary_qty+'" data-item-id="'+this_product_id+'" data-secondary_name="'+this_secondary_name+'" class="this_secondary_qty form-control pull-right" value="'+this_secondary_qty+'" /></span></li>');
      }

    }
  });
  total_qty = total_qty.toFixed(2);
  $('#item_'+this_product_id+" .item_qty").val(total_qty);
//  $('#item_'+this_product_id+" .item_qty").attr('readonly','readonly');
  $('#product_variants_modal').modal('hide');
  update_cart_total(contacts_data);

});


$(document).on( "click", "#product_variants_modal #update_variants", function() {
  var total_qty=0;
  var this_product_id = $('#product_variants_modal .product_id').val();
  $('#item_'+this_product_id+" .variants_cart").html('');

  $('.variant_qty').each(function(){
    var this_variant_id = $(this).attr('name');
    var this_variant_name = $(this).attr('data-variant-name');
    var this_variant_qty_before = $(this).attr('data-qty-before');
    var this_variant_qty = $(this).val();
    this_variant_id = this_variant_id.replace('variant_id_','');
    if(this_variant_qty>0){
      total_qty = parseFloat(total_qty) + parseFloat(this_variant_qty);
      if ( $( "#item_variant_"+this_variant_id ).length ) {
          // alert("variant id exists!!");
          // do nothing
      }else{
        $('#item_'+this_product_id+" .variants_cart").append('<li id="item_variant_'+this_variant_id+'" data-variant_name="'+this_variant_name+'"  data-qty-before="'+this_variant_qty_before+'"  data-variant="'+this_variant_id+'" class="list-group-item item_variant">'+this_variant_name+' <span class="item_variant_qty"> <input type="number" class="item_variant_qty form-control pull-right" value="'+this_variant_qty+'" /></span></li>');
      }

    }
  });

  $('#item_'+this_product_id+" .item_qty").val(total_qty);
//  $('#item_'+this_product_id+" .item_qty").attr('readonly','readonly');
  $('#product_variants_modal').modal('hide');
  update_cart_total(contacts_data);
});

$(document).on( "click", ".add_item_to_cart", function() {

  var this_id=$(this).attr('id');
  var this_unit=$(this).attr('data-unit');
  var item_tax=$(this).attr('data-tax-type');
  var item_variants_count=$(this).attr('data-variant_count');
  var item_variants_json=$(this).attr('data-variants-json');
  var item_secondary_units_count=$(this).attr('data-secondary_units_count');
  var item_secondary_units_json=$(this).attr('data-secondary-units-json');
  var item_tax_rate=$(this).attr('data-tax-rate');
  var attrs=this_id.split('_');
  var item_id=attrs[1];
  var item_name=attrs[2];
  var item_rate=attrs[attrs.length - 4];
  var avl_qty=attrs[attrs.length - 3];
  var unit_cost=attrs[attrs.length - 2];
  var unit_measure=attrs[attrs.length - 1];
  var row_str='<tr rel="'+avl_qty+'_'+unit_cost+'_'+unit_measure+'" data-available_stock="'+avl_qty+'" data-pname="'+item_name+'" id="item_'+item_id+'"><td class="hide sr">'+item_id+'</td><td class="name">'+item_name+'<ul class="variants_cart list-group"></ul><ul class="secondary_cart list-group"></ul></td><td class="tax_td">'+item_tax+' <span class="tax_rate">'+item_tax_rate+'</span>%</td><td class="unit_price"><input type="number" name="item_unitprice[]" value="'+item_rate+'" class="form-control item_rate" onchange="update_item_total('+item_id+')"></td><td class="unit">'+this_unit+'</td><td class="qty"><input type="number" name="item_qty[]" value="1" class="form-control item_qty"  onchange="update_item_total('+item_id+')"></td><td class="total">'+currency+' <span class="item_total">'+item_rate+'</span> <a href="#" rel="'+item_id+'" class="btn btn-danger btn-sm removeitem pull-right"><i class="ti-trash"></i></a><a href="#" rel="'+item_id+'" class="btn btn-info btn-sm item_history pull-right"><i class="ti-eye"></i></a></td></tr>';

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

  if(item_variants_count>0)
  {
    $('#product_variants_modal .modal-body .row').html('');
    if(item_secondary_units_count==0)
    {

      $('#product_variants_modal .product_name').html(item_name);
      $('#product_variants_modal .modal-body .row').html('');
      $('#product_variants_modal .product_id').val(item_id);

      var variants_array = item_variants_json.split("--,--");
      var counter = 1;
      $.each( variants_array, function( key, value ) {
        variant_holder = value.split("--:--");


        var html_content = '<div class="col-lg-4 col-md-6 select_variant" data-variant_id="'+variant_holder[2]+'"><div class="card"><div class="el-card-item"><div class="el-card-content" style="text-align:center;"><h3 class="box-title">'+variant_holder[0]+'</h3><p><small>Available Stock: '+variant_holder[1]+'</small></p><p><input type="number" name="variant_id_'+variant_holder[2]+'" value="'+counter+'" data-variant-name="'+variant_holder[0]+'" data-qty-before="'+variant_holder[1]+'" class="variant_qty form-control" /></p></div></div></div></div>';
        counter=0;
        $('#product_variants_modal .modal-body .row').append(html_content);
      });
      $(".submit_variants_btn").prop('id', 'update_variants');

    }else{
      $('#product_variants_modal .product_name').html(item_name);
      $('#product_variants_modal .modal-body .row').html('');
      $('#product_variants_modal .product_id').val(item_id);
      var variants_array='';

      variants_array = item_variants_json.split("--,--");
      var counter = 1;
      var units = JSON.parse(item_secondary_units_json);

      $.each( variants_array, function( key, value ) {
        variant_holder = value.split("--:--");

        var html_content = '<div class="col-12"><h3 class="box-title">'+variant_holder[0]+'</h3><p><small>Available Stock: '+variant_holder[1]+'</small></p></div>';


        $.each(units , function(index, unit) {

          html_content += '<div class="col-lg-4 col-md-6 select_units" data-units="'+unit.secondary_unit+'"><div class="card"><div class="el-card-item"><div class="el-card-content" style="text-align:center;"><h3 class="box-title">'+unit.secondary_unit+'</h3><p><small>1 '+unit.secondary_unit+'= '+unit.primary_unit_qty+' '+this_unit+'</small></p><p><input type="number" data-variant-id="'+variant_holder[2]+'" data-variant-name="'+variant_holder[0]+'" name="secondary_unit_'+unit.secondary_unit+'" value="'+counter+'" data-qty-before="'+variant_holder[1]+'" data-primary-unit-qty="'+unit.primary_unit_qty+'" class="variant_secondary_unit form-control" /></p></div></div></div></div>';
          counter=0;

        });

        html_content += '<div class="col-lg-4 col-md-6 select_units" data-units="'+this_unit+'"><div class="card"><div class="el-card-item"><div class="el-card-content" style="text-align:center;"><h3 class="box-title">'+this_unit+'</h3><p><small>1 '+this_unit+'= 1 '+this_unit+'</small></p><p><input type="number" name="secondary_unit_'+this_unit+'" value="'+counter+'" data-variant-id="'+variant_holder[2]+'"  data-variant-name="'+variant_holder[0]+'"  data-qty-before="'+variant_holder[1]+'" data-primary-unit-qty="1" class="variant_secondary_unit form-control" /></p></div></div></div></div>';

//        html_content += '</div></div></div></div></div>';


        $('#product_variants_modal .modal-body .row').append(html_content);
      });

      $(".submit_variants_btn").prop('id', 'update_variants_with_secondary');
    }

    $('#product_variants_modal').modal('show');
  }else if(item_secondary_units_count>0)
  {
    //    alert("this item has secondary units but no variants.");

    $('#product_variants_modal .modal-body .row').html('');
    var units = JSON.parse(item_secondary_units_json);
    var counter = 1;
    $('#product_variants_modal .product_id').val(item_id);

    $.each(units , function(index, unit) {

      var html_content = '<div class="col-lg-4 col-md-6 select_units" data-units="'+unit.secondary_unit+'"><div class="card"><div class="el-card-item"><div class="el-card-content" style="text-align:center;"><h3 class="box-title">'+unit.secondary_unit+'</h3><p><small>1 '+unit.secondary_unit+'= '+unit.primary_unit_qty+' '+this_unit+'</small></p><p><input type="number" name="secondary_unit_'+unit.secondary_unit+'" value="'+counter+'"  data-primary-unit-qty="'+unit.primary_unit_qty+'" class="secondary_unit form-control" /></p></div></div></div></div>';

      $('#product_variants_modal .modal-body .row').append(html_content);
      counter=0;

    });

    var html_content = '<div class="col-lg-4 col-md-6 select_units" data-units="'+this_unit+'"><div class="card"><div class="el-card-item"><div class="el-card-content" style="text-align:center;"><h3 class="box-title">'+this_unit+'</h3><p><small>1 '+this_unit+'= 1 '+this_unit+'</small></p><p><input type="number" name="secondary_unit_'+this_unit+'" value="'+counter+'"  data-primary-unit-qty="1" class="secondary_unit form-control" /></p></div></div></div></div>';

    $('#product_variants_modal .modal-body .row').append(html_content);

    $('#product_variants_modal').modal('show');
    $(".submit_variants_btn").prop('id', 'update_secondary_units');

  }else{
    $('#product_modal_btn').trigger('click');
  }

$(".item_qty:last-child").focus();

});

$("#amount_paid").change(function(){
  update_cart_total(contacts_data);
});

function get_lend_data(lend_inventory)
{
  var this_grand_total_lend_qty = 0;
//  alert('func call get lend data.');
//  alert(lend_inventory);
  $('.preloader').show();

  if(lend_inventory=='on')
  {
    $('.old_lended_qty').val(0);
    var cname = $('#contact_name').val();
   // alert(cname);
    var jqxhr = $.get( "t-get-lend-inventory-data.php?cname="+cname, function(response) {
     console.log(response);
      if(JSON.parse(response).length==0){
        $('.old_lended_qty').val(0);
      }else {
        $.each(JSON.parse(response), function(i, item) {
          // alert(parseFloat(item.grand_total_qty));


          if(parseFloat(item.grand_total_qty)>=0){
            this_grand_total_lend_qty = item.grand_total_qty;
          }
  //          alert(item.grand_total_qty);
            $('#old_lend_'+item.item_id).val(this_grand_total_lend_qty);
          });
      }
//      alert(response);
//      alert( "success" );
    })
      .done(function() {
//        alert( "second success" );
      })
      .fail(function() {
        alert( "error" );
      })
      .always(function() {
  //      alert( "finished" );
    $('.preloader').hide();
    update_lend_inventory();
      });

    // Perform other work here ...

    // Set another completion function for the request above
    jqxhr.always(function() {
//      alert( "second finished" );
    });
  }else {
    $('.preloader').hide();
  }

}


function process_invoice(post_url,invoice_url,shop_name,shop_phone,shop_address,currency)
{


    var data = $("#invoice_form").serialize();

    var location_id = '';
    var cname = $("#contact_name").val();
    var date = $("#datepicker-autoclose").val();
    var selected_date = $("#datepicker-autoclose").val();

    var days = ['Sun', 'Mon', 'Tues', 'Wed', 'Thur', 'Fri', 'Sat'];
    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul','Aug','Sep','Oct','Nov','Dec'];
    var d = new Date(selected_date);
    var getDayName = days[d.getDay()];
    var getDateNumber = d.getDate();
    var getMonthName = months[d.getMonth()];
    var getYear = d.getFullYear();

    var formated_date = getDayName+' '+getDateNumber+'-'+getMonthName+'-'+getYear;
    var sub_total = $("#sub_total").val();
    var discount = $("#discount").val();
    var tax = $("#tax").val();
    var grand_total = $("#grand_total").val();
    var amount_paid = $("#amount_paid").val();
    var payment_method = $("#payment_method").val();
    var payment_method_name = $( "#payment_method option:selected" ).text();
    var remaining_balance = $("#remaining_balance").val();
    location_id = $("#location_id").val();
    var notes = $("#notes").val();
    var secondary_html = [];

//    console.log('variables defined...');

    if(parseFloat(sub_total)>0)
    {
    }else{
      alert('You are not allowed to submit when sub total is less then 0...');
      $('.preloader').hide();
      $(this).attr('disabled',false);
      return false;
    }

//    console.log('sub_total is checked...');

    var cart_items = '[';
    var item_variants = '[';
    var print_table_body = '';
    var row_counter = 0;
    var print_products_total_qty = 0;
    var print_products_total_price = 0;
    var wa_products_list = '';

//    console.log('starting products loop...');

    $("#produutsincart tbody tr").each(function(){
      row_counter++;
      var row_id_=$(this).attr('id');
      var row_item_name_box = $(this).attr('data-pname');
      var row_base=$(this).attr('rel');
      var row_rate = $("#"+row_id_+ " .item_rate").val();
      var row_qty = $("#"+row_id_+ " .item_qty").val();
      $("#"+row_id_+ " .secondary_cart input").attr('readonly','readonly');
      var row_secondary_html = $("#"+row_id_+ " .secondary_cart").html();
      console.log(row_secondary_html);
      console.log(row_qty);
      var row_secondary_json = [];

        $("#"+row_id_+ " .secondary_cart input").each(function(e){
          var this_secondary_item_val = $(this).val();
          var this_secondary_name = $(this).attr('data-secondary_name');
          var data_primary_unit_qty = $(this).attr('data-primary_unit_qty');
          console.log(this_secondary_item_val);
          console.log(this_secondary_name);
          row_secondary_json.push({'this_secondary_name':this_secondary_name, 'this_secondary_item_val':this_secondary_item_val, 'data-primary_unit_qty':data_primary_unit_qty});
        });
      var row_variant_html = $("#"+row_id_+ " .variants_cart").html();

      print_products_total_qty = parseFloat(print_products_total_qty) + parseFloat(row_qty);
      print_products_total_price = print_products_total_price + (row_qty*row_rate);

      var attrs=row_id_.split('_');
      var bases=row_base.split('_');
      var row_id = attrs[1];
      var available_stock = bases[0];
      var purchase_cost = bases[1];
      var unit_measure = bases[2];

      var secondary_json = {'item_id':row_id, 'row_secondary_html':row_secondary_html, 'secondary_json':row_secondary_json, 'variant_html': row_variant_html};
      var print_table_variants_row='';
      var print_table_secondary_row='';
      secondary_html.push(secondary_json);

      cart_items += '{"item_id":"'+row_id+'","row_rate":"'+row_rate+'","row_qty":"'+row_qty+'","qty_before":"'+available_stock+'","cost_per_unit":"'+purchase_cost+'","unit_measure":"'+unit_measure+'"},';


      $('#'+row_id_+ " ul.variants_cart li").each(function(){
        var this_variant_id = $(this).attr('data-variant');
        var this_variant_name = $(this).attr('data-variant_name');
        var this_variant_qty = $("#item_variant_"+this_variant_id+" input").val();
        var this_variant_qty_before = $(this).attr('data-qty-before');
        item_variants += '{"item_id":"'+row_id+'","variant_id": "'+this_variant_id+'", "variant_qty": "'+this_variant_qty+'", "this_variant_qty_before": "'+this_variant_qty_before+'"},';
        print_table_variants_row+='<li>'+this_variant_name+' <span class="print_pull_right">'+this_variant_qty+'</span></li>';
      });

      $('#'+row_id_+ " ul.secondary_cart li").each(function(){
        var this_secondary_name = $(this).attr('data-secondary_name');
        var this_secondary_id = $(this).attr('id');
        var this_secondary_qty = $("#item_secondary_"+this_secondary_name+" input").val();

//        console.log(this_secondary_qty);

        if(this_secondary_qty==undefined)
        {
          var this_secondary_qty = $("#"+this_secondary_id+" span").text();
        }
        print_table_secondary_row+='<li>'+this_secondary_name+' <span class="print_pull_right">'+this_secondary_qty+'</span></li>';

//        console.log(print_table_secondary_row);
//        console.log(this_secondary_qty);
      });

        wa_products_list += row_item_name_box+"\n"+row_qty+" @ "+row_rate+"=       "+parseFloat((row_rate*row_qty)).toFixed(2)+" \n";
        print_table_body +='<tr><td>'+row_counter+'</td><td>'+row_item_name_box+' '+print_table_variants_row+' '+print_table_secondary_row+'</td><td class="print_number">'+parseFloat(row_qty).toFixed(2)+'</td><td class="tax_td"></td><td class="align_center">'+unit_measure+'</td><td class="print_number do_mode">'+parseFloat(row_rate).toFixed(2)+'</td><td class="print_number do_mode">'+parseFloat((row_rate*row_qty)).toFixed(2)+'</td></tr>';
      });

      console.log('secondary_html');
      console.log(secondary_html);

//      console.log('finished products loop...');


      if(cart_items!=='[')
      {
        cart_items = cart_items.slice(0,-1);
        wa_products_list += "- - - - - - - -\n";
       }
      cart_items += ']';

      item_variants = item_variants.slice(0,-1);
      item_variants += ']';

      var cart_items_services = '[';
      var print_services_tbody = '';
      var service_counter = 0;
      var print_services_total_qty = 0;
      var print_services_total_price = 0;
      var wa_services_list = '';

//      console.log('starting services loop...');



      $("#services_cart_items tr").each(function(){
        service_counter++;
        var service_row_id = $(this).attr('id');
        var service_row_name = $("#"+service_row_id+" td:first-child").text();
        var service_id = service_row_id.replace("row_service_", "");
        var this_service_sale_price = $("#"+service_row_id+" .sale_price").val();
        var this_service_qty = $("#"+service_row_id+" .service_qty").val();

        print_services_total_qty = parseFloat(print_services_total_qty) + parseFloat(this_service_qty);
        print_services_total_price = print_services_total_price + (this_service_sale_price*this_service_qty);

        cart_items_services += '{"service_id":"'+service_id+'","sale_price":"'+this_service_sale_price+'","qty":"'+this_service_sale_price+'","this_total":"'+(this_service_qty*this_service_sale_price)+'"},';

        wa_services_list+= service_row_name+" \n "+this_service_qty+" @ "+this_service_sale_price+"=       "+parseFloat((this_service_sale_price*this_service_qty)).toFixed(2)+" \n";
        print_services_tbody += '<tr><td>'+service_counter+'</td><td>'+service_row_name+'</td><td class="print_number do_mode">'+parseFloat(this_service_sale_price).toFixed(2)+'</td><td class="print_number">'+parseFloat(this_service_qty).toFixed(2)+'</td><td class="print_number do_mode">'+parseFloat((this_service_sale_price*this_service_qty)).toFixed(2)+'</td></tr>';
      });

//      console.log('finished services loop...');

      if(cart_items_services!=='[')
      {
        cart_items_services = cart_items_services.slice(0,-1);
      }
      cart_items_services += ']';

      var full_secondary_json = secondary_html.toString();

      var lend_inventory_json = '';


      if(lend_inventory=='on')
      {
        lend_inventory_json = '[';
        $(".lend_row").each(function(){
          var this_lend_id = $(this).attr('data-lendid');

          var this_old_lend_qty = parseFloat($('#old_lend_'+this_lend_id).val());
          var this_new_lend_qty = parseFloat($('#new_lend_'+this_lend_id).val());
          var this_total_lend_qty = parseFloat(this_old_lend_qty+this_new_lend_qty);
          var this_deposit_lend_qty = parseFloat($('#deposit_lend_'+this_lend_id).val());
          var this_grand_total_lend_qty = parseFloat(this_total_lend_qty-this_deposit_lend_qty);

          lend_inventory_json += '{"lend_id":"'+this_lend_id+'","old_lend_qty":"'+this_old_lend_qty+'","new_lend_qty":"'+this_new_lend_qty+'","total_lend_qty":"'+this_total_lend_qty+'","deposit_lend_qty":"'+this_deposit_lend_qty+'","grand_total_lend_qty":"'+this_grand_total_lend_qty+'"},';


        });
        if(lend_inventory_json!=='[')
        {
          lend_inventory_json = lend_inventory_json.slice(0,-1);

         }

        lend_inventory_json += ']';
//        alert('posting lend inventory...' + lend_inventory_json);
      }

//      console.log('going to post invoice...');
//      console.log(cart_items);

      $.post( post_url, { cart_items: cart_items, variants_json: item_variants, cname: cname, date: date, sub_total: sub_total, discount: discount, tax: tax, grand_total: grand_total, amount_paid: amount_paid, payment_method: payment_method, remaining_balance: remaining_balance, location_id: location_id, notes:notes, secondary_json: secondary_html, cart_items_services: cart_items_services, lend_inventory_json: lend_inventory_json })
      .done(function( data ) {

//        console.log(data);

        if($.isNumeric(data))
        {
//            console.log(data);
  //          alert(data);
            swal({
               title: 'Submited!',
               text: 'Record has been saved successfully.',
               timer: 2000,
               type: 'success',
               showConfirmButton: false
            });
            window.location = invoice_url+data;
  //                      window.location.reload();
        }else{
          console.log('not numeric 1');
          if($.isNumeric(data))
          {
            console.log(data);
  //          alert(data);
            swal({
               title: 'Error!',
               text: 'Some error occur while processing.',
               timer: 2000,
               type: 'error',
               showConfirmButton: false
            });
            // alert(data);

          }else{

            console.log('not numeric 2');
            if(isValidJSONString(data))
            {
              console.log('valid JSON');

              console.log('check pont 1 ');
              var this_lend_id = '74054';
              var this_old_lend_qty = parseFloat($('#old_lend_'+this_lend_id).val());
              console.log("this old id: #old_lend_"+this_lend_id);
              console.log("this old qty: "+this_old_lend_qty);

              var response = JSON.parse(data);
                if(pos_state==true)
                {
                  console.log('pos_state true');

                  $('#invoice_response_modal .invoice_id').html(response['msg']);

                  var print_customer_name = $.trim($('#select2-contact_name-container').attr('title'));
                  var print_name_parts = print_customer_name.split('(');
                  var print_customer_name = print_name_parts[0];
                  var old_remaining_balance = $('#old_balance_val').html();
                  var old_remaining_balance_status = $('#old_balance_status').html();
                  var total_remaining_balance = $('#new_balance_val').html();
                  var total_remaining_balance_status = $('#new_balance_status').html();
                  var msg_body = '';
                  var msg_body_detail = '';
                  var whatsapp_valid_phone = cname.replace('-','');
                  whatsapp_valid_phone = whatsapp_valid_phone.replace('+','');

                  var wa_invoice_msg = "Dear *"+print_customer_name.slice(0,-1)+ "* \n\nThis invoice total amount is *"+parseFloat(grand_total).toFixed(2)+"* \n\nReceipt No: "+response['msg']+" \nDate: "+response['date_time']+" \n\n=====================================\n\n"+wa_products_list+wa_services_list+"\n---------------------------\nSub Total: "+parseFloat(sub_total).toFixed(2)+"\nDiscount:       "+parseFloat(discount).toFixed(2)+"\nTax:       "+parseFloat(tax).toFixed(2)+"\n------------------------\nGrand Total:       *"+parseFloat(grand_total).toFixed(2)+"*\nPaid:       "+parseFloat(amount_paid).toFixed(2)+"\nRemaining:      "+parseFloat(remaining_balance).toFixed(2)+" \nPayment Method:       "+payment_method_name+"\n=====================================\nOld Balance:       "+old_remaining_balance+" "+old_remaining_balance_status+"\nNew Balance:       *"+total_remaining_balance+" "+total_remaining_balance_status+"* \n\n\n\n\n*"+shop_name+"*\nPhone: "+shop_phone+"\nAddress: "+shop_address+" \nSoftware By www.BasePlan.pk\nThank you for your business, Visit Again.";

                  var msg_start = "Dear "+print_customer_name+" \nThis invoice total amount is: "+parseFloat(grand_total).toFixed(2)+"\nReceipt: "+response['msg']+"\nDate: "+response['date_time']+" \n ================\n";

                  var msg_end = "Sub Total: "+parseFloat(sub_total).toFixed(2)+"\nDiscount:       "+parseFloat(discount).toFixed(2)+"\nTax:   "+parseFloat(tax).toFixed(2)+"\n------------------------\nGrand Total:       "+parseFloat(grand_total).toFixed(2)+"\nPaid:       "+parseFloat(amount_paid).toFixed(2)+"\nRemaining:      "+parseFloat(remaining_balance).toFixed(2)+"\nPayment Method:       "+payment_method_name+"\n=====================================\nOld Balance:       "+old_remaining_balance+" "+old_remaining_balance_status+"\nNew Balance:       "+total_remaining_balance+" "+total_remaining_balance_status+" \n\n\n "+shop_name;

                  var whatsapp_link = 'https://api.whatsapp.com/send?phone='+whatsapp_valid_phone+'&text='+encodeURI(wa_invoice_msg);
                  var sms_summary_link = 'sms://'+whatsapp_valid_phone+'/?&body='+encodeURI(msg_start+msg_end);
                  var sms_details_link = 'sms://'+whatsapp_valid_phone+'/?&body='+encodeURI(msg_start+wa_products_list+wa_services_list+msg_end);


                  console.log('check pont 2 ');
                  var this_lend_id = '74054';
                  var this_old_lend_qty = parseFloat($('#old_lend_'+this_lend_id).val());
                  console.log("this old id: #old_lend_"+this_lend_id);
                  console.log("this old qty: "+this_old_lend_qty);

                  $(".print_customer_name").html(print_customer_name);
                  $(".print_customer_phone").html(cname);
                  $(".print_invoice_date").html(formated_date);
                  $(".print_invoice_no").html(response['msg']);
                  $("#print_sub_total").html(parseFloat(sub_total).toFixed(2));
                  $("#print_discount").html(parseFloat(discount).toFixed(2));
                  $("#print_tax").html(parseFloat(tax).toFixed(2));
                  $("#print_grand_total").html(parseFloat(grand_total).toFixed(2));
                  $("#print_payment_method").html(payment_method_name);
                  $("#print_amount_recieived").html(parseFloat(amount_paid).toFixed(2));
                  $("#print_invoice_balance").html(parseFloat(remaining_balance).toFixed(2));
                  $("#print_old_balance").html(old_remaining_balance+' '+old_remaining_balance_status);
                  $("#print_total_balance").html(total_remaining_balance+' '+total_remaining_balance_status);
                  $("#print_notes").html(notes);

                  $('#print_items_total_qty').html(parseFloat(print_products_total_qty).toFixed(2));
                  $('#print_items_total_price').html(parseFloat(print_products_total_price).toFixed(2));
                  $('#services_total_qty').html(parseFloat(print_services_total_qty).toFixed(2));
                  $('#services_total_price').html(parseFloat(print_services_total_price).toFixed(2));

                  $('#print_products tbody').html(print_table_body);
                  $("#print_services tbody").html(print_services_tbody);

                  console.log('check pont 3 ');
                  var this_lend_id = '74054';
                  var this_old_lend_qty = parseFloat($('#old_lend_'+this_lend_id).val());
                  console.log("this old id: #old_lend_"+this_lend_id);
                  console.log("this old qty: "+this_old_lend_qty);


                  if(service_counter==0)
                  {
                    $('#print_services').hide();
                  }else{
                    $('#print_services').show();
                  }
                  if(row_counter==0)
                  {
                    $('#print_products').hide();
                  }else{
                    $('#print_products').show();
                  }

                  if(lend_inventory=='on')
                  {
                    var html_print_lend_inventory = '<h3>Lended Items</h3><table class="table table-bordered full-color-table hover-table" id="print_lend_inventory_table"><thead><tr><th>Item</th><th>Old Qty</th><th>New Qty</th><th>Total Qty</th><th>Deposit Qty</th><th>Total Lend Qty</th></tr></thead><tbody id="print_lend_inventory_cart_items">';

                    console.log('check pont 7 ');
                    var this_lend_id = '74054';
                    var this_old_lend_qty = parseFloat($('#old_lend_'+this_lend_id).val());
                    console.log("this old id: #old_lend_"+this_lend_id);
                    console.log("this old qty: "+this_old_lend_qty);


                    $(".lend_row").each(function(){


                      var this_lend_id = $(this).attr('data-lendid');
                      var this_lend_name = $(this).attr('data-lendname');

                      var this_old_lend_qty = parseFloat($('#old_lend_'+this_lend_id).val());
                      console.log("this old id: #old_lend_"+this_lend_id);
                      console.log("this old qty: "+this_old_lend_qty);
                      var this_new_lend_qty = parseFloat($('#new_lend_'+this_lend_id).val());
                      var this_total_lend_qty = parseFloat(this_old_lend_qty+this_new_lend_qty);
                      $('#total_lend_'+this_lend_id).val(this_total_lend_qty);
                      var this_deposit_lend_qty = parseFloat($('#deposit_lend_'+this_lend_id).val());
                      var this_grand_total_lend_qty = parseFloat(this_total_lend_qty-this_deposit_lend_qty);
                      $('#grand_total_lend_'+this_lend_id).val(this_grand_total_lend_qty);

                      html_print_lend_inventory+='<tr><td>'+this_lend_name+'</td><td>'+this_old_lend_qty+'</td><td>'+this_new_lend_qty+'</td><td>'+this_total_lend_qty+'</td><td>'+this_deposit_lend_qty+'</td><td>'+this_grand_total_lend_qty+'</td></tr>';

                    });

                    html_print_lend_inventory+='</tbody></table>';

                    $("#print_lend_inventory").html(html_print_lend_inventory);
                  }
                  console.log('check pont 4 ');
                  var this_lend_id = '74054';
                  var this_old_lend_qty = parseFloat($('#old_lend_'+this_lend_id).val());
                  console.log("this old id: #old_lend_"+this_lend_id);
                  console.log("this old qty: "+this_old_lend_qty);

                  $('.invoice_link').attr('href',invoice_url+response['msg']);
                  $('.whatsapp_link').attr('href',whatsapp_link);
                  $('.sms_summary').attr('href',sms_summary_link);
                  $('.sms_details').attr('href',sms_details_link);

                  console.log('check pont 5 ');
                  var this_lend_id = '74054';
                  var this_old_lend_qty = parseFloat($('#old_lend_'+this_lend_id).val());
                  console.log("this old id: #old_lend_"+this_lend_id);
                  console.log("this old qty: "+this_old_lend_qty);



                  // reset formdata
                  $('#contact_name').val('+0000').trigger('change');
                  $('#invoice_form #produutsincart tbody').html('');
                  $('#invoice_form #services_in_cart tbody').html('');
                  $('#notes').val('');
                  $('#amount_paid').val(0);
                  $('#discount').val(0);
                  $('#discount_percentage').val(0);
                  $('#old_balance_val').html('');
                  $('#old_balance_status').html('');
                  update_cart_total(contacts_data);
                  contacts_data[cname]={balance:total_remaining_balance,status:total_remaining_balance_status};


                  console.log('check pont 6 ');
                  var this_lend_id = '74054';
                  var this_old_lend_qty = parseFloat($('#old_lend_'+this_lend_id).val());
                  console.log("this old id: #old_lend_"+this_lend_id);
                  console.log("this old qty: "+this_old_lend_qty);



                  $('.lended_item').val('0');
                  $('#invoice_response_modal').modal('show');
                  $('.preloader').hide();
                }else{
                  window.location = invoice_url+response['msg'];
                  console.log('pos_state false');

                }
            }
            else
            {
              console.log('invalid JSON');

              console.log(data);
    //          alert(data);
              swal({
                 title: 'Error!',
                 text: 'Some error occur while processing.',
                 timer: 2000,
                 type: 'error',
                 showConfirmButton: false
              });
              // alert(data);
            }
          }
        }
      }).fail(function() {
          alert( "error" );
        });

      if(post_url=='t-quote.process.php')
      {
        $("#sale_invoice_label").text('Sales Quotation');
      }else if(this_module=='purchase')
      {
        $("#sale_invoice_label").text('Purchase Invoice');
      }
      else
      {
        $("#sale_invoice_label").text('Sale Invoice');
      }

    return false;

}

$("#submitbtn").click(function(e){
  e.preventDefault();
  $('.preloader').show();
  $(this).attr('disabled',true);
  process_invoice(post_url,invoice_url,shop_name,shop_phone,shop_address,currency);
});

$("#quotebtn").click(function(e){
  e.preventDefault();
  $('.preloader').show();
  $(this).attr('disabled',true);
  process_invoice(quote_post_url,quote_url,shop_name,shop_phone,shop_address,currency);
});

$("#contact_name").change(function(e){
  update_cart_total(contacts_data);
  get_lend_data(lend_inventory);
});

$('#product_search_box').keyup(function(e){
  var key = $(this).val();

  if(key.length>1)
  {
    $('.add_item_to_cart').hide();
    $("[rel*='"+key+"']").show();
    $('.add_item_to_cart').attr('accesskey','');
  }else{
    $('.add_item_to_cart').show();
  }

  var key_counter = 1;
  $(".add_item_to_cart").each(function(){
    if($(this).is(":visible"))
    {
      $(this).attr('accesskey',key_counter);
      key_counter++;
    }
  });

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

$("#discount").keyup(function(e){
  var discount = $(this).val();
  var sub_total = $('#sub_total').val();

  discount=parseFloat(discount);
  sub_total=parseFloat(sub_total);

  if(discount<0)
  {
    discount=0;
    $('#discount').val(discount);
    alert('Discount amount can not be less then 0');
  }else if(discount > sub_total)
  {
    discount=sub_total;
    $('#discount').val(discount);
    alert('Discount amount can not be more then sub_total');
  }

  var discount_percentage = (discount*100)/sub_total;
  discount_percentage = parseFloat(discount_percentage).toFixed(2);
  $("#discount_percentage").val(discount_percentage);
  update_cart_total(contacts_data);

});


$('#discount_percentage').keyup(function(e){
  var discount_percentage = $(this).val();
  var sub_total = $('#sub_total').val();

  discount_percentage=parseFloat(discount_percentage);
  sub_total=parseFloat(sub_total);

  if(discount_percentage<0)
  {
    discount_percentage = 0;
    $('#discount_percentage').val(discount_percentage);
    alert('Discount Percentage cannot be less then 0.' );
  }else if(discount_percentage>100)
  {
    discount_percentage = 100;
    $('#discount_percentage').val(discount_percentage);
    alert('Discount Percentage cannot be more then 100.' );
  }
  var discount = (sub_total/100)*discount_percentage;
  discount = parseFloat(discount).toFixed(2);
  $("#discount").val(discount);
  update_cart_total(contacts_data);
});

function add_services_to_cart(service_id)
{
  var service_price = $("#"+service_id).attr('data-price');
  var service_name = $("#"+service_id).attr('data-name');

  var row_html = '<tr id="row_'+service_id+'"><td>'+service_name+'</td><td><input type="number" class="form-control sale_price" value="'+service_price+'" /></td><td><input type="number" class="form-control service_qty" value="1" /></td><td>'+currency+' <span class="service_row_total">'+service_price+'</span><a href="#" rel="'+service_id+'" class="btn btn-danger btn-sm remove_service pull-right"><i class="ti-trash"></i></a></td></tr>';

  var service_count = $('#services_cart_items #row_'+service_id).length;
  if(service_count>0)
  {
  }else{
    $('#services_cart_items').append(row_html);

  }
    $('#services_modal').modal('hide');

  update_cart_total(contacts_data);
}

$(document).on('click','.remove_service',function(e){
  e.preventDefault();

  var service_id = $(this).attr('rel');
  $('#row_'+service_id).remove();
  return false;
  update_cart_total(contacts_data);
});

function update_lend_inventory(){
  $(".lend_row").each(function(){
    var this_lend_id = $(this).attr('data-lendid');

    var this_old_lend_qty = parseFloat($('#old_lend_'+this_lend_id).val());
    var this_new_lend_qty = parseFloat($('#new_lend_'+this_lend_id).val());
    var this_total_lend_qty = parseFloat(this_old_lend_qty+this_new_lend_qty);
    $('#total_lend_'+this_lend_id).val(this_total_lend_qty);
    var this_deposit_lend_qty = parseFloat($('#deposit_lend_'+this_lend_id).val());
    var this_grand_total_lend_qty = parseFloat(this_total_lend_qty-this_deposit_lend_qty);
    $('#grand_total_lend_'+this_lend_id).val(this_grand_total_lend_qty);
  });
}

function update_services_total()
{
  var services_total = 0;
  var services_total_qty = 0;

  var tr_count = $('#services_cart_items tr').length;

  if(tr_count>0)
  {
    $('#services_in_cart').removeClass('hide');
    $('#services_in_cart').show();
  }else{
     $("#services_in_cart").hide();
  }

  var row_qty = 0;
  var row_price = 0;
  var row_total = 0;
  var services_total = 0;
  $("#services_cart_items tr").each(function(){

    var service_row_id = $(this).attr('id');

    row_qty = $("#"+service_row_id+" .service_qty").val();
    row_price = $("#"+service_row_id+" .sale_price").val();

    row_total = parseFloat(row_qty)*parseFloat(row_price);
    row_total = row_total.toFixed(2);
    $("#"+service_row_id+" .service_row_total").html(row_total);
    services_total += parseFloat(row_total);
    services_total_qty = services_total_qty + parseFloat(row_qty);
  });
  $('#services_total_qty').html(services_total_qty);
  return services_total;
}

$(document).on('change','#services_in_cart .form-control',function(e){
   update_cart_total(contacts_data);
});
$(document).on('click','.item_history',function(e){
  e.preventDefault();
  var item_id = $(this).attr('rel');
  view_item_history(item_id);
});

$(document).on('change','.lended_item',function(e){
    update_lend_inventory();
});
$(document).on('click','.add_services_to_cart',function(e)
{
  var service_id = $(this).attr('id');
  add_services_to_cart(service_id);
});

$(document).on('click','.delivery_mode',function(e)
{
  e.preventDefault();
  $('.do_mode').toggle();
});

$('#product_modal').on('shown.bs.modal', function () {
    $('#product_search_box').focus();
});

$('#contact_modal').on('shown.bs.modal', function () {
    $('#name').focus();
});



get_lend_data(lend_inventory);
