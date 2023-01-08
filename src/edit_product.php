<?php
require "functions_sign_in.php";

// on get/set les différents attributs de User > Productname, Description, picture, price
// Catégorie ID à ajouter aussi. 

// FIXER product id Pendant les tests en attendant les boutons
$productid=$_GET['myid'];

// $productid=3;
// On fixe certaines variables 
$product1=displayProduct($productid);
$name1=$product1['name'];
$desc1=$product1['description'];
$pic1=$product1['picture'];
$price1=$product1['price'];
$cat1=$product1['category_id'];
$pic1=$product1['picture'];


// on evite les bugs avec les POSTS

if (isset($_POST['name'])){
    $namepost=$_POST['name'];
}
if (isset($_POST['description'])){
    $descpost=$_POST['description'];
}
if (isset($_POST['picture'])){
    $picpost=$_POST['picture'];
}
if(isset($_POST['price']) && !empty($_POST['price'])){
      $pricepost=$_POST['price'];
    
}
if(isset($_POST['category_id'])){
    $catpost=$_POST['category_id'];
}
if(isset($_FILES) && !empty($_FILES)){
    $image_file = $_FILES["picpic"];
    $picname=$image_file['name'];
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src= "https://cdn.tailwindcss.com"></script> 
    <title>Edit your product, you admin !</title>
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

<!-- MAJ nom, description, categorie, prix -->
<form class = "mx-auto w-full items-center mt-10 my-4 before:flex-1 before:border-t before:border-gray-300 before:mt-0.5 after:flex-1 after:border-t after:border-gray-300 after:mt-0.5" action = "" method = "POST">

<table class= "inline-block px-7 mt-7 w-full">

      <caption class="inline-block w-full px-4 py-2 text-xl font-bold text-gray-700 justify_center bg-slate-300"><h1>Edit a product</h1></caption>

      <tr>
          <!-- PRODUCT NAME -->
          <td class="pt-10">
              <label class="form-control block w-full px-4 py-2 pl-10 text-xl font-normal text-gray-700">Product name : </label>
          </td>

          <td class="pt-10">
            <input
            class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            placeholder="Enter the name" 
            type = "text" name = "name"/>
            <?php if (isset($_POST['name'])){ editPname($namepost,$productid);} ?>
          </td>

          <!-- DESCRIPTION -->
          <td class="pt-10">
            <label class="form-control block w-full px-4 py-2 pl-10 text-xl font-normal text-gray-700">Description (max : 1 000 chars) : </label>
          </td>

          <td class="pt-10">
            <input
            class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            placeholder="Enter the name" 
            type = "text" name = "description"/>
            <?php if (isset($_POST['description'])){editPdesc($descpost,$productid);} ?>
          </td>
      </tr>

      <tr>
          <!-- PRICE -->
          <td class="pt-10">
              <label class="form-control block w-full px-4 py-2 pl-10 text-xl font-normal text-gray-700">Price : </label>
          </td>

          <td class="pt-10">
            <input
            class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            placeholder="Enter the price" 
            type = "text" name = "price"/>
            <?php if (isset($_POST['price'])&& !empty($_POST['price'])){editPrice($pricepost,$productid);} ?>
          </td>

          <!-- CATEGORY avec menu déroulant -->
          <td class="pt-10">
              <label class="form-control block w-full px-4 py-2 pl-10 text-xl font-normal text-gray-700">Category : </label>
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
                  $namecat=showCat($catid);
                  echo$namecat;
                  ?>
                  <option value="<?=$catid;?>"><?=$namecat;?></option>
                  <?php } 
                  if (isset($_POST['category'])&& !empty($_POST['category'])){
                    setCat($_POST['category'],$productid);
                  }
                ?>
              </select>
          </td>
      </tr>

      <tr>
        <!-- BOUTON METTRE A JOUR LE PRODUIT-->
        <td class="pt-10">
          <input 
          class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 border-4 border-yellow-400 bg-slate-300" 
          type = "submit" value="Mettre à jour" />
        </td>
      </tr>

</table>

</form>

<!-- MAJ fichier -->
<form class = "mx-auto w-full items-center mt-10 my-4 before:flex-1 before:border-t before:border-gray-300 before:mt-0.5 after:flex-1 after:border-t after:border-gray-300 after:mt-0.5"
action="<?php $_SELF ?>" method="POST" enctype="multipart/form-data">

<table class= "inline-block px-7 w-full">
  <tr>
        <!-- CHOISIR UN FICHIER -->
        <td class="pt-10">
          <input 
          class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700"
          type="file" name="picpic" id="pix"/>
        </td>
        <!-- TELECHARGER UN FICHIER -->
        <td class="pt-10">
          <button 
          class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 border-4 border-yellow-400 bg-slate-300"
          type="submit"> Upload pic</button>
        </td>
        <!-- VISUALISER L'IMAGE -->
        <td class="pt-10">
          <label class="form-control block w-full px-4 py-2 pl-10 text-xl font-normal text-gray-700">Picture : </label>
          </td>
        <td class="pt-10">
          <img class="w-48 max-h-48 ml-5" 
          src=<?php echo$pic1?>>
        </td>
  </tr>

</table>

         <?php 
        if (isset($_FILES) && !empty($_FILES) && strlen($_FILES['picpic']['type'])!=0 )
        {          
            define ("STORAGE_PATH",__DIR__."/img");
            $filespath=STORAGE_PATH.'/'.$_FILES['picpic']['name'];
            move_uploaded_file($_FILES['picpic']['tmp_name'],$filespath);
            $changepic="http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/".$_FILES['picpic']['name'];

          setImg($changepic,$productid);
        }
        ?>
</form>

</body>
</html>