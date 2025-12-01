<?php
  require_once("a-users.config.php");
  $meta['info']['title']='User Cohorts';
  require_once("includes/head.php");
  require_once("includes/libs/form.cls.php");
  require_once("includes/libs/table.cls.php");
?>
<script>

function loadtdata(newname, newphone, newemail, newprivs, newstatus, newid)
{
  dtable.row.add(newname, newphone, newemail, newprivs, newstatus, newid ).draw(false);

}
function check_access_level_radio(clas)
{
  var val = $('.'+clas).val();

  if(val=='*'){
    $(".access_level #super_admin").removeClass('d-none');
    $(".access_level #co_admin").addClass('d-none');
  }else if (val=='coadmin') {
    $(".access_level #super_admin").addClass('d-none');
    $(".access_level #co_admin").removeClass('d-none');

  }
}

  $(document).ready(function(e){

    $('.access_level_select').click(function(){
      check_access_level_radio('access_level_select');
    });

    $('.access_level_select').on('change', function() {


      console.log("Changed one!");
      if ($(this).prop('checked', true)) {
        $('#id1,#id2,#id3').not(this).prop('checked', false);
      }
    });

    $(".editmodalbtn").click(function(e){
      e.preventDefault();
      var reqid=$(this).attr('rel');
      //  alert(reqid);
        $.get( "admin-edit.php?reqid="+reqid, function( data ) {
          // the contents is now in the variable data
          $('#modaldiv').html(data);
          $('#responsive-modal').modal('show');
        });

    });


    $("#newmodalbtn").click(function(e){
      e.preventDefault();
        $.get( "admin-new.php", function( data ) {
          // the contents is now in the variable data
          $('#modaldiv').html(data);
          $('#responsive-modal').modal('show');
        });

    });

    $('#editmodal').on('change',function(){
      if($(this).hasClass('show')){
        alert('shown');
      }else{
        alert('hidden');
      }

    });
  });

</script>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><?=$meta['info']['title']?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <?php
                          $module_count=count($meta['module']);
                          $counter=1;
                          foreach ($meta['module'] as $key => $value) {

                            ?>
                              <li class="breadcrumb-item
                              <?php

                                if($counter==$module_count)
                                {
                                  echo 'active';
                                }

                              ?>"><?=ucfirst($value)?></li>
                            <?php
                            $counter++;
                          }
                        ?>
                    </ol>
                </div>
                <div>
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
                        <div class="card">
                            <div class="card-body">
                              <!-- column -->
                              <div class="col-lg-12">
                                  <div class="card">
                                      <div class="card-body">
                                          <h4 class="card-title">Cohorts Statistics by Numbers</h4>
                                          <div id="stat_numbers" style="width:100%; height:400px;"></div>
                                      </div>
                                  </div>
                              </div>
                              <!-- column -->

                              <!-- column -->
                              <div class="col-lg-12">
                                  <div class="card">
                                      <div class="card-body">
                                          <h4 class="card-title">Cohorts Statistics by Percentage</h4>
                                          <div id="stat_percentage" style="width:100%; height:400px;"></div>
                                      </div>
                                  </div>
                              </div>
                              <!-- column -->

                              <?php

                                $cohorts_array=[];

                                $select_qry="SELECT `cohort`,COUNT(`id`) as `new_users`  FROM `users` GROUP BY `cohort` order by `cohort`";
                                //  echo $select_qry;
                                foreach ($db->query($select_qry) as $row) {


                                  $qry_select_free="select count(*) as free_users from `users` where `cohort`='$row[cohort]' and `type`='prepaid' ";
                                  $stmt_free = $db->query($qry_select_free);
                                  $row_free = $stmt_free->fetch();

                                  $qry_select_premium="select count(*) as premium_users from `users` where `cohort`='$row[cohort]' and `type`!='prepaid' ";
                                  $stmt_premium = $db->query($qry_select_premium);
                                  $row_premium = $stmt_premium->fetch();

                                  $qry_select_1_entries="select count(*) as user_count from `users` where `cohort`='$row[cohort]' and `entries`>'0' ";
                                  $stmt_1_entries = $db->query($qry_select_1_entries);
                                  $row_1_entries = $stmt_1_entries->fetch();

                                  $qry_select_5_entries="select count(*) as user_count from `users` where `cohort`='$row[cohort]' and `entries`>'5' ";
                                  $stmt_5_entries = $db->query($qry_select_5_entries);
                                  $row_5_entries = $stmt_5_entries->fetch();

                                  $qry_select_25_entries="select count(*) as user_count from `users` where `cohort`='$row[cohort]' and `entries`>'25' ";
                                  $stmt_25_entries = $db->query($qry_select_25_entries);
                                  $row_25_entries = $stmt_25_entries->fetch();

                                  $qry_select_50_entries="select count(*) as user_count from `users` where `cohort`='$row[cohort]' and `entries`>'50' ";
                                  $stmt_50_entries = $db->query($qry_select_50_entries);
                                  $row_50_entries = $stmt_50_entries->fetch();

                                  $qry_select_100_entries="select count(*) as user_count from `users` where `cohort`='$row[cohort]' and `entries`>'100' ";
                                  $stmt_100_entries = $db->query($qry_select_100_entries);
                                  $row_100_entries = $stmt_100_entries->fetch();


                                  $cohorts_array[$row['cohort']]=array(
                                    'cohort'=>$row['cohort'],
                                    'total_users'=>$row['new_users'],
                                    'free_users'=>$row_free['free_users'],

                                    'premium_users'=>$row_premium['premium_users'],
                                    '1_entries'=>$row_1_entries['user_count'],
                                    '5_entries'=>$row_5_entries['user_count'],

                                    '25_entries'=>$row_25_entries['user_count'],
                                    '50_entries'=>$row_50_entries['user_count'],
                                    '100_entries'=>$row_100_entries['user_count'],
                                  );
                                    }
                                   ?>

                              <div class="table-responsive m-t-40"  id="no-more-tables">
                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead class="cf">
                                      <tr>
                                        <th class="numeric">Cohort</th>
                                        <th class="numeric">Total Users</th>
                                        <th class="numeric">1 Entry</th>
                                        <th class="numeric">5 Entries</th>

                                        <th class="numeric">25 Entries</th>
                                        <th class="numeric">50 Entries</th>
                                        <th class="numeric">100 Entries</th>

                                        <th class="numeric">Premium Users</th>
                                      </tr>
                                  </thead>
                                  <tfoot class="cf">
                                    <tr>
                                      <th class="numeric">Cohort</th>
                                      <th class="numeric">Total Users</th>
                                      <th class="numeric">Zero Entry</th>
                                      <th class="numeric">5 Entries</th>

                                      <th class="numeric">25 Entries</th>
                                      <th class="numeric">50 Entries</th>
                                      <th class="numeric">100 Entries</th>

                                      <th class="numeric">Premium Users</th>
                                    </tr>
                                </tfoot>
                                <tbody>

                                  <?php
                                  foreach ($cohorts_array as $key => $value) {
                                    // code...

                                   ?>
                                    <tr>
                                      <td data-title="Cohort: "><a href="a-users.php?cohort=<?=$value['cohort']?>" class="btn btn-sm btn-link"><?=$value['cohort']?></a></td>
                                      <td data-title="Total Users: "><?=$value['total_users']?></td>
                                      <td data-title="1 Entry: "><?=$value['1_entries']?></td>
                                      <td data-title="5 Entries: "><?=$value['5_entries']?></td>

                                      <td data-title="25 Entries: "><?=$value['25_entries']?></td>
                                      <td data-title="50 Entries: "><?=$value['50_entries']?></td>
                                      <td data-title="100 Entries: "><?=$value['100_entries']?></td>

                                      <td data-title="Premium Users: "><?=$value['premium_users']?></td>
                                    </tr>
                                    <?php
                                  }

                                  ?>
                                </tbody>
                              </table>




                              </div>
                            </div>
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
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/echarts/echarts-all.js"></script>
    <script type="text/javascript">

        // ==============================================================
        // Line chart stat_numbers
        // ==============================================================
        var dom = document.getElementById("stat_numbers");
        var mytempChart = echarts.init(dom);
        var app = {};
        option = null;
        option = {

            tooltip : {
                trigger: 'axis'
            },
            legend: {
                data:['total_users','free_users','premium_users','1_entry','5_entries','25_entries','50_entries','100_entries']
            },
            toolbox: {
                show : true,
                feature : {
                    magicType : {show: true, type: ['line', 'bar']},
                    restore : {show: true},
                    saveAsImage : {show: true}
                }
            },
            color: ['#1abc9c','#2ecc71','#3498db','#9b59b6','#34495e','#f1c40f','#e67e22','#c0392b'],
            calculable : true,
            xAxis : [
                {
                    type : 'category',

                    boundaryGap : false,
                    data : [
                      <?php


                        foreach ($cohorts_array as $key => $value) {

                          echo "'$key', ";
                          // code...
                        }

                       ?>
      ]
                }
            ],
            yAxis : [
                {
                    type : 'value',
                    axisLabel : {
                        formatter: '{value} Users'
                    }
                }
            ],

            series : [
                {
                    name:'total_users',
                    type:'line',
                    data:[
                      <?php
                        foreach ($cohorts_array as $key => $value) {
                          // code...
                          echo "'".$value['total_users']."', ";
                        }

                       ?>],
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                shadowColor : 'rgba(0,0,0,0.3)',
                                shadowBlur: 10,
                                shadowOffsetX: 8,
                                shadowOffsetY: 8
                            }
                        }
                    }
                },
                {
                    name:'free_users',
                    type:'line',
                    data:[
                      <?php
                        foreach ($cohorts_array as $key => $value) {
                          // code...
                          echo "'".$value['free_users']."', ";
                        }

                       ?>],
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                shadowColor : 'rgba(0,0,0,0.3)',
                                shadowBlur: 10,
                                shadowOffsetX: 8,
                                shadowOffsetY: 8
                            }
                        }
                    }
                },
                {
                    name:'premium_users',
                    type:'bar',
                    data:[
                      <?php
                        foreach ($cohorts_array as $key => $value) {
                          // code...
                          echo "'".$value['premium_users']."', ";
                        }

                       ?>],
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                shadowColor : 'rgba(0,0,0,0.3)',
                                shadowBlur: 10,
                                shadowOffsetX: 8,
                                shadowOffsetY: 8
                            }
                        }
                    }
                },
                {
                    name:'1_entry',
                    type:'line',
                    data:[
                      <?php
                        foreach ($cohorts_array as $key => $value) {
                          // code...
                          echo "'".$value['1_entries']."', ";
                        }

                       ?>],
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                shadowColor : 'rgba(0,0,0,0.3)',
                                shadowBlur: 10,
                                shadowOffsetX: 8,
                                shadowOffsetY: 8
                            }
                        }
                    }
                },
                {
                    name:'5_entries',
                    type:'line',
                    data:[
                      <?php
                        foreach ($cohorts_array as $key => $value) {
                          // code...
                          echo "'".$value['5_entries']."', ";
                        }

                       ?>],
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                shadowColor : 'rgba(0,0,0,0.3)',
                                shadowBlur: 10,
                                shadowOffsetX: 8,
                                shadowOffsetY: 8
                            }
                        }
                    }
                },
                {
                    name:'25_entries',
                    type:'line',
                    data:[
                      <?php
                        foreach ($cohorts_array as $key => $value) {
                          // code...
                          echo "'".$value['25_entries']."', ";
                        }

                       ?>],
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                shadowColor : 'rgba(0,0,0,0.3)',
                                shadowBlur: 10,
                                shadowOffsetX: 8,
                                shadowOffsetY: 8
                            }
                        }
                    }
                },
                {
                    name:'50_entries',
                    type:'line',
                    data:[
                      <?php
                        foreach ($cohorts_array as $key => $value) {
                          // code...
                          echo "'".$value['50_entries']."', ";
                        }

                       ?>],
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                shadowColor : 'rgba(0,0,0,0.3)',
                                shadowBlur: 10,
                                shadowOffsetX: 8,
                                shadowOffsetY: 8
                            }
                        }
                    }
                },
                {
                    name:'100_entries',
                    type:'line',
                    data:[
                      <?php
                        foreach ($cohorts_array as $key => $value) {
                          // code...
                          echo "'".$value['100_entries']."', ";
                        }

                       ?>],
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                shadowColor : 'rgba(0,0,0,0.3)',
                                shadowBlur: 10,
                                shadowOffsetX: 8,
                                shadowOffsetY: 8
                            }
                        }
                    }
                }

            ]
        };


      // ==============================================================
      // Line chart stat_percentage
      // ==============================================================
      var dom_percentage = document.getElementById("stat_percentage");
      var mytempChart_percentage = echarts.init(dom_percentage);
      var app_percentage = {};
      option_percentage = null;
      option_percentage = {

          tooltip : {
              trigger: 'axis'
          },
          legend: {
              data:['total_users','free_users','premium_users','1_entry','5_entries','25_entries','50_entries','100_entries']
          },
          toolbox: {
              show : true,
              feature : {
                  magicType : {show: true, type: ['line', 'bar']},
                  restore : {show: true},
                  saveAsImage : {show: true}
              }
          },
          color: ['#1abc9c','#2ecc71','#3498db','#9b59b6','#34495e','#f1c40f','#e67e22','#c0392b'],
          calculable : true,
          xAxis : [
              {
                  type : 'category',

                  boundaryGap : false,
                  data : [
                    <?php


                      foreach ($cohorts_array as $key => $value) {

                        echo "'$key', ";
                        // code...
                      }

                     ?>
    ]
              }
          ],
          yAxis : [
              {
                  type : 'value',
                  axisLabel : {
                      formatter: '{value} Users'
                  }
              }
          ],

          series : [
              {
                  name:'total_users',
                  type:'line',
                  data:[
                    <?php
                      foreach ($cohorts_array as $key => $value) {
                        // code...
                        echo "'".(($value['total_users']*100)/$value['total_users'])."', ";
                      }

                     ?>],
                  itemStyle: {
                      normal: {
                          lineStyle: {
                              shadowColor : 'rgba(0,0,0,0.3)',
                              shadowBlur: 10,
                              shadowOffsetX: 8,
                              shadowOffsetY: 8
                          }
                      }
                  }
              },
              {
                  name:'free_users',
                  type:'line',
                  data:[
                    <?php
                      foreach ($cohorts_array as $key => $value) {
                        // code...
                        echo "'".(($value['free_users']*100)/$value['total_users'])."', ";
                      }

                     ?>],
                  itemStyle: {
                      normal: {
                          lineStyle: {
                              shadowColor : 'rgba(0,0,0,0.3)',
                              shadowBlur: 10,
                              shadowOffsetX: 8,
                              shadowOffsetY: 8
                          }
                      }
                  }
              },
              {
                  name:'premium_users',
                  type:'bar',
                  data:[
                    <?php
                      foreach ($cohorts_array as $key => $value) {
                        // code...
                        echo "'".(($value['premium_users']*100)/$value['total_users'])."', ";
                      }

                     ?>],
                  itemStyle: {
                      normal: {
                          lineStyle: {
                              shadowColor : 'rgba(0,0,0,0.3)',
                              shadowBlur: 10,
                              shadowOffsetX: 8,
                              shadowOffsetY: 8
                          }
                      }
                  }
              },
              {
                  name:'1_entry',
                  type:'line',
                  data:[
                    <?php
                      foreach ($cohorts_array as $key => $value) {
                        // code...
                        echo "'".(($value['1_entries']*100)/$value['total_users'])."', ";
                      }

                     ?>],
                  itemStyle: {
                      normal: {
                          lineStyle: {
                              shadowColor : 'rgba(0,0,0,0.3)',
                              shadowBlur: 10,
                              shadowOffsetX: 8,
                              shadowOffsetY: 8
                          }
                      }
                  }
              },
              {
                  name:'5_entries',
                  type:'line',
                  data:[
                    <?php
                      foreach ($cohorts_array as $key => $value) {
                        // code...
                        echo "'".(($value['5_entries']*100)/$value['total_users'])."', ";
                      }

                     ?>],
                  itemStyle: {
                      normal: {
                          lineStyle: {
                              shadowColor : 'rgba(0,0,0,0.3)',
                              shadowBlur: 10,
                              shadowOffsetX: 8,
                              shadowOffsetY: 8
                          }
                      }
                  }
              },
              {
                  name:'25_entries',
                  type:'line',
                  data:[
                    <?php
                      foreach ($cohorts_array as $key => $value) {
                        // code...
                        echo "'".(($value['25_entries']*100)/$value['total_users'])."', ";
                      }

                     ?>],
                  itemStyle: {
                      normal: {
                          lineStyle: {
                              shadowColor : 'rgba(0,0,0,0.3)',
                              shadowBlur: 10,
                              shadowOffsetX: 8,
                              shadowOffsetY: 8
                          }
                      }
                  }
              },
              {
                  name:'50_entries',
                  type:'line',
                  data:[
                    <?php
                      foreach ($cohorts_array as $key => $value) {
                        // code...
                        echo "'".(($value['50_entries']*100)/$value['total_users'])."', ";
                      }

                     ?>],
                  itemStyle: {
                      normal: {
                          lineStyle: {
                              shadowColor : 'rgba(0,0,0,0.3)',
                              shadowBlur: 10,
                              shadowOffsetX: 8,
                              shadowOffsetY: 8
                          }
                      }
                  }
              },
              {
                  name:'100_entries',
                  type:'line',
                  data:[
                    <?php
                      foreach ($cohorts_array as $key => $value) {
                        // code...
                        echo "'".(($value['100_entries']*100)/$value['total_users'])."', ";
                      }

                     ?>],
                  itemStyle: {
                      normal: {
                          lineStyle: {
                              shadowColor : 'rgba(0,0,0,0.3)',
                              shadowBlur: 10,
                              shadowOffsetX: 8,
                              shadowOffsetY: 8
                          }
                      }
                  }
              }

          ]
      };

      if (option && typeof option === "object") {
          mytempChart.setOption(option, true), $(function() {
                  function resize() {
                      setTimeout(function() {
                          mytempChart.resize()
                      }, 100)
                  }
                  $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
              });
      }


      if (option_percentage && typeof option_percentage === "object") {
          mytempChart_percentage.setOption(option_percentage, true), $(function() {
                  function resize() {
                      setTimeout(function() {
                          mytempChart_percentage.resize()
                      }, 100)
                  }
                  $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
              });
      }

    </script>
    <!-- ============================================================== -->
</body>
</html>
