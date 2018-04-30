<form method="post">
  <?= $form->input('username', 'Pseudo'); ?>
  <?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
  <?= $form->submit('Envoyer'); ?>
</form>
