<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Group management</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="<?= $this->Url->build([ 'controller' => 'Dashboard', 'action' => 'index']) ?>">Home</a></li>
                <li><a href="<?= $this->Url->build([ 'controller' => 'Dashboard', 'action' => 'users']) ?>">User Master</a></li>
                <li class="active">Add Group</li>
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
                    <?= $this->Form->create(null, ['class' => 'form-validate-jquery form-horizontal']) ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Add Group</h5>
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
                                        <label class="col-lg-3 control-label">Name<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->text("name", ['length' => 255, 'maxlength' => 255, "required" => true, 'class' => 'form-control']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Description</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->textarea("description", ['length' => 1024, 'maxlength' => 1024, "required" => false, 'class' => 'form-control']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Status<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('status', [1 => "Active", 0 => "Inactive"], ['empty' => 'Select status', 'required' => true, 'class' => 'select']) ?>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
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
<script type="text/javascript" src="<?php echo $this->Url->build('/js/Groups/add.js', ['fullBase' => true]) ?>"></script>