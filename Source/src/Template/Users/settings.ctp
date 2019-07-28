<?php
    use Cake\Core\Configure;
    use Cake\Utility\Inflector;

    $userBig = Inflector::pluralize(Inflector::camelize($user['role']));
    $userCamelize = Inflector::camelize($user['role']);

    // extend the appropriate view depending on user role
    $this->extend('/' . $userBig . '/common');

    $this->Title->set('Ρυθμίσεις');

    $this->Html->script('user/settings', ['block' => 'bottomScript']);

    $roleSpecificSettings = in_array($user['role'], ['student', 'professor']);
?>

<?php if ($roleSpecificSettings): // use tabs ?>
<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#user-settings" role="tab"><?= __('Χρήστης') ?></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#role-settings" role="tab"><?= $this->UserRole->translate($user['role']) ?></a>
  </li>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="user-settings" role="tabpanel">
    <?= $this->element('User/settings') ?>
  </div>
  <div class="tab-pane" id="role-settings" role="tabpanel">
    <?= $this->cell($userCamelize . '::settings', [$user['id']]) ?>
  </div>
</div>
<?php else: ?>
  <?= $this->element('User/settings') ?>
<?php endif; ?>