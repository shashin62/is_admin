<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Aco management</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="<?= $this->Url->build([ 'controller' => 'Dashboard', 'action' => 'index']) ?>">Home</a></li>
                <li><a href="#">Aco Master</a></li>
                <li class="active">Add Aco</li>
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
            <!-- Centered forms -->
            <div class="row">

                <div class="col-md-12">
                    <?= $this->Form->create(null, ['type' => 'file', 'class' => 'form-validate-jquery form-horizontal', 'id' => 'frm_main', 'name' => 'frm_main', 'url' => '/acoMasters/add']) ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Add Aco</h5>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                            <li><a data-action="reload"></a></li>
                                            <li><a data-action="close"></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Title<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->text("aco_title", ['length' => 25, 'maxlength' => 25, "required" => true, 'class' => 'form-control']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Description</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->text("aco_description", ['length' => 1024, 'maxlength' => 1024, "required" => false, 'class' => 'form-control']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Type<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('type', ['0' => "Menu", '1' => "Portlet"], ['empty' => 'Select type', 'id' => 'type', "required" => true, 'class' => 'select']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Parent Id<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->number("parent_id", ["required" => true, 'class' => 'form-control']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Sort order<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->number("sort_order", ["required" => true, 'class' => 'form-control']) ?>
                                        </div>
                                    </div>
                                    <div id="type_div">
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Menu type<span class="menu_type_span text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <?= $this->Form->select("menu_type", ['0' => "Menu header", '1' => "Menu clickable"], ['empty' => 'Select menu type', 'id' => 'menu_type', "required" => false, 'class' => 'select']) ?>
                                            </div>
                                        </div>
                                        <div id="menu_type_div">
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Glyphicon<span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <?= $this->Form->select('glyphicon', $glyphicons, ['empty' => 'Select glyphicon', 'id' => 'glyphicon', "required" => false, 'class' => 'select-icons']) ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Controller<span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <?= $this->Form->text("controller", ['id' => 'controller', 'length' => 255, 'maxlength' => 255, "required" => false, 'class' => 'form-control']) ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Action<span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <?= $this->Form->text("action", ['id' => 'action', 'length' => 255, 'maxlength' => 255, "required" => false, 'class' => 'form-control']) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Status<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('status', [1 => "Active", 0 => "Inactive"], ['id' => 'status', 'empty' => 'Select status', 'required' => true, 'class' => 'select']) ?>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $this->Form->end(); ?>
                </div>
            </div>
        </div>  
    </div>  
</div>
<script type="text/javascript" src="<?php echo $this->Url->build('/js/AcoMasters/add.js', ['fullBase' => true]) ?>"></script>