<?php
require "functions_sign_in.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src= "https://cdn.tailwindcss.com"></script> 
    <title>Add your product, you admin !</title>
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
    
<form class = "mx-auto w-full items-center mt-10 my-4 before:flex-1 before:border-t before:border-gray-300 before:mt-0.5 after:flex-1 after:border-t after:border-gray-300 after:mt-0.5" action="" method = "POST" enctype="multipart/form-data">
    <table class= "inline-block px-7 mt-7 w-full">
      
      <caption class="inline-block w-full px-4 py-2 text-xl font-bold text-gray-700 justify_center bg-slate-300"><h1>Create a new product</h1></caption>

      <tr>
          <!-- PRODUCT NAME -->
          <td class="pt-10">
              <label class="form-control block w-full px-4 py-2 pl-10 text-xl font-normal text-gray-700">Product name* : </label>
          </td>

          <td class="pt-10">
            <input
            class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            placeholder="Enter the name" 
            type = "text" name = "name"/>
            <?php if (isset($_POST['name'])) ?>
          </td>

          <!-- DESCRIPTION -->
          <td class="pt-10">
              <label class="form-control block w-full px-4 py-2 pl-10 text-xl font-normal text-gray-700">Description* (max : 1 000 chars) : </label>
          </td>

          <td class="pt-10">
            <input
            class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            placeholder="Enter the name" 
            type = "text" name = "description"/>
            <?php if (isset($_POST['description'])) ?>
          </td>
      </tr>

      <tr>
          <!-- PRICE -->
          <td class="pt-10">
              <label class="form-control block w-full px-4 py-2 pl-10 text-xl font-normal text-gray-700">Price* : </label>
            </td>

            <td class="pt-10">
            <input
            class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            placeholder="Enter the price" 
            type = "text" name = "price"/>
            <?php if (isset($_POST['price'])){$d=3;} ?>
            </td>

          <!-- CATEGORY avec menu déroulant -->
          <td class="pt-10">
              <label class="form-control block w-full px-4 py-2 pl-10 text-xl font-normal text-gray-700">Category* : </label>
          </td>
          <td class="pt-10">
              <select 
                class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                name="category" 
                id="category">
                <option value=""></option>
                <?php
                foreach(showCatId() as $values)
                {
                  $catid=$values['id'];
                  echo$catid;
                  $namecat= utf8_encode(showCat($catid));
                  echo $namecat;
                ?>
                <option
                  value="<?=$catid;?>"><?=$namecat;?>
                </option>
                <?php }?>
              </select>
          </td>
        </tr>

      <tr>
        <!-- CHOISIR UN FICHIER -->
        <td class="pt-10">
        <input 
        class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700"
        type="file" name="picpic" id="pix"/>
        </td>
      </tr>

      <tr>
        <!-- BOUTON CREER UN PRODUIT-->
        <td class="pt-10">
        <input 
        class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 border-4 border-yellow-400 bg-slate-300" 
        type = "submit" value="Créer un nouveau produit" />
        </td>
      </tr>
      
    </table>



         <?php 
       
        if (isset($_POST['name'])&& $_POST['name']!="" &&isset($_POST['description']) && isset($_POST['price'])&&  $_POST['description']!="" && $_POST['price']!="" && isset($_POST['category']) && $_POST['category']!="" && isset($_FILES) && !empty($_FILES) && strlen($_FILES['picpic']['type'])!=0 ){          
          
          define ("STORAGE_PATH",__DIR__."/img");
          $filespath=STORAGE_PATH.'/'.$_FILES['picpic']['name'];
          move_uploaded_file($_FILES['picpic']['tmp_name'],$filespath);
          $changepic="http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/".$_FILES['picpic']['name'];
          
          // on ajoute le produit si on a tous les éléments et la photo
          $a=$_POST['name'];
          // var_dump($a=$_POST['name']);
          $b=$_POST['description'];
          // var_dump($a=$_POST['description']);
          $c=$_POST['price'];
          // var_dump($a=$_POST['price']);
          $d=$_POST['category'];
          // var_dump($a=$_POST['category']);
          $query ="INSERT INTO products (name,description,price,category_id,picture) VALUES ($a,$b,$c,$d,$changepic)";   
          $qq=connect_to_db();
          $qadd=$qq->prepare($query);
          // var_dump($a);
          $qadd->bindValue(1,$a,PDO::PARAM_STR);
          $qadd->bindValue(2,$b,PDO::PARAM_STR);
          $qadd->bindValue(3,$c,pdo::PARAM_INT);
          $qadd->bindValue(4,$d,PDO::PARAM_INT);
          $qadd->bindValue(1,"$changepic",PDO::PARAM_STR);
          $qadd->execute();
          ?>
          <div class= "mx-auto w-1/2 mt-7 bg-green-400 text-gray-500 text-center font-medium uppercase rounded">
          <?php echo"UN NOUVEAU PRODUIT EST CRÉE !";?>
          </div>
          <?php
          
        }
          
          else{
            ?>
            <div class= "mx-auto w-1/2 mt-7 bg-green-400 text-gray-500 text-center font-medium uppercase rounded">
            <?php echo"* Tous les champs doivent être remplis pour pouvoir générer un nouveau produit !";?>
            </div>
            <?php
          }
    ?>
 
</form>

    
</body>
</html>