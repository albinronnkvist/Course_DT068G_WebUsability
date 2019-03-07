<?php

    //Klass för att lagra användare och logga in
    class Users {

        private $db;
        private $username;
        private $user_type;
        private $password;
        private $firstname;
        private $lastname;
        private $email;
        private $phonenumber;
        private $trappklattrare;
        private $specialfordon;
        private $arbetsresa;
        private $ledsagare;
        private $contactvia;
        private $skrymmande;

        function __construct(){
            $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
            if($this->db->connect_errno > 0){
                die('Fel vid anslutning [' . $this->db->connect_error . ']');
            }
        }

        //Lagra ny användare
        function storeUser($username, $user_type, $password, $firstname, $lastname, $email, $phonenumber, $trappklattrare, $specialfordon, $arbetsresa, $ledsagare, $contactvia, $skrymmande){
            $username = $this->db->real_escape_string($username);
            $user_type = $this->db->real_escape_string($user_type);
            $password = $this->db->real_escape_string($password);
            $firstname = $this->db->real_escape_string($firstname);
            $lastname = $this->db->real_escape_string($lastname);
            $email = $this->db->real_escape_string($email);
            $phonenumber = $this->db->real_escape_string($phonenumber);
            $trappklattrare = $this->db->real_escape_string($trappklattrare);
            $specialfordon = $this->db->real_escape_string($specialfordon);
            $arbetsresa = $this->db->real_escape_string($arbetsresa);
            $ledsagare = $this->db->real_escape_string($ledsagare);
            $contactvia = $this->db->real_escape_string($contactvia);
            $skrymmande = $this->db->real_escape_string($skrymmande);

            //Hasha $password - CRYPT_BLOWFISH 
            $salt = "$2y$10$".bin2hex(openssl_random_pseudo_bytes(22));
            $password = crypt($password, $salt);

            $sql = "INSERT INTO osthammar_user(username, user_type, password, firstname, lastname, email, phonenumber, trappklattrare, specialfordon, arbetsresa, ledsagare, contactvia, skrymmande)VALUES('$username', '$user_type', '$password', '$firstname', '$lastname', '$email', '$phonenumber', '$trappklattrare', '$specialfordon', '$arbetsresa', '$ledsagare', '$contactvia', '$skrymmande')";
            $result = $this->db->query($sql);

            return $result;
        }

        //Logga in
        function loginUser($username, $password){
            $username = $this->db->real_escape_string($username);
            $password = $this->db->real_escape_string($password);

            $sql = "SELECT * FROM osthammar_user WHERE username='$username' LIMIT 1";
            $result = $this->db->query($sql);

            //Koll om användarnamnet och lösenordet finns i databasen
            //är det fler rader än 0 så finns användaren i databasen), annars inte
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $storedPass = $row['password'];
                $storedUsertype = $row['user_type'];
                $storedTrappklattrare = $row['trappklattrare'];
                $storedSpecialfordon = $row['specialfordon'];
                $storedArbetsresa = $row['arbetsresa'];
                $storedLedsagare = $row['ledsagare'];

                $storedFirstname = $row['firstname'];
                $storedLastname = $row['lastname'];
                $storedEmail = $row['email'];
                $storedPhonenumber = $row['phonenumber'];
                $storedContactvia = $row['contactvia'];
                $storedSkrymmande = $row['skrymmande'];
                $storedDate = $row['date'];

                if($storedPass == crypt($password, $storedPass)){
                    $_SESSION['myUsername'] = $username;
                    $_SESSION['user_type'] = $storedUsertype;
                    $_SESSION['trappklattrare'] = $storedTrappklattrare;
                    $_SESSION['specialfordon'] = $storedSpecialfordon;
                    $_SESSION['arbetsresa'] = $storedArbetsresa;
                    $_SESSION['ledsagare'] = $storedLedsagare;

                    $_SESSION['firstname'] = $storedFirstname;
                    $_SESSION['lastname'] = $storedLastname;
                    $_SESSION['email'] = $storedEmail;
                    $_SESSION['phonenumber'] = $storedPhonenumber;
                    $_SESSION['contactvia'] = $storedContactvia;
                    $_SESSION['skrymmande'] = $storedSkrymmande;
                    $_SESSION['date'] = $storedSkrymmande;
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }

        //Logga ut
        function logOutUser($username){
            unset($_SESSION['myUsername']);  
            unset($_SESSION['user_type']);  
            unset($_SESSION['trappklattrare']);
            unset($_SESSION['specialfordon']);
            unset($_SESSION['arbetsresa']);
            unset($_SESSION['ledsagare']);   
            unset($_SESSION['firstname']);
            unset($_SESSION['lastname']);
            unset($_SESSION['email']);
            unset($_SESSION['phonenumber']);
            unset($_SESSION['contactvia']);
            unset($_SESSION['skrymmande']);  
            unset($_SESSION['date']);
        }

        //Om användarnamn redan är upptaget
        function takenUsername($username){
            $username = $this->db->real_escape_string($username);

            $sql = "SELECT username FROM osthammar_user WHERE username='$username'";

            $result = $this->db->query($sql);

            //Koll om användarnamnet finns i databasen
            //mysqli_num_rows() returnerar antal rader från $result
            //är det fler rader än 0 så är användarnamnet upptaget(finns redan i databasen), annars inte
            if($result->num_rows > 0){
                return true;
            }
            else{
                return false;
            }


        }

        //Läs in alla Kunder
        function getCustomers(){
            $sql = "SELECT * FROM osthammar_user WHERE user_type='customer' ORDER BY username ASC";
            $result = $this->db->query($sql);
            
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
            
        }

        //Läs in alla användare
        function getUsers(){
            $sql = "SELECT * FROM osthammar_user ORDER BY username ASC";
            $result = $this->db->query($sql);
            
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
            
        }

        //Hämta specifikt inlägg med id
        function getSpecificUser($id){
            $id = intval($id);

            $sql = "SELECT * FROM osthammar_user WHERE username=$id";
            $result = $this->db->query($sql);
            $row = mysqli_fetch_array($result);

            return $row;
        }

        //Hämta en användares fulla namn
        function getFullname($id){
            $sql = "SELECT firstname, lastname FROM osthammar_user WHERE username='$id'";
            $result = $this->db->query($sql);
            $row = mysqli_fetch_array($result);

            return $row;
            
        }


        //Uppdatera en användare
        function updateUser($username, $user_type, $password, $firstname, $lastname, $email, $phonenumber, $trappklattrare, $specialfordon, $arbetsresa, $ledsagare, $contactvia, $skrymmande, $id){

            //Försäkra om att det är en siffra som matas in
            $id = intval($id);

            $username = $this->db->real_escape_string($username);
            $user_type = $this->db->real_escape_string($user_type);
            $password = $this->db->real_escape_string($password);
            $firstname = $this->db->real_escape_string($firstname);
            $lastname = $this->db->real_escape_string($lastname);
            $email = $this->db->real_escape_string($email);
            $phonenumber = $this->db->real_escape_string($phonenumber);
            $trappklattrare = $this->db->real_escape_string($trappklattrare);
            $specialfordon = $this->db->real_escape_string($specialfordon);
            $arbetsresa = $this->db->real_escape_string($arbetsresa);
            $ledsagare = $this->db->real_escape_string($ledsagare);
            $contactvia = $this->db->real_escape_string($contactvia);
            $skrymmande = $this->db->real_escape_string($skrymmande);

            //Hasha $password - CRYPT_BLOWFISH 
            $salt = "$2y$10$".bin2hex(openssl_random_pseudo_bytes(22));
            $password = crypt($this->password, $salt);
            
            $sql = "UPDATE osthammar_user SET username='$username', user_type='$user_type', password='$password', firstname='$firstname', lastname='$lastname', email='$email', phonenumber='$phonenumber', trappklattrare='$trappklattrare', specialfordon='$specialfordon', arbetsresa='$arbetsresa', ledsagare='$ledsagare', contactvia='$contactvia', skrymmande='$skrymmande', date=now() WHERE username=$id";
            return $this->db->query($sql);
        }

    }

?>