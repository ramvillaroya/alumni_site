<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Alumni Office User Site</title>
  <link rel="stylesheet" href="style.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>

</head>
<body>
  <div class="container">
    <button class="menu-button" onclick="toggleDashboard()">☰</button>
    <div class="sidebar hidden">
      <h2>Dashboard</h2>
      <div class="button-container">
        <button onclick="showAllEvents()"><i class="fas fa-calendar-alt"></i> View All Events</button>
        <button onclick="showUpcomingNotifications()"><i class="fas fa-bell"></i> View Upcoming Events</button>
        <button onclick=""><i class="fas fa-users"></i>View a list of Alumni Member Per Batch</button>
      </div>
    </div>

    <div class="main-content">
      <header><h1>Alumni Office User Site</h1></header>
      <section id="events">
        <h2>Event Calendar</h2>
        <div id="notification"></div>
        <table id="eventsTable">
          <tr>
            <th>Alumni Theme</th>
            <th>Batch of Year</th>
            <th>Date</th>
            <th>Venue</th>
            <th>Location</th>
          </tr>
        </table>
      </section>

      <script>
        
        const alumniEvents = [];

        function renderEvents(events) {
          const table = document.getElementById("eventsTable");
          table.innerHTML = `
            <tr>
              <th>Alumni Theme</th>
              <th>Batch of Year</th>
              <th>Date</th>
              <th>Venue</th>
              <th>Location</th>
            </tr>
          `;
          events.forEach(event => {
            const row = document.createElement("tr");
            row.innerHTML = <td>${event.theme}</td><td>${event.year}</td><td>${event.date}</td><td>${event.venue}</td><td>${event.location}</td>;
            table.appendChild(row);
          });
        }

        function showAllEvents() {
          renderEvents(alumniEvents);
          showNotification("All events loaded.", "success");
        }

        function showUpcomingNotifications() {
          const today = new Date();
          const upcoming = alumniEvents.filter(e => {
            const eventDate = new Date(e.date);
            return Math.ceil((eventDate - today) / (1000 * 60 * 60 * 24)) === 7;
          });

          if (upcoming.length > 0) {
            const msg = upcoming.map(e => Upcoming: "${e.theme}" on ${e.date} at ${e.venue}, ${e.location}).join("\n\n");
            alert(msg);
          } else {
            alert("No upcoming events within 1 week.");
          }
        }

        function showNotification(message, type) {
          const notification = document.getElementById("notification");
          notification.innerHTML = <div class="alert ${type}">${message}</div>;
          setTimeout(() => { notification.innerHTML = ""; }, 3000);
        }

        function toggleDashboard() {
          const sidebar = document.querySelector(".sidebar");
          sidebar.classList.toggle("hidden");
        }

        function goToAdmin() {
          location.href = "ALUMNI ADMIN SITE OFFICE.html";
        }

        // Load on startup
        showAllEvents();
      </script>

      <footer><center><p>&copy; 2025 Alumni Office | User Portal</p></center></footer>
    </div>
  </div>
</body>
</html>