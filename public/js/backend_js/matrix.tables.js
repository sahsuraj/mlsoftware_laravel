
$(document).ready(function(){
	
	$('.data-table').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""l>t<"F"fp>',
		 "stripeClasses": [ 'odd-row', 'even-row' ]
	});
	$('#member_export').DataTable( {
    dom: 'Bfrtip',
	"sPaginationType": "full_numbers",
	 "stripeClasses": [ 'odd-row', 'even-row' ],
    buttons: [
				{
					extend: 'excelHtml5',
					text: '<i class="fa fa-file-excel-o"></i> Excel',
					titleAttr: 'Export to Excel',
					title: 'Member Reports',
				},
				{
					extend: 'csvHtml5',
					text: '<i class="fa fa-file-text-o"></i> CSV',
					titleAttr: 'CSV',
					title: 'Member Reports',
				},
				{
					extend: 'pdfHtml5',
					text: '<i class="fa fa-file-pdf-o"></i> PDF',
					titleAttr: 'PDF',
					title: 'Member Reports',
					orientation: 'landscape',
				   customize: function(doc) {
					  doc.defaultStyle.fontSize = 10; //<-- set fontsize to 16 instead of 10 
				   } 
				},
				{
					extend: 'print',
					text: '<i class="fa fa-print"></i> Print',
					exportOptions: {
						columns: ':visible'
					},
					
				}
			],
	 "bJQueryUI": true,
    searching: false
} );
 
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	$('select').select2();
	
	$("span.icon input:checkbox, th input:checkbox").click(function() {
		var checkedStatus = this.checked;
		var checkbox = $(this).parents('.widget-box').find('tr td:first-child input:checkbox');		
		checkbox.each(function() {
			this.checked = checkedStatus;
			if (checkedStatus == this.checked) {
				$(this).closest('.checker > span').removeClass('checked');
			}
			if (this.checked) {
				$(this).closest('.checker > span').addClass('checked');
			}
		});
	});	
});
