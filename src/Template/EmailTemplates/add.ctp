<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Email management</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="<?= $this->Url->build([ 'controller' => 'Dashboard', 'action' => 'index']) ?>">Home</a></li>
                <li><a href="#">Settings Master</a></li>
                <li class="active">Add Template</li>
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
                    <?= $this->Form->create(null, ['class' => 'form-validate-jquery form-horizontal', 'id' => 'frm_main', 'name' => 'frm_main', 'url' => '/email-templates/add']) ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Add Template</h5>
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
                                            <?= $this->Form->text("name", ['length' => 50, 'maxlength' => 50, "required" => true, 'class' => 'form-control']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Content</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->textarea("content", ["required" => false, 'class' => 'wysihtml5 wysihtml5-default form-control']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Pre-defined tags</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('tags', $tags, ['empty' => 'Select tag', "required" => false, 'class' => 'select']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Status<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('status', [1 => "Active", 0 => "Inactive"], ['id' => 'status', 'empty' => 'Select status', 'required' => true, 'class' => 'select']) ?>
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
<script type="text/javascript" src="<?php echo $this->Url->build('/js/EmailTemplates/add.js', ['fullBase' => true]) ?>"></script>
<script>
    $(function () {
        // Default initialization
        $('.wysihtml5-default').wysihtml5({
            parserRules: wysihtml5ParserRules,
            stylesheets: ["<?= $this->Url->build('/assets/css/components.css', ['fullBase' => true]) ?>"]
        });
    });
</script>