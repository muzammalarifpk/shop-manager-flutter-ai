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

  $("#produutsincart tbody tr").each(function(){
    var row_id=$(this).attr('id');
    var row_tax_type=$(this).attr('data-tax-type');
    var row_rate = $("#"+row_id+ " .item_rate").val();
    var row_tax_rate = $("#"+row_id+ " .tax_rate").html();
    var row_qty = $("#"+row_id+ " .item_qty").val();
    var this_total = parseFloat(row_rate) * parseFloat(row_qty);
    this_total =  this_total.toFixed(2);
    $("#"+row_id+ " .item_total").html(this_total);
    var row_tax_amount = this_total/100*row_tax_rate;
      tax_amount = parseFloat(tax_amount) + parseFloat(row_tax_amount);
      sub_total = parseFloat(sub_total) + parseFloat(this_total);

  });


  var selected_contact_details=$("#contact_name").val();
  var old_amount=contacts_data[selected_contact_details]['balance'];
  var old_status=contacts_data[selected_contact_details]['status'];

  var new_amount = 0;
  var new_status = '';

  grand_total = (parseFloat(sub_total)+tax_amount) - parseFloat(discount);
  remaining_balance = parseFloat(grand_total) - parseFloat(amount_paid);


  if(this_module == 'purchase' || this_module == 'sale_return')
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
        $('#item_'+this_product_id+' .variants_cart').append('<li id="item_variant_'+key+'" data-qty-before="'+value['qty_before']+'" data-variant="'+key+'" class="list-group-item item_variant">'+value['name']+' <span class="item_variant_qty"> <input type="number" class="item_variant_qty form-control pull-right" value="'+value['qty']+'" readonly="readonly"></span></li>');
      }
    });

    $.each( qty_array, function( key, value ) {
      $('#item_'+value['item']+' .secondary_cart').append('<li id="item_variant_secondary_'+value['variant_id']+'" class="list-group-item item_variant_secondary_li">'+value['variant_name']+' <span class="this_secondary_qty_span"> '+value['secondary_unit_qty']+' '+value['secondary_unit']+' </span></li>');
    });
    total_qty = total_qty.toFixed(2);
  $('#item_'+this_product_id+" .item_qty").val(total_qty);
  $('#item_'+this_product_id+" .item_qty").attr('readonly','readonly');
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
      if ( $( "#item_secondary_"+this_secondary_name ).length ) {
          // alert("variant id exists!!");
          // do nothing
      }else{
        $('#item_'+this_product_id+" .secondary_cart").append('<li id="item_secondary_'+this_secondary_name+'" class="list-group-item item_secondary_li">'+this_secondary_name+' <span class="this_secondary_qty_span"> <input type="number" data-primary_unit_qty="'+this_primary_qty+'" data-item-id="'+this_product_id+'" class="this_secondary_qty form-control pull-right" value="'+this_secondary_qty+'" /></span></li>');
      }

    }
  });
  total_qty = total_qty.toFixed(2);
  $('#item_'+this_product_id+" .item_qty").val(total_qty);
  $('#item_'+this_product_id+" .item_qty").attr('readonly','readonly');
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
        $('#item_'+this_product_id+" .variants_cart").append('<li id="item_variant_'+this_variant_id+'"  data-qty-before="'+this_variant_qty_before+'"  data-variant="'+this_variant_id+'" class="list-group-item item_variant">'+this_variant_name+' <span class="item_variant_qty"> <input type="number" class="item_variant_qty form-control pull-right" value="'+this_variant_qty+'" /></span></li>');
      }

    }
  });

  $('#item_'+this_product_id+" .item_qty").val(total_qty);
  $('#item_'+this_product_id+" .item_qty").attr('readonly','readonly');
  $('#product_variants_modal').modal('hide');
  update_cart_total(contacts_data);
});

$(".add_item_to_cart").click(function(e){
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

  var row_str='<tr rel="'+avl_qty+'_'+unit_cost+'_'+unit_measure+'" id="item_'+item_id+'"><td class="hide sr">'+item_id+'</td><td class="name">'+item_name+'<ul class="variants_cart list-group"></ul><ul class="secondary_cart list-group"></ul></td><td class="tax_td">'+item_tax+' <span class="tax_rate">'+item_tax_rate+'</span>%</td><td class="unit_price"><input type="number" name="item_unitprice[]" value="'+item_rate+'" class="form-control item_rate" onchange="update_item_total('+item_id+')"></td><td class="unit">'+this_unit+'</td><td class="qty"><input type="number" name="item_qty[]" value="1" class="form-control item_qty"  onchange="update_item_total('+item_id+')"></td><td class="total">'+currency+' <span class="item_total">'+item_rate+'</span> <a href="#" rel="'+item_id+'" class="btn btn-danger btn-sm removeitem pull-right"><i class="ti-trash"></i></a></td></tr>';

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

  }


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
    var custom_field = $("#custom_field").val();
    var tax = $("#tax").val();
    var grand_total = $("#grand_total").val();
    var amount_paid = $("#amount_paid").val();
    var payment_method = $("#payment_method").val();
    var remaining_balance = $("#remaining_balance").val();
    var notes = $("#notes").val();
    var secondary_html = [];

    if(parseFloat(sub_total)>0)
    {
    }else{
      alert('You are not allowed to submit when sub total is less then 0...');
      $('.preloader').hide();
      $(this).attr('disabled',false);
      return false;
    }

    var cart_items = '[';
    var item_variants = '[';

    $("#produutsincart tbody tr").each(function(){
      var row_id_=$(this).attr('id');
      var row_base=$(this).attr('rel');
      var row_rate = $("#"+row_id_+ " .item_rate").val();
      var row_qty = $("#"+row_id_+ " .item_qty").val();
      $("#"+row_id_+ " .secondary_cart input").attr('readonly','readonly');
      var row_secondary_html = $("#"+row_id_+ " .secondary_cart").html();
      var row_variant_html = $("#"+row_id_+ " .variants_cart").html();

      var attrs=row_id_.split('_');
      var bases=row_base.split('_');
      var row_id = attrs[1];
      var available_stock = bases[0];
      var purchase_cost = bases[1];
      var unit_measure = bases[2];

      var secondary_json = {'item_id':row_id, 'secondary_html':row_secondary_html, 'variant_html': row_variant_html};

      secondary_html.push(secondary_json);

      cart_items += '{"item_id":"'+row_id+'","row_rate":"'+row_rate+'","row_qty":"'+row_qty+'","qty_before":"'+available_stock+'","cost_per_unit":"'+purchase_cost+'","unit_measure":"'+unit_measure+'"},';

        $('#'+row_id_+ " ul.variants_cart li").each(function(){
          var this_variant_id = $(this).attr('data-variant');
          var this_variant_qty = $("#item_variant_"+this_variant_id+" input").val();
          var this_variant_qty_before = $(this).attr('data-qty-before');
          item_variants += '{"item_id":"'+row_id+'","variant_id": "'+this_variant_id+'", "variant_qty": "'+this_variant_qty+'", "this_variant_qty_before": "'+this_variant_qty_before+'"},';
        });

      });

      cart_items = cart_items.slice(0,-1);
      cart_items += ']';

      item_variants = item_variants.slice(0,-1);
      item_variants += ']';

      var full_secondary_json = secondary_html.toString();

      $.post( post_url, { cart_items: cart_items, variants_json: item_variants, cname: cname, date: date, sub_total: sub_total, discount: discount, tax: tax, grand_total: grand_total, amount_paid: amount_paid, payment_method: payment_method, remaining_balance: remaining_balance,  custom_field: custom_field, notes:notes, secondary_json: secondary_html })
      .done(function( data ) {
        if(data == 'error')
        {
          alert('Some error while processing invoice.');
        }else{
          console.log(data);
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
