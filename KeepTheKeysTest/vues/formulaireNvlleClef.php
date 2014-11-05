<h3>Ajout d'un nouveau lot de clefs </h3>
<Form Method='POST' action='index.php?vue=ajoutClef&action=validerCreationClef' enctype="multipart/form-data">
	<Table>
		<Tr>
			<Td>
				Fichier : <Input Type="File" Name="fichierXML"/>
			</Td>
		</Tr>
		<tr>
			<TD>
				Voulez vous reserver ce lot de clef :<Input Type="Radio" Name="reserve" Value="Oui"> Oui <Input Type="Radio" Name="reserve" Value="Non" checked> Non
			</TD>
		</tr>
		<Tr>
			<Td align="left">
				<Input Type="Submit" Value="Valider"/>
			</Td>
		</Tr>
	</Table>
</Form>