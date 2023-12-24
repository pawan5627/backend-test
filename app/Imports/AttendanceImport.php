<?php
namespace App\Imports;

use src\AppHumanResources\Attendance\Domain\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;

class AttendanceImport implements ToModel
{
    public function model(array $row)
    {
        return new Attendance([
            'employee_id' => $row[0],  // adjust based on your Excel structure
            'schedule_id' => $row[1],
            'date' => $row[2],
            'clock_in' => $row[3],
            'clock_out' => $row[4],
            // Add other columns as needed
        ]);
    }
}
