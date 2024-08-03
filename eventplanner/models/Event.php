<?php
include_once '../config/connection.php';
class Event {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createEvent($title, $description, $event_date, $location) {
        $title = mysqli_real_escape_string($this->conn, $title);
        $description = mysqli_real_escape_string($this->conn, $description);
        $event_date = mysqli_real_escape_string($this->conn, $event_date);
        $location = mysqli_real_escape_string($this->conn, $location);

        $sql = "INSERT INTO events (title, description, event_date, location) VALUES ('$title', '$description', '$event_date', '$location')";
        return mysqli_query($this->conn, $sql);
    }

    public function getEvents() {
        $query = "SELECT id, title, description, event_date, location FROM events order by id DESC";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
    
    public function getEventById($id) {
        $id = intval($id);
        $sql = "SELECT * FROM events WHERE id = $id";
        return mysqli_query($this->conn, $sql);
    }

    public function updateEvent($id, $title, $description, $event_date, $location) {
        $id = intval($id);
        $title = mysqli_real_escape_string($this->conn, $title);
        $description = mysqli_real_escape_string($this->conn, $description);
        $event_date = mysqli_real_escape_string($this->conn, $event_date);
        $location = mysqli_real_escape_string($this->conn, $location);

        $sql = "UPDATE events SET title='$title', description='$description', event_date='$event_date', location='$location' WHERE id=$id";
        return mysqli_query($this->conn, $sql);
    }

    public function deleteEvent($id) {
        $id = intval($id);
        $sql = "DELETE FROM events WHERE id=$id";
        return mysqli_query($this->conn, $sql);
    }

   public function getWeatherForecast($location, $eventDate) {
    $apiKey = 'b2611b66eeb24674b71395b8b47042e7';
    $url = "https://api.weatherbit.io/v2.0/forecast/daily?city=" . urlencode($location) . "&key=" . $apiKey;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    if (isset($data['data'])) {
        foreach ($data['data'] as $forecast) {
            if (isset($forecast['valid_date']) && $forecast['valid_date'] == $eventDate) {
                return $forecast;
            }
        }
    }

    return null;
}
}
?>
