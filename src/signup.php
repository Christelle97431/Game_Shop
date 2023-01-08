<?php

//---------------------------------//
//-------- FICHIER ERREURS --------//
//---------------------------------//

define ('ERROR_LOG_FILE', 'errors.log');   

//----------------------------------//
//------ CONNECTION FUNCTIONS ------//
//----------------------------------//

include_once ("functions_sign_up.php");
require ("connect_db.php");
include_once ("functions_sign_in.php");
/* a récupérer : 
- function connect_db (l127)
- function removeslashes (l105)
- function securisation (l113))*/

//-----------------------------------//
//-------- AJOUTER UN USER ----------//
//------ DANS LA TABLE USERS --------//
//-------------DE LA BDD-------------//
//-----------------------------------//

function add_users($username,$password,$email)  
{   
    $bdd  = connect_to_db();
    $create_id = date("Y-m-d");
    $password_hash = password_hash($password,PASSWORD_BCRYPT);
    $admin = 0;

    // Vérifier si l'utilisateur est dans la BDD
        $query = "SELECT * FROM users WHERE username=?";
        $verif_user = $bdd -> prepare ($query);
        $verif_user -> bindValue(1,$username,PDO::PARAM_STR);
        $verif_user -> execute ();
        $user = $verif_user -> fetch();
        $verif_user -> closeCursor();
        if ($user)
        {
          $err = "Le nom d'utilisateur existe déjà";
          ?>
          <div class= "inline-block px-7 py-3 bg-red-400 text-white text-center font-medium uppercase rounded w-full">
          <?php echo $err;?>
          </div>
          <?php
            file_put_contents(ERROR_LOG_FILE, $err, FILE_APPEND);
        }
        else
        {
            // Ajouter l'utilisateur dans la table users
            $modif    = "INSERT INTO users (username, password, email, admin, created_at)
            VALUES (:username,:password,:email,:admin,:create_id)";
            $new_user = $bdd -> prepare ($modif);
            $new_user -> bindParam(':username',$username, PDO::PARAM_STR);
            $new_user -> bindParam(':password',$password_hash, PDO::PARAM_STR);
            $new_user -> bindParam(':email',$email);
            $new_user -> bindParam(':admin',$admin);
            $new_user -> bindParam(':create_id',$create_id);
            
            $new_user -> execute();
            $new_user -> closeCursor();

            echo "Bienvenue $username !\n";
            // Redirection vers la page de connexion
            header("Location: ./signin.php");
        }
}


//--------------------------------------//
//---------- VERIFICATION -------------//
//---- DES ERREURS AVANT INSERTION-----//
//-------------DANS LA BDD-------------//
//-------------------------------------//

if(!empty($_POST))
{
    $err="";
    $identifiant = "";
    $mdp = "";
    $mail = "";
    $confirm_mdp = "";

    $identifiant = $_POST['identifiant'];
    $mdp = $_POST['mdp'];
    $mail = $_POST['mail'];
    $confirm_mdp = $_POST['confirm_mdp'];

    securisation($identifiant);

    if(!isset($identifiant) || empty($identifiant))
    {
        $err.= "username : undeclared or empty value\n"."</br>";
        file_put_contents(ERROR_LOG_FILE, $err, FILE_APPEND);
    }

    if(!isset($mail) || empty($mail))
    {
        $err.= "mail : undeclared or empty value\n"."</br>";
        file_put_contents(ERROR_LOG_FILE, $err, FILE_APPEND);
    }
    elseif (filter_var($mail,FILTER_VALIDATE_EMAIL)===false)
    {
        $err.= "Invalid email !\n"; 
        file_put_contents(ERROR_LOG_FILE, $err, FILE_APPEND);
    }

    if(!isset($mdp)|| !isset($confirm_mdp) || empty($mdp) || empty($confirm_mdp))
    {
        $err.= "password or confirm password : undeclared or empty value\n"."</br>";
        file_put_contents(ERROR_LOG_FILE, $err, FILE_APPEND);
    }
    elseif($mdp != $confirm_mdp)
    {
        $err.= "Passwords don't match.\n"."</br>";
        file_put_contents(ERROR_LOG_FILE, $err, FILE_APPEND);
    }
    elseif(!preg_match("/^(?=\S*[\W])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/",$mdp))
    {
        $err.= "Password must contain between 8 and 20 characters including 1 MAJ, 1 min, 1 number and 1 special character\n"."</br>";
        file_put_contents(ERROR_LOG_FILE, $err, FILE_APPEND);
    }

    if ($err=="")
    {
        add_users($identifiant,$mdp,$mail);
    }
    else{
        ?>
          <div class= "inline-block px-7 py-3 bg-red-400 text-white text-center font-medium uppercase rounded w-full">
          <?php echo $err;?>
          </div>
        <?php
    }
}         
?>



<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My Shop</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src        = "https://cdn.tailwindcss.com"></script> 
    <link rel="stylesheet" href="">
    <link href="/dist/output.css" rel="stylesheet">
  </head>

  <body>

  <section class="bg-white">
  <div class="lg:grid lg:min-h-screen lg:grid-cols-12">
    <section
      class="relative flex h-32 items-end bg-gray-900 lg:col-span-5 lg:h-full xl:col-span-6"
    >
      <img
        alt="image Game"
        src="img\img_game.jpg"
        class="absolute inset-0 h-full w-full object-cover opacity-80"
      />

      <div class="hidden lg:relative lg:block lg:p-12">
        <p class="block text-white w-20 h-8 sm:h-10">
        <img
        alt="Logo"
        src="img\logo.jpg"
        class="max-w-full h-auto rounded-full"
        />
          <span class="sr-only">Home</span>
        </p>

        <h2 class="mt-12 text-2xl font-bold text-white sm:text-3xl md:text-4xl">
          Welcome to My_Shop
        </h2>

        <p class="mt-4 leading-relaxed text-white/90">
          Un site pour le plaisir de découvrir ou redécouvrir des jeux à faire en famille ou entre amis
        </p>
      </div>
    </section>

    <main
      aria-label="Main"
      class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:py-12 lg:px-16 xl:col-span-6"
    >
      <div class="max-w-xl lg:max-w-3xl">
        <div class="relative -mt-16 block lg:hidden">
          <p
            class="inline-flex h-12 w-16 items-center justify-center rounded-full bg-white text-blue-600 sm:h-20 sm:w-20"
          >
          <img
            alt="Logo"
            src="img\logo.jpg"
            class="max-w-full h-auto rounded-full"
          />
          <span class="sr-only">Home</span>
          </p>

          <h1
            class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl"
          >
            Welcome to BoardGames
          </h1>

          <p class="mt-4 leading-relaxed text-gray-500">
          Un site pour le plaisir de découvrir ou redécouvrir des jeux à faire en famille ou entre amis
          </p>
        </div>

        <form method = "POST" class="mt-8 grid grid-cols-6 gap-6">
          <div class="col-span-6 sm:col-span-3">
            <label
              for="FirstName"
              class="block text-sm font-medium text-gray-700"
            >
              Surname*
            </label>

            <input
              type="text"
              id="id"
              name="identifiant"
              placeholder="Saisissez votre nom d'utilisateur" 
              required autofocus
              class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
            />
          </div>

          <div class="col-span-6">
            <label for="Email" class="block text-sm font-medium text-gray-700">
              Email*
            </label>

            <input
              type="mail"
              id="mail"
              name="mail"
              placeholder="Saisissez votre mail" required
              class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
            />
          </div>

          <div class="col-span-6 sm:col-span-3">
            <label
              for="Password"
              class="block text-sm font-medium text-gray-700"
            >
              Password*
            </label>

            <input
              type="password"
              id="mdp"
              name="mdp"
              placeholder="Saisissez votre mot de passe" 
              required
              class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
            />
          </div>

          <div class="col-span-6 sm:col-span-3">
            <label
              for="PasswordConfirmation"
              class="block text-sm font-medium text-gray-700"
            >
              Password Confirmation*
            </label>

            <input
              type="password"
              id="confirm_mdp"
              name="confirm_mdp"
              placeholder="Confirmez votre mot de passe" required
              class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
            />
          </div>

          <div class="col-span-6">
            <label for="MarketingAccept" class="flex gap-4">
              <input
                type="checkbox"
                id="MarketingAccept"
                name="marketing_accept"
                class="h-5 w-5 rounded-md border-gray-200 bg-white shadow-sm"
              />

              <span class="text-sm text-gray-700">
                I want to receive emails about events, product updates and
                company announcements.
              </span>
            </label>
          </div>

          <div class="col-span-6">
            <p class="text-sm text-gray-500">
            Les champs précédés d'un * sont obligatoires.
            </p>
          </div>

          <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
            <button
              class="inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500"
            >
              Create an account
            </button>

            <p class="mt-4 text-sm text-gray-500 sm:mt-0">
              Already have an account?
              <a href="signin.php" class="text-gray-700 underline">Log in</a>.
            </p>
          </div>
        </form>
      </div>
    </main>
  </div>
</section>

</body>



