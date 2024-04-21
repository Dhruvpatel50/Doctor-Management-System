<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Dashboard</title>
    <style>
        .dashbord-tables,.doctor-heade{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table,#anim{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .doctor-heade{
            animation: transitionIn-Y-over 0.5s;
        }
        .form-control{
            height: 35px;
            width: 250px;
        }
        .a{
            background-color: #1977cc;
        }
    </style>
    
    
</head>
<body>
    <?php

    //learn from w3schools.com

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='d'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }
    

    //import database
    include("../connection.php");
    $userrow = $database->query("select * from doctor where docemail='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["docid"];
    $username=$userfetch["docname"];


    //echo $userid;
    //echo $username;
    
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username,0,13)  ?>..</p>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../index.html" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active" >
                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">My Appointments</p></a></div>
                    </td>
                </tr>

                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-session">
                        <a href="add_schedule.php" class="non-style-link-menu"><div><p class="menu-text">Edit Sessions</p></div></a>
                    </td>
                </tr>

                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="patient.php" class="non-style-link-menu"><div><p class="menu-text">My Patients</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings">
                        <a href="settings.php" class="non-style-link-menu"><div><p class="menu-text">Settings</p></a></div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >
                        
                        <tr >
                            
                            <td colspan="1" class="nav-bar" >
                            <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;">     Dashboard</p>
                          
                            </td>
                            <td width="25%">

                            </td>
                            <td width="15%">
                                <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                                    Today's Date
                                </p>
                                <p class="heading-sub12" style="padding: 0;margin: 0;">
                                    <?php 
                                date_default_timezone_set('Asia/Kolkata');
        
                                $today = date('Y-m-d');
                                echo $today;


                                $patientrow = $database->query("select  * from  patient;");
                                $doctorrow = $database->query("select  * from  doctor;");
                                $appointmentrow = $database->query("select  * from  appointment where appodate>='$today';");
                                $schedulerow = $database->query("select  * from  schedule where scheduledate='$today';");


                                ?>
                                </p>
                            </td>
                            <td width="10%">
                                <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                            </td>
        
        
                        </tr>
                <tr>
                    <td colspan="4" >
                        
                    <center>
                    <table class="filter-container doctor-header" style="border: none;width:95%" border="0" >
                    <tr>
                        <td >
                            <h3>Welcome!</h3>
                            <h1><?php echo $username  ?>.</h1>
                            <p>Thanks for joinnig with us. We are always trying to get you a complete service<br>
                            You can view your dailly schedule, Reach Patients Appointment at home!<br><br>
                            </p>
                            <a href="appointment.php" class="non-style-link"><button class="btn-primary btn" style="width:30%">View My Appointments</button></a>
                            <br>
                            <br>
                        </td>
                    </tr>
                    </table>
                    </center>
                    
                </td>
                </tr>
               
            </table>
            <?php 
                // require_once _DIR_."/config/config.php";

                // $timezones = timezone_identifiers_list();

                // if($_SERVER['REQUEST_METHOD']=='POST'){
                //     $data = $_POST;
                //     $data['type'] = 2;
                //     if(!empty($data['settings']['host_video'])){
                //         $data['settings']['host_video'] = true;
                //     }else {
                //         $data['settings']['host_video'] = false;
                //     }
                //     if(!empty($data['settings']['participant_video'])){
                //         $data['settings']['participant_video'] = true;
                //     }else {
                //         $data['settings']['participant_video'] = false;
                //     }
                //     if(!empty($data['settings']['join_before_host'])){
                //         $data['settings']['join_before_host'] = true;
                //     }else{
                //         $data['settings']['join_before_host'] = false;
                //     }
                //     if(empty($data['password'])){
                //         $data['password'] = '';
                //     }
                    
                //     if(isset($_GET['id'])){
                //         if(updateMeeting($_GET['id'], $data)){
                //             header("Location:meeting-list.php?update=true");   
                //         }
                //     }else {
                //     if(createMeeting($data)){
                //             header("Location:meeting-list.php");   
                //         }   
                //     }
                // }
                // if(isset($_GET['id'])){
                //     $data = getMeeting($_GET['id']);
                // }
            ?>
    
    <div class="container mt-5" style="text-align:center;">
    <h2 style="text-align: center; left: 35%; position:relative;">Schedule The Zoom Meeting</h2>
    <form action="" method="post">
    <div class="row" style="text-align:center; align-items:center;">
    <table border="0" style="margin-top: -200px">
        <tr>
            <td>
        <div class="mb-3 col-md-6">
            <label for="topic" class="form-label">Meeting Title<span class='text-danger'>*</span></label>
            <input type="text" class="form-control text-warning fw-bold" id="topic" value="<?=$data['topic'] ?? '' ?>" name="topic" required>
        </div>
        </td>
        <td>
        <div class="mb-3 col-md-6">
            <label for="duration" class="form-label">Duration (minutes)<span class='text-danger'>*</span></label>
            <input type="number" class="form-control text-warning fw-bold" id="duration" value="<?=$data['duration'] ?? ''?>" name="duration" required>
        </div>
        </td>
        <td>
          <div class="mb-3 col-md-6">
            <label class="form-label">Timezone<span class='text-danger'>*</span></label>
            <select class="form-select text-warning fw-bold"  name="timzone">
                    <option value="select timezone">select timezone</option>
                   <?php foreach ($timezones as $timezone) : ?>
                    <option value="<?php echo $timezone; ?>" <?=($timezone=='UTC')?'selected':''?>>
                         <?php echo $timezone; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        </td>
        </tr>
        <tr>
        <td>
        <div class="mb-3 col-md-6">
            <label for="start_time" class="form-label">Start Time<span class='text-danger'>*</span></label>
            <input type="datetime-local" class="form-control text-warning fw-bold" id="start_time" value="<?= date('Y-m-d\TH:i', strtotime($data['start_time'])) ?? '' ?>" name="start_time" required>
        </div>
        </td>
        <td>
        <div class="mb-3 form-check col-md-4">
            <input type="checkbox" class="form-check-input text-warning fw-bold" id="host_video" name="settings[host_video]"  <?=(isset($data['settings']['host_video']) && $data['settings']['host_video']=='1' ) ? 'checked':'checked' ?> >     
            <label class="form-check-label" for="host_video">Enable Host Video</label>
        </div>
        </td>
        <td>
        <div class="mb-3 form-check col-md-4">
            <input type="checkbox" class="form-check-input text-warning fw-bold" id="participant_video" name="settings[participant_video]" <?=(isset($data['settings']['participant_video']) && $data['settings']['participant_video']=='1' ) ? 'checked':'checked' ?>>
            <label class="form-check-label" for="participant_video">Enable Participant Video</label>
        </div>
        </td>
        </tr>
        <tr>
        <td>
        <div class="mb-3 form-check col-md-4">
            <input type="checkbox" class="form-check-input text-warning fw-bold" id="join_before_host" name="settings[join_before_host]" <?=(isset($data['settings']['join_before_host']) && $data['settings']['join_before_host']=='1' ) ? 'checked':'checked' ?>>
            <label class="form-check-label" for="join_before_host">Allow Join Before Host</label>
        </div>
        </td>
        <td>
        <div class="mb-3 col-md-6">
            <label for="auto_recording" class="form-label">Auto Recording</label>
            
            <select class="form-select text-warning fw-bold" id="auto_recording" name="settings[auto_recording]">
                <option value="none" <?=(isset($data['settings']['auto_recording']) && $data['settings']['auto_recording']=='none' ) ? 'selected':'' ?> >None</option>
                <option value="local" <?=(isset($data['settings']['auto_recording']) && $data['settings']['auto_recording']=='local' ) ? 'selected':'' ?> >Local</option>
                <option value="cloud" <?=(isset($data['settings']['auto_recording']) && $data['settings']['auto_recording']=='cloud' ) ? 'selected':'' ?>>Cloud</option>
            </select>
        </div>
        </td>
        <td>
          <div class="mb-3 col-md-6">
            <label for="start_time" class="form-label">Password</label>
            <input type="text" class="form-control" name="password" value="<?= $data['password'] ?? ''?>" required>
        </div>
        </td>
        </tr>
        <tr rowspan="3">
            <td>
        <div class='col-md-12 d-flex justify-content-center'>
            
        </div>
                   </td>
        </tr>
                   </table>
    </div>
    <center><button type="submit"  class="btn-block btn btn-outline-warning btn-lg a">Submit</button></center>
    </form>
</div>
        </div>
        
    </div>
    

</body>
</html>