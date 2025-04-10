<?php

namespace MissaelAnda\Whatsapp\Messages\Components\Parameters;

use Illuminate\Support\Str;
use MissaelAnda\Whatsapp\Messages\Message;

class Text implements Message
{
    public static function create(string $text = '', ?string $name = null): static
    {
        return new static($text, $name);
    }

    public function __construct(
        public string $text,
        public ?string $name = null,
    ) {
        //
    }

    public function text(string $text): static
    {
        $this->text = $text;
        return $this;
    }

    public function name(string $name): static
    {
        $this->name = Str::snake($name);
        return $this;
    }

    public function toArray()
    {
        $payload = [
            'type' => 'text',
            'text' => str_replace(["\n", "\t", "\r"], ['\n', '\t', '\r'], $this->text),
        ];
        if ($this->name) {
            $payload['paramter_name'] = $this->name;
        }
        return $payload;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
