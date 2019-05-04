<div class="row-fluid">
    <div class="span9">
        <h2><?php echo __('ユーザー編集'); ?></h2>
        <?php echo $this->Form->create('User', array(
                'type' => 'file', 'inputDefaults' => array(
                        'label' => false, 'div' => false
                )
        )); ?>
        <?php if(isset($this->request->data['User']['profile_pic'])
                 && $this->request->data['User']['profile_pic'] != ''
        ):
            echo $this->Html->image('/uploads/user_pic/'.$this->request->data['User']['profile_pic'], array(
                    'width' => '200', 'height' => '200', 'class' => 'img-polaroid control-group'
            ));
        endif; ?>

        <table class="table">
            <tr>
                <th><?php echo __('ユーザ名'); ?></th>
                <td>
                    <?php echo $this->Form->input('nick_name'); ?>
                </td>
            </tr>
            <tr>
                <th><?php echo __('名前'); ?></th>
                <td>
                    <?php echo $this->Form->input('name'); ?>
                </td>
            </tr>
            <tr>
                <th><?php echo __('メールアドレス'); ?></th>
                <td>
                    <?php echo $this->Form->input('email', array(
                            'required' => 'required', 'class' => 'span10'
                    )); ?>
                </td>
            </tr>
            <tr>
                <th><?php echo __('性別'); ?></th>
                <td>
                    <?php echo $this->Form->input('sex', array(
                            'type' => 'radio', 'options' => array(
                                    '男性' => __('男性'), '女性' => __('女性')
                            ), 'legend' => false,
                    )); ?>
                </td>
            </tr>
            <tr>
                <th><?php echo __('住所'); ?></th>
                <td>
                    <?php echo $this->Form->input('address', array(
                            'type' => 'text', 'class' => 'span12'
                    )); ?>
                </td>
            </tr>
            <tr>
                <th><?php echo __('生年月日'); ?></th>
                <td>
                    <?php echo $this->Form->input('birthday', array(
                            'minYear' => '1950', 'maxYear' => date('Y') - 15, 'dateFormat' => 'YMD',
                            'timeFormat' => '24', 'monthNames' => false, 'empty' => '---'
                    )); ?>
                </td>
            </tr>
            <tr>
                <th><?php echo __('自己紹介'); ?></th>
                <td>
                    <?php echo $this->Form->input('self_description', array()); ?>
                </td>
            </tr>
            <tr>
                <th>URL1</th>
                <td>
                    <?php echo $this->Form->input('url1', array()); ?>
                </td>
            </tr>
            <tr>
                <th>URL2</th>
                <td>
                    <?php echo $this->Form->input('url2', array()); ?>
                </td>
            </tr>
            <tr>
                <th>URL3</th>
                <td>
                    <?php echo $this->Form->input('url3', array()); ?>
                </td>
            </tr>
            <tr>
                <th><?php echo __('リターン受け取り住所'); ?></th>
                <td>
                    <?php echo $this->Form->input('receive_address', array()); ?>
                </td>
            </tr>
            <tr>
                <th><?php echo __('プロフィール画像'); ?></th>
                <td>
                    <?php echo $this->Form->input('profile_pic', array('type' => 'file')); ?>
                </td>
            </tr>
        </table>
        <?php echo $this->Form->submit(__('送信'), array('class' => 'btn btn-warning col-xs-3')); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
