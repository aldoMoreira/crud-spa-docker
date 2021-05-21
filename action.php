<?php

if(isset($_POST['action']))
{
	if($_POST["action"] == 'fetch_single')
	{
			$curl = curl_init();

			curl_setopt_array($curl, array(
			CURLOPT_URL => 'http://127.0.0.1/api/get.php?id='.$_POST["id"],
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			));

			$response = curl_exec($curl);

			curl_close($curl);
			echo $response; 
	}

	if($_POST['action'] == 'insert')
	{
		$form_data = array(
			'id'	    =>	$_POST['id'],
			'nome'	    =>	$_POST['nome'],
			'sexo'	    =>	$_POST['sexo'],
			'idade'	    =>	$_POST['idade'],
			'hobby'	    =>	$_POST['hobby'],
			'dnascto'	=>	$_POST['dnascto']
		);
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://127.0.0.1/api/post.php',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => json_encode($form_data),
		CURLOPT_HTTPHEADER => array(
			'Content-Type: text/plain'
		),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		$result = json_decode($response, true);
		echo $response;
	}

	if($_POST["action"] == 'update')
	{
		$form_data = array(
			'id'	    =>	$_POST['id'],
			'nome'	    =>	$_POST['nome'],
			'sexo'	    =>	$_POST['sexo'],
			'idade'	    =>	$_POST['idade'],
			'hobby'	    =>	$_POST['hobby'],
			'dnascto'	=>	$_POST['dnascto']
		);
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://127.0.0.1/api/put.php',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'PUT',
		  CURLOPT_POSTFIELDS => json_encode($form_data),
		  CURLOPT_HTTPHEADER => array(
			'Content-Type: text/plain'
		  ),
		));
		
		$response = curl_exec($curl);
		
		curl_close($curl);
		echo $response;
	}
	if($_POST["action"] == 'delete')
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://127.0.0.1/api/delete.php?id='.$_POST["id"],
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'DELETE'
		));
		$response = curl_exec($curl);
		curl_close($curl);
		echo $response; 
	}
}	
?>
