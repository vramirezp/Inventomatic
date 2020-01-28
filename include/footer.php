</div>
<br>
<?php  ?>
<div class="text-center"><?php echo TITULO ?> Duoc UC - <?php echo date("Y"); ?></div>
</body>
</html>
<script type="text/javascript">
	$('body').click(function(e)
	{
    	var inputs = document.getElementsByTagName('input');

		for(var i = 0; i < inputs.length; i++) 
		{
		    if(inputs[i].type.toLowerCase() == 'text') 
		    {
		        inputs[i].value = inputs[i].value.trim();
		    }
		}
	});

	$('#cancelar').click(function(e)
	{
    	var inputs = document.getElementsByTagName('input');

		for(var i = 0; i < inputs.length; i++) 
		{
		    if(inputs[i].type.toLowerCase() == 'text') 
		    {
		        inputs[i].value = "";
		    }
		}
	});
</script>
<?php ob_end_flush(); ?>