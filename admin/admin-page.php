<style>
table {
  border-collapse: collapse;
  border: 1px solid black; 
}

th, td {
  padding: 8px;
}

thead {
  background-color: #333;
  color: white;
}

</style>
<div class="wrap">
<h1>CSV Export</h1>
<p>
<?php

create_form(plugin_dir_url(__FILE__) . 'download.php');
show_db_result();

?>
</p>
</div>
