<?php
namespace AppHumanResources\Attendance\Application;

use App\Models\Attendance;

class AttendanceService
{
    public function storeAttendance(array $data)
    {
        return Attendance::create($data);
    }

    public function getEmployeeAttendance($employeeId)
    {
        return Attendance::where('employee_id', $employeeId)->get();
    }
}
