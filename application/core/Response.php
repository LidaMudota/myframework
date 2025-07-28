<?php
class Response
{
    private int $status = 200;

    public function setStatus(int $status): void
    {
        http_response_code($status);
        $this->status = $status;
    }

    public function getStatus(): int
    {
        return $this->status;
    }
}