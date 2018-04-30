<?php if (!empty($_SESSION['errors'])): ?>
  <div class="alert alert-danger">
    <p>Vous n'avez pas rempli le formulaire correctement</p>
    <ul>
      <?php foreach ($_SESSION['errors'] as $type => $message): ?>
        <li><?= $message; ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php unset($_SESSION['errors']); ?>
<?php endif; ?>

<form method="post">
  <?= $form->input('username', 'Pseudo'); ?>
  <?= $form->input('email', 'Email', ['type' => 'email']); ?>
  <?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
  <?= $form->input('password_confirm', 'Confirmer mot de passe', ['type' => 'password']); ?>
  <?= $form->submit('Envoyer'); ?>
</form>
