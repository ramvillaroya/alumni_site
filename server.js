const express = require('express');
const app = express();  // Initialize the app
const mysql = require('mysql2');

// Create MySQL connection
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '', // Ensure this is the correct password
  database: 'alumni_db'
});

connection.connect((err) => {
  if (err) {
    console.error('Could not connect to MySQL:', err);
  } else {
    console.log('Connected to MySQL');
  }
});

// Middleware for parsing JSON request bodies
app.use(express.json());

// Serve static files (like your HTML and CSS)
app.use(express.static('public'));

// Routes for managing events
app.get('/events', (req, res) => {
  connection.query('SELECT * FROM events', (err, rows) => {  // Use `connection.query`
    if (err) {
      res.status(500).json({ error: 'Error fetching events' });
      return;
    }
    res.json(rows);
  });
});

app.post('/events', (req, res) => {
  const { theme, year, date, venue, location } = req.body;
  const query = 'INSERT INTO events (theme, year, date, venue, location) VALUES (?, ?, ?, ?, ?)';
  connection.query(query, [theme, year, date, venue, location], (err, result) => {  // Use `connection.query`
    if (err) {
      res.status(500).json({ error: 'Error adding event' });
      return;
    }
    res.json({ message: 'Event added successfully!', eventId: result.insertId });
  });
});

app.put('/events/:id', (req, res) => {
  const { theme, year, date, venue, location } = req.body;
  const { id } = req.params;
  const query = 'UPDATE events SET theme = ?, year = ?, date = ?, venue = ?, location = ? WHERE id = ?';
  connection.query(query, [theme, year, date, venue, location, id], (err, result) => {  // Use `connection.query`
    if (err) {
      res.status(500).json({ error: 'Error updating event' });
      return;
    }
    res.json({ message: 'Event updated successfully!' });
  });
});

app.delete('/events/:id', (req, res) => {
  const { id } = req.params;
  const query = 'DELETE FROM events WHERE id = ?';
  connection.query(query, [id], (err, result) => {  // Use `connection.query`
    if (err) {
      res.status(500).json({ error: 'Error deleting event' });
      return;
    }
    res.json({ message: 'Event deleted successfully!' });
  });
});

// Start server
const port = 3000; // Define your port
app.listen(port, () => {
  console.log(`Server running on http://localhost:${port}`);
});
