<?php

namespace Optimus\Castle\Guard;

use Optimus\Castle\Guard\GuardInterface;
use Optimus\Castle\Guard\IdentifierResolverTrait;

class EqualGuard implements GuardInterface {

    use IdentifierResolverTrait;

    private $leftIdentifier;

    private $rightIdentifier;

    public function __construct($leftIdentifier, $rightIdentifier)
    {
        $this->leftIdentifier = $leftIdentifier;
        $this->rightIdentifier = $rightIdentifier;
    }

    public function run($left, $right)
    {
        $leftResolved  = $this->resolveIdentifier($left, $this->leftIdentifier);
        $rightResolved = $this->resolveIdentifier($right, $this->rightIdentifier);

        return $leftResolved === $rightResolved;
    }

}
