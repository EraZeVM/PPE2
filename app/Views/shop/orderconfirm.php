<h2>Informations sur la livraison</h2>

<form method="post" action="index.php?view=shop.ordervalidate">
  <fieldset>
    <legend>Adresse favorite</legend>

    <?= $form->input('address', 'Utiliser mon adresse favorite', ['type' => 'radio']); ?>

    


  </fieldset>
  <fieldset>
    <legend>Autre adresse</legend>

    <?= $form->input('address', 'Utiliser une nouvelle adresse', ['type' => 'radio']); ?>

    <?= $form->input('last_name', 'Nom'); ?>
    <?= $form->input('first_name', 'Prenom'); ?>
    <?= $form->input('phone_number', 'Numero de telephone'); ?>
    <?= $form->input('street_address', 'Adresse'); ?>
    <?= $form->input('city', 'City'); ?>
    <?= $form->input('region', 'Region'); ?>
    <?= $form->input('zipcode', 'Zipcode'); ?>
    <?= $form->input('country', 'Country'); ?>
  </fieldset>
  <?= $form->submit('Envoyer'); ?>
</form>
