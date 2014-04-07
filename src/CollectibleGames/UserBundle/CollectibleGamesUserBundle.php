<?php

namespace CollectibleGames\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CollectibleGamesUserBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }
}
?>