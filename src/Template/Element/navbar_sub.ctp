<div class="navbar navbar-default" id="navbar-second">
    <ul class="nav navbar-nav no-border visible-xs-block">
        <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
    </ul>

    <div class="navbar-collapse collapse" id="navbar-second-toggle">
        <ul class="nav navbar-nav">
            <li class="active"><a href="<?= $this->Url->build([ 'controller' => 'Dashboard', 'action' => 'index']) ?>"><i class="icon-display4 position-left"></i> Dashboard</a></li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-users4 position-left"></i> User Master <span class="caret"></span>
                </a>

                <ul class="dropdown-menu width-250">
                    <li class="dropdown-header">Dashboard</li>
                    <li><a href="<?= $this->Url->build([ 'controller' => 'Dashboard', 'action' => 'users']) ?>"><i class="icon-stats-growth"></i> Users Dashboard</a></li>
                    <li class="dropdown-header">User management</li>
                    <li><a href="<?= $this->Url->build([ 'controller' => 'Users', 'action' => 'add']) ?>"><i class="icon-user-plus"></i> Add User</a></li>
                    <li><a href="<?= $this->Url->build([ 'controller' => 'Users', 'action' => 'index']) ?>"><i class="icon-users2"></i> Manage Users</a></li>
                    <li class="dropdown-header">Group management</li>
                    <li><a href="<?= $this->Url->build([ 'controller' => 'Groups', 'action' => 'add']) ?>"><i class="icon-add-to-list"></i> Add Group</a></li>
                    <li><a href="<?= $this->Url->build([ 'controller' => 'Groups', 'action' => 'index']) ?>"><i class="icon-paragraph-justify2"></i> Manage Groups</a></li>
                    <li class="dropdown-header">Permission management</li>
                    <li><a href="<?= $this->Url->build([ 'controller' => 'Permissions', 'action' => 'user']) ?>"><i class="icon-user-lock"></i> User Permissions</a></li>
                    <li><a href="<?= $this->Url->build([ 'controller' => 'Permissions', 'action' => 'group']) ?>"><i class="icon-indent-increase"></i> Group Permissions</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>