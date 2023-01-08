<?php

// -----------------------------------------------* function Sign-In *------------------------------------------------------------

function connect_to_db (){
    require "connect_db.php";
    $pdo= new PDO($DB_DSN,$DB_USER,$DB_PW);
    
    return $pdo;

}

// Checklogin if we have valid name or mail and pw
function checklogin ($nameormail, $pw) {

    $pdo1=connect_to_db();
    $mail=$nameormail;

    $query="SELECT * FROM users WHERE users.password=? AND (users.username=? OR users.email=?)";
    
    //preparation de la requete 

    $query1=$pdo1->prepare($query);


    $query1->bindValue(1, $pw, PDO::PARAM_STR);
    $query1->bindValue(2, $nameormail, PDO::PARAM_STR);
    $query1->bindValue(3, $mail, PDO::PARAM_STR);

    $query1->execute();

    $result=$query1->fetchAll();

    // print_r($result);

    // on vérifie si l'on retrouve bien un élément, >> on a un match du coup connexion ! 

    

    if(!$result){
        ?>
        <div class= "inline-block px-7 py-3 bg-red-400 text-white text-center font-medium uppercase rounded w-full">
        <?php echo"This user is not registered in the DB";?>
        </div>
        <?php
    }
    else{
        $uniqid2=uniqid($nameormail,true);
        $uniqid="\"$uniqid2\"";
        $cestunmail=trueMail($nameormail);

        if(isAdmin($nameormail)){
            
    // //on crée notre cookie d'identification, utile pour rester log sur le site ! 
            if($cestunmail){
                
            $insert="UPDATE users SET users.json=$uniqid WHERE users.email = ?";
            
            $kk=connect_to_db();
            $insercook=$kk->prepare($insert);
            // $insercook->bindValue(1,$nameormail,PDO::PARAM_STR);

            $insercook->execute(array($nameormail));
            setcookie($nameormail,$uniqid,time()+3600);
            // header("Location: Admin.php");
        }
        else{
            $insert="UPDATE users SET users.json=$uniqid WHERE users.username = ?";
            
            $kk=connect_to_db();
            $insercook=$kk->prepare($insert);
            $insercook->bindValue(1,$nameormail,PDO::PARAM_STR);

            echo "vous êtes ici";
            $insercook->execute();
            setcookie($nameormail,$uniqid,time()+3600);
            header("Location: Admin.php");
        }
        }
        
        else{
            if($cestunmail){
                
                $insert="UPDATE users SET users.json=$uniqid WHERE users.email = ?";
                
                $kk=connect_to_db();
                $insercook=$kk->prepare($insert);
                $insercook->bindValue(1,$nameormail,PDO::PARAM_STR);
    
                $insercook->execute();
                setcookie($nameormail,$uniqid,"3600");
                header("Location: index.php");
            }
            else{
                $insert="UPDATE users SET users.json=$uniqid WHERE users.username = ?";
                
                $kk=connect_to_db();
                $insercook=$kk->prepare($insert);
                $insercook->bindValue(1,$nameormail,PDO::PARAM_STR);
    
                $insercook->execute();
                setcookie($nameormail,$uniqid,"3600");
                header("Location: index.php");
        }
    }

}
}
// 5 fonctions > check mail, username, mail, null, isAdmin

function checkNull($we){
    if (isset($we)){
        return true;
    }
    else{
        return false;
    }
}

function trueLogin($log){
    if ((is_string($log)) && (strlen($log)<15 && strlen($log)>5)) {
        return $log; 
    }
    else{
       
        return false;
    }
}

function truePassw($passw){
    if ((is_string($passw)) && (strlen($passw)<15 && strlen($passw)>5)) {
        return $passw; 
    }
    else{
        return false;
    }
}


function trueMail($email){
    if ((filter_var($email, FILTER_VALIDATE_EMAIL))) {
        return $email; 
    }
    else{
        return false;
    }
}

function isAdmin ($email){

    $jj=connect_to_db();

    $adminrequest= "SELECT * FROM users WHERE (users.email=? OR users.username=?) AND users.admin=1";

    $admined=$jj->prepare($adminrequest);

    $name=$email;


    $admined->bindValue(1,$email,PDO::PARAM_STR);
    $admined->bindValue(2,$name,PDO::PARAM_STR);

    $admined->execute();

    $resAdmined=$admined->fetchAll();

    // print_r($resAdmined);

    // var_dump($resAdmined);

    if($resAdmined){
        return true;
        ?>
        <div class= "inline-block px-7 py-3 bg-green-400 text-white text-center font-medium uppercase rounded w-full">
        <?php echo"Hello Admin";?>
        </div>
        <?php
    }
    else{
        ?>
        <div class= "inline-block px-7 py-3 bg-green-400 text-white text-center font-medium uppercase rounded w-full">
        <?php echo"You are not Admin !";?>
        </div>
        <?php
        return false;
    }


}

// -----------------------------------------------* function edit-user *------------------------------------------------------------

function displayUser ($id){
    $gg=connect_to_db();

    $query="SELECT * FROM users WHERE users.id=?";
    $quser=$gg->prepare($query);

    $quser->bindValue(1,$id,PDO::PARAM_STR);
    $quser->execute();
    $result=$quser->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $value){
    return $value;
    var_dump($value);
    }
}
    
function editName ($newname,$id){
    if(isset($newname)&& !empty($newname)){
        $qq=connect_to_db();
        $k="$newname";
        $query="UPDATE users SET users.username=? WHERE users.id=$id";
        $qname=$qq->prepare($query);
        $qname->bindValue(1,$k,PDO::PARAM_STR);
        $qname->execute();
        echo "Name changed with success</br>";
    }
}

function editEmail ($newemail,$id){
    if(isset($newemail) && !empty($newemail)){
        $qq=connect_to_db();
        $k="$newemail";
        $query="UPDATE users SET users.email=? WHERE users.id=$id";
        $qname=$qq->prepare($query);
        $qname->bindValue(1,$k,PDO::PARAM_STR);
        $qname->execute();
        echo "Mail changed with success</br>";
    }
}

function editPassword ($newpw,$id){
    if(isset($newpw)&& !empty($newpw)){
        $qq=connect_to_db();
        $k="$newpw";
        $query="UPDATE users SET users.password=? WHERE users.id=$id";
        $qname=$qq->prepare($query);
        $qname->bindValue(1,$k,PDO::PARAM_STR);
        $qname->execute();
        echo "Password changed with success</br>";
    }
}

function setAdmin ($admin,$id){
        switch($admin){
            case "0":
            $qq=connect_to_db();
            $query="UPDATE users SET users.admin=\"0\" WHERE users.id=$id";
            $qname=$qq->prepare($query);
            $qname->execute();
            echo "Admin status edited</br></br>";
            break;
                case "1":
                $qq=connect_to_db();
                $query="UPDATE users SET users.admin=\"1\" WHERE users.id=$id";
                $qname=$qq->prepare($query);
                $qname->execute();
                echo "Admin status edited</br></br>";
                break;
        }
}

function showAdmin ($admin){
    if ($admin == 1){
        echo "Cet utilisateur est désormais un admin !</br></br></br>";
    }
   
}



// -----* function edit-product ---------------*


function displayProduct ($id){
    $gg=connect_to_db();
    
    $query="SELECT * FROM products WHERE products.id=?";
    $qproduct=$gg->prepare($query);
    
    $qproduct->bindValue(1,$id,PDO::PARAM_STR);
    $qproduct->execute();
    $result=$qproduct->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $value){
        return $value;
        // var_dump($value);
    }
}

// mettre à jour setImg pour l'inclure dans SaveImg
function setImg($url1, $id) {
    
    $qq=connect_to_db();
    $url="$url1";
    // var_dump($url1);
    $query="UPDATE products SET products.picture=? WHERE products.id=$id;";
    $qpic=$qq->prepare($query);
    $qpic->bindValue(1,$url,PDO::PARAM_STR);
    $qpic->execute();

}

// FONCTION UTILE POUR UPLOAD LES FICHIERS. 

// function saveImg ($image_file){

// var_dump($image_file);
// define("STORAGE_PATH",__DIR__."/img");
// $filespath=STORAGE_PATH.'/'.$image_file['name'];

// move_uploaded_file($image_file['tmp_name'],$filespath);

// }

function editPname($newname,$id) {
    if(isset($newname)&& !empty($newname)){
        $qq=connect_to_db();
        $k="$newname";
        $query="UPDATE products SET products.name=? WHERE products.id=$id";
        $qname=$qq->prepare($query);
        $qname->bindValue(1,$k,PDO::PARAM_STR);
        $qname->execute();
        echo "Name changed with success</br>";
    }
}



function editPdesc($desc,$id) {
    if(isset($desc) && !empty($desc)){
    $qq=connect_to_db();
    $k="$desc";
    $query="UPDATE products SET products.description=? WHERE products.id=$id";
    $qname=$qq->prepare($query);
    $qname->bindValue(1,$k,PDO::PARAM_STR);
    $qname->execute();
    echo "Description changed with success</br>";
}
}

function editPrice($price,$id){
    
    if(($price!=0)){
        
        $qq=connect_to_db();
        $k=$price;
        $query="UPDATE products SET products.price=? WHERE products.id=\"$id\"";
        $qname=$qq->prepare($query);
        $qname->bindValue(1,$k);
        $qname->execute();
        echo "Price changed with success</br>";
    }
    else{
        echo"Your price must be an integer !";
    }
}

function setCat($category,$id){
    $qq=connect_to_db();
    $query="UPDATE products SET products.category=$category WHERE products.id=$id";
    $qcat=$qq->prepare($query);
    $qcat->execute();
}

// -----------------------------------------------* function edit-categorie *------------------------------------------------------------

// Fonction Catégorie dans update_object

function deleteCat ($parentid){
    
    //on trouve le père du supprimé 
    
    $gg=connect_to_db();
    $query0="SELECT parent_id FROM categories WHERE categories.id=$parentid";
    $qgpcat=$gg->prepare($query0);
    $qgpcat->execute();
    $resgp=$qgpcat->fetchAll();
    foreach($resgp as $val1){
       $val=$val1[0];
    }

    // on trouve les filles du supprimé ! et on en fait une liste exploitable pour une fonction IN 
    $globs="";
    $qq=connect_to_db();
    $query="SELECT categories.id FROM categories WHERE parent_id=$parentid";
    $qparcat=$qq->prepare($query);
    $qparcat->execute();
    $respar=$qparcat->fetchAll(PDO::FETCH_ASSOC);
    foreach($respar as $res){
        $globs.=$res['id'].",";
    }
    $glob="(".substr($globs,0,-1).")";

    // on leur donne comme tuteur leur grand pere 
    if($glob != "()"){
    $kk=connect_to_db();
    $query2="UPDATE categories SET parent_id=$val WHERE categories.id IN $glob";
    $qdaugh=$kk->prepare($query2);
    $qdaugh->execute();    
    }

    // On occit le père une bonne fois pour toute 

    $pp=connect_to_db();
    $query3="DELETE FROM categories WHERE categories.id = $parentid";
    $qkill=$pp->prepare($query3);
    $qkill->execute();
    echo "La catégorie a bien été supprimée. Les catégories filles sont rattachées au parent de la catégorie supprimée.";

}

function createCat($category,$parent){
    if(!empty($category)){
    $qq=connect_to_db();
    $query ="INSERT INTO categories(name,parent_id) VALUES(?,?)";
    $qcat=$qq->prepare($query);
    $qcat->bindValue(1,"$category",PDO::PARAM_STR);
    $qcat->bindValue(2,$parent);
    $qcat->execute();
    echo"Category added with success!" ;
    }
    else{
        echo"Text cannot be null to add a new category";
    }

}

// l'idée est de rappeler toutes les catégories parentes à l'admin :) ! 

function showCat($val){
    $qq=connect_to_db();
    $query="SELECT categories.name FROM categories WHERE id =$val";
    $qcat=$qq->prepare($query);
    $qcat->execute();
    $result=$qcat->fetch(PDO::FETCH_ASSOC);
    foreach($result as $e){
        print_r($e);
        return $e;
    }
}

// trouver les id, retourne 

function showCatId(){
    $qq=connect_to_db();
    $query="SELECT categories.id FROM categories";
    $qcat=$qq->prepare($query);
    $qcat->execute();
    $result=$qcat->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}


// --------------------------------------------------------- FONCTIONS UTILES POUR LA BDD --------------------------------------------------------------------------------------------

function generatepiclinks ($n){
    for ($i=1; $i<$n; $i++) {
        $qq=connect_to_db();
        $query= "SELECT products.name FROM products WHERE id = $i";
        $qname=$qq->prepare($query);
        $qname->execute();
        $result=$qname->fetch();
        foreach($result as $res){
        echo$res;
        
        }

        $piclink="\"http://shopquimarche/src/img/".$res.".jpg\"";
        echo$piclink;
        var_dump($piclink);

        $queri ="UPDATE products SET products.picture = $piclink WHERE products.id= $i ";
        $qpic=$qq->prepare($queri);
        $qpic->execute();
        
    }

}