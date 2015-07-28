<?php

namespace Optimus\Castle\Guard;

use InvalidArgumentException;

trait IdentifierResolverTrait {

    private function resolveIdentifier($subject, $identifier)
    {
        if (is_object($subject)) {
            if (!isset($subject->{$identifier})) {
                throw new InvalidArgumentException(get_class($subject) . " does not have a $identifier property");
            }

            return $subject->{$identifier};
        } else if(is_array($subject)) {
            if (!array_key_exists($identifer, $subject)) {
                throw new InvalidArgumentException(var_expor($subject, true)) . " does not have a $identifer key";
            }

            return $subject[$identifier];
        } else {
            return $subject;
        }
    }

}
