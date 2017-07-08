$(document).ready( function (){
	$("#actionTop").change( function(){
		var selectedValue = $("#actionTop option:selected").val();
		var selectedText = $("#actionTop option:selected").text();
		$("#actionBottom [value=" + selectedValue + "]").attr("selected", "selected");
	});

	$("#actionBottom").change( function(){
		var selectedValue = $("#actionBottom option:selected").val();
		var selectedText = $("#actionBottom option:selected").text();
		$("#actionTop [value=" + selectedValue + "]").attr("selected", "selected");
	});
	
	$( function() {
		$( "#stat_by_project_dp_from" ).datepicker({
			defaultDate: "-5d",
			constrainInput: true,
			maxDate: "0",
			showOtherMonths: true,
		});
	});
	$( function() {
		$( "#stat_by_project_dp_to" ).datepicker({
			defaultDate: null,
			constrainInput: true,
			maxDate: "0",
			showOtherMonths: true,
		});
	});
} );
