<script type="text/javascript">
$(document).ready(function(){
	$('#frmSearch').validate();
});

function onSubmit()
{
	$ddlSelect = $('#ddlSelect').val();

	$action = "<?=base_url()?>index.php/"+$ddlSelect;
	document.frmSearch.action = $action;
}

</script>
<form id="frmSearch" name="frmSearch" method="post">
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><input type="text" id="txtKeyword" name="txtKeyword" placeholder="Search" onBlur="if (this.value=='') { this.value='Search'; }" onFocus="if (this.value=='Search') { this.value=''; }" class="top-search-inp " /></td>
    <td><select  class="styledselect required" id="ddlSelect">
        <option value="">All</option>
        <option value="Actor/manage_Actor">Actor</option>
        <option value="movie/manage_movie">Movie</option>
      </select>
    </td>
    <td><input type="image" src="<?=base_url(); ?>images/shared/top_search_btn.gif" onclick="return onSubmit();"  />
    </td>
  </tr>
</table>
</form>