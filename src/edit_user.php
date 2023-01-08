<?php
require "functions_sign_in.php";

// on get/set les différents attributs de User > username, email, password, admin

// FIXER USERID Pendant les test en attendant les boutons
$userid=$_GET['myid'];



// on fixe certaines variables 
$user1=displayUser($userid);
$name1=$user1['username'];
$email1=$user1['email'];
$password1=$user1['password'];
$admin1=$user1['admin'];

// Var de Post 
if (isset($_POST['name'])){
    $namepost=$_POST['name'];
}
if (isset($_POST['email'])){
    $emailpost=$_POST['email'];
}
if (isset($_POST['password'])){
    $pwpost=$_POST['password'];
}
if(isset($_POST['admin'])){
    $adminpost=$_POST['admin'];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src        = "https://cdn.tailwindcss.com"></script> 
    <title>Edit our user now !</title>
</head>

<header class="bg-white">
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex-1 md:flex md:items-center md:gap-12">
          <p class="block text-teal-600">
            <span class="sr-only">Home</span>
            <img class="h-20" src="img\logo.jpg" alt="Logo">
            
          </p>
        </div>
  
        <div class="md:flex md:items-center md:gap-12">

          
          <div class="flex items-center gap-4">
            <div class="sm:flex sm:gap-4">
              <a
                class="rounded-md bg-teal-600 px-5 py-2.5 text-sm font-medium text-white shadow"
                href="signin.php"
              >
                Connexion
              </a>

              <a
                class="rounded-md bg-red-700 px-5 py-2.5 text-sm font-medium text-white shadow"
                href="logout.php"
              >
                Déconnexion
              </a>
  
              <div class="hidden sm:flex">
                <a
                  class="rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-teal-600"
                  href="signup.php"
                >
                  Inscription
                </a>  
              </div>
            </div>
  
            <div class="block md:hidden">
              <button
                class="rounded bg-gray-100 p-2 text-gray-600 transition hover:text-gray-600/75"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="2"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4 6h16M4 12h16M4 18h16"
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  
<body>
    
<form action = "" method = "POST">

        </br>
        </br>
        
        USERNAME: <input class="border-4 border-black" type = "text" name = "name" 
        placeholder="<?php if (isset($_POST['name'])){echo($_POST['name']);} else{echo$name1;}?>" /></br>
        <?php if (isset($_POST['name'])){ editName($namepost,$userid);} ?>
        </br>
        </br>
        
        EMAIL: <input class="border-4 border-black " type = "text" name = "email" 
        placeholder="<?php if (isset($_POST['email'])){echo($_POST['email']);}else{ echo $email1;}?>" /></br>
        <?php if (isset($_POST['email'])){ editEmail($emailpost,$userid);} ?>
        </br>
        </br>
        
        Password: <input class="border-4 border-black " type = "text" name = "password" 
        placeholder="<?php if (isset($_POST['password'])){echo$_POST['password'];}else{ echo $password1;}?>" /></br>
        <?php if (isset($_POST['password'])){ editPassword($pwpost,$userid);} ?>
        </br>
        </br>
        <?php
        if (isset($_POST['admin'])&&!empty(($_POST['admin']))){showAdmin($adminpost);}  ?>
        
        Admin: <label for="admin">SET TO ADMIN:</br></label>
            <select name="admin" id="admin">
                <option value=""></option>
                <option value="1">YES</option>
                <option value="0">NO</option>
            </select>
        <?php
        if (isset($_POST['admin'])){ 
            if($_POST['admin']==1){
                setAdmin(1,$userid);}
            elseif($_POST['admin']==0){
                setAdmin(0,$userid);}
            }
             ?>
    </br>

        <input class="border-4 border-yellow-400 text-lg" type = "submit" value="Make the changes !" />
  
</form> 


</body>
</html>

<?php 

?>