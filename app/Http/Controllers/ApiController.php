<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lesson;

use Illuminate\Support\Facades\Response;

use App\Sunil\Transformers\LessonTransformer;

class ApiController extends Controller{

	// 200 by default
	protected $statusCode = 200;

	public function getStatusCode(){
		return $this->statusCode;
	}

	public function setStatusCode($statusCode){
		$this->statusCode = $statusCode;
		return $this;
	}

	public function respondNotFound($message = 'Not Found!'){

		return $this->setStatusCode(404)->respondWithError($message);

	}

	public function respond($data, $headers = []){
		return Response::json($data, $this->getStatusCode(), $headers);
	}

	public function respondWithError($message){
		return $this->respond([
				'error' => [
					'message' => $message,
					'status_code' => $this->getStatusCode()
				]
			]);
	}

	public function respondCreated($message){
		return $this->setStatusCode(201)->respond(['message'=>$message]);
	}

}