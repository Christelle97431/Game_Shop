<?php 

require "functions_sign_in.php";

if((isset($_POST['category']) && !empty($_POST['category']))){
  $category=$_POST['category'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src        = "https://cdn.tailwindcss.com"></script> 
<title>Categories</title>
</head>


<header class="bg-white">
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex-1 md:flex md:items-center md:gap-12">
          <a class="block text-teal-600" href="/">
            <span class="sr-only">Home</span>
            <div class="mt-3">
              
            <a href="#"><img src="img/logo.jpg" width="110px" alt="logo"> </a>
            </div>
        </div>
  
          <div class="flex items-center gap-4">
            <div class="sm:flex sm:gap-4">
              <a
                class="rounded-md bg-teal-600 px-5 py-2.5 text-sm font-medium text-white shadow"
                href="signin.php"
              >
                Connexion
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
</br>
</br>

<form method="POST">
CATEGORY: <input class="border-4 border-black" type = "text" name="category" placeholder="" />
</br>
</br>

<?php
//  foreach(showCatId() as $e){
  // var_dump($e);}
  // echo(showCat(3));}
  ?>
  
  
  Whose family does this game belongs to ? </br> </br> </br>
  <select name="parent" id="parent">
  <?php
  foreach(showCatId() as $values){
    
    $catid=$values['id'];
    echo$catid;
    $namecat=showCat($catid);
    echo$namecat;
    ?>
    <option value="<?=$catid;?>"><?=$namecat;?></option>
    <?php } ?>
    </select>
    
    </br> </br> </br>
    </br>
    
    <input class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease  
    hover:bg-green-600 focus:outline-none focus:shadow-outline" type = "submit" value="Créer la catégorie" />
    
    <?php 
    
    if((isset($category) && !empty($category))){
      createCat($category,$_POST['parent']);
    }
    ?>
    
  </form>
  
  </br> </br> </br>

DELETE AN EXISTING CATEGORY : 


  <form action ="" method="Post"> 
  <select name="delete" id="delete">
    <option value=""></option>
  <?php
  foreach(showCatId() as $values){
    
    $catid=$values['id'];
    echo$catid;
    $namecat=showCat($catid);
    echo$namecat;
    ?>
    <option value="<?=$catid;?>"><?=$namecat;?></option>
    <?php } ?>
    </select>
  

    </br> </br> 
  <input Class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease  
    hover:bg-green-600 focus:outline-none focus:shadow-outline" type="submit" value="DELETE">

<?php 
if((isset($_POST['delete']) && !empty($_POST['delete']))){
    deleteCat($_POST['delete']);
}
?>

</form>

</body>

</html>
    
