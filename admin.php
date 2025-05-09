<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Alumni Office Admin Site</title>
  <link rel="stylesheet" href="style.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body>
  <div class="container">
    <div class="main-content">
      <header>
        <div class="logo">ALUMNI HOMECOMING</div>
        <div class="header-buttons">
          <button onclick="location.href='AlumniMemberPerBatch.html'" title="Add a list of Alumni Member Per Batch">
            <i class="fas fa-users"></i>
          </button>
          <button id="notifyButton" onclick="showUpcomingNotifications()" title="Show Notifications">
            <i class="fas fa-bell"></i>
          </button>
          <button onclick="toggleMessageForm()" title="Contact Form">
            <i class="fas fa-address-book"></i>
          </button>
          <button onclick="location.href='ADDGENERATEREPORTS.html'" title="Add Generate Reports">
            <i class="fas fa-chart-line"></i>
          </button>
        </div>
      </header>

      <h1 style="padding: 20px;">Admin</h1>

      <div id="messageForm" class="form-container hidden" style="padding: 0 20px;">
        <h3>Contact Us</h3>
        <form>
          <input type="text" id="from" placeholder="Your Name:" required /><br />
          <input type="email" id="to" placeholder="Your Email:" required /><br />
          <textarea id="message" placeholder="Enter your message" required></textarea><br />
          <button type="button" onclick="sendMessage()">Send</button>
        </form>
      </div>

      <section id="events" style="padding: 0 20px;">
        <h2>Upcoming Alumni Event Schedule</h2>
        <div id="notification"></div>
        <br />

        <div class="table-scroll-wrapper">
          <table id="eventsTable">
            <tr>
              <th>Alumni Theme</th>
              <th>Batch of Year</th>
              <th>Date</th>
              <th>Venue</th>
              <th>Location</th>
              <th>Action</th>
            </tr>
          </table>

          <br />
          <h3 id="addEventSection">Add New Alumni Event Schedules</h3>
          <form id="eventForm" method="POST" action="insert_event.php">
            <div class="form-group" style="display: flex; flex-direction: column; gap: 10px;">
              <input type="text" name="theme" id="theme" placeholder="Alumni Theme" required />
              <input type="text" name="batchYear" id="batchYear" placeholder="Batch of Year" required />
              <input type="date" name="eventDate" id="eventDate" required />
              <input type="text" name="eventVenue" id="eventVenue" placeholder="Venue" required />
              <div style="display: flex; align-items: center; gap: 10px;">
                <input type="text" name="eventLocation" id="eventLocation" placeholder="Location" required style="flex: 1;" />
                <select id="countrySelect" onchange="updateLocationOptions()" style="flex: 0.6;">
                  <option value="">--Select Campus--</option>
                  <option value="USTP Oroquieta">USTP Oroquieta</option>
                  <option value="USTP Panaon">USTP Panaon</option>
                  <option value="USTP Claveria">USTP Claveria</option>
                  <option value="USTP Jasaan">USTP Jasaan</option>
                  <option value="USTP Cagayan De Oro">USTP Cagayan De Oro</option>
                </select>
              </div>
            </div>
            <button type="submit">Insert</button>
          </form>
        </div>
      </section>
    </div>
  </div>

  <script>
    const locationData = {
      "USTP Oroquieta": { city: "Oroquieta City", address: "USTP Oroquieta Campus" },
      "USTP Panaon": { city: "Panaon", address: "USTP Panaon Campus" },
      "USTP Claveria": { city: "Claveria", address: "USTP Claveria Campus" },
      "USTP Jasaan": { city: "Jasaan", address: "USTP Jasaan Campus" },
      "USTP Cagayan De Oro": { city: "Cagayan de Oro", address: "USTP Cagayan De Oro Campus" },
    };

    function updateLocationOptions() {
      const selected = document.getElementById("countrySelect").value;
      const locationInput = document.getElementById("eventLocation");
      if (selected && locationData[selected]) {
        locationInput.value = `${locationData[selected].city}, ${locationData[selected].address}`;
      } else {
        locationInput.value = "";
      }
    }

    function toggleMessageForm() {
      document.getElementById("messageForm").classList.toggle("hidden");
    }

    function sendMessage() {
      let from = document.getElementById("from").value;
      let to = document.getElementById("to").value;
      let message = document.getElementById("message").value;
      if (from.trim() && to.trim() && message.trim()) {
        alert("Message sent from: " + from + "\nTo: " + to + "\nMessage: " + message);
        document.getElementById("from").value = "";
        document.getElementById("to").value = "";
        document.getElementById("message").value = "";
      } else {
        alert("Please fill in all fields.");
      }
    }
  </script>
</body>
</html>
