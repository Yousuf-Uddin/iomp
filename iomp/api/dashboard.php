 <?php
    session_start();
    if (!isset($_SESSION["userdata"])) {
        header("location: ../");
    }
    $userdata = $_SESSION['userdata'];
    $groupdata = $_SESSION['groupdata'];
    if ($_SESSION['userdata']['status'] == 0) {
        $status = '<b style="color:red">Not voted</b>';
    } else {
        $status = '<b style="color:green">Voted</b>';
    }
    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../css/index.css" />
     <link rel="stylesheet" href="../css/dashboard.css" />
     <title>Dashboard</title>
 </head>

 <body>
     <heading class="voters_heading">
         <button><a href="../">Back</a></button>
         <center>
             <h1>Voting Dashboard</h1>
         </center>
         <button><a href="../api/logout.php">Logout</a></button>
     </heading>
     <hr />
     <div class="wrapper">
         <div class="user-profile">
             <center><img src="../uploads/<?php echo $userdata['photo'] ?>" alt=""></center>
             <div class=" user-data" style="text-align: initial; display: inline-block ;font-size: larger;">
                 <b>Name:</b> <?php echo $userdata['name'] ?><br><br>
                 <b>Roll-Number:</b> <?php echo $userdata['rollno'] ?><br><br>
                 <b>Email:</b> <?php echo $userdata['email'] ?><br><br>
                 <b>Status:</b>
                 <?php echo $status ?><br><br>
             </div>
         </div>
         <div class="voter-profile">
             <?php
                if ($_SESSION['groupdata']) {
                    for ($i = 0; $i < count($groupdata); $i++) {
                ?>
                     <div class="voter-data">
                         <img src="../uploads/<?php echo $groupdata[$i][4] ?>" height="150px" width="150px" />
                         <div class="voter-info">
                             <p><b>CandidateName:</b>
                             <p><?php echo $groupdata[$i][1] ?><br>
                             <p><b>Candidate Info:</b>
                             <p><?php echo $groupdata[$i][2] ?><br>
                             <p><b>Votes:</b>
                             <p><?php echo $groupdata[$i][5] ?><br>

                             <form action="../api/vote.php" method="POST">
                                 <input type="hidden" name="gvotes" value="<?php echo $groupdata[$i][5] ?>">
                                 <input type="hidden" name="gid" value="<?php echo $groupdata[$i][0] ?>">
                                 <?php
                                    if ($_SESSION['userdata']['status'] == 0) {
                                    ?>
                                     <input type="submit" name="votebtn" value="vote" id="votebtn">
                                 <?php
                                    } else {
                                    ?>
                                     <button disabled type="submit" name="votebtn" value="vote" id="votebtn btn_dis">Voted</button>
                                 <?php
                                    }
                                    ?>
                             </form>
                         </div>
                     </div>
                     <hr>
             <?php
                    }
                } ?>
         </div>
     </div>
 </body>

 </html>