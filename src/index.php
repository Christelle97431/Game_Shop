<?php

include_once("functions_sign_up.php");
require_once("functions_sign_in.php");

/* sélectionner les produits depuis la barre de recherche */
// require_once("searchbar.php");

// On va chercher les articles dans la BDD
// On se connecte à la base
$pdo = connect_to_db();

        // On écrit la requête
        $sql = "SELECT * FROM `products` ORDER BY id DESC";
        // On éxecute la requête
        $requete = $pdo->query($sql);
        // On récupère les données
        $products = $requete->fetchAll();


// Code PHP de la pagination et récupération des produits

// On détermine sur quelle page on se trouve
if (isset($_GET['page']) && !empty($_GET['page'])) {
  $currentPage = (int) strip_tags($_GET['page']);
} else {
  $currentPage = 1;
}

// On détermine le nombre total de produits
$sql = 'SELECT COUNT(*) AS nb_products FROM `products`;';

// On prépare la requête
$query = $pdo->prepare($sql);

// On exécute
$query->execute();

// On récupère le nombre de produits
$result = $query->fetch();

$nbArticles = (int) $result['nb_products'];

// On détermine le nombre d'articles par page
$parPage = 7;

// On calcule le nombre de pages total
$pages = ceil($nbArticles / $parPage);


// Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;

// Produits à afficher selon le mot saisi dans la barre de recherche
$words = "";
if(isset($_POST['submit']) && !empty($_POST['keywords']))
{
    // Récupérer tous les mots dans un array
    $words = explode(" ", trim($_POST['keywords']));
    for ($i=0; $i<count($words);$i++)
    {
        /* tableau $kw contenant les expressions des mots saisis par l'utilisateur */
        $kw[$i] = "name like '%".$words[$i]."%'";
        /* réaliser la requête en associant les mots du tableau $kw grâce la fonction implode qui convertit le tableau $kw en 1 chaine de caractère
        séparé par des OR */
        $sql = 'SELECT * FROM products WHERE '.implode(" OR ", $kw);
        // $sql = "SELECT * FROM products WHERE " .implode(" OR ", $kw) ."ORDER BY 'name' DESC LIMIT :premier, :parpage";
        $query = $pdo -> prepare($sql);

        $query->bindValue(':premier', $premier, PDO::PARAM_INT);
        $query->bindValue(':parpage', $parPage, PDO::PARAM_INT);

        $query -> execute();
    }
    /* si aucun mot saisi dans la barre de recherche n'est trouvé*/
    if (($query -> rowcount()) == 0)
    {                
      $_POST['keywords'] = "Sorry ! no product found. Try search again.";
      $sql = 'SELECT * FROM `products` ORDER BY `id` DESC LIMIT :premier, :parpage;';
      // On prépare la requête
      $query = $pdo->prepare($sql);
    
      $query->bindValue(':premier', $premier, PDO::PARAM_INT);
      $query->bindValue(':parpage', $parPage, PDO::PARAM_INT);
    
      // On exécute
      $query->execute();
    
      // On récupère les valeurs dans un tableau associatif
      $products = $query->fetchAll(PDO::FETCH_ASSOC);
    }
    else
    {
        $products = $query -> fetchall(PDO::FETCH_ASSOC);
    }
}
else
    /* si la barre de recherche est vide*/
{
  $_POST['keywords'] = NULL;
  $sql = 'SELECT * FROM `products` ORDER BY `id` DESC LIMIT :premier, :parpage;';
  // On prépare la requête
  $query = $pdo->prepare($sql);

  $query->bindValue(':premier', $premier, PDO::PARAM_INT);
  $query->bindValue(':parpage', $parPage, PDO::PARAM_INT);

  // On exécute
  $query->execute();

  // On récupère les valeurs dans un tableau associatif
  $products = $query->fetchAll(PDO::FETCH_ASSOC);
}

?>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Board games - Accueil</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="">
  <link href="/dist/output.css" rel="stylesheet">
</head>

<header class="bg-white">

  <div class="mx-auto max-w-screen-xl px-2 sm:px-6 lg:px-8">

    <div class="flex h-16 items-center justify-between">
      <!-- logo -->
      <div class="flex-1 md:flex md:items-center md:gap-12">
        <p class="block text-teal-600">
          <span class="sr-only">Accueil</span>
          <a href="./index.php">
          <img class="h-16" src="img\logo.jpg"  alt="Logo">
          </a>
        </p>

        <!-- barre de recherche -->
        <div>
          <form method="POST" class="flex items-center mt-3">   
          <label for="simple-search" class="sr-only">Search</label>
          <div class="relative w-full">
              <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                  <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
              </div>

              <input type="text" value= "<?php echo $_POST['keywords']?>" name="keywords" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-14 lg:w-96 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search">
          </div>
          <button type="submit" name="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
              <span class="sr-only">Search</span>
          </button>
          </form>
        </div>

      </div>

      <!-- boutons de connexion - inscription - menu -->
      <div class="md:flex md:items-center md:gap-12">

        <div class='flex items-center justify-center min-h-screen'>
          <div class="border w-fit rounded-xl m-5 shadow-sm">
            <a href="signin.php">
              <button class="px-4 py-2 rounded-l-xl m-0 text-white bg-teal-600 hover:bg-teal-400 transition">Connexion</button>
            </a>
            <a href="signup.php">
              <button class="px-4 py-2 rounded-r-xl text-white bg-teal-600 hover:bg-teal-400 transition">Inscription</button>
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
  
</header>


<body class="border-8">

  </div>

  <!-- Création de la Grid -->

  <div class="grid grid-cols-1 gap-4 lg:grid-cols-4">

    <!-- Emplacement pour le menu Filtre -->

    <div></div>

    <!-- Liste des cards -->

    <?php foreach ($products as $value) 
    {
      $picture = $value['picture'];
      $name = $value['name'];
      $description = $value['description'];
      $price = $value['price'];
    ?>

      <div class="block overflow-hidden rounded-2xl border-spacing-1">
        <img alt="Product" src="<?= $picture; ?>" class="h-36 w-50 ml-24" />

        <div class="bg-teal-600 p-4 rounded-b-2xl">
          <p class="text-xs text-black"><?= $price; ?>€</p>

          <h3 class="text-sm text-white">
            <?= utf8_encode("$name"); ?>
            <!-- Ligne ci dessus le "?=" équivaut à un php echo -->
          </h3>

          <p class="mt-1 text-xs text-black">
            <?php $description = wordwrap($description, 60);
            $description = explode("\n", $description);
            $description = $description[0];
            echo utf8_encode("$description"); ?>
          </p>

        </div>
      </div>

    <?php
    }
    ?>

</body>



  <footer class="mt-4">

  <!-- Pagination HTML avec Tailwind -->
  <ol class="flex justify-center gap-10 text-xs font-medium md:text-sm  lg:justify-center">

    <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
    <li class="<?= ($currentPage == 1) ? "hidden lg:hidden" : "" ?>">
      <a href="./?page=<?= $currentPage - 1 ?>" title="Précédente" class="inline-flex h-8 w-8 items-center justify-center rounded border border-gray-100">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
      </a>
    </li>

    <?php for ($page = 1; $page <= $pages; $page++) : ?>
      <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
      <li <?= ($currentPage == $page) ? "active" : "" ?>>
        <a href="./?page=<?= $page ?>" <?= $page ?> class="block h-8 w-8 border-black text-center bg-teal-600 hover:bg-teal-400 leading-8 text-white">
          <?= $page ?>
        </a>
      </li>
    <?php endfor ?>
      <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
      <li <?= ($currentPage == $pages) ? "hidden lg:hidden" : "" ?>>
        <a href="./?page=<?= $currentPage + 1 ?>" title="Suivante" class="inline-flex h-8 w-8 items-center justify-center rounded border border-gray-100">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
          </svg>
        </a>
      </li> 
  </ol>

  <div aria-label="Site Footer" class="bg-white">
    <div class="mx-auto max-w-5xl px-4 py-6 sm:px-6 lg:px-8">
      <div class="flex justify-center text-teal-600">
      <img class="h-16" src="img\logo.png" alt="Logo">
      </div>

      <p class="mx-auto mt-6 max-w-md text-center leading-relaxed text-gray-500">
        Board Games, ton shop bourré de jeux de sociétés !
      </br>
        Board Games © 2022 - Christelle, Mathieu & Dylan.
      </p>

      <ul class="mt-12 flex justify-center gap-6 md:gap-8">
        <li>
          <a
            href="/"
            rel="noreferrer"
            target="_blank"
            class="text-gray-700 transition hover:text-gray-700/75"
          >
            <span class="sr-only">Facebook</span>
            <svg
              class="h-6 w-6"
              fill="currentColor"
              viewBox="0 0 24 24"
              aria-hidden="true"
            >
              <path
                fill-rule="evenodd"
                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                clip-rule="evenodd"
              />
            </svg>
          </a>
        </li>

        <li>
          <a
            href="/"
            rel="noreferrer"
            target="_blank"
            class="text-gray-700 transition hover:text-gray-700/75"
          >
            <span class="sr-only">Instagram</span>
            <svg
              class="h-6 w-6"
              fill="currentColor"
              viewBox="0 0 24 24"
              aria-hidden="true"
            >
              <path
                fill-rule="evenodd"
                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                clip-rule="evenodd"
              />
            </svg>
          </a>
        </li>

        <li>
          <a
            href="/"
            rel="noreferrer"
            target="_blank"
            class="text-gray-700 transition hover:text-gray-700/75"
          >
            <span class="sr-only">Twitter</span>
            <svg
              class="h-6 w-6"
              fill="currentColor"
              viewBox="0 0 24 24"
              aria-hidden="true"
            >
              <path
                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"
              />
            </svg>
          </a>
        </li>

        <li>
          <a
            href="/"
            rel="noreferrer"
            target="_blank"
            class="text-gray-700 transition hover:text-gray-700/75"
          >
            <span class="sr-only">GitHub</span>
            <svg
              class="h-6 w-6"
              fill="currentColor"
              viewBox="0 0 24 24"
              aria-hidden="true"
            >
              <path
                fill-rule="evenodd"
                d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                clip-rule="evenodd"
              />
            </svg>
          </a>
        </li>

      </ul>
      
    </div>
  </div>

</footer>

</html>