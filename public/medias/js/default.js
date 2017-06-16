$(document).ready(function() {
    $('#DataTable').DataTable({
        'language': translationFrDataTable(),
        "lengthMenu": [[10], [5, 15, 30, "All"]]
    });
});

function translationFrDataTable(){
    var output = [];
    output = {
        "sProcessing":     "Traitement en cours...",
        "sSearch":         "Rechercher :",
        "sLengthMenu":     "Afficher _MENU_ éléments",
        "sInfo":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
        "sInfoEmpty":      "Affichage de l'élément 0 &agrave; 0 sur 0 élément",
        "sInfoFiltered":   "(filtré de _MAX_ éléments au total)",
        "sInfoPostFix":    "",
        "sLoadingRecords": "Chargement en cours...",
        "sZeroRecords":    "Aucun élément à afficher",
        "sEmptyTable":     "Aucune donnée disponible dans le tableau",
        "oPaginate": {
            "sFirst":      "Premier",
            "sPrevious":   "Précédent",
            "sNext":       "Suivant",
            "sLast":       "Dernier"
        },
        "oAria": {
            "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
            "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
        }
    };

    return output;
}