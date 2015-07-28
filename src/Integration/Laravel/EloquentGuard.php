<?php

namespace Optimus\Castle\Integration\Laravel;

use InvalidArgumentException;
use Optimus\Castle\Guard\GuardInterface;
use Optimus\Castle\Guard\IdentifierResolverTrait;
use Illuminate\Database\Eloquent\Model;

class EloquentGuard implements GuardInterface {

    use IdentifierResolverTrait;

    private $foreignKeyIdentifier;

    public function __construct($foreignKeyIdentifier)
    {
        $this->foreignKeyIdentifier = $foreignKeyIdentifier;
    }

    public function run($left, $right)
    {
        $leftResolved  = $this->resolvePrimaryKey($left);
        $rightResolved = $this->resolveIdentifier($right, $this->foreignKeyIdentifier);

        return $leftResolved === $rightResolved;
    }

    private function resolvePrimaryKey($left)
    {
        if ($left instanceof Model) {
            $primaryKey = $left->getKeyName();
            return $left->{$primaryKey};
        } elseif(is_array($left)) {
            throw new InvalidArgumentException('Cannot use an array in an eloquent guard.');
        } else {
            return $left;
        }
    }

}
