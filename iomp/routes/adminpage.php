<?php
require("../api/connect.php");
session_start();

$groupdata = mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM nominee WHERE `role`=1 or `role`=2"));
$_SESSION["groupdata"] = $groupdata;

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin</title>
  <link rel="stylesheet" href="../css/adminpage.css" />
  <link rel="stylesheet" href="../css/index.css" />
  <script src="https://kit.fontawesome.com/5291e76286.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class="header">
    <img src="../img/logo.png" alt="an image" style="height: 40%; width: 30%; margin-top: 10px; margin-bottom: 5px" />
    <div class="text-center" style="float: right; margin: 5px; margin-right: 1rem">
      <button class="btn" style="padding: 8px">
        <a href="../api/logout.php">Logout</a>
      </button>
    </div>
  </div>
  <hr />
  <h1>Welcome To The Admin Page</h1>
  <section>
    <div class="scroll-text">
      <p>
        !!!NOTICE!!! Admin can Reigister candidates who are willing to participate in the upcoming CR/V-CR
        elections.Here Admin can also check the voting results .Voting is an important way to make
        your voice heard and participate in the democratic process.
      </p>
    </div>
  </section>
  <div class="cardbox">
    <div class="card">
      <div>
        <div class="numbers">
          <?php
          $query_run = mysqli_query($connect, "SELECT id from user where is_verified=1");
          $row1 = mysqli_num_rows($query_run);
          echo $row1;
          ?>
        </div>
        <div class="cardname">Total Voters</div>
      </div>
      <div class="iconbx"><i class="fas fa-vote-yea"></i></div>
    </div>

    <div class="card">
      <div>
        <div class="numbers">
          <?php
          $query_run = mysqli_query($connect, "SELECT id from nominee order by id");
          $row = mysqli_num_rows($query_run);
          echo $row;
          ?></div>
        <div class="cardname">Total Candidates</div>
      </div>
      <div class="iconbx"><i class="fas fa-users"></i></div>
    </div>
  </div>
  <div class="btn-gp">
    <a href="../routes/csignup.html"><button class="btn btn-stl" style="font-size:larger">Register a Candidate</button>
    </a>
  </div>
  <div>
    <a href="#result"><button style="font-size:larger" class="btn btn-stl" onclick="popup('login-popup')">View Results</button> </a>
  </div>
  <section id="result">
    <div class="popup-container" id="login-popup">
      <div class="popup" style="width: fit-content;  background:rgba(255, 255, 255, 0.644) ;">
        <table style="border: 1px solid gray;  border-collapse: collapse; padding: 5px;">
          <thead>
            <tr>
              <th colspan="3" style="border: 1px solid gray;padding: 5px;font-size:x-large ">Results </th>
            </tr>
            <tr>
              <th style="border: 1px solid gray;padding: 5px;width:300px;font-size:large">ID</th>
              <th style="border: 1px solid gray;padding: 5px;width:500px;font-size:large">Candidate Name</th>
              <th style="border: 1px solid gray; padding: 5px;width:500px;font-size:large">Total Votes</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($_SESSION['groupdata']) {
              for ($i = 0; $i < count($groupdata); $i++) {
            ?>
                <tr>
                  <td style="border: 1px solid gray;padding: 5px;font-size:large"><img src="../uploads/<?php echo $groupdata[$i][4] ?>" height="100px" width="100px" /></td>
                  <td style="border: 1px solid gray;padding: 5px;font-size:large"><?php echo $groupdata[$i][1] ?></td>
                  <td style="border: 1px solid gray;padding: 5px;font-size:large"><?php echo $groupdata[$i][5] ?></td>
                </tr>
            <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <script>
    function popup(popup_name) {
      get_popup = document.getElementById(popup_name);
      if (get_popup.style.display == "flex") {
        get_popup.style.display = "none";
      } else {
        get_popup.style.display = "flex";
      }
    }
  </script>
</body>

</html>