<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Alumni Office - Reports</title>
  <link rel="stylesheet" href="style.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
  
</head>

<body>
  <div class="container">
    <div class="main-content">
      <header style="display: flex; flex-direction: column; align-items: center;">
        <!-- Moved the buttons here -->
        <div class="header-buttons">
          <button style="font-size: 14px; padding: 6px 12px;" onclick="location.href='ALUMNI OFFICE ADMIN SITE.html'">
            <i class="fas fa-arrow-circle-left"></i> BACK
          </button>
          <button style="font-size: 14px; padding: 6px 12px;" onclick="scrollToAddEventForm()">
            <i class="fas fa-file-alt"></i> Add a Report
          </button>
        </div>
        <h1>Alumni Office - Reports</h1>
      </header>

      <section id="events">
        <h2>List of Generated Reports</h2>
        <div id="notification"></div>
        <br/>

        <div class="table-scroll-wrapper">
          <table id="eventsTable">
            <tr>
              <th>Report_ID</th>
              <th>Report Title/Name</th>
              <th>Date Created</th>
              <th>Created By</th>
              <th>Report Type</th>
              <th>Date Range</th>
              <th>Notes/Remarks</th>
              <th>Action</th>
            </tr>
          </table>

          <br/>
          <h3 id="addEventSection">Add a Report</h3>
          <form id="eventForm">
            <div class="form-group" style="display: flex; flex-direction: column; gap: 10px;">
              <input type="text" id="reportID" placeholder="Report_ID" required />
              <input type="text" id="reportTitle" placeholder="Report Title/Name" required />
              <input type="date" id="dateCreated" placeholder="Date Created" required />
              <input type="text" id="createdBy" placeholder="Created By" required />
              <input type="text" id="reportType" placeholder="Report Type" required />
              <input type="text" id="dateRange" placeholder="Date Range" required />
              <input type="text" id="remarks" placeholder="Notes/Remarks" required />
              <button type="button" onclick="addEvent()">Insert</button>
            </div>
          </form>
        </div>
      </section>

      <script>
        function scrollToAddEventForm() {
          const addEventSection = document.getElementById("addEventSection");
          addEventSection.scrollIntoView({ behavior: "smooth" });
        }

        let events = JSON.parse(localStorage.getItem("alumniReports")) || [];

        function saveEvents() {
          localStorage.setItem("alumniReports", JSON.stringify(events));
        }

        function renderEvents() {
          const table = document.getElementById("eventsTable");
          table.innerHTML = `
            <tr>
              <th>Report_ID</th>
              <th>Report Title/Name</th>
              <th>Date Created</th>
              <th>Created By</th>
              <th>Report Type</th>
              <th>Date Range</th>
              <th>Notes/Remarks</th>
              <th>Action</th>
            </tr>
          `;
          events.forEach((e, index) => {
            const row = document.createElement("tr");
            row.innerHTML = `
              <td>${e.reportID}</td>
              <td>${e.reportTitle}</td>
              <td>${e.dateCreated}</td>
              <td>${e.createdBy}</td>
              <td>${e.reportType}</td>
              <td>${e.dateRange}</td>
              <td>${e.remarks}</td>
              <td>
                <button onclick="editEvent(${index})">Update</button>
                <button onclick="deleteEvent(${index})">Delete</button>
              </td>
            `;
            table.appendChild(row);
          });
        }

        function addEvent() {
          let reportID = document.getElementById("reportID").value;
          let reportTitle = document.getElementById("reportTitle").value;
          let dateCreated = document.getElementById("dateCreated").value;
          let createdBy = document.getElementById("createdBy").value;
          let reportType = document.getElementById("reportType").value;
          let dateRange = document.getElementById("dateRange").value;
          let remarks = document.getElementById("remarks").value;

          if (reportID && reportTitle && dateCreated && createdBy && reportType && dateRange && remarks) {
            events.push({ reportID, reportTitle, dateCreated, createdBy, reportType, dateRange, remarks });
            saveEvents();
            renderEvents();
            document.getElementById("eventForm").reset();
            showNotification("Report added successfully!", "success");
          } else {
            showNotification("Please fill in all fields.", "error");
          }
        }

        function editEvent(index) {
          let e = events[index];
          let reportID = prompt("Update Report_ID", e.reportID);
          let reportTitle = prompt("Update Report Title/Name", e.reportTitle);
          let dateCreated = prompt("Update Date Created", e.dateCreated);
          let createdBy = prompt("Update Created By", e.createdBy);
          let reportType = prompt("Update Report Type", e.reportType);
          let dateRange = prompt("Update Date Range", e.dateRange);
          let remarks = prompt("Update Notes/Remarks", e.remarks);

          if (reportID && reportTitle && dateCreated && createdBy && reportType && dateRange && remarks) {
            events[index] = { reportID, reportTitle, dateCreated, createdBy, reportType, dateRange, remarks };
            saveEvents();
            renderEvents();
            showNotification("Report updated successfully!", "success");
          }
        }

        function deleteEvent(index) {
          events.splice(index, 1);
          saveEvents();
          renderEvents();
          showNotification("Report deleted successfully!", "error");
        }

        function showNotification(message, type) {
          const notification = document.getElementById("notification");
          notification.innerText = message;
          notification.style.color = type === "success" ? "green" : "red";
          setTimeout(() => {
            notification.innerText = "";
          }, 3000);
        }

        renderEvents();
      </script>

      <footer>
        <center><p>&copy; 2025 Alumni Office. All rights reserved.</p></center>
      </footer>
    </div>
  </div>
</body>
</html>