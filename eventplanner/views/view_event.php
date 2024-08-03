<!DOCTYPE html>
<html>
<head>
    <title>View Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .toast {
            visibility: hidden;
            position: fixed;
            top: 20px;
            right: 20px;
            text-align: center;
            padding: 15px;
            border-radius: 15px;
            z-index: 10000;
            max-width: 300px;
        }
        .toast.show {
            visibility: visible;
        }
        .toast.success {
            background-color: #4CAF50;
            color: white;
        }
        .toast.error {
            background-color: #F44336;
            color: white;
        }
        .custom-thead {
            background-color: #343a40; 
            color: white; 
        }
        .container {
            position: relative;
        }
        .create-btn {
            position: absolute;
            top: 10px;
            right: 15px;
        }
    </style>
</head>
<body>
    <?php
   
    include_once '../config/connection.php';
    include_once '../models/Event.php';
    $eventModel = new Event($conn);
    $events = [];
    $events = $eventModel->getEvents();
   
    if (isset($_SESSION['toast_message'])) {
        $message = $_SESSION['toast_message'];
        $type = $_SESSION['toast_type'];
        echo "<script>
            window.onload = function() {
                showToast('$message', '$type');
            };
        </script>";
        unset($_SESSION['toast_message']);
        unset($_SESSION['toast_type']);
    }
    ?>

    <div class="container mt-4">
        <h1 align="center">Event List</h1>
        <a href="../views/create_event.php" class="btn btn-primary create-btn mb-3">Create New Event</a>
        <table class="table table-bordered table-hover text-center custom-width-table">
            <thead class="custom-thead">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Event Date</th>
                    <th>Location</th>
                    <th>Weather Forecast</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($events) && mysqli_num_rows($events) > 0): ?>
                   
                    <?php while ($event = mysqli_fetch_assoc($events)): ?>
                        <?php
                        $weather = $eventModel->getWeatherForecast($event['location'], $event['event_date']);
                        $weatherDescription = $weather ? $weather['weather']['description'] : 'No forecast available';
                        ?>
                        <tr>
                        <td><?php echo htmlspecialchars($event['id']); ?></td>
                            <td><?php echo htmlspecialchars($event['title']); ?></td>
                            <td><?php echo htmlspecialchars($event['description']); ?></td>
                            <td><?php echo htmlspecialchars($event['event_date']); ?></td>
                            <td><?php echo htmlspecialchars($event['location']); ?></td>
                            <td><?php echo htmlspecialchars($weatherDescription); ?></td>
                            <td>
                            <a href="../views/update_event.php?id=<?php echo $event['id']; ?>" class="btn btn-primary">Edit</a>
                            <a href="../controllers/EventController.php?delete=<?php echo $event['id']; ?>" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No events found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div id="toast" class="toast"></div>

    <script>
        function showToast(message, type) {
            var toast = document.getElementById('toast');
            toast.className = 'toast show ' + type;
            toast.textContent = message;
            setTimeout(function() {
                toast.className = toast.className.replace('show', '');
            }, 3000);
        }
    </script>
</body>
</html>
