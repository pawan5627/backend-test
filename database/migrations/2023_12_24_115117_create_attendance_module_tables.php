<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceTables extends Migration
{
    public function up()
    {

        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Create shifts table
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Create locations table
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Create schedules table
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->foreignId('shift_id')->constrained();
            $table->foreignId('location_id')->constrained();
            $table->timestamps();
        });

        // Create attendance table
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->foreignId('schedule_id')->constrained();
            $table->date('date');
            $table->time('clock_in');
            $table->time('clock_out')->nullable();
            $table->timestamps();
        });

        // Create attendance faults table
        Schema::create('attendance_faults', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendance_id')->constrained();
            $table->string('fault_type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
        Schema::dropIfExists('shifts');
        Schema::dropIfExists('locations');
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('attendance_faults');
    }
}
