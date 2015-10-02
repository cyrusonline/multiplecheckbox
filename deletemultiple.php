
<?php include 'config.php';?>
<?php include 'Database.php';?>
<?php 
$db = new Database;

$query = "SELECT * FROM people";
$people = $db->select($query);

if (isset($_GET['delete'])){
	$multiple = $_GET['multiple'];
	
	$i = 0;
	$sql = "DELETE FROM people ";
	foreach ($multiple as $item_id){
		$i++;
		if ($i == 1) {
			$sql .= "WHERE id= ".mysql_real_escape_string($item_id)."";
		}else {
			$sql .= " OR id= ".mysql_real_escape_string($item_id)."";
			
		}
	}
	
	echo $sql;
	$delete = $db->delete($sql);
	
	//mysql_query($sql) or die(mysql_error());
	
	header("location:".$_SERVER['PHP_SELF']);
	
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>

<style type="text/css">
body{
font-family: Arial, sans-serif;
font-size:14px;
line-height:1.6;
text-align:center;


}

#wrapper{
margin:0 auto;
width: 650px;
text-align: left;

}

td{
padding:20px;
}

thead{
background: #fafafa;



}

</style>
</head>
<body>
<div id="wrapper">
<?php if ($people):?>


<!-- Display data -->
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="GET">
<table width="100%">
<thead>
	<tr>
	<td>First name</td>
	<td>Last name</td>
	<td>Age</td>
	<td><div><input type = "submit" name = "delete" value="Delete Mulitple"></div></td>
	
	</tr>

</thead>

<tbody>
 <?php while($row = $people->fetch_assoc()) :?>
 <tr>
	<td><?php echo $row['first_name']?></td>
	<td><?php echo $row['last_name']?></td>
	<td><?php echo $row['age']?></td>
	<td align="center">
	 <input type = "checkbox" name="multiple[]" value="<?php echo $row['id'];?>">
	</td>
	
	
	
	</tr>
 
 <?php endwhile;?>

</tbody>


</table>


</form>
<?php else:?>
<p>Sorry, nothing here</p>
<?php endif;?>

</div>
</body>
</html>