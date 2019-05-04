<div class="setting_title">
    <h2><?php echo __('Users List'); ?></h2>
</div>
<br><br>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <?php echo $this->Form->create('User', array('type'=>'get')) ?>
            <?php echo $this->Form->hidden('page', array('value' => $page)) ?>
            <div class="form-group">
                <?php echo $this->Form->input('name_like', array(
                        'class' => 'form-control', 'label' => __('Search by name'), 'required' => false, 'value' => $name
                )) ?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('email_like', array(
                        'class' => 'form-control', 'label' => __('Search by email'), 'required' => false, 'value' => $email
                )) ?>
            </div>
            <div class="form-group">
                <label for="UserUserTypeCd">User type</label>
                <?php echo $this->Form->select('user_type_cd', array(1 => 'Sponsor', 2=>'Sponsee'), array(
                        'class' => 'form-control', 'label' => __('User type'), 'required' => false, 'empty' => 'All',
                        'value' => $type
                )) ?>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="btn-search-user"><?php echo __('Search'); ?></button>
                <button type="submit" id="export" class="btn btn-primary float-right"><?php echo __('Export CSV'); ?></button>
            </div>
            <?php echo $this->Form->end() ?>
        </div>
    </div>
    <hr>
    <?php    $pagerParams = $this->Paginator->params();?>
    Found: <?php echo $pagerParams['count'] ?> 
    <?php if(!empty($users)): ?>
        <br>

        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th><?php echo __('Name'); ?></th>
                <th>User Type</th>
                <th><?php echo __('Email'); ?></th>
            </tr>
            <?php foreach($users as $u): ?>
                <tr>
                    <td><?php echo h($u['User']['id']) ?></td>
                    <td><?php echo h($u['User']['name']) ?></td>
                    <td><?php echo $u['User']['user_type_cd'] == 2 ? 'Sponsee' : 'Sponsor' ?></td>
                    <td><?php echo h($u['User']['email']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php echo $this->element('admin/pagination') ?>
    <?php endif; ?>
</div>
<script>
    $('#export').click(function(e){
        e.preventDefault();
        var url = baseURL + '/admin/admin_users/csv/'
        var data = {
            'name_like' : $('#UserNameLike').val(),
            'email_like' : $('#UserEmailLike').val(),
            'user_type_cd' : $('#UserUserTypeCd').val()
        };
        post(url, data);
    });
    $('#UserAdminIndexForm').on('submit', function(){
        $('#UserPage').val(1);
    });
</script>