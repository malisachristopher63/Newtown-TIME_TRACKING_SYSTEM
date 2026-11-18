<?php
$siteName = "NEWTOWN LOGISTICS";

// SAMPLE DATA: later this comes from the database (attendance_events table)
$records = [
  ["name" => "Juma Mwangi",  "site" => "Main Depot", "in" => "07:52", "out" => "",      "distance" => 34],
  ["name" => "Asha Salim",   "site" => "Main Depot", "in" => "08:10", "out" => "16:45", "distance" => 12],
  ["name" => "Peter Moshi",  "site" => "Warehouse B", "in" => "08:31", "out" => "",     "distance" => 71],
  ["name" => "Neema John",   "site" => "Main Depot", "in" => "",      "out" => "",      "distance" => 0],
];

// Count the stats from the array
$onSite = 0;
$left   = 0;
$absent = 0;

foreach ($records as $r) {
  if ($r["in"] !== "" && $r["out"] === "") {
    $onSite++;
  } elseif ($r["in"] !== "" && $r["out"] !== "") {
    $left++;
  } else {
    $absent++;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $siteName; ?> | Admin</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <header class="topbar">
    <h1><?php echo $siteName; ?></h1>
    <p>Manager dashboard</p>
    <nav class="nav">
      <a href="index.php">Check-in page</a>
      <a href="admin.php">Dashboard</a>
    </nav>
  </header>

  <main class="container wide">

    <!-- Summary cards -->
    <section class="stats">
      <div class="stat"><span class="num"><?php echo $onSite; ?></span>On site</div>
      <div class="stat"><span class="num"><?php echo $left; ?></span>Checked out</div>
      <div class="stat"><span class="num"><?php echo $absent; ?></span>Not arrived</div>
    </section>

    <!-- Today's attendance -->
    <section class="card">
      <h2>Today's attendance</h2>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Worker</th>
              <th>Site</th>
              <th>Arrived</th>
              <th>Departed</th>
              <th>Distance (m)</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($records as $r): ?>
              <tr>
                <td><?php echo htmlspecialchars($r["name"]); ?></td>
                <td><?php echo htmlspecialchars($r["site"]); ?></td>
                <td><?php echo $r["in"]  !== "" ? $r["in"]  : "-"; ?></td>
                <td><?php echo $r["out"] !== "" ? $r["out"] : "-"; ?></td>
                <td><?php echo $r["distance"]; ?></td>
                <td>
                  <?php if ($r["in"] !== "" && $r["out"] === ""): ?>
                    <span class="badge on">On site</span>
                  <?php elseif ($r["in"] !== ""): ?>
                    <span class="badge done">Left</span>
                  <?php else: ?>
                    <span class="badge off">Absent</span>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>

    <!-- Add a work site (not connected yet) -->
    <section class="card">
      <h2>Add work site</h2>
      <form method="post" action="#">
        <label for="siteName">Site name</label>
        <input type="text" id="siteName" name="site_name" placeholder="e.g. Main Depot">

        <div class="grid3">
          <div>
            <label for="lat">Latitude</label>
            <input type="text" id="lat" name="latitude">
          </div>
          <div>
            <label for="lng">Longitude</label>
            <input type="text" id="lng" name="longitude">
          </div>
          <div>
            <label for="radius">Radius (m)</label>
            <input type="number" id="radius" name="radius" value="100">
          </div>
        </div>

        <button type="submit" class="btn">Save site</button>
      </form>
    </section>

  </main>
</body>
</html>