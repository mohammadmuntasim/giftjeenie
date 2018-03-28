<?php

/**
 * Simple class to connect to the database.
 *
 *
 * @author Ajitem Sahasrabuddhe <asahasrabuddhe@torinit.com>
 * @package GiftJeenie
 * @subpackage Database
 * @since 1.0
 */
use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require __DIR__ . '/../vendor/autoload.php';
    require __DIR__ . '/../PHPMailer/src/Exception.php';
    require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
    require __DIR__ . '/../PHPMailer/src/SMTP.php';
    // $mail = new PHPMailer;


require dirname( __DIR__ ) . "/config.php";

class Database
{
    private $connect;
    private $error_message;

    public function __construct()
    {

        $this->error_message = '';

        $this->connect = new mysqli(HOST, USER, PASSWORD, DATABASE);

        if ($this->connect->connect_errno)
        {
            $error_message = array("error" => "Failed to connect to MySQL: (" . $this->connect->connect_errno . ") " . $this->connect->connect_error);
        }
    }

    public function disconnect()
    {
        $this->connect->close();
        $this->connect = NULL;
    }

    public function createActivationToken( $user_id )
    {
        $activation = md5(uniqid(rand(), true));

        $stmt = $this->connect->prepare("INSERT INTO user_activation (user_id, token) VALUES (?, ?)");

        $stmt->bind_param( 'is', $user_id, $activation );
        $stmt->execute();

        $stmt->close();
    }

    public function generateToken( $user_id )
    {
        $api_key = hash('sha256', (time() . $user_id . md5(uniqid(rand(), true)) . rand()));
        $created_on = date('Y-m-d H:i:s');

        $stmt = $this->connect->prepare("SELECT COUNT(*) FROM user_keys WHERE user_id = ?");
        $stmt->bind_param( 'i', $user_id );
        $stmt->execute();
        $stmt->bind_result( $count );
        $stmt->fetch();
        $stmt = NULL;

        if( $count != 1 )
        {
            $stmt = $this->connect->prepare("INSERT INTO user_keys (user_id, token, created_on) VALUES (?, ?, ?)");

            $stmt->bind_param( 'iss', $user_id, $api_key, $created_on );
            $stmt->execute();

            echo $stmt->error;

            $stmt->close();

            return $api_key;
        }
        else
        {
            $stmt = $this->connect->prepare("SELECT token FROM user_keys WHERE user_id = ?");
           
            $stmt->bind_param( 'i', $user_id );
            $stmt->execute();
            $stmt->bind_result( $token );
            $stmt->fetch();
            $stmt = NULL;

            return $token;
        }
    }

    public function verifyToken( $user_id, $token )
    {

        $stmt = $this->connect->prepare("SELECT * FROM user_keys WHERE user_id = ?");

        $stmt->bind_param( 'i', $user_id );
        $stmt->execute();
        $stmt->bind_result( $t_id, $u_id, $tk, $created_on );
        $stmt->fetch();

        if( $tk == $token )
        {
            if( 1 ) // expiry check
            {
                return true;
            }
        }

        return false;
    }

    public function random_password( $length = 8 )
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr( str_shuffle( $chars ), 0, $length );
        while( ! (1 === preg_match('~[0-9]~', $password) ) )
        {
            $password = substr( str_shuffle( $chars ), 0, $length );
        }
        return $password;
    }

    // public function createUser( $user, $password, $update = false )
    // {
    //     if( $this->error_message != '' )
    //     {
    //         return $error_message;
    //     }

    //     $stmt = $this->connect->prepare("SELECT id, password FROM users WHERE email = ? LIMIT 1");

    //     if( $stmt )
    //     {
    //         $first_name = $user->getFirstName();
    //         $last_name = $user->getLastName();
    //         $email = $user->getEmail();
    //         $source = $user->getSource();
    //         $source_id = $user->getSourceId();
    //         $profile_picture = $user->getProfilePicture();
    //         $status = $user->getStatus();
    //         $role = $user->getRole();
    //         $location = $user->getLocation();
    //         $date_of_birth = $user->getDob();
    //         $phone = $user->getPhone();

    //         if( !$update )
    //         {
    //             $created_on = date('Y-m-d H:i:s');
    //             $last_login_date = $created_on;
    //             $last_modified_on = $created_on;
    //             $last_logout = $created_on;
    //         }
    //         else
    //         {
    //             $created_on = $user->getCreatedOn();
    //             $last_login_date = $user->getLastLoginDate();
    //             $last_modified_on = date('Y-m-d H:i:s');
    //             $last_logout = $user->getLastLogout();
    //         }

    //         if( $update )
    //         {
    //             $id = $user->getID();
    //             if( $update_stmt = $this->connect->prepare( "UPDATE users SET first_name = ?, last_name = ?, email = ?, status = ?, profile_picture = ?, location = ?, last_login_date = ?, last_modified_on = ?, last_logout = ?, date_of_birth = ?, phone = ? WHERE id = ?" ) )
    //             {
    //                 $update_stmt->bind_param( 'sssisssssssi', $first_name, $last_name, $email, $status, $profile_picture, $location, $last_login_date, $last_modified_on, $last_logout, $date_of_birth, $phone, $id );

    //                 if( !$update_stmt->execute() )
    //                 {
    //                     $update_stmt->close();
    //                     return array('message_code' => 132 );
    //                 }

    //                 $update_stmt->close();
    //                 return array('message_code' => 170 );

    //             }
    //             else
    //             {
    //                 return array('message_code' => 132 );
    //             }
    //         }

    //         $stmt->bind_param( 's', $email );
    //         $stmt->execute();
    //         $stmt->store_result();

    //         if( $stmt->num_rows == 1 && !$update )
    //         {
    //             $stmt->bind_result( $user_id, $db_password );
    //             $stmt->fetch();
    //             $stmt->close();
    //             return array( 'message_code' => 104, 'password' => $db_password );
    //         }

    //         $password = sha1( $email . ':' . $password );
    //         $password = password_hash($password, PASSWORD_BCRYPT);

    //         if( $insert_stmt = $this->connect->prepare( "INSERT INTO users ( first_name, last_name, email, password, source, source_id, status, role, profile_picture, date_of_birth, phone, location, created_on, last_login_date, last_modified_on, last_logout ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )" ) )
    //         {
    //             $insert_stmt->bind_param( 'ssssssiissssssss', $first_name, $last_name, $email, $password, $source, $source_id, $status, $role, $profile_picture, $date_of_birth, $phone, $location, $created_on, $last_login_date, $last_modified_on, $last_logout );

    //             if( !$insert_stmt->execute() )
    //             {
    //                 //$insert_stmt->close();
    //                 return array( 'message_code' => 103, 'err' => $this->connect->error );
    //             }

    //             $insert_stmt->close();
    //             $user_id = $this->connect->insert_id;

    //             //$this->createActivationToken( $user_id );
    //             if( $source == 5 )
    //             {
    //                 $this->sendConfirmationMail( $user );
    //             }

    //             return array('message_code' => 154, 'id' => $user_id );
    //         }
    //         else
    //         {
    //             return array('message_code' => 103 );
    //         }
    //     }
    // }

    public function createUser( $user, $password, $update = false )
    {
        if( $this->error_message != '' )
        {
            return $error_message;
        }

        $stmt = $this->connect->prepare("SELECT id, password FROM users WHERE email = ? LIMIT 1");

        if( $stmt )
        {
            $first_name = $user->getFirstName();
            $last_name = $user->getLastName();
            $gender = $user->getGender();
            $email = $user->getEmail();
            $source = $user->getSource();
            $source_id = $user->getSourceId();
            $profile_picture = $user->getProfilePicture();
            $status = $user->getStatus();
            $role = $user->getRole();
            $location = $user->getLocation();
            $date_of_birth = $user->getDob();
            $phone = $user->getPhone();

            if( !$update )
            {
                $created_on = date('Y-m-d H:i:s');
                $last_login_date = $created_on;
                $last_modified_on = $created_on;
                $last_logout = $created_on;
            }
            else
            {
                $created_on = $user->getCreatedOn();
                $last_login_date = $user->getLastLoginDate();
                $last_modified_on = date('Y-m-d H:i:s');
                $last_logout = $user->getLastLogout();
            }

            if( $update )
            {
                $id = $user->getID();
                if( $update_stmt = $this->connect->prepare( "UPDATE users SET first_name = ?, last_name = ?, gender = ?, email = ?, status = ?, profile_picture = ?, location = ?, last_login_date = ?, last_modified_on = ?, last_logout = ?, date_of_birth = ?, phone = ? WHERE id = ?" ) )
                {
                    $update_stmt->bind_param( 'ssssisssssssi', $first_name, $last_name, $gender, $email, $status, $profile_picture, $location, $last_login_date, $last_modified_on, $last_logout, $date_of_birth, $phone, $id );

                    if( !$update_stmt->execute() )
                    {
                        $update_stmt->close();
                        return array('message_code' => 132 );
                    }

                    $update_stmt->close();
                    return array('message_code' => 170 );

                }
                else
                {
                    return array('message_code' => 132 );
                }
            }

            $stmt->bind_param( 's', $email );
            $stmt->execute();
            $stmt->store_result();

            if( $stmt->num_rows == 1 && !$update )
            {
                $stmt->bind_result( $user_id, $db_password );
                $stmt->fetch();
                $stmt->close();
                return array( 'message_code' => 104, 'password' => $db_password );
            }

            $password = sha1( $email . ':' . $password );
            $password = password_hash($password, PASSWORD_BCRYPT);

            if( $insert_stmt = $this->connect->prepare( "INSERT INTO users ( first_name, last_name, gender, email, password, source, source_id, status, role, profile_picture, date_of_birth, phone, location, created_on, last_login_date, last_modified_on, last_logout ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )" ) )
            {
                $insert_stmt->bind_param( 'sssssssiissssssss', $first_name, $last_name, $gender, $email, $password, $source, $source_id, $status, $role, $profile_picture, $date_of_birth, $phone, $location, $created_on, $last_login_date, $last_modified_on, $last_logout );

                if( !$insert_stmt->execute() )
                {
                    //$insert_stmt->close();
                    return array( 'message_code' => 103, 'err' => $this->connect->error );
                }

                $insert_stmt->close();
                $user_id = $this->connect->insert_id;

                //$this->createActivationToken( $user_id );
                if( $source == 5 )
                {
                    $this->sendConfirmationMail( $user );
                }

                return array('message_code' => 154, 'id' => $user_id );
            }
            else
            {
                return array('message_code' => 103 );
            }
        }
    }

    public function verifyUserExisting( $email, $password )
    {

        $stmt = $this->connect->prepare("SELECT id, password, status, role FROM users WHERE email = ? LIMIT 1");

        $stmt->bind_param( 's', $email );
        $stmt->execute();
        $stmt->bind_result( $user_id, $db_password, $status, $role );
        $stmt->fetch();
        $stmt->close();
        $stmt = NULL;

        if( $password== $db_password )
        {
            if( $status == 2 )
            {
                $token = $this->generateToken( $user_id );
                $last_login_date = date('Y-m-d H:i:s');

                $stmt = $this->connect->prepare("UPDATE users SET last_login_date = ? WHERE id = ?");
                $stmt->bind_param( 'si', $last_login_date, $user_id );
                $stmt->execute();
                $stmt->close();
                $stmt = NULL;

                return array( 'message_code' => 153, 'id' => $user_id, 'token' => $token, 'role' => $role );
            }
            else
            {
                return array( 'message_code' => 100 );
            }
        }
        else
        {
            return array( 'message_code' => 105 );
        }
    }

    public function verifyUser( $email, $password )
    {

        $stmt = $this->connect->prepare("SELECT id, password, status, role FROM users WHERE email = ? LIMIT 1");

        $stmt->bind_param( 's', $email );
        $stmt->execute();
        $stmt->bind_result( $user_id, $db_password, $status, $role );
        $stmt->fetch();
        $stmt->close();
        $stmt = NULL;

//echo "1|1" . password_hash(sha1($email . ':' . $password),PASSWORD_BCRYPT)  . "1|1" ;

        if( password_verify( sha1( $email . ':' . $password ), $db_password) )
        {
            if( $status == 2 )
            {
                $token = $this->generateToken( $user_id );
                $last_login_date = date('Y-m-d H:i:s');

                $stmt = $this->connect->prepare("UPDATE users SET last_login_date = ? WHERE id = ?");
                $stmt->bind_param( 'si', $last_login_date, $user_id );
                $stmt->execute();
                $stmt->close();
                $stmt = NULL;

                return array( 'message_code' => 153, 'id' => $user_id, 'token' => $token, 'role' => $role );
            }
            else
            {
                return array( 'message_code' => 100 );
            }
        }
        else if ( $password == $db_password)
        {
            if( $status == 2 )
            {
                $token = $this->generateToken( $user_id );
                $last_login_date = date('Y-m-d H:i:s');

                $stmt = $this->connect->prepare("UPDATE users SET last_login_date = ? WHERE id = ?");
                $stmt->bind_param( 'si', $last_login_date, $user_id );
                $stmt->execute();
                $stmt->close();
                $stmt = NULL;

                return array( 'message_code' => 153, 'id' => $user_id, 'token' => $token, 'role' => $role );
            }
            else
            {
                return array( 'message_code' => 100 );
            }
        }
        else
        {
            return array( 'message_code' => 105 );
        }
    }

    public function activateUser( $user_id, $key )
    {
        $stmt = $this->connect->prepare("SELECT token FROM user_activation WHERE user_id = ?");

        $stmt->bind_param( 'i', $user_id );
        $stmt->execute();
        $stmt->bind_result( $token );
        $stmt->fetch();
        $stmt->close();
        $stmt = NULL;

        if( $token == $key )
        {
            $stmt = $this->connect->prepare("UPDATE users SET status = 2 WHERE id = ?");

            $stmt->bind_param( 'i', $user_id );
            $stmt->execute();
            $stmt->close();

            return array( 'message_code' => 152 );
        }
        else
        {
            return array( 'message_code' => 102 );
        }
    }

    public function sendConfirmationMail( $user )
    {
        $to = $user->getEmail();
        $subject = "Welcome to GiftJeenie!";

        $message = "Dear " . $user->getFirstName() . ",<br />\r\n<br />\r\n";
        $message .= "Your registration is now complete. Please login with your email address and password and enjoy the app.<br/>\r\n<br />\r\n Thanks and Regards <br />\r\n Gift Jeenie Admin";

        $header = "From: Gift Jeenie Admin <support@giftjeenie.com> \r\n";
        //$header .= "Cc:afgh@somedomain.com \r\n";
        //ajitem@joshiinc.com
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";


        ini_set('smtp_user','mallika@giftjeenie.com');
        ini_set('smtp_pass','Makhijani070991');


        $result = mail( $to, $subject, $message, $header );
    }

    public function changePassword( $user_id, $password, $newPassword )
    {
        $stmt = $this->connect->prepare("SELECT email, password FROM users WHERE id = ?");

        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->bind_result( $email, $db_password );
        $stmt->fetch();
        $stmt->close();
        $stmt = NULL;

        if( $db_password == password_verify( sha1( $email . ':' . $password ), $db_password)  )
        {
            $new_password = sha1( $email . ':' . $newPassword );
            $new_password = password_hash($new_password, PASSWORD_BCRYPT);

            $stmt = $this->connect->prepare("UPDATE users SET password = ? WHERE id = ?");

            $stmt->bind_param( 'si', $new_password, $user_id );
            $stmt->execute();
            $stmt->close();
            $stmt = NULL;

            return( array('message_code' => '185') );
        }
        else
        {
            return( array('message_code' => '138') );
        }
    }

    public function resetPassword( $email )
    {
        $stmt = $this->connect->prepare("SELECT id, first_name FROM users WHERE email = ?");

        $stmt->bind_param( 's', $email );
        $stmt->execute();
        $stmt->bind_result( $user_id, $name );
        $stmt->fetch();
        $stmt->close();
        $stmt = NULL;
// var_dump($user_id);exit;
        if( isset( $user_id ) && !empty( $user_id ) )
        {
            $newpass = $this->random_password(6);

            $password = sha1( $email . ':' . $newpass );
            $password = password_hash($password, PASSWORD_BCRYPT);

            $stmt = $this->connect->prepare("UPDATE users SET password = ? WHERE id = ?");

            $stmt->bind_param( 'si', $password, $user_id );
            $stmt->execute();
            $stmt->close();
            $stmt = NULL;

            $to = $email;


            $message = "Dear " . $name . ",<br />\r\n <br />\r\n";

            $message .= "Your Gift Jeenie password has been reset. Please login with your new password: " . $newpass . "<br />\r\n <br />\r\n Thanks and Regards <br />\r\n Gift Jeenie Admin";

            $subject = "Gift Jeenie login crediential.";

            $header = "From: Gift Jeenie Admin <support@giftjeenie.com> \r\n";

            //$header .= "Cc:afgh@somedomain.com \r\n";

            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";

             ini_set('smtp_user','mallika@giftjeenie.com');
             ini_set('smtp_pass','Makhijani070991');
// var_dump('smtp_user');exit;
// var_dump($b);exit;
            $result = mail( $to, $subject, $message, $header );

            return array( "message_code" => 151, "user_id" => $user_id, "result" => $result, "Error" => error_get_last() );
        }

        return array( "message_code" => 101 );
    }

    public function logout( $user_id )
    {
        $last_logout = date('Y-m-d H:i:s');

        $stmt = $this->connect->prepare("UPDATE users SET last_logout = ? WHERE id = ?");
        $stmt->bind_param( 'si', $last_login_date, $user_id );
        $stmt->execute();
        $stmt->close();
        $stmt = NULL;

        $stmt = $this->connect->prepare("DELETE FROM user_keys WHERE user_id = ?");
        $stmt->bind_param( 'i', $user_id );
        $stmt->execute();
        $stmt->close();
        $stmt = NULL;

        return array( "message_code" => 150 );
    }


    // public function getUser( $user_id )
    // {
    //     $stmt = $this->connect->prepare("SELECT * FROM users LEFT JOIN user_address ON users.id = user_address.user_id WHERE users.id = ?");
    //     $stmt->bind_param( 'i', $user_id );
    //     $stmt->execute();
    //     $stmt->bind_result( $id, $first_name, $last_name, $gender, $email, $password, $status, $role, $profile_picture, $dob, $phone, $created_on, $location, $last_login_date, $last_modified_on, $source, $source_id, $last_logout, $address_id, $auid, $address, $apt_suite, $zip_code, $city, $state, $country );
    //     $stmt->fetch();

    //     $user = new User( $first_name, $last_name, $email, $source, $source_id, $profile_picture );
    //     $user->setID( $id );
    //     $user->setGender ($gender);
    //     $user->setStatus( $status );
    //     $user->setRole( $role );
    //     $user->setLocation( $location );
    //     $user->setCreatedOn( $created_on );
    //     $user->setLastLoginDate( $last_login_date );
    //     $user->setLastModifiedOn( $last_modified_on );
    //     $user->setLastLogOut( $last_logout );
    //     $user->setDob( $dob );
    //     $user->setPhone( $phone );
    //     $user->address = $address;
    //     $user->apt_suite = $apt_suite;
    //     $user->zip_code = $zip_code;
    //     $user->city = $city;
    //     $user->state = $state;
    //     $user->country = $country;

    //     //-------------------- modify on 10 Feb
    //     $stmt->close ();

    //     $stmt = $this->connect->prepare("SELECT name FROM users LEFT JOIN user_categories ON users.id = user_categories.user_id LEFT JOIN product_category ON product_category.id = user_categories.category_id WHERE users.id = ?");
        
    //     if( $stmt ) {
            
    //         $stmt->bind_param( 'i', $user_id );
    //         $stmt->execute();
    //         $stmt->bind_result($name);
    //         $stmt->store_result();

    //         $user_categories = array();

    //         while ( $stmt->fetch() )
    //         {
    //             $user_categories[] = $name;
    //             $name = NULL;
    //         }

    //         $user->setCategory( $user_categories );
    //     }

    //     //-------------------- modify on 10 Feb

    //     return $user;
    // }

     public function getUser( $user_id )
    {
        $stmt = $this->connect->prepare("SELECT * FROM users LEFT JOIN user_address ON users.id = user_address.user_id WHERE users.id = ?");
        $stmt->bind_param( 'i', $user_id );
        $stmt->execute();
        $stmt->bind_result( $id, $first_name, $last_name, $gender, $email, $password, $status, $role, $profile_picture, $dob, $phone, $created_on, $location, $last_login_date, $last_modified_on, $source, $source_id, $last_logout, $address_id, $auid, $address, $apt_suite, $zip_code, $city, $state, $country );
        $stmt->fetch();

        $user = new User( $first_name, $last_name, $gender, $email, $source, $source_id, $profile_picture );
        $user->setID( $id );
        //$user->setGender ($gender);
        $user->setStatus( $status );
        $user->setRole( $role );
        $user->setLocation( $location );
        $user->setCreatedOn( $created_on );
        $user->setLastLoginDate( $last_login_date );
        $user->setLastModifiedOn( $last_modified_on );
        $user->setLastLogOut( $last_logout );
        $user->setDob( $dob );
        $user->setPhone( $phone );
        $user->address = $address;
        $user->apt_suite = $apt_suite;
        $user->zip_code = $zip_code;
        $user->city = $city;
        $user->state = $state;
        $user->country = $country;

        //-------------------- modify on 10 Feb
        $stmt->close ();

        //$stmt = $this->connect->prepare("SELECT name FROM users LEFT JOIN user_categories ON users.id = user_categories.user_id LEFT JOIN product_category ON product_category.id = user_categories.category_id WHERE users.id = ?");
        
        // 14Feb modify
        $stmt = $this->connect->prepare("SELECT category_id, name FROM users LEFT JOIN user_categories ON users.id = user_categories.user_id LEFT JOIN product_category ON product_category.id = user_categories.category_id WHERE users.id = ?");

        if( $stmt ) {
            
            $stmt->bind_param( 'i', $user_id );
            $stmt->execute();
            $stmt->bind_result($category_id, $name);
            $stmt->store_result();

            $user_categories = array(); // 14 Feb
            $user_category = array();

            while ( $stmt->fetch() )
            {
                $user_category['category_id'] = $category_id;
                $user_category['name'] = $name;

                $user_categories [] = $user_category;

                $user_category = null;
                $category_id = null;
                $name = NULL;
            }

            $user->setCategory( $user_categories );
        }

        //-------------------- modify on 10 Feb

        return $user;
    }


    // public function getUsers()
    // {
    //     $stmt = $this->connect->prepare("SELECT * FROM users ORDER BY id DESC");
    //     $stmt->execute();
    //     $stmt->bind_result( $id, $first_name, $last_name, $email, $password, $status, $role, $profile_picture, $dob, $phone, $created_on, $location, $last_login_date, $last_modified_on, $source, $source_id, $last_logout );
    //     $users = array();

    //     while ( $stmt->fetch() )
    //     {
    //         $user = new User( $first_name, $last_name, $email, $source, $source_id, $profile_picture );
    //         $user->setID( $id );
    //         $user->setStatus( $status );
    //         $user->setRole( $role );
    //         $user->setLocation( $location );
    //         $user->setCreatedOn( $created_on );
    //         $user->setLastLoginDate( $last_login_date );
    //         $user->setLastModifiedOn( $last_modified_on );
    //         $user->setLastLogOut( $last_logout );
    //         $user->setDob( $dob );
    //         $user->setPhone( $phone );

    //         $users[] = $user;
    //         $user = NULL;
    //     }

    //     return $users;
    // }

     public function getUsers()
    {
        $stmt = $this->connect->prepare("SELECT * FROM users ORDER BY id DESC");
        $stmt->execute();
        $stmt->bind_result( $id, $first_name, $last_name, $gender, $email, $password, $status, $role, $profile_picture, $dob, $phone, $created_on, $location, $last_login_date, $last_modified_on, $source, $source_id, $last_logout );
        $users = array();

        while ( $stmt->fetch() )
        {
            $user = new User( $first_name, $last_name, $gender, $email, $source, $source_id, $profile_picture );
            $user->setID( $id );
            $user->setStatus( $status );
            $user->setRole( $role );
            $user->setLocation( $location );
            $user->setCreatedOn( $created_on );
            $user->setLastLoginDate( $last_login_date );
            $user->setLastModifiedOn( $last_modified_on );
            $user->setLastLogOut( $last_logout );
            $user->setDob( $dob );
            $user->setPhone( $phone );

            $users[] = $user;
            $user = NULL;
        }

        return $users;
    }


    public function getUsersDatatable()
    {
        $stmt = $this->connect->prepare("SELECT u.id, u.first_name, u.last_name, u.email, u.status, u.created_on, (SELECT COUNT(*) FROM wishlist WHERE user_id = u.id) AS `wishlists` FROM users u  ORDER BY id DESC");
        $stmt->execute();
        $stmt->bind_result( $id, $first_name, $last_name, $email, $status, $created_on, $wishlists );

        $users = [];
        while($stmt->fetch()) {
            $userArr = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'status' => $status,
                'wishlists' => $wishlists,
                'created_on' => $created_on,
                'id' => $id,
            ];
            $users[] = array_values($userArr);

        }
        return $users;
    }

    public function deleteUser( $user_id )
    {
        $stmt = $this->connect->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param( 'i', $user_id );
        $stmt->execute();

        return array('message_code' => 161);

    }

    public function addUserAddress( $user_id, $address )
    {
        $stmt = $this->connect->prepare('SELECT COUNT(*) FROM user_address WHERE user_id = ?');
        if( $stmt ) {
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();

            if( $count == 0 ) {
                $stmt = $this->connect->prepare('INSERT INTO user_address (user_id, address, apt_suite, zip_code, city, state, country) VALUES (?, ?, ?, ?, ?, ?, ?)');
       
                if ($stmt) {
                    $stmt->bind_param('issssss', $user_id, $address['address'], $address['apt_suite'], $address['zip_code'], $address['city'], $address['state'], $address['country']);
                    $stmt->execute();
                    $stmt->close();

                    $address_id = $this->connect->insert_id;
                    return ['message_code' => 300, 'address_id' => $address_id, 'user_id' => $user_id ];
                } else {
                    return ['message_code' => 301, 'user_id' => $user_id ];
                }

            } else {
                $stmt = $this->connect->prepare('UPDATE user_address SET address = ?, apt_suite = ?, zip_code = ?, city = ?, state = ?, country = ? WHERE user_id = ? ');
                $stmt->bind_param('ssssssi', $address['address'], $address['apt_suite'], $address['zip_code'], $address['city'], $address['state'], $address['country'], $user_id);
                $stmt->execute();
                $stmt->close();

                return ['message' => 'updated' ];
            }
        }
    }

    public function addUserCategories( $user_id, $categories )
    {
        $stmt = $this->connect->prepare('INSERT INTO user_categories (user_id, category_id) VALUES (?, ?)');
       
       if($stmt) {
            foreach($categories as $category) {
                $stmt->bind_param('ii', $user_id, $category);
                $stmt->execute();
            }
            $stmt->close();
            return ['message_code' => 302, 'user_id' => $user_id ];
       } else {
            return ['message_code' => 303, 'user_id' => $user_id ];
       }
    }

    public function addProduct( $product, $update = false , $isImage = false)
    {
        if( $this->error_message != '' )
        {
            return $error_message;
        }

        $name = $product->getName();
        $url = $product->getUrl();
        $price = $product->getPrice();
        $currency = $product->getCurrency();
        $trend_rating = $product->getTrendRating();
        $category_id = $product->getCategory();

        $source = $product->getSource();
        $description = $product->getDescription();
        $meta = $product->getMeta();

        if ( $update )
        {
            // var_dump($isImage);exit;
            $sSQL = "";
            if ($isImage)
            {
                // echo "Hie";exit;
                $images = json_encode( $product->getImages() );
                $sSQL  = "UPDATE product SET name =?, url =?, price =?, currency =?, trend_rating =?, category_id =?, image=?, source =?, description =?, last_modified_on =?, last_modified_by =? WHERE id = ?";

                if( $update_stmt = $this->connect->prepare($sSQL) )
                {
                    $id = $product->getID();
                    $update_stmt->bind_param( 'ssdsiisissii', $name, $url, $price, $currency, $trend_rating, $category_id, $images, $source, $description, $meta['last_modified_on'], $meta['last_modified_by'], $id);

                    if( !$update_stmt->execute() )
                    {
                        $update_stmt->close();
                        return array('message_code' => 126);
                    }
                    $update_stmt->close();
                    return array('message_code' => 171);
                }

            }
            else
            {

                $sSQL  = "UPDATE product SET name =?, url =?, price =?, currency =?, trend_rating =?, category_id =?, source =?, description =?, last_modified_on =?, last_modified_by =? WHERE id = ?";

                if( $update_stmt = $this->connect->prepare($sSQL) )
                {
                     
                    $id = $product->getID();
                    //  var_dump($name);
                    // var_dump($url);
                    //  var_dump($price);
                    // var_dump($currency);
                    //  var_dump($trend_rating);
                    // var_dump($category_id);
                    //  var_dump($source);
                    // var_dump($description);exit;
                    // var_dump($id);exit;
                    // var_dump($product);exit;
                    // var_dump($meta);exit;
                    $update_stmt->bind_param( 'ssdsiiissii', $name, $url, $price, $currency, $trend_rating, $category_id,  $source, $description, $meta['last_modified_on'], $meta['last_modified_by'], $id);
// var_dump($update_stmt);exit;
                    if( !$update_stmt->execute() )
                    {
                        // echo "Hie";
                        $update_stmt->close();
                        return array('message_code' => 126);
                    }
                     // echo "Hello";exit;
                    $update_stmt->close();
                    return array('message_code' => 171);
                }
            }

        }
        else
        {

            if ($product->getImages() !="")
            {
                // echo "Hie";exit;
                $images = json_encode( $product->getImages() );
                // var_dump($images);
                // var_dump($meta);
                // var_dump($product);exit;
                if( $insert_stmt = $this->connect->prepare("INSERT INTO product ( name, url, price, currency, trend_rating, category_id, image, source, description, created_on, created_by, last_modified_on, last_modified_by ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )") )
                {
                    $insert_stmt->bind_param( 'ssdsiisissisi', $name, $url, $price, $currency, $trend_rating, $category_id, $images, $source, $description, $meta['created_on'], $meta['created_by'], $meta['last_modified_on'], $meta['last_modified_by']);
                    if( !$insert_stmt->execute() )
                    {
                        $insert_stmt->close();
                        return array('message_code' => '108' );
                    }
                    $insert_stmt->close();
                    return array('message_code' => '155', 'product_id' => $this->connect->insert_id );
                }
                else
                {
                    return array('message_code' => '108' );
                }
            }
            else
            {
                // echo "Hello";exit;
                if( $insert_stmt = $this->connect->prepare("INSERT INTO product ( name, url, price, currency, trend_rating, category_id, source, description, created_on, created_by, last_modified_on, last_modified_by ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )") )
                {
                    $insert_stmt->bind_param( 'ssdsiisissisi', $name, $url, $price, $currency, $trend_rating, $category_id, $source, $description, $meta['created_on'], $meta['created_by'], $meta['last_modified_on'], $meta['last_modified_by']);
                    if( !$insert_stmt->execute() )
                    {
                        $insert_stmt->close();
                        return array('message_code' => '108' );
                    }
                    $insert_stmt->close();
                    return array('message_code' => '155', 'product_id' => $this->connect->insert_id );
                }
                else
                {
                    return array('message_code' => '108' );
                }
            }


        }
    }

    public function getCategoriesName() {
        $query = "SELECT DISTINCT id, `name`FROM product_category";
        $stmt = $this->connect->prepare( $query );
        $stmt->bind_result( $id, $name );
        $stmt->execute();


        $cats = [];
        while($stmt->fetch()) {
            $cats[$id] = $name;

        }
        return $cats;
    }

    public function getProducts( $option, $cat_id = NULL, $offset, $limit, $datatable = false )
    {
        if( $option == 'all' )
        {

            if( $cat_id > 0 )
            {
                $query = "SELECT p.*, pc.name FROM product AS p JOIN product_category AS pc ON p.category_id = pc.id WHERE p.source <> 8 AND p.category_id = ?";
                if( isset( $limit ) && $limit != NULL ) {
                    $query .= ' LIMIT ' . $limit;
                }
                if( isset( $offset ) && $offset != NULL ) {
                    $query .= ' OFFSET ' . $offset;
                }
                $stmt = $this->connect->prepare( $query );
                $stmt->bind_param( 'i', $cat_id );
            }
            else if( $cat_id == 0) {
                if($datatable) {
                    $query = "SELECT p.id, p.name, p.image, p.price, p.currency, p.trend_rating, p.url, p.category_id, pc.name FROM product AS p JOIN product_category AS pc ON p.category_id = pc.id ORDER BY p.id DESC";
                } else {
                    $query = "SELECT p.*, pc.name FROM product AS p JOIN product_category AS pc ON p.category_id = pc.id ORDER BY id DESC";
                }

                if( isset( $limit ) && $limit != NULL ) {
                    $query .= ' LIMIT ' . $limit;
                }
                if( isset( $offset ) && $offset != NULL ) {
                    $query .= ' OFFSET ' . $offset;
                }
                $stmt = $this->connect->prepare( $query );
            }
            else
            {
                $query = "SELECT p.*, pc.name FROM product AS p JOIN product_category AS pc ON p.category_id = pc.id WHERE p.source <> 8";

                if( isset( $limit ) && $limit != NULL ) {
                    $query .= ' LIMIT ' . $limit;
                }
                if( isset( $offset ) && $offset != NULL ) {
                    $query .= ' OFFSET ' . $offset;
                }
                $stmt = $this->connect->prepare( $query );
            }

        }
        if( $option == 'social' )
        {
            $query = "SELECT p.*, pc.name FROM product AS p JOIN product_category AS pc ON p.category_id = pc.id WHERE trend_rating = -1 order by p.created_on DESC";

            if( isset( $limit ) && $limit != NULL ) {
                $query .= ' LIMIT ' . $limit;
            }
            if( isset( $offset ) && $offset != NULL ) {
                $query .= ' OFFSET ' . $offset;
            }
            $stmt = $this->connect->prepare( $query );
        }
        if( $option == 'trending' )
        {
            $rand=rand(1,9);
            if ($rand % 2 == 0)
            {
                $query = "SELECT p.*, pc.name FROM product AS p JOIN product_category AS pc ON p.category_id = pc.id WHERE trend_rating BETWEEN 0 AND 10 ORDER BY p.trend_rating DESC, p.name DESC";

                if( isset( $limit ) && $limit != NULL ) {
                    $query .= ' LIMIT ' . $limit;
                }
                if( isset( $offset ) && $offset != NULL ) {
                    $query .= ' OFFSET ' . $offset;
                }
            }
            else
            {
                $query = "SELECT p.*, pc.name FROM product AS p JOIN product_category AS pc ON p.category_id = pc.id WHERE trend_rating BETWEEN 0 AND 10 ORDER BY p.trend_rating DESC, p.name ASC";
                if( isset( $limit ) && $limit != NULL ) {
                    $query .= ' LIMIT ' . $limit;
                }
                if( isset( $offset ) && $offset != NULL ) {
                    $query .= ' OFFSET ' . $offset;
                }
            }

            $stmt = $this->connect->prepare( $query );
        }

        if($datatable) {
            $stmt->execute();
            $stmt->bind_result( $id, $name, $image, $price, $currency, $trend_rating, $url, $category_id, $cat_name );

            $products = [];
            while($stmt->fetch()) {

                $userArr = [
                    'cat_name' => $cat_name,
                    'image' => json_decode($image)->url,
                    'name' => $name,
                    'price' => $price,
                    'currency' => 'test',
                    'trend_rating' => $trend_rating,
                    'url' => $url,
                    'id' => $id,
                ];
                $products[] = array_values($userArr);

            }
            return $products;

        } else {

            $stmt->execute();
            $stmt->bind_result($id, $list_order, $name, $url, $price, $currency, $trend_rating, $category_id, $image, $source, $description, $created_on, $created_by, $last_modified_on, $last_modified_by, $cat_name);

            $products = array();
            while ($stmt->fetch()) {
                $product = new Product();

                $product->setID($id);
                $product->setOrder($list_order);
                $product->setName($name);
                $product->setURL($url);
                $product->setPrice($price);
                $product->setCurrency($currency);
                $product->setTrendRating($trend_rating);

                $category = new ProductCategory();
                $category->setID($category_id);
                $category->setName($cat_name);

                $product->setCategory($category);
                $product->setImages(json_decode($image));
                $product->setSource($source);
                $product->setDescription($description);

                $meta = array('created_on' => $created_on,
                    'created_by' => $created_by,
                    'last_modified_on' => $last_modified_on,
                    'last_modified_by' => $last_modified_by);
                $product->setMeta($meta);
                $products[] = $product;
            }

            return $products;
        }
    }

    public function getProduct( $id )
    {
        $stmt = $this->connect->prepare( "SELECT p.*, pc.name FROM product AS p JOIN product_category AS pc ON p.category_id = pc.id WHERE p.id = ?" );
        $stmt->bind_param( 'i', $id );
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result( $id, $list_order, $name, $url, $price, $currency, $trend_rating, $category_id, $image, $source, $description, $created_on, $created_by, $last_modified_on, $last_modified_by, $cat_name );
        $stmt->fetch();

        if( $stmt->num_rows > 0 )
        {
            $product = new Product();

            $product->setID( $id );
            $product->setOrder( $list_order );
            $product->setName( $name );
            $product->setURL( $url );
            $product->setPrice( $price );
            $product->setCurrency( $currency );
            $product->setTrendRating( $trend_rating );

            $category = new ProductCategory();
            $category->setID( $category_id );
            $category->setName( $cat_name );

            $product->setCategory( $category );
            $product->setImages( json_decode( $image ) );
            $product->setSource( $source );
            $product->setDescription( $description );
            $meta = array(  'created_on' => $created_on,
                'created_by' => $created_by,
                'last_modified_on' => $last_modified_on,
                'last_modified_by' => $last_modified_by );
            $product->setMeta( $meta );

            return $product;
        }
        else
        {
            return array( 'message_code' => 110 );
        }
    }

    public function createWishlist( $wishlist, $user_id )
    {
        if( $this->error_message != '' )
        {
            return $error_message;
        }

        $name = $wishlist->getName();
        $meta = $wishlist->getMeta();

        if( $insert_stmt = $this->connect->prepare("INSERT INTO wishlist (name, user_id, created_on, created_by, last_modified_on, last_modified_by) VALUES (?, ?, ?, ?, ?, ?)") )
        {
            $insert_stmt->bind_param( 'sisisi', $name, $user_id, $meta['created_on'], $meta['created_by'], $meta['last_modified_on'], $meta['last_modified_by'] );
            if( !$insert_stmt->execute() )
            {
                $insert_stmt->close();
                return array('message_code' => '111' );
            }
            $insert_stmt->close();
            return array('message_code' => '157', 'id' => $this->connect->insert_id );
        }
        else
        {
            return array('message_code' => '111' );
        }
    }

    public function addProductToWishlist( $wishlist_id, $product_id, $user_id )
    {
        if( $this->error_message != '' )
        {
            return $error_message;
        }

        $created_on = date('Y-m-d H:i:s');
        $created_by = $user_id;
        $last_modified_on = $created_on;
        $last_modified_by = $user_id;
        $grant_status = 12;
        $claim_status = 18;

        if( $insert_stmt = $this->connect->prepare("INSERT INTO wishlist_details (wishlist_id, product_id, grant_status, claim_status, created_on, created_by, last_modified_on, last_modified_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?)") )
        {
            $insert_stmt->bind_param( 'iiiisisi', $wishlist_id, $product_id, $grant_status, $claim_status, $created_on, $created_by, $last_modified_on, $last_modified_by );

            if( !$insert_stmt->execute() )
            {
                $insert_stmt->close();
                return array('message_code' => '112');
            }
            $insert_stmt->close();
            return array('message_code' => '158', 'id' => $this->connect->insert_id );
        }
        else
        {
            return array('message_code' => '112' );
        }
    }

    public function removeProductFromWishlist( $wishlist_id, $product_id )
    {
        if( $this->error_message != '' )
        {
            return $error_message;
        }

        if( $stmt = $this->connect->prepare("DELETE FROM wishlist_details WHERE product_id = ? AND wishlist_id = ?") )
        {
            $stmt->bind_param( 'ii', $product_id, $wishlist_id );

            if( !$stmt->execute() )
            {
                $stmt->close();
                return array('message_code' => '113' );
            }
            $stmt->close();
            return array('message_code' => '159' );
        }
        else
        {
            return array('message_code' => '113' );
        }
    }

    public function deleteWishlist( $wishlist_id )
    {

        $stmt = $this->connect->prepare("DELETE FROM wishlist WHERE id = ?");
        $stmt->bind_param( 'i', $wishlist_id );
        $stmt->execute();

        $stmt = $this->connect->prepare("DELETE FROM wishlist_details WHERE wishlist_id = ?");
        $stmt->bind_param( 'i', $wishlist_id );
        $stmt->execute();

        $stmt = $this->connect->prepare("DELETE FROM shared_wishlist WHERE wishlist_id = ?");
        $stmt->bind_param( 'i', $wishlist_id );
        $stmt->execute();

        return ( array( "message_code" => 163 ) );
    }

    public function shareWishlist( $wishlist_id, $user_id_by, $user_id_to )
    {
        $date = date('Y-m-d H:i:s');

        if ($user_id_by == $user_id_to )
            return array('message_code' => '162', 'id' => $wishlist_id); //Wishlist is opened by same user.
        else
        {
            $query = 'SELECT count(*) FROM shared_wishlist WHERE wishlist_id = ? and user_id = ? ';

            $stmt = $this->connect->prepare( $query );

            $stmt->bind_param( 'ii', $wishlist_id, $user_id_to  );
            $stmt->execute();
            $stmt->bind_result( $cnt );
            $stmt->store_result();

            if ($cnt == 0)
            {
                if( $insert_stmt = $this->connect->prepare("INSERT INTO shared_wishlist (wishlist_id, user_id, shared_by, created_on, created_by, last_modified_on, last_modified_by) VALUES (?, ?, ?, ?, ?, ?, ?)") )
                {

                    $insert_stmt->bind_param( 'iiisisi', $wishlist_id, $user_id_to, $user_id_by , $date, $user_id_by, $date, $user_id_by );

                    if( !$insert_stmt->execute() )
                    {
                        //return array('message_code' => $insert_stmt->error  );
                        $insert_stmt->close();
                        return array('message_code' => '114' );
                    }
                    $insert_stmt->close();
                    return array('message_code' => '162', 'id' => $this->connect->insert_id );
                }
                else
                {
                    return array('message_code' => '114' );
                }

            }
            else
            {
                return array('message_code' => '162', 'id' => $cnt); //Wishlist already opened once.
            }
        }
    }

    public function getWishlists( $user_id = -1, $sharedby = false, $sharedwith = false, $wl = false )
    {
        if( $sharedby )
        {
            $query = 'SELECT * FROM wishlist w 
                            LEFT OUTER JOIN wishlist_details wd ON w.id = wd.wishlist_id 
                        WHERE g.created_by = ?';
        }
        else if( $sharedwith )
        {
            // $query = 'SELECT * FROM wishlist w
            //              LEFT OUTER JOIN wishlist_details wd ON w.id = wd.wishlist_id
            //              LEFT OUTER JOIN givelist g ON w.id = g.wishlist_id
            //           WHERE g.shared_with = ?';
            $query = 'SELECT * FROM wishlist w 
                            LEFT OUTER JOIN wishlist_details wd ON w.id = wd.wishlist_id';
        }
        else
        {
            if( $wl )
            {
                $query = 'SELECT * FROM wishlist w 
                                LEFT OUTER JOIN wishlist_details wd ON w.id = wd.wishlist_id
                            WHERE w.id = ?';
            }
            else
            {
                if( $user_id == -1 )
                {
                    $query = 'SELECT * FROM wishlist w
                                    LEFT OUTER JOIN wishlist_details wd ON w.id = wd.wishlist_id';
                }
                else
                {
                    $query = 'SELECT * FROM wishlist w
                                    LEFT OUTER JOIN wishlist_details wd ON w.id = wd.wishlist_id
                                WHERE w.user_id = ?';
                }
            }
        }
// var_dump($query);exit;
        $stmt = $this->connect->prepare( $query );
        if( !$sharedwith && $user_id != -1 )
            $stmt->bind_param( 'i', $user_id );
        $stmt->execute();
        $stmt->bind_result( $wishlist_id, $name, $user_id, $groupstatus, $w_created_on, $w_created_by, $w_last_modified_on, $w_last_modified_by, $wld_id, $wl_id, $product_id, $grant_status, $claim_status, $status, $wp_created_on, $wp_created_by, $wp_last_modified_on, $wp_last_modified_by );
        $stmt->store_result();

        if( $stmt->num_rows > 0 )
        {
            $current_wlid = 0;
            $details = array();
            $wishlists = array();
            while( $stmt->fetch() )
            {
                // $wishlist->setStatus( $groupstatus );
                 // $wishlists['groupstatus'] = $groupstatus;
            // var_dump($wishlist);exit;
                // var_dump($groupstatus);exit;
                if( $wishlist_id != $current_wlid )
                {
                    if( isset( $wishlist ) )
                    {
                      // echo "hie";exit;   
                        $wishlist->setDetails( $details );
                        
                        $wishlists[] = $wishlist;
                        $details = NULL;
                        $wishlist = NULL;
                    }
                    // var_dump($wishlist->setName( $name ));exit;
                    
                    $wishlist = new Wishlist();
                    $wishlist->setStatus( $groupstatus );
                    $wishlist->setID( $wishlist_id );
                    $wishlist->setName( $name );
                    
                   
                    $wishlist->setUserId( $this->getUser ( $user_id ) );

                    $wl_meta['created_on'] = $w_created_on;
                    $wl_meta['created_by'] = $w_created_by;
                    $wl_meta['last_modified_on'] = $w_last_modified_on;
                    $wl_meta['last_modified_by'] = $w_last_modified_by;

                    $wishlist->setMeta( $wl_meta );

                    $current_wlid = $wishlist_id;
                }
                
// var_dump($wishlist);exit;
                // $temp['groupstatus'] = $groupstatus;
                $temp['product_id'] = $this->getProduct( $product_id );
                $temp['grant_status'] = $grant_status;
                $temp['claim_status'] = $claim_status;
                // var_dump($temp);exit;
                if( $grant_status == 19)
                    $temp['gift_id'] = $wld_id;
 // $details['groupstatus'] = $groupstatus;
                $details[] = $temp;
                $temp = NULL;
            }
            // var_dump($wishlist);exit;
             // var_dump($groupstatus);exit;
 // $wishlist['groupstatus'] = $groupstatus;
            // $wishlist->setStatus( $groupstatus );       
            $wishlist->setDetails( $details );
            // $wishlist['groupstatus'] = $groupstatus;
            $wishlists[] = $wishlist;
            // var_dump($wishlists);exit;

            if( $wl )
                return $wishlists[0];
            else
                return $wishlists;
        }
        else
        {
            if ( $sharedby )
            {
                return array( "message_code" => 115 );
            }
            else if ( $sharedwith )
            {
                return array( "message_code" => 116 );
            }
            else
            {
                return array( "message_code" => 117 );
            }
        }
    }


    public function getSharedWishlists($user_id)
    {

        $query = 'SELECT * FROM wishlist w 
                    LEFT OUTER JOIN wishlist_details wd ON w.id = wd.wishlist_id 
                    WHERE w.id IN (SELECT distinct wishlist_id FROM shared_wishlist where user_id = ? )';

        $stmt = $this->connect->prepare( $query );

        $stmt->bind_param( 'i', $user_id );
        $stmt->execute();
        $stmt->bind_result( $wishlist_id, $name, $user_id, $groupstatus, $w_created_on, $w_created_by, $w_last_modified_on, $w_last_modified_by, $wld_id, $wl_id, $product_id, $grant_status, $claim_status, $status, $wp_created_on, $wp_created_by, $wp_last_modified_on, $wp_last_modified_by );
        $stmt->store_result();
//var_dump($stmt);exit;
        if( $stmt->num_rows > 0 )
        {
            
            $current_wlid = 0;
            $details = array();
            $wishlists = array();
            while( $stmt->fetch() )
            {
                //echo "Inside";exit;
                if( $wishlist_id != $current_wlid )
                {
                    if( isset( $wishlist ) )
                    {
                        $wishlist->setDetails( $details );

                        $wishlists[] = $wishlist;
                        $details = NULL;
                        $wishlist = NULL;
                    }
                    $wishlist = new Wishlist();
                    $wishlist->setStatus( $groupstatus );
                    $wishlist->setID( $wishlist_id );
                    $wishlist->setName( $name );
                    $wishlist->setUserId( $this->getUser ( $user_id ) );

                    $wl_meta['created_on'] = $w_created_on;
                    $wl_meta['created_by'] = $w_created_by;
                    $wl_meta['last_modified_on'] = $w_last_modified_on;
                    $wl_meta['last_modified_by'] = $w_last_modified_by;

                    $wishlist->setMeta( $wl_meta );

                    $current_wlid = $wishlist_id;
                }
                
                // $temp['groupstatus'] = $groupstatus;
                $temp['product_id'] = $this->getProduct( $product_id );
                $temp['grant_status'] = $grant_status;
                $temp['claim_status'] = $claim_status;
                if( $grant_status == 19)
                    $temp['gift_id'] = $wld_id;

                $details[] = $temp;
                $temp = NULL;
            }

            $wishlist->setDetails( $details );
            // $wishlists['shared_by'] = "123";
            $wishlists[] = $wishlist;
            return $wishlists;
        }
        else
        {
          //  echo "Outside";exit;
            return array( "message_code" => 115 );
        }
    }

    public function deleteMessage( $message_id )
    {
        $stmt = $this->connect->prepare('DELETE FROM messages WHERE id = ?');

        $stmt->bind_param( 'i', $message_id );
        $stmt->execute();

        return array('message_code' => 187);
    }

    public function createMessage( $message )
    {
        if( $this->error_message != '' )
        {
            return $error_message;
        }

        $gift_id = $message->getGiftId();
        $message_type = $message->getMessageType();
        $message_content = $message->getMessageContent();
        $message_desc = $message->getMessageDesc();
        $meta = $message->getMeta();

        if ( $insert_stmt = $this->connect->prepare( "INSERT INTO messages (gift_id, message_desc, message_type, message_content, created_on, created_by, last_modified_on, last_modified_by) VALUES ( ?, ?, ?, ?, ?, ?, ?, ? )" ) )
        {
            $insert_stmt->bind_param( 'iiissisi', $gift_id, $message_desc, $message_type, $message_content, $meta['created_on'], $meta['created_by'], $meta['last_modified_on'], $meta['last_modified_by'] );
            if( !$insert_stmt->execute() )
            {
                $insert_stmt->close();
                return array('message_code' => '118', 'err' => $insert_stmt->error );
            }
            $insert_stmt->close();
            $mid = $this->connect->insert_id;
            if( $message_desc == 17 )
            {
                $gift = $this->getGiftInfo( $gift_id );
                $meta = $gift->gift_thankyou_id[0]->getMeta();

                $res = $this->notify( $gift->sender_id, 'You have received a Thank You message', $gift->product_id, '20', $meta );
            }
            return array('message_code' => '164', 'id' => $mid, 'res' => $res );
        }
        else
        {
            return array('message_code' => '118' );
        }
    }

    public function getMessage( $id, $gift = false )
    {
        if( $gift )
        {
            $stmt = $this->connect->prepare( 'SELECT * FROM messages WHERE gift_id = ?');
        }
        else
        {
            $stmt = $this->connect->prepare( 'SELECT * FROM messages WHERE id = ?' );
        }

        $stmt->bind_param( 'i', $id );
        $stmt->execute();
        $stmt->bind_result( $m_id, $gift_id, $message_desc, $message_type, $message_content, $created_on, $created_by, $last_modified_on, $last_modified_by );
        $stmt->store_result();

        if( $stmt->num_rows > 0 )
        {
            $messages = array();
            while ( $stmt->fetch() )
            {

                $message = new Message();

                $message->setID( $m_id );
                $message->setMessageType( $message_type );
                $message->setMessageContent( $message_content );
                $message->setMessageDesc( $message_desc );

                $meta['created_on'] = $created_on;
                $meta['created_by'] = $created_by;
                $meta['last_modified_on'] = $last_modified_on;
                $meta['last_modified_by'] = $last_modified_by;

                $message->setMeta( $meta );

                array_push( $messages, $message );
            }

            return $messages;
        }
        else
        {
            return array( 'error_message' => 119 );
        }
    }

    // public function giveGift( $gift )
    // {
    //     if( $this->error_message != '' )
    //     {
    //         return $error_message;
    //     }

    //     if( $insert_stmt = $this->connect->prepare( "INSERT INTO gift ( wishlist_id, product_id, order_details, delivery_details, created_on, created_by, last_modified_on, last_modified_by) VALUES (?, ?, ?, ?, ?, ?, ?, ? ) ") )
    //     {
    //         $wishlist_id = $gift->getWishlistID();
    //         $product_id = $gift->getProductID();
    //         $order_details = $gift->getOrderDetails();
    //         $delivery_details = $gift->getDeliveryDetails();
    //         $gift_message_id = $gift->getGiftMessage();
    //         $gift_thankyou_id = $gift->getThankYouMessage();
    //         $meta = $gift->getMeta();

    //         $insert_stmt->bind_param( 'iisssisi', $wishlist_id, $product_id, $order_details, $delivery_details, $meta['created_on'], $meta['created_by'], $meta['last_modified_on'], $meta['last_modified_by'] );

    //         if( !$insert_stmt->execute() )
    //         {
    //             //$insert_stmt->close();
    //             return array('message_code' => 120, 'error' => $insert_stmt->error );
    //         }
    //         $insert_stmt->close();
    //         return array('message_code' => 165, 'id' => $this->connect->insert_id );
    //     }
    //     else
    //     {
    //         return array('message_code' => 120 );
    //     }
    // }

    public function giveGift( $gift )
    {
        if( $this->error_message != '' )
        {

            return $error_message;
        }
// echo "Hello";exit;
        // 16feb -m
        if( $insert_stmt = $this->connect->prepare( "INSERT INTO gift ( gift_id, wishlist_id, product_id, order_details, delivery_details, created_on, created_by, last_modified_on, last_modified_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ? ) ") )     // 16feb -m
        {
            $gift_id =  $gift->getGiftID();
            $wishlist_id = $gift->getWishlistID();
            $product_id = $gift->getProductID();
            $order_details = $gift->getOrderDetails();
            $delivery_details = $gift->getDeliveryDetails();
            $gift_message_id = $gift->getGiftMessage();
            $gift_thankyou_id = $gift->getThankYouMessage();
            $meta = $gift->getMeta();

            // 16feb -m
            $insert_stmt->bind_param( 'iiisssisi', $gift_id, $wishlist_id, $product_id, $order_details, $delivery_details, $meta['created_on'], $meta['created_by'], $meta['last_modified_on'], $meta['last_modified_by'] );

            if( !$insert_stmt->execute() )
            {
                //$insert_stmt->close();
                return array('message_code' => 120, 'error' => $insert_stmt->error );
            }
            $insert_stmt->close();
            return array('message_code' => 165, 'id' => $this->connect->insert_id );
        }
        else
        {
            return array('message_code' => 120 );
        }
    }

    public function getGiftsGiven( $user_id )
    {
        if( $this->error_message != '' )
        {

            return $error_message;
        }

        $stmt = $this->connect->prepare("SELECT id, wishlist_id, product_id, created_by, last_modified_on FROM wishlist_details WHERE last_modified_by = ? AND grant_status = 13 ORDER BY last_modified_on DESC");
        $stmt->bind_param( 'i', $user_id );
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result( $gift_id, $wishlist_id, $product_id, $created_by, $last_modified_on );

        $gifts = array();

        if( $stmt->num_rows > 0 )
        {

            while( $stmt->fetch() )
            {

                $gift = array(
                    'product' => $this->getProduct( $product_id ),
                    'gift_id' => $gift_id,
                    'gift_info' => $this->getGiftInfo( $gift_id ),
                    'wishlist_id' => $wishlist_id,
                    'meta' => array(
                        'created_by' => $this->getUser( $created_by ),
                        'created_on' => $last_modified_on
                    )
                );
 // echo "Hello";exit;
 
                array_push( $gifts, $gift );
                // return $gifts;
// var_dump($gifts);exit;
                $gift = NULL;
            }
            // var_dump($gifts);exit;
            return $gifts;
        }
        else
        {
            return array( "message_code" => 121 );
        }
    }


    public function getGiftsReceived( $user_id )
    {
        if( $this->error_message != '' )
        {
            return $error_message;
        }

        $stmt = $this->connect->prepare("SELECT id, wishlist_id, product_id, last_modified_by, last_modified_on FROM wishlist_details WHERE created_by = ? AND grant_status = 13 ORDER BY last_modified_on DESC");
        $stmt->bind_param( 'i', $user_id );
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result( $gift_id, $wishlist_id, $product_id, $last_modified_by, $last_modified_on );

        $gifts = array();

        if( $stmt->num_rows > 0 )
        {
            while( $stmt->fetch() )
            {
                $gift = array(
                    'product' => $this->getProduct( $product_id ),
                    'gift_id' => $gift_id,
                    'gift_info' => $this->getGiftInfo( $gift_id ),
                    'wishlist_id' => $wishlist_id,
                    'meta' => array(
                        'created_by' => $this->getUser( $last_modified_by ),
                        'created_on' => $last_modified_on
                    )
                );
                /*$gift = new Gift();

                $gift->setID( $id );
                $gift->setWishlistID( $wishlist_id );
                $gift->setProductID( $this->getProduct( $product_id ) );
                $gift->setOrderDetails( $order_details );
                $gift->setDeliveryDetails( $delivery_details );

                $meta['created_on'] = $created_on;
                $meta['created_by'] = $this->getUser( $created_by );
                $meta['last_modified_on'] = $last_modified_on;
                $meta['last_modified_by'] = $last_modified_by;

                $gift->setMeta( $meta );

                $stmt2 = $this->connect->prepare("SELECT * FROM messages WHERE gift_id = ?");

                $stmt2->bind_param( 'i', $id );
                $stmt2->execute();
                $stmt2->store_result();
                $stmt2->bind_result( $id, $gift_id, $message_desc, $message_type, $message_content, $created_on, $created_by, $last_modified_on, $last_modified_by );

                while( $stmt2->fetch() )
                {
                    if( $message_desc == 16 )
                    {
                        $gift->setGiftMessage( $id );
                    }
                    else
                    {
                        $gift->setThankYouMessage( $id );
                    }
                }*/

                array_push( $gifts, $gift );

                $gift = NULL;
            }
            return $gifts;
        }
        else
        {
            return array( "message_code" => 122 );
        }
    }

    public function getGiftInfo( $gift_id )
    {
        if( $this->error_message != '' )
        {
            return $error_message;
        }

        $stmt = $this->connect->prepare("SELECT wd.product_id, g.*, wd.last_modified_by FROM wishlist_details wd JOIN gift g ON g.gift_id = wd.id WHERE wd.id = ?");
        $stmt->bind_param( 'i', $gift_id );
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result( $product_id, $id, $gift_id, $order_details, $delivery_date, $sender_id );

        if( $stmt->num_rows > 0 )
        {
            $stmt->fetch();

            $gift = new stdClass();

            $gift->gift_id =  $gift_id;
            $gift->product_id = $product_id;
            $gift->order_details = $order_details;
            $gift->delivery_date = $delivery_date;
            $gift->sender_id = $sender_id;
// var_dump($gift_id);exit;
            $stmt2 = $this->connect->prepare("SELECT * FROM messages WHERE gift_id = ?");

            $stmt2->bind_param( 'i', $gift_id );
            $stmt2->execute();
            $stmt2->store_result();
            $stmt2->bind_result( $id, $gift_id, $message_desc, $message_type, $message_content, $created_on, $created_by, $last_modified_on, $last_modified_by );

            while( $stmt2->fetch() )
            {

                if( $message_desc == 16 )
                {
                    // echo "Hie";exit;
                    // var_dump($id);exit;
                    $gift->gift_message_id = $this->getMessage( $id );
                }
                else
                {
                    // echo "Hello";exit;
                    $gift->gift_thankyou_id = $this->getMessage( $id );
                }
            }

            return $gift;
        }
        else
        {
            return array( "message_code" => 123 );
        }
    }

    public function updateDeliveryDetails( $gift_id, $delivery_details )
    {
        if( $this->error_message != '' )
        {
            return $error_message;
        }

        $stmt = $this->connect->prepare("UPDATE gift SET delivery_details = ? WHERE gift_id = ?");

        $stmt->bind_param( 'si', $delivery_details, $gift_id );

        if( $stmt->execute() )
        {
            return array( "message_code" => 168 );
        }
        else
        {
            return array( "message_code" => 123 );
        }
    }

    public function updateOrderDetails( $gift_id, $order_details )
    {
        if( $this->error_message != '' )
        {
            return $error_message;
        }

        $stmt = $this->connect->prepare("UPDATE gift SET order_details = ? WHERE gift_id = ?");

        $stmt->bind_param( 'si', $order_details, $gift_id );

        if( $stmt->execute() )
        {
            return array( "message_code" => 169 );
        }
        else
        {
            return array( "message_code" => 123 );
        }
    }

    public function toggleClaimed( $user_id, $wishlist_id, $product_id, $mark )
    {
        if( $this->error_message != '' )
        {
            return $error_message;
        }

        $stmt = $this->connect->prepare('UPDATE wishlist_details SET claim_status = ? WHERE wishlist_id = ? AND product_id = ?');

        $claim_status = $mark ? 19 : 18;
        $last_modified_on = date('Y-m-d H:i:s');
        $last_modified_by = $user_id;

        $stmt->bind_param( 'iii', $claim_status, $wishlist_id, $product_id );

        if( !$stmt->execute() )
        {
            $message_code = $mark ? 127 : 128;
            return array( 'message_code' => $message_code );
        }
        else
        {
            $message_code = $mark ? 173 : 174;
            $notify_user = $this->getUserFromWishList( $wishlist_id );
            $action = $mark ? 'Product was marked as claimed' : 'Product was unmarked as claimed';
            $meta = array(
                'created_by' => $user_id,
                'created_on' => $last_modified_on,
                'last_modified_by' => $user_id,
                'last_modified_on' => $last_modified_on
            );
            $note = $this->notify( $notify_user, $action, $product_id , '20', $meta );
            return array( 'message_code' => $message_code );
        }
    }

    public function toggleGranted( $user_id, $wishlist_id, $product_id, $mark )
    {
        if( $this->error_message != '' )
        {
            return $error_message;
        }

        $stmt = $this->connect->prepare('UPDATE wishlist_details SET grant_status = ?, last_modified_on = ?, last_modified_by = ? WHERE wishlist_id = ? AND product_id = ?');

        $grant_status = $mark ? 13 : 12;
        $last_modified_on = date('Y-m-d H:i:s');
        $last_modified_by = $user_id;

        $stmt->bind_param( 'isiii', $grant_status, $last_modified_on, $last_modified_by, $wishlist_id, $product_id );

        if( !$stmt->execute() )
        {
            $message_code = $mark ? 129 : 130;
            return array( 'message_code' => $message_code );
        }
        else
        {
            $stmt = NULL;
            $stmt = $this->connect->prepare('SELECT id FROM wishlist_details WHERE wishlist_id = ? AND product_id = ?');

            $stmt->bind_param( 'ii', $wishlist_id, $product_id );
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result( $gift_id );
            $stmt->fetch();

            $b = '';
            $bd = '0000-00-00 00:00:00';
            $insert_stmt = $this->connect->prepare( 'INSERT INTO gift (gift_id, order_details, delivery_details) VALUES (?, ?, ?)' );
            $insert_stmt->bind_param( 'iss', $gift_id, $b, $bd );
            $insert_stmt->execute();

            $message_code = $mark ? 175 : 176;
            $notify_user = $this->getUserFromWishList( $wishlist_id );
            $action = $mark ? 'Product was marked as granted' : 'Product was unmarked as granted';
            $meta = array(
                'created_by' => $user_id,
                'created_on' => $last_modified_on,
                'last_modified_by' => $user_id,
                'last_modified_on' => $last_modified_on
            );
            $note = $this->notify( $notify_user, $action, $product_id , '20', $meta );
            return array( 'message_code' => $message_code, 'gift_id' => $gift_id );
        }
    }

    // public function toggleGranted( $user_id, $wishlist_id, $product_id, $mark )
    // {
    //     if( $this->error_message != '' )
    //     {
    //         return $error_message;
    //     }

    //     $stmt = $this->connect->prepare('UPDATE wishlist_details SET grant_status = ?, last_modified_on = ?, last_modified_by = ? WHERE wishlist_id = ? AND product_id = ?');

    //     $grant_status = $mark ? 13 : 12;
    //     $last_modified_on = date('Y-m-d H:i:s');
    //     $last_modified_by = $user_id;

    //     $stmt->bind_param( 'isiii', $grant_status, $last_modified_on, $last_modified_by, $wishlist_id, $product_id );

    //     if( !$stmt->execute() )
    //     {
    //         $message_code = $mark ? 129 : 130;
    //         return array( 'message_code' => $message_code );
    //     }
    //     else
    //     {
    //         // ------------------- modified - 19 Feb -m -----------------

    //         // $stmt = NULL;
    //         // $stmt = $this->connect->prepare('SELECT id FROM wishlist_details WHERE wishlist_id = ? AND product_id = ?');

    //         // $stmt->bind_param( 'ii', $wishlist_id, $product_id );
    //         // $stmt->execute();
    //         // $stmt->store_result();
    //         // $stmt->bind_result( $gift_id );
    //         // $stmt->fetch();

    //         // $b = '';
    //         // $bd = '0000-00-00 00:00:00';
    //         // $insert_stmt = $this->connect->prepare( 'INSERT INTO gift (gift_id, order_details, delivery_details) VALUES (?, ?, ?)' );
    //         // $insert_stmt->bind_param( 'iss', $gift_id, $b, $bd );
    //         // $insert_stmt->execute();

    //         // $message_code = $mark ? 175 : 176;

    //         // -------------------- modified - 19 Feb -m -----------------
            
    //         $notify_user = $this->getUserFromWishList( $wishlist_id );
    //         $action = $mark ? 'Product was marked as granted' : 'Product was unmarked as granted';
    //         $meta = array(
    //             'created_by' => $user_id,
    //             'created_on' => $last_modified_on,
    //             'last_modified_by' => $user_id,
    //             'last_modified_on' => $last_modified_on
    //         );
    //         $note = $this->notify( $notify_user, $action, $product_id , '20', $meta );
    //         return array( 'message_code' => $message_code, 'gift_id' => $gift_id );
    //     }
    // }

    public function toggleGrantList( $user_id, $product_id, $add )
    {
        if( $this->error_message != '' )
        {
            return $error_message;
        }

        if( $add )
        {
            $stmt = $this->connect->prepare('INSERT INTO grantlist (user_id, product_id, created_on, created_by, last_modified_on, last_modified_by) VALUES (?, ?, ?, ?, ?, ?)');

            $created_on = date('Y-m-d H:i:s');
            $created_by = $user_id;
            $last_modified_on = $created_on;
            $last_modified_by = $created_by;

            $stmt->bind_param('iisisi', $user_id, $product_id, $created_on, $created_by, $last_modified_on, $last_modified_by);
        }
        else
        {
            $stmt = $this->connect->prepare('DELETE FROM grantlist WHERE user_id = ? AND product_id = ?');
            $stmt->bind_param('ii', $user_id, $product_id);
        }

        if( !$stmt->execute() )
        {
            $message_code = $add ? 131 : 132;
            return array( 'message_code' => $message_code );
        }
        else
        {
            $message_code = $add ? 177 : 178;
            return array( 'message_code' => $message_code );
        }
    }

    public function getGrantList( $user_id )
    {
        if( $this->error_message != '' )
        {
            return $error_message;
        }

        $stmt = $this->connect->prepare('SELECT * FROM grantlist WHERE user_id = ? ORDER BY created_on DESC');

        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->bind_result( $id, $uid, $product_id, $created_on, $created_by, $last_modified_on, $last_modified_by);
        $stmt->store_result();

        $grantlist = array();

        while( $stmt->fetch() )
        {
            $tmp = array(
                'id' => $id,
                'user' => $this->getUser( $user_id ),
                'product' => $this->getProduct( $product_id ),
                'meta' => array(
                    'created_on' => $created_on,
                    'created_by' => $created_by,
                    'last_modified_on' => $last_modified_on,
                    'last_modified_by' => $last_modified_by
                )
            );

            array_push( $grantlist, $tmp );
            $tmp = null;
        }

        return $grantlist;
    }

    public function postFeedback( $user_id, $email, $message)
    {
        if( $this->error_message != '' )
        {
            return $error_message;
        }


        $stmt2 = $this->connect->prepare('SELECT  `first_name`, `last_name` FROM users WHERE id = ?');

        $stmt2->bind_param('i', $user_id);
        $stmt2->execute();
        $stmt2->store_result();
        $stmt2->bind_result( $fname, $lname);
        $stmt2->fetch();

        if( $stmt2 )
        {
            $first_name = $fname;
            $last_name = $lname;
        }

        $messageDesc= "User's name : " . $first_name . " " . $last_name ."<br/>" .
            "User's email address : " . $email . "<br/>".
            "Feedback description : " . $message;


        if( $insert_stmt = $this->connect->prepare('INSERT INTO feedback (email, message, created_on, created_by, last_modified_on, last_modified_by) VALUES (?, ?, ?, ?, ?, ?)') )
        {
            $created_on = date('Y-m-d H:i:s');
            $insert_stmt->bind_param( 'sssisi', $email, $messageDesc, $created_on, $user_id, $created_on, $user_id );

            if( !$insert_stmt->execute())
            {
                return array( 'message_code' => 133 );

            }
            else
            {
                $this->sendFeedback( $messageDesc );
                return array( 'message_code' => 179 );
            }
        }

        else
        {
            return array( 'message_code' => 133 );
        }
    }

    public function notify( $user_id, $action, $action_id, $status, $meta )
    {
        // var_dump($action_id);exit;
        if( $insert_stmt = $this->connect->prepare('INSERT INTO notifications (user_id, action, action_id, status, created_on, created_by, last_modified_on, last_modified_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?)') )
        {
            $insert_stmt->bind_param('isiisisi', $user_id, $action, $action_id, $status, $meta['created_on'], $meta['created_by'], $meta['last_modified_on'], $meta['last_modified_by']);

            /*echo $user_id;
            echo $action;
            echo $action_id;
            echo $status;
            echo $meta['created_on'];
            echo $meta['created_by'];
            echo $meta['last_modified_on'];
            echo $meta['last_modified_by'];
            exit(); */

            if( !$insert_stmt->execute() )
            {
                //echo "Done";
                return array('message_code' => 134, 'error' => $insert_stmt->error );
            }
            else
            {
                //echo var_dump($insert_stmt);
                //exit();
                return array('message_code' => 180);
            }
        }
        else
        {
            return array('message_code' => 134 );
        }
    }

    public function getUserFromWishList( $wishlist_id )
    {
        $stmt = $this->connect->prepare('SELECT user_id FROM wishlist WHERE id = ?');

        $stmt->bind_param('i', $wishlist_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result( $user_id );
        $stmt->fetch();

        return $user_id;
    }

    public function getNotifications( $user_id )
    {
        $stmt = $this->connect->prepare('SELECT * FROM notifications WHERE user_id = ? ORDER BY created_on DESC');

        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result( $id, $uid, $action, $action_id, $status, $created_by, $created_on, $last_modified_by, $last_modified_on);

        $notifications = array();

        while( $stmt->fetch() )
        {
            $tmp = array(
                'id' => $id,
                'user' => $this->getUser( $uid ),
                'action' => $action,
                'action_details' => $this->getProduct( $action_id ),
                'status' => $status,
                'meta' => array (
                    'created_by' => $this->getUser( $created_by ),
                    'created_on' => $created_on,
                    'last_modified_by' => $this->getUser( $last_modified_by ),
                    'last_modified_on' => $last_modified_on
                )
            );

            array_push( $notifications, $tmp );
            $tmp = NULL;
        }

        if( $stmt->num_rows > 0)
        {
            return $notifications;
        }
        else
        {
            return array('message_code' => 183);
        }
    }



    public function getNotificationsCount( $user_id )
    {

        $count= 0;
        $stmt = $this->connect->prepare('SELECT count(*)  as cnt FROM notifications WHERE user_id = ? and status = 20');

        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($count);
        $stmt->fetch();

        return array('count' => $count);

    }


    public function markNotificationAsRead( $user_id, $notification_id )
    {
        $stmt = $this->connect->prepare('UPDATE notifications SET status = 21, last_modified_by = ?, last_modified_on = ? WHERE id = ?');

        $last_modified_on = date('Y-m-d H:i:s');
        $stmt->bind_param('isi', $user_id, $last_modified_on, $notification_id );

        if( !$stmt->execute() )
        {
            return array('message_code' => 135);
        }
        else
        {
            return array('message_code' => 181);
        }
    }

    public function clearNotification( $user_id, $notification_id )
    {
        $stmt = $this->connect->prepare('DELETE FROM notifications WHERE id = ?');

        $last_modified_on = date('Y-m-d H:i:s');
        $stmt->bind_param('isi', $user_id, $last_modified_on, $notification_id );

        if( !$stmt->execute() )
        {
            return array('message_code' => 136);
        }
        else
        {
            return array('message_code' => 182);
        }
    }

    public function toggleUserStatus( $user_id, $active )
    {
        if( $active )
        {
            $stmt = $this->connect->prepare('UPDATE users SET status = 2 WHERE id = ?');
        }
        else
        {
            $stmt = $this->connect->prepare('UPDATE users SET status = 1 WHERE id = ?');
        }

        $stmt->bind_param( 'i', $user_id );

        if( !$stmt->execute() )
        {
            return array('message_code' => 137);
        }
        else
        {
            return array('message_code' => 184);
        }
    }

    public function getUserStatus( $user_id )
    {
        $stmt = $this->connect->prepare('SELECT status FROM users WHERE id = ?');

        $stmt->bind_param( 'i', $user_id );

        $stmt->execute();
        $stmt->bind_result( $status );
        $stmt->fetch();

        if( !$stmt->execute() )
        {
            return array('message_code' => 139);
        }
        else
        {
            return array('status' => $status);
        }
    }

    public function sendFeedback( $message )
    {
        $to = 'vikram@giftjeenie.com';
        //$to = 'sahar@joshiinc.com';


        $subject = "Gift Jeenie Feedback";

        $header = "From: Gift Jeenie Admin <support@giftjeenie.com> \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        ini_set('smtp_user','mallika@giftjeenie.com');
        ini_set('smtp_pass','Makhijani070991');

        $result = mail( $to, $subject, $message, $header );
    }

    public function deleteProduct( $id )
    {
        $stmt = $this->connect->prepare('DELETE FROM product WHERE id = ?');

        $stmt->bind_param( 'i', $id );
        $stmt->execute();

        return array( 'message_code' => 186 );
    }

    public function getCategories()
    {
        $stmt = $this->connect->prepare('SELECT * FROM product_category');

        $stmt->execute();
        $stmt->bind_result( $id, $name, $created_on, $created_by, $last_modified_on, $last_modified_by );

        $cat = array();

        while( $stmt->fetch() )
        {
            $tmp = array (
                'id' => $id,
                'name' => $name,
                'meta' => array(
                    'created_on' => $created_on,
                    'created_by' => $created_by,
                    'last_modified_on' => $last_modified_on,
                    'last_modified_by' => $last_modified_by
                )
            );

            array_push( $cat, $tmp );
            $tmp = null;
        }

        return $cat;
    }

    public function updateTrend( $pid, $tr )
    {
        $stmt = $this->connect->prepare('UPDATE product SET trend_rating = ? WHERE id = ?');

        $stmt->bind_param('ii', $tr, $pid);
        $stmt->execute();

        return array( 'message_code' => 188 );
    }

//send birthday notifucation
    public function birthday()
    {
        // $monthyear = '';
        // if ($monthyear !='')
        //  $query = "SELECT id, first_name, last_name, date_of_birth FROM `users` where substr(date_of_birth,6,5) = " . $monthyear . " ORDER BY id DESC";
        // else
        $query = "SELECT id, first_name, last_name, date_of_birth FROM `users` where substr(date_of_birth,6,5) = substr(CURDATE(),6,5) ORDER BY id DESC";

        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result( $id, $first_name, $last_name,$dob);
        $users = array();

        while ( $stmt->fetch() )
        {
            // $user = new User( $first_name, $last_name);
            // $user->setID( $id );
            // $user->setDob( $dob );

            $query = "SELECT distinct user_id FROM shared_wishlist where shared_by = " . $id;

            $stmt1 = $this->connect->prepare( $query );
            //echo $this->connect->error;
            $stmt1->execute();
            $stmt1->store_result();
            $stmt1->bind_result( $user_id);

            while ( $stmt1->fetch() )
            {

                if ($id != $user_id)
                {

                    $meta = array(
                        'created_by' => $id,
                        'created_on' => date('Y-m-d H:i:s'),
                        'last_modified_by' => $id,
                        'last_modified_on' => date('Y-m-d H:i:s')
                    );

                    $res = $this->notify( $user_id, $first_name . ' has got birthday TODAY!', 0, '20', $meta );
                }

            }


            $stmt1 = $this->connect->prepare("SELECT distinct shared_by FROM `shared_wishlist` where user_id = " .  $id);
            $stmt1->execute();
            $stmt1->bind_result( $user_id);

            while ( $stmt1->fetch() )
            {
                if ($id != $user_id)
                {
                    $meta = array(
                        'created_by' => $id,
                        'created_on' => date('Y-m-d H:i:s'),
                        'last_modified_by' => $id,
                        'last_modified_on' => date('Y-m-d H:i:s')
                    );

                    $res = $this->notify( $user_id, $first_name . ' has got birthday TODAY!', 0, '20', $meta );
                }
            }


            // $users[] = $user;
            // $user = NULL;
        }


        return array( 'Birth date:' => date('Y-m-d H:i:s') );

    }

    public function createBrand($name, $img, $user_id)
    {
        $stmt = $this->connect->prepare('INSERT INTO brands (brand_name, brand_image, created_on, created_by, last_modified_on, last_modified_by) VALUES (?, ?, ?, ?, ?, ?)');
        
        if( $stmt ) {
            $created_on = date('Y-m-d H:i:s');
            $stmt->bind_param('sssisi', $name, json_encode($img), $created_on, $user_id, $created_on, $user_id);
            $stmt->execute();
            $stmt->close();
        }

        return ['message_code' => 307, 'brand_id' => $this->connect->insert_id ];
    }

    public function updateBrand($brand_id, $name, $img, $user_id)
    {
        $stmt = $this->connect->prepare('UPDATE brands SET brand_name = ?, brand_image = ?, last_modified_on = ?, last_modified_by = ? WHERE id = ?');
        
        if( $stmt ) {
            $created_on = date('Y-m-d H:i:s');
            $stmt->bind_param('sssii', $name, json_encode($img), $created_on, $user_id, $brand_id);
            $stmt->execute();
            $stmt->close();
        }

        return ['message_code' => 311, 'brand_id' => $brand_id];
    }

    public function addProductToBrand($product_id, $brand_id)
    {
        $stmt = $this->connect->prepare('INSERT INTO brand_items (brand_id, product_id) VALUES (?, ?)');
        
        if( $stmt ) {
            if(is_array($product_id)) {
                foreach ($product_id as $id) {
                    $stmt->bind_param('ii', $brand_id, $id);
                    $stmt->execute();
                }
            } else {
                $stmt->bind_param('ii', $brand_id, $product_id);
                $stmt->execute();
            }
            $stmt->close();
        }

        return [ 'message_code' => 309 ];
    }

    public function getDeals()
    {
        $stmt = $this->connect->prepare('SELECT brands.id, brands.brand_name, brands.brand_image, product.id, product.name, product.url, product.price, product.currency, product.trend_rating, product.image FROM brands
                    LEFT JOIN brand_items ON brands.id = brand_items.brand_id
                    LEFT JOIN product ON product.id = brand_items.product_id');
        if( $stmt ) {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($brand_id, $brand_name, $brand_image, $product_id, $product_name, $product_url, $product_price, $product_currency, $product_trend_rating, $product_image);

            $data = [];
            $out_brand_id = 0;
            while($stmt->fetch()) {
                if( $out_brand_id != $brand_id) {
                    $out_brand_id = $brand_id;
                    $data[$out_brand_id]['brand_id'] = $out_brand_id;
                    $data[$out_brand_id]['brand_name'] = $brand_name;
                    $data[$out_brand_id]['brand_image'] = $brand_image;
                    $data[$out_brand_id]['products'] = [];
                }
                if (!is_null($product_id)) {
                    $data[$out_brand_id]['products'][] = [
                        'product_id' => $product_id,
                        'product_name' => $product_name,
                        'product_name' => $product_name,
                        'product_url' => $product_url,
                        'product_url' => $product_url,
                        'product_price' => $product_price,
                        'product_price' => $product_price,
                        'product_currency' => $product_currency,
                        'product_trend_rating' => $product_trend_rating,
                        'product_image' => $product_image
                    ];
                }
            }
        }

        return ['message_code' => 303, 'data' => array_values($data) ];
    }

    public function getBrands()
    {
        $count = $this->connect->prepare('SELECT count(*) FROM brands');
        $count->execute();
        $count->store_result();
        $count->bind_result($total);
        $count->fetch();
        $count->close();

        $stmt = $this->connect->prepare('SELECT brands.id, brands.brand_name, brands.brand_image, count(brand_items.id) AS total_items 
                    FROM brands LEFT JOIN brand_items on brands.id = brand_items.brand_id GROUP BY brands.id');

        if($stmt) {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $brand_name, $brand_image, $total_items);

            $brands = [];
            while($stmt->fetch()) {
                $brands[$id]['brand_id'] =  $id;
                $brands[$id]['brand_name'] =  $brand_name;
                $brands[$id]['brand_image'] =  json_decode($brand_image)->url;
                $brands[$id]['total_items'] = $total_items;
            }
            $stmt->close();
            
            return ['recordsTotal' => $total, 'recordsFiltered' => count($brands), 'data' => array_values($brands)];
        }
    }

    public function getBrand($bid)
    {
        $stmt = $this->connect->prepare('SELECT brands.id, brands.brand_name, brands.brand_image, product.id, product.name, product.url, product.price, product.currency, product.trend_rating, product.image FROM brands
                    LEFT JOIN brand_items ON brands.id = brand_items.brand_id
                    LEFT JOIN product ON product.id = brand_items.product_id
                    WHERE brands.id = ?');

        if( $stmt ) {
            $stmt->bind_param('i', $bid);
            $stmt->execute();
            $stmt->store_result();

            $stmt->bind_result($brand_id, $brand_name, $brand_image, $product_id, $product_name, $product_url, $product_price, $product_currency, $product_trend_rating, $product_image);
            $data = [];
            $out_brand_id = 0;
            while($stmt->fetch()) {
                $total++;
                if( $out_brand_id != $brand_id) {
                    $out_brand_id = $brand_id;
                    $data['brand_id'] = $brand_id;
                    $data['brand_name'] = $brand_name;
                    $data['brand_image'] = $brand_image;
                    $data['products'] = [];
                }
                if(null !== $product_id ) {
                    $data['products'][] = [
                        'product_id' => $product_id,
                        'product_name' => $product_name,
                        'product_name' => $product_name,
                        'product_url' => $product_url,
                        'product_url' => $product_url,
                        'product_price' => $product_price,
                        'product_price' => $product_price,
                        'product_currency' => $product_currency,
                        'product_trend_rating' => $product_trend_rating,
                        'product_image' => $product_image
                    ];
                }
            }
        }

        return ['message_code' => 303, 'data' => $data ];
    }

    public function deleteBrand($brand_id)
    {
        $stmt = $this->connect->prepare('DELETE FROM brands WHERE id = ?');
        if( $stmt ) {
            $stmt->bind_param('i', $brand_id);
            $stmt->execute();
            $stmt->close();
            return true;
        }
        return false;
    }

    public function createList($name, $img, $gradient_id, $user_id)
    {
        $stmt = $this->connect->prepare('INSERT INTO lists (list_name, list_image, list_gradient_id, created_on, created_by, last_modified_on, last_modified_by) VALUES (?, ?, ?, ?, ?, ?, ?)');
        
        if( $stmt ) {
            $created_on = date('Y-m-d H:i:s');
            $stmt->bind_param('ssisisi', $name, json_encode($img), $gradient_id, $created_on, $user_id, $created_on, $user_id);
            $stmt->execute();
            $stmt->close();
        }

        return ['message_code' => 307, 'list_id' => $this->connect->insert_id ];
    }

    public function updateList($list_id, $name, $img, $gradient_id, $user_id)
    {
        $stmt = $this->connect->prepare('UPDATE lists SET list_name = ?, list_image = ?, list_gradient_id = ?, last_modified_on = ?, last_modified_by = ? WHERE id = ?');
        
        if( $stmt ) {
            $created_on = date('Y-m-d H:i:s');
            $stmt->bind_param('ssisii', $name, json_encode($img), $gradient_id, $created_on, $user_id, $list_id);
            $stmt->execute();
            $stmt->close();
        }

        return ['message_code' => 311, 'list_id' => $list_id];
    }

    public function addProductToList($product_id, $list_id)
    {
        $stmt = $this->connect->prepare('INSERT INTO list_items (list_id, product_id) VALUES (?, ?)');
        
        if( $stmt ) {
            if(is_array($product_id)) {
                foreach ($product_id as $id) {
                    $stmt->bind_param('ii', $list_id, $id);
                    $stmt->execute();
                }
            } else {
                $stmt->bind_param('ii', $list_id, $product_id);
                $stmt->execute();
            }
            $stmt->close();
        }

        return [ 'message_code' => 309 ];
    }

    public function getTrends()
    {
        $stmt = $this->connect->prepare('SELECT lists.id, lists.list_name, lists.list_image, lists.list_gradient_id, gradients.first_color, gradients.second_color, product.id, product.name, product.url, product.price, product.currency, product.trend_rating, product.image FROM lists
                    LEFT JOIN list_items ON lists.id = list_items.list_id
                    LEFT JOIN product ON product.id = list_items.product_id
                    LEFT JOIN gradients ON gradients.id = lists.list_gradient_id');

        if( $stmt ) {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($list_id, $list_name, $list_image, $list_gradient_id, $list_gradient_first_color, $list_gradient_second_color, $product_id, $product_name, $product_url, $product_price, $product_currency, $product_trend_rating, $product_image);

            $data = [];
            $out_list_id = 0;
            while($stmt->fetch()) {
                if( $out_list_id != $list_id) {
                    $out_list_id = $list_id;
                    $data[$out_list_id]['list_id'] = $out_list_id;
                    $data[$out_list_id]['list_name'] = $list_name;
                    $data[$out_list_id]['list_image'] = $list_image;
                    $data[$out_list_id]['list_gradient_id'] = $list_gradient_id;
                    $data[$out_list_id]['list_gradient_first_color'] = $list_gradient_first_color;
                    $data[$out_list_id]['list_gradient_second_color'] = $list_gradient_second_color;
                    $data[$out_list_id]['products'] = [];
                }
                if (!is_null($product_id)) {
                    $data[$out_list_id]['products'][] = [
                        'product_id' => $product_id,
                        'product_name' => $product_name,
                        'product_name' => $product_name,
                        'product_url' => $product_url,
                        'product_url' => $product_url,
                        'product_price' => $product_price,
                        'product_price' => $product_price,
                        'product_currency' => $product_currency,
                        'product_trend_rating' => $product_trend_rating,
                        'product_image' => $product_image
                    ];
                }
            }
        }

        return ['message_code' => 303, 'data' => array_values($data) ];
    }

    public function getLists()
    {
        $count = $this->connect->prepare('SELECT count(*) FROM lists');
        $count->execute();
        $count->store_result();
        $count->bind_result($total);
        $count->fetch();
        $count->close();

        $stmt = $this->connect->prepare('SELECT lists.id, lists.list_name, lists.list_image, lists.list_gradient_id, count(list_items.id) AS total_items, gradients.first_color, gradients.second_color 
                    FROM lists LEFT JOIN list_items on lists.id = list_items.list_id LEFT JOIN gradients ON gradients.id = lists.list_gradient_id GROUP BY lists.id');

        if($stmt) {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $list_name, $list_image, $list_gradient_id, $total_items, $list_gradient_first_color, $list_gradient_second_color);

            $lists = [];
            while($stmt->fetch()) {
                $lists[$id]['list_id'] =  $id;
                $lists[$id]['list_name'] =  $list_name;
                $lists[$id]['list_image'] =  json_decode($list_image)->url;
                $lists[$id]['list_gradient_id'] =  $list_gradient_id;
                $lists[$id]['list_gradient_first_color'] =  $list_gradient_first_color;
                $lists[$id]['list_gradient_second_color'] =  $list_gradient_second_color;
                $lists[$id]['total_items'] = $total_items;
            }
            $stmt->close();
            
            return ['recordsTotal' => $total, 'recordsFiltered' => count($lists), 'data' => array_values($lists)];
        }
    }

    public function getList($bid)
    {
        $stmt = $this->connect->prepare('SELECT lists.id, lists.list_name, lists.list_image, lists.list_gradient_id, gradients.first_color, gradients.second_color, product.id, product.name, product.url, product.price, product.currency, product.trend_rating, product.image FROM lists
                    LEFT JOIN list_items ON lists.id = list_items.list_id
                    LEFT JOIN product ON product.id = list_items.product_id
                    LEFT JOIN gradients ON gradients.id = lists.list_gradient_id
                    WHERE lists.id = ?');

        if( $stmt ) {
            $stmt->bind_param('i', $bid);
            $stmt->execute();
            $stmt->store_result();

            $stmt->bind_result($list_id, $list_name, $list_image, $list_gradient_id, $list_gradient_first_color, $list_gradient_second_color, $product_id, $product_name, $product_url, $product_price, $product_currency, $product_trend_rating, $product_image);
            $data = [];
            $out_list_id = 0;
            while($stmt->fetch()) {
                $total++;
                if( $out_list_id != $list_id) {
                    $out_list_id = $list_id;
                    $data['list_id'] = $list_id;
                    $data['list_name'] = $list_name;
                    $data['list_image'] = $list_image;
                    $data['list_gradient_id'] = $list_gradient_id;
                    $data['list_gradient_first_color'] = $list_gradient_first_color;
                    $data['list_gradient_second_color'] = $list_gradient_second_color;
                    $data['products'] = [];
                }
                if(null !== $product_id ) {
                    $data['products'][] = [
                        'product_id' => $product_id,
                        'product_name' => $product_name,
                        'product_name' => $product_name,
                        'product_url' => $product_url,
                        'product_url' => $product_url,
                        'product_price' => $product_price,
                        'product_price' => $product_price,
                        'product_currency' => $product_currency,
                        'product_trend_rating' => $product_trend_rating,
                        'product_image' => $product_image
                    ];
                }
            }
        }

        return ['message_code' => 303, 'data' => $data ];
    }

    public function deleteList($list_id)
    {
        $stmt = $this->connect->prepare('DELETE FROM lists WHERE id = ?');
        if( $stmt ) {
            $stmt->bind_param('i', $list_id);
            $stmt->execute();
            $stmt->close();
            return true;
        }
        return false;
    }

    public function getGradients()
    {
        $stmt = $this->connect->prepare('SELECT id, first_color, second_color FROM gradients WHERE enabled = 1');
        if( $stmt ) {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $first_color, $second_color);

            $gradients = [];
            while($stmt->fetch()) {
                $gradients[] = [
                    'id' => $id,
                    'first_color' => $first_color,
                    'second_color' => $second_color
                ];
            }

            return ['message_code' => 321, 'data' => $gradients ];
        }

        return false;
    }

    public function addFriend($user_id, $friend_id)
    {
        // var_dump($user_id);
        // var_dump($friend_id);exit;
         if($user_id == $friend_id);
            {
                // echo "Hello";exit;
               return ['message' => 'Invalid Friend!' ]; 
            }
         //    else
         //    {
         //        echo "Hie";exit;
         $query = $this->connect->prepare('SELECT user_id, friend_id  FROM user_friends WHERE friend_id = ? AND user_id = ?');
         $query->bind_param('ii', $friend_id, $user_id);
            $query->execute();
            $query->store_result();

            if($query->fetch()) {

                return ['message' => 'Friend Already Added!' ];
            }
            else
            {

        $stmt = $this->connect->prepare('INSERT INTO user_friends (user_id, friend_id) VALUES (?, ?)');
        if( $stmt ) {
           
            $stmt->bind_param('ii', $user_id, $friend_id);
            $stmt->execute();
            $stmt->close();

            return ['message' => 'success' ];

        }
        else
        {
            return ['message' => 'failed' ];
        }

        }
        
    }

    public function deleteFriend($friend_id, $user_id)
    {
        $stmt = $this->connect->prepare('DELETE FROM user_friends WHERE friend_id = ? AND user_id = ?');
        if ($stmt) {
            $stmt->bind_param('ii', $friend_id, $user_id);
            $stmt->execute();
            $stmt->close();
            return ['message' => 'success' ];
        }
        return ['message' => 'failed' ];

    }

    public function listFriends($user_id)
    {
        $stmt = $this->connect->prepare('SELECT users.id, users.first_name, users.last_name, users.profile_picture FROM user_friends JOIN users ON user_friends.friend_id = users.id WHERE user_id = ?');
        if($stmt) {
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $first_name, $last_name, $profile_picture);

            $friends = [];

            while($stmt->fetch()) {
                $tmp = [];
                $tmp['id'] = $id;
                $tmp['first_name'] = $first_name;
                $tmp['last_name'] = $last_name;
                $tmp['profile_picture'] = $profile_picture;
                $friends[] = $tmp;
                $tmp = null;
            }

            return ['friends' => $friends];
        }
    }

     public function addSocialFriend($friend_id, $user_id)
    {
        $stmt = $this->connect->prepare('INSERT INTO user_socialfriends (user_id, first_name, last_name, mobile, email, profile_picture, address) VALUES (?, ?, ?, ?, ?, ?, ?)');
        if( $stmt ) {
           
            $stmt->bind_param('iiiiiii', $user_id, $first_name, $last_name, $mobile, $email, $profile_picture, $address);
            $stmt->execute();
            $stmt->close();
            return ['message' => 'success' ];

        }
        return ['message' => 'failed' ];
    }

     public function listSocialFriends($user_id)
    {
        $stmt = $this->connect->prepare('SELECT socialfriend_id, first_name, last_name, profile_picture, mobile, email, address FROM user_socialfriends WHERE user_id = ?');
        if($stmt) {
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($socialfriend_id, $first_name, $last_name, $profile_picture, $mobile, $email, $address);

            $socialfriends = [];

            while($stmt->fetch()) {
                $tmp = [];
                $tmp['socialfriend_id'] = $socialfriend_id;
                $tmp['first_name'] = $first_name;
                $tmp['last_name'] = $last_name;
                $tmp['profile_picture'] = $profile_picture;
                $tmp['mobile'] = $mobile;
                $tmp['email'] = $email;
                $tmp['address'] = $address;
                $socialfriends[] = $tmp;
                $tmp = null;
            }

            return ['socialfriends' => $socialfriends];
        }
    }

      public function searchSocialFriend($email)
    {
        $stmt = $this->connect->prepare('SELECT id, first_name, last_name, profile_picture, phone, email, date_of_birth FROM users WHERE email = ?');

        // if($stmt) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $first_name, $last_name, $profile_picture, $phone, $email, $dob);
// var_dump($stmt);exit;
if( $stmt->num_rows > 0 ) {

            $friend = [];

            while($stmt->fetch()) {
                // echo "Hie";exit;
                $tmp = [];
                $tmp['id'] = $id;
                $tmp['first_name'] = $first_name;
                $tmp['last_name'] = $last_name;
                $tmp['profile_picture'] = $profile_picture;
                $tmp['phone'] = $phone;
                $tmp['email'] = $email;
                $tmp['dob'] = $dob;
                $friend[] = $tmp;
                $tmp = null;
            }

            return ['friend' => $friend];
        }
        else
        {
             // $to = $email;
        
        // $subject = "Invitation from GiftJeenie!";

        // $header = "From: Gift Jeenie Admin <support@giftjeenie.com> \r\n";
        // //$header .= "Cc:afgh@somedomain.com \r\n";
        // //ajitem@joshiinc.com
        // $header .= "MIME-Version: 1.0\r\n";
        // $header .= "Content-type: text/html\r\n";


        // ini_set('smtp_user','mallika@giftjeenie.com');
        // ini_set('smtp_pass','Makhijani070991');
        // $result = mail( $to, $subject, $message, $header );

            // echo "Hello";exit;
        $mail = new PHPMailer();
        $mail->IsSMTP(); 
        $mail->isHTML(true); 
        $mail->CharSet = 'UTF-8';
        $mail->Host       = "mallika@giftjeenie.com"; // SMTP server example
        $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->Port       = 25;                    // set the SMTP port for the GMAIL server
        $mail->Username   = "mallika@giftjeenie.com"; // SMTP account username example
        $mail->Password   = "Makhijani070991";  
        $mailer->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
    );                               // Set email format to HTML

        $subject = "Invitation from GiftJeenie!";
     // $mail->addReplyTo($email);
       
        $message = "Dear " . $email . ",<br />\r\n<br />\r\n";
        $message .= "The Sender has invited you to use Gift Jeenie, Please Use the link below to install an app and get started.<br/>\r\n<br />\r\n Thanks and Regards <br />\r\n Gift Jeenie Admin";

        $from="support@giftjeenie.com";
        $mail->From=$from;
        // $mail->FromName="Example.com";
        $mail->Sender=$from; // indicates ReturnPath header
        $mail->AddReplyTo($from); // indicates ReplyTo headers
        $mail->AddCC('cc@site.com.com', 'CC: to site.com');
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AddAddress($email);
        // var_dump($from);
        // var_dump($message);
        // var_dump($email);
        // var_dump($subject);exit;
        // var_dump($mail);exit;
        if(!$mail->Send())
        {
            return ['message' => 'Failed' ]; 
             
        }
        else
        {
          return ['message' => 'Email sent to download App' ]; 
        }
         
// $mail->send($to, $subject, $message, $header);

       
// // var_dump($result);exit;
//            return ['message' => 'Email sent to download App' ]; 
        }
    }


     public function getFaqs()
    {
        $stmt = $this->connect->prepare('SELECT faq_id, question, answer FROM faq');
        if( $stmt ) {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($faq_id, $question, $answer);

            $faqs = array();
            while($stmt->fetch()) {
                $faqs[] = [
                    'faq_id' => $faq_id,
                    'question' => $question,
                    'answer' => $answer
                ];
                
            }

            return ['data' => $faqs ];
        }

        return "false";
    }


    public function listProductWishlist($user_id, $searchname)
    {
        $stmt = $this->connect->prepare('SELECT id, name, url, price, currency, trend_rating, image, category_id FROM product where UCASE(name) LIKE ?');
        if($stmt) {

            $name = '%'. strtoupper($searchname).'%';
            $name=preg_replace('/\s+/', '', $name);
            
            $stmt->bind_param('s', $name);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $productname, $url, $price, $currency, $trend_rating, $image, $category_id);

             $productsearch = [];

            while($stmt->fetch()) {
                $tmp = [];
                $tmp['id'] = $id;
                $tmp['productname'] = $productname;
                $tmp['url'] = $url;
                $tmp['price'] = $price;
                $tmp['currency'] = $currency;
                $tmp['trend_rating'] = $trend_rating;
                $tmp['image'] = $image;
                $tmp['category_id'] = $category_id;
                $productsearch[] = $tmp;
                $tmp = null;
}
}

$stmt = $this->connect->prepare('SELECT name FROM wishlist where user_id = ?');
        if($stmt) {
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($wname);

             $wishlistsearch = [];

            while($stmt->fetch()) {
                $tmp = [];
                $tmp['wishlistname'] = $wname;
                $wishlistsearch[] = $tmp;
                $tmp = null;
}
}
$search['product'] = $productsearch;
$search['wishlist'] = $wishlistsearch;
return [$search];
    }


     public function insertrecent($user_id, $lastvisited)
    {
        $query = $this->connect->prepare('SELECT user_id, last_visited_id From recent_wishlist where user_id = ?');

        $query->bind_param('i', $user_id);
            $query->execute();
            $query->store_result();

            if($query->fetch()) {
            $stmt = $this->connect->prepare('UPDATE recent_wishlist SET last_visited_id =    ? WHERE user_id = ?');
            $stmt->bind_param('ii', $lastvisited, $user_id);

            if( $stmt->execute() )
        {
            return ['message' => 'Updated Successfully' ];
        }
        else
        {
             return ['message' => 'failed' ];
        }
            
        }
        else {
    
          $stmt = $this->connect->prepare('INSERT INTO recent_wishlist (user_id, last_visited_id) VALUES (?, ?)');
          $stmt->bind_param('ii', $user_id, $lastvisited);

             if( $stmt->execute() )
        {
             return ['message' => 'Inserted Successfully' ];
        }
        else
        {
             return ['message' => 'failed' ];
        }
           
        }
        
    }

     public function getRecentWishlists()
    {
        $stmt = $this->connect->prepare('SELECT id, first_name, last_name, profile_picture, phone, email, date_of_birth FROM users WHERE wishlist_id = ?');
        if($stmt) {
            $stmt->bind_param('i', $wishlist_id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $first_name, $last_name, $profile_picture, $phone, $email, $dob);

            $friend = [];

            while($stmt->fetch()) {
                $tmp = [];
                $tmp['id'] = $id;
                $tmp['first_name'] = $first_name;
                $tmp['last_name'] = $last_name;
                $tmp['profile_picture'] = $profile_picture;
                $tmp['phone'] = $phone;
                $tmp['email'] = $email;
                $tmp['dob'] = $dob;
                $friend[] = $tmp;
                $tmp = null;
            }

            return ['data' => $faqs ];
        }

        return "false";
    }

     public function listrecent($user_id)
    {
        $stmt = $this->connect->prepare('SELECT recent_wishlist.last_visited_id, wishlist.name FROM recent_wishlist JOIN wishlist ON recent_wishlist.last_visited_id = wishlist.id WHERE recent_wishlist.user_id = ?');
        if($stmt) {
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $name);

            $result = [];

            while($stmt->fetch()) {
                $tmp = [];
                $tmp['last_visited_id'] = $id;
                $tmp['name'] = $name;
                $result[] = $tmp;
                $tmp = null;
            }

            return ['recentlist' => $result];
        }
        else
        {
           return ['message' => 'failed' ]; 
        }
    }


     public function detailsrecent($id)
    {
        $stmt = $this->connect->prepare('SELECT wishlist.name, wishlist_details.grant_status, wishlist_details.claim_status, wishlist_details.product_id, product.name, product.url, product.price, product.currency, product.trend_rating, product.category_id, product.image FROM wishlist JOIN wishlist_details ON wishlist.id = wishlist_details.wishlist_id JOIN product ON wishlist_details.product_id = product.id WHERE wishlist.id = ?');
        if($stmt) {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($name, $grant_status, $claim_status, $product_id,  $product_name, $url, $price, $currency, $trend_rating, $category_id, $image);

            $details = [];

            while($stmt->fetch()) {
                $tmp = [];
                $tmp['wishlistname'] = $name;
                $tmp['grant_status'] = $grant_status;
                $tmp['claim_status'] = $claim_status;
                $tmp['product_id'] = $product_id;
                $tmp['productname'] = $product_name;
                $tmp['url'] = $url;
                $tmp['price'] = $price;
                $tmp['currency'] = $currency;
                $tmp['trend_rating'] = $trend_rating;
                $tmp['category_id'] = $category_id;
                $tmp['image'] = $image;
                $details[] = $tmp;
                $tmp = null;
            }

            return ['details' => $details];
        }
        else
        {
           return ['message' => 'failed' ]; 
        }
    }


     public function getGiftsCategoriesList( $user_id )
    {
        // if( $this->error_message != '' )
        // {
        //     return $error_message;
        // }

        $stmt = $this->connect->prepare("SELECT product_category.name, product_category.id, product_category.created_by, product_category.created_on FROM user_categories JOIN product_category ON user_categories.category_id = product_category.id WHERE user_categories.user_id = ?");
        $stmt->bind_param( 'i', $user_id );
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result( $categoryname, $category_id, $created_by, $created_on );

        $giftscategories = array();

        if( $stmt->num_rows > 0 )
        {
            // echo "Hie";exit;
            while( $stmt->fetch() )
            {
                $gift = array(
                    'categoryName' => $categoryname,
                    'categoryId' => $category_id,
                    // 'gift_info' => $this->getGiftInfo( $gift_id ),
                    // 'wishlist_id' => $wishlist_id,
                    'meta' => array(
                        'created_by' => $created_by,
                        'created_on' => $created_on
                    )
                );

                array_push( $giftscategories, $gift );

                $gift = NULL;
            }
            return $giftscategories;
        }
        else
        {
            return array( "message_code" => 121 );
        }
    }


     public function addgroup($user_id, $wishlist_name, $group)
    {

        $stmt = $this->connect->prepare('SELECT id FROM wishlist where name = ?');
        if($stmt) {
            $stmt->bind_param('s', $wishlist_name);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id);
            // $stmt->fetch()
             while($stmt->fetch()) {
                // $tmp = [];
                $tmp = $id;
                $wishlist_id = $tmp;
                $tmp = null;
}
}
// var_dump($wishlist_id);exit;
// SELECT DISTINCT group_wishlist.wishlist_id, wishlist.name FROM `group_wishlist` JOIN wishlist ON group_wishlist.wishlist_id = wishlist.id
    
          $stmt = $this->connect->prepare('INSERT INTO group_wishlist (user_id, wishlist_id, friend_id) VALUES (?, ?, ?)');

           if($stmt) {
            foreach($group as $friend_id) {
                $stmt->bind_param('iii', $user_id, $wishlist_id, $friend_id);
                $stmt->execute();
                // var_dump($friend_id);exit;
                
                $meta = array(
                   'created_on'      => date('Y-m-d H:i:s'),
                   'created_by'      => $user_id,
                   'last_modified_on'=> date('Y-m-d H:i:s'),
                   'last_modified_by'=> $user_id
                );
                // var_dump($meta);exit;
                 $res = $this->notify( $friend_id, 'You have added in wishlist', $wishlist_id, '20', $meta );
                 // var_dump($res);exit;
            }
            $stmt->close();
            if ($this->connect->insert_id) 
            {
            // echo "Hello";exit();
             $stmt = $this->connect->prepare('UPDATE wishlist SET status = ? WHERE id = ?');
             $status = "Group";
             $stmt->bind_param('si', $status, $wishlist_id);
             $stmt->execute();   
            }    
             

             return array('message' => 'Inserted Successfully', 'res' => $res );
             // return ['message' => 'Inserted Successfully' ];
             // , 'id' => $this->connect->insert_id
        }
        else
        {
             return ['message' => 'failed' ];
        }
           
     }


}
