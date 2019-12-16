<style type="text/css">
#print_table{
	font-family:"Times New Roman", Times, serif;
    font-size: 13.5px;
    margin: 10px auto;
    text-align: justify;
    width: 800px;
	
	}
#print_table .heading{ width:30px; }
</style>
<script type="text/javascript">

function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

</script>
<input type="button" onclick="printDiv('printableArea')" value="Print" />
<div id="printableArea">
      


<table  id="print_table">
  <tr>
    <td class="heading"><strong>Subject:</strong> </td>
    <td><?php echo $dak->subject; ?>  </td>
  </tr>
    <tr>
    <td class="heading"> <strong>PUC :</strong></td>
    <td><?php echo $dak->puc; ?></td>
  </tr>
  <tr>
   
    <td colspan="2" > 
	<br />
	<?php echo $dak->note; ?> </td>
  </tr>
  
  <tr>
    <td  align="right" colspan="2">
    <br /><br />
   <strong>  <?php echo $dak->signtory; ?></strong> <br />
    <?php echo mdate("%d.%m.%Y",$dak->date); ?>
    </td>
  </tr>
</table>
<table id="print_table">  
  <?php foreach($dak_note_list as $list){?>
   <tr>
    <td colspan="2" ><?php echo $list->dak_pad_note; ?></td>

  </tr>
  <tr>
    <td colspan="2" align="right">
    <br /><br />
    <strong><?php echo $list->addressee; ?> </strong>
    <br />
    <?php echo mdate("%d.%m.%Y",$list->dak_pad_note_date); ?>
    </td>
  </tr>
<?php } ?>  
</table>
</div>
