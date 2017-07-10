<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Permission management</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="<?= $this->Url->build([ 'controller' => 'Dashboard', 'action' => 'index']) ?>">Home</a></li>
                <li><a href="<?= $this->Url->build([ 'controller' => 'Dashboard', 'action' => 'users']) ?>">User Master</a></li>
                <li class="active">Group Permissions</li>
            </ul>
        </div>
    </div>
</div>
<!-- /page header -->
<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Table tree -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Table tree</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    The following example demonstrates rendered tree as a table (aka tree grid) and support keyboard navigation in a grid with embedded input controls. Table functionality is based on Fancytree's <code>table.js</code> extension. The tree table extension takes care of rendering the node into one of the columns. Other columns have to be rendered in the <code>renderColumns</code> event.  
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered tree-table">
                        <thead>
                            <tr>
                                <th style="width: 46px;"></th>
                                <th style="width: 80px;">#</th>
                                <th>Items</th>
                                <th style="width: 80px;">Create</th>
                                <th style="width: 80px;">Read</th>
                                <th style="width: 80px;">Update</th>
                                <th style="width: 80px;">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /table tree -->
        </div>
    </div>
</div>
<script>
    $(function () {
        //
        // Table tree
        //

        $(".tree-table").fancytree({
            extensions: ["table"],
            checkbox: true,
            table: {
                indentation: 20, // indent 20px per node level
                nodeColumnIdx: 2, // render the node title into the 2nd column
                checkboxColumnIdx: 0  // render the checkboxes into the 1st column
            },
            source: {
                type: 'post',
                url: "<?= $this->Url->build([ 'controller' => 'Permissions', 'action' => 'group']) ?>"
            },
            renderColumns: function (event, data) {
                console.log(data);
                var node = data.node,
                        $tdList = $(node.tr).find(">td");

                // (index #0 is rendered by fancytree by adding the checkbox)
                $tdList.eq(1).text(node.getIndexHier()).addClass("alignRight");

                // (index #2 is rendered by fancytree)
                $tdList.eq(3).addClass('text-center').html("<input type='checkbox' " + node.data._create + " class='styled' name='_create' value='" + node.key + "'>");
                $tdList.eq(4).addClass('text-center').html("<input type='checkbox' " + node.data._read + " class='styled' name='_read' value='" + node.key + "'>");
                $tdList.eq(5).addClass('text-center').html("<input type='checkbox' " + node.data._update + " class='styled' name='_update' value='" + node.key + "'>");
                $tdList.eq(6).addClass('text-center').html("<input type='checkbox' " + node.data._delete + " class='styled' name='_delete' value='" + node.key + "'>");

                // Style checkboxes
                $(".styled").uniform({radioClass: 'choice'});
            }
        });

        // Handle custom checkbox clicks
        $(".tree-table").delegate("input[name=like]", "click", function (e) {
            var node = $.ui.fancytree.getNode(e),
                    $input = $(e.target);
            e.stopPropagation(); // prevent fancytree activate for this row
            if ($input.is(":checked")) {
                alert("like " + $input.val());
            }
            else {
                alert("dislike " + $input.val());
            }
        });
    });
</script>
