<?php

namespace App\Services\Exceptions;

class ExceptionService
{
    /**
     * Get normal basic exception error page
     *
     * @param  mixed $e
     * @return void
     */
    public function viewException($e)
    {
        $errorMsg = [
            '404' => "Oops...Not found!",
            '401' => "Not authorized",
            '403' => "This action is unauthorized.",
            '422' => "Unprocessable Entity",
            '500' => "General server error",
            '419' => "Page Expired",
        ];

        $statusCode = $e->getStatusCode();
        $message = $e->getMessage();

        //if no default message found then set message from errorMsg array
        if ($message == "") {
            $message = isset($errorMsg[$statusCode]) ? $errorMsg[$statusCode] : "Internal Error";
        }

        if($statusCode == 404)$message = $errorMsg[404];

        //if request is post then output is json formate.
        if (request()->isMethod('post')) {
            return response()->json([
                'message' => $message,
            ], $statusCode);
        }

        //if request is get then show view error page.
        return response()->view('error.error', [
            'statusCode' => $statusCode,
            'message' => $message,
        ])->setStatusCode($statusCode);
    }
}
