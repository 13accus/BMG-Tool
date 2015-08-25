var TableData = function () {
    //function to initiate DataTable
    //DataTable is a highly flexible tool, based upon the foundations of progressive enhancement, 
    //which will add advanced interaction controls to any HTML table
    //For more information, please visit https://datatables.net/
	
    var runDataTable = function () {
        
        $('#sample_1_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
        // modify table search input
        $('#sample_1_wrapper .dataTables_length select').addClass("m-wrap small");
        // modify table per page dropdown
        $('#sample_1_wrapper .dataTables_length select').select2();
        // initialzie select2 dropdown
        $('#sample_1_column_toggler input[type="checkbox"]').change(function () {
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });
    };
    
    var runEditableTable = function(){
    	
    	var newRow = false;
		var actualEditingRow = null;

		function restoreRow(oTable, nRow) {
			var aData = oTable.fnGetData(nRow);
			var jqTds = $('>td', nRow);

			for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
				oTable.fnUpdate(aData[i], nRow, i, false);
			}

			oTable.fnDraw();
		}

		function editRow(oTable, nRow) {
			var aData = oTable.fnGetData(nRow);
			var jqTds = $('>td', nRow);
			var selector;
			var options = ""
			
			$.ajax({
				  url: '/api/catalog/socialNetwork',
				  async: false,
				  dataType: 'json',
				  success: function (data) {
					  $.each(data, function(key, element) {
						  if(aData[0]==element.socialNetworkName) options = options + "<option value=\"" + element.socialNetworkName + "\" selected=\"selected\">" + element.socialNetworkName + "</option>";
						  else options = options + "<option value=\"" + element.socialNetworkName + "\">" + element.socialNetworkName + "</option>";
						 
						  				  
					  });					  
				  }
				});
			
			selector = "<select size=\"1\" id=\"socialNetwork_list\" name=\"socialNetwork_list\" aria-controls=\"sample_2\" class=\"form-control\" tabindex=\"-1\">" + options + "</select>";
			
			jqTds[1].innerHTML = '<input type="text" id="userSocialNetworkAccount" name="userSocialNetworkAccount" >';
			jqTds[0].innerHTML = selector;
			jqTds[2].innerHTML = '<a class="save-row" href="">Save</a>';
			jqTds[3].innerHTML = '<a class="cancel-row" href="">Cancel</a>';

		}

		function saveRow(oTable, nRow) {
			var jqSelect = $('select', nRow);
			var jqInputs = $('input', nRow);
			oTable.fnUpdate(jqInputs[0].value, nRow, 1, false);
			oTable.fnUpdate(jqSelect.eq(0).val(), nRow, 0, false);
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
		$('#sample_2').on('click', '.cancel-row', function(e) {

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
		$('#sample_2').on('click', '.delete-row', function(e) {
			e.preventDefault();
			if (newRow && actualEditingRow) {
				oTable.fnDeleteRow(actualEditingRow);
				newRow = false;

			}
			var nRow = $(this).parents('tr')[0];
			//var userSocialNetworkAccountValue = $(nRow).find('td').first().html();
			var socialNetworkName = $(nRow).find('td').first().html();
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
		    			data: { "action":"deleteUserSocialNetworkLink","apikey":"thisismyapikey","socialNetworkName":socialNetworkName },
		    	        success : function(json) {
		    				var response = JSON.parse(json);
		    				console.log(response);
		    				$.unblockUI();
							if (response.say == "ok") {
								oTable.fnDeleteRow(nRow);
							}		
							
		    			}
		    		});	
					
				}
			});
			

			
		});
		$('#sample_2').on('click', '.save-row', function(e) {
			e.preventDefault();

			var nRow = $(this).parents('tr')[0];
			var jqInputs = $('input', nRow);		
			var jqSelect = $('select', nRow);
			
			userSocialNetworkAccountValue = jqInputs[0].value;
			socialNetworkName = jqSelect.eq(0).val();
			
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
		    			data: { "action":"addUserSocialNetworkLink","apikey":"thisismyapikey","userSocialNetworkAccount":userSocialNetworkAccountValue,"socialNetworkName":socialNetworkName  },
		    	        success : function(json) {
		    				var response = JSON.parse(json);
		    				console.log(response);
		    				$.unblockUI();
							
							if (response.say == "ok") {
								saveRow(oTable, nRow);
							}		
							
		    			}
		    		});	
						
		});
		
		$('#sample_2').on('click', '.edit-row', function(e) {
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
			
			console.log(nRow);
			
			var jqSelect = $('select', nRow);
			
			socialNetworkName = jqSelect.val();
			
			editRow(oTable, nRow);
			actualEditingRow = nRow;

		});
		var oTable = $('#sample_2').dataTable({
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
		$('#sample_2_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
		// modify table search input
		$('#sample_2_wrapper .dataTables_length select').addClass("m-wrap small");
		// modify table per page dropdown
		$('#sample_2_wrapper .dataTables_length select').select2();
		// initialzie select2 dropdown
		$('#sample_2_column_toggler input[type="checkbox"]').change(function() {
			/* Get the DataTables object again - this is not a recreation, just a get of the object */
			var iCol = parseInt($(this).attr("data-column"));
			var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
			oTable.fnSetColumnVis(iCol, ( bVis ? false : true));
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