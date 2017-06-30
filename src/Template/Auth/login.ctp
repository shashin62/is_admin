<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Simple login form -->
            <?= $this->Form->create(null, ['class' => 'login-form form-validate-jquery', 'id' => 'frm_login', 'name' => 'frm_login', 'url' => '/auth/login']) ?>
            <div class="panel panel-body login-form">
                <div class="text-center">
                    <div class="icon-object border-slate-300 text-slate-300"><i class="icon-lock"></i></div>
                    <h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
                </div>

                <div class="form-group has-feedback has-feedback-left">
                    <?= $this->Form->text("email", ["required" => true, "class" => "form-control", "placeholder" => "Email"]) ?>
                    <div class="form-control-feedback">
                        <i class="icon-user text-muted"></i>
                    </div>
                </div>

                <div class="form-group has-feedback has-feedback-left">
                    <?php echo $this->Form->password('password', ["required" => true, "class" => "form-control", "placeholder" => "Password"]); ?>
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button>
                </div>

                <div class="text-center">
                    <a href="<?= $this->Url->build('/Auth/forgot', ['fullBase' => true]); ?>">Forgot password?</a>
                </div>
            </div>
            <?= $this->Form->end() ?>
            <!-- /simple login form -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<script type="text/javascript" src="<?php echo $this->Url->build('/js/Auth/login.js', ['fullBase' => true]) ?>"></script>