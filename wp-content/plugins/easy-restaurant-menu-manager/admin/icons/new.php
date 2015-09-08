<?php
defined('WPRMM_PATH') or die();

$icon = new WPRMM_ICON();
?>
<div class="wrap wprmm">
  <img class="left" style="margin:0 15px 0 0" src="<?php echo WPRMM_URL.'images/menumanagericon_50x50.jpg'?>" />
  <h2 class="left">Restaurant Menu Manager - New Icon</h2>
  <div class="clear"></div>
  <hr />

  <?php wprmm_get_help();?>

  <p class="wprmm-breadcrumb"><a href="<?php echo admin_url('admin.php?page='.WPRMM_ADMIN_ICON_URL);?>">Icons</a> &raquo; <a href="">New</a></p>

  <form method="POST" action="<?php echo WPRMM_CRUD; ?>">

    <table class="form-table">
      <tbody>

        <tr valign="top">
          <th scope="row"><label for="wprmm[name]">Name</label></th>
          <td><input name="wprmm[name]" type="text" value="<?php echo $icon->name;?>" class="regular-text">
              <span class="description">Display name for this icon.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wprmm[description]">Description</label></th>
          <td><textarea name="wprmm[description]" class="large-text code"><?php echo $icon->description;?></textarea>
              <span class="description">Icon tool-tip displayed when user hovers over icon.</span>
          </td>
        </tr>


        <tr valign="top">
          <th scope="row">Upload Image</th>
          <td>
            <label for="upload_image">
              <input id="upload_image" type="text" size="36" name="wprmm[image]" value="<?php echo $icon->image;?>" />
              <input id="upload_image_button" type="button" value="Upload Image" />
              <span class="description">Icon image.</span>
            </label>
            <?php if(!empty($icon->image)):?>
              <img class="wprmm_preview_image" src="<?php echo $icon->image;?>"/>
            <?php endif;?>
          </td>
        </tr>



      </tbody>
    </table>


   
    <input type="hidden" name="wprmm_crud[icon]" value="new" /> 
    <div class="wprmm-admin-nav">
      <p>
        <input class="button-primary" class="left" type="submit" name="save_icon" value="Create Icon" />&nbsp;
        <a class="button" href="<?php echo admin_url('admin.php?page='.WPRMM_ADMIN_ICON_URL);?>">&laquo;back to icons</a>&nbsp;
        <span><a class="button" href="<?php echo wprmm_help_link();?>">help?</a></span>&nbsp;
      </p>
    </div>

  </form>

</div>
