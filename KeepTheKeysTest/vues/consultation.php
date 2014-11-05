<form action="index.php?vue=consultationClef&action=Affichage" method="POST">
	<table>
		<tr>
			<td>
				Rechercher Par :
			</td>
		</tr>
		<tr>
			<td>
				Logiciel : <?php echo $_SESSION['listeLogiciel']; ?>
			</td>
		</tr>
		<tr>
			<td>
				Professeur : <?php echo $_SESSION['listeProfesseur']; ?>
			</td>
		</tr>
		<tr>
			<td>
				<input type='submit' name="Envoyer">
			</td>
		</tr>
	</table>

</form>