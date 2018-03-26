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

        $( function() {
                $( "#stat_by_redmine_from" ).datepicker({
                        defaultDate: "-5d",
                        constrainInput: true,
                        maxDate: "0",
                        showOtherMonths: true,
                });
        });
        $( function() {
                $( "#stat_by_redmine_to" ).datepicker({
                        defaultDate: null,
                        constrainInput: true,
                        maxDate: "0",
                        showOtherMonths: true,
                });
        });

        $( function() {
                $( "#sla_by_severity_from" ).datepicker({
                        defaultDate: "-5d",
                        constrainInput: true,
                        maxDate: "0",
                        showOtherMonths: true,
                });
        });
        $( function() {
                $( "#sla_by_severity_to" ).datepicker({
                        defaultDate: null,
                        constrainInput: true,
                        maxDate: "0",
                        showOtherMonths: true,
                });
        });


	$( function() {
		$('#summary_by_severity').change(function(){
			$('#summary_by_severity_form').submit();
		});
	});

	$( function() {
		$('#show_filetered_issues').click(function(){
	                var darkLayer = document.createElement('div'); // слой затемнения
                        var closeBtn = document.getElementById('close_modal_win');
                        var submitBtn = document.getElementById('submit_modal_win');
                        darkLayer.id = 'shadow'; // id чтобы подхватить стиль
                        document.body.appendChild(darkLayer); // включаем затемнение

                        var modalWin = document.getElementById('popupWin'); // находим наше "окно"
                        modalWin.style.display = 'block'; // "включаем" его

                        darkLayer.onclick = function () {  // при клике на слой затемнения все исчезнет
        	                darkLayer.parentNode.removeChild(darkLayer); // удаляем затемнение
                	        modalWin.style.display = 'none'; // делаем окно невидимым
                        	return false;
                        };

                        closeBtn.onclick = function () {  // при клике на слой затемнения все исчезнет
	                        darkLayer.parentNode.removeChild(darkLayer); // удаляем затемнение
                                modalWin.style.display = 'none'; // делаем окно невидимым
        	                return false;
                        };
		});
	});
} );

addEventListener("submit", function (event){
	var bugnoteText = document.getElementsByName("bugnote_text")[0].value;
	if( bugnoteText != "" ) {
		if( ( event.target.id != "bugnoteadd" ) &&
		    ( event.target.id != "update_bug_form" ) &&
		    ( !( document.URL.indexOf( 'bugnote_edit_page.php' ) +1 ) ) &&
		    ( event.target.id != "bug-change-status-form" ) ) {
			alert( "Пожалуйста, сохраните комментарий прежде, чем продолжить!" );
//                        alert( event.target.id );
			event.preventDefault();
			return false;
		};
	}
	if ( event.target.id == "bug-change-status-form" ){
		var selectedValue = $("#resolution option:selected").val();
		if( selectedValue == 10 ){ //"открыта"
			alert( "Пожалуйста выберите корректный результат" );
			event.preventDefault();
			return false;
		};
	}
	return true;
});
