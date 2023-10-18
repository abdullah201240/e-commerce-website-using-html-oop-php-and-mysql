<?php
namespace ecom\Controllers;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

use md5;

class ProductController {
    private $conn;

    public function __construct() {
        session_start();
        // Start the session at the beginning

        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'demo';

        $this->conn = new \mysqli( $servername, $username, $password, $database );

        if ( $this->conn->connect_error ) {
            die( 'Connection failed: ' . $this->conn->connect_error );
        }
    }

    public function singup( $name, $email, $phone, $address, $password ) {
        $query = "INSERT INTO `users`( `name`, `email`, `phone`, `address`, `password`) VALUES ('$name','$email','$phone','$address','$password')";
        $user = $this->conn->query( $query );
        return $user;

    }

    public function userlogin( $username, $password ) {
        $pass = md5( $password );

        $query = "SELECT * FROM `users` WHERE email='$username' AND password='$pass'";
        $result = $this->conn->query( $query );

        $user = $result->fetch_assoc();

        if ( $user ) {
            $_SESSION[ 'id' ] = $user[ 'id' ];
            $_SESSION[ 'name' ] = $user[ 'name' ];
            $_SESSION[ 'address' ] = $user[ 'address' ];

        }

        return $user;
    }

    public function home() {
        if ( isset( $_SESSION[ 'id' ] ) ) {
            $id = $_SESSION[ 'id' ];

            $stmt = $this->conn->prepare( 'SELECT * FROM `users` WHERE `id`=?' );
            $stmt->bind_param( 's', $id );
            $stmt->execute();
            $result = $stmt->get_result();

            $userDetails = $result->fetch_assoc();

            return $userDetails;
        } else {

            header( 'Location:login.php' );

        }
    }

    public function orderinsert( $type1, $type2, $type3 ) {

        $id = $_SESSION[ 'id' ];
        if ( isset( $id ) ) {
        $name = $_SESSION[ 'name' ];
        $query = "INSERT INTO `order`( `uid`, `name`, `type1`, `type2`, `type3`) VALUES ('$id','$name','$type1','$type2','$type3')";
        $user = $this->conn->query( $query );
        return $user;
        }
        else {
            header( 'Location:login.php' );

        }

    }

    public function cart() {
        $id = $_SESSION[ 'id' ];
        if ( isset( $id ) ) {
        $query = "SELECT * FROM `order` WHERE `uid`='$id'";
        $data = $this->conn->query( $query );
        return $data;
    }
    else {
        header( 'Location:login.php' );

    }

    }

    public function deleteorder( $id ) {
      
        $query = "DELETE FROM `order` WHERE `id`='$id'";
        $data = $this->conn->query( $query );
        return $data;

    }

    public function buynow() {

        $address = $_SESSION[ 'address' ];
        $name = $_SESSION[ 'name' ];
        $final1 = 0;
        $final3 = 0;
        $final2 = 0;
        $ttype1 = 0;
        $ttype2 = 0;
        $ttype3 = 0;
        $id = $_SESSION[ 'id' ];
        if ( isset( $id ) ) {
        $query = "SELECT * FROM `order` WHERE `uid`='$id'";
        $data = $this->conn->query( $query );
        while( $row = mysqli_fetch_array( $data ) ) {
            $total1 = ( $row[ 'type1' ]*100 );
            $final1 = $final1+$total1;
            $total2 = ( $row[ 'type2' ]*50 );
            $final2 = $final2+$total2;
            $total3 = ( $row[ 'type3' ]*10 );
            $final3 = $final3+$total3;

            $ttype1 = $ttype1+$row[ 'type1' ];
            $ttype2 = $ttype2+$row[ 'type2' ];
            $ttype3 = $ttype3+$row[ 'type3' ];

        }
        $total = $final1+$final2+$final3;
        $sql = "INSERT INTO `buy`( `name`, `uid`, `type1`, `type2`, `type3`, `price`, `address`,rid) VALUES ('$name','$id','$ttype1','$ttype2','$ttype3','$total','$address','0')";
        $data = $this->conn->query( $sql );
        $query = "DELETE FROM `order` WHERE `uid`='$id'";
        $data = $this->conn->query( $query );
        return $data;
    }
        else {
            header( 'Location:login.php' );
    
        }
    }

    public function orderlist() {

        $id = $_SESSION[ 'id' ];
        if ( isset( $id ) ) {
        $query = "SELECT * FROM `buy` WHERE `uid`='$id'";
        $data = $this->conn->query( $query );
        return $data;
        }
        else {
            header( 'Location:login.php' );
    
        }
    }

    public function profile() {

        $id = $_SESSION[ 'id' ];
        if ( isset( $id ) ) {
        $query = "SELECT * FROM `users` WHERE `id`='$id'";
        $data = $this->conn->query( $query );
        return $data;
        }
        else {
            header( 'Location:login.php' );
    
        }
    }

    public function adminlogin( $username, $password ) {
        $pass = md5( $password );

        $query = "SELECT * FROM `admin` WHERE username='$username' AND password='$pass'";
        $result = $this->conn->query( $query );

        $user = $result->fetch_assoc();

        if ( $user ) {
            $_SESSION[ 'aid' ] = $user[ 'id' ];
            $_SESSION[ 'aname' ] = $user[ 'name' ];

        }

        return $user;
    }

    public function adminorderlist() {
        $aid = $_SESSION[ 'aid' ];
        if ( isset( $aid ) ) {

            $query = 'SELECT * FROM `buy`';
            $data = $this->conn->query( $query );
            return $data;
        } else {
            header( 'Location:adminlogin.php' );

        }

    }

    public function adminriderlist() {
        $aid = $_SESSION[ 'aid' ];
        if ( isset( $aid ) ) {

            $query = 'SELECT * FROM `rider` ORDER BY(id) DESC';
            $data = $this->conn->query( $query );
            return $data;
        } else {
            header( 'Location:adminlogin.php' );

        }
    }

    public function asprej( $id, $code, $email, $name ) {

        if ( $code == 1 ) {

            $sql = " UPDATE `rider` SET `status`='Accept' WHERE id='$id'";
            $data = $this->conn->query( $sql );

            $mail = new PHPMailer( true );
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'patronwelfare@gmail.com';
            $mail->Password = 'qbdduwnstiyfdscy';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom( 'patronwelfare@gmail.com', 'Rain Water' );
            $mail->addAddress( $email, $name );
            $mail->Subject = 'Congregation  '.$name;
            $mail->Body = 'You are recognized as a rider and try to login with your login email:'. $email.'
            And the password is:1234';
            $mail->send();

            header( 'location: adminriderlist.php' );
        }
        if ( $code == 2 ) {

            $sql = " UPDATE `rider` SET `status`='Reject' WHERE id='$id'";
            $data = $this->conn->query( $sql );

            $mail = new PHPMailer( true );
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'patronwelfare@gmail.com';
            $mail->Password = 'qbdduwnstiyfdscy';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom( 'patronwelfare@gmail.com', 'Rain Water' );
            $mail->addAddress( $email, $name );
            $mail->Subject = 'Congregation  '.$name;
            $mail->Body = 'Sorry you have been rejected as a rider';
            $mail->send();

            header( 'location: adminriderlist.php' );

        }
        return $data;
    }

    public function riderapply( $name, $email, $phone, $address ) {
        $pass = md5( '1234' );
        $query = "INSERT INTO `rider`( `name`, `email`, `phone`, `address`, `password`) VALUES ('$name','$email','$phone','$address','$pass')";
        $user = $this->conn->query( $query );
        return $user;

    }

    public function riderlogin( $username, $password ) {
        $pass = md5( $password );

        $query = "SELECT * FROM `rider` WHERE email='$username' AND password='$pass'";
        $result = $this->conn->query( $query );

        $user = $result->fetch_assoc();

        if ( $user ) {
            $_SESSION[ 'rid' ] = $user[ 'id' ];
            $_SESSION[ 'rname' ] = $user[ 'name' ];
            $_SESSION[ 'raddress' ] = $user[ 'address' ];

        }

        return $user;
    }

    public function riderorderlist() {
        $rid = $_SESSION[ 'rid' ];
        if ( isset( $rid ) ) {

        $query = "SELECT * FROM `buy` WHERE `status`='Pandding'";
        $data = $this->conn->query( $query );
        return $data;
    } else {
        header( 'Location:riderlogin.php' );
    }
    }

    public function pick( $id ) {
        $rid = $_SESSION[ 'rid' ];
        if ( isset( $rid ) ) {
            $query = "UPDATE `buy` SET `status`='pick',`rid`='$rid' WHERE id='$id'";
            $data = $this->conn->query( $query );
            return $data;
        } else {
            header( 'Location:riderlogin.php' );
        }

    }

    public function ridermyorderlist() {
        $rid = $_SESSION[ 'rid' ];
        if ( isset( $rid ) ) {

            $query = "SELECT * FROM `buy` WHERE `rid`='$rid'";
            $data = $this->conn->query( $query );
            return $data;
        } else {
            header( 'Location:riderlogin.php' );
        }

    }

    public function riderprofile() {

        $rid = $_SESSION[ 'rid' ];

        if ( isset( $rid ) ) {
            $query = "SELECT * FROM `rider` WHERE `id`='$rid'";
            $data = $this->conn->query( $query );
            return $data;
        } else {
            header( 'Location:riderlogin.php' );
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header( 'Location:../index.php' );

    }

}
