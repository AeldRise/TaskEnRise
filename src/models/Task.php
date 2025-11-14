<?php
namespace App\Models;
class Task
{
    private int $id;
    private string $title;
    private string $status;

    function __construct(string $title, string $status)
    {
        $this->title = $title;
        $this->status = $status;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}