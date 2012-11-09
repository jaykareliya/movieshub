<script language="javascript" type="text/javascript">
function deletechecked()
{
    var answer = confirm("Are you sure you want to delete Singer ?")
    if (answer){
        document.messages.submit();
    }
    
    return false;  
}  
$("document").ready(function(){
	$("#ddlRecordSelection").change(function(){
		location.replace("manage_Movie_Singer?records="+$(this).val());
	});
	$(".tablesorter").tablesorter( {sortList: [[0,0], [1,0]]} ); 
});
</script>
<?php if ($this->session->flashdata('success')){ 
		?>
		<div id='message-green'>
    <table border='0' width='100%' cellpadding='0' cellspacing='0'>
      <tr>
        <td class='green-left'><?=$this->session->flashdata('success')?></td>
        <td class='green-right'><img src='<?=base_url()?>images/table/icon_close_green.gif'   alt='' /></td>
      </tr>
    </table>
  </div>
		<?php
		}?>
<?php if ($this->session->flashdata('error')){ 
		?>
		<div id="message-red">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="red-left"><?=$this->session->flashdata('error')?></a></td>
					<td class="red-right"><a class="close-red"><img src="<?=base_url()?>images/table/icon_close_red.gif"   alt="" /></a></td>
				</tr>
				</table>
		</div>
		<?php
         }?>

<div style="margin:0 10px 15px 10px">
  <table id="table-search" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
      <td width="75">Search by: </td>
      <td class="search"><?php
$alpha = "A";
echo '<a href="'.base_url().'index.php/Movie_Singer/manage_Movie_Singer?alpha=0-9" >#</a>&nbsp;';
echo '|&nbsp;';
for($i=0;$i<26;$i++)
{
	echo '<a href="'.base_url().'index.php/Movie_Singer/manage_Movie_Singer?alpha='.$alpha.'" >'.$alpha++.'</a>&nbsp;';
	echo '|&nbsp;';
}
echo '<a href="'.base_url().'index.php/Movie_Singer/manage_Movie_Singer?alpha=ALL" >ALL</a>';
?></td>
      <td align="right" ><a href="new_Movie_Singer" class="btn-bg">Add Singer</a></td>
    </tr>
  </table>
</div>
<div id="table-content">
<?php
$result = count($fill_Movie_Singer_table);
if($result == 0) 
{ 
?>
  <div id='message-yellow'>
    <table border='0' width='100%' cellpadding='0' cellspacing='0'>
      <tr>
        <td class='yellow-left'>No such record found.</td>
        <td class='yellow-right'><img src='<?=base_url()?>images/table/icon_close_yellow.gif'   alt='' /></td>
      </tr>
    </table>
  </div>
<?php
}
?>
  <table id="product-table" class="tablesorter" cellspacing="0" cellpadding="5" border="0" width="100%">
    <thead><tr bgcolor="#eaeaea">
      <?php  
		$result = count($fill_Movie_Singer_table);
		if($result > 0) 
		{ 
      
            echo '<th class="table-header-repeat line-left"><a>Movie Name</a></th>
            <th class="table-header-options "><a>Singer Name</a></th>
			<th class="table-header-options line-left" width="10%"><a>Actions</a></th>';
		} ?>
    </tr></thead>
    <tbody>
      <?php 
	  		$alterrow=0;
	  		$result = count($fill_Movie_Singer_table);if($result != 0) {
				foreach($fill_Movie_Singer_table as $row)
				{
				if($alterrow%2==0){echo "<tr class='alternate-row'>";}else{echo "<tr>";}
				echo "<td>".$row->Movie_Name." </td>";
				echo "<td>".$row->Singer_Name."</td>";			
			
				echo "<td align='center'><a href='new_Movie_Singer?Movie_Singer_id=".$row->Movie_Singer_Id."' class='icon-1 info-tooltip' title='Edit'></a>
					<a onclick='return deletechecked();' href='delete_Movie_Singer?Movie_Singer_id=".$row->Movie_Singer_Id."' class='icon-2 info-tooltip' title='Delete'></a></td>";
				echo "</tr>";
				$alterrow++;
				} 
			}
		  ?>
    </tbody>
  </table>
  <div align="right"> </div>
</div>
<!--  start paging..................................................... -->
<?php if($visible) { ?>
<table border="0" cellpadding="0" cellspacing="0" id="paging-table">
  <tr>
    <td><?php echo $pagination; ?></td>
    <td><?php echo form_dropdown('ddlRecordSelection',$ddlRows,$ddlSelected,'id="ddlRecordSelection"');?> </td>
  </tr>
</table>
</td>
<?php } ?>
<!--  end paging................ -->
<div class="clear"></div>