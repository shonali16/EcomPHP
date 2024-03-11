<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('server/connection.php');
session_start();
// echo $_SESSION['logged_in'];

if(!isset($_SESSION['logged_in'])){
    header('location:login.php');
    exit;
}

if(isset($_GET['logout'])){
    // die("logout");
    if(isset($_SESSION['logged_in'])){
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        header('location: login.php');  
        exit;
    }
}


if(isset($_POST['change_password'])){
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmPassword'];
    $user_email  = $_SESSION['user_email'];


    if($password  !== $confirm_password){
        header('location: account.php?error=password dont match');
    }
    else if(strlen($password) < 6)  {
        header('location:account.php?error= password must be atleast 6 characters');
    }
    // no errors
    else{
        $stmt = $conn->prepare("UPDATE users SET user_password = ? WHERE user_email = ? ");
        $stmt->bind_param('ss',md5($password), $user_email);
        if($stmt->execute()){
            header('location: account.php?message=password has been updated successfully');
        }
        else{
            header('location: account.php?error=password has been updated successfully');
        }
    }
}

// gte orders
if(isset($_SESSION['logged_in'])){
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
    $stmt->bind_param('i',$user_id);
    $stmt->execute();
    $orders = $stmt->get_result();


}
?>
<?php
include('layouts/header.php');
include('layouts/navbar.php');
?>

<div class="container" style="margin-top:50px;">
        <div class="row">
        <p style="color:green"><?php if(isset($_GET['register_success'])) {echo $_GET['register_success']; }?></p>
            <p style="color:red"><?php echo  isset(($_GET['error']) ) ? $_GET[' error']: '';?></p>
            <p style="color:green"><?php echo isset(($_GET['messsage'])) ? $_GET['message'] :'';?></p>
            <div class="col-md-4">
               
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Change Password</h5>
                        <form action="account.php" method="POST">
                            <div class="form-group">
                                <label for="currentPassword">New Password</label>
                                <input type="password" class="form-control" id="currentPassword" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="newPassword">Confirm Password</label>
                                <input type="password" class="form-control" id="newPassword" name="confirmPassword" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary" name="change_password">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <!-- Account Details Section (Right) -->
                <h1>Welcome to Your Account Page</h1>
                <p>Name: <?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name']; }?></p>
                <p>Email: <?php echo $_SESSION['user_email']; ?></p>
                <p><a href="#orders">Your Orders</a></p>
                <p><a href="account.php?logout=1">Log Out</a></p>
            </div>
        </div>
    </div>

    <div id="orders" class="container" style="margin-top: 50px;">
    <h2>Your Orders</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
            
                <th>Order Cost</th>
                <th>Order Status</th>
                <th>Order Date</th>
                <th>Order Details</th>
            </tr>
        </thead>
        <tbody>
            <?php
        while($row= $orders->fetch_assoc()){
        
        
                ?>
                <tr>
                    <td><?php echo $row['order_id']; ?></td>
                
                    <td><?php echo $row['order_cost']; ?></td>
                    <td><?php echo $row['order_status']; ?></td>
                    <td><?php echo $row['order_date']; ?></td>
                    <td>
                    <form action="order_details.php" method="POST"> 
                    <input type="hidden" value="<?php echo $row['order_status']?>" name="order_status"/>
                        <input type="hidden" value="<?php echo $row['order_id']?>" name="order_id"/>
                    <input class="btn btn-info" type="submit" value="details" name="order_details_btn">
                    </form>   
                </td>
                </tr>
            <?php
        }
            ?>
        </tbody>
    </table>
</div>

