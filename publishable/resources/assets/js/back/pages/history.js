$(document).ready(function () {

    var tableId = $('#history-table');

    if (tableId.length) {

        var historyTable = tableId.DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            "ajax": {
				"url": 'history/list',
				// "type": "POST"
			},
			//  ajax: 'back/history/list', // route('back.history.list').toString(),
            columns: [
                {data: 'table', name: 'reference_table'},
                {data: 'identifiant', name: 'reference_id', className: 'text-right'},
                {data: 'utilisateur', name: 'actor_id'},
                {data: 'action', name: 'body'},
                {data: 'modification', name: 'body'},
                {data: 'created_at', className: 'text-center'},
               // {data: 'updated_at', className: 'text-center'}, 
            ],
            aoColumnDefs: [
                {
                    "aTargets": [4],
                    "mData": "modification",
                    "mRender": function (data, type, full) {
                        var dataReplace = data.replace(/::/gi,"</li><li>");
                        return '<ul class="mb-0"><li>' + dataReplace +'</li></ul>';
                    }
                }
            ]
        });



        $('#toggle-sidebar').on('click', function() {
            historyTable.responsive.recalc();
        });
    }
});
