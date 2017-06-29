<div id="animal">
	<h2><i class="list layout icon"></i> Liste d'animaux</h2>

	<table id="DataTable" class="ui selectable celled table">
		<thead>
		<tr>
			<th>ID</th>
			<th>Sexe</th>
			<th>Date de naissance</th>
			<th>Nom</th>
			<th>Commentaires</th>
			<th>Espèce</th>
			<th>Race</th>
			<th>Mère</th>
			<th>Père</th>
		</tr>
		</thead>
		<tbody>
		{foreach from=$this->animals item=animal}
			<tr>
				<td>{$animal->id}</td>
				<td><i class="{if $animal->sexe=='M'}man{else}woman{/if} icon"></i></td>
				<td>{$animal->date_naissance}</td>
				<td>{$animal->nom}</td>
				<td>{$animal->commentaires}</td>
				<td>{$animal->espece_id}</td>
				<td>{$animal->race_id}</td>
				<td>{$animal->mere_id}</td>
				<td>{$animal->pere_id}</td>
			</tr>
		{/foreach}
		</tbody>
	</table>
</div>