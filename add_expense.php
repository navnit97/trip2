<?php
/**
 * Created by IntelliJ IDEA.
 * User: RadioactiveScript
 * Date: 7/30/2018
 * Time: 5:57 PM
 */
session_start();
include("connection.php");
include("check_session.php");

if(isset($_SESSION)) {

    @$expense_category = $_POST['expense_category'];
    @$expense_name = $_POST['expense_name'];
    @$expense_date = $_POST['expense_date'];
    @$expense_amount = $_POST['expense_amount'];
    @$trip_id = mysqli_real_escape_string($connection, trim($_GET['t_id']));
    @$user_id = $_SESSION['current_user_id'];

    $insert_expense_sql = "INSERT INTO trip_expenese (t_id, u_id, ex_name, ex_date,ex_amount, c_id) VALUES ('$trip_id', '$user_id', '$expense_name', '$expense_date', '$expense_amount', '$expense_category')";

    echo $insert_expense_sql;
    @$result = mysqli_query($connection, $insert_expense_sql);
    echo $result;
    if ($result > 0) {
        header("Location: ./ourtrip.php?t_id=$trip_id&status=SUCCESS");
    } else {
        echo mysqli_error(@$connection);
        exit();
        header("Location: ./ourtrip.php?t_id=$trip_id&status=ERROR");
    }


}
else{
    header("Location: ./login.php?flag=loginfirst");
}