<div id="video_modal_div" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Video Guide</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
    <div class="modal-body">

<?php
$videos[] = array('module'=>'intro','name'=>'1. Intro', 'video_url'=>'https://www.youtube.com/embed/4US1c6o4pQk');
$videos[] = array('module'=>'products','name'=>'2. Products', 'video_url'=>'https://www.youtube.com/embed/koa8ROw9Bqg');
$videos[] = array('module'=>'contacts','name'=>'3. Customer and Supplier Accounts', 'video_url'=>'https://www.youtube.com/embed/dH_gm4QcBAY');
$videos[] = array('module'=>'expense','name'=>'4. Expense', 'video_url'=>'https://www.youtube.com/embed/vDAwvN0IcHQ');
$videos[] = array('module'=>'sale_purchase','name'=>'5. Sales and Purchase', 'video_url'=>'https://www.youtube.com/embed/3O91_ASbZOw');
$videos[] = array('module'=>'payments','name'=>'6. Payments', 'video_url'=>'https://www.youtube.com/embed/xlsjxqh-T80');

 ?>

      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                  <h6 class="card-subtitle"></h6>
                  <div id="accordion1" role="tablist" aria-multiselectable="true">
                    <?php
                      foreach ($videos as $key => $value) {

                        // Show videos...
                        ?>
                      <div class="card m-b-0">
                          <div class="card-header" role="tab" id="heading<?=$key+1?>">
                              <h5 class="mb-0">
                              <a class="link collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse<?=$key+1?>" aria-expanded="false" aria-controls="collapse<?=$key+1?>">
                                <?=$value['name']?>
                              </a>
                            </h5>
                          </div>
                          <div id="collapse<?=$key+1?>" class="collapse" role="tabpanel" aria-labelledby="heading<?=$key?>" style="">
                              <div class="card-body">
                                  <iframe src="<?=$value['video_url']?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                              </div>
                          </div>
                      </div>
                      <?php
                      }
                    ?>
                  </div>
              </div>
          </div>
      </div>
    </div>

    </div>
    </div>
  </div>
</div>
