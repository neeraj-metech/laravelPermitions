<?php
include "oops.php";
$data = new Database;
// echo "Oops conncepts";
echo $data->getPrivatefun();
die;
?>
<table border="1">
    <tr>
        <td>id</td>
        <td>name</td>
        <td>Email</td>
        <td>password</td>
        <td>Status</td>
    </tr>
    <?php
    $user = $data->select('users');
    if ($user['msg_code']=='OOPS0000') {
        foreach ($user['data'] as $value) {?>
            <tr>
                <td><?php echo $value['id'];?></td>
                <td><?php echo $value['name'];?></td>
                <td><?php echo $value['email'];?></td>
                <td><?php echo $value['password'];?></td>
                <td><?php echo $value['status'];?></td>
            </tr>
        <?php }
    }else{ ?>
            <tr>
                <td colspan="5"><?php echo $user['msg'];?></td>
            </tr>
    <?php } ?>
    

</table>


<table border="1">
    <tr>
        <td>id</td>
        <td>name</td>
        <td>password</td>
        <td>email</td>
    </tr>
    <?php
    $user = $data->select('users');
    $i=1;
    foreach ($user['data'] as $value) {?>
        <tr>
            <td><?php echo $i++;?></td>
            <td><?php echo $value['name'];?></td>
            <td><?php echo $value['password'];?></td>
            <td><?php echo $value['email'];?></td>
        </tr>
    <?php } ?>
  

</table>
<br/><br/><br/><br/><br/>

<form action="" method="POST">
Name <input type="text" name="name" placeholder="Enter your Name"><br/><br/>
Password <input type="password" name="pass" placeholder="Enter your password"><br/><br/>
email <input type="email" name="email" placeholder="Enter your email"><br/><br/>
<input type="submit" name="submit">
</form>


<?php
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];

    $userdata = array(
        'username' => $name,
        'password' => $pass,
        'email' => $email
    );
    if($data->insert("test", $userdata)){
        echo "data inserted successfully";
    }else{
        echo "some error occurs";
    }
}


?>