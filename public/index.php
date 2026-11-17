<?php
// Later this will check that the worker is logged in.
$siteName = "NEWTOWN LOGISTICS";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $siteName; ?> | Attendance</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <header class="topbar">
    <h1><?php echo $siteName; ?></h1>
    <p>Worker attendance</p>
  </header>

  <main class="container">
    <section class="card">
      <h2>Check in / out</h2>

      <label for="workerName">Worker name</label>
      <input type="text" id="workerName" placeholder="Enter your name">

      <button id="locateBtn" class="btn btn-outline">Get my location</button>

      <div id="status" class="status">Tap "Get my location" to begin.</div>

      <div class="actions">
        <button id="checkInBtn" class="btn" disabled>Check in</button>
        <button id="checkOutBtn" class="btn" disabled>Check out</button>
      </div>
    </section>
  </main>

  <script src="checkin.js"></script>
</body>
</html>