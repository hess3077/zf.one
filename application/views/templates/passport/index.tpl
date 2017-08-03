<div id="passport">
	<h2><i class="list layout icon"></i> Liste des Agents</h2>

	<table id="DataTable" class="ui selectable celled table">
		<thead>
		<tr>
			<th>ID</th>
			<th>Identité</th>
			<th>Age</th>
		</tr>
		</thead>
		<tbody>
		{foreach from=$this->agents item=agent}
			<tr>
				<td>{$agent->id}</td>
				<td>{$agent->name}</td>
				<td>{$agent->old}</td>
			</tr>
		{/foreach}
		</tbody>
	</table>
</div>