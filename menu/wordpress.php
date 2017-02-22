<?php 
function renderMenu($menuName) { ?>
	<ul class="newmenu">
	<?php $count = 0; $submenu = false;
	$menuItems = wp_get_nav_menu_items($menuName);
	foreach($menuItems as $item) {
		// item does not have a parent so menu_item_parent equals 0 (false)
		if(!$item->menu_item_parent) {
			// save this id for later comparison with sub-menu items
			$parentId = $item->ID; ?>
			<li class="collapsed" data-toggle="collapse" data-target="#<?= $parentId; ?>">
				<a href="<?= $item->url; ?>"><?= $item->title; ?></a>
		<?php } ?>
		
		<?php if($parentId == $item->menu_item_parent) { ?>
			<?php if(!$submenu) {
				$submenu = true; ?>
				<i class="fa toggle fa-lg pull-right"></i>
				<ul class="collapse submenu" id="<?= $parentId; ?>">
			<?php } ?>
					<li><a href="<?= $item->url; ?>"><?= $item->title; ?></a></li>
			<?php if(!isset($menuItems[$count + 1]) || $menuItems[$count + 1]->menu_item_parent != $parentId && $submenu) { ?>
				</ul>
				<?php $submenu = false;
			}
		} ?>
		
		<?php if(!isset($menuItems[$count + 1]) || $menuItems[$count + 1]->menu_item_parent != $parentId) {  ?>
			</li>
			<?php $submenu = false; 
		} ?>
		
		<?php $count++;
	} ?>
	</ul>
<?php }
