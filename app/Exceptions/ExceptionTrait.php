<?php

namespace App\Exceptions;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use  Symfony\Component\HttpFoundation\Response;


trait ExceptionTrait
{

    public function apiException($request, $e)
    {
        if($this->isModelException($e)){

            return $this->ModelResponse();
        }


        if($this->isHttpException($e)){

            return $this->HttpResponse();
        }
    }

    public function isModelException($e)
    {
        return $e instanceof ModelNotFoundException;
    }


    public function isHttpException($e)
    {
        return $e  instanceof NotFoundHttpException;
    }


    public function ModelResponse()
    {
        return response()->json([

            'errors' => 'Model Product Not Found'
    ],Response::HTTP_NOT_FOUND);

    }

    public function HttpResponse()
    {
        return response()->json([

            'errors' => 'Incorrect Route'
    ],Response::HTTP_NOT_FOUND);

    }

}