<?php

if (isset($_GET['seed']))
{
	$hash     = substr(md5($_GET['seed']), -8);
	$hash_int = base_convert($hash, 16, 10);
	srand($hash_int);
}

$size     = 5;
$keywords = array_filter(file('keywords'));
shuffle($keywords);

?>

<html>
<head>
	<meta charset="utf-8" />
	<title>The HPC bingo !</title>
	<script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<style>
		.container {
			width: 60%;
			padding-right: 15px;
			padding-left: 15px;
			margin-right: auto;
			margin-left: auto;
		}
		#bingo th {
			vertical-align: middle;
		}
		.popup {
			display:     none;
			position:    absolute;
			left:        50%;
    	top:         50%;
    	z-index:     100;
    	height:      100px;
    	margin-top:  -50px;
    	width:       40%;
    	margin-left: -20%;
		}
		.pointer {
			cursor: pointer;
		}
	</style>
	
</head>

<body>
	<div class="container">
		<div class="page-header">
			<h1 class="text-center">The HPC bingo!</h1>
			<h3 class="text-center"><small>Keywords for your keynotes</small></h1>
		</div>
		<p class="text-center">
			Boards are generated randomly from a set of keywords. You can seed the random generator with any string by adding <code>?seed=MySeed</code> to the url.<br/>Click on entries your speaker mentionned.
		</p>
	
		<table id="bingo" class="table table-bordered">
			<tbody>
			<?php for ($i=0, $c=0; $i<$size; ++$i) { ?>	
				<tr>
				<?php for ($j=0; $j<$size; ++$j, ++$c) { ?>	
					<th class="text-center pointer">
						<?php echo $keywords[$c] ?>
					</th>
				<?php } ?>
				</tr>
			<?php } ?>
			</tbody>
		</table>

		<p class="text-center">
			All contributions to the set of keywords are welcome - © Hadrien Croubois 2017 
		</p>

</div>

<div id="win" class="popup alert alert-danger text-center pointer" role="alert"><h1>BINGO !</h1></div>


<script>
	$("#bingo th").click(function(){
		var block = $(this);		
		block.toggleClass("bg-success");
    if ( block.closest("tr").find("th").not(".bg-success").length == 0
      || block.closest("#bingo").find("tr").find("th:eq("+block.index()+")").not(".bg-success").length == 0)
      win();
		return false;
	});
	$("#win").click(function(){
		$(this).hide();
		return false;
	});
	function win()
	{
		$("#win").show("pulsate", 400, function(){ $(this).hide(); });
	}
</script>

</body>
</html>

