{nocache}
<div id="race">
	<h2><i class="list layout icon"></i> Liste des Races</h2>

	<table id="DataTable" class="ui selectable celled table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nom</th>
				<th>ID Espèce</th>
				<th>Description</th>
				<th>Prix</th>
			</tr>
		</thead>
		<tbody>
		{foreach from=$this->races item=race}
			<tr>
				<td>{$race->id}</td>
				<td>{$race->nom}</td>
				<td>{$race->espece_id}</td>
				<td>{$race->description}</td>
				<td>{$race->prix}</td>
			</tr>
		{/foreach}
		</tbody>
	</table>
</div>
{/nocache}