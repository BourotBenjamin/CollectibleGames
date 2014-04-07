<?php

 
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

if(isset($_POST["validerAjoutBug"]))
{
	$headeralerts = $headeralerts.ajoutBug();
}
print_header(null, $headeralerts, null, $user, 1);

		$page = '<div id="templatemo_slider">
			<br><div class="titreBlanc">Bugs et Suggestions actuels : </div><br><br>
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="tableConsoles" width="100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Bug</th>
					<th>Type</th>
					<th>Priorité</th>
					<th>Résolu</th>
				</tr>
			</thead>
			<tbody>';
		foreach(Bugtracker::findAll() as $bug)
		{
			if($bug->getAttr('type_bug')!=3)
			{
				if($bug->getAttr('resolu_bug')==1)
				{
					$page=$page.'<tr class="grade0">';
					$priorite='0 : N/A';
				}
				else
				{
					switch($bug->getAttr('priorite_bug'))
					{
						case 0:
							$page=$page.'<tr class="gradeU">';
							$priorite='6 : Inconnu';
							break;
						case 1:
							$page=$page.'<tr class="grade1">';
							$priorite='1 : Basse';
							break;
						case 2:
							$page=$page.'<tr class="grade2">';
							$priorite='2 : Normale';
							break;
						case 3:
							$page=$page.'<tr class="grade3">';
							$priorite='3 : Haute';
							break;
						case 4:
							$page=$page.'<tr class="grade4">';
							$priorite='4 : Urgent';
							break;				
						case 5:
							$page=$page.'<tr class="grade5">';
							$priorite='5 : Critique';
							break;
					}
				}
				$page=$page.'<td class="center"> '.$bug->getAttr('id_bugtracker').' </td>
				<td class="center"> '.$bug->getAttr('description_bug').' </td>
				<td class="center"> '.($bug->getAttr('type_bug')==2?"Bug":"Suggestion").' </td>
				<td class="center"> '.$priorite.' </td>
				<td class="center"> '.($bug->getAttr('resolu_bug')==1?"Oui":"Non").' </td>
				</tr>';
			}
		}
		$page=$page.'</tbody>
		</table>
		<script type="text/javascript">
			$(document).ready(function()  
			{
				$(\'#tableConsoles\').dataTable();
			});
		</script><br><br>
		</div><div id="templatemo_main">
		<br><h1>Proposez une idée / Signalez un bug</h1><br>
		<form action="" method=POST>
		<TEXTAREA NAME="description_bug" ROWS=3 COLS=100 ></TEXTAREA><br>
		<select name="type_bug"><option value=1 >Suggestion</option><option value=2 >Bug</option></select><br>
		<input type=submit name="validerAjoutBug" value="Valider" />
		</form>
		</div> <!-- END of templatemo_main -->';
		echo $page;
		
print_footer();
?>