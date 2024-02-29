<?php

namespace App\Helpers;

class ResponseSchema
{
    /** @var bool */
    public $success = true;

    /** @var mixed */
    public $result = null;

    /** @var string */
    public $code = null;

    /** @var string */
    public $message = null;

    /** @var mixed */
    public $metadatas = null;

    public function __construct(
        bool $success = true,
        $result = null,
        string $code = 'error',
        string $message = null,
        $metadatas = null,
    ) {
        $this->fill([
            'success' => $success,
            'result' => $result,
            'code' => $code,
            'message' => $message,
            'metadatas' => $metadatas,
        ]);
    }

    public static function create(
        bool $success = true,
        $result = null,
        string $code = 'success',
        string $message = null,
        $metadatas = null,
    ) {
        return new self($success, $result, $code, $message, $metadatas);
    }

    public function fill(array $attrs)
    {
        $this->success = $attrs['success'];
        $this->result = $attrs['result'];
        $this->code = $attrs['code'];
        $this->message = $attrs['message'];
        $this->metadatas = $attrs['metadatas'];
    }

    public function send(int $status = 200, array $headers = [])
    {
        return response()->json($this->toArray(), $status, $headers);
    }

    /**
     * Return the response has error
     */
    public function error(int $status, string $code = 'error', string $message = null)
    {
        $response = clone $this;
        $response->success = false;
        $response->code = $code;
        $response->message = $message ? $message : $response->message;

        return response()->json($response->toArray(), $status);
    }

    public function toArray()
    {
        return [
            'success' => $this->success,
            'result' => $this->result,
            'code' => $this->code,
            'message' => $this->message,
            'metadatas' => $this->metadatas,
        ];
    }

    public function __call(string $method, array $args)
    {
        if (preg_match('#^with#i', $method) < 1) {
            throw new \RuntimeException("$method is not a property of $this.", 1);
        }

        $attr = strtolower(str_replace('with', '', $method));

        if (!property_exists($this, $attr)) {
            throw new \RuntimeException("$attr is not a property of $this.", 2);
        }

        $this->$attr = $args[0];

        return $this;
    }

    public function __toString()
    {
        return json_encode($this->toArray());
    }
}
