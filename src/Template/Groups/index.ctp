<div class="page-container">
    <div class="panel panel-flat">           
        <!--DataTables example-->
        <div id="table-datatables" class="">
            <h4 class="header"><?= __('List Groups') ?></h4>
            <div class="row">
                <div class="col l12 m8 l9">
                    <?= $this->Form->create(null, ['id' => 'frm-example', 'name' => 'frm-example', 'url' => '/groups/bulk']) ?>
                    <div class="row">
                        <div class="input-field col s3">
                            <?= $this->Form->select('bulk_action', [0 => "Activate", 1 => "Inactivate"], ['empty' => 'Select Bulk Action', 'required' => false]) ?>
                        </div>
                        <div class="input-field col s3">
                            <button class="btn cyan waves-effect waves-light" type="submit" name="action">Apply action
                            </button>
                        </div>
                    </div> 
                    <?= $this->Form->end() ?>
                </div>
            </div>
            <div class="row">
                <div class="col l12 m8 l9">
                    <table  class="table datatable-basic table-striped" cellspacing="0">
                        <thead>
                            <tr>
                                <th><input id="check_main"  name="select_all" value="1" type="checkbox" class="filled-in"><label name="select_all" for="check_main">&nbsp;</label></th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Total Users</th>
                                <th>Modified</th>
                                <th>Created</th>
                                <th>Action</th>                            
                            </tr>
                        </thead> 
                        <thead class="filters hide">
                            <tr>
                                <td>&nbsp</td>   
                                <td>Name</td>
                                <td>Description</td>
                                <td>Status</td>
                                <td>&nbsp</td>   
                                <td>Modified</td>
                                <td>Created</td>  
                                <td>&nbsp</td>   
                            </tr>
                        </thead>      
                        <tbody>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Total Users</th>
                                <th>Modified</th>
                                <th>Created</th>
                                <th>Action</th>  
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
        <br>
    </div>

</div>
<style>
    /*    *::-moz-placeholder {
            color: #000 !important;
        }
        table.dataTable.select tbody tr,
        table.dataTable thead th:first-child {
            cursor: pointer;
        }
        #data-table-complex_processing{
            background-color: black !important;
            line-height: 0.5 !important;
        }*/
</style>
<script>
    //
    // Updates "Select all" control in a data table
    //
    function updateDataTableSelectAllCtrl(table) {
        var $table = table.table().node();
        var $chkbox_all = $('tbody input[   type = "checkbox"]', $table);
        var $chkbox_checked = $('tbody input[type = "checkbox"]:checked', $table);
        var chkbox_select_all = $('thead input[name = "select_all"]', $table).get(0);
        // If none of the checkboxes are checked
        if ($chkbox_checked.length === 0) {
            chkbox_select_all.checked = false;
            if ('indeterminate' in chkbox_select_all) {
                chkbox_select_all.indeterminate = false;
            }

            // If all of the checkboxes are checked
        } else if ($chkbox_checked.length === $chkbox_all.length) {
            chkbox_select_all.checked = true;
            if ('indeterminate' in chkbox_select_all) {
                chkbox_select_all.indeterminate = false;
            }

            // If some of the checkboxes are checked
        } else {
            chkbox_select_all.checked = true;
            if ('indeterminate' in chkbox_select_all) {
                chkbox_select_all.indeterminate = true;
            }
        }
    }

    $(document).ready(function () {
        // Array holding selected row IDs
        var rows_selected = [];
        var table = $('.datatable-basic').DataTable({
            "processing": true,
            "serverSide": true,
            'ajax': {
                'url': '<?= $this->Url->build('/groups/index ', ['fullBase' => true]); ?>',
                'type': 'post'
            },
            'columnDefs': [{
                    'targets': 0,
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'width': '1%',
                    'render': function (data, type, full, meta) {
                        return '<input id="check_' + data + '" type="checkbox" class="filled-in"><label class="lbl_check" data-id="' + data + '" for="check_' + data + '" >&nbsp;</label>';
                    }
                },
                {
                    'targets': 4,
                    'searchable': false,
                    'orderable': false
                }, {
                    'targets': 7,
                    'searchable': false,
                    'orderable': false,
                    'render': function (data, type, full, meta) {
                        var action = '<a href="/linkcxo-web/groups/edit/' + data + '">Edit</a>|';
                        if (full[3] === 'Active') {
                            action += '<form name="post_' + data + '" style="display:none;" method="post" action="/linkcxo-web/groups/inactivate/' + data + '">\n\
                                            <input name="_method" value="POST" type="hidden"></form>\n\
                                            <a href="#" onclick="if (confirm(&quot;Are you sure you want to activate this entry?&quot;)) { document.post_' + data + '.submit(); } event.returnValue = false; return false;">Inactivate</a>';
                        }
                        else {
                            action += '<form name="post_' + data + '" style="display:none;" method="post" action="/linkcxo-web/groups/activate/' + data + '">\n\
                                            <input name="_method" value="POST" type="hidden"></form>\n\
                                            <a href="#" onclick="if (confirm(&quot;Are you sure you want to inactivate this entry?&quot;)) { document.post_' + data + '.submit(); } event.returnValue = false; return false;">Activate</a>';
                        }

                        return action;
                    }
                }],
            'order': [[6, 'desc']],
            'rowCallback': function (row, data, dataIndex) {
                // Get row ID
                var rowId = data[0];
                // If row ID is in the list of selected row IDs
                if ($.inArray(rowId, rows_selected) !== -1) {
                    $(row).find('input[type="checkbox"]').prop('checked', true);
                    $(row).addClass('selected');
                }
            }
        });
        // Handle click on checkbox
        $('.datatable-basic tbody').on('click', 'input[type="checkbox"]', function (e) {
            var $row = $(this).closest('tr');
            // Get row data
            var data = table.row($row).data();
            // Get row ID
            var rowId = data[0];
            // Determine whether row ID is in the list of selected row IDs 
            var index = $.inArray(rowId, rows_selected);
            // If checkbox is checked and row ID is not in list of selected row IDs
            if (this.checked && index === -1) {
                rows_selected.push(rowId);
                // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
            } else if (!this.checked && index !== -1) {
                rows_selected.splice(index, 1);
            }

            if (this.checked) {
                $row.addClass('selected');
            } else {
                $row.removeClass('selected');
            }

            // Update state of "Select all" control
            updateDataTableSelectAllCtrl(table);
            // Prevent click event from propagating to parent
            e.stopPropagation();
        });
        // Handle click on "Select all" control
        $('thead input[name="select_all"]', table.table().container()).on('click', function (e) {
            if (this.checked) {
                $('#data-table-complex tbody input[type="checkbox"]:not(:checked)').trigger('click');
            } else {
                $('#data-table-complex tbody input[type="checkbox"]:checked').trigger('click');
            }

            // Prevent click event from propagating to parent
            e.stopPropagation();
        });
        // Handle table draw event
        table.on('draw', function () {
            // Update state of "Select all" control
            updateDataTableSelectAllCtrl(table);
        });
        // Handle form submission event 
        $('#frm-example').on('submit', function (e) {
            var form = this;
            // Iterate over all selected checkboxes
            $.each(rows_selected, function (index, rowId) {
                // Create a hidden element 
                $(form).append(
                        $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'id[]')
                        .val(rowId)
                        );
            });
        });


        var ignore = [0, 4, 7];
        var type = [];
        type[3] = 'select';
        createFilters($(".datatable-basic"), ignore, type);


//        // Setup - add a text input to each footer cell
//        var colIdx = 0;
//        $('#data-table-complex .filters td').each(function () {
//            // ignore search for action column #141202277
//            if (colIdx !== 7 && colIdx !== 0 && colIdx !== 4) {
//                var title = $('#data-table-complex thead td').eq($(this).index()).text();
//                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
//            }
//            colIdx++;
//        });
//        // DataTable
//        var table = $('#data-table-complex').DataTable();
//        // Apply the search
//        table.columns().eq(0).each(function (colIdx) {
//            $('input', $('.filters td')[colIdx]).on('keyup change', function () {
//                table
//                        .column(colIdx)
//                        .search(this.value)
//                        .draw();
//            });
//        });
    });


    //table is the jquery table object
    //ignore is array of indexes to ignore filters
    //type is array of values viz. (text/select) with indexes corresponding to column index
    function createFilters(table, ignore, type) {
        var colIdx = 0;
        table.find('.filters td').each(function () {
            // ignore search for action column #141202277
            if (ignore.indexOf(colIdx) === -1) {
                var title = $('#data-table-complex thead td').eq($(this).index()).text();
                switch (type[colIdx]) {
                    case 'text':
                        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
                        break;
                    case 'select':
                        $(this).html('<select><option value="">Search</option><option value="1">Active</option><option value="0">Inactive</option></select>');
                        break;
                    default:
                        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
                        break;
                }
            }
            colIdx++;
        });

        var dataTable = table.DataTable();
        // Apply the search
        dataTable.columns().eq(0).each(function (colIdx) {
            $('input, select', $('.filters td')[colIdx]).on('keyup change', function () {
                dataTable
                        .column(colIdx)
                        .search(this.value)
                        .draw();
            });
        });
    }

</script>