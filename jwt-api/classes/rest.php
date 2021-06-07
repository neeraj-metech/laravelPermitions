<?php 

/**
 * 
 */
class rest
{
	protected $request;
	protected $param;
	
	function __construct()
	{
		$handler = fopen('php://input','r');
		$this->request = stream_get_contents($handler);
		$this->validateRequest();
	}

	public function validateRequest(){
		if($_SERVER['CONTENT_TYPE'] !== 'application/json') {
				$this->throwError('401', 'Request content type is not valid');
			}

			$data = json_decode($this->request, true);

			if(!isset($data['name']) || $data['name'] == "") {
				$this->throwError('401', "API name is required.");
			}
			$this->serviceName = $data['name'];

			if(!is_array($data['param'])) {
				$this->throwError('401', "API PARAM is required.");
			}
			$this->param = $data['param'];
	}

	public function throwError($code,$msg){
		header("content-type: application/json");
		$errorMsg = json_encode(['error' => ['status'=>$code, 'message'=>$message]]);
		echo $errorMsg; exit;
	}


}



 ?>