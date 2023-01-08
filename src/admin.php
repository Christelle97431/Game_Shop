<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CDM</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <script src="https://cdn.tailwindcss.com"></script>
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

  <div class="grid grid-cols-1 text-center lg:grid-cols-2 gap-4 px-8 py-8">
    <fieldset class=" border-4 border-slate-400 m-3">
      <legend><h3 class="font-bold">USERS</h3></legend>
  
      <form method = "post" action=display_user.php> 
          <!-- <legend><h4>Username</h4></legend>  -->
          <input class=" border-2 border-black m-3 w-40" type="submit" value="DISPLAY USER"/>
      </form>

      <!-- <form method = "post" action=edit_user.php> 
          <input class=" border-2 border-black m-3 w-40" type="submit" value="EDIT USER"/> 
      </form>

      <form method = "post" action=delete_user.php> 

        <input class=" border-2 border-black m-3 w-40" type="submit" value="DELETE USER"/> 
          <button class=" border-2 border-black m-3 w-40" type="button" name="user_delete">DELETE USER</button>
      </form> -->
    </fieldset>

    <fieldset class=" border-4 border-slate-400 m-3">
      <legend><h3 class="font-bold">PRODUCTS</h3></legend>
  
      <form method = "post" action=add_product.php> 
          <input class=" border-2 border-black m-3 w-40" type="submit" value="ADD PRODUCT"/> 
      </form>

      <form method = "post" action=categories.php> 
          <input class=" border-2 border-black m-3 w-40" type="submit" value="ADD CATEGORY"/> 
      </form>
      
      <form method = "post" action=display_product.php> 
          <!-- <legend><h4>Product</h4></legend> 
          <input class=" border-2 border-black m-3 w-96" type = "text" name="user" placeholder="Nom du produit"/> -->
          <input class=" border-2 border-black m-3 w-40" type="submit" value="DISPLAY PRODUCT"/>
      </form>

      <!-- <form method = "post" action=edit_product.php> 
          <input class=" border-2 border-black m-3 w-40" type="submit" value="EDIT PRODUCT"/> 
      </form>

      <form method = "post" action=delete_product.php> 
          <input class=" border-2 border-black m-3 w-40" type="submit" value="DELETE PRODUCT"/> 
      </form> -->
    </fieldset>
  </div>

</body>
