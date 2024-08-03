<!DOCTYPE html>
<html>
<head>
    <title>Create Event</title>
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
    session_start();

    if (isset($_SESSION['toast_message'])) {
        $message = $_SESSION['toast_message'];
        $type = $_SESSION['toast_type'];
        echo "<script>
            window.onload = function() {
                showToast('$message', '$type');
                setTimeout(function() {
                    // Redirect only if the toast message is a success message
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

    <div class="container mt-4">
        <div class="form-container">
            <form method="POST" action="../controllers/EventController.php" id="submit_form" onsubmit="return validation()">
                <h1 class="text-center">Create Event</h1>
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" class="form-control">
                <span id="titlee"></span>
                <br>
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control"></textarea>
                <span id="desc"></span>
                <br>
                <label for="event_date">Event Date:</label>
                <input type="date" id="event_date" name="event_date" class="form-control">
                <span id="evedt"></span>
                <br>
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" class="form-control">
                <span id="loc"></span>
                <br>
                <div class="text-center">
                    <input type="submit" name="create" value="Create Event" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

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
                document.getElementById('evedt').innerHTML = "Please select a date";
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
            }, 2000);
        }
    </script>
</body>
</html>
