<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language
{
    public string $language;
    public int $appeared;
    public array $created;
    public bool $functional;
    public bool $objectOriented;
    public array $relation;

    public function __construct(array $data)
    {
        $this->language = $data['language'];
        $this->appeared = $data['appeared'];
        $this->created = $data['created'];
        $this->functional = $data['functional'];
        $this->objectOriented = $data['object-oriented'];
        $this->relation = $data['relation'];
    }
}
