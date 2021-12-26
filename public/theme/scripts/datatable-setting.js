$('document').ready(function(){
	
	var table = $('.checkbox-datatable').DataTable({
		'scrollCollapse': true,
		'autoWidth': false,
		'responsive': true,
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		"language": {
			"info": "_START_-_END_ of _TOTAL_ entries",
			searchPlaceholder: "Search",
			paginate: {
				next: '<i class="ion-chevron-right"></i>',
				previous: '<i class="ion-chevron-left"></i>'  
			}
		},
		'columnDefs': [{
			'targets': 0,
			'searchable': false,
			'orderable': false,
			'className': 'dt-body-center',
			'render': function (data, type, full, meta){
				return '<div class="dt-checkbox"><input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '"><span class="dt-checkbox-label"></span></div>';
			}
		}],
		'order': [[1, 'asc']]
	});
	var checkedvalues = table.$('input:checked').map(function () {
		return this.value;
		}).get();
		if(checkedvalues.length > 0){
			$('#deleteRows').show();
		}else{
			$('#deleteRows').hide();
		}
	$('#deleteRows').click( function () {
		var checkedvalues = table.$('input:checked').map(function () {
			return this.value;
			}).get();
			$('#delete_selected input[name="ids"]').val(checkedvalues);
		$('#delete_selected').submit();
    } );
	$('#example-select-all').on('click', function(){
		var rows = table.rows({ 'search': 'applied' }).nodes();
		$('input[type="checkbox"]', rows).prop('checked', this.checked);
		var checkedvalues = table.$('input:checked').map(function () {
			return this.value;
			}).get();
			if(checkedvalues.length > 0){
				$('#deleteRows').show();
			}else{
				$('#deleteRows').hide();
			}
	});

	$('.checkbox-datatable tbody').on('change', 'input[type="checkbox"]', function(){
		var checkedvalues = table.$('input:checked').map(function () {
			return this.value;
			}).get();
			if(checkedvalues.length > 0){
				$('#deleteRows').show();
			}else{
				$('#deleteRows').hide();
			}
		if(!this.checked){
			var el = $('#example-select-all').get(0);
			if(el && el.checked && ('indeterminate' in el)){
				el.indeterminate = true;
			}
		}
	});
});