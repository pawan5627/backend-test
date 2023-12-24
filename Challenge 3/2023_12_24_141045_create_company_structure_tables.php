<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyStructureTables extends Migration
{
    public function up()
    {
        // Locations Table
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('Location name');
            $table->string('City');
            $table->string('Country');
            $table->timestamps();
        });

        // Assets Table
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('Value');
            $table->timestamps();
        });

        // Companies Table
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Company Groups Table
        Schema::create('company_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('parent_company_group_id')->nullable();
            $table->unsignedBigInteger('company_id');
            $table->timestamps();
            $table->foreign('parent_company_group_id')->references('id')->on('company_groups')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');
        });

        // Employees Table
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('First name');
            $table->string('Designation');
            $table->string('Department');
            $table->unsignedBigInteger('company_id');
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('companies');
        });

        // Managers Table
        Schema::create('managers', function (Blueprint $table) {
            $table->id();
            $table->string('First name');
            $table->string('Designation');
            $table->string('Department');
            $table->unsignedBigInteger('company_id');
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('companies');
        });

        // People Table
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('First name');
            $table->string('Last Name');
            $table->string('email');
            $table->string('address');
            $table->string('phone number');
            $table->string('gender');
            $table->string('CNIC No.');
            $table->timestamps();
        });
    }

    public function down()
    {
        // Drop tables in reverse order to avoid foreign key constraint issues
        Schema::dropIfExists('people');
        Schema::dropIfExists('managers');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('company_groups');
        Schema::dropIfExists('assets');
        Schema::dropIfExists('locations');
        Schema::dropIfExists('companies');
    }
}
