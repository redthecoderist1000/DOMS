document.addEventListener('DOMContentLoaded', function() {
    // Cache element references for better performance
    const studentIDInput = document.getElementById('studentID');
    const studentIDField = document.getElementById('studentIDField');
    const nameField = document.getElementById('nameField');
    const courseField = document.getElementById('courseField');
    const violationTableBody = document.getElementById('violationTableBody');  // Assuming this exists in your HTML
  
    // Function to handle student ID input and update student information
    const updateStudentInfo = function() {
      const studentID = studentIDInput.value;
      console.log(studentID); // Optional for debugging
  
      const xhr = new XMLHttpRequest();
      xhr.open('GET', `php/fetch_student_data.php?student_id=${studentID}`, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          const responseData = JSON.parse(xhr.responseText);
  
          studentIDField.value = responseData.studentID;
          nameField.value = responseData.name;
          courseField.value = `${responseData.course} - ${responseData.section}`;
  
          // Update modal content
          document.getElementById('stundet_name').textContent = responseData.name;
          document.getElementById('student_id').textContent = responseData.studentID;
          document.getElementById('stundet_course').textContent = responseData.course;
          document.getElementById('stundet_dept').textContent = responseData.department;
          document.getElementById('stundet_email').textContent = responseData.email;
  
          // Update violation table
          violationTableBody.innerHTML = ''; // Clear existing rows before populating
          if (responseData.violation_type) {
            const row = document.createElement('tr');
  
            const violationTypeCell = document.createElement('td');
            violationTypeCell.textContent = responseData.violation_type;
            row.appendChild(violationTypeCell);
  
            const offenseTypeCell = document.createElement('td');
            offenseTypeCell.textContent = responseData.offense_type;
            row.appendChild(offenseTypeCell);
  
            const dateCreatedCell = document.createElement('td');
            dateCreatedCell.textContent = responseData.date_created;
            row.appendChild(dateCreatedCell);
  
            violationTableBody.appendChild(row);
          } else {
            const noViolationRow = document.createElement('tr');
            const noViolationCell = document.createElement('td');
            noViolationCell.setAttribute('colspan', '3');
            noViolationCell.textContent = 'No Violation was made';
            noViolationRow.appendChild(noViolationCell);
            violationTableBody.appendChild(noViolationRow);
          }
        }
      };
      xhr.send();
    };
  
    // Event listener for student ID input
    studentIDInput.addEventListener('input', updateStudentInfo);
  
    // Function to handle print button click
    const handlePrint = function() {
      const violationType = document.getElementById('violation_type').value;
      const studentID = document.getElementById('studentID').value;
  
      const printWindow = window.open(`printable/print.php?violation_type=${encodeURIComponent(violationType)}&studentID=${encodeURIComponent(studentID)}`, '_blank');
  
      printWindow.addEventListener('load', function() {
        printWindow.print();
        printWindow.close();
      }, { once: true });
    };
  
    // Event listener for print button
    document.getElementById('printBtn').addEventListener('click', handlePrint);
  
    // Function to handle offense type selection (assuming this functionality exists)
    // ... (code for offense type selection can be placed here)
  
    // Function to handle violation type selection (assuming this functionality exists)
    // ... (code for violation type selection can be placed here)
  });
  