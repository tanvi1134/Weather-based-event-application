<?php
include_once '../config/connection.php'; 
include_once '../models/Event.php'; 


$eventModel = new Event($conn);


$error = '';
$message = '';


session_start();

// Handle create event
if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    $location = $_POST['location'];

    // Fetch weather forecast
    $weather = $eventModel->getWeatherForecast($location, $event_date);

    $weatherDescription = $weather ? $weather['weather']['description'] : 'NO forecast Available';
    if ($weather && (strpos(strtolower($weatherDescription), 'rain') !== false || strpos(strtolower($weatherDescription), 'storm') !== false)) {
        $error = "Bad weather expected on the selected date. Please choose a different date.";
        $_SESSION['toast_message'] = $error;
        $_SESSION['toast_type'] = 'error';
        header('Location: ../views/create_event.php');
        exit();
    } else {
        if ($eventModel->createEvent($title, $description, $event_date, $location)) {
            $message = "Event created successfully!";
            $_SESSION['toast_message'] = $message;
            $_SESSION['toast_type'] = 'success';
            header('Location: ../views/create_event.php');
            exit();
        } else {
            $error = "Failed to create event.";
            $_SESSION['toast_message'] = $error;
            $_SESSION['toast_type'] = 'error';
            header('Location: ../views/create_event.php');
            exit();
        }
    }
}

// Handle update event
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    $location = $_POST['location'];

   
    $weather = $eventModel->getWeatherForecast($location, $event_date);
    $weatherDescription = $weather ? $weather['weather']['description'] : '';
    if ($weather && (strpos(strtolower($weatherDescription), 'rain') !== false || strpos(strtolower($weatherDescription), 'storm') !== false)) {
        $error = "Bad weather expected on the selected date. Please choose a different date.";
        $_SESSION['toast_message'] = $error;
        $_SESSION['toast_type'] = 'error';
        header('Location: ../views/update_event.php?id=' . $id);
        exit();
    } else {
        if ($eventModel->updateEvent($id, $title, $description, $event_date, $location)) {
            $message = "Event updated successfully!";
            $_SESSION['toast_message'] = $message;
            $_SESSION['toast_type'] = 'success';
            header('Location: ../views/update_event.php?id=' . $id);
            exit();
        } else {
            $error = "Failed to update event.";
            $_SESSION['toast_message'] = $error;
            $_SESSION['toast_type'] = 'error';
          
            header('Location: ../views/update_event.php?id=' . $id);
            exit();
        }
    }
}

// Handle delete event
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if ($eventModel->deleteEvent($id)) {
        $message = "Event deleted successfully!";
        $_SESSION['toast_message'] = $message;
        $_SESSION['toast_type'] = 'success';
    } else {
        $error = "Failed to delete event.";
        $_SESSION['toast_message'] = $error;
        $_SESSION['toast_type'] = 'error';
    }
    header('Location: ../controllers/EventController.php');
    exit();
}

$events = $eventModel->getEvents();

include '../views/view_event.php';
?>
