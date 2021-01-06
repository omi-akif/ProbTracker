$(document).ready(function(){
	$('#prob_table').Tabledit({
		deleteButton: false,
		editButton: false,   		
		columns: {
		  identifier: [0, 'id'],                    
		  editable: [[10, 'solution']]
		},
		hideIdentifier: true,
		url: 'edit.php'
	});
});
