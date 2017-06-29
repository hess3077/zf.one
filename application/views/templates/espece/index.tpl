<div id="animal">
	<h2><i class="list layout icon"></i> Liste des espèces</h2>

	<table id="DataTable" class="ui selectable celled table">
		<thead>
		<tr>
			<th>ID</th>
			<th>Nom courant</th>
			<th>Nom Latin</th>
			<th>Description</th>
			<th>Prix</th>
		</tr>
		</thead>
		<tbody>
		{foreach from=$this->especes item=espece}
			<tr>
				<td>{$espece->id}</td>
				<td>{$espece->nom_courant}</td>
				<td>{$espece->nom_latin}</td>
				<td>{$espece->description}</td>
				<td>{$espece->prix}</td>
			</tr>
		{/foreach}
		</tbody>
	</table>
</div>