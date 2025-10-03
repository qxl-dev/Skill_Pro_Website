
<?php
require __DIR__ . '/config/db.php';
require __DIR__ . '/partials/header.php';

/* --- Params & Date helpers --- */
$year  = isset($_GET['year'])  ? max(1970, (int)$_GET['year']) : (int)date('Y');
$month = isset($_GET['month']) ? max(1, min(12, (int)$_GET['month'])) : (int)date('n');

$firstDay      = new DateTime("$year-$month-01");
$daysInMonth   = (int)$firstDay->format('t');
$startWeekDay  = (int)$firstDay->format('N'); // 1=Mon ... 7=Sun
$todayStr      = (new DateTime())->format('Y-m-d');

$monthStartStr = $firstDay->format('Y-m-01');
$monthEndStr   = $firstDay->format('Y-m-t');

/* --- Fetch events that overlap this month (safe if offerings missing) --- */
$eventsByDate = [];  // 'YYYY-MM-DD' => [ [title, mode, location], ... ]

try {
  // Any offering that overlaps the month (start <= monthEnd AND end >= monthStart)
  $stmt = $pdo->prepare("
    SELECT c.title, o.mode, o.location, o.start_date, o.end_date
    FROM course_offerings o
    JOIN courses c ON c.id = o.course_id
    WHERE o.start_date <= ? AND o.end_date >= ?
    ORDER BY o.start_date
  ");
  $stmt->execute([$monthEndStr, $monthStartStr]);
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Expand ranges day-by-day within this month
  foreach ($rows as $r) {
    $start = new DateTime(max($monthStartStr, $r['start_date']));
    $end   = new DateTime(min($monthEndStr,   $r['end_date']));
    for ($d = clone $start; $d <= $end; $d->modify('+1 day')) {
      $key = $d->format('Y-m-d');
      $eventsByDate[$key][] = [
        'title'    => $r['title'],
        'mode'     => $r['mode'],
        'location' => $r['location'],
      ];
    }
  }
} catch (PDOException $e) {
  // Fallback (no offerings table): show courses on first day of month as TBA
  try {
    $stmt = $pdo->query("SELECT title FROM courses ORDER BY id");
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($courses as $c) {
      $eventsByDate[$monthStartStr][] = [
        'title'    => $c['title'],
        'mode'     => 'TBA',
        'location' => 'TBA'
      ];
    }
  } catch (PDOException $e2) {
    // ignore – calendar will render empty
  }
}

/* --- Month/Year options --- */
function monthOptions($selected) {
  $names = [1=>'January','February','March','April','May','June','July','August','September','October','November','December'];
  $out = '';
  for ($m=1; $m<=12; $m++) {
    $sel = $m == $selected ? 'selected' : '';
    $out .= "<option value=\"$m\" $sel>{$names[$m]}</option>";
  }
  return $out;
}
function yearOptions($selected) {
  $yNow = (int)date('Y');
  $out = '';
  for ($y = $yNow - 3; $y <= $yNow + 3; $y++) {
    $sel = $y == $selected ? 'selected' : '';
    $out .= "<option value=\"$y\" $sel>$y</option>";
  }
  return $out;
}
?>




<h2>Event Calendar</h2>

<link rel="stylesheet" href="assets/css/calendar.css">

<div class="calendar-wrap">

  <div class="cal-header">
    <?php
      $prev = (clone $firstDay)->modify('-1 month');
      $next = (clone $firstDay)->modify('+1 month');
    ?>
    <a class="nav-btn" href="calendar.php?year=<?= $prev->format('Y') ?>&month=<?= $prev->format('n') ?>">&#8592; Prev</a>

    <form class="selectors" method="get" onChange="this.submit()">
      <select name="month"><?= monthOptions($month) ?></select>
      <select name="year"><?= yearOptions($year) ?></select>
      <noscript><button type="submit">Go</button></noscript>
    </form>

    <div>
      <a class="nav-btn" href="calendar.php?year=<?= date('Y') ?>&month=<?= date('n') ?>">Today</a>
      <a class="nav-btn" href="calendar.php?year=<?= $next->format('Y') ?>&month=<?= $next->format('n') ?>">Next &#8594;</a>
    </div>
  </div>

  <div class="cal-legend">
    Showing: <strong><?= $firstDay->format('F Y') ?></strong>
  </div>

  <div class="cal-grid">
    <!-- Day-of-week headers (Mon–Sun) -->
    <div class="dow">Mon</div><div class="dow">Tue</div><div class="dow">Wed</div>
    <div class="dow">Thu</div><div class="dow">Fri</div><div class="dow">Sat</div><div class="dow">Sun</div>

    <?php
      // Leading blanks (Mon=1 -> render 0 blanks, Tue=2 -> 1 blank, ... Sun=7 -> 6 blanks)
      for ($i=1; $i<$startWeekDay; $i++) {
        echo '<div class="day other"></div>';
      }

      // Days of month
      for ($day=1; $day <= $daysInMonth; $day++) {
        $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $day);
        $isToday = ($dateStr === $todayStr);
        $cls = 'day' . ($isToday ? ' today' : '');

        echo "<div class=\"$cls\">";
        echo "<div class=\"date\">$day</div>";

        if (!empty($eventsByDate[$dateStr])) {
          foreach ($eventsByDate[$dateStr] as $ev) {
            $title = htmlspecialchars($ev['title']);
            $mode  = htmlspecialchars($ev['mode']);
            $loc   = htmlspecialchars($ev['location']);
            echo "<div class=\"ev\">
                    <span class=\"t\">$title</span>
                    <span class=\"m\">$mode · $loc</span>
                  </div>";
          }
        }

        echo "</div>";
      }

      // Trailing blanks to complete the grid
      $cellsUsed = ($startWeekDay - 1) + $daysInMonth;
      $remain = (7 - ($cellsUsed % 7)) % 7;
      for ($i=0; $i<$remain; $i++) {
        echo '<div class="day other"></div>';
      }
    ?>
  </div>
</div>

<!-- // upcoming events -->

<div class="upcoming">
  <h2>Upcoming Events</h2>
  <ul>
    <?php if ($eventsByDate): ?>
      <?php 
        $futureEvents = [];
        foreach ($eventsByDate as $date => $items) {
          if ($date >= date("Y-m-d")) {
            foreach ($items as $ev) {
              $futureEvents[] = [$date, $ev['title'], $ev['mode'], $ev['location']];
            }
          }
        }
        usort($futureEvents, fn($a,$b) => strcmp($a[0], $b[0]));
        $futureEvents = array_slice($futureEvents, 0, 5);
      ?>
      <?php foreach ($futureEvents as $fe): ?>
        <li>
          <strong><?= htmlspecialchars($fe[1]) ?></strong> 
          (<?= htmlspecialchars($fe[2]) ?> - <?= htmlspecialchars($fe[3]) ?>)  
          <br><small><?= date("F j, Y", strtotime($fe[0])) ?></small>
        </li>
      <?php endforeach; ?>
    <?php else: ?>
      <li>No upcoming events.</li>
    <?php endif; ?>
  </ul>
</div>


<?php require __DIR__ . '/partials/footer.php'; ?>
