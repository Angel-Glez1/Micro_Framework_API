<?php


// Sirve para hacer un response de tipo JSON
function responseJSON(int $codeHttp, bool $state,  string $msg, $data = [], $info = []){

	$response = [
		'ok' => $state,
		'msg' => $msg,
		'data' => $data,
		'info' => (object)$info
	];


	header("Content-Type: application/json");
	http_response_code($codeHttp);
	echo json_encode( $response ,JSON_UNESCAPED_UNICODE);
	exit;
}

function debugear($data)
{

    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    exit;
}

function request()
{
    $dataSanitizada = [];
    $dataPOST = $_POST ?? [];
    $dataGET = $_GET ?? [];
    $dataJSON = json_decode(file_get_contents("php://input"), true) ?? []; 


    $data = array_merge($dataPOST, $dataGET, $dataJSON);


    foreach ($data as $key => $value) {
        $dataSanitizada[htmlspecialchars($key)] = htmlspecialchars($value);
    }


    $dataSanitizada['__FILE'] = $_FILES ?? [];
    return $dataSanitizada;
       
}



function readFileTypeJSON($pathFile = ''){

    $response = [
        'ok' => '',
        'msg' => '',
        'data' => [],
    ];

    try {
        
        $json = file_get_contents($pathFile);
        $data = json_decode($json, true);

        $response['ok'] = true;
        $response['msg'] = "Archivo leido exitosamente";
        $response['data'] = $data;

    } catch (Exception $e) {

        $response['ok'] = false;
        $response['msg'] = $e->getMessage();

    }

    return (object)$response;


    
}
