<?php



function listdata($conn,$table,$table_heads,$all_fields) {
    $count=count($table_heads);
    $counter=1;
    $sql = 'SELECT id,';
    foreach ($table_heads as $key => $value) {

      $sql.=$value;

      if($counter!==$count)
      {
        $sql.=', ';
      }

      $counter++;
    }

    $sql.= " FROM `".$table."` where `status`!='trashed' ORDER BY ".$table_heads[0];



    echo '<div class="table-responsive m-t-40">';

    ?>
    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <?php

            foreach ($table_heads as $key => $value) {
              ?>
                <th><?=$all_fields[$value]['name']?></th>
              <?php
            }

            ?>
              <th>Action</th>
            </tr>
        </thead>
        <tfoot>
          <tr>
            <?php
            foreach ($table_heads as $key => $value) {
              ?>
              <th><?=$all_fields[$value]['name']?></th>
              <?php
            }

            ?>
              <th>Action</th>
            </tr>
        </tfoot>
        <tbody>
          <?php
          foreach ($conn->query($sql) as $row) {
            echo '<tr>';
              foreach ($table_heads as $key => $value) {
                # code...
                echo '<td>'.$row[$value].'</td>';
              }
              echo '<td> '.showbtn_main('warning','edit',$row['id']).' '.showbtn_main('danger','delete',$row['id']).' </td>';
            echo '</tr>';
          }
          ?>
        </tbody>
    </table>
    <?php
    echo '</div>';

}
?>
