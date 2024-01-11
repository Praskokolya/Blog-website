<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResponseRequest;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    protected $responseRepository;
    public function __construct(ResponseRepository $responseRepository)
    {
        $this->responseRepository = $responseRepository;
    }
    protected function createResponse(ResponseRequest $request)
    {
        $requestData = $request->validated();
        $requestData['user_name'] = Auth::user()->nickname;
        $this->responseRepository->createResponse($requestData);
    }
}
