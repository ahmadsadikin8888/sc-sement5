<?php echo _css('datatables') ?>
<meta http-equiv="refresh" content="300">
<div class='timer2' data-start='<?php echo date('Y-m-d H:i:s') ?>' data-end='0'>
</div>
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
            Monitoring Realtime
        </h1>
    </div>
    <div class="row row-cards">
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <?php
                    if ($cache['duty_num'] != 0) {
                        if ($cache_monev_realtime['duty_num'] < $duty_num) {
                    ?>
                            <div class="text-right text-green">
                                <?php
                                echo abs($cache['duty_num']);
                                echo '<i class="fe fe-chevron-up"></i>';
                                ?>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="text-right text-red">
                                <?php
                                echo abs($cache['duty_num']);
                                echo '<i class="fe fe-chevron-down"></i>';
                                ?>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="text-right text-white">
                            <?php
                            echo abs($cache['duty_num']);
                            // echo '<i class="fe fe-chevron-down"></i>';
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="h1 m-0"><?php echo $duty_num; ?></div>
                    <div class="text-muted mb-4">ON DUTY</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <div class="text-right text-white">
                        <?php
                        echo abs($cache['duty_num']);
                        // echo '<i class="fe fe-chevron-down"></i>';
                        ?>
                    </div>
                    <div class="h1 m-0" id="oncall"><?php echo $oncall_num; ?></div>
                    <div class="text-muted mb-4">ON CALL</div>
                </div>
            </div>
        </div>


        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <?php
                    if ($cache['aux_num'] != 0) {
                        if ($cache_monev_realtime['aux_num'] < $aux_num) {
                    ?>
                            <div class="text-right text-red">
                                <?php
                                echo abs($cache['aux_num']);
                                echo '<i class="fe fe-chevron-up"></i>';
                                ?>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="text-right text-green">
                                <?php
                                echo abs($cache['aux_num']);
                                echo '<i class="fe fe-chevron-down"></i>';
                                ?>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="text-right text-white">
                            <?php
                            echo abs($cache['duty_num']);
                            // echo '<i class="fe fe-chevron-down"></i>';
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="h1 m-0"><?php echo $aux_num; ?></div>
                    <div class="text-muted mb-4">BREAK</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <?php
                    if ($cache['idle_num'] != 0) {
                        if ($cache_monev_realtime['idle_num'] < $idle_num) {
                    ?>
                            <div class="text-right text-red">
                                <?php
                                echo abs($cache['idle_num']);
                                echo '<i class="fe fe-chevron-up"></i>';
                                ?>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="text-right text-green">
                                <?php
                                echo abs($cache['idle_num']);
                                echo '<i class="fe fe-chevron-down"></i>';
                                ?>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="text-right text-white">
                            <?php
                            echo abs($cache['duty_num']);
                            // echo '<i class="fe fe-chevron-down"></i>';
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="h1 m-0"><?php echo $idle_num; ?></div>
                    <div class="text-muted mb-4">IDLE</div>
                </div>
            </div>
        </div>

        <div class="col-6 col-sm-4 col-lg-2">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <?php
                    if ($cache['logout_num'] != 0) {
                        if ($cache_monev_realtime['logout_num'] < $logout_num) {
                    ?>
                            <div class="text-right text-red">
                                <?php
                                echo abs($cache['logout_num']);
                                echo '<i class="fe fe-chevron-up"></i>';
                                ?>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="text-right text-green">
                                <?php
                                echo abs($cache['logout_num']);
                                echo '<i class="fe fe-chevron-down"></i>';
                                ?>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="text-right text-white">
                            <?php
                            echo abs($cache['duty_num']);
                            // echo '<i class="fe fe-chevron-down"></i>';
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="h1 m-0"><?php echo $logout_num; ?></div>
                    <div class="text-muted mb-4">OFFLINE</div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">AGENT STATUS</h3>
                </div>
                <div class="card-body">
                    <div class='box-body table-responsive' id='box-table'>
                        <small>
                            *<i>In a minute</i>
                            <table class='timecard' id="report_table_reg" style="width: 100%;">
                                <thead>

                                    <tr>
                                        <th>No.</th>
                                        <th nowrap>Agent ID</th>
                                        <th>Name</th>
                                        <th nowrap>Team Leader</th>
                                        <th>Status</th>
                                        <th>Contacted</th>
                                        <th>Duration</th>
                                        <th>Idle</th>
                                        <th>AUX</th>
                                        <th>Checkin</th>
                                        <th>Checkout</th>
                                        <!-- <th></th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $na = 0;
                                    if (count($agent['num']) > 0) {
                                        foreach ($agent['results'] as $ag) {
                                            $agent_peformance = $agent_status[$ag->agentid];
                                            $sub_total_contacted = $agent_status[$ag->agentid][1] + $agent_status[$ag->agentid][13] +  $agent_status[$ag->agentid][3] + $agent_status[$ag->agentid][12];
                                            $sub_total_uncontacted =  $agent_status[$ag->agentid][15] + $agent_status[$ag->agentid][8] + $agent_status[$ag->agentid][9] + $agent_status[$ag->agentid][4] + $agent_status[$ag->agentid][7] + $agent_status[$ag->agentid][11] + $agent_status[$ag->agentid][10] + $agent_status[$ag->agentid][14] + $agent_status[$ag->agentid][2];
                                            $na++;
                                    ?>
                                            <tr>
                                                <td>
                                                    <?php echo $na; ?>
                                                </td>
                                                <td>
                                                    <?php echo $ag->agentid; ?>
                                                </td>
                                                <td nowrap>
                                                    <?php echo $ag->nama; ?>
                                                </td>
                                                <td nowrap>
                                                    <?php echo $list_tl[$ag->tl]; ?>
                                                </td>
                                                <td nowrap>
                                                    <?php
                                                    $offline = false;
                                                    $aux = false;
                                                    $idle = false;
                                                    $other_status = false;
                                                    if (in_array($ag->agentid, $logout_data)) {
                                                        echo '<span class="status-icon bg-primary"></span> Offline';
                                                        $offline = true;
                                                    }
                                                    if (in_array($ag->agentid, $offline_data)) {
                                                        echo '<span class="status-icon bg-primary"></span> Offline';
                                                        $offline = true;
                                                    }
                                                    if (in_array($ag->agentid, $aux_data) && $offline == false) {
                                                        $dtl = $aux_detail[$ag->agentid]['ket'];
                                                        $lt = $aux_detail[$ag->agentid]['login_time'];
                                                        $dateax = new DateTime($lt);
                                                        $dateax2 = new DateTime(date('Y-m-d H:i:s'));

                                                        $diffax2 = $dateax2->getTimestamp() - $dateax->getTimestamp();
                                                        echo '<span class="status-icon bg-warning"></span> ' . $dtl . " : " . date('i:s', $diffax2);
                                                        $aux = true;
                                                    }
                                                    // if(count($aux_all_status[$ag->agentid]) > 0){
                                                    //     foreach($aux_all_status[$ag->agentid] as $stat=>$data_other){
                                                    //         echo '<span class="status-icon bg-warning"></span> '.$stat;
                                                    //     }

                                                    //     $other_status = true;
                                                    // }
                                                    if (in_array($ag->agentid, $idle_data) && $aux == false && $offline == false) {
                                                        echo '<span class="status-icon bg-danger" id="dot_' . $ag->agentid . '"></span> <span id="available_' . $ag->agentid . '">Idle</span>';
                                                        $idle = true;
                                                    }
                                                    if ($idle == false && $aux == false && $offline == false) {
                                                        if (!in_array($ag->agentid, $offline_data)) {
                                                            // if (in_array($ag->agentid, $oncall_data)) {
                                                            //     echo '<span class="status-icon bg-success" ></span> <span id="available_' . $ag->agentid . '">ONLINE</span>';
                                                            // } else {
                                                            echo '<span class="status-icon bg-success" id="dot_' . $ag->agentid . '"></span> <span id="available_' . $ag->agentid . '">Available</span>';
                                                            // }
                                                        } else {
                                                            echo '<span class="status-icon bg-primary" ></span> Offline';
                                                        }
                                                    }
                                                    ?>

                                                </td>
                                                <td>
                                                    <?php echo number_format($agent_peformance['call']->jumlah); ?>
                                                </td>
                                                <td>
                                                    <?php echo gmdate("H:i:s", $agent_peformance['call']->jumlah_duration); ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (in_array($ag->agentid, $idle_data)) {
                                                        echo number_format($agent_status[$ag->agentid]['idle'] / 60);
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo number_format($aux_all_status[$ag->agentid]['Break_'] / 60);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $agent_peformance['in']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $agent_peformance['out']; ?>
                                                </td>

                                                <!-- <td class="text-right">
                                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                                            </div>
                                        </td> -->
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </small>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#report_table_reg').DataTable();
                    });
                </script>
            </div>
        </div>
    </div>
</div>

</div>
<?php echo _js('datatables') ?>