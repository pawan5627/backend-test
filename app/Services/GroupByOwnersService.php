<?php

namespace App\Services;

class GroupByOwnersService
{
    public function groupFilesByOwners(array $files)
    {
        $result = [];

        foreach ($files as $file => $owner) {
            $result[$owner][] = $file;
        }

        return $result;
    }
}
