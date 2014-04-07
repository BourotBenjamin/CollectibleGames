<?php
 
$navbar = 0;
define('IN_PHPBB', true);
$phpbb_root_path = './forum/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.php');
         
// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();
//$user->data['userid']
//$user->data['username']
//print_header($navbits, $headeralerts, $navbar, $pagetitle);
if(isset($_POST['logout']))
{
		$user->session_kill();
		$user->session_begin();
		$headeralerts = '<script>
				$(function(){
					alertify.success("Au revoir");
				});
			</script>';
}
if(isset($_POST['login']))
{
	$result = $auth->login($_POST['username'], $_POST['password']);
	if ($result['status'] == LOGIN_SUCCESS)
	{
		$headeralerts = '<script>
				$(function(){
					alertify.success("Connexion réussie");
				});
			</script>';
	}
	else
	{
		$headeralerts = '<script>
				$(function(){
					alertify.error("Erreur lors de la connexion");
				});
			</script>';
	}
}
include 'bddjv/controller.php';

print_header(null, $headeralerts, null, $user, 1);

$query = "SELECT * FROM bddjv_version_jeu 
NATURAL JOIN bddjv_jeu 
JOIN bddjv_nom_jeu 
WHERE bddjv_nom_jeu.id_nom_jeu = bddjv_jeu.id_nom_jeu
AND photo_boite != 'img/inconnu.png'
ORDER BY RAND()
LIMIT 8";
	$db = Base::getConnection();


echo '</div>
<div id="templatemo_slider"><br>
	<div class="titreBlanc">Des jeux au hasard : </div>
	<!-- This is the container for the carousel. -->
    <center><div id = "carousel1" style="width:960px; height:280px;background:none;overflow:scroll; margin-top: 20px">            
        <!-- All images with class of "cloudcarousel" will be turned into carousel items -->
        <!-- You can place links around these images -->';
		foreach($db->query($query) as $row)
		{
			$x=0;
			if(is_file($row['photo_boite']))
			{
				$img = getimagesize($row['photo_boite']);
				$x=$img[0]*(150/$img[1]);
			}
			echo '<a rel="nofollow" href="bddjv.php?action=view&id='.$row['id_jeu'].'" rel="lightbox"><img class="cloudcarousel" width="'.$x.'" height="150" src="'.$row['photo_boite'].'" alt="'.$row['nom_jeu'].'" title="'.$row['nom_jeu'].'" /></a>';
		}
   echo ' </div></center>
    
    <!-- Define left and right buttons. -->
    <center>
    <input id="slider-left-but" type="button" value="" />
    <input id="slider-right-but" type="button" value="" />
    </center>
</div>
<div id="templatemo_main">
			
			<div class="col one_third fp_services">
			<h2>Bienvenue !</h2>
				<img src="images/welcome.png" alt="Bienvenue" class="image_fl" />
				<p>Bienvenue sur Collectible Games ! Ici, vous pourrez vous renseigner sur certaines versions de jeux vidéos, vous pourrez gérer votre collection et vous pourrez partager votre passion sur le forum. D\'autres surprises vous attendent !</p>
				<ul class="templatemo_list">
					<li class="flow"> </li>
					<li class="flow nomr"> </li>
					<li class="flow"> </li>
					<li class="flow nomr"> </li>
				</ul>
			</div>
			<div class="col one_third fp_services">
				<h2>Les News</h2>
				<div class="rp_pp">
					<img src="images/templatemo_image_02.png" alt="News 02" />
					<a href="#">Les albums photos arrivent sur Collectible Games !</a>
					<p>Samedi 1er Mars 2014</p>
					<div class="cleaner"></div>
				</div>
				<div class="rp_pp">
					<img src="images/templatemo_image_01.png" alt="News 01" />
					<a href="#">Le projet est lancé !</a>
					<p>Dimanche 16 Février 2014</p>
					<div class="cleaner"></div>
				</div>
			</div>
			<div class="col one_third no_margin_right fp_services">
				
				<h2>Aidez nous !</h2>
				<div class="rp_pp">
					<img src="images/emrald_1.png" alt="Help 03" />
					Vous connaissez bien les jeux, les consoles ou les accessoires ? Alors aidez nous à remplir nos bases de données en ajoutant vous même des jeux, des packs ou des accessoires et en complétant nos informations.
					<div class="cleaner"></div>
				</div>
				<div class="rp_pp">
					<img src="images/emrald_2.png" alt="Help 03" />
					Vous avez des idées, vous pensez que ce serait mieux avec ceci ou cela ? N\'hésitez pas à nous faire part de toutes vos idées grâce à la page de suggestions. Si l\'idée nous intéresse, elle pourrait bien se retrouver sur le site ! ;)
					<div class="cleaner"></div>
				</div>
			</div>
			<div class="cleaner"></div>
		</div> <!-- END of templatemo_main -->';
print_footer();
?>