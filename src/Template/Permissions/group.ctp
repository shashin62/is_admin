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
                                <th style="width: 80px;">Key</th>
                                <th style="width: 46px;">Like</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
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
<script type="text/javascript" src="<?php echo $this->Url->build('/js/Permissions/group.js', ['fullBase' => true]) ?>"></script>
