<?php 
// 3- create object 
// 4- check validation


class Validator{
    private $errors = [];


    
    function required($inputName,$input){
        if(empty($input)){
            $error = [$inputName => "the field is required"];
            array_push($this->errors,$error);
        }
    }
    function max($inputName,$input,$max_val){
        if(strlen($input) > $max_val){
            $error = [$inputName => "the field must be less than $max_val"];
            array_push($this->errors,$error);
        }
    }
    function min($inputName,$input,$min_val){
        if(strlen($input) < $min_val){
            $error = [$inputName => "the field must be more than $min_val"];
            array_push($this->errors,$error);
        }
    }
    function emailRule1($inputName,$input){
        if(!filter_var($input,FILTER_VALIDATE_EMAIL)){
            $error = [$inputName => "invalid email"];
            array_push($this->errors,$error);
        }
    }
    function emailRule2($inputName,$input){
        $regex = "/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[\w-]{2,4}$/";
        if(!preg_match($regex,$input)){
            $error = [$inputName => "invalid email by regex"];
            array_push($this->errors,$error);
        }
    }
    function numeric($inputName,$input){
        if(!is_numeric($input)){
            $error = [$inputName => "you must enter numbers only"];
            array_push($this->errors,$error);
        }
    }
    // https://www.example.com
    function url($inputName,$input){
        if(!filter_var($input,FILTER_VALIDATE_URL)){
            $error = [$inputName => "invalid URL"];
            array_push($this->errors,$error);
        }
    }
    function alpha($inputName,$input){
        $regex = "/^[a-zA-Z]+$/";
        if(!preg_match($regex,$input)){
            $error = [$inputName => "you must enter only letters."];
            array_push($this->errors,$error);
        }
    }
    function matchInput($inputName,$input,$matchInput){
        if($input !== $matchInput){
            $error = [$inputName => "you must match the the field"];
            array_push($this->errors,$error);
        }
    }
    function matchPattern($inputName,$input,$regex){
        if(!preg_match($regex,$input)){
            $error = [$inputName => "the input must match the pattern."];
            array_push($this->errors,$error);
        }
    }
    function getErrors(){
        return $this->errors;
    }
    
}



$name = "hamada ";
$email = "diaa@gmail.com";
$phone = "010638644";
$password = "Password@1212";
// $confirm_password = "Password@123";
$url = "https://www.example.com";


$validator = new Validator();


$validator->required("name",$name);
$validator->max("name",$name,15);
$validator->min("name",$name,3);
$validator->alpha("name",$name);

$validator->required("email",$email);
$validator->emailRule1("email",$email);
$validator->emailRule2("email",$email);

$validator->numeric("phone",$phone);

$validator->url("url",$url);

// $validator->matchInput("password_confirmation",$confirm_password,$password);

$regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])(?=.*[^\w\s])[^ ]{8,}$/";
$validator->matchPattern("password",$password,$regex);


if(count($validator->getErrors()) == 0){
    echo "there are no errors 😏😉";
}else{
    var_dump($validator->getErrors());
}

?>
