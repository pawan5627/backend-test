<?php

namespace Tests\Unit;

use App\Services\GroupByOwnersService;
use PHPUnit\Framework\TestCase;

class GroupByOwnersServiceTest extends TestCase
{
    public function testGroupFilesByOwners()
    {
        $groupByOwnersService = new GroupByOwnersService();

        $files = [
            "insurance.txt" => "Company A",
            "letter.docx" => "Company A",
            "Contract.docx" => "Company B",
        ];

        $expectedResult = [
            "Company A" => ["insurance.txt", "letter.docx"],
            "Company B" => ["Contract.docx"],
        ];

        $result = $groupByOwnersService->groupFilesByOwners($files);

        $this->assertEquals($expectedResult, $result);
    }
}
