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
});
