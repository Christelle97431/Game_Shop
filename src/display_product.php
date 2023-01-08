<?php

//--------------------------------------//
//---------- CONNECTION A -------------//
//--------------LA BDD ---------------//

function connect_db($host,$username,$password,$port,$dbname)
{   
    try
    {
        $connexion = new PDO("mysql:host=$host;dbname=$dbname;port=$port",$username,$password); 
        $connexion -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // echo "Connection to DB successfull : ";
        return $connexion;
    }
    
    catch (PDOexception $e)
    {      
        $error = "PDO ERROR : Error connection to DB" .$e ->getMessage() ."\n";
        echo $error."\n";
        return false; 
    }   
}

$bdd=connect_db("localhost","root","","3306","my_shop");

//-------------------------------------//
//------------- DISPLAY --------------//
//-------------- USER ---------------//

$select = "SELECT * FROM products";
        $query = $bdd -> prepare($select);
        $query -> execute();

        $result = $query -> fetchall(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<script src="https://cdn.tailwindcss.com"></script>
<title>Delete Product data</title>
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

<!-- component -->
<div class="table w-full p-10">
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-50 border-b">
                    <th class="border-r p-2">
                        <input type="checkbox">
                    </th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                        <div class="flex items-center justify-center">
                            ID
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                            </svg>
                        </div>
                    </th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                        <div class="flex items-center justify-center">
                            Name
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                            </svg>
                        </div>
                    </th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                        <div class="flex items-center justify-center">
                            Description
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                            </svg>
                        </div>
                    </th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                        <div class="flex items-center justify-center">
                            Price €
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                            </svg>
                        </div>
                    </th>
                    <th colspan="2" class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                        <div class="flex items-center justify-center">
                            Action
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                            </svg>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- Zones de recherche -->
                <tr class="bg-gray-50 text-center">
                    <td class="p-2 border-r">
                        
                    </td>
                    <td class="p-2 border-r">
                        <input type="text" class="border p-1">
                    </td>
                    <td class="p-2 border-r">
                        <input type="text" class="border p-1">
                    </td>
                    <td class="p-2 border-r">
                        <input type="text" class="border p-1">
                    </td>
                    <td class="p-2 border-r">
                        <input type="text" class="border p-1">
                    </td>
                    <td colspan="2" class="p-2">
                        <input type="text" class="border p-1">
                    </td>   
                </tr>

<?php
foreach($result as $value)
    {
    $name = $value['name'];
    $id = $value['id'];
    $description = $value['description'];
    $price = $value['price'];
?>

                <tr class="bg-gray-100 text-center border-b text-sm text-gray-600">
                    <td class="p-2 border-r">
                        <input type="checkbox">
                    </td>
                    <td class="p-2 border-r"><?php echo $id; ?></td>
                    <td class="p-2 border-r"><?php echo utf8_encode ("$name"); ?></td>
                    <td class="p-2 border-r"><?php echo utf8_encode ("$description"); ?></td>
                    <td class="p-2 border-r"><?php echo $price; ?></td>
                    <td class="border border-slate-300">
                        
                        <a class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none
                         focus:shadow-outline" href="edit_product.php?myid=<?=$id?>" type="submit" name="edit_product" value="<?php echo $id;?>">Edit Product</button></td>
                        </form>
                    <td class="border border-slate-300">
                        <form method = "POST">
                        <button class="border border-red-500 bg-red-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" type="submit" name="product_delete" value="<?php echo $id;?>">Delete Product</button>
                    </td>
                </tr>
<?php
    }
?>
            </tbody>
        </table>
    </div>



<?php
//--------------------------------------//
//--------------- DELETE --------------//
//-------------- PRODUCT --------------//

if(isset($_POST['product_delete']))
{
    $product_id = $_POST['product_delete'];
    $delete = "DELETE FROM products WHERE id=$product_id";
    
    $query = $bdd -> prepare($delete);
    $query -> execute();
    
    if (($query -> rowcount()) == 1)     // rowcount == 1 car il y a 1 suppression
    {                
        ?>
        <!DOCTYPE html>
        <html>
        <head>
        <link rel="stylesheet" href="style.css">
        <script src="https://cdn.tailwindcss.com"></script>
        <title>Delete product data</title>
        </head>
        <body>
        <div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="delete">
        <span class="font-medium">Product deleted successfully</span>
        </div>
        
        <?php
        echo date('H:i:s Y-m-d');
        echo '<script type="text/JavaScript"> location.reload(); </script>';
        exit;
    }                                   
}

?>
</body>


</html>



