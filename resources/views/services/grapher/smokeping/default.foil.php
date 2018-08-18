#
# This file contains Smokeping configuration for customers VLAN interfaces
#
# WARNING: this file is automatically generated using the
#     api/v4/grapher/config?backend=smokeping&vlanid=<?= $t->vlan->getId() ?>&protocol=ipv<?= $t->protocol ?> API call to IXP Manager.
#   Any local changes made to this script will be lost.
#
# VLAN id: <?= $t->vlan->getId() ?>; tag: <?= $t->vlan->getNumber() ?>; name: <?= $t->vlan->getName() ?>; protocol: ipv<?= $t->protocol ?>.
#
# Generated: <?= date( 'Y-m-d H:i:s' ) . "\n" ?>
#

<?php foreach( $t->vlis as $vli ):

    if( !$vli['enabled'] || !$vli['canping'] ) {
        continue;
    }
    ?>

# <?= $vli['cname'] ?> / <?= $vli['address'] ?>

<?= $t->level ?> vlanint_<?= $vli['vliid'] ?>_ipv<?= $t->protocol ?>

menu = <?= preg_replace( '/[#\\\\]/', '', $vli['abrevcname'] . ' (IPv' . $t->protocol . ')' ) ?>

title =  <?= preg_replace( '/[#\\\\]/', '', $t->vlan->getName() . ' :: ' . $vli['abrevcname'] . ' via ' . $vli['address'] ) ?>

probe = <?= $t->probe ?>

host = <?= $vli['address'] ?>


<?php endforeach; ?>
