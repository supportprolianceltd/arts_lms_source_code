<?php
$addon_details = $this->db->get_where('addons', array('id' => $param2))->row_array();
?>
<h5 class="mt-0"><?php echo $addon_details['name']; ?></h5>
