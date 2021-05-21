<?php

$client = curl_init();
curl_setopt_array($client, array(
	CURLOPT_URL => 'http://127.0.0.1/api/get_all.php',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'GET',
  ));
$response = curl_exec($client);
$result = json_decode($response);

$output = '';

if(count($result) > 0)
{
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td>'.$row->id.'</td>
			<td>'.$row->nome.'</td>
			<td>'.$row->sexo.'</td>
			<td>'.$row->idade.'</td>
			<td>'.$row->hobby.'</td>
			<td>'.$row->dnascto.'</td>
			<td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id.'">Editar</button>
			    <button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id.'">Apagar</button></td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="8" align="center">Sem registros para mostrar</td>
	</tr>
	';
}

echo $output;

?>
