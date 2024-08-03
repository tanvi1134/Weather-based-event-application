<?php
session_start();
include_once '../config/connection.php'; 
include_once '../models/Event.php'; 


$eventModel = new Event($conn);
$event = [];
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $result = $eventModel->getEventById($id);
    $event = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Event</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        span {
            color: Red;
        }
        .form-container {
            max-width: 700px;
            margin: auto; 
            padding: 20px;
            border: 1px solid grey;
            border-radius: 5px;
        }
        .form-control {
            margin-bottom: 15px; 
        }
    </style>
</head>
<body>

    <?php
  
    if (isset($_SESSION['toast_message'])) {
        $message = $_SESSION['toast_message'];
        $type = $_SESSION['toast_type'];
        echo "<script>
            window.onload = function() {
                showToast('$message', '$type');
                setTimeout(function() {
                    document.getElementById('submit_form').reset();
                    if ('$type' === 'success') {
                        window.location.href = '../controllers/EventController.php'; 
                    }
                }, 1000); // Duration of toast message display
            };
        </script>";

        unset($_SESSION['toast_message']);
        unset($_SESSION['toast_type']);
    }
    ?>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message; ?>
        </div>
    <?php else: ?>
        <div class="container mt-4">
            <div class="form-container">
                <form method="POST" action="../controllers/EventController.php" id="submit_form" onsubmit="return validation()">
                    <h1 align="center">Update Event</h1>    
                    <input type="hidden" name="id" class="form-control" value="<?php echo ($event['id']); ?>">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" class="form-control" value="<?php echo ($event['title']); ?>">
                    <span id="titlee"></span>
                    <br>
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" class="form-control"><?php echo ($event['description']); ?></textarea>
                    <span id="desc"></span>
                    <br>
                    <label for="event_date">Event Date:</label>
                    <input type="date" id="event_date" name="event_date" class="form-control" value="<?php echo ($event['event_date']); ?>">
                    <span id="evedt"></span>
                    <br>
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" class="form-control" value="<?php echo ($event['location']); ?>">
                    <span id="loc"></span>
                    <br>
                    <div class="text-center">
                        <input type="submit" name="update" value="Update Event" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <div id="toast" class="toast"></div>

    <script>
        function validation() {
            var title = document.getElementById("title").value.trim();
            var description = document.getElementById("description").value.trim();
            var event_date = document.getElementById("event_date").value.trim();
            var location = document.getElementById("location").value.trim();

            var isValid = true;
            if (title == "") {
                document.getElementById('titlee').innerHTML = "This field is required.";
                isValid = false;
            } else {
                document.getElementById('titlee').innerHTML = "";
            }
            if (description == "") {
                document.getElementById('desc').innerHTML = "This field is required.";
                isValid = false;
            } else {
                document.getElementById('desc').innerHTML = "";
            }
            if (event_date == "") {
                document.getElementById('evedt').innerHTML = "This field is required.";
                isValid = false;
            } else {
                document.getElementById('evedt').innerHTML = "";
            }
            if (location == "") {
                document.getElementById('loc').innerHTML = "This field is required.";
                isValid = false;
            } else {
                document.getElementById('loc').innerHTML = "";
            }
            return isValid;
        }

        function showToast(message, type) {
            var toast = document.getElementById('toast');
            toast.className = 'toast show ' + type;
            toast.textContent = message;
            setTimeout(function() {
                toast.className = toast.className.replace('show', '');
            }, 3000);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
