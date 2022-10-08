<?php
header ('Content-type: text/html; charset=ISO-8859-1');
//fetch_user.php

include('database_connection.php');

session_start();

// $query = "
// SELECT * FROM login 
// WHERE user_id != '".$_SESSION['user_id']."' 
// ";

$query = "
SELECT DISTINCT from_user_id FROM chat_message 
WHERE to_user_id = '".$_SESSION['user_id']."' 
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

?>

<table style="background-color: #fff;" class="table table-bordered table-striped">
		<tr>
			<th width="70%">Usuário</td> 
			<th width="10%">Ação</td>
		</tr>

<?php

foreach($result as $row){
 
	$querya = "
	SELECT * FROM login 
	WHERE user_id = '".$row['from_user_id']."' 
	"; 
	$statementa = $connect->prepare($querya);

	$statementa->execute();

	$resulta = $statementa->fetchAll();

	$output = '
	
	';

	foreach($resulta as $row)
	{
		$status = '';
		$current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
		$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
		$user_last_activity = fetch_user_last_activity($row['user_id'], $connect);
		// if($user_last_activity > $current_timestamp)
		// {
		// 	$status = '<span class="label label-success">Online</span>';
		// }
		// else
		// {
		// 	$status = '<span class="label label-danger">Offline</span>';
		// }
		$output .= '
		<tr>
			<td>'.$row['username'].' '.count_unseen_message($row['user_id'], $_SESSION['user_id'], $connect).' '.fetch_is_type_status($row['user_id'], $connect).'</td>
			
			<td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['username'].'">Chat</button></td>
		</tr>
		';
	}

	$output .= '';

	echo $output;


}

?>

</table>