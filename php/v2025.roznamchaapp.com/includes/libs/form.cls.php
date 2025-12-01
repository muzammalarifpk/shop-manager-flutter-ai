<?php

function create_form($form_layout,$all_fields)
{
  echo '<form action="#" class="validation-wizard wizard-circle"  enctype="multipart/form-data">';
  foreach ($form_layout as $container => $section)
  {
    # code...
    echo '<h6>'.ucwords($container).'</h6>';
    echo '<section>';
      foreach ($section as $contains => $row) {
        # code...
        echo '<div class="row">';
        foreach ($row as $field_name => $class_name) {
          # code...
          if($all_fields[$field_name]['type']=='text' || $all_fields[$field_name]['type']=='number' || $all_fields[$field_name]['type']=='email' || $all_fields[$field_name]['type']=='tel' || $all_fields[$field_name]['type']=='date' || $all_fields[$field_name]['type']=='password')
          {
            if(isset($all_fields[$field_name]['attr']))
            {
              form_field_input($class_name,$field_name,$all_fields[$field_name]['name'],$all_fields[$field_name]['is_req'],$all_fields[$field_name]['type'],$all_fields[$field_name]['attr']);
            }else{

              form_field_input($class_name,$field_name,$all_fields[$field_name]['name'],$all_fields[$field_name]['is_req'],$all_fields[$field_name]['type']);
            }
          }elseif($all_fields[$field_name]['type']=='tags')
          {
            form_field_tags($class_name,$field_name,$all_fields[$field_name]['name'],$all_fields[$field_name]['is_req'],$all_fields[$field_name]['type']);
          }elseif($all_fields[$field_name]['type']=='dropzone')
          {
            form_field_dropzone($class_name,$field_name,$all_fields[$field_name]['name'],$all_fields[$field_name]['is_req'],$all_fields[$field_name]['type']);
          }elseif ($all_fields[$field_name]['type']=='dropdown') {

            # code...
            form_field_dropdown($class_name,$field_name,$all_fields[$field_name]['name'],$all_fields[$field_name]['is_req'],$all_fields[$field_name]['type'],$all_fields[$field_name]['attr']);
          }elseif ($all_fields[$field_name]['type']=='textarea') {
            # code...
            form_field_textarea($class_name,$field_name,$all_fields[$field_name]['name'],$all_fields[$field_name]['is_req'],$all_fields[$field_name]['type']);
          }elseif ($all_fields[$field_name]['type']=='manual') {
            # code...
            form_field_manual($class_name,$field_name,$all_fields[$field_name]['name'],$all_fields[$field_name]['is_req'],$all_fields[$field_name]['attr']);
          }

        }
        echo '</div>';
      }
    echo '</section>';
  }
  echo '</form>';
}

function form_field_input($class_name,$key,$name,$is_req,$type,$attr='')
{
  echo '
    <div class="'.$class_name.'">
      <div class="form-group">
        <label for="'.$key.'"> '.ucwords($name).': ';

  if($is_req==1)
  {
    echo '<span class="text-danger">*</span>';
  }

  echo '</label>
    <input type="'.$type.'" class="form-control"';
    if($is_req==1)
    {
      echo ' required ';
    }
    if(is_array($attr))
    {
      if(in_array("disabled",$attr))
      {
        echo ' readonly ';
      }
    }
  echo ' id="'.$key.'" name="'.$key.'">
      </div>
      </div>
    ';
}


function form_field_dropzone($class_name,$key,$name,$is_req,$type,$attr='')
{
  echo '
    <div class="'.$class_name.'">
      <div class="form-group">';
    echo '<div class="fallback" id="dropzoneabc">
          </div>';
  echo '
  <input name="file" type="file" multiple />
      </div>
      </div>
    ';
}


function form_field_tags($class_name,$key,$name,$is_req,$type,$attr='')
{
  echo '
    <div class="'.$class_name.'">
      <div class="form-group">
        <label for="'.$key.'"> '.ucwords($name).': ';

  if($is_req==1)
  {
    echo '<span class="text-danger">*</span>';
  }

  echo '</label>
    <input type="text" data-role="tagsinput" value="" class="form-control "';
    if($is_req==1)
    {
      echo ' required';
    }
  echo ' id="'.$key.'" name="'.$key.'">
      </div>
      </div>
    ';
}


function form_field_dropdown($class_name,$key,$name,$is_req,$type,$attr)
{
    echo '<div class="'.$class_name.'"><div class="form-group"><label for="'.$key.'"> '.ucwords($name).': ';

    if($is_req==1)
    {
        echo '<span class="text-danger">*</span>';
    }

    echo ' </label><select class="custom-select form-control';
            if($is_req==1)
            {
                echo ' required';
              }

    echo ' " id="'.$key.'" name="'.$key.'"><option value="">Select '.$name.'</option>';

                  foreach ($attr[0] as $key => $value) {
                      echo '<option value="'.strtolower($value).'">'.ucwords($value).'</option>';
                  }

    echo '</select></div></div>';

}


function form_field_textarea($class_name,$key,$name,$is_req,$type)
{
    echo '<div class="'.$class_name.'"><div class="form-group"><label for="'.$key.'">'.ucwords($name).' :';
    if($is_req==1)
    {
        echo '<span class="text-danger">*</span>';
    }
    echo '</label><textarea name="'.$key.'" id="'.$key.'" rows="6" class="form-control"';
    if($is_req==1)
    {
        echo ' required';
      }

    echo '></textarea></div></div>';

}

function form_field_manual($class_name,$key,$name,$is_req,$attr)
{
    if(1==1)
    {
      form_field_privs($class_name,$key,$name,$is_req,$attr);
    }
}

function form_field_privs($class_name,$key,$name,$is_req,$attr)
{

?>


<div class="col-md-6">
      <div class="form-group validate">
          <h5>Access Type <span class="text-danger">*</span></h5>
          <select class="custom-select access_level_select form-control required" onchange="check_access_level_radio('access_level_select')" id="access_level_select" name="access_level_select">
              <option value="*" selected="selected">Super Admin / CEO</option>
              <option value="coadmin">Sub Admin / Manager</option>
          </select>
      </div>
  </div>
  <div class="col-md-6">
      <div class="form-group">
          <label for="webUrl3">Access to Modules:</label>
          <div class="access_level">
              <div id="super_admin">Super Admin / CEO has access to all modules.</div>
              <div id="co_admin" class="d-none">
                  <div class="controls">
                    <?php
                      foreach ($attr as $key => $value) {
                      ?>
                        <label class="inline custom-control custom-checkbox block">
                        <input type="checkbox" name="privs[]" class="custom-control-input" value="<?=$value?>"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0"><?=$value?></span>
                        </label>
                      <?php
                      }
                    ?>
                  </div>
              </div>
          </div>
      </div>
  </div>
<?php
}
?>
