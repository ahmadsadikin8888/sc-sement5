<div class="card">
    <div class="card-header">
        <h3 class="card-title">Hasil Upload Data Bayar</h3>
    </div>
    <div class="card-body">
        <div class='box-body table-responsive' id='box-table'>
            <div class="alert alert-icon alert-success" role="alert" id="information-success" style=""><i class="fe fe-check mr-2" aria-hidden="true"></i><small>Information : Sukses <?php echo count($status['Sukses']); ?> , Gagal proses <?php echo count($status['Gagal proses']); ?></small><br></div>

            <small>
                <table class='timecard' id="report_table_reg" style="width: 100%;">
                    <thead>

                        <tr>
                            <th>No.</th>
                            <th nowrap>Trans ID</th>
                            <th nowrap>CID</th>
                            <th nowrap>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        if (count($datana) > 0) {
                            foreach ($datana as $ag) {
                                $no++;
                        ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $ag['transid']; ?></td>
                                    <td><?php echo $ag['cid']; ?></td>
                                    <td><?php echo $ag['status']; ?></td>
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
<?php echo _js('datatables') ?>