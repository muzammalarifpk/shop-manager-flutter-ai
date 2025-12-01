<?php
  require_once("app-chat.config.php");
  require_once("includes/head.php");
  require_once("includes/libs/form.cls.php");
  require_once("includes/libs/table.cls.php");
?>
    <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Chats</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item">Apps</li>
                        <li class="breadcrumb-item active">Chats</li>
                    </ol>
                </div>
                <div class="">
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">

                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-0">
                            <!-- .chat-row -->
                            <div class="chat-main-box">
                                <!-- .chat-left-panel -->
                                <div class="chat-left-aside">
                                    <div class="open-panel"><i class="ti-angle-right"></i></div>
                                    <div class="chat-left-inner">
                                        <div class="form-material">
                                            <input class="form-control p-20" type="text" placeholder="Search Contact">
                                        </div>
                                        <ul class="chatonline style-none ">

                                          <li>
                                              <a id="c_92-3434123489" href="javascript:void(0)"><span class="label label-rouded label-info pull-right" style="color:#fff;">0</span><img src="../assets/images/logo-icon.png" alt="user-img" class="img-circle"> <span>BasePlan Helpline <br /> (+92-3434123489)</span></a>
                                          </li>
                                          <?php
                                          $contacts_query="select * from `contacts` where `owner_mobile`='$_SESSION[sess_bp_username]'";
                                          foreach ($db->query($contacts_query) as $row)
                                          {
                                            $number=$row['number'];
                                            $number=str_replace('+','',$number);
                                        //    $number=str_replace('-','',$number);
                                           ?>
                                           <li>
                                               <a id="c_<?=$number?>" href="javascript:void(0)"><img src="../assets/images/users/1.jpg" alt="user-img" class="img-circle"> <span><?=$row['name']?> <br />(+<?=$number?>)</span></a>
                                           </li>
                                          <?php
                                            }

                                           ?>
                                            <li class="p-20"></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- .chat-left-panel -->
                                <!-- .chat-right-panel -->
                                <div class="chat-right-aside">
                                    <div class="chat-main-header">
                                        <div class="p-20 b-b">
                                            <h3 class="box-title">Chat Message</h3>
                                        </div>
                                    </div>
                                    <div class="chat-rbox">
                                        <ul class="chat-list p-20">
                                            <!--chat Row -->
                                        </ul>
                                    </div>
                                    <div class="card-body b-t">
                                        <div class="row">
                                            <div class="col-8">
                                                <input type="hidden" class="form-control" name="active_chat" id="active_chat" value="">
                                                <textarea placeholder="Type your message here" class="form-control b-0" id="chat_msg"></textarea>
                                            </div>
                                            <div class="col-4 text-right">
                                                <button type="button" class="btn btn-info btn-circle btn-lg submit_chat"><i class="fa fa-paper-plane-o"></i> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- .chat-right-panel -->
                            </div>
                            <!-- /.chat-row -->
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <?php require_once("includes/right.php"); ?>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer"><?=$footer_note?></footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <?php
          require_once("includes/footer.php");
          echo $meta['footer']['script'];
        ?>
        <script>

        function load_chat(this_contact)
        {
          $('.chat-list').html('loading chat...');
          $.post( "app-load_chat.php", { to_chat: this_contact})
            .done(function( data ) {
              $('.chat-list').html('');
              $('.chat-list').append(data);
              $('.chat-list').animate({scrollTop: $('.chat-list')[0].scrollHeight}, 1000);
            }).fail(function() {
              alert( "error" );
            })
            .always(function() {
              $("#chat_msg").val('');
            });
        }

        function check_messages()
        {
//          var this_contact = '3434123489';
          var this_contact=$('#active_chat').val();
          $.post( "app-check_chat.php", { to_chat: this_contact})
            .done(function( data ) {
              var chats = JSON.parse(data);
              $('.chatonline a span.label').remove();
              chats.forEach(function(item)
                  {
                    var contact=item.to_contact;
                    var count=item.count;

                    $('#'+contact).prepend('<span class="label label-rouded label-info pull-right" style="color:#fff;">'+count+'</span>');
                  });
            }).fail(function() {
              alert( "error" );
            })
            .always(function() {
            });

        }

        function load_messages()
        {
          var this_contact=$('#active_chat').val();
          $.post( "app-load_messages.php", { to_chat: this_contact})
            .done(function( data ) {
              $('.chat-list').append(data);
              $('.chat-list').animate({scrollTop: $('.chat-list')[0].scrollHeight}, 500);
            }).fail(function() {
              alert( "error" );
            })
            .always(function() {
            });
        }

        function onchange_chat(this_contact)
        {
          $('.chatonline li a').removeClass('active');

          $("#"+this_contact).addClass('active');
          $('#active_chat').val(this_contact);

          $('.chat-list').html('');
          load_chat(this_contact);
        }

        function send_chat()
        {
          var to_chat = $('#active_chat').val();
          var chat_msg = $('#chat_msg').val();

          if(chat_msg.length>0 && to_chat.length>0)
          {
            $.post( "app-send_chat.php", { to_chat: to_chat, chat_msg: chat_msg })
              .done(function( data ) {
                $('.chat-list').append('<li class="reverse"><div class="chat-content"><div class="box bg-light-inverse">'+chat_msg+'</div></div><div class="chat-time">10:57 am</div></li>');
                $('.chat-list').animate({scrollTop: $('.chat-list')[0].scrollHeight}, 500);
              }).fail(function() {
                alert( "error" );
              })
              .always(function() {
                $("#chat_msg").val('');
              });
          }
        }

        $(document).on('click','.chatonline li a',function(e){
          var this_contact=$(this).attr('id');
          onchange_chat(this_contact);
        });

        $(document).on('click','.submit_chat',function(e){
          send_chat();
        });

        $(document).ready(function(){
          setInterval(function(){
            load_messages();
          }, 3000);
          setInterval(function(){
            check_messages();
          }, 7000);

        });

      </script>
      </body>
      </html>
