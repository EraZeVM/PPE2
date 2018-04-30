<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimal-ui" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
    <meta http-equiv="content-language" content="fr" />
    <meta name="language" content="fr" />
    <title><?= App::getInstance()->title; ?></title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body>
    <header>
      <div class="header__top">
        <div class="search">
          <i class="fas fa-search"></i>
        </div>
        <div class="header__title">
          <a href="index.php?view=app.index"><h1>Daltons<span>Shop</span></h1></a>
        </div>
        <div class="account">
          <div class="wo__account">
            <a href="index.php?view=users.signin">Connexion</a>
            <a href="index.php?view=users.signup">Inscription</a>
          </div>
          <div class="w__account">
            <nav>
              <ul class="menu">
                <li><i class="far fa-user"></i>
                  <ul class="submenu">
                    <a href="index.php?view=users.index"><li>Compte</li></a>
                    <a href="index.php?view=users.orders"><li>Commandes</li></a>
                    <a href="index.php?view=users.signout"><li>Déconnexion</li></a>
                  </ul>
                </li>
                <li><i class="fas fa-shopping-cart"></i>
                  <ul class="submenu">
                    <a href="index.php?view=users.index"><li>test</li></a>
                    <a href="index.php?view=users.orders"><li>test</li></a>
                    <a href="index.php?view=users.signout"><li>test</li></a>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
      <div class="header__bottom">
        <nav>
          <ul>
            <a href="#"><li>Page d'accueil</li></a>
            <a href="index.php?view=shop.index"><li>Nos produits</li></a>
            <a href="#"><li>Règlement</li></a>
            <a href="#"><li>Formulaire de devis</li></a>
            <a href="#"><li>Contact</li></a>
          </ul>
        </nav>
      </div>
    </header>

    <?php if (!empty($_SESSION['flash'])): ?>
      <?php foreach ($_SESSION['flash'] as $type => $message): ?>
        <div class="alert alert-<?= $type; ?>">
          <?= $message; ?>
        </div>
      <?php endforeach; ?>
      <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <main>
      <?= $content; ?>
    </main>

    <footer>
      <div class="general-information">
        <h3>Daltons</h3>
        <div class="footer__col">
          <h4>A Propos</h4>
          <ul>
            <a href="#"><li>CGU / CGV</li></a>
            <a href="#"><li>Qui sommes-nous ?</li></a>
            <a href="#"><li>Mentions légales</li></a>
          </ul>
        </div>
        <div class="footer__col">
          <h4>Nous contacter</h4>
          <ul>
            <a href="#"><li>CGU / CGV</li></a>
            <a href="#"><li>Qui sommes-nous ?</li></a>
            <a href="#"><li>Mentions légales</li></a>
          </ul>
        </div>
        <div class="footer__col">
          <h4>Test</h4>
          <ul>
            <a href="#"><li>CGU / CGV</li></a>
            <a href="#"><li>Qui sommes-nous ?</li></a>
            <a href="#"><li>Mentions légales</li></a>
          </ul>
        </div>
      </div>
      <div class="copyright">
          <p>© 2017 Matthieu Clay, Inc.</p>
      </div>
    </footer>
  </body>
</html>
