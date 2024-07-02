<?php

namespace App\Traits\Controller;

use App\Traits\Controller\Functions\TraitRestDestroy;
use App\Traits\Controller\Functions\TraitRestGetByWhere;
use App\Traits\Controller\Functions\TraitRestIndex;
use App\Traits\Controller\Functions\TraitRestResponse;
use App\Traits\Controller\Functions\TraitRestStore;
use App\Traits\Controller\Functions\TraitRestUpdate;
use App\Traits\Controller\Functions\TraitRestUpdateFields;

trait RestControllerTrait
{
    use TraitRestResponse;
    use TraitRestIndex;
    use TraitRestGetByWhere;
    use TraitRestStore;
    use TraitRestUpdate;
    use TraitRestUpdateFields;
    use TraitRestDestroy;
}
