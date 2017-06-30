<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">User management</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="<?= $this->Url->build([ 'controller' => 'Dashboard', 'action' => 'index']) ?>">Home</a></li>
                <li><a href="<?= $this->Url->build([ 'controller' => 'Dashboard', 'action' => 'users']) ?>">User Master</a></li>
                <li class="active">Add User</li>
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
                    <?= $this->Form->create(null, ['class' => 'form-validate-jquery form-horizontal', 'id' => 'frm_main', 'name' => 'frm_main', 'url' => '/users/add']) ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Add User</h5>
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
                                        <label class="col-lg-3 control-label">Photograph</label>
                                        <div class="col-lg-4">
                                            <input type="file" class="file-input" data-show-caption="false" data-show-upload="false" data-browse-class="btn btn-primary" data-remove-class="btn btn-default">
                                            <span class="help-block">Only <code>jpg</code>, <code>gif</code> and <code>png</code> extensions are allowed.</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Firstname<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->text("firstname", ['length' => 255, 'maxlength' => 255, "required" => true, 'class' => 'form-control']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Lastname<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->text("lastname", ['length' => 255, 'maxlength' => 255, "required" => true, 'class' => 'form-control']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Mobile<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->text("mobile", ['length' => 10, 'maxlength' => 10, "required" => true, 'class' => 'form-control']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Email<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->email("email", ['length' => 255, 'maxlength' => 255, "required" => true, 'class' => 'form-control']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">PAN<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->text("pan", ['length' => 10, 'maxlength' => 10, "required" => true, 'class' => 'form-control']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">AADHAR<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->text("aadhar", ['length' => 12, 'maxlength' => 12, "required" => true, 'class' => 'form-control']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Type</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('type', ['broker' => "Broker", 'builder' => "Builder", 'other' => 'Other'], ['empty' => 'Select type', 'id' => 'type', "required" => true, 'class' => 'select']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">RERA</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->text("rera", ['length' => 50, 'maxlength' => 50, "required" => false, 'class' => 'form-control']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Group<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('group_id', $groups, ['empty' => 'Select group', 'id' => 'group_id', "required" => true, 'class' => 'select']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Comments</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->textarea("comments", ['length' => 1024, 'maxlength' => 1024, "required" => false, 'class' => 'form-control']) ?>
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
<script type="text/javascript" src="<?php echo $this->Url->build('/js/Users/add.js', ['fullBase' => true]) ?>"></script>