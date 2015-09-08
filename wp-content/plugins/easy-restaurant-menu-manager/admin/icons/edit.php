<?php
defined('WPRMM_PATH') or die();

wprmm_save_icon();
$icon = new WPRMM_ICON((int) $_GET['icon_id']);
?>
<div class="wrap wprmm">
  <img class="left" style="margin:0 15px 0 0" src="<?php echo WPRMM_URL.'images/menumanagericon_50x50.jpg'?>" />
  <h2 class="left">Restaurant Menu Manager - Edit Icon</h2>
  <div class="clear"></div>
  <hr />

  <?php wprmm_get_help();?>

  <p class="wprmm-breadcrumb">
    <a href="<?php echo admin_url('admin.php?page='.WPRMM_ADMIN_ICON_URL);?>">Icons</a> &raquo; 
    <a href="<?php echo $_SERVER['REQUEST_URI']; ?>"><?php echo $icon->name;?></a>
  </p>

  <form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">

    <table class="form-table">
      <tbody>

        <tr valign="top">
          <th scope="row"><label for="wprmm[name]">Name</label></th>
          <td><input name="wprmm[name]" type="text" required="required" value="<?php echo $icon->name;?>" class="regular-text">
              <span class="description">Display name for this item.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wprmm[description]">Description</label></th>
          <td><textarea name="wprmm[description]" class="large-text code"><?php echo $icon->description;?></textarea>
              <span class="description">Display description for this item.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row">Upload Image</th>
          <td>
            <?php if(!empty($icon->image)):?>
              <img class="wprmm_preview_image" src="<?php echo $icon->image;?>"/>
            <?php endif;?>
            <label for="upload_image">
              <input id="upload_image" type="text" size="36" name="wprmm[image]" value="<?php echo $icon->image;?>" />
              <input id="upload_image_button" type="button" value="Upload Image" />
              <span class="description">Enter an URL or upload an image for this item. Recommended size 16x16px.</span>
            </label>
          </td>
        </tr>


      </tbody>
    </table>

    <br />

    <input type="hidden" name="wprmm[id]" value="<?php echo $icon->id;?>" />

    <div class="wprmm-admin-nav">
      <p>
        <input class="button-primary" class="left" type="submit" name="save_item" value="Save Icon" />
        <a class="button" href="<?php echo admin_url('admin.php?page='.WPRMM_ADMIN_ICON_URL);?>">&laquo;back to Icons</a>&nbsp;
        <span>
          <a class="button" href="<?php echo wprmm_admin_icon_url('icon','new-icon',$menu->id);?>">+ Add New Icon</a>&nbsp;
          <a class="button" href="<?php echo wprmm_help_link(); ?>">help?</a>
        </span>&nbsp;
      </p>
    </div>


  </form>

</div>
