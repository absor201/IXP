<?php $this->layout( 'layouts/ixpv4' ) ?>

<?php $this->section( 'title' ) ?>
    <a href="<?= action( 'SDNController@list' )?>">Controller</a>
<?php $this->append() ?>

<?php $this->section( 'page-header-postamble' ) ?>
    <li><?= ( $t->edit ) ? 'Edit' : 'Add' ?></li>
    <?= $t->rt->getId() ?>
<?php $this->append() ?>

<?php $this->section( 'page-header-preamble' ) ?>
    <li class="pull-right">
        <div class="btn-group btn-group-xs" role="group">
            <a type="button" class="btn btn-default" href="<?= route('controller/list' ) ?>" title="list">
                <span class="glyphicon glyphicon-th-list"></span>
            </a>
            <?php if( $t->edit ): ?>
                <a type="button" class="btn btn-default" href="<?= route ('controller/add' ) ?>" title="add">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
            <?php endif; ?>
        </div>
    </li>
<?php $this->append() ?>

<?php $this->section( 'content' ) ?>

    <?= $t->alerts() ?>
    <div  class="well col-sm-12">


        <?= Former::open()->method( 'POST' )
            ->action( action( 'SDNController@store' ) )
            ->customWidthClass( 'col-sm-6' )
            ->addClass( 'col-md-10' );
        ?>

        <?= Former::text( 'handle' )
            ->label( 'Handle' )
            ->placeholder( 'c1-lan1-ipv4' )
            ->blockHelp( "The handle is like the controller's name. It is suggested you use something like: <code>purpose-proto-lan</code>. A
                good example of this is <code>c1-lan1-ipv4</code> for <em>controller server #1</em> on <em>lan1</em> using <em>IPv4</em>.
                These handles are used in API calls and other areas such as configuration generation." );
        ?>

        <?= Former::select( 'vlan' )
            ->label( 'Vlan' )
            ->fromQuery( $t->vlans, 'name' )
            ->placeholder( 'Choose a VLAN' )
            ->addClass( 'chzn-select' );
        ?>

        <?= Former::text( 'controller_ip' )
            ->label( 'Controller IP' )
            ->placeholder('192.168.100.10')
            ->blockHelp( "The Controller's ip address." );
        ?>

        <?= Former::text( 'controller_port' )
            ->label( 'Controller Port' )
            ->placeholder( '6653' )
            ->blockHelp( "The Controller's Port on which it is listening like for faucet it is <em>6653</em> by default." );
        ?>

        <?= Former::text( 'api' )
            ->label( 'API Endpoint' )
            ->placeholder( "https://c1-lan1-ipv4.mgmt.example.com/api" )
            ->blockHelp( "The URL endpoint of the API." );
        ?>

        <?= Former::text( 'faucet_version')
            ->label( 'Faucet Version' )
            ->placeholder( "1.0" )
            ->blockHelp( "The version of the controller like <em>faucet controller</em> version." );
        ?>

        <?= Former::text( 'faucet_config')
            ->label( 'Faucet Config' )
            ->placeholder( "/etc/faucet/faucet.yaml:/etc/ryu/faucet/faucet.yaml" )
            ->blockHelp( "The version of the controller like <em>faucet controller</em> version." );
        ?>

        <?= Former::checkbox( 'faucet_config_stat_reload')
            ->label( 'Faucet Config Reload' )
            ->text( 'Check to automatically reload configuration' )
            ->unchecked_value( 0 )
            ->value( 1 )
            ->blockHelp( 'If checked, faucet will automatically reload itself and apply new configuration when <em>FAUCET_CONFIG</em> changes' );
        ?>

        <?= Former::text( 'faucet_log')
            ->label( 'Faucet Log' )
            ->placeholder( "/var/log/faucet/faucet.log" )
            ->blockHelp( "Location for faucet to log messages to, can be special values STDOUT or STDERR" );
        ?>

        <?= Former::text( 'faucet_log_exception')
            ->label( 'Faucet Log Exception' )
            ->placeholder( "/var/log/faucet/faucet_exception.log" )
            ->blockHelp( "Location for faucet log to log exceptions to, can be special values STDOUT or STDERR" );
        ?>

        <?= Former::text( 'faucet_event_sock')
            ->label( 'Faucet Event Log' )
            ->placeholder( "Socket Path" )
            ->blockHelp( "Location to a UNIX socket where faucet will write events to, or empty to disable events" );
        ?>            
        
        <?= Former::text( 'faucet_prometheus_port')
            ->label( 'Faucet Prometheus Port' )
            ->placeholder( '9302' )
            ->blockHelp( "TCP port to listen on for faucet prometheus client." );
        ?>

        <?= Former::text( 'faucet_prometheus_addr')
            ->label( 'Faucet Prometheus IP' )
            ->placeholder( '192.168.100.50' )
            ->blockHelp( "IP address to listen on for faucet prometheus client." );
        ?>

        <?= Former::text( 'faucet_pipeline_dir')
            ->label( 'Faucet Pipeline Dir' )
            ->placeholder( '/etc/faucet:/etc/ryu/faucet' )
            ->blockHelp( "Faucet will load pipeline definitions from the first valid directory in list" );
        ?>

        <?= Former::text( 'gauge_config')
            ->label( 'Gauge Config' )
            ->placeholder( "/etc/faucet/gauge.yaml:/etc/ryu/faucet/gauge.yaml" )
            ->blockHelp( "Gauge will load it’s configuration from the first valid file in list" );
        ?>
        
        <?= Former::checkbox( 'gauge_config_stat_reload')
            ->label( 'Gauge Config Reload' )
            ->text( 'Check to automatically reload configuration' )
            ->unchecked_value( 0 )
            ->value( 1 )
            ->blockHelp( 'If true, gauge will automatically reload itself and apply new configuration when <em> GAUGE_CONFIG </em> changes');
        ?>

        <?= Former::text( 'gauge_log')
            ->label( 'Gauge Log' )
            ->placeholder( "/var/log/faucet/gauge.log" )
            ->blockHelp( "Location for gauge to log messages to, can be special values STDOUT or STDERR" );
        ?>

        <?= Former::text( 'gauge_exception_log')
            ->label( 'Gauge Exception Log' )
            ->placeholder( "/var/log/faucet/gauge_exception.log" )
            ->blockHelp( "Location for faucet log to log exceptions to, can be special values STDOUT or STDERR" );
        ?>

        <?= Former::text( 'gauge_prometheus_addr')
            ->label( 'Gauge Prometheus IP' )
            ->placeholder( '192.168.100.51' )
            ->blockHelp( "IP address to listen on for gauge prometheus client" );
        ?>

        <?= Former::text( 'gauge_prometheus_port')
            ->label( 'Gauge Prometheus Port' )
            ->placeholder( '9303' )
            ->blockHelp( "TCP port to listen on for gauge prometheus client." );
        ?>

        <?=Former::actions( Former::primary_submit( 'Save Changes' ),
            Former::default_link( 'Cancel' )->href( action( 'SDNController@list' ) ),
            Former::success_button( 'Help' )->id( 'help-btn' )
        );?>

        <?= Former::hidden( 'id' )
            ->value( $t->rt ? $t->rt->getId() : '' )
        ?>

    <?= Former::close() ?>
    </div>
<?php $this->append() ?
