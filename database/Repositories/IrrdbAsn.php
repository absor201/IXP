<?php

namespace Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * IrrdbAsn
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class IrrdbAsn extends EntityRepository
{
    /**
     * Utility function to get the ASNs of a customer prefix has for a given protocol
     *
     * Returns an array of associative arrays containing keys 'id' (database ID) and 'asn'.
     *
     * If `$flatten` is true, returns a flat array of (int)asns indexed by database ID.
     *
     * @param \Entities\Customer $cust The customer entity
     * @param int $protocol The IP protocol (4/6)
     * @param boolean $flatten Return a flat array of (int)asns indexed by database ID.
     * @return array The number of ASNs found
     */
    public function getForCustomerAndProtocol( $cust, $protocol, $flatten = false ): array
    {
        $asns = $this->getEntityManager()->createQuery(
                    "SELECT p.id, p.asn FROM \\Entities\\IrrdbAsn p
                        WHERE p.Customer = :cust AND p.protocol = :protocol
                        ORDER BY p.asn ASC, p.id ASC"
                )
                ->setParameter( 'cust', $cust )
                ->setParameter( 'protocol', $protocol )
                ->getScalarResult();

        // ASNs are an integer and should be returned as such:
        array_walk( $asns, function( &$element, $key ){ $element['asn'] = (int)$element['asn']; } );

        if( !$flatten ) {
            return $asns;
        }

        $flat = [];
        foreach( $asns as $p ) {
            $flat[ $p['id'] ] = $p['asn'];
        }

        return $flat;
    }

    /**
     * Utility function to get the number of ASNs a customer has for a given protocol
     *
     * @param \Entities\Customer $cust The customer entity
     * @param int $protocol The IP protocol (4/6)
     * @return int The number of prefixes found
     */
    public function getCountForCustomerAndProtocol( $cust, $protocol )
    {
        return $this->getEntityManager()->createQuery(
                    "SELECT COUNT(p.id) FROM \\Entities\\IrrdbAsn p
                        WHERE p.Customer = :cust AND p.protocol = :protocol"
                )
                ->setParameter( 'cust', $cust )
                ->setParameter( 'protocol', $protocol )
                ->getSingleScalarResult();
    }
}
