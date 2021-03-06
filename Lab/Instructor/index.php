<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 8/27/2016
 * Time: 7:14 PM
 */
include_once '../Model/Lab.php';

$lab = new Lab($_SESSION['resource_link_id']);

$start_date = new DateTime($lab->getOpenDate(), new DateTimeZone("America/Phoenix"));
$due_date = new DateTime($lab->getDueDate(), new DateTimeZone("America/Phoenix"));
$timer = $lab->getTimerVal();

$steps = $lab->getSteps();

//TODO: Implement AJAX to Create "Delete" Buttons on Client Side for Steps

//TODO: Add a 3 X 10 table, create input and output test cases

?>
<HTML>
<header>
    <title>Instructor View</title>
    <link rel="stylesheet" type="text/css" href="style.css" >
</header>
<body>
<div class="lab-window">
    <div class="lab-window-header">
        <h1 class="lab-title"><?php echo $_SESSION['resource_link_title']; ?> </h1>
    </div>
    <div class="step-window options-window">
        <p>Lab Settings</p>
        <form action="save-lab.php" method="post" enctype="multipart/form-data">
            <table style="margin-top: 0.8rem">
                <tr>
                    <td></td>
                    <td><label for="open_date">Open Date:</label></td>
                    <td><input type="datetime-local" name="open_date" value="<?php echo $start_date->format('Y-m-d\TH:i:s'); ?>"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td><label for="due_date">Due Date:</label></td>
                    <td><input type="datetime-local" name="due_date" value="<?php echo $due_date->format('Y-m-d\TH:i:s'); ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><label for="alotted_time">Time Allowed (mins):</label></td>
                    <td><input type="number" name="alotted_time" value="<?php echo $timer ?>"> </td>
                </tr>
                <tr>
                    <th><!-- to be left blank as placeholder --></th>
                    <th>Input Test Cases (.txt)</th>
                    <th>Output Test Cases (.txt)</th>
                </tr>
                <tr>
                    <td>1: </td>
                    <td><input type= "file" name = "inputFile[]"/></td>
                    <td><input type= "file" name = "outputFile[]"/></td>
                </tr>
                <tr>
                    <td>2: </td>
                    <td><input type= "file" name = "inputFile[]"/></td>
                    <td><input type= "file" name = "outputFile[]"/></td>
                </tr>
                <tr>
                    <td>3: </td>
                    <td><input type= "file" name = "inputFile[]"/></td>
                    <td><input type= "file" name = "outputFile[]"/></td>
                </tr>
                <tr>
                    <td>4: </td>
                    <td><input type= "file" name = "inputFile[]"/></td>
                    <td><input type= "file" name = "outputFile[]"/></td>
                </tr>
                <tr>
                    <td>5: </td>
                    <td><input type= "file" name = "inputFile[]"/></td>
                    <td><input type= "file" name = "outputFile[]"/></td>
                </tr>
                <tr>
                    <td>6: </td>
                    <td><input type= "file" name = "inputFile[]"/></td>
                    <td><input type= "file" name = "outputFile[]"/></td>
                </tr>
                <tr>
                    <td>7: </td>
                    <td><input type= "file" name = "inputFile[]"/></td>
                    <td><input type= "file" name = "outputFile[]"/></td>
                </tr>
                <tr>
                    <td>8: </td>
                    <td><input type= "file" name = "inputFile[]"/></td>
                    <td><input type= "file" name = "outputFile[]"/></td>
                </tr>
                <tr>
                    <td>9: </td>
                    <td><input type= "file" name = "inputFile[]"/></td>
                    <td><input type= "file" name = "outputFile[]"/></td>
                </tr>
                <tr>
                    <td>10: </td>
                    <td><input type= "file" name = "inputFile[]"/></td>
                    <td><input type= "file" name = "outputFile[]"/></td>
                </tr>
            </table>
            <input type="submit" name="save" value ="Save Lab" style="margin-top: 0.8rem">
        </form>
    </div>
    <?php
    if(!is_null($steps))
    {
        $n = 1;
        foreach ($steps as $step)
        {
            $step->setStepMask($n);
            //echo $step->getStepMask();
            $step->Save();
            echo "<div class='step-window'><p><a href='edit-step.php?step=" . $step->GetStepID() ."'>Step ". $step->getStepMask() . "</a></p><p>" . $step->GetInstructions() ."</p><div class='delete'><a  href='step-delete.php?step=" . $step->GetStepID() .  "'>X</a></div> </div>";
            $n = $n + 1;
        }
    }

    ?>
    <div class="step-window add-step">
        <a href="add-step.php">Add Step</a>
    </div>
    <a href="error-console.php">Error Console</a>
</div>
</body>
</HTML>
