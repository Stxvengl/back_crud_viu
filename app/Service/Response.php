<?php

namespace App\Service;

class Response
{
    public $ok = true;
    public $data = null;
    public $code = 200;
    public $message = '';
    function setok($ok = true)
    {
        $this->ok = $ok;
    }
    function GetOk($ok)
    {
        return $this->ok;
    }
    function SetData($data = null)
    {
        $this->data = $data;
    }
    function GetData()
    {
        return $this->data;
    }
    function SetCode($code = 200)
    {
        $this->code = $code;
    }
    function GetCode()
    {
        return $this->code;
    }
    function SetMessage($message = '')
    {
        $this->message = $message;
    }
    function GetMessage()
    {
        return $this->message;
    }

    public function toArray()
    {
        return [
            'ok' => $this->ok,
            'data' => $this->data,
            'message' => $this->message,
            'code' => $this->code,

        ];
    }
}
