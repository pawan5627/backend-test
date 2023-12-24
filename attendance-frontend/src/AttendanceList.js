// src/components/AttendanceList.js

import React, { useState, useEffect } from 'react';
import axios from 'axios';

const AttendanceList = () => {
  const [attendance, setAttendance] = useState([]);

  useEffect(() => {
    const fetchAttendance = async () => {
      try {
        const response = await axios.get('/api/attendance');
        setAttendance(response.data);
      } catch (error) {
        console.error('Error fetching attendance:', error);
      }
    };

    fetchAttendance();
  }, []);

  return (
    <div>
      <h2>Attendance Information</h2>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Check-In</th>
            <th>Check-Out</th>
            <th>Total Working Hours</th>
          </tr>
        </thead>
        <tbody>
          {attendance.map((record) => (
            <tr key={record.id}>
              <td>{record.name}</td>
              <td>{record.clock_in || 'N/A'}</td>
              <td>{record.clock_out || 'N/A'}</td>
              <td>{calculateTotalHours(record.clock_in, record.clock_out)}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

// Function to calculate total working hours
const calculateTotalHours = (clock_in_Time, clock_out_Time) => {
    if (clock_in_Time && clock_out_Time) {
      const clock_in = new Date(clock_in_Time);
      const clock_out = new Date(clock_out_Time);

      // Calculate the time difference in milliseconds
      const timeDifference = clock_out - clock_in;

      // Convert milliseconds to hours (assuming 1 hour = 3600000 milliseconds)
      const totalHours = timeDifference / 3600000;

      // You can format the total hours as needed
      return totalHours.toFixed(2); // For example, rounding to 2 decimal places
    } else {
      return 'N/A';
    }
  };

export default AttendanceList;
