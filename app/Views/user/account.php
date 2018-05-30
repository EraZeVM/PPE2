<section>
  <form method="post">
    <?= $form->input('currentPassword', 'Mot de passe actuel', ['type' => 'password']); ?>
    <?= $form->input('newPassword', 'Nouveau mot de passe', ['type' => 'password']); ?>
    <?= $form->input('newPassword_confrim', 'Confirmation du nouveau mot de passe', ['type' => 'password']); ?>
    <?= $form->submit('Envoyer'); ?>
  </form>
</section>
