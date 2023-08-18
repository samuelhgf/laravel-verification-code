<?php

namespace NextApps\VerificationCode\Support;

use RuntimeException;

class CodeGenerator
{
    public function generate() : string
    {
        $length = $this->getLength();
        $characters = $this->getCharacters();

        return collect(range(0, $length - 1))
            ->map(function () use ($characters) {
                return $characters[rand(0, strlen($characters) - 1)];
            })
            ->join('');
    }

    protected function getLength() : int
    {
        $length = config('verification-code.length');

        if (! is_int($length)) {
            throw new RuntimeException('The code length must be an integer');
        }

        return $length;
    }

    protected function getCharacters() : string
    {
        $characters = config('verification-code.characters');

        if (! is_string($characters) || strlen($characters) <= 0) {
            throw new RuntimeException('The character list must contain at least 1 character');
        }

        return $characters;
    }
}
