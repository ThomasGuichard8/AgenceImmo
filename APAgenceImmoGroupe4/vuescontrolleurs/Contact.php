<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
?>
<html>
    <head>
        <title>Contact</title>
        <meta charset="UTF-8">
        <link href="../css//CharteGraphique.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php
        include_once '../inc/header.inc';
        if((isset($_SESSION['login']))){
                include_once '../inc/nav_employe.inc';
            }
        else{
            include_once '../inc/nav.inc';
        }
        ?>
		<div id="pageContact">
			<br><br>
			<div id="mail">Mail : AgenceImmo@gmail.com</div>
			<br><br>
			<img id="imgfb" src="../img/facebook.png" alt="" height="50" width="50">
			<a id="facebook" href="https://fr-fr.facebook.com/">Compte Facebook</a>
			<br><br>
			<img id="imgtw" src="../img/Twitter.jpg" alt="" height="50" width="50">
			<a id="twitter" href="http://twitter.fr/">Compte Twitter</a>
			<br><br>
			<img id="imgin" src="../img/Instagram.png" alt="" height="50" width="50">
			<a id="insta" href="https://www.instagram.com/">Compte Instagram</a>
			<br><br><br>
			<div id="numero">Téléphone : +33 3 12 34 56 78</div>
        </div>
        <?php
        include_once '../inc/footer.inc'
        ?>
	</body>
</html>
