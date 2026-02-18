<?php

namespace App\Services;

use App\Models\Code;

class CodeService
{
    /**
     * Generates a unique 10-digit numeric code.
     * Prevents collisions by verifying against the database 
     * and an optional array of already generated codes in the current batch.
     *
     * @param array $excludeCodes Codes generated in the current process to prevent in-batch collisions.
     * @return string
     */
    public function generateUniqueCode(array $excludeCodes = []): string
    {
        do {
            $code = str_pad((string) random_int(0, 9999999999), 10, '0', STR_PAD_LEFT);
        } while (in_array($code, $excludeCodes, true) || Code::where('code', $code)->exists());

        return $code;
    }
}