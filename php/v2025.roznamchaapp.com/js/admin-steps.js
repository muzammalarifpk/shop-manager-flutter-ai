$(".tab-wizard").steps({
    headerTag: "h6",
    bodyTag: "section",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: "Submit"
    },
    onFinished: function (event, currentIndex) {
        var form = $(this);
        // Submit form input
        form.submit();
    }
});


var form = $(".validation-wizard").show();

$(".validation-wizard").steps({
    headerTag: "h6"
    , bodyTag: "section"
    , transitionEffect: "fade"
    , titleTemplate: '<span class="step">#index#</span> #title#'
    , labels: {
        finish: "Submit"
    }
    , onStepChanging: function (event, currentIndex, newIndex) {
        return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid())
    }
    , onFinishing: function (event, currentIndex) {
        return form.validate().settings.ignore = ":disabled", form.valid()
    }
    , onFinished: function (event, currentIndex) {
        var formaction=$('.validation-wizard').attr('action');
        var urlpost='admin-new-process.php';
        var reqid=$('.validation-wizard').attr('rel');


        if(formaction=='update')
        {
          urlpost='admin-new-process.php?reqid='+reqid;
        }
//        alert(urlpost);
        $.ajax({
                    type:'POST',
                    url:urlpost,
                    data:form.serialize(),
                    success:function(msg){
                        //alert(msg);
                        if(msg == 'success'){
                          $(".validation-wizard input").val('');
                          $(".validation-wizard checkbox").val('');
                          $(".validation-wizard select").val('');
                          $(".validation-wizard textarea").val('');
                          $("#msgholder").html('');
                          $("#msgholder").addClass('d-none');

                            var tlbdata=new Array();

/*                            tlbdata['name']='new name';
                            tlbdata['phone']='123456789';
                            tlbdata['email']='hello@email.com';
                            tlbdata['access']='any';
                            tlbdata['status']='active';
                            tlbdata['actionid']='hello';

                            //('name':'name value','phone':'phone number','email':'emailaddress','access':'*','status':'active','id':'22');

                            var nname1='safa miss';
                            var nname2='safa miss';
                            var nname3='safa miss';
                            var nname4='safa miss';
                            var nname5='safa miss';
                            var nname6='safa miss';

                          loadtdata(nname1,nname2,nname3,nname4,nname5,nname6);


*/
                          $('#responsive-modal').modal('hide');

                          if(formaction=='update')
                          {
                            swal({
                               title: 'Updated!',
                               text: 'Record has been updated successfully.',
                               timer: 2000,
                               type: 'success',
                               showConfirmButton: false
                            });
                          }else{
                            location.reload();
                            swal({
                               title: 'Submited!',
                               text: 'Record has been added successfully.',
                               timer: 2000,
                               type: 'success',
                               showConfirmButton: false
                            });
                          }
                  //


                        }else{
                            $("#msgholder").html(msg);
                            $("#msgholder").removeClass('d-none');
                        }
                        $('.submitBtn').removeAttr("disabled");
                        $('.modal-body').css('opacity', '');
                    }
                });



    }
}), $(".validation-wizard").validate({
    ignore: "input[type=hidden]"
    , errorClass: "text-danger"
    , successClass: "text-success"
    , highlight: function (element, errorClass) {
        $(element).removeClass(errorClass)
    }
    , unhighlight: function (element, errorClass) {
        $(element).removeClass(errorClass)
    }
    , errorPlacement: function (error, element) {
        error.insertAfter(element)
    }
    , rules: {
        email: {
            email: !0
        }
    }
})
