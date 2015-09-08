<?php 
defined('WPRMM_PATH') or die();

wprmm_save_icon();

$icon = new WPRMM_ICON();
$icons = $icon->get_all();

?>
<div class="wrap wprmm">
  <img class="left" style="margin:0 15px 0 0" src="<?php echo WPRMM_URL.'images/menumanagericon_50x50.jpg'?>" />
  <h2 class="left">Restaurant Menu Manager - Manage Icons</h2>
  <div class="clear"></div>
  <hr />

  <?php wprmm_get_help(array('main'=>true));?>

  <table class="widefat icons">
  <thead>
    <tr>
      <th>Name</th>
      <th>Edit</th>
      <th>Description</th>
      <th>Icon</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </tfoot>
  <tbody>
    <?php foreach($icons as $i): ?>
     <tr>
       <td><strong><?php echo $i->name;?></strong></td>
       <td><a href="<?php echo wprmm_admin_icon_url('icon','edit-icon',$i->id);?>"><?php echo $i->name; ?></a></td>
       <td><?php echo $i->description;?></td>
       <td><?php if(!empty($i->image)) echo '<img src="'.$i->image.'" />';?></td>
       <td>
         <form method="post" action="<?php echo WPRMM_CRUD;?>">
           <input type="submit" class="button" name="wprmm_crud[icon]" value="Delete" />
           <input type="hidden" name="wprmm_crud[icon_id]" value="<?php echo $i->id;?>" />
         </form>
       </td>
     </tr>
    <?php endforeach; ?>
  </tbody>
  </table>

  <div class="wprmm-admin-nav">
    <p>
      <a class="button-primary" href="<?php echo wprmm_admin_icon_url('icon','new-icon','new');?>">+ Create New Icon</a>&nbsp;
      <span><a class="button" href="<?php echo wprmm_help_link(); ?>">help?</a></span>&nbsp;
    </p>
  </div>

</div>
