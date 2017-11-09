<?php

namespace Fds\AslMongoBundle\Service;

use Doctrine\ODM\MongoDB\DocumentManager;
/**
 * Mongo Service.
 */
class MongoService
{
    protected $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }
    
    public function getIdPlusOneAdded($document)
    {
        $qb = $this->dm->createQueryBuilder('FdsAslMongoBundle:'.$document)
            ->hydrate(false)
            ->limit(1)
            ->sort('createdAt', 'desc')
            ->select('identifier');
        
        $query = $qb->getQuery();
        $resident = $query->execute()->getSingleResult();
        
        if ($resident && array_key_exists('identifier', $resident)) {
            return (int) $resident['identifier']+1;
        } else {
            return (int) 1;
        }
    }
}