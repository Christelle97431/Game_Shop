<?php

/*---------------------------------*/
/*---------HASH PASSWORD-----------*/
/*---------------------------------*/

function my_password_hash($password)
{
    $salt=uniqid();
    $mdp = crypt($password, $salt);
    $array = [
        "hash"=>$mdp,
        "salt"=>$salt];
    return $array;
};

/*---------------------------------*/
/*---------VERIFY PASSWORD---------*/
/*---------------------------------*/
function my_password_verify($password,$salt,$hash)
{
    $hash_verify = crypt($password, $salt);
    // var_dump ($hash_verify);
    // echo "\n";
    if ($hash == $hash_verify){
        return true;
    }
    else {
        return false;
    }
};

// $arr = my_password_hash("toto");
// print_r ($arr);
// echo "\n";
// var_dump(my_password_verify("toto",$arr["salt"],$arr["hash"]));

//--------------------------------------//
//---------- VERIFICATION -------------//
//---- DES ERREURS AVANT INSERTION-----//
//-------------DANS LA BDD-------------//
//-------------------------------------//

/* Vérifier si la variable est vide ou pas avant injection dans la BDD */
function required($value)
{
    if(!isset($value) || empty($value))
    {
        $err="undeclared or empty value";
        echo $err."\n";
        file_put_contents(ERROR_LOG_FILE, $err, FILE_APPEND);
        exit;
    }
    else
    {
        return($value);
    }
}

/* vérifier si le password et le confirm_password sont identiques 
et que le password correspond aux critères données : 
au moins un caractère spécial : (?=\S*[\W])
au moins un chiffre : (?=.*[0-9])
au moins une lettre majuscule : (?=.*[A-Z])
de 8 caractères à 20 caractères : .{8,20} */
function password($password,$confirm_password)
{
    $pattern = "/^(?=\S*[\W])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/";
    if ($password <> $confirm_password)
    {
        $err= "Passwords don't match";
        file_put_contents(ERROR_LOG_FILE, $err, FILE_APPEND);
        echo $err."\n";
        exit;
    }
    elseif (preg_match($pattern,$password))
    {
        return($password);
    }
    else
    {
        $err= "Password must contain betwin 8 and 20 characters including 1 MAJ, 1 min, 1 number and 1 special character<br>";
        file_put_contents(ERROR_LOG_FILE, $err, FILE_APPEND);
        echo $err."\n";
        exit;
    }
}


/* vérifier si mail est valide */
function email($value)
{
    if (!filter_var($value,FILTER_VALIDATE_EMAIL))
    { 
        $valid = false;
        $err= "Invalid email !<br>";
        file_put_contents(ERROR_LOG_FILE, $err, FILE_APPEND);
        echo $err."\n";
        exit;
    }
}


/* Supprimer les \ successifs dans une chaîne de caractères */
function removeslashes($string)
{
    $string=implode("",explode("\\",$string));
    return stripslashes(trim($string));
}


/* Nettoyer la valeur de type string saisie par l'utilisateur */
function securisation($value)
{
    $value = filter_var($value,FILTER_SANITIZE_SPECIAL_CHARS); //supprime les caractères spéciaux en html <>&
    $value = trim($value);  //supprime les espaces, \t,\n,\r,\0, \v saisis par l'utilisateur en début/fin de chaîne
    $value = removeslashes($value);  //supprime les antislash successifs en appliquant la fonction ci-dessus
    $value= strip_tags($value);    //supprime les balises html et PHP saisies par l'utilisateur du formulaire
    return ($value);
}