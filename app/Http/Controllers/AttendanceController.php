<?php

// app/Http/Controllers/AttendanceController.php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use AppHumanResources\Attendance\Application\AttendanceService;
use AppHumanResources\Attendance\Domain\Attendance;
use App\Imports\AttendanceImport;

class AttendanceController extends Controller
{
    private $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        $file = $request->file('file');

        Excel::import(new AttendanceImport, $file);

        return response()->json(['message' => 'Attendance data imported successfully'], 200);
    }

    public function getEmployeeAttendance($employeeId)
    {
        $employee = Employee::find($employeeId);

        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        $attendance = $this->attendanceService->getEmployeeAttendance($employeeId);

        // You can format the response as needed based on your requirements
        $formattedAttendance = $attendance->map(function ($entry) {
            return [
                'date' => $entry->date,
                'clock_in' => $entry->clock_in ?? 'N/A',
                'clock_out' => $entry->clock_out ?? 'N/A',
                // Add other columns as needed
            ];
        });

        return response()->json(['employee' => $employee, 'attendance' => $formattedAttendance]);
    }
}
