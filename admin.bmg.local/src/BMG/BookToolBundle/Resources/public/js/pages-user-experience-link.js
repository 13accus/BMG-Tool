var TableData = function () {
    //function to initiate DataTable
    //DataTable is a highly flexible tool, based upon the foundations of progressive enhancement, 
    //which will add advanced interaction controls to any HTML table
    //For more information, please visit https://datatables.net/
	
    var runDataTable = function () {
    };
    
    var runEditableTable = function(){
    	
    	var newRow = false;
		var actualEditingRow = null;

		function restoreRow(oTable, nRow) {
			var aData_experience = oTable.fnGetData(nRow);
			var jqTds_experience = $('>td', nRow);

			for (var i = 0, iLen = jqTds_experience.length; i < iLen; i++) {
				oTable.fnUpdate(aData_experience[i], nRow, i, false);
			}

			oTable.fnDraw();
		}

		function editRow(oTable, nRow) {
			var aData_experience = oTable.fnGetData(nRow);
			var jqTds_experience = $('>td', nRow);
			var selector;
			var options = ""
			
			$.ajax({
				  url: '/api/catalog/experience',
				  async: false,
				  dataType: 'json',
				  success: function (data) {
					  $.each(data, function(key, element) {
						 
						  editCell = aData_experience[0];
						  
						  if(aData_experience[0]==element.experienceName) options = options + "<option value=\"" + element.experienceName + "\" selected=\"selected\">" + element.experienceName + "</option>";
						  else options = options + "<option value=\"" + element.experienceName + "\">" + element.experienceName + "</option>";
					  });					  
				  }
				});
			
			selector = "<select size=\"1\" id=\"experience_list\" name=\"experience_list\" aria-controls=\"aria_experience\" class=\"form-control\" tabindex=\"-1\">" + options + "</select>";
			
			jqTds_experience[0].innerHTML = selector;
			jqTds_experience[1].innerHTML = '<input type="text" id="rate" name="rate" >';
			jqTds_experience[2].innerHTML = '<a class="save-row" href="">Save</a>';
			jqTds_experience[3].innerHTML = '<a class="cancel-row" href="">Cancel</a>';

		}

		function saveRow(oTable, nRow) {
			var jqSelect_experience = $('select', nRow);
			var jqInputs_experience = $('input', nRow);
			oTable.fnUpdate(jqSelect_experience.eq(0).val(), nRow, 0, false);
			oTable.fnUpdate(jqInputs_experience[0].value, nRow, 1, false);
			oTable.fnUpdate('<a class="edit-row" href="">Edit</a>', nRow, 2, false);
			oTable.fnUpdate('<a class="delete-row" href="">Delete</a>', nRow, 3, false);
			oTable.fnDraw();
			newRow = false;
			actualEditingRow = null;
		}

		$('body').on('click', '.add-row', function(e) {
			e.preventDefault();
			if (newRow == false) {
				if (actualEditingRow) {
					restoreRow(oTable, actualEditingRow);
				}
				newRow = true;
				var aiNew = oTable.fnAddData(['', '', '', '', '']);
				var nRow = oTable.fnGetNodes(aiNew[0]);
				editRow(oTable, nRow);
				actualEditingRow = nRow;
			}
		});
		$('#aria_experience').on('click', '.cancel-row', function(e) {

			e.preventDefault();
			if (newRow) {
				newRow = false;
				actualEditingRow = null;
				var nRow = $(this).parents('tr')[0];
				oTable.fnDeleteRow(nRow);

			} else {
				restoreRow(oTable, actualEditingRow);
				actualEditingRow = null;
			}
		});
		$('#aria_experience').on('click', '.delete-row', function(e) {
			e.preventDefault();
			if (newRow && actualEditingRow) {
				oTable.fnDeleteRow(actualEditingRow);
				newRow = false;

			}
			var nRow = $(this).parents('tr')[0];
			var experienceValue = $(nRow).find('td').first().html();
			//var rate = $(nRow).find('td').first().html();
			bootbox.confirm("Are you sure to delete this row?", function(result) {
				if (result) {
					$.blockUI({
					message : '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
					});

					$.mockjax({
						url : '/tabledata/delete/webservice',
						dataType : 'json',
						responseTime : 1000,
						responseText : {
							say : 'ok'
						}
					});
					
					$.ajax({
		    			url: "/api",
		    			data: { "action":"deleteUserExperienceLink","apikey":"thisismyapikey","experience":experienceValue},
		    	        success : function(json) {
		    				var response = JSON.parse(json);
		    				$.unblockUI();
							if (response.say == "ok") {
								oTable.fnDeleteRow(nRow);
							}		
							
		    			}
		    		});	
					
				}
			});
			

			
		});
		$('#aria_experience').on('click', '.save-row', function(e) {
			e.preventDefault();

			var nRow = $(this).parents('tr')[0];
			var jqInputs_experience = $('input', nRow);		
			var jqSelect_experience = $('select', nRow);
			
			experienceValue = jqSelect_experience.eq(0).val();
			rate = jqInputs_experience[0].value;
			
			$.blockUI({
					message : '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
					});
					$.mockjax({
						url : '/tabledata/add/webservice',
						dataType : 'json',
						responseTime : 1000,
						responseText : {
							say : 'ok'
						}
					});
					$.ajax({
						url: "/api",
		    			data: { "action":"addUserExperienceLink","apikey":"thisismyapikey","experience":experienceValue,"userExperienceLinkRate":rate },
		    	        success : function(json) {
		    				var response = JSON.parse(json);
		    				$.unblockUI();
							
		    				if (response.say == "ok") {
								saveRow(oTable, nRow);
								if(editClicked)
								{
									$.ajax({
										url: "/api",
						    			data: { "action":"deleteUserExperienceLink","apikey":"thisismyapikey","experience":editCell},
						    	        success : function(json) {
						    				var response = JSON.parse(json);
						    		    															
											if (response.say == "ok") {
												$.unblockUI();
											}		
											
						    			}
						    					    					    			
						    		});	
									editClicked = false;
									editCell = null;
								}else
								{
									$.unblockUI();
								}
							}		
		    			}
		    		});	
						
		});
		
		$('#aria_experience').on('click', '.edit-row', function(e) {
			e.preventDefault();
			
			if (actualEditingRow) {
				if (newRow) {
					oTable.fnDeleteRow(actualEditingRow);
					newRow = false;
				} else {
					restoreRow(oTable, actualEditingRow);
				}
			}
			
			var nRow = $(this).parents('tr')[0];
			var jqSelect_experience = $('select', nRow);
			
			experienceValue = jqSelect_experience.val();
			
			editClicked = true;
			
			editRow(oTable, nRow);
			actualEditingRow = nRow;

		});
		var oTable = $('#aria_experience').dataTable({
			"aoColumnDefs" : [{
				"aTargets" : [0]
			}],
			"oLanguage" : {
				"sLengthMenu" : "Show _MENU_ Rows",
				"sSearch" : "",
				"oPaginate" : {
					"sPrevious" : "",
					"sNext" : ""
				}
			},
			"aaSorting" : [[1, 'asc']],
			"aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
			],
			// set the initial value
			"iDisplayLength" : 10,
		});
    	
    };
    
    
    
    return {
        //main function to initiate template pages
        init: function () {
            runDataTable();
            runEditableTable();
        }
    };
}();